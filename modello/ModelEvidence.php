<?php

/**
 * Class ModelEvidence
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione degli evidence.
 */
class ModelEvidence
{

    /**
     * Variabili di classe
     * @var int $evi_id: identificativo
     * @var string $evi_etichetta: etichetta
     * @var string $evi_tipo: tipologia
     * @var string $evi_modello: modello
     * @var string $evi_seriale: seriale
     * @var string $evi_pwd: password
     * @var int $evi_pwd_used: password utilizzata (valore 1|0)
     * @var string $evi_dimensione: dimensione
     * @var string $evi_kbmbgbtb: KB | MB | GB | TB
     * @var string $evi_pathfoto: path in cui si trovano le foto
     * @var string $image1: nome prima foto comprensivo di estensione
     * @var string $image2: noto seconda foto comprensivo di estensione
     * @var string $image3: nome terza foto comprensivo di estensione
     * @var string $image_docx: nome foto da integrare nelle intestazioni da incollare in consulenza (file docx)
     * @var int $ex_id_host: chiave esterna riferita all'id dell'host a cui appartiene l'evidence corrente
     * @var array res
     */
    private $evi_id,
            $evi_etichetta,
            $evi_tipo,
            $evi_modello,
            $evi_seriale,
            $evi_pwd,
            $evi_pwd_used,
            $evi_dimensione,
            $evi_kbmbgbtb,
            $evi_pathfoto,
            $image1,
            $image2,
            $image3,
            $image_docx,
            $ex_id_host,
            $res = array();


    /**
     * @var string $ARCHIVIOIMG:
     * @var int $EVI_ID: identificativo
     * @var string $EVI_ETI: etichetta
     * @var string $EVI_TIP: tipologia
     * @var string $EVI_MOD: modello
     * @var string $EVI_SER: seriale
     * @var string $EVI_DIM: dimensione
     * @var string $EVI_KMGT: KB | MB| GB | TB
     * @var string $EVI_PATHFOTO: path in cui si trovano le fotografie
     * @var string $IMAGE1: nome prima immagine comprensivo di estensione
     * @var string $IMAGE2: nome seconda immagine comprensivo di estensione
     * @var string $IMAGE3: nome terza immagine comprensivo di estensione
     * @var int $EX_ID_HOST: chiave esterna riferita all'identificativo dell'host a cui appartiene l'evidence
     */
    private $ARCHIVIOIMG = "archivioimg",
            $EVI_ID = "evi_id",
            $EVI_ETI = "evi_etichetta",
            $EVI_TIP = "evi_tipo",
            $EVI_MOD = "evi_modello",
            $EVI_SER = "evi_seriale",
            $EVI_DIM = "evi_dimensione",
            $EVI_KMGT = "evi_kbmbgbtb",
            $EVI_PATHFOTO = "evi_pathfoto",
            $IMAGE1 = "evi_image1",
            $IMAGE2 = "evi_image2",
            $IMAGE3 = "evi_image3",
            $EX_ID_HOST = "ex_id_host";

    // SETTERS
    public function set_evi_id($value){
        $this->evi_id = $value;
    }

    public function set_evi_etichetta($value){
        $this->evi_etichetta = $value;
    }

    public function set_evi_tipo($value){
        $this->evi_tipo = $value;
    }

    public function set_evi_seriale($value){
        $this->evi_seriale = $value;
    }

    public function set_evi_modello($value){
        $this->evi_modello = $value;
    }

    public function set_evi_pwd($value){
        $this->evi_pwd = $value;
    }

    public function set_evi_pwd_used($value){
        $this->evi_pwd_used = $value;
    }

    public function set_evi_kbmbgbtb($value){
        $this->evi_kbmbgbtb = $value;
    }

    public function set_evi_dimensione($value){
        $this->evi_dimensione = $value;
    }

    public function set_evi_pathfoto($value){
        $this->evi_pathfoto = $value;
    }

    public function set_image1($value){
        $this->image1 = $value;
    }

    public function set_image2($value){
        $this->image2 = $value;
    }

    public function set_image3($value){
        $this->image3 = $value;
    }

    public function set_image_docx($value){
        $this->image_docx = $value;
    }

    public function set_ex_id_host($value){
        $this->ex_id_host = $value;
    }

    // GETTERS
    public function get_evi_id(){
        return $this->evi_id;
    }

    public function get_evi_etichetta(){
        return $this->evi_etichetta;
    }

    public function get_evi_tipo(){
        return $this->evi_tipo;
    }

    public function get_evi_seriale(){
        return $this->evi_seriale;
    }

    public function get_evi_pwd(){
        return $this->evi_pwd;
    }

    public function get_evi_pwd_used(){
        return $this->evi_pwd_used;
    }

    public function get_evi_modello(){
        return $this->evi_modello;
    }

    public function get_evi_dimensione(){
        return $this->evi_dimensione;
    }

    public function get_evi_kbmbgbtb(){
        return $this->evi_kbmbgbtb;
    }

    public function get_evi_pathfoto(){
        return $this->evi_pathfoto;
    }

    public function get_pathfoto(){
        return $this->evi_pathfoto;
    }

    public function get_image1(){
        return $this->image1;
    }

    public function get_image2(){
        return $this->image2;
    }

    public function get_image3(){
        return $this->image3;
    }

    public function get_image_docx(){
        return $this->image_docx;
    }

    public function get_ex_id_host(){
        return $this->ex_id_host;
    }

    public function getRes()
    {
        return $this->res;
    }

    public function setRes($evi_id, $evi_etichetta, $evi_tipo, $evi_modello, $evi_seriale, $evi_dimensione, $kmgt, $evi_pathfoto, $image1, $image2, $image3, $ex_id_host)
    {
        $this->res[] = array(
            $this->EVI_ID => $evi_id,
            $this->EVI_ETI => $evi_etichetta,
            $this->EVI_TIP => $evi_tipo,
            $this->EVI_MOD => $evi_modello,
            $this->EVI_SER => $evi_seriale,
            $this->EVI_DIM => $evi_dimensione,
            $this->EVI_KMGT => $kmgt,
            $this->EVI_PATHFOTO => $evi_pathfoto,
            $this->IMAGE1 => $image1,
            $this->IMAGE2 => $image2,
            $this->IMAGE3 => $image3,
            $this->EX_ID_HOST => $ex_id_host);
    }

    /**
     * Seleziona un evidence singolo
     * @param $id: il codice ID è il criterio di selezione
     */
    public function select_single_evidence($id)
    {
        $conn = DbManager::getConnection();

        $sql = $conn->prepare("SELECT * FROM evidence WHERE evi_id= '$id'");
        $sql->execute();

        while ($row = $sql->fetch()) {
            $this->set_evi_id($row[$this->EVI_ID]);
            $this->set_evi_etichetta($row[$this->EVI_ETI]);
            $this->set_evi_tipo($row[$this->EVI_TIP]);
            $this->set_evi_modello($row[$this->EVI_MOD]);
            $this->set_evi_seriale($row[$this->EVI_SER]);
            $this->set_evi_pwd($row['evi_pwd']);
            $this->set_evi_pwd_used($row['evi_pwd_used']);
            $this->set_evi_dimensione($row[$this->EVI_DIM]);
            $this->set_evi_kbmbgbtb($row[$this->EVI_KMGT]);
            $this->set_evi_pathfoto($row[$this->EVI_PATHFOTO]);
            $this->set_image1($row[$this->IMAGE1]);
            $this->set_image2($row[$this->IMAGE2]);
            $this->set_image3($row[$this->IMAGE3]);
            $this->set_image_docx($row['evi_image_docx']);
            $this->set_ex_id_host($row[$this->EX_ID_HOST]);

        }
    }

    /**
     * Setta l'immagine che dovrà comparire nelle intestazioni generate utili ad essere incollate nella consulenza (file DOCX)
     * @param int $IdEvi: codice id dell' evidence
     * @param string $ImgEvi: nome dell'immagine scelta per l'anteprima utile al DOCX
     */
    public function SET_DOCX_evi_image($IdEvi, $ImgEvi)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE evidence 
                                         SET evi_image_docx = '$ImgEvi'
                                         WHERE evi_id = $IdEvi");
        $sql->execute();
    }

    /**
     * Deseleziona l'immagine precedentemente scelta per il DOCX.
     * @param $IdEvi: codice id dell'evidence
     */
    public function UNSET_DOCX_evi_image($IdEvi)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE evidence 
                                         SET evi_image_docx = null
                                         WHERE evi_id = $IdEvi");
        $sql->execute();

    }

    /**
     * @param int $IdHost: identificativo Host
     * @return int count: ritorna il conteggio di quanti evidence di un host sono presenti nel DB
     */
    public function count_evidences_of_host($IdHost)
    {
        $conn = DbManager::getConnection();

        $sql = $conn->prepare("SELECT * FROM evidence WHERE ex_id_host= '$IdHost'");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }

    /**
     * Seleziona l'ID dell'ultimo evidence inserito nel DB
     */
    public function select_last_evidence()
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT MAX(evi_id) AS evi_id FROM evidence");
        $sql->execute();
        while($row = $sql->fetch())
        {
            $this->set_evi_id($row[$this->EVI_ID]);
        }
    }

    /**
     * Seleziona tutti gli evidence relativi ad un host
     * @param $ho_id: l'ID host è il criterio di selezione
     */
    public function select_evidence_of_host($ho_id)
    {
        //___________________
        // Connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM evidence WHERE ex_id_host = '$ho_id'");
        $sql->execute();

        while ($row = $sql->fetch())
        {
            $this->setRes(
                $row[$this->EVI_ID],
                $row[$this->EVI_ETI],
                $row[$this->EVI_TIP],
                $row[$this->EVI_MOD],
                $row[$this->EVI_SER],
                $row[$this->EVI_DIM],
                $row[$this->EVI_KMGT],
                $row[$this->EVI_PATHFOTO],
                $row[$this->IMAGE1],
                $row[$this->IMAGE2],
                $row[$this->IMAGE3],
                $row[$this->EX_ID_HOST]);

        }
    }

    /**
     * Seleziona le tipologie degli evidence
     * @return array
     */
    public function select_tipi_evidence()
    {
        $arr = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tipo_evidence ORDER BY evi_tipo ASC");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'evi_id_tipo' => $row['evi_id_tipo'],
                'evi_tipo' => $row['evi_tipo'],
                'evi_icon' => $row['evi_icon']);
        }

        return $arr;
    }

    /**
     * Seleziona le tipologie di evidence per la pagina che permette di scegliere quale eliminare.
     * @return array
     */
    public function select_tipi_evidence_for_delete()
    {
        $arr = array();
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tipo_evidence WHERE evi_default = 0");
        $sql->execute();
        while ($row = $sql->fetch()) {

            $arr[] = array(
                'evi_id_tipo' => $row['evi_id_tipo'],
                'evi_tipo' => $row['evi_tipo'],
                'evi_icon' => $row['evi_icon']);
        }

        return $arr;
    }

    /**
     * Conta le occorrenze degli evidence duplicati. Questo serve prima di un nuovo inserimento per evitare di inserire un duplicato.
     * @param $IdInd: identificativo indagato
     * @param $etichetta: etichetta dell'evidence
     * @return int
     */
    public function count_evidence_duplicates_of_indagato($IdInd, $etichetta)
    {
        //___________________
        // Connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM evidence LEFT OUTER JOIN host ON host.ho_id = evidence.ex_id_host
                                                      LEFT OUTER JOIN indagato ON indagato.ind_id = host.ex_id_indagato
                                                      WHERE ind_id = $IdInd AND evi_etichetta = '$etichetta'");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }

    /**
     * Elimina la tipologia di un evidence
     * @param $IdTipoEvi: codice id del tipo di evidence nella tabella "Tipo_evidence"
     */
    public function del_tipo_evi($IdTipoEvi)
    {   //___________________
        // Connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from tipo_evidence WHERE evi_id_tipo =". $IdTipoEvi);
        $sql->execute();
    }


    /**
     * Inserisce un nuovo evidence nel DB
     * @param string $evi_etichetta: etichetta
     * @param string $evi_tipo: tipologia
     * @param string $evi_modello: modello
     * @param string $evi_seriale: numero seriale
     * @param string $evi_pwd: password
     * @param int $evi_pwd_used: 1 | 0
     * @param string $evi_dimensione: dimensione
     * @param string $evi_kbmbgbtb: KB| MB| GB| TB
     * @param int $ex_id_host: chiave esterna relativa al codice ID dell'host a cui appartiene l'evidence corrente
     */
    public function insert_evidence($evi_etichetta, $evi_tipo, $evi_modello, $evi_seriale, $evi_pwd, $evi_pwd_used, $evi_dimensione, $evi_kbmbgbtb, $ex_id_host)
    {
        //___________________
        // Connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO evidence (evi_etichetta, evi_tipo, evi_modello, evi_seriale, evi_pwd, evi_pwd_used, evi_dimensione, evi_kbmbgbtb, ex_id_host) VALUES (\"$evi_etichetta\", \"$evi_tipo\", \"$evi_modello\", \"$evi_seriale\", \"$evi_pwd\", $evi_pwd_used, \"$evi_dimensione\", \"$evi_kbmbgbtb\", $ex_id_host)");
        $sql->execute();

    }


    /**
     * Elimina un evidence dal DB
     * @param $evi_id: identificativo evidence
     */
    public function delete_evidence($evi_id)
    {   //___________________
        // Connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from evidence WHERE evi_id =". $evi_id);
        $sql->execute();
    }


    /**
     * Esegue l'upload delle immagini di un evidence
     * @param int $IdProcura
     * @param int $IdPm
     * @param int $IdCaso
     * @param int $IdIndagato
     * @param int $IdHost
     * @param int $IdEvidence
     * Sfrutta i codici ID per creare un albero di directory (categorie e sotto-categorie) fino ad arrivare alla directory
     * dell'evidence in cui andranno le sue immagini
     * @return string
     */
    public function upload_evidence_images($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost, $IdEvidence)
    {
        $Path = $this->create_evidence_images_path($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost, $IdEvidence);
        $i = 0;

        if(!empty($_FILES["file"])) {
            $count = count($_FILES["file"]["name"]);
            foreach ($_FILES["file"]["name"] as $indice => $nome) {
                $i++;
                if($i <= 3) {
                    if($_FILES["file"]["error"][$indice] == 0) {
                        $estensione = pathinfo($_FILES["file"]["name"][$indice], PATHINFO_EXTENSION);
                        if($estensione == "png" || $estensione == "jpg" || $estensione == "PNG" || $estensione == "JPG") {
                            //if($_FILES["file"]["size"][$indice] < 1000000) {
                            $risultato = move_uploaded_file($_FILES["file"]["tmp_name"][$indice], $Path . "/" . $_FILES["file"]["name"][$indice]);
                            $NomeImg = pathinfo($_FILES["file"]["name"][$indice], PATHINFO_FILENAME);
                            $NomeImg = $NomeImg . "." . $estensione;
                            // Se la foto selezionata ne è una
                            if($count == 1) {
                                $this->update_evidence_single_photo($IdEvidence, $Path, $NomeImg, $i);
                            }
                            // Se le foto selezionate sono più di una
                            if($count > 1){
                                $this->update_evidence_photos($IdEvidence, $Path, $NomeImg, $i);
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
        } else { $stringa = "Nessun File Selezionato";
            return $stringa; }
    }


    /**
     * Crea una stringa contenente il path delle foto che saranno uploadate.
     * @param int $IdProcura
     * @param int $IdPm
     * @param int $IdCaso
     * @param int $IdIndagato
     * @param int $IdHost
     * @param int $IdEvidence
     * @return string
     */
    public function create_evidence_images_path($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost, $IdEvidence)
    {
        $PathEvidImg = $this->ARCHIVIOIMG . '/'. 'cli_' . $IdProcura . '/' . 'pm_' . $IdPm . '/' . 'ca_' . $IdCaso . '/' . 'ind_' . $IdIndagato . '/' . 'ho_' . $IdHost . '/' . 'evi_' . $IdEvidence .'/';
        if (!file_exists($PathEvidImg)) {
            mkdir($PathEvidImg, 0777, true);
        }
        return $PathEvidImg;
    }


    /**
     * Esegue la modifica delle informazioni nel DB di una foto
     * @param int $evi_id: codice id evidence
     * @param string $evi_pathfoto: path in cui sono presenti le foto
     * @param string $evi_image: nome della foto comprensivo dell'estensione
     * @param int $i
     */
    public function update_evidence_single_photo($evi_id, $evi_pathfoto, $evi_image, $i){
        $conn = DbManager::getConnection();
        $this->select_single_evidence($evi_id);
        $image1 = $this->get_image1();
        $image2 = $this->get_image2();
        $image3 = $this->get_image3();
        if(($i == 1) && ($image1 == null)) {
            $sql = $conn->prepare("UPDATE evidence SET evi_pathfoto = \"$evi_pathfoto\", evi_image$i = \"$evi_image\" WHERE evi_id = $evi_id AND evi_image$i is null");
            $sql->execute();
        }
        elseif(($i == 1) && ($image1 != null) && ($image2 == null)){
            $i=2;
            $sql = $conn->prepare("UPDATE evidence SET evi_pathfoto = \"$evi_pathfoto\", evi_image$i = \"$evi_image\" WHERE evi_id = $evi_id AND evi_image$i is null");
            $sql->execute();
        }
        elseif(($i == 1) && ($image1 != null) && ($image2 != null) && ($image3 == null)){
            $i=3;
            $sql = $conn->prepare("UPDATE evidence SET evi_pathfoto = \"$evi_pathfoto\", evi_image$i = \"$evi_image\" WHERE evi_id = $evi_id AND evi_image$i is null");
            $sql->execute();
        }
    }

    /**
     * Esegue la modifica delle informazioni nel DB di una foto.
     * @param int $evi_id: codice id evidence
     * @param string $evi_pathfoto: path in cui sono contenute le foto
     * @param string $evi_image: nome delle foto comprensivo di estensione
     * @param int $i
     */
    public function update_evidence_photos($evi_id, $evi_pathfoto, $evi_image, $i)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE evidence SET evi_pathfoto = \"$evi_pathfoto\", evi_image$i = \"$evi_image\" WHERE evi_id = $evi_id AND evi_image$i is null");
        $sql->execute();
    }

    /**
     * Modifica le informazioni di un evidence nel DB
     * @param $id: codice ID
     * @param $etichetta
     * @param $tipo
     * @param $modello
     * @param $seriale
     * @param $pwd: password
     * @param $pwd_used: password usata (1 | 0)
     * @param $dimensione
     * @param $kbmbgbtb: KB| MB| GB| TB
     */
    public function update_evidence_info($id, $etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $dimensione, $kbmbgbtb)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE evidence SET evi_etichetta = \"$etichetta\",
                                               evi_tipo = \"$tipo\",
                                               evi_modello = \"$modello\",
                                               evi_seriale = \"$seriale\",
                                               evi_pwd = \"$pwd\",
                                               evi_pwd_used = $pwd_used,
                                               evi_dimensione = \"$dimensione\",
                                               evi_kbmbgbtb = \"$kbmbgbtb\"
                               WHERE evi_id = $id");
        $sql->execute();
    }

    /**
     * Setta tutte le immagini relative ad un evidence a NULL nel DB
     * @param int $id: criterio di selezione dell'evidence
     */
    public function set_all_evi_images_to_null($id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE evidence 
                                         SET evi_image1 = null, 
                                             evi_image2 = null, 
                                             evi_image3 = null,  
                                             evi_image_docx = null 
                                         WHERE evi_id = $id");
        $sql->execute();
    }


    /**
     * Setta il campo evi_image a null.
     * @param int $evi_id
     * @param string $evi_image
     * entrambi i parametri sono usati come criterio per settare a null evi_image1, evi_image2 oppure evi_image3
     */
    public function set_evi_image_to_null($evi_id, $evi_image){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE evidence 
                                         SET evi_image1 = CASE
                                         WHEN evi_image1 = '$evi_image' THEN NULL 
                                         ELSE evi_image1 
                                         END			 
                                         WHERE  evi_id = $evi_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE evidence 
                                         SET evi_image2 = CASE
                                         WHEN evi_image2 = '$evi_image' THEN NULL 
                                         ELSE evi_image2
                                         END			 
                                         WHERE  evi_id = $evi_id");
        $sql->execute();
        $sql = $conn->prepare("UPDATE evidence 
                                         SET evi_image3 = CASE
                                         WHEN evi_image3 = '$evi_image' THEN NULL 
                                         ELSE evi_image3 
                                         END			 
                                         WHERE  evi_id = $evi_id");
        $sql->execute();
    }

    /**
     * Inserisce un nuovo tipo di evidence
     * @param string $EviTipo: nome della tipologia
     * @param string $PathIcona: path dell'icona
     */
    public function insert_tipo_evi($EviTipo, $PathIcona)
    {
        //___________________
        // Connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO tipo_evidence (evi_tipo, evi_icon) VALUES (\"$EviTipo\", \"$PathIcona\")");
        $sql->execute();

    }


}
