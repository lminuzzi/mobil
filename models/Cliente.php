<?php

class Cliente extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("cliente");
    }
    public function getFormBaseUpperCase()
    {
        return strtoupper(parent::getFormBase());
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $cliente = str_replace(',', '.', $dados['cliente']);
        
        $sql = "INSERT INTO " . parent::getFormBaseUpperCase() . " SET cliente = '$cliente'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = "SELECT * FROM " . parent::getFormBaseUpperCase();
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function del($id)
    {
        if (is_numeric($id)) {
            $sql = "DELETE FROM " . parent::getFormBaseUpperCase() . " WHERE id = '$id'";
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
            $sql = "SELECT * FROM " . parent::getFormBaseUpperCase() . " WHERE id = '$id'";
            $sql = $this->db->query($sql);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getByNameExactly($name)
    {
        return parent::getByNameExactlyTemplate($name, parent::getFormBase());
    }
    public function atualizar($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }
        $id = $dados['id'];
        $cliente = addslashes($dados['cliente']);
        $sql = "UPDATE " . parent::getFormBaseUpperCase() . " SET cliente = '$cliente' WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
}