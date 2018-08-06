<?php
class Horimetros extends Model
{

    public function atualizarHorimetro($id, $horimetro, $horimetro_anterior = null)
    {

        $sql = "UPDATE reservatorios SET horimetro = $horimetro, ultima_atualizacao = NOW() WHERE id = $id";
        $this->db->query($sql);
    }
    public function abastecer($id, $horimetro)
    {
        $sql = "UPDATE reservatorios SET horimetro = $horimetro, horimetro_abastecimento = $horimetro WHERE id = $id";
        $this->db->query($sql);
    }
}
