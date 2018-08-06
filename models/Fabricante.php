<?php

class Fabricante extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("fabricante");
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $fabricante = str_replace(',', '.', $dados[parent::getFormBase()]);
        $tipo_equipamento_id = str_replace(',', '.', $dados['tipo_equipamento_id']);
        
        $sql = "INSERT INTO ".parent::getFormBaseUpperCase()." 
                SET ".parent::getFormBase()." = '$fabricante', tipo_equipamento_id = $tipo_equipamento_id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = 'SELECT fab.*, teq.tipo_equipamento FROM '.parent::getFormBaseUpperCase().' fab 
                INNER JOIN TIPO_EQUIPAMENTO teq ON teq.id = fab.tipo_equipamento_id';
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
            $sql = "SELECT fab.*, teq.tipo_equipamento FROM ".parent::getFormBase()." fab 
                    INNER JOIN TIPO_EQUIPAMENTO teq ON teq.id = fab.tipo_equipamento_id 
                    WHERE fab.id = '$id'";
            $sql = $this->db->query($sql);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function getByNameExactly($name)
    {
        return parent::getByNameExactlyTemplate($name, parent::getFormBase());
    }
    public function getAllByTipoEquipamentoId($tipo_equipamento_id)
    {
        if (is_numeric($tipo_equipamento_id)) {
            $sql = "SELECT fab.*, teq.tipo_equipamento FROM ".parent::getFormBaseUpperCase()." fab 
                    INNER JOIN TIPO_EQUIPAMENTO teq ON teq.id = fab.tipo_equipamento_id 
                    WHERE teq.id = '$tipo_equipamento_id'";
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
        $fabricante = addslashes($dados[parent::getFormBase()]);
        $tipo_equipamento_id = addslashes($dados['tipo_equipamento_id']);
        $sql = "UPDATE ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$fabricante', tipo_equipamento_id = $tipo_equipamento_id WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
}
