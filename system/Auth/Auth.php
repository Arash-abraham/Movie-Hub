<?php

    namespace System\Auth;

    use App\Models\User;
    use System\Session\Session; 

    // Before developing the Auth class, Session must first be developed.
    // The development of the Session class has been completed beautifully :)

    class Auth {
        private function methodCaller($method, $arguments) {
            /* 
                This method basically calls methods that have the Method extension.
                For example :
                    A method called authMethod is defined,
                    methodCaller removes the word Method and calls the method.
            */
            
        }
    }
    
?>