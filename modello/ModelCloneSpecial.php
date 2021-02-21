<?php

/**
 * Class ModelCloneSpecial
 * La classe gestisce le operazioni di inserimento, modifica ed eliminazione dei cloni degli host special
 */
class ModelCloneSpecial
{

    /**
     * Variabili di classe
     * @var int $clo_id: id del clone
     * @var string $clo_tipoacq: tipologia acquisizione
     * @var string $altro_tipo: altra tipologia
     * @var string $clo_stracq: strumento HW o SW acquisizione
     * @var string $clo_md5: md5 del clone
     * @var string $clo_sha1: sha1 del clone
     * @var string $clo_sha256: sha256 del clone
     * @var string $clo_log: percorso del log
     * @var int $ex_id_host_special: chiave esterna relativa all'identificativo dell'host speciale
     * @var array
     */
    private $clo_id, $clo_tipoacq, $altro_tipo, $clo_stracq, $clo_md5, $clo_sha1, $clo_sha256, $clo_log, $ex_id_host_special, $res = array();

    /**
     * Variabili statiche di classe.
     * @var int $CLO_ID: identificativo del clone
     * @var string $CLO_TIPOACQ: tipologia acquisizione
     * @var string $CLO_ALTRO: altra tipologia
     * @var string $CLO_STRACQ: strumento HW o SW acquisizione
     * @var string $CLO_MD5: MD5 del clone
     * @var string $CLO_SHA1: SHA1 del clone
     * @var string $CLO_SHA256: SHA256 del clone
     * @var string $CLO_LOG: percorso + nome del log
     * @var int $EX_ID_HOST_SPECIAL: chiave esterna relativa all'ID dell'host special
     */
    private $CLO_ID = "clo_id",
            $CLO_TIPOACQ = "clo_tipoacq",
            $CLO_ALTRO = "clo_altro_tipo",
            $CLO_STRACQ = "clo_stracq",
            $CLO_MD5 = "clo_md5",
            $CLO_SHA1 = "clo_sha1",
            $CLO_SHA256 = "clo_sha256",
            $CLO_LOG = "clo_log",
            $EX_ID_HOST_SPECIAL = "ex_id_host_special";


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

    public function set_ex_id_host_special($value){
        $this->ex_id_host_special = $value;
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

    public function get_ex_id_host_special(){
        return $this->ex_id_host_special;
    }

    public function get_res(){
        return $this->res;
    }


    public function setRes($clo_id, $clo_tipoacq, $altro_tipo, $clo_stracq, $clo_md5, $clo_sha1, $clo_sha256, $clo_log, $ex_id_host_special)
    {
        $this->res[] = array($this->CLO_ID => $clo_id,
            $this->CLO_TIPOACQ => $clo_tipoacq,
            $this->CLO_ALTRO => $altro_tipo,
            $this->CLO_STRACQ => $clo_stracq,
            $this->CLO_MD5 => $clo_md5,
            $this->CLO_SHA1 => $clo_sha1,
            $this->CLO_SHA256 => $clo_sha256,
            $this->clo_log => $clo_log,
            $this->ex_id_host_special => $ex_id_host_special,);
    }

    public function getRes(){
        return $this->res;
    }

    /**
     * Seleziona un clone singolo e setta le variabili di classe
     * @param $id: l'id è il criterio di selezione
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
            $this->set_ex_id_host_special($row[$this->EX_ID_HOST_SPECIAL]);

        }
    }

    /**
     * Seleziona l'ID dell'ultimo clone inserito nel DB.
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
     * Inserisce un nuovo clone.
     * @param string $tipoacq: tipo acquisizione
     * @param string $altro: altre info
     * @param string $stracq: strumento acquisizione
     * @param $md5
     * @param $sha1
     * @param $sha256
     * @param $ex_id_host_special
     */
    public function insert_clone($tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $ex_id_host_special)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO clone (clo_tipoacq, clo_altro_tipo, clo_stracq, clo_md5, clo_sha1, clo_sha256, ex_id_host_special) VALUES (\"$tipoacq\", \"$altro\", \"$stracq\", \"$md5\", \"$sha1\", \"$sha256\", $ex_id_host_special)");
        $sql->execute();

    }


    /**
     * Salva il LOG su file
     * @param $logname: path + nome del log
     * @param $log: contenuto effettivo del log
     */
    public function save_log($logname, $log)
    {
        $myfile = fopen("$logname", "w") or die("Unable to open file!");
        fwrite($myfile, $log);
        fclose($myfile);
    }


    /**
     * Aggiorna un LOG
     * @param $id: id del log
     * @param $log: contenuto del log.
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
     * Aggiorna le informazioni nel DB relative ad un clone
     * @param $id: identificativo del clone
     * @param $tipoacq: tipo acquisizione
     * @param $altro: altro tipo di acquisizione
     * @param $stracq: strumento HW o SW di acquisizione
     * @param $md5: md5 del clone
     * @param $sha1: sha1 del clone
     * @param $sha256: sha256 del clone
     * @param $log: contenuto del log
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
     * Elimina un clone
     * @param $clo_id: l'id è il criterio di eliminazione
     */
    public function delete_clone_special($clo_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from clone WHERE clo_id =". $clo_id);
        $sql->execute();
    }

}
