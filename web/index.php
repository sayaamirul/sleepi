<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$app = new \Slim\App();

require __DIR__ . '/../app/error.php';

require __DIR__ . '/../app/database.php';

require __DIR__ . '/../app/routes.php';

$app->run();
