<?php
/**
 * Class ModelAzienda
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione relative alla tabella "Azienda".
 */
class ModelAzienda {

    //_________________________________
    // Variabili private da valorizzare.
    /**
     * @var
     * $rsoc: Ragione Sociale
     * $ctu: Nome e Cognome del CTU
     * $indi: Indirizzo dell'azienda
     * $cap: numero CAP
     * $citta: città in cui si trova l'azienda
     * $tele: telefono
     * $cell: cellulare
     * $fax: numero di fax
     * $email: indirizzo di posta
     * $piva: partita iva
     * $rea: numero rea dell'azienda
     * $def: default (se settato a 1 viene considerato nella visualizzazione a video)
     */
    private $rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def;

    /**
     * @return mixed
     */
    public function getRsoc()
    {
        return $this->rsoc;
    }

    /**
     * @param mixed $rsoc
     */
    public function setRsoc($rsoc)
    {
        $this->rsoc = $rsoc;
    }

    /**
     * @return mixed
     */
    public function getCtu()
    {
        return $this->ctu;
    }

    /**
     * @param mixed $ctu
     */
    public function setCtu($ctu)
    {
        $this->ctu = $ctu;
    }

    /**
     * @return mixed
     */
    public function getIndi()
    {
        return $this->indi;
    }

    /**
     * @param mixed $indi
     */
    public function setIndi($indi)
    {
        $this->indi = $indi;
    }

    /**
     * @return mixed
     */
    public function getCap()
    {
        return $this->cap;
    }

    /**
     * @param mixed $cap
     */
    public function setCap($cap)
    {
        $this->cap = $cap;
    }

    /**
     * @return mixed
     */
    public function getCitta()
    {
        return $this->citta;
    }

    /**
     * @param mixed $citta
     */
    public function setCitta($citta)
    {
        $this->citta = $citta;
    }

    /**
     * @return mixed
     */
    public function getTele()
    {
        return $this->tele;
    }

    /**
     * @param mixed $tele
     */
    public function setTele($tele)
    {
        $this->tele = $tele;
    }

    /**
     * @return mixed
     */
    public function getCell()
    {
        return $this->cell;
    }

    /**
     * @param mixed $cell
     */
    public function setCell($cell)
    {
        $this->cell = $cell;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPiva()
    {
        return $this->piva;
    }

    /**
     * @param mixed $piva
     */
    public function setPiva($piva)
    {
        $this->piva = $piva;
    }

    /**
     * @return mixed
     */
    public function getRea()
    {
        return $this->rea;
    }

    /**
     * @param mixed $rea
     */
    public function setRea($rea)
    {
        $this->rea = $rea;
    }

    /**
     * @return mixed
     */
    public function getDef()
    {
        return $this->def;
    }

    /**
     * @param mixed $def
     */
    public function setDef($def)
    {
        $this->def = $def;
    }

    /**
     * @param $id
     * Seleziona l'azienda
     */
    public function select_azienda($id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // PREPARE SQL
        $sql = $conn->prepare("SELECT * FROM azienda WHERE id = :id");

        // BINDING PARAMETERS
        $sql->bindParam(':id', $id);

        // EXECUTE SQL
        $sql->execute();

        while ($row = $sql->fetch()) {

            $this->setRsoc($row['rsoc']);
            $this->setCtu($row['ctu']);
            $this->setIndi($row['indi']);
            $this->setCap($row['cap']);
            $this->setCitta($row['citta']);
            $this->setTele($row['tele']);
            $this->setCell($row['cell']);
            $this->setFax($row['fax']);
            $this->setMail($row['mail']);
            $this->setPiva($row['piva']);
            $this->setRea($row['rea']);
            $this->setDef($row['def']);
        }
    }

    /**
     * Seleziona l'azienda di DEFAULT (da considerare per la visualizzazione e le stampe)
     */
    public function select_azienda_default()
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM azienda WHERE def = 1");
        $sql->execute();

        while ($row = $sql->fetch()) {

            $this->setRsoc($row['rsoc']);
            $this->setCtu($row['ctu']);
            $this->setIndi($row['indi']);
            $this->setCap($row['cap']);
            $this->setCitta($row['citta']);
            $this->setTele($row['tele']);
            $this->setCell($row['cell']);
            $this->setFax($row['fax']);
            $this->setMail($row['mail']);
            $this->setPiva($row['piva']);
            $this->setRea($row['rea']);
            $this->setDef($row['def']);
        }
    }

    /**
     * @return array
     * Seleziona tutte le aziende
     */
    public function select_aziende()
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM azienda");
        $sql->execute();
        $res = array();
        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $res[] = array(
                "id" => $row['id'],
                "rsoc" => $row['rsoc'],
                "ctu" => $row['ctu'],
                "indi" => $row['indi'],
                "cap" => $row['cap'],
                "citta" => $row['citta'],
                "tele" => $row['tele'],
                "cell" => $row['cell'],
                "fax" => $row['fax'],
                "mail" => $row['mail'],
                "piva" => $row['piva'],
                "rea" => $row['rea'],
                "def" => $row['def']);
        }

        return $res;
    }

    /**
     * @param $rsoc: ragione sociale
     * @param $ctu: nome e cognome CTU
     * @param $indi: indirizzo dell'azienda
     * @param $cap: numero cap
     * @param $citta: città dell'azienda
     * @param $tele: telefono
     * @param $cell: cellulare
     * @param $fax: numero fax
     * @param $mail: indirizzo mail
     * @param $piva: partita iva
     * @param $rea: numero rea
     * @param $def: default (se settato a 1 viene considerata tale azienda per la visualizzazione e la stampa)
     * Inserisce una nuova azienda.
     */
    public function insert_azienda($rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO azienda (rsoc, ctu, indi, cap, citta, tele, cell, fax, mail, piva, rea, def) VALUES (:rsoc, :ctu, :indi, :cap, :citta, :tele, :cell, :fax, :mail, :piva, :rea, :def)");

        // BIND PARAMETERS
        $sql->bindParam(':rsoc', $rsoc, PDO::PARAM_STR);
        $sql->bindParam(':ctu', $ctu, PDO::PARAM_STR);
        $sql->bindParam(':indi', $indi, PDO::PARAM_STR);
        $sql->bindParam(':cap', $cap, PDO::PARAM_STR);
        $sql->bindParam(':citta', $citta, PDO::PARAM_STR);
        $sql->bindParam(':tele', $tele, PDO::PARAM_STR);
        $sql->bindParam(':cell', $cell, PDO::PARAM_STR);
        $sql->bindParam(':fax', $fax, PDO::PARAM_STR);
        $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
        $sql->bindParam(':piva', $piva, PDO::PARAM_STR);
        $sql->bindParam(':rea', $rea, PDO::PARAM_STR);
        $sql->bindParam(':def', $def, PDO::PARAM_INT);

        // EXECUTE SQL
        $sql->execute();
    }

    /**
     * @param $rsoc: ragione sociale
     * @param $ctu: nome e cognome CTU
     * @param $indi: indirizzo dell'azienda
     * @param $cap: numero cap
     * @param $citta: città dell'azienda
     * @param $tele: telefono
     * @param $cell: cellulare
     * @param $fax: numero fax
     * @param $mail: indirizzo mail
     * @param $piva: partita iva
     * @param $rea: numero rea
     * @param $def: default (se settato a 1 viene considerata tale azienda per la visualizzazione e la stampa)
     */
    public function update_azienda($id, $rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE azienda SET rsoc = :rsoc, ctu = :ctu, indi = :indi, cap = :cap, citta = :citta, tele = :tele, cell = :cell, fax = :fax, mail = :mail, piva = :piva, rea = :rea, def = :def  WHERE id = :id");

        //BIND PARAMETERS
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->bindParam(':rsoc', $rsoc, PDO::PARAM_STR);
        $sql->bindParam(':ctu', $ctu, PDO::PARAM_STR);
        $sql->bindParam(':indi', $indi, PDO::PARAM_STR);
        $sql->bindParam(':cap', $cap, PDO::PARAM_STR);
        $sql->bindParam(':citta', $citta, PDO::PARAM_STR);
        $sql->bindParam(':tele', $tele, PDO::PARAM_STR);
        $sql->bindParam(':cell', $cell, PDO::PARAM_STR);
        $sql->bindParam(':fax', $fax, PDO::PARAM_STR);
        $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
        $sql->bindParam(':piva', $piva, PDO::PARAM_STR);
        $sql->bindParam(':rea', $rea, PDO::PARAM_STR);
        $sql->bindParam(':def', $def, PDO::PARAM_INT);

        // EXECUTE SQL
        $sql->execute();
    }

    /**
     * @param $id
     * Elimina un'azienda
     */
    public function delete_azienda($id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from azienda WHERE id = :id");

        // BIND PARAMETERS
        $sql->bindParam(':id', $id, PDO::PARAM_INT);

        // EXECUTE SQL
        $sql->execute();
    }

}
