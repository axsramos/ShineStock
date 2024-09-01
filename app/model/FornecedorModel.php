<?php

namespace app\model;

use app\core\Database;
use app\shared\MessageDictionary;
use PDO;

class FornecedorModel
{
    private $attCmpFncCod;
    private $attCmpFncDca;
    private $attCmpFncDsc;
    private $attCmpFncBlq;
    private $attCmpFncObs;

    // -- database -- //
    private $cnx;
    private $tbl = 'CmpFnc';

    private $csMessage;
    public $messages = array();
    public $data_row = array();

    public function __construct()
    {
        $this->cnx = new Database();
        $this->csMessage = new MessageDictionary;
    }

    // -- get -- //
    public function getCmpFncCod()
    {
        return $this->attCmpFncCod;
    }
    public function getCmpFncDca()
    {
        return $this->attCmpFncDca;
    }
    public function getCmpFncDsc()
    {
        return $this->attCmpFncDsc;
    }
    public function getCmpFncBlq()
    {
        return $this->attCmpFncBlq;
    }
    public function getCmpFncObs()
    {
        return $this->attCmpFncObs;
    }

    // -- set -- //
    public function setCmpFncCod($inCmpFncCod)
    {
        $this->attCmpFncCod = $inCmpFncCod;
    }
    public function setCmpFncDca($inCmpFncDca)
    {
        $this->attCmpFncDca = $inCmpFncDca;
    }
    public function setCmpFncDsc($inCmpFncDsc)
    {
        $this->attCmpFncDsc = htmlspecialchars($inCmpFncDsc);
    }
    public function setCmpFncBlq($inCmpFncBlq)
    {
        $this->attCmpFncBlq = $inCmpFncBlq;
    }
    public function setCmpFncObs($inCmpFncObs)
    {
        $this->attCmpFncObs = htmlspecialchars($inCmpFncObs);
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CmpFncCod,
            CmpFncDca,
            CmpFncDsc,
            CmpFncBlq,
            CmpFncObs
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
            CmpFncCod,
            CmpFncDca,
            CmpFncDsc,
            CmpFncBlq,
            CmpFncObs
        FROM
        " . $this->tbl . "
        WHERE
            CmpFncCod = :CmpFncCod
        ";

        $parameters = array(
            ":CmpFncCod" => $this->attCmpFncCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCmpFncCod = $this->data_row['CmpFncCod'];
            $this->attCmpFncDca = $this->data_row['CmpFncDca'];
            $this->attCmpFncDsc = $this->data_row['CmpFncDsc'];
            $this->attCmpFncBlq = $this->data_row['CmpFncBlq'];
            $this->attCmpFncObs = $this->data_row['CmpFncObs'];
        }

        return boolval($rows);
    }

    public function insertLine()
    {
        if (empty($this->attCmpFncCod)) {
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
            CmpFncCod,
            CmpFncDca,
            CmpFncDsc,
            CmpFncBlq,
            CmpFncObs
        )
        VALUES
        (
            :CmpFncCod,
            :CmpFncDca,
            :CmpFncDsc,
            :CmpFncBlq,
            :CmpFncObs
        )
        ";

        $parameters = array(
            ':CmpFncCod' => $this->attCmpFncCod,
            ':CmpFncDca' => $this->attCmpFncDca,
            ':CmpFncDsc' => $this->attCmpFncDsc,
            ':CmpFncBlq' => $this->attCmpFncBlq,
            ':CmpFncObs' => $this->attCmpFncObs
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
            CmpFncDca = :CmpFncDca,
            CmpFncDsc = :CmpFncDsc,
            CmpFncBlq = :CmpFncBlq,
            CmpFncObs = :CmpFncObs
        WHERE
            CmpFncCod = :CmpFncCod
        ";

        $parameters = array(
            ':CmpFncCod' => $this->attCmpFncCod,
            ':CmpFncDca' => $this->attCmpFncDca,
            ':CmpFncDsc' => $this->attCmpFncDsc,
            ':CmpFncBlq' => $this->attCmpFncBlq,
            ':CmpFncObs' => $this->attCmpFncObs
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
            CmpFncCod = :CmpFncCod
        ";

        $parameters = array(
            ':CmpFncCod' => $this->attCmpFncCod
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
            CmpFncCod
        FROM
        " . $this->tbl . "
        ORDER BY
            CmpFncCod desc
        LIMIT 1
        ";

        $stmt = $this->cnx->executeQuery($qry);
        $rows = $stmt->rowCount();

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->attCmpFncCod = (1 + $row['CmpFncCod']);
        } else {
            $this->attCmpFncCod = 1;
        }
    }

    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            CmpFncCod
        FROM
        " . $this->tbl . "
        WHERE
            CmpFncCod = :CmpFncCod
        ";

        $parameters = array(
            ":CmpFncCod" => $this->attCmpFncCod
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
        // CmpFncItm
        // WHERE
        //     CmpFncCod = :CmpFncCod
        // ";

        // $parameters = array(
        //     ':CmpFncCod' => $this->attCmpFncCod
        // );

        // $stmt = $this->cnx->executeQuery($qry, $parameters);
    }
}
