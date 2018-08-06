<?php class HorimetrosController extends controller
{


    public function __construct()
    {
        $u = new User();
        if (!$u->isLoggedIn()) {
            header('location: '.BASE_URL.'/login?noAccess');
            exit;
        }
    }
    public function atualizar()
    {
        $dados = array();
        $r = new Reservatorio();
        $dados['reservatorios'] = $r->getAll();
        $this->loadTemplate('horimetros/atualizar', $dados);
    }
    public function index()
    {
        echo 'teste';
    }
    public function att_horimetros()
    {
        $id = $_GET['id'];
        $horimetro = $_GET['horimetro'];
        $horimetro_anterior = $_GET['horimetro_anterior'];
        $h = new Horimetros();
        if (is_numeric($id) && is_numeric($horimetro) && is_numeric($horimetro_anterior)) {
            $h->atualizarHorimetro($id, $horimetro, $horimetro_anterior);
        }
    }
}
