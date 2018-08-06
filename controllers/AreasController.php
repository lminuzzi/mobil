<?php

class AreasController extends controller
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
        $r = new Area();
        $dados['areas'] = $r->getAll();
        $this->loadTemplate('areas/gerenciar', $dados);
    }

    public function adicionar()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Area();
            if ($r->cadNew($_POST)) {
                $_SESSION['success'] = 'Área cadastrada com sucesso.';
                header('location: '.BASE_URL.'areas');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar a Área. Tente novamente';
            }
        }

        $this->loadTemplate('areas/adicionar');
    }

    public function del($id)
    {
        $r = new Area();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $r = new Area();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($r->atualizar($_POST)) {
                $_SESSION['success'] = 'Área atualizada com sucesso.';
                header('location: '.BASE_URL.'areas');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar a Área. Tente novamente';
            }
        }
        $data['area'] = $r->getById($id);
        $this->loadTemplate('areas/editar', $data);
    }
}
