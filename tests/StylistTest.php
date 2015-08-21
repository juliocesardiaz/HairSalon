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
	
	class StylistTest extends PHPUnit_Framework_TestCase
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
			
			$result = $test_stylist->getName();
			
			$this->assertEquals($name, $result);
		}
		
		function test_getId()
		{
			$name = "Jane Doe";
			$id = 1;
			$test_stylist = new Stylist($name, $id);
			
			$result = $test_stylist->getId();
			
			$this->assertEquals($id, $result);
		}
		
		function test_getAll()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			$name2 = "James Don";
			$test_stylist2 = new Stylist($name2);
			$test_stylist2->save();
			
			$result = Stylist::getAll();
			
			$this->assertEquals([$test_stylist, $test_stylist2], $result);
		}
		
		function test_save()
		{
			$name = "Johnny Bravo";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			
			$result = Stylist::getAll();
			
			$this->assertEquals($test_stylist, $result[0]);
		}
		
		function test_deleteAll()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			$name2 = "James Don";
			$test_stylist2 = new Stylist($name2);
			$test_stylist2->save();
			
			Stylist::deleteAll();
			$result = Stylist::getAll();
			
			$this->assertEquals([], $result);
		}
		
		function test_update()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			$name2 = "James Don";
			$test_stylist->update($name2);
		
			$result = Stylist::getAll();
			
			$this->assertEquals($name2, $result[0]->getName());	
		}
		
		function test_find()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			$name2 = "James Don";
			$test_stylist2 = new Stylist($name2);
			$test_stylist2->save();
			
			$search_stylist = $test_stylist->getId();
			$result = Stylist::find($search_stylist);
			
			$this->assertEquals($test_stylist, $result);
		}
		
		function test_delete()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			$name2 = "James Don";
			$test_stylist2 = new Stylist($name2);
			$test_stylist2->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			$test_client->save();
			
			$test_stylist->delete();
			$result = Stylist::getAll();
			
			$this->assertEquals([$test_stylist2], $result);
		}
		
		function test_getClients()
		{
			$name = "Jane Doe";
			$test_stylist = new Stylist($name);
			$test_stylist->save();
			$name2 = "James Don";
			$test_stylist2 = new Stylist($name2);
			$test_stylist2->save();
			
			$client_name = "Jimmy";
			$client_stylist_id = $test_stylist->getId();
			$test_client = new Client($client_name, $client_stylist_id);
			$test_client->save();
			$client_name2 = "Brea";
			$client_stylist_id2 = $test_stylist2->getId();
			$test_client2 = new Client($client_name, $client_stylist_id);
			$test_client2->save();
			
			
			$result = $test_stylist->getClients();
			
			$this->assertEquals($test_client, $result[0]);
		}
	}
?>