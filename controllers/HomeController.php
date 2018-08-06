<?php
class HomeController extends controller
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
        $u = new User();
        $r = new Reservatorio();
        $f = new Farol();
        $dados['farois'] = $f->getAllFarois();
        $dados['reservatorios'] = $r->getAll();

        $this->loadTemplate('index', $dados);
    }
    public function lista()
    {
        $u = new User();
        $r = new Reservatorio();
        $dados['reservatorios'] = $r->getAll();
        $this->loadTemplate('index_lista', $dados);
    }

    public function cadastros()
    {
        $this->loadTemplate('cadastros');
    }
}
