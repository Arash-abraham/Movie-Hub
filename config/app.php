<?php

    require_once '../vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $dotenv->required(['APP_TITLE', 'BASE_URL']);

    define("APP_TITLE", $_ENV['APP_TITLE']);
    define("BASE_URL", rtrim($_ENV['BASE_URL'], '/'));
    define("BASE_DIR", realpath(dirname(__DIR__)));

    if ($_ENV['APP_DEBUG'] ?? false) {
        error_log("Config loaded - APP_TITLE: " . APP_TITLE . ", BASE_URL: " . BASE_URL);
    }

    // print $_ENV['APP_TITLE'];

    return [
        'APP_TITLE' => $_ENV['APP_TITLE'],
        'BASE_URL' => rtrim($_ENV['BASE_URL'], '/'),
        'BASE_DIR' => realpath(dirname(__DIR__))
    ];

?>