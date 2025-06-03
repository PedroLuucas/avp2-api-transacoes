<?php
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

(require __DIR__ . '/../config/settings.php')($app);
(require __DIR__ . '/../app/Routes/routes.php')($app);

$app->run();
