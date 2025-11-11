<?php 

    namespace System\Session;

    class Session {
        public function set($session_name , $session_value) {
            $_SESSION[$session_name] = $session_value;
        }

        public function get($session_name) {
            if(isset($_SESSION[$session_name])) {
                return $_SESSION[$session_name];
            }
            return false;
        }

        public function remove($session_name) {
            if(isset($_SESSION[$session_name])) {
                unset($_SESSION[$session_name]);
            }
            return false;
        }

        public static function __callStatic($name, $arguments) {
            // The reason for using __callStatic is to allow us to use Session methods statically.
            $instance = new self();
            return call_user_func_array(array($instance, $name), $arguments);
        }
    }

?>