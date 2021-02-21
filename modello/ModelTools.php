<?php

/**
 * Created by PhpStorm.
 * User: Gaetano
 * Date: 14/05/2015
 * Time: 12:31
 * Class Model Tools
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione relative alla tabella "tools"
 */

class ModelTools {

    private $id, $item, $path, $md5;
    private $res = array();

    //_______
    //SETTERS
    //-------
    public function setId($value){
        $this->id = $value;
    }

    public function setItem($value){
        $this->item = $value;
    }

    public function setPath($value){
        $this->path = $value;
    }

    public function setMd5($value){
        $this->md5 = $value;
    }

    //_______
    //GETTERS
    //-------
    public function getId(){
        return $this->id;
    }

    public function getItem(){
        return $this->item;
    }

    public function getPath(){
        return $this->path;
    }

    public function getMd5(){
        return $this->md5;
    }

    //____________________________________________________________________________SETTERS E GETTERS DELL'ARRAY RES

    public function setRes($id, $item, $path, $md5)
    {
        $this->res[] = array("id" => $id, "item" => $item, "path" => $path, "md5" => $md5);
    }

    public function getRes()
    {
        return $this->res;
    }

    public function getResId()
    {
        foreach ($this->res as $row) {
            return $row[$this->id];
        }
    }

    public function getResItem()
    {
        foreach ($this->res as $row) {
            return $row[$this->item];
        }
    }


    public function getResPath()
    {
        foreach ($this->res as $row) {
            return $row[$this->path];
        }
    }

    public function getResMd5()
    {
        foreach ($this->res as $row) {
            return $row[$this->md5];
        }
    }






    /*//__________________________________________________________________________________________________
    //POICHE' NON ESISTE L'OVERLOADING DEI COSTRUTTORI IN PHP, METTO I PARAMETRI = NULL DI DEFAULT COSI'
    //IN UN UNICO COSTRUTTORE HO LA POSSIBILITA' SIA DI PASSARGLIELI TUTTI SIA DI NON PASSARGLI NESSUNO
    //--------------------------------------------------------------------------------------------------
    public function __construct($id = 0, $item = 0, $path = '0', $md5 = '0')
    {
        $this->id = $id;
        $this->item = $item;
        $this->path = $path;
        $this->md5 = $md5;
    }*/


    /**
     * Esegue una rapida cernita di elementi doppioni aventi md5 uguale.
     * Tiene conto solo degli md5 uguali e non dei path
     * @return array
     */
    public function group_by_md5(){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tools GROUP BY md5");
        $sql->execute();
        $res = array();
        while($row = $sql->fetch()){
            $res[] = array(
                "id" => $row['id'],
                "item" => $row['item'],
                "path" => $row['path'],
                "md5" => $row['md5']);
        }

        return $res;
    }


    /**
     * Seleziona tutte le tuple presenti nella tabella "tools"
     * @return array
     */
    public function SELECT_from_tools(){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM tools");
        $sql->execute();
        $res = array();
        while($row = $sql->fetch()){
            $res[] = array(
                "id" => $row['id'],
                "item" => $row['item'],
                "path" => $row['path'],
                "md5" => $row['md5']);
        }

        return $res;
    }


    /**
     * @TODO: questa funzione come anche le funzioni relative alla cernita delle email sono in fase di sviluppo.
     *   Quindi non la elimino dato che può essere spunto per eventuali modifiche opportune.
     * @return array
     */
    public function SELECT_from_ftktool_mail()
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM ftktool_mail");
        $sql->execute();
        $res = array();
        while ($row = $sql->fetch()){
            $res[] = array(
                "id" => $row['id'],
                "item" => $row['item'],
                "receiver" => $row['receiver'],
                "sender" => $row['sender'],
                "submit" => $row['submit'],
                "delivery" => $row['delivery'],
                "attachment" => $row['attachment'],
                "created" => $row['created'],
                "accessed" => $row['accessed'],
                "modified" => $row['modified'],
                "psize" => $row['psize'],
                "lsize" => $row['lsize'],
                "path" => $row['path'],
                "deleted" => $row['deleted']);
        }
        return $res;
    }


    /**
     * Elimina doppioni con MD5 uguale dando priorità ai files residenti con path più corto
     * @param $res
     */
    public function DELETE_shortpath_duplicates($res)
    {
        foreach ($res as $row)
        {
            // SELEZIONA TUTTI I DOPPIONI (AVENTI MD5 UGUALE) DELLA TUPLA ATTUALE
            $resMd5 = $this->select_md5($row['md5']);

            //ANALIZZO I PATH SOLO SE GLI ELEMENTI CON MD5 UGUALE SONO > DI 1
            if(count($resMd5) > 1)
            {
                //ANALIZZA I PATH DEI DOPPIONI E NE ESEGUE UNA CERNITA A SECONDA DEI CRITERI DI path_analizer_carved()
                $this->path_analizer_carved($resMd5);
            }

            //DOPO UNA PRIMA CERNITA DEI CARVED, SELEZIONA TUTTI I DOPPIONI DELL'ELEMENTO ATTUALE
            $resMd5 = $this->select_md5($row['md5']);
            if(count($resMd5) > 1)
            {
                //ANALIZZA I PATH DEI DOPPIONI RESIDENTI
                $this->shortpath_analizer_resident($resMd5);
            }
        }
    }


    /**
     * La funzione analizza il path degli elementi (files) Carved ed elimina quelli con il path più corto.
     * @param $resMd5: contiene i doppioni dell'elemento corrente     *
     */
    private function path_analizer_carved($resMd5)
    {
        //CARICO IL PRIMO ELEMENTO NELLE VARIABILI. UTILE A COMINCIARE CORRETTAMENTE IL CICLO SUCCESSIVO
        foreach($resMd5 as $row)
        {
            $prev_item = $row['item'];
            $prev_path = $row['path'];
            break;
        }

        /*OGNI TUPLA VIENE CONFRONTATA CON LA TUPLA PRECEDENTE:
            1. SE SONO ENTRAMBI CARVED MANTIENE QUELLO CON PATH PIU LUNGO
            2. SE UNO è CARVED E UNO è RESIDENTE MANTIENE IL RESIDENTE
        */
        foreach ($resMd5 as $row)
        {
            //SE IL PREV E L'ATTUALE SONO ENTRAMBI CARVED
            if((strpos($prev_path, "Carved") == true) && (strpos($row['path'], "Carved") == true))
            {
                //SE LA LUNGHEZZA DEI 2 PATH è UGUALE ALLORA NON ELIMINA NESSUNO
                if((strlen($prev_path)) == strlen($row['path']))
                {
                    continue;
                }

                //SE LA LUNGHEZZA DEL PREV è > ALLORA ELIMINA QUELLO CORRENTE
                if((strlen($prev_path)) > strlen($row['path']))
                {
                    $this->delete_single_item($row['item']);
                }

                //SE LA LUNGHEZZA DEL PREV è < ALLORA ELIMINA QUELLO PRECEDENTE
                if((strlen($prev_path)) < strlen($row['path']))
                {
                    $this->delete_single_item($prev_item);
                }
            }

            //SE IL PRECEDENTE è UN CARVED MENTRE QUELLO CORRENTE NON è UN CARVED ALLORA ELIMINA IL PRECEDENTE.
            if((strpos($prev_path, "Carved") == true) && (strpos($row['path'], "Carved") == false))
            {
                $this->delete_single_item($prev_item);
            }

            //SE IL PRECEDENTE NON è UN CARVED MENTRE QUELLO CORRENTE è UN CARVED ALLORA ELIMINA QUELLO CORRENTE.
            if((strpos($prev_path, 'Carved') == false) && (strpos($row['path'], 'Carved') == true))
            {
                $this->delete_single_item($row['item']);
            }

            //RINNOVA I VALORI DELL'ELEMENTO PRECEDENTE PRIMA DI PASSARE ALLA PROSSIMA RIGA DELL'ARRAY
            $prev_item = $row['item'];
            $prev_path = $row['path'];
        }
    }


    /**
     * La funzione analizza il path degli elementi (files) residenti ed elimina quelli con il path più lungo.
     * @param $resMd5: contiene i doppioni dell'elemento corrente.
     */
    private function shortpath_analizer_resident($resMd5)
    {
        //CARICO IL PRIMO ELEMENTO NELLE VARIABILI. UTILE A COMINCIARE CORRETTAMENTE IL CICLO SUCCESSIVO
        foreach($resMd5 as $row)
        {
            $prev_item = $row['item'];
            $prev_path = $row['path'];
            break;
        }

        /*OGNI TUPLA VIENE CONFRONTATA CON LA TUPLA PRECEDENTE:
            1. SE SONO ENTRAMBI RESIDENTI
                1. SE HANNO PATH UGUALE (CONDIZIONE MOLTO RARA) ALLORA NON SI ELIMINA NESSUNO DEI DUE
                2. SE PREV HA PATH > DI QUELLO CORRENTE ALLORA VIENE MANTENUTO QUELLO CORRENTE
                3. SE PREV HA PATH < DI QUELLO CORRENTE ALLORA VIENE MANTENUTO PREV
        */
        foreach($resMd5 as $row)
        {
            if((strpos($prev_path, 'Carved') == false) && (strpos($row['path'], 'Carved') == false))
            {
                if(strlen($prev_path) == strlen($row['path']))
                {
                continue;
                }
                if(strlen($prev_path) > strlen($row['path']))
                {
                    $this->delete_single_item($prev_item);
                }
                if(strlen($prev_path) < strlen($row['path']))
                {
                    $this->delete_single_item($row['item']);
                }
            }

            //RINNOVA I VALORI DELL'ELEMENTO PRECEDENTE PRIMA DI PASSARE ALLA PROSSIMA RIGA DELL'ARRAY
            $prev_item = $row['item'];
            $prev_path = $row['path'];
        }
    }

    public function DELETE_longpath_duplicates($res)
    {
        foreach ($res as $row)
        {
            // SELEZIONA TUTTI I DOPPIONI (AVENTI MD5 UGUALE) DELLA TUPLA ATTUALE
            $resMd5 = $this->select_md5($row['md5']);

            //ANALIZZO I PATH SOLO SE GLI ELEMENTI CON MD5 UGUALE SONO > DI 1
            if(count($resMd5) > 1)
            {
                //ANALIZZA I PATH DEI DOPPIONI E NE ESEGUE UNA CERNITA A SECONDA DEI CRITERI DI path_analizer_carved()
                $this->path_analizer_carved($resMd5);
            }

            //DOPO UNA PRIMA CERNITA DEI CARVED, SELEZIONA TUTTI I DOPPIONI DELL'ELEMENTO ATTUALE
            $resMd5 = $this->select_md5($row['md5']);
            if(count($resMd5) > 1)
            {
                //ANALIZZA I PATH DEI DOPPIONI RESIDENTI
                $this->longpath_analizer_resident($resMd5);
            }
        }
    }


    private function longpath_analizer_resident($resMd5)
    {
        //CARICO IL PRIMO ELEMENTO NELLE VARIABILI. UTILE A COMINCIARE CORRETTAMENTE IL CICLO SUCCESSIVO
        foreach($resMd5 as $row)
        {
            $prev_item = $row['item'];
            $prev_path = $row['path'];
            break;
        }

        /*OGNI TUPLA VIENE CONFRONTATA CON LA TUPLA PRECEDENTE:
            1. SE SONO ENTRAMBI RESIDENTI
                1. SE HANNO PATH UGUALE (CONDIZIONE MOLTO RARA) ALLORA NON SI ELIMINA NESSUNO DEI DUE
                2. SE PREV HA PATH > DI QUELLO CORRENTE ALLORA VIENE MANTENUTO PREV
                3. SE PREV HA PATH < DI QUELLO CORRENTE ALLORA VIENE MANTENUTO QUELLO CORRENTE
        */
        foreach($resMd5 as $row)
        {
            if((strpos($prev_path, 'Carved') == false) && (strpos($row['path'], 'Carved') == false))
            {
                if(strlen($prev_path) == strlen($row['path']))
                {
                    continue;
                }
                if(strlen($prev_path) > strlen($row['path']))
                {
                    $this->delete_single_item($row['item']);
                }
                if(strlen($prev_path) < strlen($row['path']))
                {
                    $this->delete_single_item($prev_item);
                }
            }

            //RINNOVA I VALORI DELL'ELEMENTO PRECEDENTE PRIMA DI PASSARE ALLA PROSSIMA RIGA DELL'ARRAY
            $prev_item = $row['item'];
            $prev_path = $row['path'];
        }
    }





    /*@TODO rifare la funzione DELETE_longpath_duplicates prendendo esempio da DELETE_shortpath_duplicates*/
    /*public function DELETE_longpath_duplicates($res){

        $prev_item = 0;
        $prev_path = 0;
        $prev_md5 = 0;

        foreach ($res as $row){
            $now_item = $row['item'];
            $now_path = $row['path'];
            $now_md5 = $row['md5'];

            if($now_md5 == $prev_md5){

                if((strpos($now_path, 'Carved') == true) && (strpos($prev_path, 'Carved') == true)){

                    if(strlen($now_path) == strlen($prev_path)){
                        $this->delete_single_item($now_item);
                    }
                    if(strlen($now_path) < strlen($prev_path)){
                        $this->delete_single_item($now_item);
                    }
                    if(strlen($now_path) > strlen($prev_path)){
                        $this->delete_single_item($prev_item);
                        $prev_item = $now_item;
                        $prev_path = $now_path;
                        $prev_md5 = $now_md5;
                    }
                }

                if((strpos($now_path, 'Carved') == true) && (strpos($prev_path, 'Carved') == false)){

                    $this->delete_single_item($now_item);
                }

                if((strpos($now_path, 'Carved') == false) && (strpos($prev_path, 'Carved') == true)){

                    $this->delete_single_item($prev_item);
                    $prev_item = $now_item;
                    $prev_path = $now_path;
                    $prev_md5 = $now_md5;
                }

                if((strpos($now_path, 'Carved') == false) && (strpos($prev_path, 'Carved') == false)){

                    if(strlen($now_path) == strlen($prev_path)){
                        $this->delete_single_item($now_item);
                    }
                    if(strlen($now_path) < strlen($prev_path)){
                        $this->delete_single_item($now_item);
                    }
                    if(strlen($now_path) > strlen($prev_path)){
                        $this->delete_single_item($prev_item);
                        $prev_item = $now_item;
                        $prev_path = $now_path;
                        $prev_md5 = $now_md5;
                    }
                }
            }
            else if ($now_md5 != $prev_md5){
                $prev_item = $now_item;
                $prev_path = $now_path;
                $prev_md5 = $now_md5;
            }
        }
    }*/




/*@TODO: LA FUNZIONE è IN FASE DI SVILUPPO E TESTING.
    l'INTENTO ERA QUELLO DI TROVARE UN CRITERIO DI CERNITA DEI DOPPIONI DELLE EMAIL DATO CHE TRA LE INFO ESPORTABILI CON FTK
    NON VI ERA LA POSSIBILITA' DI ESPORTARE UN VALORE IDENTIFICATIVO DELLA MAIL
    NON LA ELIMINO SICCOME PUò ESSERE DI SPUNTO PER SVILUPPI FUTURI*/
    public function DELETE_email_duplicates($res)
    {
        $prev_item = 0;
        $prev_receiver = 0;
        $prev_sender = 0;
        $prev_submit = 0;
        $prev_delivery = 0;
        $prev_attachment = 0;
        $prev_created = 0;
        $prev_accessed = 0;
        $prev_modified = 0;
        $prev_psize = 0;
        $prev_lsize = 0;
        $prev_path = 0;
        $prev_deleted = 0;

        foreach ($res as $row) {
            $now_item = $row['item'];
            $now_receiver = $row['receiver'];
            $now_sender = $row['sender'];
            $now_submit = $row['submit'];
            $now_delivery = $row['delivery'];
            $now_attachment = $row['attachment'];
            $now_created = $row['created'];
            $now_accessed = $row['accessed'];
            $now_modified = $row['modified'];
            $now_psize = $row['psize'];
            $now_lsize = $row['lsize'];
            $now_path = $row['path'];
            $now_deleted = $row['deleted'];

            if(($now_receiver == $prev_receiver) &&
                ($now_sender == $prev_sender) &&
                ($now_submit == $prev_submit) &&
                ($now_delivery == $prev_delivery) &&
                ($now_attachment == $prev_attachment) &&
                ($now_psize == $prev_psize) &&
                ($now_lsize == $prev_lsize))
            {
                if(($now_deleted == true) && ($prev_deleted == false))
                {
                    $this->delete_single_email($now_item);
                }
                elseif(($now_deleted == false) && ($prev_deleted == true))
                {
                    $this->delete_single_email($prev_item);
                }
                else{
                    $this->delete_single_email($prev_item);
                }
                $prev_item = $now_item;
                $prev_receiver = $now_receiver;
                $prev_sender = $now_sender;
                $prev_submit = $now_submit;
                $prev_delivery = $now_delivery;
                $prev_attachment = $now_attachment;
                $prev_created = $now_created;
                $prev_accessed = $now_accessed;
                $prev_modified = $now_modified;
                $prev_psize = $now_psize;
                $prev_lsize = $now_lsize;
                $prev_path = $now_path;
                $prev_deleted = $now_deleted;


            }
            else{
                $prev_item = $now_item;
                $prev_receiver = $now_receiver;
                $prev_sender = $now_sender;
                $prev_submit = $now_submit;
                $prev_delivery = $now_delivery;
                $prev_attachment = $now_attachment;
                $prev_created = $now_created;
                $prev_accessed = $now_accessed;
                $prev_modified = $now_modified;
                $prev_psize = $now_psize;
                $prev_lsize = $now_lsize;
                $prev_path = $now_path;
                $prev_deleted = $now_deleted;
            }

        }
    }

    /**
     * Elimina una singola tupla dalla tabella "tools"
     * @param $item_number: criterio di eliminazione
     */
    public function delete_single_item($item_number){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("DELETE FROM tools WHERE item=$item_number");
        $sql->execute();
    }


    /**
     * Elimina una singola tupla dalla tabella "ftktool_mail"
     * @param $item_number: criterio di eliminazione
     */
    public function delete_single_email($item_number){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("DELETE FROM ftktool_mail WHERE item=$item_number");
        $sql->execute();
    }


    /**
     * Seleziona tutti gli id e item number dalla tabella "tools"
     * @return array
     */
    public function select_item_numbers(){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT id, item FROM tools");
        $sql->execute();
        $res = array();
        while($row = $sql->fetch()){
            $res[] = array(
                "id" => $row['id'],
                "item" => $row['item']);
        }

        return $res;
    }


    /**
     * Seleziona tutte le tuple aventi MD5 uguale
     * @param $md5
     * @return array $res: verrà dato in pasto alle funzioni per la cernita dei doppioni
     */
    public function select_md5($md5){
        $conn = DbManager::getConnection();
        //$sql = $conn->prepare("SELECT * FROM tools where md5 like '%$md5%'");
        $sql = $conn->prepare("SELECT * FROM tools where md5='$md5'");
        $sql->execute();
        $res = array();
        while($row = $sql->fetch()){
            $res[] = array(
                "id" => $row['id'],
                "item" => $row['item'],
                "path" => $row['path'],
                "md5" => $row['md5']);
        }

        return $res;
    }
}
