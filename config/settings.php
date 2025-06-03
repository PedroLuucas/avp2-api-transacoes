<?php
use Slim\App;
use Psr\Container\ContainerInterface; // Manter este use

return function (App $app) {
    // O container agora é o seu SimpleContainer que foi definido em index.php
    $container = $app->getContainer();

    // Configuração do banco
    $config = require __DIR__ . '/database.php';

    // Registrar a factory PDO no container
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