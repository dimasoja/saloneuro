<?php

defined('SYSPATH') or die('No direct script access.');

class ViewFormError
{
   private static $_form_fields = array();

   private function  __construct() {}

   public static function addFields($fields)
   {

      if (is_array($fields))
      {
         foreach($fields as $item)
         {
            array_push(self::$_form_fields, $item);
         }
      }
      else
      {
         array_push(self::$_form_fields, $fields);
      }
   }   // addFields

   public static function setValues($view, $values, $post = array())
   {
       
      if (!is_object($values))
      {
         $temp = new stdClass();
         if (is_array($values))
         {
            foreach($values as $item => $value)
            {
                $temp->$item = $value;
            }
         }
         $values = $temp;
         unset($temp);
      }
      $post_array = $post;
      if (is_object($post))
      {
         $post_array = $post->as_array();
      }

      foreach(self::$_form_fields as $item)
      {
         if (isset($post_array[$item]) && is_array($post_array[$item]))
         {
            $post_array[$item] = '';
         }
         if (isset($post_array[$item]) && '' != trim($post_array[$item]))
         {
            $view->$item = $post_array[$item];
         }
         elseif (isset($values->$item))
         {
            $view->$item = $values->$item;
         }
         else
         {
            $view->$item = '';
         }
      }
      return $view;
   }   // setValues

   public static function build($view, $post, $values = array(), $errors = array())
   {
      $is_post_object = false;
      $post_array = array();
      if (is_object($post))
      {
         $is_post_object = true;
         $post_array = $post->as_array();
      }
      foreach(self::$_form_fields as $item)
      {
         $temp_text_error = $item . '_error';
         $temp_class_error = $item . '_show_error';
         $error_text = '';
         if (isset($errors[$item]))
         {
            $error_text = $errors[$item];
         }
         elseif ($is_post_object)
         {
            $error_text = $post->errors('errors');
            if (isset($error_text[$item]))
            {
               $error_text = $error_text[$item];
            }
            else
            {
               $error_text = '';
            }
         }
         $view->$temp_text_error = $error_text;
         $view->$temp_class_error = ('' != trim($error_text)) ? '_error' : '';
      }
      return self::setValues($view, $values, $post_array);
   }   // build

}   // class ViewFormError