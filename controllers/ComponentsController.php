<?php

class ComponentesController extends controller
{
    public function __construct()
    {
        /*
        $u = new User();
        if (!$u->isLoggedIn()) {
            header('location: '.BASE_URL.'/login?noAccess');
            exit;
        }
        */
    }
    public function hierarchy()
    {
        var_dump('aqui');exit;
        $this->loadTemplate('components/hierarchy');
    }
}
