<?php
class AdminController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function index($mode = "", $message = "")
    {
        if (isset($_SESSION['admin'])) {
            header("location: http://travigo.com/Admin/Dashboard");
            exit();
        }
        if (empty($mode)) {
            $this->view('Admin/index', "Travigo Login", ['error' => $message]);
            $this->view->render();
        } else {
            if (isset($_POST['submit'])) {
                $adminName = $this->Validate($_POST['admin_name']);
                $adminPassword = $this->Validate($_POST['password']);
                if (empty($adminName) || empty($adminPassword)) {
                    $this->index("", "Empty admin name or password");
                    return;
                }
                $this->model('Admin');
                if (!$this->model->getAdmin($adminName)) {
                    $this->index("", "Incorrect Admin name !");
                    return;
                }
                if (!($this->model->getAdmin($adminName)['password'] == $adminPassword)) {
                    $this->index("", "Incorrect password !");
                    return;
                }
                if ($this->model->getAdmin($adminName)['name'] == $adminName && $this->model->getAdmin($adminName)['password'] == $adminPassword) {
                    $_SESSION['admin'] = $adminName;
                    header("Location: http://travigo.com/Admin/Dashboard/");
                    exit();
                }
            }
            header("Location: http://travigo.com/Admin/");
        }
    }
    public function LogOut()
    {
        session_unset();
        header("Location: http://travigo.com/Admin/");
    }
    public function Dashboard()
    {
        if (!isset($_SESSION['admin'])) {
            header("location: http://travigo.com/Admin");
            exit();
        }
        $this->model('Travel');
        $this->view('Admin/Dashboard', "Travigo Dashboard", ['travels' => $this->model->Display()]);
        $this->view->render();
    }
    public function Create($mode = "", $message = "")
    {
        if (!isset($_SESSION['admin'])) {
            header("location: http://travigo.com/Admin");
            exit();
        }

        if (empty($mode)) {
            $this->view('Admin/Create', "Create Travel", ['message' => $message]);
            $this->view->render();
        } else {
            if (isset($_POST['submit'])) {
                $destination = $this->Validate($_POST['destination']);
                $image = $this->Validate($_FILES['image']['name']);
            }
            if (empty($destination)) {
                $this->Create("", "Please Write a destination.");
                return;
            }
            if (empty($image)) {
                $this->Create("", "Make sure that you added an image.");
                return;
            }
            $this->model('Travel');
            $this->model->Create($destination, $image);
            header("Location: http://travigo.com/Admin/Dashboard/");
        }
    }
    public function Edit($id, $mode = "", $message = "")
    {
        if (!isset($_SESSION['admin'])) {
            header("location: http://travigo.com/Admin");
            return;
        }
        $this->model('Travel');
        if (empty($mode)) {
            $this->view('Admin/Edit', "Edit Travel", ['message' => $message, 'travel' => $this->model->Display($id)]);
            $this->view->render();
        } else {
            if (isset($_POST['submit'])) {
                $destination = $this->Validate($_POST['destination']);
                $image = $this->Validate($_FILES['image']['name']);
            }
            if (empty($destination)) {
                $this->Edit($id, "", "Please Write a destination.");
                return;
            }
            if (empty($image)) {
                $this->model->Edit($id, $destination, $image, "Without image");
                header("Location: http://travigo.com/Admin/Dashboard");
                return;
            }
            $this->model->Edit($id, $destination, $image);
            header("Location: http://travigo.com/Admin/Dashboard");
        }
    }
    public function Delete($id)
    {
        $this->model('Travel');
        $this->model->Delete($id);
        header("Location: http://travigo.com/Admin/Dashboard/");
    }
    public function Validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}