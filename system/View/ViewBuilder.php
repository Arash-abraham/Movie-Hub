<?php

    namespace System\View;

    use System\View\Traits\HasViewLoader;
    use System\View\Traits\HasExtendContent;
    

    class ViewBuilder {
        use HasViewLoader , HasExtendContent;

        public $content;

        public function run($dir) {
            $this->content = $this->viewLoader($dir);
            $this->checkExtendContent();
        }
        
    }

?>