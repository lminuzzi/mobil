<?php

class Registro extends Model
{
    public function getFormBase()
    {
        return "REGISTROS";
    }
    
    public function getAll()
    {
        $sql = 'SELECT reg.* FROM '.$this->getFormBase().' reg';
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id)
    {
        if (is_numeric($id)) {
            $sql = "SELECT reg.* FROM ".$this->getFormBase()." reg
                    WHERE reg.id = '$id'";
            $sql = $this->db->query($sql);
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
    }
    
    public function getSQLGraficoPrincipal($periodo_inicial, $periodo_final, $identificador)
    {
        $sql ="
            SELECT 
                MIN(REG.data) data_minima, MAX(REG.data) data_maxima, 
                MIN(REG.leitura) leitura_minima, MAX(REG.leitura) leitura_maxima, 
                $identificador, ".$identificador."_id, TRE.tipo_reservatorio, 
                TRE.volume_morto, TRE.area_base
            FROM REGISTROS REG 
            JOIN SENSORES SEN ON SEN.serial = REG.serial
            JOIN RESERVATORIOS RES ON RES.titulo = SEN.tag 
            JOIN MODELO MO ON MO.id = RES.modelo_id
            JOIN FABRICANTE FA ON FA.id = MO.fabricante_id
            JOIN TIPO_EQUIPAMENTO TEQ ON TEQ.id = FA.tipo_equipamento_id
            JOIN AREA ARE ON ARE.id = TEQ.area_id
            JOIN TIPO_RESERVATORIO TRE ON TRE.id = RES.tipo_reservatorio_id
            WHERE 
                DATE(REG.data) BETWEEN DATE('$periodo_inicial') AND DATE('$periodo_final')
                AND tipo_leitura = 'D'
            GROUP BY 
                $identificador, ".$identificador."_id, TRE.tipo_reservatorio, 
                TRE.volume_morto, TRE.area_base
            ORDER BY ARE.area, REG.data
        ";
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSQLGraficoFabricantes($periodo_inicial, $periodo_final, $id_objeto, $identificador)
    {
        $sql ="
            SELECT 
                MIN(REG.data) data_minima, MAX(REG.data) data_maxima, 
                MIN(REG.leitura) leitura_minima, MAX(REG.leitura) leitura_maxima, 
                MO.modelo, RES.modelo_id, FA.fabricante, MO.fabricante_id,
                TRE.tipo_reservatorio, TRE.volume_morto, TRE.area_base
            FROM REGISTROS REG 
            JOIN SENSORES SEN ON SEN.serial = REG.serial
            JOIN RESERVATORIOS RES ON RES.titulo = SEN.tag 
            JOIN MODELO MO ON MO.id = RES.modelo_id
            JOIN FABRICANTE FA ON FA.id = MO.fabricante_id
            JOIN TIPO_EQUIPAMENTO TEQ ON TEQ.id = FA.tipo_equipamento_id
            JOIN TIPO_RESERVATORIO TRE ON TRE.id = RES.tipo_reservatorio_id
            WHERE 
                ".$identificador."_id = $id_objeto
                AND tipo_leitura = 'D'
                AND DATE(REG.data) BETWEEN DATE('$periodo_inicial') AND DATE('$periodo_final')
            GROUP BY
                MO.modelo, RES.modelo_id, FA.fabricante, MO.fabricante_id,
                TRE.tipo_reservatorio, TRE.volume_morto, TRE.area_base
            ORDER BY FA.fabricante, MO.modelo, REG.data
        ";
        //echo $sql;
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSQLGraficoTag($periodo_inicial, $periodo_final, $id_objeto, $identificador)
    {
        $sql ="
            SELECT 
                MIN(REG.data) data_minima, MAX(REG.data) data_maxima, 
                MIN(REG.leitura) leitura_minima, MAX(REG.leitura) leitura_maxima, 
                RES.titulo, RES.id, TRE.tipo_reservatorio, TRE.volume_morto, TRE.area_base
            FROM REGISTROS REG 
            JOIN SENSORES SEN ON SEN.serial = REG.serial
            JOIN RESERVATORIOS RES ON RES.titulo = SEN.tag 
            JOIN MODELO MO ON MO.id = RES.modelo_id
            JOIN FABRICANTE FA ON FA.id = MO.fabricante_id
            JOIN TIPO_EQUIPAMENTO TEQ ON TEQ.id = FA.tipo_equipamento_id
            JOIN TIPO_RESERVATORIO TRE ON TRE.id = RES.tipo_reservatorio_id
            WHERE 
                ".$identificador."_id = $id_objeto
                AND tipo_leitura = 'D'
                AND DATE(REG.data) BETWEEN DATE('$periodo_inicial') AND DATE('$periodo_final')
            GROUP BY
                RES.titulo, RES.id, 
                TRE.tipo_reservatorio, TRE.volume_morto, TRE.area_base
            ORDER BY FA.fabricante, MO.modelo, REG.data
        ";
        //echo $sql;
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSQLGraficoTagComparativo($periodo_inicial, $periodo_final, $id_objeto)
    {
        $sql ="
            SELECT 
                REG.data, REG.leitura, RES.titulo, RES.id, 
                TRE.tipo_reservatorio, TRE.volume_morto, TRE.area_base
            FROM REGISTROS REG 
            JOIN SENSORES SEN ON SEN.serial = REG.serial
            JOIN RESERVATORIOS RES ON RES.titulo = SEN.tag 
            JOIN MODELO MO ON MO.id = RES.modelo_id
            JOIN FABRICANTE FA ON FA.id = MO.fabricante_id
            JOIN TIPO_EQUIPAMENTO TEQ ON TEQ.id = FA.tipo_equipamento_id
            JOIN TIPO_RESERVATORIO TRE ON TRE.id = RES.tipo_reservatorio_id
            WHERE 
                REG.id = $id_objeto
                AND tipo_leitura = 'D'
                AND DATE(REG.data) BETWEEN DATE('$periodo_inicial') AND DATE('$periodo_final')
            ORDER BY REG.data, REG.leitura
        ";
        //echo $sql;
        $sql = $this->db->query($sql);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}