<?php
class LoginController extends controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = isset($_POST['username']) ? addslashes($_POST['username']) : '';
            $password = isset($_POST['password']) ? md5(addslashes($_POST['password'])) : '';

            $u = new User();
            if ($u->auth($username, $password)) {
                header('location: '.BASE_URL);
            } else {
                header('location: '.BASE_URL.'/login?tryAgain');
            }
        } else {
            $this->loadview('login');
        }
    }
    public function logout()
    {
        $_SESSION['uid'] = null;
        unset($_SESSION['uid']);
        $_SESSION['erro'] = 'Você foi desconectado.';
        header('location: '.BASE_URL);
    }
}
