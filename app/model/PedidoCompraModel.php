<?php

namespace app\model;

use app\core\Database;
use app\shared\MessageDictionary;
use PDO;

class PedidoCompraModel
{
    private $attCmpPncCod;
    private $attCmpPncDca;
    private $attCmpPncDsc;
    private $attCmpPncEtp;
    private $attBasEtpDsc;
    private $attBasEtpGrp;
    private $attCmpPncUsr;
    private $attCmpPncObs;

    // -- database -- //
    private $cnx;
    private $tbl = 'CmpPnc';

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
    public function getCmpPncDca()
    {
        return $this->attCmpPncDca;
    }
    public function getCmpPncDsc()
    {
        return $this->attCmpPncDsc;
    }
    public function getCmpPncEtp()
    {
        return $this->attCmpPncEtp;
    }
    public function getBasEtpDsc()
    {
        return $this->attBasEtpDsc;
    }
    public function getBasEtpGrp()
    {
        return $this->attBasEtpGrp;
    }
    public function getCmpPncUsr()
    {
        return $this->attCmpPncUsr;
    }
    public function getCmpPncObs()
    {
        return $this->attCmpPncObs;
    }

    // -- set -- //
    public function setCmpPncCod($inCmpPncCod)
    {
        $this->attCmpPncCod = $inCmpPncCod;
    }
    public function setCmpPncDca($inCmpPncDca)
    {
        $this->attCmpPncDca = $inCmpPncDca;
    }
    public function setCmpPncDsc($inCmpPncDsc)
    {
        $this->attCmpPncDsc = htmlspecialchars($inCmpPncDsc);
    }
    public function setCmpPncEtp($inCmpPncEtp)
    {
        $this->attCmpPncEtp = $inCmpPncEtp;
    }
    public function setCmpPncUsr($inCmpPncUsr)
    {
        $this->attCmpPncUsr = $inCmpPncUsr;
    }
    public function setCmpPncObs($inCmpPncObs)
    {
        $this->attCmpPncObs = htmlspecialchars($inCmpPncObs);
    }

    // -- crud -- //
    public function readAllLines()
    {
        $qry = "
        SELECT
            CmpPncCod,
            CmpPncDca,
            CmpPncDsc,
            CmpPncEtp,
            BasEtp.BasEtpDsc as BasEtpDsc,
            BasEtp.BasEtpGrp as BasEtpGrp,
            CmpPncUsr,
            CmpPncObs
        FROM
        " . $this->tbl . "
        INNER JOIN BasEtp
        ON BasEtp.BasEtpCod = CmpPnc.CmpPncEtp
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
            CmpPncCod,
            CmpPncDca,
            CmpPncDsc,
            CmpPncEtp,
            BasEtp.BasEtpDsc as BasEtpDsc,
            BasEtp.BasEtpGrp as BasEtpGrp,
            CmpPncUsr,
            CmpPncObs
        FROM
        " . $this->tbl . "
        INNER JOIN BasEtp
        ON BasEtp.BasEtpCod = CmpPnc.CmpPncEtp
        WHERE
            CmpPncCod = :CmpPncCod
        ";

        $parameters = array(
            ":CmpPncCod" => $this->attCmpPncCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        if ($rows) {
            $this->data_row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCmpPncCod = $this->data_row['CmpPncCod'];
            $this->attCmpPncDca = $this->data_row['CmpPncDca'];
            $this->attCmpPncDsc = $this->data_row['CmpPncDsc'];
            $this->attCmpPncEtp = $this->data_row['CmpPncEtp'];
            $this->attBasEtpDsc = $this->data_row['BasEtpDsc'];
            $this->attBasEtpGrp = $this->data_row['BasEtpGrp'];
            $this->attCmpPncUsr = $this->data_row['CmpPncUsr'];
            $this->attCmpPncObs = $this->data_row['CmpPncObs'];
        }

        return boolval($rows);
    }

    public function insertLine()
    {
        if (empty($this->attCmpPncCod)) {
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
            CmpPncCod,
            CmpPncDca,
            CmpPncDsc,
            CmpPncEtp,
            CmpPncUsr,
            CmpPncObs
        )
        VALUES
        (
            :CmpPncCod,
            :CmpPncDca,
            :CmpPncDsc,
            :CmpPncEtp,
            :CmpPncUsr,
            :CmpPncObs
        )
        ";

        $parameters = array(
            ':CmpPncCod' => $this->attCmpPncCod,
            ':CmpPncDca' => $this->attCmpPncDca,
            ':CmpPncDsc' => $this->attCmpPncDsc,
            ':CmpPncEtp' => $this->attCmpPncEtp,
            ':CmpPncUsr' => $this->attCmpPncUsr,
            ':CmpPncObs' => $this->attCmpPncObs
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
            CmpPncDca = :CmpPncDca,
            CmpPncDsc = :CmpPncDsc,
            CmpPncEtp = :CmpPncEtp,
            CmpPncUsr = :CmpPncUsr,
            CmpPncObs = :CmpPncObs
        WHERE
            CmpPncCod = :CmpPncCod
        ";

        $parameters = array(
            ':CmpPncCod' => $this->attCmpPncCod,
            ':CmpPncDca' => $this->attCmpPncDca,
            ':CmpPncDsc' => $this->attCmpPncDsc,
            ':CmpPncEtp' => $this->attCmpPncEtp,
            ':CmpPncUsr' => $this->attCmpPncUsr,
            ':CmpPncObs' => $this->attCmpPncObs
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
        ";

        $parameters = array(
            ':CmpPncCod' => $this->attCmpPncCod
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
            CmpPncCod
        FROM
        " . $this->tbl . "
        ORDER BY
            CmpPncCod desc
        LIMIT 1
        ";

        $stmt = $this->cnx->executeQuery($qry);
        $rows = $stmt->rowCount();

        if ($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->attCmpPncCod = (1 + $row['CmpPncCod']);
        } else {
            $this->attCmpPncCod = 1;
        }
    }

    private function check_duplicate_key()
    {
        $qry = "
        SELECT
            CmpPncCod
        FROM
        " . $this->tbl . "
        WHERE
            CmpPncCod = :CmpPncCod
        ";

        $parameters = array(
            ":CmpPncCod" => $this->attCmpPncCod
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
        // CmpPncItm
        // WHERE
        //     CmpPncCod = :CmpPncCod
        // ";

        // $parameters = array(
        //     ':CmpPncCod' => $this->attCmpPncCod
        // );

        // $stmt = $this->cnx->executeQuery($qry, $parameters);
    }
}
