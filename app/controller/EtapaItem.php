<?php

use app\core\Controller;
use app\shared\MessageDictionary;
use app\model\EtapaModel;
use app\model\EtapaItemModel;

class EtapaItem extends Controller
{
    public function index($id)
    {
        http_response_code(200);

        $message  = new MessageDictionary;
        $messages = array();
        $data_etapa = array();
        // array_push($messages, $message->getDictionaryError(3, "Messages", "You are on the home page."));

        $csEtapaModel = new EtapaModel();
        $csEtapaModel->setBasEtpCod($id);
        if ($csEtapaModel->readLine()) {
            $data_etapa = array(
                "BasEtpCod" => $csEtapaModel->getBasEtpCod(),
                "BasEtpDca" => $csEtapaModel->getBasEtpDca(),
                "BasEtpDsc" => $csEtapaModel->getBasEtpDsc(),
                "BasEtpBlq" => $csEtapaModel->getBasEtpBlq(),
                "BasEtpGrp" => $csEtapaModel->getBasEtpGrp()
            );
        }

        $csEtapaItemModel = new EtapaItemModel();
        $csEtapaItemModel->setBasEtpCod($id);
        $rows = $csEtapaItemModel->readAllLines();

        $restrict_ids = $id;
        if (isset($rows)) {
            foreach($rows as $row_item) {
                $restrict_ids = $restrict_ids . ',' . $row_item['BasEtpItmCod'];
            }
        }

        $group = $csEtapaModel->getBasEtpGrp();

        $rows_selection = $this->listEtapasSelection($restrict_ids, $group);
        
        $data_content = array(
            "Messages" => $messages,
            "DataHeader" => $data_etapa,
            "DataRows" => $rows,
            "DataRowsSelection" => $rows_selection
        );

        $this->view('EtapaItemFormView', $data_content);
    }

    private function listEtapasSelection($inBasEtpCod, $inGroup = null)
    {
        $csEtapaModel = new EtapaModel();
        $rows = $csEtapaModel->readAllLinesSelection($inBasEtpCod, $inGroup);

        return $rows;
    }

    public function Add($id, $id_selection)
    {
        $csEtapaItemModel = new EtapaItemModel();
        
        $csEtapaItemModel->setBasEtpCod($id);
        $csEtapaItemModel->setBasEtpItmCod($id_selection);
        $csEtapaItemModel->setBasEtpItmDca(date('Y-m-d'));
        $csEtapaItemModel->setBasEtpItmBlq('N');

        $result = $csEtapaItemModel->insertLine();

        header("Location: /ShineStock/EtapaItem/Index/" . $id);
    }

    public function Remove($id, $id_selection)
    {
        $csEtapaItemModel = new EtapaItemModel();
        
        $csEtapaItemModel->setBasEtpCod($id);
        $csEtapaItemModel->setBasEtpItmCod($id_selection);
        
        $result = $csEtapaItemModel->deleteLine();

        header("Location: /ShineStock/EtapaItem/Index/" . $id);
    }
}