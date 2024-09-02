<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\EtapaModel;
use app\model\PedidoCompraModel;

class Dashboard extends Controller
{

  public function index()
  {
    $message  = new MessageDictionary;
    $messages = array();

    http_response_code(200);
    array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

    $data_content = array("Messages" => $messages);

    $this->view('DashboardView', $data_content);
  }

  protected function getStatusCards()
  {
    $csEtapaModel = new EtapaModel();

    $dangerCod = 0;
    $successCod = 0;
    $warningCod = 0;
    $primaryCod = 0;

    $csEtapaModel->setBasEtpDsc('REPROVADO');
    if ($csEtapaModel->findStatus()) {
      $dangerCod = $csEtapaModel->getBasEtpCod();
    }
    
    $csEtapaModel->setBasEtpDsc('APROVADO');
    if ($csEtapaModel->findStatus()) {
      $successCod = $csEtapaModel->getBasEtpCod();
    }
    
    $csEtapaModel->setBasEtpDsc('ANÁLISE');
    if ($csEtapaModel->findStatus()) {
      $warningCod = $csEtapaModel->getBasEtpCod();
    }
    
    $csEtapaModel->setBasEtpDsc('FECHADO');
    if ($csEtapaModel->findStatus()) {
      $primaryCod = $csEtapaModel->getBasEtpCod();
    }
    
    $result = array(
      "danger" => $dangerCod,
      "success" => $successCod,
      "warning" => $warningCod,
      "primary" => $primaryCod
    );

    return $result;
  }

  protected function balanceCards($card)
  {
    $csPedidoCompraModel = new PedidoCompraModel();
    $csPedidoCompraModel->setCmpPncEtp($card);
    $balance = $csPedidoCompraModel->balanceCards();

    return $balance;
  }
}
