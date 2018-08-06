<?php

class ClientesController extends controller
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
        $r = new Cliente();
        $dados['clientes'] = $r->getAll();
        $this->loadTemplate('clientes/gerenciar', $dados);
    }

    public function adicionar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Cliente();
            if ($r->cadNew($_POST)) {
                $_SESSION['success'] = 'Cliente cadastrada com sucesso.';
                header('location: '.BASE_URL.'clientes');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar o cliente. Tente novamente';
            }
        }

        $this->loadTemplate('clientes/adicionar');
    }

    public function del($id)
    {
        $r = new Cliente();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $r = new Cliente();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($r->atualizar($_POST)) {
                $_SESSION['success'] = 'Cliente atualizado com sucesso.';
                header('location: '.BASE_URL.'clientes');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar o cliente. Tente novamente';
            }
        }
        $data['cliente'] = $r->getById($id);
        $this->loadTemplate('clientes/editar', $data);
    }
}
