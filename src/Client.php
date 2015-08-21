<?php 
	class Client
	{
		private $name;
		private $stylist_id;
		private $id;
		
		function __construct($name, $stylist_id, $id=null)
		{
			$this->name = $name;
			$this->stylist_id = $stylist_id;
			$this->id = $id;
		}
		
		function setName($new_name)
		{
			$this->name = $new_name;
		}
		
		function getName()
		{
			return $this->name;
		}
		
		function setStylistId($new_stylist_id)
		{
			$this->stylist_id = $new_stylist_id;
		}
		
		function getStylistId()
		{
			return $this->stylist_id;
		}
		
		function getId()
		{
			return $this->id;
		}
	}
?>