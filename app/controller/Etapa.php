<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\EtapaModel;

class Etapa extends Controller
{
  private $csEtapaModel;

  public function Index()
  {
    http_response_code(200);

    $message  = new MessageDictionary;
    $messages = array();
    // array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

    $this->csEtapaModel = new EtapaModel();
    $rows = $this->csEtapaModel->readAllLines();

    $data_content = array("Messages" => $messages, "DataRows" => $rows);

    $this->view('EtapaListView', $data_content);
  }

  public function Show($id = null)
  {
    $message  = new MessageDictionary;
    $messages = array();
    $data_row = array();

    if (isset($_POST['btnClose'])) {
      header("Location: /ShineStock/Etapa");
    }

    $this->csEtapaModel = new EtapaModel();
    $this->csEtapaModel->setBasEtpCod($id);

    if (empty($id)) {
      $actionMode = 'modeInsert';

      if (isset($_POST['btnConfirm'])) {
        $this->csEtapaModel = $this->SetValues();
        if ($this->csEtapaModel->insertLine()) {
          header("Location: /ShineStock/Etapa");
        }
      }
    } else {
      $actionMode = 'modeDisplay';

      if (isset($_POST['btnDelete'])) {
        $actionMode = 'modeDelete';
        if ($this->csEtapaModel->deleteLine()) {
          header("Location: /ShineStock/Etapa");
        }
      }

      if (isset($_POST['btnConfirm'])) {
        $this->csEtapaModel = $this->SetValues();
        if ($this->csEtapaModel->updateLine()) {
          header("Location: /ShineStock/Etapa");
        }
      }

      if (isset($_POST['btnUpdate'])) {
        $actionMode = 'modeUpdate';
      }

      if ($this->csEtapaModel->readLine()) {
        $data_row = $this->csEtapaModel->data_row;
      }
    }

    $data_content = array("Messages" => $messages, "ActionMode" => $actionMode, "DataRow" => $data_row);

    $this->view('EtapaFormView', $data_content);
  }

  private function SetValues()
  {
    if (isset($_POST['BasEtpCod'])) {
      $this->csEtapaModel->setBasEtpCod($_POST['BasEtpCod']);
    }
    $this->csEtapaModel->setBasEtpDca($_POST['BasEtpDca']);
    $this->csEtapaModel->setBasEtpDsc($_POST['BasEtpDsc']);
    $this->csEtapaModel->setBasEtpBlq($_POST['BasEtpBlq']);
    $this->csEtapaModel->setBasEtpGrp($_POST['BasEtpGrp']);

    return $this->csEtapaModel;
  }
}
