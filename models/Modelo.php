<?php

class Modelo extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("modelo");
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $modelo = str_replace(',', '.', $dados[parent::getFormBase()]);
        $fabricante_id = str_replace(',', '.', $dados['fabricante_id']);
        
        $sql = "INSERT INTO ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$modelo', fabricante_id = $fabricante_id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = 'SELECT modelo.*, fab.fabricante FROM '.parent::getFormBaseUpperCase().' modelo 
                INNER JOIN FABRICANTE fab ON fab.id = modelo.fabricante_id';
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
            $sql = "SELECT modelo.*, fab.fabricante FROM ".parent::getFormBaseUpperCase()." modelo 
                    INNER JOIN FABRICANTE fab ON fab.id = modelo.fabricante_id 
                    WHERE modelo.id = '$id'";
            $sql = $this->db->query($sql);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getByNameExactly($name)
    {
        return parent::getByNameExactlyTemplate($name, parent::getFormBase());
    }
    public function getAllByFabricanteId($fabricante_id)
    {
        if (is_numeric($fabricante_id)) {
            $sql = "SELECT modelo.*, fab.fabricante FROM ".parent::getFormBaseUpperCase()." modelo 
                    INNER JOIN FABRICANTE fab ON fab.id = modelo.fabricante_id 
                    WHERE modelo.fabricante_id = '$fabricante_id'";
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
        $modelo = addslashes($dados[parent::getFormBase()]);
        $fabricante_id = addslashes($dados['fabricante_id']);
        $sql = "UPDATE ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$modelo', fabricante_id = $fabricante_id WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
}