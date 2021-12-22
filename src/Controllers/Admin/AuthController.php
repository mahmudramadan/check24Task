<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function __construct()
    {
    }

    public function index(array $params = [])
    {
        if (isset($_SESSION['isLogged'])) {
            header('Location: ');
        }
        $data = ['title' => "Login page"];
        $this->view("admin/login/index", $data);
    }

    public function loginUser()
    {
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            echo json_encode(['success' => false, 'message' => "email and password is required"]);
            die;
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userData = UserModel::getUserActiveData($email);
        if (empty($userData) || $userData == null) {
            echo json_encode(['success' => false, 'message' => "email or password is incorrect11"]);
        } else if (password_verify($password, $userData->password)) {
            $_SESSION['isLogged'] = true;
            $_SESSION['userLoggedName'] = $userData->name;
            $_SESSION['userLoggedEmail'] = $userData->email;
            $_SESSION['userLoggedId'] = $userData->id;
            echo json_encode(['success' => true, 'message' => "Login successful", "ESSION" => $_SESSION]);
        } else {
            echo json_encode(['success' => false, 'message' => "email or password is incorrect"]);
        }
    }

    public function logoutUser()
    {
        session_destroy();
        header('Location: /');
    }
}