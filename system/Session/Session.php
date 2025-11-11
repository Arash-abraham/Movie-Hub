<?php 

    namespace System\Session;

    class Session {
        public function set($session_name , $session_value) {
            $_SESSION[$session_name] = $session_value;
        }

        public function get($session_name) {
            if (isset($_SESSION[$session_name])) {
                return $_SESSION[$session_name];
            }
            return false;
        }

        public function remove() {

        }

        public static function __callStatic($name, $arguments) {

        }
    }

?>