<?php

class Tiporeservatorio extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("tipo_reservatorio");
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $campoFormBase = str_replace(',', '.', $dados[parent::getFormBase()]);
        $volume_morto = str_replace(",", ".", addslashes($dados['volume_morto']));
        $area_base = addslashes($dados['area_base']);
        
        $sql = "INSERT INTO ".parent::getFormBaseUpperCase()." 
            SET ".parent::getFormBase()." = '$campoFormBase', volume_morto = $volume_morto, 
            area_base = '$area_base'";
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
        $volume_morto = str_replace(",", ".", addslashes($dados['volume_morto']));
        $area_base = addslashes($dados['area_base']);
        $sql = "UPDATE ".parent::getFormBaseUpperCase()." SET ".parent::getFormBase()." = '$campoFormBase', 
            volume_morto = $volume_morto, area_base = '$area_base' WHERE id = $id";
        var_dump($sql);
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
}