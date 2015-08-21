<?php 
	/**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
	
	require_once "src/Client.php";
	require_once "src/Stylist.php";
	
	$server = 'mysql:host=localhost;dbname=hair_salon_test';
	$username = 'root';
	$password = 'root';
	$DB = new PDO($server, $username, $password);
	
	class ClientTest extends PHPUnit_Framework_TestCase
	{
		protected function tearDown()
		{
			Client::deleteAll();
			Stylist::deleteAll();
		}
		
		function test_getName()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			
			$result = $test_client->getName();
			
			$this->assertEquals($client_name, $result);
		}
		
		function test_getId()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$id = 1;
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id, $id);
			
			$result = $test_client->getId();
			
			$this->assertEquals($id, $result);
		}
		
		function test_getStylistId()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$id = 1;
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			
			$result = $test_client->getStylistId();
			
			$this->assertEquals($client_stylist_id, $result);
		}
		
		function test_save()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			$test_client->save();
			
			$result = Client::getAll();
			
			$this->assertEquals($test_client, $result[0]);
		}
		
		function test_getAll()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			$test_client->save();
			
			$client_name2 = "Coco";
			$test_client2 = new Client($client_name, $client_stylist_id);
			$test_client2->save();
			
			$result = Client::getAll();
			
			$this->assertEquals([$test_client, $test_client2], $result);
		}
		
		function test_deleteAll()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			$test_client->save();
			
			$client_name2 = "Coco";
			$test_client2 = new Client($client_name, $client_stylist_id);
			$test_client2->save();
			
			Client::deleteAll();
			$result = Client::getAll();
			
			$this->assertEquals([], $result);
		}
		
		function test_update()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			$test_client->save();
			
			$client_name2 = "Coco";
			$test_client->update($client_name2, $client_stylist_id);
		
			$result = Client::getAll();
			
			$this->assertEquals($client_name2, $result[0]->getName());
		}
		
		function test_delete()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			$test_client->save();
			
			$client_name2 = "Coco";
			$test_client2 = new Client($client_name2, $client_stylist_id);
			$test_client2->save();
			
			$test_client->delete();
			$result = Client::getAll();
			
			$this->assertEquals([$test_client2], $result);
		}
	}
?>