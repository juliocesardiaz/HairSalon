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
		
		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getName()}', {$this->getStylistId()});");
			$this->id = $GLOBALS['DB']->lastInsertId();
		}
		
		function updateName($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->name = $new_name;
		}
		
		function updateStylistId($new_stylist_id)
		{
			$GLOBALS['DB']->exec("UPDATE clients SET stylist_id = {$new_stylist_id} WHERE id = {$this->getId()};");
			$this->stylist_id = $new_stylist_id;
		}
		
		function update($new_name, $new_stylist_id)
		{
			$this->updateName($new_name);
			$this->updateStylistId($new_stylist_id);
		}
		
		function delete()
		{
			$GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
		}
		
		static function getAll()
		{
			$returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
			$clients = array();
			foreach($returned_clients as $client) {
				$name = $client['name'];
				$stylist_id = $client['stylist_id'];
				$id = $client['id'];
				$new_client = new Client($name, $stylist_id, $id);
				array_push($clients, $new_client);
			}
			return $clients;
		}
		
		static function deleteAll()
		{
			$GLOBALS['DB']->exec("DELETE FROM clients;");
		}
	}
?>