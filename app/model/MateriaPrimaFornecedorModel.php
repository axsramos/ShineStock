<?php

namespace app\model;

use app\core\Database;
use app\shared\MessageDictionary;
use PDO;

class MateriaPrimaFornecedorModel
{
    private $attCmpFncCod;
    private $attCmpMprCod;
    private $attCmpMpfDca;
    private $attCmpMpfDsc;
    private $attCmpMpfBlq;
    private $attCmpMpfObs;

    // -- database -- //
    private $cnx;
    private $tbl = 'CmpMpf';

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
    public function getCmpMprCod()
    {
        return $this->attCmpMprCod;
    }
    public function getCmpMpfDca()
    {
        return $this->attCmpMpfDca;
    }
    public function getCmpMpfDsc()
    {
        return $this->attCmpMpfDsc;
    }
    public function getCmpMpfBlq()
    {
        return $this->attCmpMpfBlq;
    }
    public function getCmpMpfObs()
    {
        return $this->attCmpMpfObs;
    }

    // -- set -- //
    public function setCmpFncCod($inCmpFncCod)
    {
        $this->attCmpFncCod = $inCmpFncCod;
    }
    public function setCmpMprCod($inCmpMprCod)
    {
        $this->attCmpMprCod = $inCmpMprCod;
    }
    public function setCmpMpfDca($inCmpMpfDca)
    {
        $this->attCmpMpfDca = $inCmpMpfDca;
    }
    public function setCmpMpfDsc($inCmpMpfDsc)
    {
        $this->attCmpMpfDsc = htmlspecialchars($inCmpMpfDsc);
    }
    public function setCmpMpfBlq($inCmpMpfBlq)
    {
        $this->attCmpMpfBlq = $inCmpMpfBlq;
    }
    public function setCmpMpfObs($inCmpMpfObs)
    {
        $this->attCmpMpfObs = htmlspecialchars($inCmpMpfObs);
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CmpFncCod,
            CmpMprCod,
            CmpMpfDca,
            CmpMpfDsc,
            CmpMpfBlq,
            CmpMpfObs
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
            CmpMprCod,
            CmpMpfDca,
            CmpMpfDsc,
            CmpMpfBlq,
            CmpMpfObs
        FROM
        " . $this->tbl . "
        WHERE
            CmpFncCod = :CmpFncCod
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ":CmpFncCod" => $this->attCmpFncCod,
            ":CmpMprCod" => $this->attCmpMprCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCmpFncCod = $this->data_row['CmpFncCod'];
            $this->attCmpMprCod = $this->data_row['CmpMprCod'];
            $this->attCmpMpfDca = $this->data_row['CmpMpfDca'];
            $this->attCmpMpfDsc = $this->data_row['CmpMpfDsc'];
            $this->attCmpMpfBlq = $this->data_row['CmpMpfBlq'];
            $this->attCmpMpfObs = $this->data_row['CmpMpfObs'];
        }

        return boolval($rows);
    }

    public function insertLine()
    {
        if (!$this->check_duplicate_key()) {
            return FALSE;
        }
        
        $qry = "
        INSERT INTO
        " . $this->tbl . "
        (
            CmpFncCod,    
            CmpMprCod,
            CmpMpfDca,
            CmpMpfDsc,
            CmpMpfBlq,
            CmpMpfObs
        )
        VALUES
        (
            :CmpFncCod,
            :CmpMprCod,
            :CmpMpfDca,
            :CmpMpfDsc,
            :CmpMpfBlq,
            :CmpMpfObs
        )
        ";

        $parameters = array(
            ':CmpFncCod' => $this->attCmpFncCod,
            ':CmpMprCod' => $this->attCmpMprCod,
            ':CmpMpfDca' => $this->attCmpMpfDca,
            ':CmpMpfDsc' => $this->attCmpMpfDsc,
            ':CmpMpfBlq' => $this->attCmpMpfBlq,
            ':CmpMpfObs' => $this->attCmpMpfObs
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
            CmpMpfDca = :CmpMpfDca,
            CmpMpfDsc = :CmpMpfDsc,
            CmpMpfBlq = :CmpMpfBlq,
            CmpMpfObs = :CmpMpfObs
        WHERE
            CmpFncCod = :CmpFncCod
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ':CmpFncCod' => $this->attCmpFncCod,
            ':CmpMprCod' => $this->attCmpMprCod,
            ':CmpMpfDca' => $this->attCmpMpfDca,
            ':CmpMpfDsc' => $this->attCmpMpfDsc,
            ':CmpMpfBlq' => $this->attCmpMpfBlq,
            ':CmpMpfObs' => $this->attCmpMpfObs
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
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ':CmpFncCod' => $this->attCmpFncCod,
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
            CmpFncCod,
            CmpMprCod
        FROM
        " . $this->tbl . "
        ORDER BY
            CmpFncCod asc, CmpMprCod desc
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
            CmpFncCod,
            CmpMprCod
        FROM
        " . $this->tbl . "
        WHERE
            CmpFncCod = :CmpFncCod
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ":CmpFncCod" => $this->attCmpFncCod,
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
        // CmpMpfItm
        // WHERE
        //     CmpMprCod = :CmpMprCod
        // ";

        // $parameters = array(
        //     ':CmpMprCod' => $this->attCmpMprCod
        // );

        // $stmt = $this->cnx->executeQuery($qry, $parameters);
    }

    public function readAllLinesMateriaPrimaSelection($inCmpFncCod)
    {
        $qry = "
        SELECT
            CmpMprCod,
            CmpMprDca,
            CmpMprDsc,
            CmpMprBlq,
            CmpMprObs
        FROM
            CmpMpr
        WHERE
            NOT EXISTS(
            SELECT CmpMprCod FROM CmpMpf 
            WHERE CmpMpf.CmpMprCod = CmpMpr.CmpMprCod
              AND CmpMpf.CmpFnCcod in(:CmpFncCod)
            )
        ";

        $parameters = array(
            ":CmpFncCod" => $inCmpFncCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();
        $allLines = false;

        if ($rows) {
            $allLines = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $allLines;
    }
}
