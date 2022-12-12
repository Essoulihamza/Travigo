<?php
class PageController extends Controller
{
    public function index()
    {
        $this->view('Pages/index', "Travigo Home");
        $this->view->render();
    }
    public function travels()
    {
        $this->model('Travel');
        $this->view('Pages/travels', "Travigo Travels", ['travels' => $this->model->Display()]);
        $this->view->render();
    }
    public function about()
    {
        $this->view('Pages/about', "Travigo About");
        $this->view->render();
    }
    public function contact()
    {
        $this->view('Pages/contact', "Travigo Contact");
        $this->view->render();
    }
}