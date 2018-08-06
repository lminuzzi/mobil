<?php

class FabricantesController extends controller
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
        $r = new Fabricante();
        $dados['fabricantes'] = $r->getAll();
        $this->loadTemplate('fabricantes/gerenciar', $dados);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Fabricante();
            if ($r->cadNew($_POST)) {
                $_SESSION['success'] = 'Fabricante cadastrado com sucesso.';
                header('location: '.BASE_URL.'fabricantes');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar o fabricante. Tente novamente';
            }
        }
        $t = new Tipoequipamento();
        $data['tipos_equipamentos'] = $t->getAll();
        $this->loadTemplate('fabricantes/adicionar', $data);
    }

    public function del($id)
    {
        $r = new Fabricante();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $r = new Fabricante();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($r->atualizar($_POST)) {
                $_SESSION['success'] = 'Fabricante atualizado com sucesso.';
                header('location: '.BASE_URL.'fabricantes');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar o fabricante. Tente novamente';
            }
        }
        $t = new Tipoequipamento();
        $data['fabricante'] = $r->getById($id);
        $data['tipos_equipamentos'] = $t->getAll();
        $this->loadTemplate('fabricantes/editar', $data);
    }

    public function buildComboFabricantes()
    {
        $tipo_equipamento_id = $_POST['tipo_equipamento_id'];
        $f = new Fabricante();
        $tipos_equipamentos = $f->getAllByTipoEquipamentoId($tipo_equipamento_id);
        echo json_encode($tipos_equipamentos);
    }
}
