<?php

/**
 * Class ModelIndagato
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione per la tabella "indagato"
 */
class ModelIndagato {


    /**
     * Variabili di classe per mappare la tabella in memoria.
     * @var int $ind_id
     * @var string $ind_titolo
     * @var string $ind_nome
     * @var string $ind_cognome
     * @var int $ex_id_ca: chiave esterna relativa all'id caso
     */
    private $ind_id,
            $ind_titolo,
            $ind_nome,
            $ind_cognome,
            $ex_id_ca;

    /**
     * Variabili di classe per le operazioni di visualizzazione dello status (numero evidence, numero gb occupati) di un indagato
     */
    private $TOT_SERVER,
            $TOT_WORKSTATION,
            $TOT_NOTEBOOK,
            $TOT_TABLET,
            $TOT_SMARTPHONE,
            $TOT_CELLULARE,
            $TOT_NAS,
            $TOT_HDE,
            $TOT_HD,
            $TOT_MSD,
            $TOT_SIMCARD,
            $TOT_PD,
            $TOT_CDDVD,
            $TOT_ALTRO;

    /**
     * @var array
     */
    private $res = array();


    /**
     * Variabili statiche di classe
     */
    private $IND_ID = "ind_id",
            $IND_TIT = "ind_titolo",
            $IND_NOME = "ind_nome",
            $IND_COGNOME = "ind_cognome",
            $EX_ID_CA = "ex_id_caso";


    //SETTERS
    public function set_ind_id($value)
    {
        $this->ind_id = $value;
    }

    public function set_ind_titolo($value)
    {
        $this->ind_titolo = $value;
    }

    public function set_ind_nome($value)
    {
        $this->ind_nome = $value;
    }

    public function set_ind_cognome($value)
    {
        $this->ind_cognome = $value;
    }

    public function set_ex_id_ca($value)
    {
        $this->ex_id_ca = $value;
    }

    /**
     * @param mixed $TOT_ALTRO
     */
    public function setTOTALTRO($TOT_ALTRO)
    {
        $this->TOT_ALTRO = $TOT_ALTRO;
    }

    /**
     * @param mixed $TOT_SERVER
     */
    public function setTOTSERVER($TOT_SERVER)
    {
        $this->TOT_SERVER = $TOT_SERVER;
    }

    /**
     * @param mixed $TOT_WORKSTATION
     */
    public function setTOTWORKSTATION($TOT_WORKSTATION)
    {
        $this->TOT_WORKSTATION = $TOT_WORKSTATION;
    }

    /**
     * @param mixed $TOT_NOTEBOOK
     */
    public function setTOTNOTEBOOK($TOT_NOTEBOOK)
    {
        $this->TOT_NOTEBOOK = $TOT_NOTEBOOK;
    }

    /**
     * @param mixed $TOT_TABLET
     */
    public function setTOTTABLET($TOT_TABLET)
    {
        $this->TOT_TABLET = $TOT_TABLET;
    }

    /**
     * @param mixed $TOT_SMARTPHONE
     */
    public function setTOTSMARTPHONE($TOT_SMARTPHONE)
    {
        $this->TOT_SMARTPHONE = $TOT_SMARTPHONE;
    }

    /**
     * @param mixed $TOT_CELLULARE
     */
    public function setTOTCELLULARE($TOT_CELLULARE)
    {
        $this->TOT_CELLULARE = $TOT_CELLULARE;
    }

    /**
     * @param mixed $TOT_NAS
     */
    public function setTOTNAS($TOT_NAS)
    {
        $this->TOT_NAS = $TOT_NAS;
    }

    /**
     * @param mixed $TOT_HDE
     */
    public function setTOTHDE($TOT_HDE)
    {
        $this->TOT_HDE = $TOT_HDE;
    }

    /**
     * @param mixed $TOT_HD
     */
    public function setTOTHD($TOT_HD)
    {
        $this->TOT_HD = $TOT_HD;
    }

    /**
     * @param mixed $TOT_MSD
     */
    public function setTOTMSD($TOT_MSD)
    {
        $this->TOT_MSD = $TOT_MSD;
    }

    /**
     * @param mixed $TOT_SIMCARD
     */
    public function setTOTSIMCARD($TOT_SIMCARD)
    {
        $this->TOT_SIMCARD = $TOT_SIMCARD;
    }

    /**
     * @param mixed $TOT_PD
     */
    public function setTOTPD($TOT_PD)
    {
        $this->TOT_PD = $TOT_PD;
    }

    /**
     * @param mixed $TOT_CDDVD
     */
    public function setTOTCDDVD($TOT_CDDVD)
    {
        $this->TOT_CDDVD = $TOT_CDDVD;
    }




    //GETTERS
    public function get_ind_id()
    {
        return $this->ind_id;
    }

    public function get_ind_titolo()
    {
        return $this->ind_titolo;
    }

    public function get_ind_nome()
    {
        return $this->ind_nome;
    }

    public function get_ind_cognome()
    {
        return $this->ind_cognome;
    }

    public function get_ex_id_ca()
    {
        return $this->ex_id_ca;
    }

    /**
     * @return mixed
     */
    public function getTOTSERVER()
    {
        return $this->TOT_SERVER;
    }

    /**
     * @return mixed
     */
    public function getTOTWORKSTATION()
    {
        return $this->TOT_WORKSTATION;
    }

    /**
     * @return mixed
     */
    public function getTOTNOTEBOOK()
    {
        return $this->TOT_NOTEBOOK;
    }

    /**
     * @return mixed
     */
    public function getTOTTABLET()
    {
        return $this->TOT_TABLET;
    }

    /**
     * @return mixed
     */
    public function getTOTSMARTPHONE()
    {
        return $this->TOT_SMARTPHONE;
    }

    /**
     * @return mixed
     */
    public function getTOTCELLULARE()
    {
        return $this->TOT_CELLULARE;
    }

    /**
     * @return mixed
     */
    public function getTOTNAS()
    {
        return $this->TOT_NAS;
    }

    /**
     * @return mixed
     */
    public function getTOTHDE()
    {
        return $this->TOT_HDE;
    }

    /**
     * @return mixed
     */
    public function getTOTHD()
    {
        return $this->TOT_HD;
    }

    /**
     * @return mixed
     */
    public function getTOTMSD()
    {
        return $this->TOT_MSD;
    }

    /**
     * @return mixed
     */
    public function getTOTSIMCARD()
    {
        return $this->TOT_SIMCARD;
    }

    /**
     * @return mixed
     */
    public function getTOTPD()
    {
        return $this->TOT_PD;
    }

    /**
     * @return mixed
     */
    public function getTOTCDDVD()
    {
        return $this->TOT_CDDVD;
    }

    /**
     * @return mixed
     */
    public function getTOTALTRO()
    {
        return $this->TOT_ALTRO;
    }

    /**
     * @return string
     */
    public function getINDTIT()
    {
        return $this->IND_TIT;
    }


    public function setRes($ind_id, $ind_titolo, $ind_nome, $ind_cognome, $ex_id_ca)
    {
        $this->res[] = array($this->IND_ID => $ind_id, $this->IND_TIT => $ind_titolo, $this->IND_NOME => $ind_nome, $this->IND_COGNOME => $ind_cognome, $this->EX_ID_CA => $ex_id_ca);
    }

    /*public function __construct($ind_id = 0, $ind_titolo = '0', $ind_nome = '0', $ind_cognome = '', $ex_id_ca = 0)
    {
        $this->set_ind_id($ind_id);
        $this->set_ind_titolo($ind_titolo);
        $this->set_ind_nome($ind_nome);
        $this->set_ind_cognome($ind_cognome);
        $this->set_ex_id_ca($ex_id_ca);
    }*/

    /**
     * Seleziona tutti gli indagati
     * @return array
     */
    public function select_all_indagati()
    {
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        // PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM indagato");
        $sql->execute();

        // SETTA L'ARRAY
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->IND_ID], $row[$this->IND_TIT], $row[$this->IND_NOME], $row[$this->IND_COGNOME], $row[$this->EX_ID_CA]);

        }

        return $this->res;
    }


    /**
     * Seleziona un singolo indagato
     * @param $ind_id
     */
    public function select_one_indagato($ind_id)
    {
        //_____________________________
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //_____________________________
        // PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM indagato WHERE ind_id = $ind_id");
        $sql->execute();

        //SETTA LE VARIABILI DI CLASSE
        while ($row = $sql->fetch()) {

            $this->set_ind_id($row[$this->IND_ID]);
            $this->set_ind_titolo($row[$this->IND_TIT]);
            $this->set_ind_nome($row[$this->IND_NOME]);
            $this->set_ind_cognome($row[$this->IND_COGNOME]);
            $this->set_ex_id_ca($row[$this->EX_ID_CA]);
        }

    }


    /**
     * Conta quanti hosts appartengono ad un indagato
     * @param $IdIndagato
     * @return int
     */
    public function count_hosts_of_indagato($IdIndagato){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM host WHERE ex_id_indagato = '$IdIndagato'");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }


    /**
     * Conta quanti hosts speciali appartengono ad un indagato
     * @param $IdIndagato
     * @return int
     */
    public function count_hosts_special_of_indagato($IdIndagato){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM host_special WHERE ex_id_indagato = '$IdIndagato'");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }


    /**
     * Seleziona gli indagati di un caso (dossier)
     * @param $ca_id
     * @return array
     */
    public function select_indagati_of_caso($ca_id)
    {
        //_____________________________
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //_____________________________
        // PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM indagato WHERE ex_id_caso = $ca_id ORDER BY ind_cognome ASC");
        $sql->execute();

        // SETTA L'ARRAY
        while ($row = $sql->fetch()) {

            $this->setRes($row[$this->IND_ID], $row[$this->IND_TIT], $row[$this->IND_NOME], $row[$this->IND_COGNOME], $row[$this->EX_ID_CA]);
        }
        return $this->res;
    }


    /**
     * Seleziona tutte le info utili al report PDF dell'indagato corrente
     * @param $ca_id
     * @param $ind_id
     * @return array
     */
    public function select_info_for_report($ind_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT cli_nome, cli_citta,
                                      pm_titolo, pm_nome, pm_cognome,
                                      ca_id, ca_num, ca_tipo,
                                      ind_id, ind_titolo, ind_nome, ind_cognome,
                                      ho_id, ho_etichetta, ho_seriale, ho_pwd, ho_pwd_used, ho_tipo, ho_modello, ho_pathfoto, ho_image1, ho_image2, ho_image3, ho_image4,
                                      evi_id, evi_etichetta, evi_tipo, evi_modello, evi_seriale, evi_pwd, evi_pwd_used, evi_dimensione, evi_kbmbgbtb, evi_pathfoto, evi_image1, evi_image2, evi_image3,
                                      clo_id, clo_tipoacq, clo_altro_tipo, clo_stracq, clo_md5, clo_sha1, clo_sha256, clo_log
                               FROM indagato
                               LEFT OUTER JOIN caso ON caso.ca_id = indagato.ex_id_caso
                               LEFT OUTER JOIN pm ON pm.pm_id = caso.ex_id_pm
                               LEFT OUTER JOIN cliente ON cliente.cli_id = pm.ex_id_cli
                               LEFT OUTER JOIN host ON host.ex_id_indagato = indagato.ind_id
                               LEFT OUTER JOIN evidence ON evidence.ex_id_host = host.ho_id
                               LEFT OUTER JOIN clone ON clone.ex_id_evi = evidence.evi_id
                               WHERE ind_id = $ind_id ORDER BY ho_id, evi_id");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'cli_nome' => $row['cli_nome'],
                'cli_citta' => $row['cli_citta'],
                'pm_titolo' => $row['pm_titolo'],
                'pm_nome' => $row['pm_nome'],
                'pm_cognome' => $row['pm_cognome'],
                'ca_num' => $row['ca_num'],
                'ca_tipo' => $row['ca_tipo'],
                'ind_id' => $row['ind_id'],
                'ind_titolo' => $row['ind_titolo'],
                'ind_nome' => $row['ind_nome'],
                'ind_cognome' => $row['ind_cognome'],
                'ho_id' => $row['ho_id'],
                'ho_etichetta' => $row['ho_etichetta'],
                'ho_seriale' => $row['ho_seriale'],
                'ho_pwd' => $row['ho_pwd'],
                'ho_pwd_used' => $row['ho_pwd_used'],
                'ho_tipo' => $row['ho_tipo'],
                'ho_modello' => $row['ho_modello'],
                'ho_pathfoto' => $row['ho_pathfoto'],
                'ho_image1' => $row['ho_image1'],
                'ho_image2' => $row['ho_image2'],
                'ho_image3' => $row['ho_image3'],
                'ho_image4' => $row['ho_image4'],
                'evi_id' => $row['evi_id'],
                'evi_etichetta' => $row['evi_etichetta'],
                'evi_tipo' => $row['evi_tipo'],
                'evi_modello' => $row['evi_modello'],
                'evi_seriale' => $row['evi_seriale'],
                'evi_pwd' => $row['evi_pwd'],
                'evi_pwd_used' => $row['evi_pwd_used'],
                'evi_dimensione' => $row['evi_dimensione'],
                'evi_kbmbgbtb' => $row['evi_kbmbgbtb'],
                'evi_pathfoto' => $row['evi_pathfoto'],
                'evi_image1' => $row['evi_image1'],
                'evi_image2' => $row['evi_image2'],
                'evi_image3' => $row['evi_image3'],
                'clo_id' => $row['clo_id'],
                'clo_tipoacq' => $row['clo_tipoacq'],
                'clo_altro_tipo' => $row['clo_altro_tipo'],
                'clo_stracq' => $row['clo_stracq'],
                'clo_md5' => $row['clo_md5'],
                'clo_sha1' => $row['clo_sha1'],
                'clo_sha256' => $row['clo_sha256'],
                'clo_log' => $row['clo_log']);
        }
        return $arr;
    }


    /*@TODO: IN FASE DI SVILUPPO. Questa funzione è pensata per snellire la funzione di stampa HTML_status_indagato siccome tutte le somme sono calcolate in tale funzione.
        Lo scopo sarebbe quello di passare alla funzione di stampa direttamente le somme. */
    public function conta_Hosts_Indagato($IdInd)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Server'");
        $sql->execute();
        $this->setTOTSERVER($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Workstation'");
        $sql->execute();
        $this->setTOTWORKSTATION($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Notebook'");
        $sql->execute();
        $this->setTOTNOTEBOOK($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Tablet'");
        $sql->execute();
        $this->setTOTTABLET($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Smartphone'");
        $sql->execute();
        $this->setTOTSMARTPHONE($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Cellulare'");
        $sql->execute();
        $this->setTOTCELLULARE($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Nas'");
        $sql->execute();
        $this->setTOTNAS($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Hard Disk Esterno'");
        $sql->execute();
        $this->setTOTHDE($sql->rowCount());

    }

    /*@TODO: IN FASE DI SVILUPPO. Questa funzione è pensata per snellire la funzione di stampa HTML_status_indagato siccome tutte le somme sono calcolate in tale funzione.
        Lo scopo sarebbe quello di passare alla funzione di stampa direttamente le somme. */
    public function conta_HostSpecial_Indagato($IdInd)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host_special AS host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Hard Disk'");
        $sql->execute();
        $this->setTOTHD($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host_special AS host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'MemoryCard'");
        $sql->execute();
        $this->setTOTMSD($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host_special AS host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'SimCard'");
        $sql->execute();
        $this->setTOTSIMCARD($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host_special AS host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'PenDrive'");
        $sql->execute();
        $this->setTOTPD($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host_special AS host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Cd/Dvd'");
        $sql->execute();
        $this->setTOTCDDVD($sql->rowCount());

        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT ho_id
                               FROM host_special AS host
                               LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                               WHERE ind_id = $IdInd AND ho_tipo = 'Altro'");
        $sql->execute();
        $this->setTOTALTRO($sql->rowCount());
    }


    /**
     * Inserisce un nuovo indagato nella tabella "indagato"
     * @param string $ind_titolo
     * @param string $ind_nome
     * @param string $ind_cognome
     * @param int $ex_id_caso: chiave esterna relativa all'id caso
     */
    public function insert_indagato($ind_titolo, $ind_nome, $ind_cognome, $ex_id_caso)
    {
        //_____________________________
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //_____________________________
        // PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("INSERT INTO indagato (ind_titolo, ind_nome, ind_cognome, ex_id_caso) VALUES (\"$ind_titolo\", \"$ind_nome\", \"$ind_cognome\", \"$ex_id_caso\")");
        $sql->execute();

    }

    /**
     * Aggiorna i campi di un indagato nella tabella "indagato"
     * @param $id
     * @param $titolo
     * @param $nome
     * @param $cognome
     */
    public function update_indagato($id, $titolo, $nome, $cognome)
    {
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        // PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("UPDATE indagato
                               SET ind_titolo = \"$titolo\", ind_nome = \"$nome\", ind_cognome = \"$cognome\"
                               WHERE ind_id = $id");
        $sql->execute();
    }

    /**
     * Elimina un indagato dal DB
     * @param $IND_ID
     */
    public function delete_indagato($IND_ID)
    {
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        // PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("DELETE from indagato WHERE IND_ID =". $IND_ID);
        $sql->execute();
    }
}
