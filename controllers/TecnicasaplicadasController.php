<?php

class TecnicasaplicadasController extends controller
{
    const FOLDER_BASE = "tecnicasaplicadas";

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
        $model = new Tecnicaaplicada();
        $dados['objs'] = $model->getAll();
        $this->loadTemplate(self::FOLDER_BASE.'/gerenciar', $dados);
    }

    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new Tecnicaaplicada();
            if ($model->cadNew($_POST)) {
                $_SESSION['success'] = 'Registro cadastrado com sucesso.';
                header('location: '.BASE_URL.self::FOLDER_BASE);
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao cadastrar o registro. Tente novamente';
            }
        }

        $this->loadTemplate(self::FOLDER_BASE.'/adicionar');
    }

    public function del($id)
    {
        $modelo = new Tecnicaaplicada();
        if ($modelo->del($id)) {
            $data['data'] = array('Deleted' => true);
        } else {
            $data['data'] = array('Deleted' => false);
        }
        echo json_encode($data);
    }

    public function edit($id)
    {
        $modelo = new Tecnicaaplicada();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($modelo->atualizar($_POST)) {
                $_SESSION['success'] = 'Registro atualizado com sucesso.';
                header('location: '.BASE_URL.self::FOLDER_BASE);
                exit;
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao atualizar a Área. Tente novamente';
            }
        }
        $data['obj'] = $modelo->getById($id);
        $this->loadTemplate(self::FOLDER_BASE.'/editar', $data);
    }
}