<?php
/**
 * Class ModelClone
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione dei cloni.
 */

class ModelClone
{
    /**
     * Variabili di classe
     * @var int $clo_id: identificativo del clone
     * @var string $clo_tipoacq: tipologia acquisizione
     * @var string $altro_tipo: altra tipologia
     * @var string $clo_stracq: strumento HW o SW acquisizione
     * @var string $clo_md5: MD5 del clone
     * @var string $clo_sha1: SHA1 del clone
     * @var string $clo_sha256: SHA256 del clone
     * @var string $clo_log: percorso + nome del log
     * @var array $res
     */
    private $clo_id, $clo_tipoacq, $altro_tipo, $clo_stracq, $clo_md5, $clo_sha1, $clo_sha256, $clo_log, $ex_id_evi;
    private $res = array();

    /**
     * Variabili di classe statiche impiegate per le query
     * @var int $CLO_ID: identificativo del clone
     * @var string $CLO_TIPOACQ: tipologia acquisizione
     * @var string $CLO_ALTRO: altra tipologia
     * @var string $CLO_STRACQ: strumento HW o SW acquisizione
     * @var string $CLO_MD5: MD5 del clone
     * @var string $CLO_SHA1: SHA1 del clone
     * @var string $CLO_SHA256: SHA256 del clone
     * @var string $CLO_LOG: percorso + nome del log
     */
    private $CLO_ID = "clo_id",
            $CLO_TIPOACQ = "clo_tipoacq",
            $CLO_ALTRO = "clo_altro_tipo",
            $CLO_STRACQ = "clo_stracq",
            $CLO_MD5 = "clo_md5",
            $CLO_SHA1 = "clo_sha1",
            $CLO_SHA256 = "clo_sha256",
            $CLO_LOG = "clo_log",
            $EX_ID_EVI = "ex_id_evi";


    // SETTERS
    public function set_clo_id($value){
        $this->clo_id = $value;
    }

    public function set_clo_tipoacq($value){
        $this->clo_tipoacq = $value;
    }

    public function set_clo_altro_tipo($value){
        $this->altro_tipo = $value;
    }

    public function set_clo_stracq($value){
        $this->clo_stracq = $value;
    }

    public function set_clo_md5($value){
        $this->clo_md5 = $value;
    }

    public function set_clo_sha1($value){
        $this->clo_sha1 = $value;
    }

    public function set_clo_sha256($value){
        $this->clo_sha256 = $value;
    }

    public function set_clo_log($value){
        $this->clo_log = $value;
    }

    public function set_ex_id_evi($value){
        $this->ex_id_evi = $value;
    }

    // GETTERS
    public function get_clo_id(){
        return $this->clo_id;
    }

    public function get_clo_tipoacq(){
        return $this->clo_tipoacq;
    }

    public function get_clo_altro_tipo(){
        return $this->altro_tipo;
    }

    public function get_clo_stracq(){
        return $this->clo_stracq;
    }

    public function get_clo_md5(){
        return $this->clo_md5;
    }

    public function get_clo_sha1(){
        return $this->clo_sha1;
    }

    public function get_clo_sha256(){
        return $this->clo_sha256;
    }

    public function get_clo_log(){
        return $this->clo_log;
    }

    public function get_ex_id_evi(){
        return $this->ex_id_evi;
    }

    public function get_res(){
        return $this->res;
    }

    public function setRes($clo_id, $clo_tipoacq, $altro_tipo, $clo_stracq, $clo_md5, $clo_sha1, $clo_sha256, $clo_log, $ex_id_evi)
    {
        $this->res[] = array($this->CLO_ID => $clo_id,
            $this->CLO_TIPOACQ => $clo_tipoacq,
            $this->CLO_ALTRO => $altro_tipo,
            $this->CLO_STRACQ => $clo_stracq,
            $this->CLO_MD5 => $clo_md5,
            $this->CLO_SHA1 => $clo_sha1,
            $this->CLO_SHA256 => $clo_sha256,
            $this->CLO_LOG => $clo_log,
            $this->EX_ID_EVI => $ex_id_evi,);
    }

    /**
     * Seleziona un clone singolo e setta le variabili di classe
     * @param $id: criterio di selezione
     */
    public function select_single_clone($id)
    {
        $conn = DbManager::getConnection();

        $sql = $conn->prepare("SELECT * FROM clone WHERE clo_id= '$id'");
        $sql->execute();

        while ($row = $sql->fetch()) {
            $this->set_clo_id($row[$this->CLO_ID]);
            $this->set_clo_tipoacq($row[$this->CLO_TIPOACQ]);
            $this->set_clo_altro_tipo($row[$this->CLO_ALTRO]);
            $this->set_clo_stracq($row[$this->CLO_STRACQ]);
            $this->set_clo_md5($row[$this->CLO_MD5]);
            $this->set_clo_sha1($row[$this->CLO_SHA1]);
            $this->set_clo_sha256($row[$this->CLO_SHA256]);
            $this->set_clo_log($row[$this->CLO_LOG]);
            $this->set_ex_id_evi($row[$this->EX_ID_EVI]);

        }
    }

    /**
     * Seleziona tutti i cloni di un evidence
     * @param $evi_id
     */
    public function select_cloni_of_evidence($evi_id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM clone WHERE ex_id_evi =".$evi_id);
        $sql->execute();
        while ($row = $sql->fetch())
        {
            $this->setRes(
                $row[$this->CLO_ID],
                $row[$this->CLO_TIPOACQ],
                $row[$this->CLO_ALTRO],
                $row[$this->CLO_STRACQ],
                $row[$this->CLO_MD5],
                $row[$this->CLO_SHA1],
                $row[$this->CLO_SHA256],
                $row[$this->CLO_LOG],
                $row[$this->EX_ID_EVI]);
        }
    }

    /**
     * Seleziona tutti i cloni di un host special
     * @param $hos_id: l'identificativo dell'host special è il criterio di selezione
     */
    public function select_cloni_of_host_special($hos_id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM clone WHERE ex_id_host_special =".$hos_id);
        $sql->execute();
        while ($row = $sql->fetch())
        {
            $this->setRes(
                $row[$this->CLO_ID],
                $row[$this->CLO_TIPOACQ],
                $row[$this->CLO_ALTRO],
                $row[$this->CLO_STRACQ],
                $row[$this->CLO_MD5],
                $row[$this->CLO_SHA1],
                $row[$this->CLO_SHA256],
                $row[$this->CLO_LOG],
                $row[$this->EX_ID_EVI]);
        }
    }

    /**
     * Seleziona l'ultimo ID inserito nella tabella Clone
     */
    public function select_last_id()
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT MAX(clo_id) AS clo_id FROM clone");
        $sql->execute();
        while($row = $sql->fetch()){
            $this->set_clo_id($row[$this->CLO_ID]);
        }
    }

    /**
     * Inserisce nel DB un nuovo clone.
     * @param $tipoacq: tipo acquisizione
     * @param $altro: altro tipo
     * @param $stracq: strumento HW o SW acquisizione
     * @param $md5: md5 del clone
     * @param $sha1: sha1 del clone
     * @param $sha256: sha256 del clone
     * @param $ex_id_evi: chiave esterna relativa all'identificativo dell'evidence nella tabella "evidence"
     */
    public function insert_clone($tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $ex_id_evi)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO clone (clo_tipoacq, clo_altro_tipo, clo_stracq, clo_md5, clo_sha1, clo_sha256, ex_id_evi) VALUES (\"$tipoacq\", \"$altro\", \"$stracq\", \"$md5\", \"$sha1\", \"$sha256\", $ex_id_evi)");
        $sql->execute();

    }

    /**
     * Salva il log in un file
     * @param $logname: nome del log
     * @param $log: path del log.
     */
    public function save_log($logname, $log)
    {
        $myfile = fopen("$logname", "w") or die("Unable to open file!");
        fwrite($myfile, $log);
        fclose($myfile);
    }

    /**
     * Esegue la modifica delle informazioni del log nel db
     * @param $id: identificativo
     * @param $log: path del log.
     */
    public function update_clone_log($id, $log)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("UPDATE clone SET clo_log = \"$log\" WHERE clo_id = $id");
        $sql->execute();

    }

    /**
     * Modifica le informazioni del log nel DB.
     * @param $id: id del clone
     * @param $tipoacq: tipo acquisizione
     * @param $altro: altro tipo di acquisizione
     * @param $stracq: strumento HW o SW acquisizione
     * @param $md5: md5 del clone
     * @param $sha1: sha1 del clone
     * @param $sha256: sha256 del clone
     * @param $log: percorso + nome del log
     */
    public function update_clone($id, $tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $log)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("UPDATE clone SET clo_tipoacq = \"$tipoacq\",
                                                clo_altro_tipo = \"$altro\",
                                                clo_stracq = \"$stracq\",
                                                clo_md5 = \"$md5\",
                                                clo_sha1 = \"$sha1\",
                                                clo_sha256 = \"$sha256\",
                                                clo_log = \"$log\"
                               WHERE clo_id = $id");
        $sql->execute();

    }

    /**
     * Elimina le info di un log dal DB.
     * @param $clo_id
     */
    public function delete_clone($clo_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from clone WHERE clo_id =". $clo_id);
        $sql->execute();
    }

    public function get_log_file($logpath)
    {
        $log = 0;
        if(($logpath != null) && ($logpath != "")){
            @$log = file_get_contents($logpath);
        }
        return $log;

    }

}
