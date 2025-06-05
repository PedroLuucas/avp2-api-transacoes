<?php
use Slim\App;
use Psr\Container\ContainerInterface;

return function (App $app) {
    
    $container = $app->getContainer();
    
    $config = require __DIR__ . '/database.php';
    
    $container->set('pdo_factory', function () use ($config) {
        return new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
            $config['user'],
            $config['pass'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]
        );
    });
};
