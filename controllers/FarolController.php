<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 14/10/2017
 * Time: 14:08
 */
class FarolController extends controller
{
    public function index()
    {
        $dados = array();
        $f = new Farol();
        $dados['farois'] = $f->getAllFarois();
        $dados['farois_realizados'] = $f->getAllFaroisRealizados();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['titulo'])) {
            //$equipamento = $_GET['eqp'];
            $titulo = $_GET['titulo'];
            $modelo_id = $_GET['modelo_id'];
            $site_id = $_GET['site_id'];
            $reservatorio_id = $_GET['reservatorio_id'];
            $itens = $_GET['itens'];
            $f = new Farol();
            //$f->cadastraFarol($titulo, $equipamento, $itens, $modelo_id, $site_id);
            $f->cadastraFarol($titulo, $itens, $modelo_id, $site_id, $reservatorio_id);
        }

        $c = new Cliente();
        $dados['clientes'] = $c->getAll();
        $a = new Area();
        $dados['areas'] = $a->getAll();
        $this->loadTemplate('farol/index', $dados);
    }

    public function exibir($id)
    {
        $f = new Farol();
        $dados['farois'] = $f->getAllFarolItens($id);
        $this->loadTemplate('farol/farol_itens', $dados);
    }

    public function get($id, $reservatorio)
    {
        $f = new Farol();
        $dados['farolid'] = $id;
        $dados['items'] = $f->getAllFarolItens($id);
        $dados['reservatorio'] = $reservatorio;

        $this->loadView('farol/farolget', $dados);
    }
    public function post($farol, $reservatorio)
    {
        $f = new Farol();
        $id_resultado = $f->cadastrarResultado($farol, $reservatorio);
        foreach ($_POST['data'] as $data) {
            $f->cadastrarResultadoItens($id_resultado, $data['item'], $data['situacao'], $data['motivo']);
        }
    }
}
