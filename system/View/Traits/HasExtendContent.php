<?php

    namespace System\View\Traits;

    trait HasExtendContent {
        private $extendContent;

        private function checkExtendContent() {

        }

        private function findExtend() {
            $filePathArray = [];
            preg_match("TODO", $this->content, $filePathArray);
        }
    }


?>