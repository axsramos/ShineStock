<?php

namespace app\model;

use app\core\Database;
use app\shared\MessageDictionary;
use PDO;

class EtapaItemModel
{
    private $attBasEtpCod;
    private $attBasEtpItmCod;
    private $attBasEtpItmDca;
    private $attBasEtpItmBlq;

    // -- database -- //
    private $cnx;
    private $tbl = 'BasEtpItm';

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
    public function getBasEtpItmCod()
    {
        return $this->attBasEtpItmCod;
    }
    public function getBasEtpItmDca()
    {
        return $this->attBasEtpItmDca;
    }
    public function getBasEtpItmBlq()
    {
        return $this->attBasEtpItmBlq;
    }
    
    // -- set -- //
    public function setBasEtpCod($inBasEtpCod)
    {
        $this->attBasEtpCod = $inBasEtpCod;
    }
    public function setBasEtpItmCod($inBasEtpItmCod)
    {
        $this->attBasEtpItmCod = $inBasEtpItmCod;
    }
    public function setBasEtpItmDca($inBasEtpItmDca)
    {
        $this->attBasEtpItmDca = $inBasEtpItmDca;
    }
    public function setBasEtpItmBlq($inBasEtpItmBlq)
    {
        $this->attBasEtpItmBlq = $inBasEtpItmBlq;
    }
    
    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            BasEtpCod,
            BasEtpItmCod,
            BasEtpItmDca,
            BasEtpItmBlq,
            (select BasEtpDsc from BasEtp where BasEtpCod = BasEtpItmCod) as BasEtpItmDsc
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
            BasEtpItmCod,
            BasEtpItmDca,
            BasEtpItmBlq,
            (select BasEtpDsc from BasEtp where BasEtpCod = BasEtpItmCod) as BasEtpItmDsc
        FROM
        " . $this->tbl . "
        WHERE
            BasEtpCod = :BasEtpCod
        AND BasEtpItmCod = :BasEtpItmCod
        ";

        $parameters = array(
            ":BasEtpCod" => $this->attBasEtpCod,
            ":BasEtpItmCod" => $this->attBasEtpItmCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attBasEtpCod = $this->data_row['BasEtpCod'];
            $this->attBasEtpItmCod = $this->data_row['BasEtpItmCod'];
            $this->attBasEtpItmDca = $this->data_row['BasEtpItmDca'];
            $this->attBasEtpItmBlq = $this->data_row['BasEtpItmBlq'];
        }

        return boolval($rows);
    }

    public function insertLine()
    {
        if (empty($this->attBasEtpItmCod)) {
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
            BasEtpItmCod,
            BasEtpItmDca,
            BasEtpItmBlq
        )
        VALUES
        (
            :BasEtpCod,    
            :BasEtpItmCod,
            :BasEtpItmDca,
            :BasEtpItmBlq
        )
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod,
            ':BasEtpItmCod' => $this->attBasEtpItmCod,
            ':BasEtpItmDca' => $this->attBasEtpItmDca,
            ':BasEtpItmBlq' => $this->attBasEtpItmBlq
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
            BasEtpItmDca = :BasEtpItmDca,
            BasEtpItmBlq = :BasEtpItmBlq
        WHERE
            BasEtpCod = :BasEtpCod
        AND BasEtpItmCod = :BasEtpItmCod
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod,
            ':BasEtpItmCod' => $this->attBasEtpItmCod,
            ':BasEtpItmDca' => $this->attBasEtpItmDca,
            ':BasEtpItmBlq' => $this->attBasEtpItmBlq
        );
        
        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return boolval($rows);
    }

    public function deleteLine()
    {
        if (!$this->check_referencial_key()) {
            return FALSE;
        }

        $qry = "
        DELETE FROM
        " . $this->tbl . "
        WHERE
            BasEtpCod = :BasEtpCod
        AND BasEtpItmCod = :BasEtpItmCod
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod,
            ':BasEtpItmCod' => $this->attBasEtpItmCod
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
            BasEtpCod,
            BasEtpItmCod
        FROM
        " . $this->tbl . "
        WHERE 
            BasEtpCod = :BasEtpCod
        ORDER BY
            BasEtpCod asc, BasEtpItmCod desc
        LIMIT 1
        ";

        $parameters = array(
            ':BasEtpCod' => $this->attBasEtpCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->attBasEtpItmCod = (1 + $row['BasEtpItmCod']);
        } else {
            $this->attBasEtpItmCod = 1;
        }
    }

    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            BasEtpItmCod
        FROM
        " . $this->tbl . "
        WHERE
            BasEtpCod = :BasEtpCod
        AND BasEtpItmCod = :BasEtpItmCod
        ";

        $parameters = array(
            ":BasEtpCod" => $this->attBasEtpCod,
            ":BasEtpItmCod" => $this->attBasEtpItmCod
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
}
