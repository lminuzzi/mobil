<?php

class Tipodesvio extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("tipo_desvio");
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $campoFormBase = str_replace(',', '.', $dados[parent::getFormBase()]);
        
        $sql = "INSERT INTO ".parent::getFormBaseUpperCase()." 
            SET ".parent::getFormBase()." = '$campoFormBase'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = 'SELECT * FROM '.parent::getFormBaseUpperCase();
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
            $sql = "SELECT * FROM ".parent::getFormBaseUpperCase()." WHERE id = '$id'";
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
        $campoFormBase = addslashes($dados[parent::getFormBase()]);
        $sql = "UPDATE ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$campoFormBase' WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
}