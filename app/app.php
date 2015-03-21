<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app['debug']=TRUE;

    $app->get("/", function() use ($app) {
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists", function() use ($app) {
      return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/clients", function() use ($app) {
      return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
    });

    //"call to getClients on null" error; because the find() function isn't putting anything into $stylist variable
    $app->get("/stylists/{id}", function($id) use ($app) {
      $stylist = Stylist::find($id);
      return $app['twig']->render('stylistsId.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
      $stylist = Stylist::find($id);
      return $app['twig']->render('stylists_edit.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/stylists", function() use ($app) {
      $stylist = new Stylist($_POST['name']);
      $stylist->save();
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/clients", function() use ($app) {
      $name = $_POST['name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $stylist_id = $_POST['stylist_id'];
      $client = new Client($name, $phone, $email, $id = null, $stylist_id);
      $client->save();
      $stylist = Stylist::find($stylist_id);
      return $app['twig']->render('stylistsId.html.twig', array('stylists' => $stylist, 'clients' => Client::getAll()));
    });

    $app->post("/delete_stylists", function() use ($app) {
      Stylist::deleteAll();
      return $app['twig']->render('index.html.twig');
    });

    $app->post("/delete_clients", function() use ($app) {
      Client::deleteAll();
      return $app['twig']->render('index.html.twig');
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
      $stylist = Stylist::find($id);
      $stylist->delete();
      return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
      $name = $_POST['name'];
      $stylist = Stylist::find($id);
      $stylist->update($name);
      return $app['twig']->render('stylistsId.html.twig', array('stylists' => $stylist, 'clients' => $stylist->getClients()));
    });

    return $app;

?>
