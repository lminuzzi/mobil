<?php

class ReservatoriosController extends controller
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
        $r = new Reservatorio();
        $dados['reservatorios'] = $r->getAll();
        $this->loadTemplate('reservatorios/gerenciar', $dados);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Reservatorio();
            if ($r->cadNew($_POST)) {
                $_SESSION['success'] = 'Reservatório cadastrado com sucesso.';
                header('location: '.BASE_URL.'reservatorios');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar o Reservatório. Tente novamente';
            }
        }
        $modelTR = new Tiporeservatorio();
        $data['tipos_reservatorios'] = $modelTR->getAll();
        $this->loadTemplate('reservatorios/adicionar', $data);
    }

    public function del($id)
    {
        $r = new reservatorio();
        if ($r->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $r = new Reservatorio();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($r->atualizar($_POST)) {
                $_SESSION['success'] = 'Reservatório atualizado com sucesso.';
                header('location: '.BASE_URL.'reservatorios');
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar o Reservatório. Tente novamente';
            }
        }
        $data['historico'] = $r->getHistorico($id);
        $data['reservatorio'] = $r->getById($id);
        $modelTR = new Tiporeservatorio();
        $data['tipos_reservatorios'] = $modelTR->getAll();
        $this->loadTemplate('reservatorios/editar', $data);
    }

    public function refil($id = null)
    {
        $r = new Reservatorio();
        $dados['reservatorios'] = $r->getAll();
        $this->loadTemplate('reservatorios/refil', $dados);
    }
    public function att_refil()
    {
        $id = $_GET['id'];
        $horimetro = $_GET['horimetro'];
        $horimetro_a = $_GET['horimetro_a'];
        $graxa_add = $_GET['kg'];
        $r = new Reservatorio();
        $h = new Horimetros();
        $horimetro_abastecimento = $r->getHorimetroAbastecimento($id);
        $h->abastecer($id, $horimetro);

        $r->Refil($id, $horimetro, $horimetro_a, $horimetro_abastecimento, $graxa_add);
        var_dump($_GET);
    }
    public function historico($id = null)
    {
        echo 'historico';
    }

    public function getConsumo($id)
    {
        $id = addslashes($id);
    }

    public function buildComboEquipamentos()
    {
        $modelo_id = $_POST['modelo_id'];
        $r = new Reservatorio();
        $equipamentos = $r->getAllByModeloId($modelo_id);
        echo json_encode($equipamentos);
    }

    public function searchAutocomplete()
    {
        $tag = $_GET['term'];
        $r = new Reservatorio();
        $tags = $r->getAllByTag($tag);
        echo json_encode($tags);
    }
}
