<?php 
    abstract class AbstractController {
        protected $model;
        protected $view;

        protected abstract function makeModel() : Model;
        protected abstract function makeView() : View;
        public abstract function start();
    }
?>