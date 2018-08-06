<?php

class Site extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("site");
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $site = str_replace(',', '.', $dados[parent::getFormBase()]);
        $cliente_id = str_replace(',', '.', $dados['cliente_id']);
        
        $sql = "INSERT INTO ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$site', cliente_id = $cliente_id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = 'SELECT sit.*, cli.cliente FROM '.parent::getFormBaseUpperCase().' sit INNER JOIN cliente cli ON cli.id = sit.cliente_id';
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function del($id)
    {
        if (is_numeric($id)) {
            $sql = "DELETE FROM ".parent::getFormBaseUpperCase()." WHERE id = '$id'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function getById($id)
    {
        if (is_numeric($id)) {
            $sql = "SELECT sit.*, cli.cliente FROM ".parent::getFormBaseUpperCase()." sit 
                    INNER JOIN CLIENTE cli ON cli.id = sit.cliente_id 
                    WHERE sit.id = '$id'";
            $sql = $this->db->query($sql);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getByNameExactly($name)
    {
        return parent::getByNameExactlyTemplate($name, parent::getFormBase());
    }
    public function getAllByClienteId($user_id)
    {
        if (is_numeric($user_id)) {
            $sql = "SELECT sit.*, cli.cliente 
                    FROM ".parent::getFormBaseUpperCase()." sit 
                    INNER JOIN CLIENTE cli ON cli.id = sit.cliente_id 
                    WHERE cli.id = '$user_id'";
            $sql = $this->db->query($sql);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function atualizar($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }
        $id = $dados['id'];
        $site = addslashes($dados[parent::getFormBase()]);
        $cliente_id = addslashes($dados['cliente_id']);
        $sql = "UPDATE ".parent::getFormBaseUpperCase()." SET site = '$site', cliente_id = $cliente_id WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
}
