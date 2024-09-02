<?php

namespace app\model;

use app\core\Database;
use app\shared\MessageDictionary;
use PDO;

class EtapaModel
{
    private $attBasEtpCod;
    private $attBasEtpDca;
    private $attBasEtpDsc;
    private $attBasEtpBlq;
    private $attBasEtpGrp;

    // -- database -- //
    private $cnx;
    private $tbl = 'BasEtp';

    private $csMessage;
    public $messages = array();
    public $data_row = array();

    public function __construct()
    {
        $this->cnx = new Database();
        $this->csMessage = new MessageDictionary;
    }

    // -- get -- //
    public function getBasEtpCod()
    {
        return $this->attBasEtpCod;
    }
    public function getBasEtpDca()
    {
        return $this->attBasEtpDca;
    }
    public function getBasEtpDsc()
    {
        return $this->attBasEtpDsc;
    }
    public function getBasEtpBlq()
    {
        return $this->attBasEtpBlq;
    }
    public function getBasEtpGrp()
    {
        return $this->attBasEtpGrp;
    }

    // -- set -- //
    public function setBasEtpCod($inBasEtpCod)
    {
        $this->attBasEtpCod = $inBasEtpCod;
    }
    public function setBasEtpDca($inBasEtpDca)
    {
        $this->attBasEtpDca = $inBasEtpDca;
    }
    public function setBasEtpDsc($inBasEtpDsc)
    {
        $this->attBasEtpDsc = htmlspecialchars($inBasEtpDsc);
    }
    public function setBasEtpBlq($inBasEtpBlq)
    {
        $this->attBasEtpBlq = $inBasEtpBlq;
    }
    public function setBasEtpGrp($inBasEtpGrp)
    {
        $this->attBasEtpGrp = htmlspecialchars($inBasEtpGrp);
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            BasEtpCod,
            BasEtpDca,
            BasEtpDsc,
            BasEtpBlq,
            BasEtpGrp
        FROM
        " . $this->tbl . "
        ";

        $stmt = $this->cnx->executeQuery($qry);
        $rows = $stmt->rowCount();
        $allLines = false;

        if ($rows) {
            $allLines = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $allLines;
    }

    public function readLine()
    {
        $qry = "
        SELECT
            BasEtpCod,
            BasEtpDca,
            BasEtpDsc,
            BasEtpBlq,
            BasEtpGrp
        FROM
        " . $this->tbl . "
        WHERE
            BasEtpCod = :BasEtpCod
        ";

        $parameters = array(
            ":BasEtpCod" => $this->attBasEtpCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attBasEtpCod = $this->data_row['BasEtpCod'];
            $this->attBasEtpDca = $this->data_row['BasEtpDca'];
            $this->attBasEtpDsc = $this->data_row['BasEtpDsc'];
            $this->attBasEtpBlq = $this->data_row['BasEtpBlq'];
            $this->attBasEtpGrp = $this->data_row['BasEtpGrp'];
        }

        return boolval($rows);
    }

    public function insertLine()
    {
        if (empty($this->attBasEtpCod)) {
            $this->newid();
        } else {
            if (!$this->check_duplicate_key()) {
                return FALSE;
            }
        }
        
        $qry = "
        INSERT INTO
        " . $this->tbl . "
        (
            BasEtpCod,
            BasEtpDca,
            BasEtpDsc,
            BasEtpBlq,
            BasEtpGrp
        )
        VALUES
        (
            :BasEtpCod,
            :BasEtpDca,
            :BasEtpDsc,
            :BasEtpBlq,
            :BasEtpGrp
        )
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod,
            ':BasEtpDca' => $this->attBasEtpDca,
            ':BasEtpDsc' => $this->attBasEtpDsc,
            ':BasEtpBlq' => $this->attBasEtpBlq,
            ':BasEtpGrp' => $this->attBasEtpGrp
        );
        
        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return boolval($rows);
    }

    public function updateLine()
    {
        $qry = "
        UPDATE 
        " . $this->tbl . "
        SET
            BasEtpDca = :BasEtpDca,
            BasEtpDsc = :BasEtpDsc,
            BasEtpBlq = :BasEtpBlq,
            BasEtpGrp = :BasEtpGrp
        WHERE
            BasEtpCod = :BasEtpCod
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod,
            ':BasEtpDca' => $this->attBasEtpDca,
            ':BasEtpDsc' => $this->attBasEtpDsc,
            ':BasEtpBlq' => $this->attBasEtpBlq,
            ':BasEtpGrp' => $this->attBasEtpGrp
        );
        
        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return boolval($rows);
    }

    public function deleteLine()
    {
        if ($this->check_referencial_key()) {
            $this->delete_referencial();
        }

        $qry = "
        DELETE FROM
        " . $this->tbl . "
        WHERE
            BasEtpCod = :BasEtpCod
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod
        );
        
        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return boolval($rows);
    }

    // -- other -- //
    private function newid()
    {
        $qry = "
        SELECT
            BasEtpCod
        FROM
        " . $this->tbl . "
        ORDER BY
            BasEtpCod desc
        LIMIT 1
        ";

        $stmt = $this->cnx->executeQuery($qry);
        $rows = $stmt->rowCount();

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->attBasEtpCod = (1 + $row['BasEtpCod']);
        } else {
            $this->attBasEtpCod = 1;
        }
    }

    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            BasEtpCod
        FROM
        " . $this->tbl . "
        WHERE
            BasEtpCod = :BasEtpCod
        ";

        $parameters = array(
            ":BasEtpCod" => $this->attBasEtpCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            array_push($this->messages, $this->csMessage->getDictionaryError(1, "Messages", "Ocorreu um erro. Validação em dado duplicado. Registro já existe."));
        }

        return !boolval($rows);
    }

    private function check_referencial_key()
    {
        return true;
    }
    private function delete_referencial()
    {
        $qry = "
        DELETE FROM
        BasEtpItm
        WHERE
            BasEtpCod = :BasEtpCod
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod
        );
        
        $stmt = $this->cnx->executeQuery($qry, $parameters);
    }

    public function readAllLinesSelection($restrictBasEtpCod, $inGroup = null)
    {
        $qry = "
        SELECT
            BasEtpCod,
            BasEtpDca,
            BasEtpDsc,
            BasEtpBlq,
            BasEtpGrp
        FROM
        " . $this->tbl . "
        WHERE
            BasEtpBlq = :BasEtpBlq
        AND NOT BasEtpCod IN(:BasEtpCod)
        AND (BasEtpGrp = :BasEtpGrp and :BasEtpGrp IS NOT NULL)
        ";
        
        $parameters = array(
            ":BasEtpCod" => $restrictBasEtpCod,
            ":BasEtpBlq" => "N",
            ":BasEtpGrp" => $inGroup
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();
        $allLines = false;

        if ($rows) {
            $allLines = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $allLines;
    }

    public function findStatus()
    {
        $qry = "
        SELECT
            BasEtpCod,
            BasEtpDsc
        FROM
        " . $this->tbl . "
        WHERE
            BasEtpDsc = :BasEtpDsc
        ";

        $parameters = array(
            ":BasEtpDsc" => $this->attBasEtpDsc
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attBasEtpCod = $this->data_row['BasEtpCod'];
            $this->attBasEtpDsc = $this->data_row['BasEtpDsc'];
        }
        
        return boolval($rows);
    }
}
