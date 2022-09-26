<?php
require 'config.php';
require HELPERS_FOLDER . 'autoloader.php';

Router::handleCORS();
Router::gateKeeper();

Output::notFound();
?>