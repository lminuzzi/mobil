<?php

class UsuariosController extends controller
{

    public function __construct()
    {
        $u = new User();
        if (!$u->isLoggedIn()) {
            header('location: '.BASE_URL.'/login?noAccess');
            exit;
        }
    }
    public function index()
    {
        $u = new User();
        $dados['users'] = $u->getAll();
        $this->loadTemplate('usuarios/gerenciar', $dados);
    }

    public function adicionar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $u = new User();
            if ($u->cadUser($_POST)) {
                $_SESSION['success'] = 'Usuário cadastrado com sucesso.';
            } else {
                $_SESSION['error'] = 'Falha ao cadastrar usuário. Tente novamente.';
            }
        }
        $this->loadTemplate('usuarios/adicionar');
    }
    public function del($id)
    {
        $r = new User();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function senha()
    {
        $u = new User();
        $u->updatePassword($_GET['id'], $_GET['senha']);
        return true;
    }
}
