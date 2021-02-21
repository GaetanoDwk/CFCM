<?php

/**
 * Class ModelHostSpecial
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione degli HostSpecial
 */
class ModelHostSpecial
{

    /**
     * Variabili di classe
     * @var int $ho_id
     * @var string $ho_etichetta
     * @var string $ho_seriale
     * @var string $ho_tipo
     * @var string $ho_modello
     * @var string $ho_dimensione
     * @var string $ho_kbmbgbtb
     * @var string $ho_pathfoto
     * @var string $ho_image1
     * @var string $ho_image2
     * @var string $ho_image3
     * @var string $ho_image4
     * @var string $ho_img_docx
     * @var string $ho_img_docx2
     * @var int $ex_id_caso
     * @var int $ex_id_indagato
     * @var array $res
     * @var array $resForTreeMenu
     */
    private $ho_id,
            $ho_etichetta,
            $ho_seriale,
            $ho_tipo,
            $ho_modello,
            $ho_dimensione,
            $ho_kbmbgbtb,
            $ho_pathfoto,
            $ho_image1,
            $ho_image2,
            $ho_image3,
            $ho_image4,
            $ho_img_docx,
            $ho_img_docx2,
            $ex_id_caso,
            $ex_id_indagato,
            $res = array(),
            $resForTreeMenu = array();


    /**
     * Variabili statiche di classe.
     * @var string $ARCHIVIOIMG: directory in cui sono presenti le immagini
     * @var string $HO_ETI: etichetta
     * @var string $HO_SER: seriale
     * @var string $HO_TIPO: tipologia
     * @var string $HO_MOD: modello
     * @var string $HO_DIM: dimensione
     * @var string $HO_KBMBGBTB: KB | MB | GB | TB
     * @var string $HO_PATH: directory in cui sono le immagini
     * @var string $HO_IMG1: nome immagine 1
     * @var string $HO_IMG2: nome immagine 2
     * @var string $HO_IMG3: nome immagine 3
     * @var string $HO_IMG4: nome immagine 4
     * @var string $HO_IMGDOCX: nome immagine scelta per il DOCX
     * @var string $HO_IMGDOCX2: nome seconda immagine scelta per il DOCX
     * @var string $EX_ID_CASO: chiave esterna relativa all'ID del caso (tabella "caso")
     * @var string $EX_ID_INDAGATO: chiave esterna relativa all'ID indagato (tabella "indagato")
     */
    private $ARCHIVIOIMG = "archivioimg",
             $HO_ID = "ho_id",
             $HO_ETI = "ho_etichetta",
             $HO_SER = "ho_seriale",
             $HO_TIPO = "ho_tipo",
             $HO_MOD = "ho_modello",
             $HO_DIM = "ho_dimensione",
             $HO_KBMBGBTB = "ho_kbmbgbtb",
             $HO_PATH = "ho_pathfoto",
             $HO_IMG1 = "ho_image1",
             $HO_IMG2 = "ho_image2",
             $HO_IMG3 = "ho_image3",
             $HO_IMG4 = "ho_image4",
             $HO_IMGDOCX = "ho_image_docx",
             $HO_IMGDOCX2 = "ho_image_docx2",
             $EX_ID_CASO = "ex_id_caso",
             $EX_ID_INDAGATO = "ex_id_indagato";


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

    public function set_ho_tipo($value){
        $this->ho_tipo = $value;
    }

    public function set_ho_modello($value){
        $this->ho_modello = $value;
    }

    public function set_ho_dimensione($value){
        $this->ho_dimensione = $value;
    }

    public function set_ho_kbmbgbtb($value){
        $this->ho_kbmbgbtb = $value;
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
        $this->ho_img_docx = $value;
    }

    public function set_ho_image_docx2($value){
        $this->ho_img_docx2 = $value;
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

    public function get_ho_tipo(){
        return $this->ho_tipo;
    }

    public function get_ho_modello(){
        return $this->ho_modello;
    }

    public function get_ho_dimensione(){
        return $this->ho_dimensione;
    }

    public function get_ho_kbmbgbtb(){
        return $this->ho_kbmbgbtb;
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

    public function get_ho_image_docx(){
        return $this->ho_img_docx;
    }

    public function get_ho_image_docx2(){
        return $this->ho_img_docx2;
    }

    public function get_ex_id_caso(){
        return $this->ex_id_caso;
    }

    public function get_ex_id_indagato(){
        return $this->ex_id_indagato;
    }

    public function get_res(){
        return $this->res;
    }




    public function setRes($ho_id, $ho_etichetta, $ho_seriale, $ho_tipo, $ho_modello, $ho_dimensione, $ho_kbmbgbtb, $ho_pathfoto, $ho_image1, $ho_image2, $ho_image3, $ho_image4)
    {
        $this->res[] = array($this->HO_ID => $ho_id,
                             $this->HO_ETI => $ho_etichetta,
                             $this->HO_SER => $ho_seriale,
                             $this->HO_TIPO => $ho_tipo,
                             $this->HO_MOD => $ho_modello,
                             $this->HO_DIM => $ho_dimensione,
                             $this->HO_KBMBGBTB => $ho_kbmbgbtb,
                             $this->HO_PATH => $ho_pathfoto,
                             $this->HO_IMG1 => $ho_image1,
                             $this->HO_IMG2 => $ho_image2,
                             $this->HO_IMG3 => $ho_image3,
                             $this->HO_IMG4 => $ho_image4);
    }


    /**
     * Seleziona l'ultimo ID dell'ultimo host special inserito nel DB
     */
    public function select_last_id()
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT MAX(ho_id) AS ho_id FROM host_special");
        $sql->execute();
        while($row = $sql->fetch()){
            $this->set_ho_id($row[$this->HO_ID]);
        }
    }


    /**
     * Seleziona tutti gli host special di un indagato
     * @param $ind_id
     * @return array
     */
    public function select_hosts_special_of_indagato($ind_id)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM host_special WHERE ex_id_indagato = ". $ind_id);
        $sql->execute();
        $arr = array();

        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ho_id' => $row['ho_id'],
                'ho_etichetta' => $row['ho_etichetta'],
                'ho_seriale' => $row['ho_seriale'],
                'ho_tipo' => $row['ho_tipo'],
                'ho_modello' => $row['ho_modello'],
                'ho_dimensione' => $row['ho_dimensione'],
                'ho_kbmbgbtb' => $row['ho_kbmbgbtb'],
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
     * Seleziona le tipologie degli host special dalla tabella "tipo_host_special"
     * @return array
     */
    public function select_hos_tipo()
    {
        $arr = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tipo_host_special ORDER BY hos_tipo ASC");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'hos_tipo_id' => $row['hos_tipo_id'],
                'hos_tipo' => $row['hos_tipo'],
                'hos_icon' => $row['hos_icon']);
        }

        return $arr;
    }


    /**
     * Seleziona le tipologie di host special eliminabili (flag impostato a zero)
     * @return array
     */
    public function select_hos_tipo_for_delete()
    {
        $arr = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tipo_host_special WHERE hos_default = 0");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'hos_tipo_id' => $row['hos_tipo_id'],
                'hos_tipo' => $row['hos_tipo'],
                'hos_icon' => $row['hos_icon']);
        }

        return $arr;
    }

    /**
     * Seleziona un singolo host special
     * @param $ho_id
     */
    public function select_host_special($ho_id)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();
        // PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM host_special WHERE ho_id = $ho_id");
        $sql->execute();
        while ($row = $sql->fetch())
        {
            // SETTA LE VARIABILI DI CLASSE STATICHE
            $this->set_ho_id($row[$this->HO_ID]);
            $this->set_ho_etichetta($row[$this->HO_ETI]);
            $this->set_ho_seriale($row[$this->HO_SER]);
            $this->set_ho_tipo($row[$this->HO_TIPO]);
            $this->set_ho_modello($row[$this->HO_MOD]);
            $this->set_ho_dimensione($row[$this->HO_DIM]);
            $this->set_ho_kbmbgbtb($row[$this->HO_KBMBGBTB]);
            $this->set_ho_pathfoto($row[$this->HO_PATH]);
            $this->set_ho_image1($row[$this->HO_IMG1]);
            $this->set_ho_image2($row[$this->HO_IMG2]);
            $this->set_ho_image3($row[$this->HO_IMG3]);
            $this->set_ho_image4($row[$this->HO_IMG4]);
            $this->set_ho_image_docx($row[$this->HO_IMGDOCX]);
            $this->set_ho_image_docx2($row[$this->HO_IMGDOCX2]);
            $this->set_ex_id_caso($row[$this->EX_ID_CASO]);
            $this->set_ex_id_indagato($row[$this->EX_ID_INDAGATO]);
        }
    }

    /**
     * Seleziona le info di tutti gli host special (comprensivi anche dei cloni) relativi ad un certo indagato.
     * @param $ind_id
     * @return array
     */
    public function select_host_special_report($ind_id){
        $arr = array();
        //CONESSIONE AL DB
        $conn = DbManager::getConnection();
        //PREPARA ED ESEGUE LA QUERY
        $sql = $conn->prepare("SELECT ho_id, ho_etichetta, ho_seriale, ho_tipo, ho_modello, ho_dimensione, ho_kbmbgbtb, ho_pathfoto, ho_image1, ho_image2, ho_image3, ho_image4,
                                      clo_id, clo_tipoacq, clo_altro_tipo, clo_stracq, clo_md5, clo_sha1, clo_sha256, clo_log
                               FROM host_special
                               LEFT OUTER JOIN clone ON clone.ex_id_host_special = host_special.ho_id
                               WHERE ex_id_indagato = $ind_id ORDER BY ho_id");
        $sql->execute();
        //RIEMPIE L'ARRAY CON I DATI SELEZIONATI
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'ho_id' => $row['ho_id'],
                'ho_etichetta' => $row['ho_etichetta'],
                'ho_seriale' => $row['ho_seriale'],
                'ho_tipo' => $row['ho_tipo'],
                'ho_modello' => $row['ho_modello'],
                'ho_dimensione' => $row['ho_dimensione'],
                'ho_kbmbgbtb' => $row['ho_kbmbgbtb'],
                'ho_pathfoto' => $row['ho_pathfoto'],
                'ho_image1' => $row['ho_image1'],
                'ho_image2' => $row['ho_image2'],
                'ho_image3' => $row['ho_image3'],
                'ho_image4' => $row['ho_image4'],
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


    /**
     * Inserisce un nuovo host special nel DB
     * @param string $etichetta
     * @param string $tipo
     * @param string $modello
     * @param string $dimensione
     * @param string $kbmbgbtb: KB | MB | GB | TB
     * @param string $seriale
     * @param int $ex_id_caso: chiave esterna relativa all'id del caso (tabella "caso")
     * @param int $ex_id_indagato: chiave esterna relativa all'id dell'indagato (tabella "indagato")
     */
    public function insert_host_special($etichetta, $tipo, $modello, $dimensione, $kbmbgbtb, $seriale, $ex_id_caso, $ex_id_indagato)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();
        // INSERIMENTO
        $sql = $conn->prepare("INSERT INTO host_special (ho_etichetta, ho_tipo, ho_modello, ho_dimensione, ho_kbmbgbtb, ho_seriale, ex_id_caso, ex_id_indagato) VALUES (\"$etichetta\", \"$tipo\", \"$modello\", \"$dimensione\", \"$kbmbgbtb\", \"$seriale\", $ex_id_caso, $ex_id_indagato)");
        $sql->execute();

    }


    /**
     * Inserisce una nuova tipologia di host special.
     * @param $HosTipo
     * @param $PathIcona
     */
    public function insert_hos_tipo($HosTipo, $PathIcona)
    {
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();
        // INSERIMENTO
        $sql = $conn->prepare("INSERT INTO tipo_host_special (hos_tipo, hos_icon) VALUES (\"$HosTipo\", \"$PathIcona\")");
        $sql->execute();
    }


    /**
     * Elimina una tipologia di host special.
     * @param $IdTipo
     */
    public function del_hos_tipo($IdTipo)
    {
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();
        // ELIMINAZIONE
        $sql = $conn->prepare("DELETE from tipo_host_special WHERE hos_tipo_id =". $IdTipo);
        $sql->execute();
    }


    /**
     * Elimina un host special dal DB
     * @param $ho_id
     */
    public function delete_host_special($ho_id)
    {
        // CONNESSIONE AL DB
        $conn = DbManager::getConnection();
        // ELIMINAZIONE
        $sql = $conn->prepare("DELETE from host_special WHERE ho_id =". $ho_id);
        $sql->execute();
    }


    /**
     * Esegue l'upload di N immagini relative all'host special corrente.
     * @param int $IdProcura
     * @param int $IdPm
     * @param int $IdCaso
     * @param int $IdIndagato
     * @param int $IdHost
     */
    public function upload_multiple_image($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost)
    {
        $PathHostImg = $this->create_host_images_path($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost);
        $i = 0;
        if(!empty($_FILES["file"])) {
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
                            $this->update_host_single_photo($IdHost, $PathHostImg, $NomeImg, $i);
                            if(!$risultato) {
                                die("Errore imprevisto durante lo spostamento dell'immagine! :(");
                            }
                            //} else {  die("Il file selezionato è troppo grande, non deve superare 1MB!"); }
                        } else {  die("Estensione non consentita! Hai cercato di caricare un file ." . $estensione . "!"); }
                    } else {  die("Errore imprevisto durante il caricamento dell'immagine! :("); }
                } else {break;}
            }
        } else { die("Nessun file selezionato."); }
    }


    /**
     * Genera il path relativo alle foto dell'host corrente.
     * @param $IdProcura
     * @param $IdPm
     * @param $IdCaso
     * @param $IdIndagato
     * @param $IdHost
     * @return string
     */
    public function create_host_images_path($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost)
    {
        $PathHostImg = $this->ARCHIVIOIMG . '/' . 'cli_' . $IdProcura . '/' . 'pm_' . $IdPm . '/' . 'ca_' . $IdCaso . '/' . 'ind_' . $IdIndagato . '/' . 'hosp_' . $IdHost . '/' . 'images/';
        if (!file_exists($PathHostImg)) {
            mkdir($PathHostImg, 0777, true);
        }
        return $PathHostImg;
    }


    /**
     * Aggiorna la info nel DB relative ad una singola foto di un host_special
     * @param $ho_id
     * @param $ho_pathfoto
     * @param $ho_image
     * @param $i
     */
    public function update_host_single_photo($ho_id, $ho_pathfoto, $ho_image, $i){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_pathfoto = \"$ho_pathfoto\", ho_image$i = \"$ho_image\" WHERE ho_id = $ho_id");
        $sql->execute();
    }

    /**
     * Aggiorna le informazioni di uno uno special host.
     * @param int $id
     * @param string $etichetta
     * @param string $tipo
     * @param string $modello
     * @param string $dimensione
     * @param string $kbmbgbtb: KB | MB | GB | TB
     * @param string $seriale
     */
    public function update_special_host($id, $etichetta, $tipo, $modello, $dimensione, $kbmbgbtb, $seriale)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_etichetta = \"$etichetta\",
                                               ho_tipo = \"$tipo\",
                                               ho_modello = \"$modello\",
                                               ho_dimensione = \"$dimensione\",
                                               ho_kbmbgbtb = \"$kbmbgbtb\",
                                               ho_seriale = \"$seriale\"
                               WHERE ho_id = $id");
        $sql->execute();
    }

    /**
     * Setta le info della prima immagine
     * @param $ho_id
     */
    public function set_ho_spec_image1_to_null($ho_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_image1 = null WHERE ho_id = $ho_id");
        $sql->execute();
    }

    /**
     * Setta le info della seconda immagine
     * @param $ho_id
     */
    public function set_ho_spec_image2_to_null($ho_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_image2 = null WHERE ho_id = $ho_id");
        $sql->execute();
    }

    /**
     * Setta le info della terza immagine
     * @param $ho_id
     */
    public function set_ho_spec_image3_to_null($ho_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_image3 = null WHERE ho_id = $ho_id");
        $sql->execute();
    }

    /**
     * Setta le info della quarta immagine
     * @param $ho_id
     */
    public function set_ho_spec_image4_to_null($ho_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_image4 = null WHERE ho_id = $ho_id");
        $sql->execute();
    }

    /**
     * Setta a NULL le info nel DB relative all'immagine scelta per il DOCX
     * @param $ho_id
     */
    public function set_hostSP_image_docx_to_null($ho_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_image_docx = null WHERE ho_id = $ho_id");
        $sql->execute();
    }

    /**
     * Setta a NULL le info nel DB relative all'immagine 2 scelta per il DOCX.
     * @param $ho_id
     */
    public function set_hostSP_image_docx2_to_null($ho_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special SET ho_image_docx2 = null WHERE ho_id = $ho_id");
        $sql->execute();
    }

    /**
     * Setta nel DB le info relative all'immagine 1 scelta per il DOCX.
     * @param $IdHost
     * @param $ImgName
     */
    public function SET_DOCX_image1($IdHost, $ImgName)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image_docx = '$ImgName'
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }

    /**
     * Setta nel DB le info relative all'immagine 2 scelta per il DOCX.
     * @param $IdHost
     * @param $ImgName
     */
    public function SET_DOCX_image2($IdHost, $ImgName)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image_docx2 = '$ImgName'
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }

    /**
     * De-setta le info dal DB relative all'immagine 1 che si vuole togliere dal DOCX
     * @param $IdHost
     * @param $ImgName
     */
    public function UNSET_DOCX_hostSP_image1($IdHost)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image_docx = null
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }

    /**
     * De-setta le info dal DB relative all'immagine 2 che si vuole togliere dal DOCX
     * @param $IdHost
     * @param $ImgName
     */
    public function UNSET_DOCX_hostSP_image2($IdHost)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image_docx2 = null
                                         WHERE ho_id = $IdHost");
        $sql->execute();

    }

    /**
     * Setta nel DB tutti i campi delle immagini a NULL
     * @param $IdHost
     * @param $ImgName
     */
    public function set_hostSP_image_to_null($ho_id, $ho_image){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image1 = CASE
                                         WHEN ho_image1 = '$ho_image' THEN NULL 
                                         ELSE ho_image1 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image2 = CASE
                                         WHEN ho_image2 = '$ho_image' THEN NULL 
                                         ELSE ho_image2 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image3 = CASE
                                         WHEN ho_image3 = '$ho_image' THEN NULL 
                                         ELSE ho_image3 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE host_special 
                                         SET ho_image4 = CASE
                                         WHEN ho_image4 = '$ho_image' THEN NULL 
                                         ELSE ho_image4 
                                         END			 
                                         WHERE  ho_id = $ho_id");
        $sql->execute();
    }

}
