<?php

class Model
{
    protected $db;
    private $form_base;

    public function __construct($form_base = null)
    {
        global $db;
        $this->db = $db;
        $this->form_base = $form_base;
    }

    public function setFormBase($form_base)
    {
        $this->form_base = $form_base;
    }

    public function getFormBase()
    {
        return $this->form_base;
    }

    public function getFormBaseUpperCase()
    {
        return strtoupper($this->getFormBase());
    }

    public function getByNameExactlyTemplate($name)
    {
        $sql = "SELECT * FROM $this->getFormBaseUpperCase() WHERE $form_base = '$name'";
        $sql = $this->db->query($sql);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}