<?php
/**
 * Class ModelCaso
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione dei CASI (dossier)
 */
class ModelCaso {

    /**
     * Variabili globali
     * @var int $ca_id: identificativo del caso
     * @var string $ca_num: numero del caso (assegnato dal PM)
     * @var string $ca_inc: numero di incarico
     * @var string $ca_tipo: tipologia (penale/civile)
     * @var datetime $ca_datains: data inserimento
     * @var int $ex_id_pm: chiave esterna relativa all'identificativo del PM a cui appartiene il caso corrente.
     */
    private $ca_id, $ca_num, $ca_inc, $ca_tipo, $ca_dss, $ca_datains, $ex_id_pm ;

    /**
     * @var array $res: dichiarazione di un array utilizzato successivamente.
     */
    private $res = array();


    /**
     * Variabili globali statiche
     * @var string $CA_ID: identificativo del caso
     * @var string $CA_NUM: numero caso
     * @var string $CA_INC:  numero incarico
     * @var string $CA_TIPO: tipologia caso
     * @var int $EX_ID_PM: chiave esterna relativa all'ID del PM a cui appartiene il caso corrente
     * @var string $CA_DSS: identificativo dell'hard disk in cui si trova il caso.
     */
    private $CA_ID = "ca_id", $CA_NUM = "ca_num", $CA_INC = "ca_inc", $CA_TIPO = "ca_tipo", $EX_ID_PM = "ex_id_pm", $CA_DSS = "ca_dss";



    // SETTERS
    public function set_ca_id($value)
    {
        $this->ca_id = $value;
    }

    public function set_ca_num($value)
    {
        $this->ca_num = $value;
    }

    public function set_ca_inc($value)
    {
        $this->ca_inc = $value;
    }

    public function set_ca_tipo($value)
    {
        $this->ca_tipo = $value;
    }

    public function set_ca_dss($value)
    {
        $this->ca_dss = $value;
    }

    public function set_ca_datains($value)
    {
        $this->ca_datains = $value;
    }

    public function set_ex_id_pm($value)
    {
        $this->ex_id_pm = $value;
    }


    //GETTERS
    public function get_ca_id()
    {
        return $this->ca_id;
    }

    public function get_ca_num()
    {
        return $this->ca_num;
    }

    public function get_ca_inc()
    {
        return $this->ca_inc;
    }

    public function get_ca_tipo()
    {
        return $this->ca_tipo;
    }

    public function get_ca_dss()
    {
        return $this->ca_dss;
    }

    public function get_ca_datains()
    {
        return $this->ca_datains;
    }

    public function get_ex_id_pm()
    {
        return $this->ex_id_pm;
    }

    public function setRes($ca_id, $ca_num, $ca_inc, $ca_tipo, $ex_id_pm, $ca_dss)
    {
        $this->res[] = array($this->CA_ID => $ca_id, $this->CA_NUM => $ca_num, $this->CA_INC => $ca_inc, $this->CA_TIPO => $ca_tipo, $this->EX_ID_PM => $ex_id_pm, $this->CA_DSS => $ca_dss);
    }

    /**
     * @return array
     * Seleziona tutti i casi e ritorna un array.
     */
    public function select_all_casi()
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM caso");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CA_ID], $row[$this->CA_NUM], $row[$this->CA_INC], $row[$this->CA_TIPO], $row[$this->EX_ID_PM], $row[$this->CA_DSS]);

        }

        return $this->res;
    }

    /**
     * @param $ca_id
     * Seleziona un caso tramite id e setta le variabili di classe con i valori selezionati
     */
    public function select_one_caso($ca_id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM caso WHERE ca_id = '$ca_id'");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {

            $this->set_ca_id($row[$this->CA_ID]);
            $this->set_ca_num($row[$this->CA_NUM]);
            $this->set_ca_inc($row[$this->CA_INC]);
            $this->set_ca_tipo($row[$this->CA_TIPO]);
            $this->set_ex_id_pm($row[$this->EX_ID_PM]);
            $this->set_ca_dss($row[$this->CA_DSS]);
        }

    }

    /**
     * Seleziona un caso tramite il numero caso e restituisce un array con tali valori selezionati.
     * @param $ca_num: numero caso.
     * @return array
     */
    public function select_caso_by_num($ca_num)
    {
        $arr = array();
        if(!empty($ca_num))
        {
            $conn = DbManager::getConnection();
            $sql = $conn->prepare("SELECT * FROM caso WHERE ca_num LIKE '%$ca_num%'");
            $sql->execute();

            while ($row = $sql->fetch()) {
                $arr[] = array(
                    'ca_id' => $row['ca_id'],
                    'ca_num' => $row['ca_num'],
                    'ca_inc' => $row['ca_inc'],
                    'ca_tipo' => $row['ca_tipo'],
                    'ca_dss' => $row['ca_dss'],
                    'ex_id_pm' => $row['ex_id_pm']
                );

            }
        }
        return $arr;
    }

    /**
     * Conta i casi appartenenti ad un PM
     * @param $IdPm
     * @return int
     */
    public function count_casi_of_pm($IdPm){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM caso WHERE ex_id_pm = '$IdPm'");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }

    /**
     * Conta gli indagati di un caso
     * @param $IdCaso
     * @return int
     */
    public function count_indagati_of_caso($IdCaso){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM indagato WHERE ex_id_caso = '$IdCaso'");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }


    /*public function select_MAX_id_caso()
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT MAX(ca_id) as ca_id FROM caso");
        $sql->execute();
        while($row = $sql->fetch()) {
            $this->set_ca_id($row["ca_id"]);
        }
    }*/


    /** Inserisce un nuovo caso nel DB
     * @param $ca_num: numero caso
     * @param $ca_inc: numero o data dell'incarico
     * @param $ca_tipo: tipologia
     * @param $ex_id_pm: chiave esterna relativa a ID del PM
     * @param $ca_dss: identificativo dell'hard disk in cui si trova il caso
     */
    public function insert_caso($ca_num, $ca_inc, $ca_tipo, $ex_id_pm, $ca_dss)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO caso (ca_num, ca_inc, ca_tipo, ex_id_pm, ca_dss) VALUES (\"$ca_num\", \"$ca_inc\", \"$ca_tipo\", $ex_id_pm, \"$ca_dss\")");
        $sql->execute();

    }


    /** Modifica un caso nel DB.
     * @param $id: identificativo del caso.
     * @param $num: numero del caso
     * @param $inc: numero o data dell'incarico
     * @param $tipo: tipologia
     * @param $dss: identificativo dell'hard disk in cui si trova il caso.
     */
    public function update_caso($id, $num, $inc, $tipo, $dss)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE caso SET ca_num = \"$num\", ca_inc = \"$inc\", ca_tipo = \"$tipo\", ca_dss = \"$dss\" WHERE ca_id = $id");
        $sql->execute();
    }


    /** Seleziona tutti i casi relativi ad un PM e li ordina per numero caso.
     * @param $pm_id: id del PM
     * @return array
     */
    public function select_casi_of_pm($pm_id){
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM caso WHERE ex_id_pm = ". $pm_id ." ORDER BY ca_num");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CA_ID], $row[$this->CA_NUM], $row[$this->CA_INC], $row[$this->CA_TIPO], $row[$this->EX_ID_PM], $row[$this->CA_DSS]);

        }

        return $this->res;
    }


    /** Elimina un caso dal DB
     * @param $ca_id: identificativo del caso
     */
    public function delete_caso($ca_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from caso WHERE ca_id =". $ca_id);
        $sql->execute();
    }


    /** Seleziona le informazioni dell'azienda per poter stampare il footer nella copertina del caso
     * @return array
     */
    public function select_azienda_for_copertina()
    {
        $arr = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM azienda");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'rsoc' => $row['rsoc'],
                'ctu' => $row['ctu'],
                'indi' => $row['indi'],
                'cap' => $row['cap'],
                'citta' => $row['citta'],
                'tele' => $row['tele'],
                'cell' => $row['cell'],
                'fax' => $row['fax'],
                'mail' => $row['mail'],
                'piva' => $row['piva'],
                'rea' => $row['rea']);

        }
        return $arr;
    }


    /** Seleziona le informazioni per poter stampare la copertina di un caso.
     * @param $ca_id
     * @return array
     */
    public function select_info_for_copertina($ca_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT cli_nome, cli_citta,
                                      pm_titolo, pm_nome, pm_cognome,
                                      ca_id, ca_num, ca_inc, ca_tipo
                               FROM caso
                               LEFT OUTER JOIN pm ON pm.pm_id = caso.ex_id_pm
                               LEFT OUTER JOIN cliente ON cliente.cli_id = pm.ex_id_cli
                               WHERE ca_id = $ca_id");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'cli_nome' => $row['cli_nome'],
                'cli_citta' => $row['cli_citta'],
                'pm_titolo' => $row['pm_titolo'],
                'pm_nome' => $row['pm_nome'],
                'pm_cognome' => $row['pm_cognome'],
                'ca_num' => $row['ca_num'],
                'ca_inc' => $row['ca_inc'],
                'ca_tipo' => $row['ca_tipo']);
        }
        return $arr;
    }


    /**Conta tutti gli evidence di un caso.
     * @param $ca_id: id del caso
     * @return int
     */
    public function count_all_evidences_of_case($ca_id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM CASO AS C 
                                         JOIN indagato AS I ON I.ex_id_caso = C.ca_id
                                         JOIN host AS H ON H.ex_id_indagato = I.ind_id 
                                         JOIN evidence AS E ON E.ex_id_host = H.ho_id 
                                         WHERE C.ca_id = $ca_id");
        $sql->execute();
        $countEviHost = $sql->rowCount();
        $sql = $conn->prepare("SELECT * FROM caso AS C 
                                         JOIN indagato AS I ON I.ex_id_caso = C.ca_id 
									     JOIN host_special AS HS ON HS.ex_id_indagato = I.ind_id 
									     WHERE C.ca_id = $ca_id");
        $sql->execute();
        $countEviHostSp = $sql->rowCount();
        // FA LA SOMMA DEGLI EVIDENCE PRESENTI NEGLI HOST + GLI HOST SPECIAL
        $TotEvi = $countEviHost + $countEviHostSp;
        return $TotEvi;
    }


    /**Seleziona i cloni degli evidence di un caso.
     * @param $ca_id: id del caso
     * @return array|int: ritorna un array se viene trovato almeno un risultato. Altrimenti ritorna 0.
     */
    public function check_cloni_host($ca_id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM CASO AS C 
                                         JOIN indagato AS I ON I.ex_id_caso = C.ca_id
                                         JOIN host AS H ON H.ex_id_indagato = I.ind_id 
                                         JOIN evidence AS E ON E.ex_id_host = H.ho_id 
                                         LEFT OUTER JOIN clone AS CL ON CL.ex_id_evi = E.evi_id  
                                         WHERE C.ca_id = $ca_id");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ind_cognome' => $row['ind_cognome'],
                'ind_nome' => $row['ind_nome'],
                'ho_etichetta' => $row['ho_etichetta'],
                'evi_etichetta' => $row['evi_etichetta'],
                'clo_id' => $row['clo_id']);
        }
        if(isset($arr)){
            return $arr;
        }
        else {return 0;}
    }


    /** Seleziona i cloni degli host special di un caso.
     * @param $ca_id: id del caso
     * @return array|int: ritorna un array se viene trovato qualcosa altrimenti ritorna 0
     */
    public function check_cloni_hostSP($ca_id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM caso AS C 
                                         JOIN indagato AS I ON I.ex_id_caso = C.ca_id 
									     JOIN host_special AS HS ON HS.ex_id_indagato = I.ind_id 
									     LEFT OUTER JOIN clone AS CL ON CL.ex_id_host_special = HS.ho_id 
									     WHERE C.ca_id = $ca_id");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ind_cognome' => $row['ind_cognome'],
                'ind_nome' => $row['ind_nome'],
                'ho_etichetta' => $row['ho_etichetta'],
                'clo_id' => $row['clo_id']);
        }
        if(isset($arr)){
            return $arr;
        }
        else {return 0;}

    }

}
