<?php

namespace app\model;

use app\core\Database;
use app\shared\MessageDictionary;
use PDO;

class MateriaPrimaPedidoCompraModel
{
    private $attCmpPncCod;
    private $attCmpMprCod;
    private $attCmpPncMprDca;
    private $attCmpPncMprQtd;

    // -- database -- //
    private $cnx;
    private $tbl = 'CmpPncMpr';

    private $csMessage;
    public $messages = array();
    public $data_row = array();

    public function __construct()
    {
        $this->cnx = new Database();
        $this->csMessage = new MessageDictionary;
    }

    // -- get -- //
    public function getCmpPncCod()
    {
        return $this->attCmpPncCod;
    }
    public function getCmpMprCod()
    {
        return $this->attCmpMprCod;
    }
    public function getCmpPncMprDca()
    {
        return $this->attCmpPncMprDca;
    }
    public function getCmpPncMprQtd()
    {
        return $this->attCmpPncMprQtd;
    }

    // -- set -- //
    public function setCmpPncCod($inCmpPncCod)
    {
        $this->attCmpPncCod = $inCmpPncCod;
    }
    public function setCmpMprCod($inCmpMprCod)
    {
        $this->attCmpMprCod = $inCmpMprCod;
    }
    public function setCmpPncMprDca($inCmpPncMprDca)
    {
        $this->attCmpPncMprDca = $inCmpPncMprDca;
    }
    public function setCmpPncMprQtd($inCmpPncMprQtd)
    {
        $this->attCmpPncMprQtd = htmlspecialchars($inCmpPncMprQtd);
    }
    
    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CmpPncCod,
            CmpMpr.CmpMprCod as CmpMprCod,
            CmpMpr.CmpMprDsc as CmpMprDsc,
            CmpPncMprDca,
            CmpPncMprQtd
        FROM
        " . $this->tbl . "
        INNER JOIN CmpMpr
        ON CmpMpr.CmpMprCod = CmpPncMpr.CmpMprCod
        WHERE
            CmpPncCod = :CmpPncCod
        ";

        $parameters = array(
            ":CmpPncCod" => $this->attCmpPncCod
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
            CmpPncCod,
            CmpMpr.CmpMprCod as CmpMprCod,
            CmpMpr.CmpMprDsc as CmpMprDsc,
            CmpPncMprDca,
            CmpPncMprQtd
        FROM
        " . $this->tbl . "
        INNER JOIN CmpMpr
        ON CmpMpr.CmpMprCod = CmpPncMpr.CmpMprCod
        WHERE
            CmpPncCod = :CmpPncCod
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ":CmpPncCod" => $this->attCmpPncCod,
            ":CmpMprCod" => $this->attCmpMprCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCmpPncCod = $this->data_row['CmpPncCod'];
            $this->attCmpMprCod = $this->data_row['CmpMprCod'];
            $this->attCmpPncMprDca = $this->data_row['CmpPncMprDca'];
            $this->attCmpPncMprQtd = $this->data_row['CmpPncMprQtd'];
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
            CmpPncCod,    
            CmpMprCod,
            CmpPncMprDca,
            CmpPncMprQtd
        )
        VALUES
        (
            :CmpPncCod,
            :CmpMprCod,
            :CmpPncMprDca,
            :CmpPncMprQtd
        )
        ";

        $parameters = array(
            ':CmpPncCod' => $this->attCmpPncCod,
            ':CmpMprCod' => $this->attCmpMprCod,
            ':CmpPncMprDca' => $this->attCmpPncMprDca,
            ':CmpPncMprQtd' => $this->attCmpPncMprQtd
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
            CmpPncMprDca = :CmpPncMprDca,
            CmpPncMprQtd = :CmpPncMprQtd
        WHERE
            CmpPncCod = :CmpPncCod
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ':CmpPncCod' => $this->attCmpPncCod,
            ':CmpMprCod' => $this->attCmpMprCod,
            ':CmpPncMprDca' => $this->attCmpPncMprDca,
            ':CmpPncMprQtd' => $this->attCmpPncMprQtd
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
            CmpPncCod = :CmpPncCod
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ':CmpPncCod' => $this->attCmpPncCod,
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
            CmpPncCod,
            CmpMprCod
        FROM
        " . $this->tbl . "
        ORDER BY
            CmpPncCod asc, CmpMprCod desc
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
            CmpPncCod,
            CmpMprCod
        FROM
        " . $this->tbl . "
        WHERE
            CmpPncCod = :CmpPncCod
        AND CmpMprCod = :CmpMprCod
        ";

        $parameters = array(
            ":CmpPncCod" => $this->attCmpPncCod,
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
        // CmpPncMprItm
        // WHERE
        //     CmpMprCod = :CmpMprCod
        // ";

        // $parameters = array(
        //     ':CmpMprCod' => $this->attCmpMprCod
        // );

        // $stmt = $this->cnx->executeQuery($qry, $parameters);
    }

    public function readAllLinesMateriaPrimaSelection($inCmpPncCod)
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
            SELECT CmpMprCod FROM CmpPncMpr 
            WHERE CmpPncMpr.CmpMprCod = CmpMpr.CmpMprCod
              AND CmpPncMpr.CmpPnccod in(:CmpPncCod)
            )
        ";

        $parameters = array(
            ":CmpPncCod" => $inCmpPncCod
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
