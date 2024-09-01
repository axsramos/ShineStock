<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\FornecedorModel;

class Fornecedor extends Controller
{
  private $csFornecedorModel;

  public function Index()
  {
    http_response_code(200);

    $message  = new MessageDictionary;
    $messages = array();
    // array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

    $this->csFornecedorModel = new FornecedorModel();
    $rows = $this->csFornecedorModel->readAllLines();

    $data_content = array("Messages" => $messages, "DataRows" => $rows);

    $this->view('FornecedorListView', $data_content);
  }

  public function Show($id = null)
  {
    $message  = new MessageDictionary;
    $messages = array();
    $data_row = array();

    if (isset($_POST['btnClose'])) {
      header("Location: /ShineStock/Fornecedor");
    }

    $this->csFornecedorModel = new FornecedorModel();
    $this->csFornecedorModel->setCmpFncCod($id);

    if (empty($id)) {
      $actionMode = 'modeInsert';

      if (isset($_POST['btnConfirm'])) {
        $this->csFornecedorModel = $this->SetValues();
        if ($this->csFornecedorModel->insertLine()) {
          header("Location: /ShineStock/Fornecedor");
        }
      }
    } else {
      $actionMode = 'modeDisplay';

      if (isset($_POST['btnDelete'])) {
        $actionMode = 'modeDelete';
        if ($this->csFornecedorModel->deleteLine()) {
          header("Location: /ShineStock/Fornecedor");
        }
      }

      if (isset($_POST['btnConfirm'])) {
        $this->csFornecedorModel = $this->SetValues();
        if ($this->csFornecedorModel->updateLine()) {
          header("Location: /ShineStock/Fornecedor");
        }
      }

      if (isset($_POST['btnUpdate'])) {
        $actionMode = 'modeUpdate';
      }

      if ($this->csFornecedorModel->readLine()) {
        $data_row = $this->csFornecedorModel->data_row;
      }
    }

    $data_content = array("Messages" => $messages, "ActionMode" => $actionMode, "DataRow" => $data_row);

    $this->view('FornecedorFormView', $data_content);
  }

  private function SetValues()
  {
    if (isset($_POST['CmpFncCod'])) {
      $this->csFornecedorModel->setCmpFncCod($_POST['CmpFncCod']);
    }
    $this->csFornecedorModel->setCmpFncDca($_POST['CmpFncDca']);
    $this->csFornecedorModel->setCmpFncDsc($_POST['CmpFncDsc']);
    $this->csFornecedorModel->setCmpFncBlq($_POST['CmpFncBlq']);
    $this->csFornecedorModel->setCmpFncObs($_POST['CmpFncObs']);

    return $this->csFornecedorModel;
  }
}
