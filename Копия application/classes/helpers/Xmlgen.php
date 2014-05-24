<?php

	class Xmlgen
	{
		private $data;
		private $model;
		public function __construct($data)
		{
			$this->data=$data;
			$this->generate();
		}
		private function generate()
		{
			$this->model=new DOMDocument('1.0', 'UTF-8');
			foreach ($this->data as $k=>$v)
			{
				$newnode=$this->model->createElement($k);
				if(is_array($v))
				{
					$newnode=$this->parseNode($v,$newnode);
				}
				$this->model->appendChild($newnode);
			}
		}
		private function count($arr)
		{
			$count=0;
			foreach ($arr as $k=>$v)
			{
				if(!((string)$k{0}=='@'||(string)$k=='#'))
				{
					$count+=1;
				}
			}
			return $count;
		}
		private function parseNode($arr,$trunk,$up=0)
		{
			foreach ($arr as $k=>$v)
			{
				if(ctype_digit($k)||is_int($k))
				{
					$this->parseNode($v,$trunk,1);
					continue;
				}
				elseif($k{0}=='@')
				{
					$newnode=$this->model->createAttribute(substr($k,1));
					$newnode->value=$v;
				}
				elseif ($k=='#')
				{
					$newnode=$this->model->createCDATASection($v);
				}
				else 
				{
					$newnode=$this->model->createElement($k);
					if(is_array($v))
					{
						$newnode=$this->parseNode($v,$newnode);
					}
					else
					{
						$newnode->nodeValue=$v;
					}
				}
				$trunk->appendChild($newnode);
			}
			return $trunk;
		}
		public function getXml()
		{
			$this->model->formatOutput = true;
			return $this->model->saveXML();
		}
		public function printXml()
		{
			header ("content-type: text/xml");
			echo $this->getXml();
		}
	}
	
	
?>