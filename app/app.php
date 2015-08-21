<?php 
	require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";
    $app = new Silex\Application();
    $app['debug'] = true;
    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
	
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__."/../views"
    ));
	
	$app->get("/", function() use ($app){
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    
    $app->post("/stylists", function() use ($app) {
            $stylist = new Stylist($_POST['name']);
            $stylist->save();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    
    $app->get("/stylists/{id}", function($id) use ($app) {
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });
    
    $app->get("/stylists/{id}/edit", function($id) use ($app){
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist)); 
    });
    
    $app->patch("/stylists/{id}", function($id) use ($app){
            $stylist = Stylist::find($id);
            $stylist->update($_POST['name']);
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll())); 
    });
    
    $app->delete("/stylists/{id}", function($id) use ($app){
       $stylist = Stylist::find($id);
       $stylist->delete();
       return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll())); 
    });
    
    $app->post("/clients", function() use ($app) {
            $client = new Client($_POST['name'], $_POST['stylist_id']);
            $client->save();
            $stylist = Stylist::find($client->getStylistId());
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });
    
    $app->get("/clients/{id}/edit", function($id) use ($app){
            $client = Client::find($id);
            return $app['twig']->render('client_edit.html.twig', array('client' => $client)); 
    });
    
    $app->patch("/clients/{id}", function($id) use ($app){
            $client = Client::find($id);
            $client->update($_POST['name'], $_POST['stylist_id']);
            $stylist = Stylist::find($client->getStylistId());
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll())); 
    });
    
    $app->delete("/clients/{id}", function($id) use ($app){
       $client = Client::find($id);
       $stylist = Stylist::find($client->getStylistId());
       $client->delete();
       return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll())); 
    });
	
	return $app;
?>