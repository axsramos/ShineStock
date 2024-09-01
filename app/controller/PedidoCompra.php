<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\PedidoCompraModel;
use app\model\EtapaModel;

class PedidoCompra extends Controller
{
  private $csPedidoCompraModel;

  public function Index()
  {
    http_response_code(200);

    $message  = new MessageDictionary;
    $messages = array();
    // array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

    $this->csPedidoCompraModel = new PedidoCompraModel();
    $rows = $this->csPedidoCompraModel->readAllLines();

    $data_content = array("Messages" => $messages, "DataRows" => $rows);

    $this->view('PedidoCompraListView', $data_content);
  }

  public function Show($id = null)
  {
    $message  = new MessageDictionary;
    $messages = array();
    $data_row = array();

    if (isset($_POST['btnClose'])) {
      header("Location: /ShineStock/PedidoCompra");
    }

    $this->csPedidoCompraModel = new PedidoCompraModel();
    $this->csPedidoCompraModel->setCmpPncCod($id);

    if (empty($id)) {
      $actionMode = 'modeInsert';

      if (isset($_POST['btnConfirm'])) {
        $this->csPedidoCompraModel = $this->SetValues();
        if ($this->csPedidoCompraModel->insertLine()) {
          header("Location: /ShineStock/PedidoCompra");
        }
      }
    } else {
      $actionMode = 'modeDisplay';

      if (isset($_POST['btnDelete'])) {
        $actionMode = 'modeDelete';
        if ($this->csPedidoCompraModel->deleteLine()) {
          header("Location: /ShineStock/PedidoCompra");
        }
      }

      if (isset($_POST['btnConfirm'])) {
        $this->csPedidoCompraModel = $this->SetValues();
        if ($this->csPedidoCompraModel->updateLine()) {
          header("Location: /ShineStock/PedidoCompra");
        }
      }

      if (isset($_POST['btnUpdate'])) {
        $actionMode = 'modeUpdate';
      }

      if ($this->csPedidoCompraModel->readLine()) {
        $data_row = $this->csPedidoCompraModel->data_row;
      }
    }

    $data_content = array("Messages" => $messages, "ActionMode" => $actionMode, "DataRow" => $data_row);

    $this->view('PedidoCompraFormView', $data_content);
  }

  private function SetValues()
  {
    if (isset($_POST['CmpPncCod'])) {
      $this->csPedidoCompraModel->setCmpPncCod($_POST['CmpPncCod']);
    }
    $this->csPedidoCompraModel->setCmpPncDca($_POST['CmpPncDca']);
    $this->csPedidoCompraModel->setCmpPncDsc($_POST['CmpPncDsc']);
    $this->csPedidoCompraModel->setCmpPncEtp($_POST['CmpPncEtp']);
    $this->csPedidoCompraModel->setCmpPncUsr($_POST['CmpPncUsr']);
    $this->csPedidoCompraModel->setCmpPncObs($_POST['CmpPncObs']);

    return $this->csPedidoCompraModel;
  }

  protected function getSelectionBasEtp() {
    $csEtapaModel = new EtapaModel();
    $rows = $csEtapaModel->readAllLines();

    // $etapas = array(
    //   array("BasEtpCod"=>"1", "BasEtpDsc"=>"Hum"),
    //   array("BasEtpCod"=>"2", "BasEtpDsc"=>"Dois")
    // );
    
    return $rows;
  }
}
