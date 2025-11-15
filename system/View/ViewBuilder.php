<?php

    namespace System\View;

    use System\View\Traits\HasViewLoader;
    
    class ViewBuilder {
        use HasViewLoader;

        public $content;

        public function run($dir) {
            $this->content = $this->viewLoader($dir);
        }
    }

    // $app = new ViewBuilder();
    // $app->run('app');
    // print_r($app);

?>