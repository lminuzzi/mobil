<?php

class TiposequipamentosController extends controller
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
        $r = new Tipoequipamento();
        $dados['tipos_equipamentos'] = $r->getAll();
        $this->loadTemplate('tiposequipamentos/gerenciar', $dados);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Tipoequipamento();
            if ($r->cadNew($_POST)) {
                $_SESSION['success'] = 'Tipo de equipamento cadastrado com sucesso.';
                header('location: '.BASE_URL.'tiposequipamentos');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar o tipo de equipamento. Tente novamente';
            }
        }
        $a = new Area();
        $data['areas'] = $a->getAll();
        $this->loadTemplate('tiposequipamentos/adicionar', $data);
    }

    public function del($id)
    {
        $r = new Tipoequipamento();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $r = new Tipoequipamento();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($r->atualizar($_POST)) {
                $_SESSION['success'] = 'Tipo de equipamento atualizado com sucesso.';
                header('location: '.BASE_URL.'tiposequipamentos');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar o tipo de equipamento. Tente novamente';
            }
        }
        $a = new Area();
        $data['tipo_equipamento'] = $r->getById($id);
        $data['areas'] = $a->getAll();
        $this->loadTemplate('tiposequipamentos/editar', $data);
    }

    public function buildComboTiposEquipamentos()
    {
        $area_id = $_POST['area_id'];
        $t = new Tipoequipamento();
        $tiposequipamentos = $t->getAllByAreaId($area_id);
        echo json_encode($tiposequipamentos);
    }
}
