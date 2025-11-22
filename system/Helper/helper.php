<?php
    use System\View\ViewBuilder;

    function view($dir , $vars = []) {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'Router' . DIRECTORY_SEPARATOR . 'View');
        $twig = new \Twig\Environment($loader);
        
        $data = $vars;
        
        echo $twig->render($dir, $data);
        exit;
    }
?>