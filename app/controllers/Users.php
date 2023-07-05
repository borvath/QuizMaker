<?php
class Users {

    private User $userModel;

    public function __construct() {
        require_once '../../models/User.php';
        $this->userModel = new User();
    }
    public function UserLoggedIn() : void {
        if (Auth::isLoggedIn())
            header('Location: ../pages/main.php');
        else
            header('Location: ../users/login.php');
        exit;
    }
    public function Signup() : void {
        if (Auth::isLoggedIn()) {
            $_SESSION['message'] = 'You are already logged in';
            header('Location: ../pages/main.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

            $data = [
                'username'           => trim($_POST['username']),
                'password'           => trim($_POST['password']),
                'usernameErr'        => Validation::ValidateUsername(trim($_POST['username']), $this->userModel),
                'passwordErr'        => Validation::ValidatePassword(trim($_POST['password']), trim($_POST['username'])),
                'confirmPasswordErr' => Validation::ValidatePasswordMatch(trim($_POST['password']), trim($_POST['confirmPassword']))
            ];

            if (empty($data['username_err']) && empty($data['password_err']) && empty($data['confirmPassword_err'])) {
                if(!$this->userModel->FindUsername($data['username'])) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    $signup = $this->userModel->Signup($data['username'], $data['password']);
                    if ($signup) {
                        Auth::Login($signup);
                        header('Location: ../pages/main.php');
                        exit;
                    }
                    else die('Something went wrong');
                }
            }
            header('Location: ../users/signup.php?'.
            'usernameErr='.$data['usernameErr'].'&passwordErr='.$data['passwordErr'].'&confirmPasswordErr='.$data['confirmPasswordErr']);
            exit;
        }
    }
    public function Login() : void {
        if (Auth::IsLoggedIn()) {
            $_SESSION['message'] = 'You are already logged in';
            header('Location: ../pages/main.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

            $data = [
                'username'    => trim($_POST['username']),
                'password'    => trim($_POST['password']),
                'usernameErr' => '',
                'passwordErr' => ''
            ];
            if (Validation::IsBlank($data['username']))
                $data['usernameErr'] = 'Please enter username';
            if (Validation::IsBlank($data['password']))
                $data['passwordErr'] = 'Please enter password';
            if (!$this->userModel->FindUsername($data['username']))
                $data['usernameErr'] = 'Invalid username';

            if (empty($data['usernameErr']) && empty($data['passwordErr'])) {
                $login = $this->userModel->Login($data['username'], $data['password']);
                if($login) {
                    Auth::Login($login);
                    header('Location: ../pages/main.php');
                    exit;
                }
                else
                    $data['passwordErr'] = 'Incorrect Password';
            }
            header('Location: ../users/login.php?'.
            'usernameErr='.$data['usernameErr'].'&passwordErr='.$data['passwordErr']);
            exit;
        }
    }
    public function Logout() : void {
        Auth::LogOut();
        header('Location: ../users/login.php');
        exit;
    }
}