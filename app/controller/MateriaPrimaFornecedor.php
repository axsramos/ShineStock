<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\FornecedorModel;
use app\model\MateriaPrimaFornecedorModel;
use app\model\MateriaPrimaModel;

class MateriaPrimaFornecedor extends Controller
{
    public function index($id)
    {
        http_response_code(200);

        $message  = new MessageDictionary;
        $messages = array();
        $data_fornecedor = array();
        array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

        $csFornecedorModel = new FornecedorModel();
        $csFornecedorModel->setCmpFncCod($id);
        if ($csFornecedorModel->readLine()) {
            $data_fornecedor = array(
                "CmpFncCod" => $csFornecedorModel->getCmpFncCod(),
                "CmpFncDca" => $csFornecedorModel->getCmpFncDca(),
                "CmpFncDsc" => $csFornecedorModel->getCmpFncDsc(),
                "CmpFncBlq" => $csFornecedorModel->getCmpFncBlq(),
                "CmpFncObs" => $csFornecedorModel->getCmpFncObs()
            );
        }

        $csMateriaPrimaFornecedorModel = new MateriaPrimaFornecedorModel();
        $csMateriaPrimaFornecedorModel->setCmpFncCod($id);
        $rows = $csMateriaPrimaFornecedorModel->readAllLines();

        $rows_selection = $this->listMateriaPrimaSelection($id);
        
        $data_content = array(
            "Messages" => $messages,
            "DataHeader" => $data_fornecedor,
            "DataRows" => $rows,
            "DataRowsSelection" => $rows_selection
        );

        $this->view('MateriaPrimaFornecedorFormView', $data_content);
    }

    private function listMateriaPrimaSelection($inCmpFncCod)
    {
        $csFornecedorModel = new MateriaPrimaFornecedorModel();
        $rows = $csFornecedorModel->readAllLinesMateriaPrimaSelection($inCmpFncCod);

        return $rows;
    }

    public function Add($id, $id_selection)
    {
        $csMateriaPrimaModel = new MateriaPrimaModel();
        $csMateriaPrimaModel->setCmpMprCod($id_selection);
        $attCmpMpfDsc = '<Not Defined>';
        if ($csMateriaPrimaModel->readLine()) {
            $attCmpMpfDsc = $csMateriaPrimaModel->getCmpMprDsc();
        }

        $csMateriaPrimaFornecedorModel = new MateriaPrimaFornecedorModel();
        
        $csMateriaPrimaFornecedorModel->setCmpFncCod($id);
        $csMateriaPrimaFornecedorModel->setCmpMprCod($id_selection);
        $csMateriaPrimaFornecedorModel->setCmpMpfDca(date('Y-m-d'));
        $csMateriaPrimaFornecedorModel->setCmpMpfDsc($attCmpMpfDsc);
        $csMateriaPrimaFornecedorModel->setCmpMpfBlq('N');

        $result = $csMateriaPrimaFornecedorModel->insertLine();

        header("Location: /ShineStock/MateriaPrimaFornecedor/Index/" . $id);
    }

    public function Remove($id, $id_selection)
    {
        $csMateriaPrimaFornecedorModel = new MateriaPrimaFornecedorModel();
        
        $csMateriaPrimaFornecedorModel->setCmpFncCod($id);
        $csMateriaPrimaFornecedorModel->setCmpMprCod($id_selection);
        
        $result = $csMateriaPrimaFornecedorModel->deleteLine();

        header("Location: /ShineStock/MateriaPrimaFornecedor/Index/" . $id);
    }

}