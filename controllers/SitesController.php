<?php

class SitesController extends controller
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
        $r = new Site();
        $dados['sites'] = $r->getAll();
        $this->loadTemplate('sites/gerenciar', $dados);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Site();
            if ($r->cadNew($_POST)) {
                $_SESSION['success'] = 'site cadastrado com sucesso.';
                header('location: '.BASE_URL.'sites');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar o site. Tente novamente';
            }
        }
        $c = new Cliente();
        $data['clientes'] = $c->getAll();
        $this->loadTemplate('sites/adicionar', $data);
    }

    public function del($id)
    {
        $r = new Site();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $r = new Site();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($r->atualizar($_POST)) {
                $_SESSION['success'] = 'site atualizado com sucesso.';
                header('location: '.BASE_URL.'sites');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar o site. Tente novamente';
            }
        }
        $c = new Cliente();
        $data['site'] = $r->getById($id);
        $data['clientes'] = $c->getAll();
        $this->loadTemplate('sites/editar', $data);
    }

    public function buildComboSites()
    {
        $cliente_id = $_POST['cliente_id'];
        $s = new Site();
        $sites = $s->getAllByClienteId($cliente_id);
        echo json_encode($sites);
    }
}
