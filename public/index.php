<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

(require __DIR__ . '/../config/settings.php')($app);
(require __DIR__ . '/../app/Routes/routes.php')($app);

$app->run();
