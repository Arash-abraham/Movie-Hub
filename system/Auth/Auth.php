<?php

    namespace System\Auth;

    use App\Models\User;
    use System\Session\Session; 

    // Before developing the Auth class, Session must first be developed.
    // The development of the Session class has been completed beautifully :)

    class Auth {

        private $redirectTo = '/login';

        private function userMethod() {
            if(Session::get('user')) {
                return redirect($this->redirectTo);
            }
            $user = User::find(Session::get('user'));
            if(empty($user)){
                Session::remove('user');
                return redirect($this->redirectTo);
            }
            return $user;
        }



        public function __call($name , $arguments) {
            return $this->methodCaller($name , $arguments);
        }

        public static function __callStatic($name, $arguments) {
            $instance = new self();
            return $instance->methodCaller($name, $arguments);
        }

        private function methodCaller($method , $arguments) {
            /* 
                This method basically calls methods that have the Method extension.
                For example :
                    A method called authMethod is defined,
                    methodCaller removes the word Method and calls the method.
            */
            $suffix = 'Method';
            $methodName = $method . $suffix;
            
            if (!method_exists($this, $methodName)) {
                throw new \BadMethodCallException("Method {$method} does not exist in Auth class");
            }
            
            return call_user_func_array([$this, $methodName], $arguments);
        }

    }
    
?>