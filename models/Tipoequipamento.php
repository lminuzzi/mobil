<?php

class Tipoequipamento extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("tipo_equipamento");
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $tipo_equipamento = str_replace(',', '.', $dados[parent::getFormBase()]);
        $area_id = str_replace(',', '.', $dados['area_id']);
        
        $sql = "INSERT INTO ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$tipo_equipamento', area_id = $area_id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = 'SELECT teq.*, are.area FROM '.parent::getFormBaseUpperCase().' teq 
                INNER JOIN area are ON are.id = teq.area_id';
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
            $sql = "SELECT teq.*, are.area FROM ".parent::getFormBaseUpperCase()." teq 
                    INNER JOIN area are ON are.id = teq.area_id 
                    WHERE teq.id = '$id'";
            $sql = $this->db->query($sql);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getByNameExactly($name)
    {
        return parent::getByNameExactlyTemplate($name, parent::getFormBase());
    }
    public function getAllByAreaId($area_id)
    {
        if (is_numeric($area_id)) {
            $sql = "SELECT teq.*, are.area FROM ".parent::getFormBaseUpperCase()." teq 
                    INNER JOIN AREA are ON are.id = teq.area_id 
                    WHERE are.id = '$area_id'";
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
        $tipo_equipamento = addslashes($dados[parent::getFormBase()]);
        $area_id = addslashes($dados['area_id']);
        $sql = "UPDATE ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$tipo_equipamento', area_id = $area_id WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
}
