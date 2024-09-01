<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\PedidoCompraModel;
use app\model\MateriaPrimaPedidoCompraModel;
use app\model\MateriaPrimaModel;

class MateriaPrimaPedidoCompra extends Controller
{
    public function index($id)
    {
        http_response_code(200);

        $message  = new MessageDictionary;
        $messages = array();
        $data_PedidoCompra = array();
        array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

        $csPedidoCompraModel = new PedidoCompraModel();
        $csPedidoCompraModel->setCmpPncCod($id);
        if ($csPedidoCompraModel->readLine()) {
            $data_PedidoCompra = array(
                "CmpPncCod" => $csPedidoCompraModel->getCmpPncCod(),
                "CmpPncDca" => $csPedidoCompraModel->getCmpPncDca(),
                "CmpPncDsc" => $csPedidoCompraModel->getCmpPncDsc(),
                "CmpPncEtp" => $csPedidoCompraModel->getCmpPncEtp(),
                "BasEtpDsc" => $csPedidoCompraModel->getBasEtpDsc(),
                "BasEtpGrp" => $csPedidoCompraModel->getBasEtpGrp(),
                "CmpPncUsr" => $csPedidoCompraModel->getCmpPncUsr(),
                "CmpPncObs" => $csPedidoCompraModel->getCmpPncObs()
            );
        }

        $csMateriaPrimaPedidoCompraModel = new MateriaPrimaPedidoCompraModel();
        $csMateriaPrimaPedidoCompraModel->setCmpPncCod($id);
        $rows = $csMateriaPrimaPedidoCompraModel->readAllLines();

        $rows_selection = $this->listMateriaPrimaSelection($id);
        
        $data_content = array(
            "Messages" => $messages,
            "DataHeader" => $data_PedidoCompra,
            "DataRows" => $rows,
            "DataRowsSelection" => $rows_selection
        );

        $this->view('MateriaPrimaPedidoCompraFormView', $data_content);
    }

    private function listMateriaPrimaSelection($inCmpPncCod)
    {
        $csPedidoCompraModel = new MateriaPrimaPedidoCompraModel();
        $rows = $csPedidoCompraModel->readAllLinesMateriaPrimaSelection($inCmpPncCod);

        return $rows;
    }

    public function Add($id, $id_selection)
    {
        $csMateriaPrimaModel = new MateriaPrimaModel();
        $csMateriaPrimaModel->setCmpMprCod($id_selection);
        $attCmpPncMprQtd = 1;

        $csMateriaPrimaPedidoCompraModel = new MateriaPrimaPedidoCompraModel();
        
        $csMateriaPrimaPedidoCompraModel->setCmpPncCod($id);
        $csMateriaPrimaPedidoCompraModel->setCmpMprCod($id_selection);
        $csMateriaPrimaPedidoCompraModel->setCmpPncMprDca(date('Y-m-d'));
        $csMateriaPrimaPedidoCompraModel->setCmpPncMprQtd($attCmpPncMprQtd);

        $result = $csMateriaPrimaPedidoCompraModel->insertLine();

        header("Location: /ShineStock/MateriaPrimaPedidoCompra/Index/" . $id);
    }

    public function Remove($id, $id_selection)
    {
        $csMateriaPrimaPedidoCompraModel = new MateriaPrimaPedidoCompraModel();
        
        $csMateriaPrimaPedidoCompraModel->setCmpPncCod($id);
        $csMateriaPrimaPedidoCompraModel->setCmpMprCod($id_selection);
        
        $result = $csMateriaPrimaPedidoCompraModel->deleteLine();

        header("Location: /ShineStock/MateriaPrimaPedidoCompra/Index/" . $id);
    }

}