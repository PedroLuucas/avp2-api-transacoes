<?php

use Slim\App;
use Psr\Container\ContainerInterface;
use DI\Container;

return function (App $app) {
    $container = new Container();

    $config = require __DIR__ . '/database.php';

    $container->set('db', function () use ($config) {
        return new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
            $config['user'],
            $config['pass'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    });

    AppFactory::setContainer($container);
};
