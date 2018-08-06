<?php

class Reservatorio extends Model
{
    function __construct() {
        parent::__construct();
        parent::setFormBase("reservatorios");
    }
    public function cadNew($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }

        $consumo = str_replace(',', '.', $dados['consumo']);
        $titulo = addslashes($dados['titulo']);
        //$capacidade = addslashes($dados['capacidade']);
        //$horimetro = addslashes($dados['horimetro']);
        //$horimetro_abastecimento = addslashes($dados['horimetro_abastecimento']);
        //$autonomia = addslashes($dados['autonomia']);
        $modelo_id = addslashes($dados['modelo_id']);
        $site_id = addslashes($dados['site_id']);
        $tipo_reservatorio_id = addslashes($dados['tipo_reservatorio_id']);
        $user = $_SESSION['uid'];
        /*
        if(!isset($autonomia) || $autonomia != "") {
            $autonomia = $capacidade/$consumo;
        }
        */
        if (!empty($_FILES['foto'])){
            $upload = new UploadController($_FILES['foto'], 150, 150, "$titulo/");
            $avatar = $upload->salvar();
        }

        $sql = "INSERT INTO ".parent::getFormBaseUpperCase()." SET titulo = '$titulo', 
                site_id = $site_id, modelo_id = $modelo_id, tipo_reservatorio_id = $tipo_reservatorio_id, 
                user = $user";
        if(isset($avatar)) {
            $sql .= ", avatar = '$avatar'";
        }
        /*
        if(isset($autonomia) && $autonomia != "")
        {            
            $sql .= ", autonomia = $autonomia";
        }
        */
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = "SELECT res.*, sit.site, modelo.modelo, tir.tipo_reservatorio 
                FROM ".parent::getFormBaseUpperCase()." res
                INNER JOIN SITE sit ON sit.id = res.site_id 
                INNER JOIN MODELO modelo ON modelo.id = res.modelo_id 
                INNER JOIN TIPO_RESERVATORIO tir ON tir.id = res.tipo_reservatorio_id ";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllByModeloId($modelo_id)
    {
        if (is_numeric($modelo_id)) {
            $sql = "SELECT res.*, sit.cliente_id,
                        hierarchy.fabricante_id,
                        hierarchy.tipo_equipamento_id, hierarchy.area_id 
                    FROM ".parent::getFormBaseUpperCase()." res
                    INNER JOIN SITE sit ON sit.id = res.site_id 
                    INNER JOIN (
                        SELECT modelo.id AS modelo_id, modelo.fabricante_id, 
                            fab.tipo_equipamento_id, teq.area_id 
                        FROM MODELO modelo 
                        INNER JOIN FABRICANTE fab ON fab.id = modelo.fabricante_id
                        INNER JOIN TIPO_EQUIPAMENTO teq ON teq.id = fab.tipo_equipamento_id
                    ) hierarchy ON hierarchy.modelo_id = res.modelo_id
                    WHERE res.modelo_id = '$modelo_id'";
            $sql = $this->db->query($sql);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function getAllByTag($tag)
    {
        $sql = "SELECT res.*, sit.cliente_id,
                    hierarchy.fabricante_id,
                    hierarchy.tipo_equipamento_id, hierarchy.area_id 
                FROM ".parent::getFormBaseUpperCase()." res
                INNER JOIN SITE sit ON sit.id = res.site_id 
                INNER JOIN (
                    SELECT modelo.id AS modelo_id, modelo.fabricante_id, 
                        fab.tipo_equipamento_id, teq.area_id 
                    FROM MODELO modelo 
                    INNER JOIN FABRICANTE fab ON fab.id = modelo.fabricante_id
                    INNER JOIN TIPO_EQUIPAMENTO teq ON teq.id = fab.tipo_equipamento_id
                ) hierarchy ON hierarchy.modelo_id = res.modelo_id
                WHERE res.titulo LIKE '%$tag%'";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByNameExactly($name)
    {
        $sql = "SELECT * FROM ".parent::getFormBaseUpperCase()." WHERE titulo = '$name'";
        $sql = $this->db->query($sql);
        return $sql->fetch(PDO::FETCH_ASSOC);
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
            $sql = "SELECT res.*, sit.cliente_id, tir.tipo_reservatorio,
                        hierarchy.fabricante_id,
                        hierarchy.tipo_equipamento_id, hierarchy.area_id 
                    FROM ".parent::getFormBaseUpperCase()." res
                    INNER JOIN SITE sit ON sit.id = res.site_id 
                    INNER JOIN TIPO_RESERVATORIO tir ON tir.id = res.tipo_reservatorio_id
                    INNER JOIN (
                        SELECT modelo.id AS modelo_id, modelo.fabricante_id, 
                            fab.tipo_equipamento_id, teq.area_id 
                        FROM MODELO modelo 
                        INNER JOIN FABRICANTE fab ON fab.id = modelo.fabricante_id
                        INNER JOIN TIPO_EQUIPAMENTO teq ON teq.id = fab.tipo_equipamento_id
                    ) hierarchy ON hierarchy.modelo_id = res.modelo_id 
                    WHERE res.id = '$id'";
            $sql = $this->db->query($sql);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
    public function atualizar($dados)
    {
        foreach ($dados as $k => $v) {
            $dados[$k] = str_replace('.', '', $v);
        }
        $id = $dados['id'];
        $titulo = addslashes($dados['titulo']);
        //$capacidade = addslashes($dados['capacidade']);
        //$horimetro = addslashes($dados['horimetro']);
        //$horimetro_abastecimento = addslashes($dados['horimetro_abastecimento']);
        //$autonomia = addslashes($dados['autonomia']);
        $modelo_id = addslashes($dados['modelo_id']);
        $site_id = addslashes($dados['site_id']);
        $tipo_reservatorio_id = addslashes($dados['tipo_reservatorio_id']);
        $user = $_SESSION['uid'];

        $sql = "UPDATE ".parent::getFormBaseUpperCase()." SET titulo = '$titulo', 
            site_id = $site_id, modelo_id = $modelo_id, 
            user = '$user', tipo_reservatorio_id = $tipo_reservatorio_id WHERE id = $id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount()>0) {
            return true;
        } else {
            return false;
        }
    }
    public function Refil($id, $horimetro, $horimetro_a, $abastecimento_a, $graxa_add)
    {
        //die($abastecimento_a);
        $ht = round($horimetro - $abastecimento_a);
        $consumo_medio = $ht/$graxa_add;
        echo 'ht:'.$ht.'<br> consumo_medio:'.$consumo_medio.'<br>'.$graxa_add;

        $sql = "INSERT INTO REFIL SET reservatorio = $id, horimetro = $horimetro, horimetro_anterior = $horimetro_a, " .
            "abastecimento_anterior = $abastecimento_a, horas_totais = $ht, graxa_adicionada = '$graxa_add', data = NOW(), consumo_medio = $consumo_medio";
        $sql = $this->db->query($sql);
    }
    public function getAllHistoricos()
    {
        $sql = 'SELECT * FROM refil';
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }
    public function getHistorico($id = null)
    {
        $sql = "SELECT * FROM REFIL where reservatorio=$id ORDER BY data DESC";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }
    public function getHorimetroAbastecimento($id)
    {
        $sql = "SELECT * FROM ".parent::getFormBaseUpperCase()." WHERE id = '$id'";
        $sql = $this->db->query($sql);
        $r = $sql->fetch();
        return $r['horimetro_abastecimento'];
    }
}