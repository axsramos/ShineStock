<?php

namespace app\model;

use app\core\Database;
use app\shared\MessageDictionary;
use PDO;

class MateriaPrimaModel
{
    private $attCmpMprCod;
    private $attCmpMprDca;
    private $attCmpMprDsc;
    private $attCmpMprBlq;
    private $attCmpMprObs;

    // -- database -- //
    private $cnx;
    private $tbl = 'CmpMpr';

    private $csMessage;
    public $messages = array();
    public $data_row = array();

    public function __construct()
    {
        $this->cnx = new Database();
        $this->csMessage = new MessageDictionary;
    }

    // -- get -- //
    public function getCmpMprCod()
    {
        return $this->attCmpMprCod;
    }
    public function getCmpMprDca()
    {
        return $this->attCmpMprDca;
    }
    public function getCmpMprDsc()
    {
        return $this->attCmpMprDsc;
    }
    public function getCmpMprBlq()
    {
        return $this->attCmpMprBlq;
    }
    public function getCmpMprObs()
    {
        return $this->attCmpMprObs;
    }

    // -- set -- //
    public function setCmpMprCod($inCmpMprCod)
    {
        $this->attCmpMprCod = $inCmpMprCod;
    }
    public function setCmpMprDca($inCmpMprDca)
    {
        $this->attCmpMprDca = $inCmpMprDca;
    }
    public function setCmpMprDsc($inCmpMprDsc)
    {
        $this->attCmpMprDsc = htmlspecialchars($inCmpMprDsc);
    }
    public function setCmpMprBlq($inCmpMprBlq)
    {
        $this->attCmpMprBlq = $inCmpMprBlq;
    }
    public function setCmpMprObs($inCmpMprObs)
    {
        $this->attCmpMprObs = htmlspecialchars($inCmpMprObs);
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CmpMprCod,
            CmpMprDca,
            CmpMprDsc,
            CmpMprBlq,
            CmpMprObs
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
            CmpMprCod,
            CmpMprDca,
            CmpMprDsc,
            CmpMprBlq,
            CmpMprObs
        FROM
        " . $this->tbl . "
        WHERE
            CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ":CmpMprCod" => $this->attCmpMprCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCmpMprCod = $this->data_row['CmpMprCod'];
            $this->attCmpMprDca = $this->data_row['CmpMprDca'];
            $this->attCmpMprDsc = $this->data_row['CmpMprDsc'];
            $this->attCmpMprBlq = $this->data_row['CmpMprBlq'];
            $this->attCmpMprObs = $this->data_row['CmpMprObs'];
        }

        return boolval($rows);
    }

    public function insertLine()
    {
        if (empty($this->attCmpMprCod)) {
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
            CmpMprCod,
            CmpMprDca,
            CmpMprDsc,
            CmpMprBlq,
            CmpMprObs
        )
        VALUES
        (
            :CmpMprCod,
            :CmpMprDca,
            :CmpMprDsc,
            :CmpMprBlq,
            :CmpMprObs
        )
        ";

        $parameters = array(
            ':CmpMprCod' => $this->attCmpMprCod,
            ':CmpMprDca' => $this->attCmpMprDca,
            ':CmpMprDsc' => $this->attCmpMprDsc,
            ':CmpMprBlq' => $this->attCmpMprBlq,
            ':CmpMprObs' => $this->attCmpMprObs
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
            CmpMprDca = :CmpMprDca,
            CmpMprDsc = :CmpMprDsc,
            CmpMprBlq = :CmpMprBlq,
            CmpMprObs = :CmpMprObs
        WHERE
            CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ':CmpMprCod' => $this->attCmpMprCod,
            ':CmpMprDca' => $this->attCmpMprDca,
            ':CmpMprDsc' => $this->attCmpMprDsc,
            ':CmpMprBlq' => $this->attCmpMprBlq,
            ':CmpMprObs' => $this->attCmpMprObs
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
            CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ':CmpMprCod' => $this->attCmpMprCod
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
            CmpMprCod
        FROM
        " . $this->tbl . "
        ORDER BY
            CmpMprCod desc
        LIMIT 1
        ";

        $stmt = $this->cnx->executeQuery($qry);
        $rows = $stmt->rowCount();

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->attCmpMprCod = (1 + $row['CmpMprCod']);
        } else {
            $this->attCmpMprCod = 1;
        }
    }

    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            CmpMprCod
        FROM
        " . $this->tbl . "
        WHERE
            CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ":CmpMprCod" => $this->attCmpMprCod
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
        // $qry = "
        // DELETE FROM
        // CmpMprItm
        // WHERE
        //     CmpMprCod = :CmpMprCod
        // ";

        // $parameters = array(
        //     ':CmpMprCod' => $this->attCmpMprCod
        // );

        // $stmt = $this->cnx->executeQuery($qry, $parameters);
    }
}
