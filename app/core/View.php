<?php
class View {
    public function __construct(protected $viewFile, protected $viewTitle, protected $viewData) {
        $this->viewFile = $viewFile;
        $this->viewData = $viewData;
        $this->viewTitle = $viewTitle;
    }
    public function render() {
        if(file_exists( VIEW . $this->viewFile . '.phtml')) {
            include VIEW . $this->viewFile . '.phtml';
        }
    }
}