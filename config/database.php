<?php 

    // require_once 'vendor/autoload.php';

    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $dotenv->required(['APP_TITLE', 'BASE_URL']);

    define("DB_HOST", $_ENV['DBHOST']);
    define("DB_NAME", $_ENV['DBNAME']);
    define("DB_USERNAME", $_ENV['DBUSERNAME']);
    define("DB_PASSWORD", $_ENV['DBPASSWORD'] ?? ''); 

    if ($_ENV['APP_DEBUG'] ?? false) {
        error_log("Database Config - Host: " . DB_HOST . ", DB: " . DB_NAME);
    }

?>