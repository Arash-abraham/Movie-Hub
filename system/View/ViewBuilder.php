<?php

    namespace System\View;

    use App\Providers\AppServiceProvider;
    use System\View\Traits\HasViewLoader;
    use System\View\Traits\HasExtendContent;
    use System\View\Traits\HasIncludeContent;
    use Exception;

    class ViewBuilder {
        use HasViewLoader , HasExtendContent , HasIncludeContent;

        public $content;
        public $vars = [];
        public function run($dir) {
            $this->content = $this->viewLoader($dir);
            $this->checkExtendContent();
            $this->checkIncludeContent();
            Composer::setViews($this->viewNameArray);
            $appServiceProvider = new AppServiceProvider();
            $appServiceProvider->boot();
            $this->vars = Composer::getVars();
        }
    }

?>