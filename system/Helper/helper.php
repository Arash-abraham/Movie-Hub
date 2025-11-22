<?php
    use System\View\ViewBuilder;

    function view($dir , $vars = []) {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'Router' . DIRECTORY_SEPARATOR . 'View');
        $twig = new \Twig\Environment($loader);
        
        $data = [
            'page_title' => "Page Not Found - ".APP_TITLE,
            'error_code' => "404",
            'error_title' => "Oops! Page Not Found",
            'message' => "The page you're looking for doesn't exist or has been moved.",
            'home_url' => BASE_URL
        ];
        
        echo $twig->render($dir, $data);
        exit;
    }
?>