<?php defined('SYSPATH') or die('No direct script access.');

class MultiORM extends Kohana_ORM {

    protected $_content_rows = array();
    protected $_content_table = '';
    protected $_language = '';
    protected $_lang_content_sql_prefix = 'l_';
    protected $_table_language_field = 'language';

    public function __construct($id = NULL){
        global $requested_language;
        parent::__construct($id);

        $this->_language = $requested_language;
    }

	protected function _load_result($multiple = FALSE)
	{


		$this->_db_builder->from($this->_table_name);
		$this->_db_builder->join($this->_content_table,'LEFT')->on($this->_table_name.'.'.$this->_primary_key,'=',$this->_content_table.'.'.$this->_primary_key)->on($this->_content_table.'.language','=',DB::expr("'".$this->_language."'"));

//var_dump($this->_language); exit;
		if ($multiple === FALSE)
		{
			// Only fetch 1 record
			$this->_db_builder->limit(1);
		}
        $db_expr = array();
        foreach($this->_content_rows as $column){
            $db_expr[] = ''.$this->_content_table.'.'.$column.' as '.$this->_lang_content_sql_prefix.$column;
        }

		// Select all columns by default
		$this->_db_builder->select($this->_table_name.'.*');
		$this->_db_builder->select(DB::expr(implode($db_expr,',')));

		if ( ! empty($this->_load_with))
		{
			foreach ($this->_load_with as $alias => $object)
			{
				// Join each object into the results
				if (is_string($alias))
				{
					// Use alias
					$this->with($alias);
				}
				else
				{
					// Use object as name
					$this->with($object);
				}
			}
		}

		if ( ! isset($this->_db_applied['order_by']) AND ! empty($this->_sorting))
		{
			foreach ($this->_sorting as $column => $direction)
			{
				if (strpos($column, '.') === FALSE)
				{
					// Sorting column for use in JOINs
					$column = $this->_table_name.'.'.$column;
				}

				$this->_db_builder->order_by($column, $direction);
			}
		}

		if ($multiple === TRUE)
		{
			// Return database iterator casting to this object type
			$result = $this->_db_builder->as_object(get_class($this))->execute($this->_db);

			$this->_reset();

			return $result;
		}
		else
		{
			// Load the result as an associative array

			$result = $this->_db_builder->as_assoc()->execute($this->_db);

			$this->_reset();

			if ($result->count() === 1)
			{
				// Load object values
                //var_dump($result);

				$this->_load_values($result->current(),true);
			}
			else
			{
				// Clear the object, nothing was found
				$this->clear();
			}

			return $this;
		}
	}


	/**
	 * Loads an array of values into into the current object.
	 *
	 * @chainable
	 * @param   array  values to load
	 * @return  ORM
	 */
	protected function _load_values(array $values, $load = false)
	{

		if (array_key_exists($this->_primary_key, $values))
		{
			// Set the loaded and saved object status based on the primary key
			$this->_loaded = $this->_saved = ($values[$this->_primary_key] !== NULL);
		}

		// Related objects
		$related = array();

		foreach ($values as $column => $value)
		{
            if(strpos($column, 'l_') === FALSE || !$load){
                if (strpos($column, ':') === FALSE)
                {
                    if ( ! isset($this->_changed[$column]))
                    {
                        if (isset($this->_table_columns[$column]))
                        {
                            // The type of the value can be determined, convert the value
                            $value = $this->_load_type($column, $value);
                        }

                        if($load){
                            if(isset($values[''.$this->_lang_content_sql_prefix.$column]) && $values['l_'.$column])
                                $this->_object[$column] = $values[''.$this->_lang_content_sql_prefix.$column];
                            else
                                $this->_object[$column] = $value;
                        }
                        else
                        {
                            $this->_object[$column] = $value;
                        }

                    }
                }
                else
                {
                    list ($prefix, $column) = explode(':', $column, 2);

                    $related[$prefix][$column] = $value;
                }
            }
		}

		if ( ! empty($related))
		{
			foreach ($related as $object => $values)
			{
				// Load the related objects with the values in the result
				$this->_related($object)->_load_values($values);
			}
		}

		return $this;
	}

	/**
	 * Handles retrieval of all model values, relationships, and metadata.
	 *
	 * @param   string  column name
	 * @return  mixed
	 */
	public function __get($column)
	{   
		if (array_key_exists($column, $this->_object))
		{
			$this->_load();

            if(isset($this->_object[''.$this->_lang_content_sql_prefix.$column]) && $this->_object[''.$this->_lang_content_sql_prefix.$column] != ''){

                $this->_object[$column] = $this->_object[''.$this->_lang_content_sql_prefix.$column];
                //TODO: refactor this if
                unset($this->_object[''.$this->_lang_content_sql_prefix.$column]);
            }

			return $this->_object[$column];
		}
		elseif (isset($this->_related[$column]) AND $this->_related[$column]->_loaded)
		{
			// Return related model that has already been loaded
			return $this->_related[$column];
		}
		elseif (isset($this->_belongs_to[$column]))
		{
			$this->_load();

			$model = $this->_related($column);

			// Use this model's column and foreign model's primary key
			$col = $model->_table_name.'.'.$model->_primary_key;
			$val = $this->_object[$this->_belongs_to[$column]['foreign_key']];

			$model->where($col, '=', $val)->find();

			return $model;
		}
		elseif (isset($this->_has_one[$column]))
		{
			$model = $this->_related($column);

			// Use this model's primary key value and foreign model's column
			$col = $model->_table_name.'.'.$this->_has_one[$column]['foreign_key'];
			$val = $this->pk();

			$model->where($col, '=', $val)->find();

			return $model;
		}
		elseif (isset($this->_has_many[$column]))
		{

			$model = ORM::factory($this->_has_many[$column]['model']);

			if (isset($this->_has_many[$column]['through']))
			{
				// Grab has_many "through" relationship table
				$through = $this->_has_many[$column]['through'];

				// Join on through model's target foreign key (far_key) and target model's primary key
				$join_col1 = $through.'.'.$this->_has_many[$column]['far_key'];
				$join_col2 = $model->_table_name.'.'.$model->_primary_key;

				$model->join($through)->on($join_col1, '=', $join_col2);

				// Through table's source foreign key (foreign_key) should be this model's primary key
				$col = $through.'.'.$this->_has_many[$column]['foreign_key'];
				$val = $this->pk();
			}
			else
			{
				// Simple has_many relationship, search where target model's foreign key is this model's primary key
				$col = DB::expr($model->_table_name.'.'.$this->_has_many[$column]['foreign_key']);
				$val = $this->pk();
			}

			return $model->where($col, '=', $val);
		}
		else
		{
			throw new Kohana_Exception('The :property property does not exist in the :class class',
				array(':property' => $column, ':class' => get_class($this)));
		}
        
	}


	public function __call($method, array $args)
	{ 
		if (in_array($method, self::$_properties))
		{
			if ($method === 'loaded')
			{
				$this->_load();
			}
			elseif ($method === 'validate')
			{
				if ( ! isset($this->_validate))
				{
					// Initialize the validation object
					$this->_validate();
				}
			}

			// Return the property
			return $this->{'_'.$method};
		}
		elseif (in_array($method, self::$_db_methods))
		{
			// Add pending database call which is executed after query type is determined
            if( !($args[0] instanceof Database_Expression)){
                $args[0] = $this->_table_name.'.'.$args[0];
            }

			$this->_db_pending[] = array('name' => $method, 'args' => $args);

			return $this;
		}
		else
		{
			throw new Kohana_Exception('Invalid method :method called in :class',
				array(':method' => $method, ':class' => get_class($this)));
		}
	}


	/**
	 * Saves the current object.
	 *
	 * @chainable
	 * @return  ORM
	 */
	public function save()
	{


            //print_r($this->_language);
            //exit;
        if(!$this->_language || $this->_language == 'fr'){
		if (empty($this->_changed))
			return $this;

		$data = array();

		foreach ($this->_changed as $column)
		{
			if ( ! in_array($column, $this->_ignored_columns))
			{
				// Compile changed data if it's not an ignored column
				$data[$column] = $this->_object[$column];
			}
		}

		if ( ! $this->empty_pk() AND ! isset($this->_changed[$this->_primary_key]))
		{
			// Primary key isn't empty and hasn't been changed so do an update

			if (is_array($this->_updated_column))
			{
				// Fill the updated column
				$column = $this->_updated_column['column'];
				$format = $this->_updated_column['format'];

				$data[$column] = $this->_object[$column] = ($format === TRUE) ? time() : date($format);
			}

			$query = DB::update($this->_table_name)
				->set($data)
				->where($this->_primary_key, '=', $this->pk())
				->execute($this->_db);

			// Object has been saved
			$this->_saved = TRUE;
		}
		else
		{
			if (is_array($this->_created_column))
			{
				// Fill the created column
				$column = $this->_created_column['column'];
				$format = $this->_created_column['format'];

				$data[$column] = $this->_object[$column] = ($format === TRUE) ? time() : date($format);
			}

			$result = DB::insert($this->_table_name)
				->columns(array_keys($data))
				->values(array_values($data))
				->execute($this->_db);

			if ($result)
			{
				if ($this->empty_pk())
				{
					// Load the insert id as the primary key
					// $result is array(insert_id, total_rows)
					$this->_object[$this->_primary_key] = $result[0];
				}

				// Object is now loaded and saved
				$this->_loaded = $this->_saved = TRUE;
			}
		}

		if ($this->_saved === TRUE)
		{
			// All changes have been saved
			$this->_changed = array();
		}

		return $this;
        }
        else
        {
            $data = array();
            foreach ($this->_changed as $column)
            {
                if ( ! in_array($column, $this->_ignored_columns))
                {
                    // Compile changed data if it's not an ignored column
                    $data[$column] = $this->_object[$column];
                }
            }

            if (  $this->empty_pk()){

                if (is_array($this->_created_column))
                {
                    // Fill the created column
                    $column = $this->_created_column['column'];
                    $format = $this->_created_column['format'];

                    $data[$column] = $this->_object[$column] = ($format === TRUE) ? time() : date($format);
                }

                $result = DB::insert($this->_table_name)
                    ->columns(array_keys($data))
                    ->values(array_values($data))
                    ->execute($this->_db);

                if ($result)
                {
                    if ($this->empty_pk())
                    {
                        // Load the insert id as the primary key
                        // $result is array(insert_id, total_rows)
                        $this->_object[$this->_primary_key] = $result[0];
                    }

                    // Object is now loaded and saved
                    $this->_loaded = $this->_saved = TRUE;
                }

            }/*
            else
            {
                // Primary key isn't empty and hasn't been changed so do an update

                if (is_array($this->_updated_column))
                {
                    // Fill the updated column
                    $column = $this->_updated_column['column'];
                    $format = $this->_updated_column['format'];

                    $data[$column] = $this->_object[$column] = ($format === TRUE) ? time() : date($format);
                }

                $query = DB::update($this->_table_name)
                    ->set($data)
                    ->where($this->_primary_key, '=', $this->pk())
                    ->execute($this->_db);

                // Object has been saved
			    $this->_saved = TRUE;
            }
*/


                try{
                    $multi = $this->contents;
                }
                catch(Exception $e){
                        return $this;
                }


                $multi = $multi->where($this->_table_language_field,'=',$this->_language)->find();
            
                $data = array();
                if(isset($this->_changed[$this->_primary_key])){
                    $multi->{$this->_primary_key} = $this->_changed[$this->_primary_key];
                }else
                {
                    if($multi->{$this->_primary_key} != $this->_object[$this->_primary_key]){
                        $multi->{$this->_primary_key} = $this->_object[$this->_primary_key];
                    }
                }

                $multi->{$this->_table_language_field} = $this->_language;
//var_dump($this->_object);exit;
                foreach ($this->_object as $column => $value)
                {   //echo $column . '  - > ' . in_array($column, $this->_content_rows);
                    if ( ! in_array($column, $this->_ignored_columns) && in_array($column, $this->_content_rows))
                    {

                        $multi->{$column} = $this->_object[$column];
                        //echo $this->_object[$column];
                    }
                }

                if($multi->save())
                    return $this;

                return false;

        }
	}

}