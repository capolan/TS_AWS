<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {

    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    // Create a DI
    $di = new FactoryDefault();

    // Setup the view component
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    // Setup a base URI so that all generated URIs include the "tutorial" folder
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    });

    // Setup the database service
    $di->set('db', function () {
        return new DbAdapter(array(
            "adapter"  => "Mysql",
            "host"     => "45.55.77.192",
            "username" => "sensor-test",
            "password" => "SensorTest33#",
            "dbname"   => "TEST_DB"
        ));
    });

    // Handle the request
    $application = new Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo get_class($e), ": ", $e->getMessage(), "\n";
    echo " File=", $e->getFile(), "\n";
    echo " Line=", $e->getLine(), "\n";
    echo $e->getTraceAsString();
}

?>

