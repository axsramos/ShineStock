<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\MateriaPrimaModel;

class MateriaPrima extends Controller
{
  private $csMateriaPrimaModel;

  public function Index()
  {
    http_response_code(200);

    $message  = new MessageDictionary;
    $messages = array();
    // array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

    $this->csMateriaPrimaModel = new MateriaPrimaModel();
    $rows = $this->csMateriaPrimaModel->readAllLines();

    $data_content = array("Messages" => $messages, "DataRows" => $rows);

    $this->view('MateriaPrimaListView', $data_content);
  }

  public function Show($id = null)
  {
    $message  = new MessageDictionary;
    $messages = array();
    $data_row = array();

    if (isset($_POST['btnClose'])) {
      header("Location: /ShineStock/MateriaPrima");
    }

    $this->csMateriaPrimaModel = new MateriaPrimaModel();
    $this->csMateriaPrimaModel->setCmpMprCod($id);

    if (empty($id)) {
      $actionMode = 'modeInsert';

      if (isset($_POST['btnConfirm'])) {
        $this->csMateriaPrimaModel = $this->SetValues();
        if ($this->csMateriaPrimaModel->insertLine()) {
          header("Location: /ShineStock/MateriaPrima");
        }
      }
    } else {
      $actionMode = 'modeDisplay';

      if (isset($_POST['btnDelete'])) {
        $actionMode = 'modeDelete';
        if ($this->csMateriaPrimaModel->deleteLine()) {
          header("Location: /ShineStock/MateriaPrima");
        }
      }

      if (isset($_POST['btnConfirm'])) {
        $this->csMateriaPrimaModel = $this->SetValues();
        if ($this->csMateriaPrimaModel->updateLine()) {
          header("Location: /ShineStock/MateriaPrima");
        }
      }

      if (isset($_POST['btnUpdate'])) {
        $actionMode = 'modeUpdate';
      }

      if ($this->csMateriaPrimaModel->readLine()) {
        $data_row = $this->csMateriaPrimaModel->data_row;
      }
    }

    $data_content = array("Messages" => $messages, "ActionMode" => $actionMode, "DataRow" => $data_row);

    $this->view('MateriaPrimaFormView', $data_content);
  }

  private function SetValues()
  {
    if (isset($_POST['CmpMprCod'])) {
      $this->csMateriaPrimaModel->setCmpMprCod($_POST['CmpMprCod']);
    }
    $this->csMateriaPrimaModel->setCmpMprDca($_POST['CmpMprDca']);
    $this->csMateriaPrimaModel->setCmpMprDsc($_POST['CmpMprDsc']);
    $this->csMateriaPrimaModel->setCmpMprBlq($_POST['CmpMprBlq']);
    $this->csMateriaPrimaModel->setCmpMprObs($_POST['CmpMprObs']);

    return $this->csMateriaPrimaModel;
  }
}
