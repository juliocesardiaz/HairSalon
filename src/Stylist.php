<?php
	class Stylist 
	{
		private $name; 
		private $id;
		
		function __construct($name, $id=null)
		{
			$this->name = $name;
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
		
		function getId()
		{
			return $this->name;
		}
		
		function save()
		{
			$GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
			$this->id = $GLOBALS['DB']->lastInsertId();
		}
		
		function update($new_name)
		{
			$GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->setName($new_name);
		}
		
		function delete()
		{
			$clients = Client::getAll();
			foreach($clients as $client) {
				if($client.getStylistId() == $this->getId()) {
					$client->delete();
				}
			}
			$GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
		}
	}
?>