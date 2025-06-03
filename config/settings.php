<?php

$config = require __DIR__ . '/database.php';

$pdo = new PDO(
    "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
    $config['user'],
    $config['pass']
);
