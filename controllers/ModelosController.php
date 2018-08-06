<?php

class ModelosController extends controller
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
        $r = new Modelo();
        $dados['modelos'] = $r->getAll();
        $this->loadTemplate('modelos/gerenciar', $dados);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Modelo();
            if ($r->cadNew($_POST)) {
                $_SESSION['success'] = 'Modelo cadastrado com sucesso.';
                header('location: '.BASE_URL.'modelos');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar o Modelo. Tente novamente';
            }
        }
        $f = new Fabricante();
        $data['fabricantes'] = $f->getAll();
        $this->loadTemplate('modelos/adicionar', $data);
    }

    public function del($id)
    {
        $r = new Modelo();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $r = new Modelo();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($r->atualizar($_POST)) {
                $_SESSION['success'] = 'Modelo atualizado com sucesso.';
                header('location: '.BASE_URL.'modelos');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar o Modelo. Tente novamente';
            }
        }
        $f = new Fabricante();
        $data['modelo'] = $r->getById($id);
        $data['fabricantes'] = $f->getAll();
        $this->loadTemplate('modelos/editar', $data);
    }

    public function buildComboModelos()
    {
        $fabricante_id = $_POST['fabricante_id'];
        $m = new Modelo();
        $modelos = $m->getAllByFabricanteId($fabricante_id);
        echo json_encode($modelos);
    }
}
