<?php
class AdminController extends Controller
{
    public function index($error = "")
    {
        $this->view('Admin/index', "Travigo Login", ['error' => $error]);
        $this->view->render();
    }
    public function Login()
    {
        if (isset($_POST['submit']) && !isset($_SESSION['admin'])) {
            $adminName = $this->Validate($_POST['admin_name']);
            $adminPassword = $this->Validate($_POST['password']);
            if (empty($adminName) || empty($adminPassword)) {
                $this->index("Admin name or password is empty!");
                return;
            }
            $this->model('Admin');
            if (!$this->model->getAdmin($adminName)) {
                $this->index("Incorrect admin name !");
                return;
            }
            if (!($this->model->getAdmin($adminName)['password'] == $adminPassword)) {
                $this->index("Incorrect password !");
                return;
            }
            $_SESSION['admin'] = true;
        }
    }
    public function Logout()
    {

    }
    public function Travels()
    {

    }
    public function Create()
    {

    }
    public function Edit()
    {

    }
    public function Delete()
    {

    }
    public function Validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}