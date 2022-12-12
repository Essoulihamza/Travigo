<?php
class Controller {
    protected $view;
    protected $model;
    
    public function view($viewName, $viewTitle ,$data = []) {
        $this->view = new View($viewName, $viewTitle, $data);
        return $this->view;
    }
    public function model($modelName, $data = []){
        if(file_exists( MODEL . $modelName . '.php')) {
            $this->model = new $modelName;
        }
    }
    
}