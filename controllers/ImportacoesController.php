<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
define('BASE_FILE_IMPORT', "assets/importacoes/");

class ImportacoesController extends controller
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
            if(isset($_FILES) && array_key_exists('arquivo',$_FILES) && 
               array_key_exists('tmp_name',$_FILES['arquivo'])) {
                $file = $_FILES['arquivo']['tmp_name'];
                $nameFile = $_FILES['arquivo']['name'];
                if($this->readXlsx($file, $nameFile)) {
                    $_SESSION['success'] = 'Arquivo carregado com sucesso.';
                } else {
                    $_SESSION['error'] = 'Ocorreu um problema ao carregar o arquivo. Tente novamente';
                }
            } else {
                $_SESSION['error'] = 'Ocorreu um problema ao carregar o arquivo. Tente novamente';
            }
        }
        $this->loadTemplate('importacoes/index');
    }

    private function readXlsx($file, $nameFile)
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        for ($index = 2; $index <= count($sheetData); $index++) { 
            if(!$this->processRow($sheetData[$index])) {
                return false;
            }
        }
        
        return $this->saveXlsx($spreadsheet, $nameFile);
    }

    private function processRow($sheetRow)
    {
        $oldKey = "";
        $oldValue = "";
        foreach($sheetRow as $aKey => $aValue) {
            if($aValue != "") {
                $dados = array();
                $objModel = $this->getModel($aKey);
                if($objModel != "") {
                    $find = $objModel->getByNameExactly($aValue);
                    if($find == "") {
                        $dados = $this->loadData($aKey, $aValue, $oldKey, $oldValue);
                        if (!$objModel->cadNew($dados)) {
                            return false;
                        }
                        $find = $objModel->getByNameExactly($aValue);
                    }
                    $arrayInsert[$aKey] = $find['id'];
                    $oldKey = $aKey;
                    $oldValue = $aValue;
                } else {
                    $arrayInsert[$aKey] = $aValue;
                }
            }
        }
        return $this->saveEquipamento($arrayInsert);
    }

    private function saveXlsx($spreadsheet, $nameFile)
    {
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save(BASE_FILE_IMPORT.date("YmdHis")."_".$nameFile.".xlsx");
        return true;
    }

    private function saveEquipamento($arrayInsert)
    {
        $objModel = new Reservatorio();
        $find = $objModel->getByNameExactly($arrayInsert['A']);
        if($find == '') {
            $arrayIndices = $this->getArrayIndices();
            foreach($arrayInsert as $aKey => $aValue) {
                $fieldName = $arrayIndices[$aKey];
                if($aKey != 'A') {
                    $fieldName .= "_id";
                    $dados[$fieldName] = $aValue;
                } else {
                    $dados['titulo'] = $aValue;
                }
            }
            $dados['consumo'] = 1;
            $dados['capacidade'] = 1;
            $dados['horimetro'] = 1;
            $dados['horimetro_abastecimento'] = 1;
            $dados['autonomia'] = 1;
            if (!$objModel->cadNew($dados)) {
                return false;
            }
        }
        return true;
    }

    private function loadData($key, $value, $oldKey, $oldValue)
    {
        $arrayIndices = $this->getArrayIndices();
        $baseForm = $arrayIndices[$key];
        $dados[$baseForm] = $value;
        $dependencyModel = $this->getDependencyModel($key);
        if($dependencyModel != "") {
            $find = $dependencyModel->getByNameExactly($oldValue);
            $dados[$arrayIndices[$oldKey].'_id'] = $find['id'];
        }
        return $dados;
    }

    private function getModel($key) 
    {
        switch($key) {
            case "B":
                return new Cliente();
                break;
            case "C":
                return new Site();
                break;
            case "D":
                return new Area();
                break;
            case "E":
                return new Tipoequipamento();
                break;
            case "F":
                return new Fabricante();
                break;
            case "G":
                return new Modelo();
                break;
            default:
                return '';
        }
    }

    private function getDependencyModel($key) 
    {
        switch($key) {
            case "C":
                return new Cliente();
                break;
            case "E":
                return new Area();
                break;
            case "F":
                return new TipoEquipamento();
                break;
            case "G":
                return new Fabricante();
                break;
            default:
                return '';
        }
    }

    private function getArrayIndices()
    {
        return array(
            'A' => 'tag',
            'B' => 'cliente',
            'C' => 'site',
            'D' => 'area',
            'E' => 'tipo_equipamento',
            'F' => 'fabricante',
            'G' => 'modelo'
        );
    }
}
