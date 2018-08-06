<?php
class RelatoriosController extends controller
{
    public function __construct()
    {
        $u = new User();
        if (!$u->isLoggedIn()) {
            header('location: '.BASE_URL.'/login?noAccess');
            exit;
        }
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = new Registro();
            $dados['pesquisa'] = $_POST;
            $dataInicial = $this->dataToDate($_POST['data_inicial']);
            $dataFinal = $this->dataToDate($_POST['data_final']);
            $dados['graficoareas'] = $this->parseDadosGrafico(
                $r->getSQLGraficoPrincipal($dataInicial, $dataFinal, 'area'), 'area');
            $dados['graficotiposequipamentos'] = $this->parseDadosGrafico(
                $r->getSQLGraficoPrincipal($dataInicial, $dataFinal, 'tipo_equipamento'), 'tipo_equipamento');
            $this->loadTemplate('relatorios/index', $dados);
            exit;
        }
        $this->loadTemplate('relatorios/index');
    }

    public function teste()
    {
        $r = new Registro();
        $dados['registros'] = $r->getAll();
        $this->loadTemplate('relatorios/teste', $dados);
    }

    public function ajaxConstruirGraficoFabricantesByArea() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultado = $this->construirGraficoFabricantes($_POST, "area");
            echo json_encode($resultado);
        }
    }

    public function ajaxConstruirGraficoFabricantesByTipoEquipamento() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultado = $this->construirGraficoFabricantes($_POST, "tipo_equipamento");
            echo json_encode($resultado);
        }
    }

    public function ajaxConstruirGraficoTagByModeloFabricante() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultado = $this->construirGraficoTag($_POST, "modelo");
            echo json_encode($resultado);
        }
    }

    public function ajaxConstruirGraficoTagComparativo() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultado = $this->construirGraficoTagComparativo($_POST);
            echo json_encode($resultado);
        }
    }

    private function construirGraficoTagComparativo($post)
    {
        $r = new Registro();
        $dataInicial = $this->dataToDate($post['data_inicial']);
        $dataFinal = $this->dataToDate($post['data_final']);
        $objId = $post['id'];
        $dados['graficotags'] = $this->parseDadosGraficoTag(
            $r->getSQLGraficoTagComparativo($dataInicial, $dataFinal, $objId), 'titulo');
        return $dados;
    }

    private function construirGraficoTag($post, $identificador)
    {
        $r = new Registro();
        $dataInicial = $this->dataToDate($post['data_inicial']);
        $dataFinal = $this->dataToDate($post['data_final']);
        $objId = $post[$identificador . '_id'];
        $dados['graficotags'] = $this->parseDadosGraficoTag(
            $r->getSQLGraficoTag($dataInicial, $dataFinal, $objId, 'modelo'), 'titulo');
        return $dados;
    }

    private function construirGraficoFabricantes($post, $identificador)
    {
        $r = new Registro();
        $dataInicial = $this->dataToDate($post['data_inicial']);
        $dataFinal = $this->dataToDate($post['data_final']);
        $objId = $post[$identificador . '_id'];
        $dados['graficofabricantes'] = $this->parseDadosGraficoFabricante(
            $r->getSQLGraficoFabricantes($dataInicial, $dataFinal, $objId, $identificador));
        return $dados;
    }

    private function parseDadosGraficoFabricante($obj)
    {
        $idsFabricantes = array();
        $idsModelos = array();
        $labels = array();
        $sublabels = array();
        $leituras = array();
        $tooltips = array();
        $indice = -1;
        foreach($obj as $valor) {
            if(!in_array($valor['fabricante_id'], $idsFabricantes)) {
                array_push($idsFabricantes, $valor["fabricante_id"]);
                array_push($labels, $valor['fabricante']);
                $indice++;
                $leituras[$indice] = array();
            }
            array_push($idsModelos, $valor['modelo_id']);
            array_push($sublabels, $valor['modelo']);
            array_push($leituras[$indice], floatval($valor['leitura_maxima']) - floatval($valor['leitura_minima']));
            array_push($tooltips, $this->construirTooltip($valor));
        }
        return array('idsfabricantes' => $idsFabricantes, 'labels' => $labels, 'idsmodelos' => $idsModelos,
            'sublabels' => $sublabels, 'leituras' => $leituras, 'tooltips' => $tooltips);
    }

    private function parseDadosGrafico($obj, $nome_coluna)
    {
        $ids = array();
        $labels = array();
        $leituras = array();
        $tooltips = array();
        foreach($obj as $valor) {
            array_push($ids, $valor[$nome_coluna."_id"]);
            array_push($labels, $valor[$nome_coluna]);
            array_push($leituras, floatval($valor['leitura_maxima']) - floatval($valor['leitura_minima']));
            array_push($tooltips, $this->construirTooltip($valor));
        }
        return array('ids' => $ids, 'labels' => $labels, 'leituras' => $leituras, 'tooltips' => $tooltips);
    }

    private function parseDadosGraficoTagComparativo($obj, $nome_coluna)
    {
        $ids = array();
        $labels = array();
        $leituras = array();
        foreach($obj as $valor) {
            array_push($ids, $valor["id"]);
            array_push($labels, $valor[$nome_coluna]);
            array_push($leituras, floatval($valor['leitura_maxima']) - floatval($valor['leitura_minima']));
        }
        return array('ids' => $ids, 'labels' => $labels, 'leituras' => $leituras);
    }

    private function parseDadosGraficoTag($obj, $nome_coluna)
    {
        $ids = array();
        $labels = array();
        $leituras = array();
        $tooltips = array();
        foreach($obj as $valor) {
            array_push($ids, $valor["id"]);
            array_push($labels, $valor[$nome_coluna]);
            array_push($leituras, floatval($valor['leitura_maxima']) - floatval($valor['leitura_minima']));
            array_push($tooltips, $this->construirTooltip($valor));
        }
        return array('ids' => $ids, 'labels' => $labels, 'leituras' => $leituras, 'tooltips' => $tooltips);
    }

    private function construirTooltip($valor)
    {
        return "
            Leitura Máxima: " .  str_replace(".", ",", $valor['leitura_minima']) . " <br/>
            Leitura Mínima: " .  str_replace(".", ",", $valor['leitura_maxima']) . " <br/>
            Data Inicial Ult. Leitura: " .  str_replace(".", ",", $valor['data_minima']) . " <br/>
            Data Final Ult. Leitura: " .  str_replace(".", ",", $valor['data_maxima']) . " <br/>
            Tipo de Reservatório: " . $valor['tipo_reservatorio'] . " <br/>
            Volume Morto: " .  str_replace(".", ",", $valor['volume_morto']) . " <br/>
            Área Base: " .  $valor['area_base'] . " <br/>
        ";
    }

    private function dataToDate($valor) {
        return date("Y-m-d", strtotime(str_replace("/", "-", $valor)));
    }
}