<?php
class Farol extends Model
{
    public function cadastraFarol($titulo, $itens, $modelo_id, $site_id, $reservatorio_id)
    {
        $sql = $this->db->query("INSERT INTO FAROL SET titulo = '$titulo', modelo_id = $modelo_id, site_id = $site_id, reservatorio_id = $reservatorio_id");
        $id = $this->db->lastInsertId();

        foreach ($itens as $item) {
            $sql = $this->db->query("INSERT INTO FAROL_ITENS SET id_farol = $id, item = '$item'");
        }
    }

    public function getAllFarois()
    {
        $sql = $this->db->query('SELECT FAR.*, count(FAI.id) as total FROM FAROL FAR INNER JOIN FAROL_ITENS FAI on FAR.id = FAI.id_farol GROUP BY FAR.id');
        $res = $sql->fetchAll();
        return $res;
    }
    public function getAllFarolItens($id)
    {
        $sql = $this->db->query("SELECT * FROM FAROL_ITENS WHERE id_farol = $id");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getSpecificFarolItens($farol_id, $item_id)
    {
        $sql = $this->db->query("SELECT * FROM FAROL_ITENS WHERE id_farol = $farol_id AND id = $item_id");
        $obj = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $obj['item'];
    }

    public function cadastrarResultado($farol_id, $reservatorio_id)
    {
        $this->db->query("INSERT INTO FAROL_CONCLUIDOS SET reservatorio = '$reservatorio_id', id_farol = '$farol_id' ");
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function cadastrarResultadoItens($resultado_id, $farol_item, $situacao, $observacao)
    {

        $this->db->query("INSERT INTO FAROL_RESPOSTAS SET
            farol_concluido = '$resultado_id',
            farol_item = '$farol_item',
            situacao = '$situacao',
            observacao = '$observacao'
            ");
    }

    public function getAllFaroisRealizados()
    {
        $sql = $this->db->query('SELECT FAC.*, FAR.titulo FROM FAROL_CONCLUIDOS FAC INNER JOIN FAROL FAR on farol_concluidos.id_farol = farol.id LIMIT 8');
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalItens($farol_concluido_id)
    {
        $sql = $this->db->query("SELECT COUNT(*) as total FROM FAROL_RESPOSTAS WHERE farol_concluido = '$farol_concluido_id'");
        /*
        $total = $sql->fetch()['total'];
        return $total;
        */
        $total = $sql->fetch();
        return $total['total'];
    }
    public function getTotalItensOk($farol_concluido_id)
    {

        $sql = $this->db->query("SELECT COUNT(*) as total FROM FAROL_RESPOSTAS WHERE farol_concluido = '$farol_concluido_id' AND situacao = 'C'");
        /*
        $total_ok = $sql->fetch()['total'];
        return $total_ok;
        */
        $total_ok = $sql->fetch();
        return $total_ok['total'];
    }
}
