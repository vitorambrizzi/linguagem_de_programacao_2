<?php
// Imports configuration file and autoloader
require 'config.php';
require HELPERS_FOLDER . 'autoloader.php';

$route = new Router();
$route->handleCORS();
$route->gateKeeper();

$output = new Output();
$output->notFound();

?>