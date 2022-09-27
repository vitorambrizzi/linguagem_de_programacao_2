<?php
require 'config.php';
require HELPERS_FOLDER . 'autoloader.php';

Router::gateKeeper();

Output::notFound();
?>