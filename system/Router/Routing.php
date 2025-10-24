<?php

    namespace System\Router;
    use ReflectionMethod;

    class Routing {
        private $current_route;
        private $method_field;
        private $routes;
        private $values = []; 

        public function __construct() {
            $this->current_route = explode('/',CURRENT_ROUTE);
            
            $this->method_field = $this->methodField();

            global $routes;

            $this->routes = $routes;
        }
        
        public function run() {
            $match = $this->match();
            if(empty($match)) {
                // var_dump($match);
                // exit;
                $this->error404();
            }
            // var_dump($match);
            // exit;
            $classPath = str_replace('\\','/',$match['class']);
            $path = BASE_DIR . '/app/Http/Controllers/'.$classPath.'.php';

            if(!file_exists($path)) {
                $this->error404();
            }

            $class = "\App\Http\Controllers\\" . $match['class'];
            
            $object = new $class();
            
            if(method_exists($object, $match['method'])) {
                $reflection = new ReflectionMethod($object, $match['method']);
                $parameterCount = $reflection->getNumberOfParameters();
                if($parameterCount <= count($this->values)) {
                    call_user_func_array(array($object, $match['method'] ), $this->values);
                }
                else {
                    $this->error404();
                }
            }

            else {
                $this->error404();
            }
        }

        public function match() {
            $resevedRoutes = $this->routes[$this->method_field];
            foreach ($resevedRoutes as $resevedRoute) {
                if($this->compare($resevedRoute['url']) == true) {
                    return ['class' => $resevedRoute['class'] , 'method' => $resevedRoute['method']];
                }
                else {
                    $this->values = [];
                }
            }
            return [];
        }
        

        private function compare($reservedRouteUrl){

            //part1
            if(trim($reservedRouteUrl, '/') === ''){
              return trim($this->current_route[0], '/') === '' ? true : false;
            }
      
            //part2
            $reservedRouteUrlArray = explode('/', $reservedRouteUrl);
            if(sizeof($this->current_route) != sizeof($reservedRouteUrlArray)){
              return false;
            }
      
            //part3
            foreach ($this->current_route as $key => $currentRouteElement) {
              $reservedRouteUrlElement = $reservedRouteUrlArray[$key];
              if(substr($reservedRouteUrlElement, 0, 1) == "{" && substr($reservedRouteUrlElement, -1) == "}"){
                array_push($this->values, $currentRouteElement);
              }
              elseif($reservedRouteUrlElement != $currentRouteElement){
                return false;
              }
            }
            return true;
      
        }
      

        public function error404() {
            $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . DIRECTORY_SEPARATOR . 'View');
            $twig = new \Twig\Environment($loader);
            
            $data = [
                'page_title' => "Page Not Found - ".APP_TITLE,
                'error_code' => "404",
                'error_title' => "Oops! Page Not Found",
                'message' => "The page you're looking for doesn't exist or has been moved.",
                'home_url' => BASE_URL
            ];
            
            http_response_code(404);
            echo $twig->render('error.twig', $data);
            exit;
        }

        public function methodField(){

            $method_field = strtolower($_SERVER['REQUEST_METHOD']);
    
            if($method_field == 'post'){
    
                if(isset($_POST['_method'])){
    
                    if($_POST['_method'] == 'put'){
                        $method_field = 'put';
                    }
                    elseif($_POST['_method'] == 'delete'){
                        $method_field = 'delete';
                    }
                }
    
            }
            return $method_field;
    
        }
    }

?>