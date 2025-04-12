<?php
    namespace System\Traits;
    trait View {
        protected function View($dir , $var = NULL) {
            $dir = str_replace('.' , '/' , $dir);
            if($var) {
                extract($var);
            }
            $path = realpath(dirname(__FILE__).'/../../Application/View/'.$dir.'.php');
            if(file_exists($path)) {
                return require_once($path);
            }
            else {
                header('HTTP/1.1 404 Not Found');
                $error_message = 'view_not_found';
                include 'Errors/404.php';
                exit;
            }
        }
        protected function Asset($dir) {
            global $base_url;
            $path = $base_url . "Public/" . $dir;
            print $path;
        }
        protected function Include($dir , $var = NULL) {
            $dir = str_replace('.' , '/' , $dir);
            if($var) {
                extract($var);
            }
            $path = realpath(dirname(__FILE__).'/../../Application/View/'.$dir.'.php');
            if(file_exists($path)) {
                return require_once($path);
            }
            else {
                header('HTTP/1.1 404 Not Found');
                $error_message = 'view_not_found';
                include 'Errors/404.php';
                exit;
            }
        }
        protected function Url($url) {
            if($url[0] == '/') {
                $url = substr($url , 1 , strlen($url) - 1);
            }
            global $base_url;
            print $base_url . $url;
        }
    }
?>
