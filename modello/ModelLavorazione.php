<?php

/**
 * Class ModelLavorazione
 * La classe gestisce le operazioni di inserimento,  modifica, eliminazione degli elementi nella tabella "lavorazione"
 */
class ModelLavorazione {


    /**
     * Variabili di classe corrispondenti ai campi presenti nella tabella "lavorazione"
     */
    private $id,
            $numero,
            $pm,
            $procura,
            $dinizio,
            $gg,
            $dfine,
            $ggrestanti,
            $copia,
            $ftk,
            $ief,
            $analisi,
            $exprep,
            $dim,
            $allegati,
            $liquidazione,
            $progresso,
            $note,
            $diff,
            $operatore;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getPm()
    {
        return $this->pm;
    }

    /**
     * @param mixed $pm
     */
    public function setPm($pm)
    {
        $this->pm = $pm;
    }

    /**
     * @return mixed
     */
    public function getProcura()
    {
        return $this->procura;
    }

    /**
     * @param mixed $procura
     */
    public function setProcura($procura)
    {
        $this->procura = $procura;
    }

    /**
     * @return mixed
     */
    public function getDinizio()
    {
        return $this->dinizio;
    }

    /**
     * @param mixed $dinizio
     */
    public function setDinizio($dinizio)
    {
        $this->dinizio = $dinizio;
    }

    /**
     * @return mixed
     */
    public function getGg()
    {
        return $this->gg;
    }

    /**
     * @param mixed $gg
     */
    public function setGg($gg)
    {
        $this->gg = $gg;
    }

    /**
     * @return mixed
     */
    public function getDfine()
    {
        return $this->dfine;
    }

    /**
     * @param mixed $dfine
     */
    public function setDfine($dfine)
    {
        $this->dfine = $dfine;
    }

    /**
     * @return mixed
     */
    public function getGgrestanti()
    {
        return $this->ggrestanti;
    }

    /**
     * @param mixed $ggrestanti
     */
    public function setGgrestanti($ggrestanti)
    {
        $this->ggrestanti = $ggrestanti;
    }

    /**
     * @return mixed
     */
    public function getCopia()
    {
        return $this->copia;
    }

    /**
     * @param mixed $copia
     */
    public function setCopia($copia)
    {
        $this->copia = $copia;
    }

    /**
     * @return mixed
     */
    public function getFtk()
    {
        return $this->ftk;
    }

    /**
     * @param mixed $ftk
     */
    public function setFtk($ftk)
    {
        $this->ftk = $ftk;
    }

    /**
     * @return mixed
     */
    public function getIef()
    {
        return $this->ief;
    }

    /**
     * @param mixed $ief
     */
    public function setIef($ief)
    {
        $this->ief = $ief;
    }

    /**
     * @return mixed
     */
    public function getAnalisi()
    {
        return $this->analisi;
    }

    /**
     * @param mixed $analisi
     */
    public function setAnalisi($analisi)
    {
        $this->analisi = $analisi;
    }

    /**
     * @return mixed
     */
    public function getExprep()
    {
        return $this->exprep;
    }

    /**
     * @param mixed $exprep
     */
    public function setExprep($exprep)
    {
        $this->exprep = $exprep;
    }

    /**
     * @return mixed
     */
    public function getDim()
    {
        return $this->dim;
    }

    /**
     * @param mixed $dim
     */
    public function setDim($dim)
    {
        $this->dim = $dim;
    }

    /**
     * @return mixed
     */
    public function getAllegati()
    {
        return $this->allegati;
    }

    /**
     * @param mixed $allegati
     */
    public function setAllegati($allegati)
    {
        $this->allegati = $allegati;
    }

    /**
     * @return mixed
     */
    public function getLiquidazione()
    {
        return $this->liquidazione;
    }

    /**
     * @param mixed $liquidazione
     */
    public function setLiquidazione($liquidazione)
    {
        $this->liquidazione = $liquidazione;
    }

    public function getDifficolta()

    {
        return $this->diff;
    }

    public function setDifficolta($diff)

    {
        $this->diff = $diff;
    }

    /**
     * @return mixed
     */
    public function getProgresso()
    {
        return $this->progresso;
    }

    /**
     * @param mixed $progresso
     */
    public function setProgresso($progresso)
    {
        $this->progresso = $progresso;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getOperatore()
    {
        return $this->operatore;
    }

    /**
     * @param mixed $operatore
     */
    public function setOperatore($operatore)
    {
        $this->operatore = $operatore;
    }


    /**
     * Seleziona tutte le lavorazioni
     * @return array
     */
    public function select_all_lavorazione()
    {
        $res = array();
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT id,
                                      numero,
                                      pm,
                                      procura,
                                      DATE_FORMAT(dinizio, '%d-%m-%Y') AS dinizio,
                                      gg,
                                      DATE_FORMAT(dfine, '%d-%m-%Y') AS dfine,
                                      ggrestanti,
                                      copia,
                                      ftk,
                                      ief,
                                      analisi,
                                      exprep,
                                      dim,
                                      allegati,
                                      liquidazione,
                                      difficolta,
                                      progresso,
                                      note,
                                      operatore,
                                      last_upd_ggrestanti FROM lavorazione ORDER BY ggrestanti ASC");
        $sql->execute();

        while ($row = $sql->fetch()) {

            $res[] = array(
                'id' => $row['id'],
                'numero' => $row['numero'],
                'pm' => $row['pm'],
                'procura' => $row['procura'],
                'dinizio' => $row['dinizio'],
                'gg' => $row['gg'],
                'dfine' => $row['dfine'],
                'ggrestanti' => $row['ggrestanti'],
                'copia' => $row['copia'],
                'ftk' => $row['ftk'],
                'ief' => $row['ief'],
                'analisi' => $row['analisi'],
                'exprep' => $row['exprep'],
                'dim' => $row['dim'],
                'allegati' => $row['allegati'],
                'liquidazione' => $row['liquidazione'],
                'progresso' => $row['progresso'],
                'note' => $row['note'],
                'difficolta' => $row['difficolta'],
                'operatore' => $row['operatore'],
                'last_upd_ggrestanti' => $row['last_upd_ggrestanti']);
        }
        return $res;
    }


    /**
     * Seleziona una singola lavorazione
     * @param $id
     */
    public function select_single_lavorazione($id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM lavorazione WHERE id = $id");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {

            $this->setId($row['id']);
            $this->setNumero($row['numero']);
            $this->setPm($row['pm']);
            $this->setProcura($row['procura']);
            $this->setDinizio($row['dinizio']);
            $this->setGg($row['gg']);
            $this->setDfine($row['dfine']);
            $this->setGgrestanti($row['ggrestanti']);
            $this->setCopia($row['copia']);
            $this->setFtk($row['ftk']);
            $this->setIef($row['ief']);
            $this->setAnalisi($row['analisi']);
            $this->setExprep($row['exprep']);
            $this->setDim($row['dim']);
            $this->setAllegati($row['allegati']);
            $this->setLiquidazione($row['liquidazione']);
            $this->setDifficolta($row['difficolta']);
            $this->setProgresso($row['progresso']);
            $this->setNote($row['note']);
            $this->setOperatore($row['operatore']);
        }

    }


    /**
     * Seleziona l'ID dell'ultimo elemento inserito
     */
    public function select_last_inserted()
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT MAX(id) AS id FROM lavorazione");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $this->setId($row['id']);
        }
    }

    /**
     * Calcola la DATA FINE a partire dalla data inizio e aggiungendo i giorni mancanti (giorni della durata dell'incarico conferito dal PM)
     * @param $id
     * @param $gg
     */
    public function calcola_dfine($id, $gg)
    {
            $conn = DbManager::getConnection();
            $sql = $conn->prepare("UPDATE lavorazione SET dfine = DATE_ADD(dinizio, INTERVAL $gg DAY) WHERE id=$id");
            $sql->execute();
    }


    /**
     * Calcola il numero di giorni restanti
     * @param $id
     */
    public function calcola_ggrestanti($id)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();
        //AGGIORNA I GIORNI RESTANTI ALLA SCADENZA DELL'INCARICO
        $sql = $conn->prepare("UPDATE lavorazione SET ggrestanti = DATEDIFF(dfine, NOW()) WHERE id=$id");
        $sql->execute();
        //AGGIORNA I GIORNI RESTANTI < 0 CON 0
        $sql = $conn->prepare("UPDATE lavorazione SET ggrestanti = 0 WHERE id=$id AND ggrestanti < 0");
        $sql->execute();
        //AGGIORNA LA DATA DELL'ULTIMO UPDATE DEL CAMPO GGRESTANTI
        $sql = $conn->prepare("UPDATE lavorazione SET last_upd_ggrestanti = NOW() WHERE id=$id");
        $sql->execute();
    }


    /**
     * La funzione viene impiegata ad ogni accesso alla sezione "lavorazioni" per aggiornare i giorni restanti in caso
     * l'ultimo update sia stato fatto in una data diversa da quella odierna.
     * @param $arr
     */
    public function refresh_ggrestanti_for_all($arr)
    {
        foreach ($arr as $row)
        {
            $id = $row['id'];
            $LastRefresh = $row['last_upd_ggrestanti'];

            //SE L'ULTIMO CALCOLO DEI GIORNI RESTANTI E' DIVERSO DALLA DATA ODIERNA
            if($LastRefresh != date("Y-m-d")){
                $this->calcola_ggrestanti($id);
            }
        }
    }

    /**
     * Calcola il numero di giorni restanti subito dopo l'inserimento di una lavorazione.
     * @param $id
     */
    public function calcola_ggrestanti_after_insert($id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE lavorazione SET ggrestanti = DATEDIFF(dfine, NOW()) WHERE id=$id");
        $sql->execute();
    }


    /**
     * Inserisce una nuova lavorazione nel DB
     * @param string $numero
     * @param string $pm
     * @param string $procura
     * @param date $dinizio
     * @param int $gg
     * @param int $copia
     * @param int $ftk
     * @param int $ief
     * @param int $analisi
     * @param int $exprep: export/report
     * @param int $dim: reportistica
     * @param int $allegati
     * @param int $liquidazione
     * @param int $progresso
     * @param string $note
     * @param int $diff: difficoltà
     * @param string $operatore
     */
    public function insert_lavorazione($numero, $pm, $procura, $dinizio, $gg, $copia, $ftk, $ief, $analisi, $exprep, $dim, $allegati, $liquidazione, $progresso, $note, $diff, $operatore)
    {
        //CONNESSIONA AL DB
        $conn = DbManager::getConnection();

        //PREPARAZIONE ED ESECUZIONE QUERY
        $sql = $conn->prepare("INSERT INTO lavorazione (numero, pm, procura, dinizio, gg, copia, ftk, ief, analisi, exprep, dim, allegati, liquidazione, progresso, note, difficolta, operatore, last_upd_ggrestanti) VALUES (\"$numero\", \"$pm\", \"$procura\", \"$dinizio\", $gg, $copia, $ftk, $ief, $analisi, $exprep, $dim, $allegati, $liquidazione, $progresso, \"$note\", $diff, \"$operatore\", NOW())");
        $sql->execute();
    }


    /**
     * Aggiorna una data lavorazione nel DB
     * @param $id
     * @param $numero
     * @param $pm
     * @param $procura
     * @param $dinizio
     * @param $gg
     * @param $copia
     * @param $ftk
     * @param $ief
     * @param $analisi
     * @param $exprep
     * @param $dim
     * @param $allegati
     * @param $liquidazione
     * @param $diff
     * @param $progresso
     * @param $note
     * @param $operatore
     */
    public function update_lavorazione($id, $numero, $pm, $procura, $dinizio, $gg, $copia, $ftk, $ief, $analisi, $exprep, $dim, $allegati, $liquidazione, $diff, $progresso, $note, $operatore)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARAZIONE QUERY
        $sql = $conn->prepare("UPDATE lavorazione
                               SET numero = '$numero',
                                   pm = '$pm',
                                   procura = '$procura',
                                   dinizio = '$dinizio',
                                   gg = $gg,
                                   copia = $copia,
                                   ftk = $ftk,
                                   ief = $ief,
                                   analisi =$analisi,
                                   exprep = $exprep,
                                   dim = $dim,
                                   allegati = $allegati,
                                   liquidazione = $liquidazione,
                                   progresso = $progresso,
                                   difficolta = $diff,
                                   note = '$note',
                                   operatore = '$operatore'
                                   WHERE id = $id");
        //ESECUZIONE QUERY
        $sql->execute();

    }


    /**
     * Elimina una lavorazione dal DB
     * @param $id
     */
    public function delete_lavorazione($id)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARAZIONE ED ESECUZIONE QUERY
        $sql = $conn->prepare("DELETE from lavorazione WHERE id =". $id);
        $sql->execute();
    }
}
