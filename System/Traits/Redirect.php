<?php
    namespace System\Traits;
    require_once 'System/config.php';
    trait Redirect {
        protected function redirect($url) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'];
            $baseDir = BASE_DIR;
            header("Location: {$protocol}{$host}{$baseDir}{$url}");
            exit;
        }
        protected function redirectBack() {
            $httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL;
            if($httpReferer != NULL) {
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
            else {
                print 'Route not found';
            }
        }
    }
    
?>
