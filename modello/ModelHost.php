<?php

/**
 * Class ModelHost
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione degli elementi presenti nella tabella "host"
 */
class ModelHost
{

    /**
     * Variabili di classe
     * @var int $ho_id codice id host
     * @var string $ho_etichetta: etichetta host
     * @var string $ho_seriale: seriale host
     * @var string $ho_pwd: password dell'host
     * @var string $ho_pwd_used: 1 | 0
     * @var string $ho_tipo: tipo host
     * @var string $ho_modello: modello
     * @var string $ho_pathfoto: directory in cui si trovano le foto dell'host
     * @var string $ho_image1: nome immagine 1
     * @var string $ho_image2: nome immagine 2
     * @var string $ho_image3: nome immagine 3
     * @var string $ho_image4: nome immagine 4
     * @var string $ho_image_docx: nome immagine 1 per il docx
     * @var string $ho_image_docx2: nome immagine 2 per il docx
     * @var int $ex_id_caso: chiave esterna relativa all'id del caso (tabella "caso")
     * @var int $ex_id_indagato: chiave esterna relativa all'id dell'indagato (tabella "indagato")
     * @var array $res
     * @var array $resForTreeMenu
     * @var array res1
     */
    private $ho_id,
            $ho_etichetta,
            $ho_seriale,
            $ho_pwd,
            $ho_pwd_used,
            $ho_tipo,
            $ho_modello,
            $ho_pathfoto,
            $ho_image1,
            $ho_image2,
            $ho_image3,
            $ho_image4,
            $ho_image_docx,
            $ho_image_docx2,
            $ex_id_caso,
            $ex_id_indagato,
            $res = array(),
            $resForTreeMenu = array(),
            $res1= array();


    /**
     * Variabili statiche di classe
     * @var string $ARCHIVIOIMG: directory in cui si trovano tutte le immagini
     * @var int $HO_ID: codice id host
     * @var string $HO_ETI: etichetta host
     * @var string $HO_TIPO: tipologia host
     * @var string $HO_MOD: modello host
     * @var string $HO_PATH: directory in cui si trovano le foto degli hosts
     * @var string $HO_IMAGE1: nome immagine 1
     * @var string $HO_IMAGE2: nome immagine 2
     * @var string $HO_IMAGE3: nome immagine 3
     * @var string $HO_IMAGE4: nome immagine 4
     * @var string $HO_IMG_DOCX: nome immagine selezionata per il docx
     * @var int $EX_ID_CASO: chiave esterna relativa all'ID caso (tabella "caso")
     * @var int $EX_ID_INDAGATO: chiave esterna relativa all'ID indagato (tabella "indagato")
     * Da EVI_ID a CLO_LOG non sono state ancora utilizzate. L'idea era quella di utilizzare solo variabili statiche nelle query.
     *
     */
    private $ARCHIVIOIMG = "archivioimg",

            $HO_ID = "ho_id",
            $HO_ETI = "ho_etichetta",
            $HO_SER = "ho_seriale",
            $HO_TIPO = "ho_tipo",
            $HO_MOD = "ho_modello",
            $HO_PATH = "ho_pathfoto",
            $HO_IMG1 = "ho_image1",
            $HO_IMG2 = "ho_image2",
            $HO_IMG3 = "ho_image3",
            $HO_IMG4 = "ho_image4",
            $HO_IMG_DOCX = "ho_image_docx",
            $EX_ID_CASO = "ex_id_caso",
            $EX_ID_INDAGATO = "ex_id_indagato",

            $EVI_ID = "evi_id",
            $EVI_ETI = "evi_etichetta",
            $EVI_TIP = "evi_tipo",
            $EVI_MOD = "evi_modello",
            $EVI_SER = "evi_seriale",
            $EVI_DIM = "evi_dimensione",
            $EVI_PAR = "evi_partizioni",
            $EVI_MD5 = "evi_md5",
            $EVI_SHA256 = "evi_sha256",
            $EVI_PATHFOTO = "evi_pathfoto",
            $EX_ID_HOST = "ex_id_host",

            $CLO_ID = "clo_id",
            $CLO_TIP = "clo_tipo",
            $CLO_ETI = "clo_etichetta",
            $CLO_MD5 = "clo_md5",
            $CLO_SHA256 = "clo_sha256",
            $CLO_LOG = "clo_log";
    //---------------------------------------------


    // SETTERS
    public function set_ho_id($value){
        $this->ho_id = $value;
    }

    public function set_ho_etichetta($value){
        $this->ho_etichetta = $value;
    }

    public function set_ho_seriale($value){
        $this->ho_seriale = $value;
    }

    public function set_ho_pwd($value){
        $this->ho_pwd = $value;
    }

    public function set_ho_pwd_used($value){
        $this->ho_pwd_used = $value;
    }

    public function set_ho_tipo($value){
        $this->ho_tipo = $value;
    }

    public function set_ho_modello($value){
        $this->ho_modello = $value;
    }

    public function set_ho_pathfoto($value){
        $this->ho_pathfoto = $value;
    }

    public function set_ho_image1($value){
        $this->ho_image1 = $value;
    }

    public function set_ho_image2($value){
        $this->ho_image2 = $value;
    }

    public function set_ho_image3($value){
        $this->ho_image3 = $value;
    }

    public function set_ho_image4($value){
        $this->ho_image4 = $value;
    }

    public function set_ho_image_docx($value){
        $this->ho_image_docx = $value;
    }

    public function set_ho_image_docx2($value){
        $this->ho_image_docx2 = $value;
    }


    public function set_ex_id_caso($value){
        $this->ex_id_caso = $value;
    }

    public function set_ex_id_indagato($value){
        $this->ex_id_indagato = $value;
    }

    // GETTERS
    public function get_ho_id(){
        return $this->ho_id;
    }

    public function get_ho_etichetta(){
        return $this->ho_etichetta;
    }

    public function get_ho_seriale(){
        return $this->ho_seriale;
    }

    public function get_ho_pwd(){
        return $this->ho_pwd;
    }

    public function get_ho_pwd_used(){
        return $this->ho_pwd_used;
    }

    public function get_ho_tipo(){
        return $this->ho_tipo;
    }

    public function get_ho_modello(){
        return $this->ho_modello;
    }

    public function get_ho_pathfoto(){
        return $this->ho_pathfoto;
    }

    public function get_ho_image1(){
        return $this->ho_image1;
    }

    public function get_ho_image2(){
        return $this->ho_image2;
    }

    public function get_ho_image3(){
        return $this->ho_image3;
    }

    public function get_ho_image4(){
        return $this->ho_image4;
    }

    public function get_ho_image_docx()
    {
        return $this->ho_image_docx;
    }

    public function get_ho_image_docx2()
    {
        return $this->ho_image_docx2;
    }

    public function get_ex_id_caso(){
        return $this->ex_id_caso;
    }

    public function get_ex_id_indagato(){
        return $this->ex_id_indagato;
    }

    /**
     * Seleziona la tipologia degli host dalla tabella "tipo_host"
     * @return array
     */
    public function select_ho_tipo()
    {
        $arr = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tipo_host ORDER BY ho_tipo ASC");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ho_id_tipo' => $row['ho_id_tipo'],
                'ho_tipo' => $row['ho_tipo'],
                'ho_icon' => $row['ho_icon']);
        }

        return $arr;
    }

    /**
     * Seleziona le tipologie di host eliminabili (con valore 0).
     * @return array
     */
    public function select_ho_tipo_for_delete()
    {
        $arr = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tipo_host WHERE ho_default = 0");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ho_id_tipo' => $row['ho_id_tipo'],
                'ho_tipo' => $row['ho_tipo'],
                'ho_icon' => $row['ho_icon']);
        }

        return $arr;
    }

    /**
     * Seleziona gli host appartenenti ad un indagato
     * @param $ind_id: identificativo dell'indagato
     * @return array
     */
    public function select_hosts_of_indagato($ind_id)
    {
        $arr = array();
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM host AS h WHERE h.ex_id_indagato = $ind_id ORDER BY ho_etichetta ASC ");
        $sql->execute();

        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ho_id' => $row['ho_id'],
                'ho_etichetta' => $row['ho_etichetta'],
                'ho_seriale' => $row['ho_seriale'],
                'ho_pwd' => $row['ho_pwd'],
                'ho_tipo' => $row['ho_tipo'],
                'ho_modello' => $row['ho_modello'],
                'ho_pathfoto' => $row['ho_pathfoto'],
                'ho_image1' => $row['ho_image1'],
                'ho_image2' => $row['ho_image2'],
                'ho_image3' => $row['ho_image3'],
                'ho_image4' => $row['ho_image4'],
                'ho_image_docx' => $row['ho_image_docx'],
                'ho_image_docx2' => $row['ho_image_docx2'],
                'ex_id_caso' => $row['ex_id_caso'],
                'ex_id_indagato' => $row['ex_id_indagato']);
        }

        return $arr;

    }

    /**
     * Seleziona hosts ed evidences degli hosts di un dato indagato.
     * Utile alla visualizzazione delle informazioni di ausilio alla creazione del docx.
     * @param $ind_id: codice id indagato
     * @return array
     */
    public function select_hosts_evidence_of_indagato_for_docx($ind_id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT ho_id, 
                                                ho_etichetta,
                                                ho_tipo, 
                                                ho_modello, 
                                                ho_seriale, 
                                                ho_pathfoto, 
                                                ho_image_docx,
                                                ho_image_docx2, 
                                                evi_id, 
                                                evi_etichetta,
                                                evi_modello,
                                                evi_seriale,
                                                evi_tipo,
                                                evi_dimensione,
                                                evi_kbmbgbtb,
                                                evi_pathfoto, 
                                                evi_image_docx 
                                                FROM host 
                                                LEFT OUTER JOIN evidence ON ho_id = ex_id_host 
                                                WHERE ex_id_indagato =". $ind_id ." 
                                                ORDER BY ho_etichetta ASC");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ho_id' => $row['ho_id'],
                'ho_etichetta' => $row['ho_etichetta'],
                'ho_tipo' => $row['ho_tipo'],
                'ho_modello' => $row['ho_modello'],
                'ho_seriale' => $row['ho_seriale'],
                'ho_pathfoto' => $row['ho_pathfoto'],
                'ho_image_docx' => $row['ho_image_docx'],
                'ho_image_docx2' => $row['ho_image_docx2'],
                'evi_id' => $row['evi_id'],
                'evi_etichetta' => $row['evi_etichetta'],
                'evi_modello' => $row['evi_modello'],
                'evi_seriale' => $row['evi_seriale'],
                'evi_tipo' => $row['evi_tipo'],
                'evi_dimensione' => $row['evi_dimensione'],
                'evi_kbmbgbtb' => $row['evi_kbmbgbtb'],
                'evi_pathfoto' => $row['evi_pathfoto'],
                'evi_image_docx' => $row['evi_image_docx']);
        }
        return $arr;

    }


    /**
     * Seleziona hosts ed evidences di un indagato. Utilizzata per il conteggio dei dispositivi di un dato indagato
     * dalla funzione status_indagato() del ControllerIndagato
     * @param $ind_id: codice id indagato
     * @return array
     */
    public function select_hosts_evidence_of_indagato($ind_id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT ho_id, evi_id, evi_tipo, evi_dimensione, evi_kbmbgbtb FROM host LEFT OUTER JOIN evidence ON ho_id = ex_id_host WHERE ex_id_indagato =". $ind_id);
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ho_id' => $row['ho_id'],
                'evi_id' => $row['evi_id'],
                'evi_tipo' => $row['evi_tipo'],
                'evi_dimensione' => $row['evi_dimensione'],
                'evi_kbmbgbtb' => $row['evi_kbmbgbtb']);
        }
        return $arr;
    }


    /**
     * Seleziona un host
     * @param $ho_id: codice id dell'host è il criterio di ricerca
     */
    public function select_host($ho_id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM host WHERE ho_id = $ho_id");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch())
        {
            $this->set_ho_id($row[$this->HO_ID]);
            $this->set_ho_etichetta($row[$this->HO_ETI]);
            $this->set_ho_seriale($row[$this->HO_SER]);
            $this->set_ho_pwd($row['ho_pwd']);
            $this->set_ho_pwd_used($row['ho_pwd_used']);
            $this->set_ho_tipo($row[$this->HO_TIPO]);
            $this->set_ho_modello($row[$this->HO_MOD]);
            $this->set_ho_pathfoto($row[$this->HO_PATH]);
            $this->set_ho_image1($row[$this->HO_IMG1]);
            $this->set_ho_image2($row[$this->HO_IMG2]);
            $this->set_ho_image3($row[$this->HO_IMG3]);
            $this->set_ho_image4($row[$this->HO_IMG4]);
            $this->set_ho_image_docx($row['ho_image_docx']);
            $this->set_ho_image_docx2($row['ho_image_docx2']);
            $this->set_ex_id_caso($row[$this->EX_ID_CASO]);
            $this->set_ex_id_indagato($row[$this->EX_ID_INDAGATO]);
        }
    }

    /**
     * Conta se ci sono duplicati tra gli host di un certo indagato aventi una certa etichetta
     * @param $IdInd: codice id indagato
     * @param $etichetta: etichetta dell'host
     * @return int
     */
    public function count_host_duplicates_of_indagato($IdInd, $etichetta)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM host LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                                                      WHERE ind_id = $IdInd AND ho_etichetta = \"$etichetta\"");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }

    /**
     * Inserisce un nuovo host nel DB.
     * @param string $etichetta: etichetta host
     * @param string $seriale: seriale host
     * @param string $pwd: password
     * @param int $pwd_used: 1 | 0
     * @param string $tipo: tipologia host
     * @param string $modello: modello host
     * @param int $ex_id_caso: chiave esterna relativa all'id del caso (tabella "caso")
     * @param int $ex_id_indagato: chiave esterna relativa all'id dell'indagato (tabella "indagato")
     */
    public function insert_host($etichetta, $seriale, $pwd, $pwd_used, $tipo, $modello, $ex_id_caso, $ex_id_indagato)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO host (ho_etichetta, ho_seriale, ho_pwd, ho_pwd_used, ho_tipo, ho_modello, ex_id_caso, ex_id_indagato) VALUES (\"$etichetta\", \"$seriale\", \"$pwd\", \"$pwd_used\", \"$tipo\", \"$modello\", $ex_id_caso, $ex_id_indagato)");
        $sql->execute();

    }

    /**
     * Inserisce una nuova tipologia di host nella tabella "tipo_host"
     * @param string $HoTipo: nome tipologia
     * @param string $PathIcona: directory in cui si trovano le icone + nome icona
     */
    public function insert_ho_tipo($HoTipo, $PathIcona)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO tipo_host (ho_tipo, ho_icon) VALUES (\"$HoTipo\", \"$PathIcona\")");
        $sql->execute();

    }

    /**
     * Elimina un host dal DB
     * @param $ho_id
     */
    public function delete_host($ho_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from host WHERE ho_id =". $ho_id);
        $sql->execute();
    }

    /**
     * Elimina una tipologia di host
     * @param $IdTipo: criterio di eliminazione
     */
    public function del_ho_tipo($IdTipo)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from tipo_host WHERE ho_id_tipo =". $IdTipo);
        $sql->execute();
    }


    /**
     * Esegue l'upload delle immagini di un host nella directory relativa all'host corrente.
     * @param int $IdProcura
     * @param int $IdPm
     * @param int $IdCaso
     * @param int $IdIndagato
     * @param int $IdHost
     * @return string
     */
    public function upload_images($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost)
    {
        // COSTRUISCE IL PATH DELLA DIRECTORY CORRETTA
        $PathHostImg = $this->create_host_images_path($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost);
        $i = 0;
        // SE L'ARRAY FILES CONTIENE DEGLI ELEMENTI
        if(!empty($_FILES["file"])) {
            $count = count($_FILES["file"]["name"]);
            foreach ($_FILES["file"]["name"] as $indice => $nome) {
                $i++;
                if($i <= 4) {
                    if($_FILES["file"]["error"][$indice] == 0) {
                        $estensione = pathinfo($_FILES["file"]["name"][$indice], PATHINFO_EXTENSION);
                        if($estensione == "png" || $estensione == "jpg" || $estensione == "PNG" || $estensione == "JPG") {
                            //if($_FILES["file"]["size"][$indice] < 1000000) {
                            $risultato = move_uploaded_file($_FILES["file"]["tmp_name"][$indice], $PathHostImg . "/" . $_FILES["file"]["name"][$indice]);
                            $NomeImg = pathinfo($_FILES["file"]["name"][$indice], PATHINFO_FILENAME);
                            $NomeImg = $NomeImg . "." . $estensione;
                            if($count == 1) {
                                $this->update_host_single_photo($IdHost, $PathHostImg, $NomeImg, $i);
                            }
                            if($count > 1){
                                $this->update_host_photos($IdHost, $PathHostImg, $NomeImg, $i);
                            }
                            if(!$risultato) {
                                $stringa = "Errore imprevisto durante lo spostamento dell'immagine! :(";
                                return $stringa;
                            }
                            //} else {  die("Il file selezionato è troppo grande, non deve superare 1MB!"); }
                        } else {  $stringa = "Estensione non consentita! Hai cercato di caricare un file ." . $estensione . "!";
                                  return $stringa;}
                    } else {  $stringa = "Errore imprevisto durante il caricamento dell'immagine! :(";
                              return $stringa; }
                } else {break;}
            }
        }
        // ALTRIMENTI VISUALIZZA CHE NON CI SONO FILE SELEZIONATI
        else { $stringa = "Nessun File Selezionato";
                 return $stringa; }
    }

    /**
     * La funzione costruisce il path per le immagini degli hosts.
     * @param int $IdProcura
     * @param int $IdPm
     * @param int $IdCaso
     * @param int $IdIndagato
     * @param int $IdHost
     * @return string
     */
    public function create_host_images_path($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost)
    {
        $PathHostImg = $this->ARCHIVIOIMG . '/' . 'cli_' . $IdProcura . '/' . 'pm_' . $IdPm . '/' . 'ca_' . $IdCaso . '/' . 'ind_' . $IdIndagato . '/' . 'ho_' . $IdHost . '/' . 'images/';
        if (!file_exists($PathHostImg)) {
            mkdir($PathHostImg, 0777, true);
        }
        return $PathHostImg;
    }

    /**
     * La funzione aggiorna le info nel DB relative alle foto degli hosts
     * @param int $ho_id
     * @param string $ho_pathfoto
     * @param string $ho_image
     * @param int $i
     */
    public function update_host_photos($ho_id, $ho_pathfoto, $ho_image, $i)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host SET ho_pathfoto = \"$ho_pathfoto\", ho_image$i = \"$ho_image\" WHERE ho_id = $ho_id AND ho_image$i is null");
        $sql->execute();
    }

    /**
     * la funzione aggiorna le info nel DB relative ad una singola immagine
     * @param int $ho_id
     * @param string $ho_pathfoto
     * @param string $ho_image
     * @param int $i
     */
    public function update_host_single_photo($ho_id, $ho_pathfoto, $ho_image, $i){
        $conn = DbManager::getConnection();
        $this->select_host($ho_id);
        $image1 = $this->get_ho_image1();
        $image2 = $this->get_ho_image2();
        $image3 = $this->get_ho_image3();
        $image4 = $this->get_ho_image4();
        if(($i == 1) && ($image1 == null)) {
            $sql = $conn->prepare("UPDATE host SET ho_pathfoto = \"$ho_pathfoto\", ho_image$i = \"$ho_image\" WHERE ho_id = $ho_id AND ho_image$i is null");
            $sql->execute();
        }
        elseif(($i == 1) && ($image1 != null) && ($image2 == null)){
            $i=2;
            $sql = $conn->prepare("UPDATE host SET ho_pathfoto = \"$ho_pathfoto\", ho_image$i = \"$ho_image\" WHERE ho_id = $ho_id AND ho_image$i is null");
            $sql->execute();
        }
        elseif(($i == 1) && ($image1 != null) && ($image2 != null) && ($image3 == null)){
            $i=3;
            $sql = $conn->prepare("UPDATE host SET ho_pathfoto = \"$ho_pathfoto\", ho_image$i = \"$ho_image\" WHERE ho_id = $ho_id AND ho_image$i is null");
            $sql->execute();
        }
        elseif(($i == 1) && ($image1 != null) && ($image2 != null) && ($image3 != null) && ($image4 == null)){
            $i=4;
            $sql = $conn->prepare("UPDATE host SET ho_pathfoto = \"$ho_pathfoto\", ho_image$i = \"$ho_image\" WHERE ho_id = $ho_id AND ho_image$i is null");
            $sql->execute();
        }
    }

    /**
     * @param int $id
     * @param string $etichetta
     * @param string $tipo
     * @param string $modello
     * @param string $seriale
     * @param string $pwd: password
     * @param int $pwd_used: 1 | 0
     */
    public function update_host_info($id, $etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host SET ho_etichetta = \"$etichetta\",
                                               ho_tipo = \"$tipo\",
                                               ho_modello = \"$modello\",
                                               ho_seriale = \"$seriale\",
                                               ho_pwd = \"$pwd\",
                                               ho_pwd_used = $pwd_used
                               WHERE ho_id = $id");
        $sql->execute();
    }

    /**
     * Setta a NULL tutti i campi relativi alle immagini di un host
     * @param $ho_id
     */
    public function set_all_host_images_to_null($ho_id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image1 = null, 
                                             ho_image_docx = null, 
                                             ho_image_docx2 = null WHERE ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host SET ho_image2 = null WHERE ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host SET ho_image3 = null WHERE ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host SET ho_image4 = null WHERE ho_id = $ho_id");
        $sql->execute();
    }


    /**
     * Setta le info nel DB dell'immagine scelta per il DOCX
     * @param $IdHost
     * @param $ImgName
     */
    public function SET_DOCX_image1($IdHost, $ImgName)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image_docx = '$ImgName'
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }

    /**
     * Setta le info nel DB dell'immagine scelta per il DOCX
     * @param $IdHost
     * @param $ImgName
     */
    public function SET_DOCX_image2($IdHost, $ImgName)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image_docx2 = '$ImgName'
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }

    /**
     * Fa l'unset dell'immagine che non si vuole più utilizzare per il DOCX
     * @param $IdHost
     */
    public function UNSET_DOCX_host_image1($IdHost)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image_docx = null
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }

    /**
     * Fa l'unset dell'immagine che non si vuole più utilizzare per il DOCX
     * @param $IdHost
     */
    public function UNSET_DOCX_host_image2($IdHost)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image_docx2 = null
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }


    /**
     * Seleziona un host dal nome del modello.
     * Funzione utile per cercare rapidamente se un dato modello di dispositivo è già stato acquisito o meno e con quali modalità
     * @param $ho_modello
     * @return array
     */
    public function select_host_by_model($ho_modello)
    {
        $arr = array();

        if (!empty($ho_modello)) {
            $conn = DbManager::getConnection();
            $sql = $conn->prepare("SELECT * FROM host WHERE ho_modello LIKE '%$ho_modello%'");
            $sql->execute();

            while ($row = $sql->fetch()) {
                $arr[] = array(
                    'ho_id' => $row['ho_id'],
                    'ho_etichetta' => $row['ho_etichetta'],
                    'ho_seriale' => $row['ho_seriale'],
                    'ho_tipo' => $row['ho_tipo'],
                    'ho_modello' => $row['ho_modello'],
                    'ex_id_caso' => $row['ex_id_caso']
                );
            }
        }
        return $arr;
    }

    /**
     * Setta a NULL il campo corrispondente al nome della foto che viene passato come parametro.
     * @param $ho_id
     * @param $ho_image
     */
    public function set_ho_image_to_null($ho_id, $ho_image){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image1 = CASE
                                         WHEN ho_image1 = '$ho_image' THEN NULL 
                                         ELSE ho_image1 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image2 = CASE
                                         WHEN ho_image2 = '$ho_image' THEN NULL 
                                         ELSE ho_image2 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image3 = CASE
                                         WHEN ho_image3 = '$ho_image' THEN NULL 
                                         ELSE ho_image3 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host 
                                         SET ho_image4 = CASE
                                         WHEN ho_image4 = '$ho_image' THEN NULL 
                                         ELSE ho_image4 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
    }

}
