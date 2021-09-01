<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Class ControllerEvidence
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative agli evidences
 *
 */

class ControllerEvidence
{
    /**
     * ControllerEvidence constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->Html = new HtmlPainter();
        $this->HtmlHost = new HtmlHost();
        $this->HtmlEvidence = new HtmlEvidence();
        $this->HtmlClone = new HtmlClone();
        $this->ModelProcura = new ModelProcura();
        $this->ModelPm = new ModelPm();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
        $this->ModelHost = new ModelHost();
        $this->ModelGeneric = new ModelGeneric();
        $this->ModelClone = new ModelClone();
        $this->ModelEvidence = new ModelEvidence();

    }

    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando)
        {
            case "view_evidence":
                $this->view_evidence();
                break;

            case "view_evidences_of_host":
                $this->view_evidences_of_host();
                break;

            case "insert_evidence":
                $this->insert_evidence();
                break;

            case "insert_evi_tipo":
                $this->insert_evi_tipo();
                break;

            case "update_evidence_info":
                $this->update_evidence_info();
                break;

            case "update_evidence_foto":
                $this->update_evidence_foto();
                break;

            case "delete_evidence_images":
                $this->delete_evidence_images();
                break;

            case "DELETE_evidence_image":
                $this->DELETE_evidence_image();
                break;

            case "delete_evidence_image1":
                unlink($_POST['evi_pathfoto'].$_POST['evi_image1']);
                $this->ModelEvidence->set_image1_to_null($_POST['evi_id']);
                $this->view_evidence();
                break;

            case "delete_evidence_image2":
                unlink($_POST['evi_pathfoto'].$_POST['evi_image2']);
                $this->ModelEvidence->set_image2_to_null($_POST['evi_id']);
                $this->view_evidence();
                break;

            case "delete_evidence_image3":
                unlink($_POST['evi_pathfoto'].$_POST['evi_image3']);
                $this->ModelEvidence->set_image3_to_null($_POST['evi_id']);
                $this->view_evidence();
                break;

            case "add_evidence":
                $this->add_evidence();
                break;

            case "page_add_tipo_evi":
                $this->page_add_tipo_evi();
                break;

            case "insert_tipo_evi":
                $this->insert_tipo_evi();
                break;

            case "page_del_tipo_evi":
                $this->page_del_tipo_evi();
                break;

            case "del_tipo_evi":
                $this->del_tipo_evi();
                break;

            case "edit_evidence":
                $this->edit_evidence();
                break;

            case "delete_evidence":
                $this->delete_evidence();
                break;

            case "SET_DOCX_evi_image":
                $IdEvi = $_POST['evi_id'];
                $ImgEvi = $_POST['evi_image'];
                $this->ModelEvidence->SET_DOCX_evi_image($IdEvi, $ImgEvi);
                $this->view_evidence();
                break;

            case "UNSET_DOCX_evi_image":
                $IdEvi = $_POST['evi_id'];
                $this->ModelEvidence->UNSET_DOCX_evi_Image($IdEvi);
                $this->view_evidence();
                break;
        }

    }




    /*_________________*/
    /*FUNZIONI PRIVATE*/
    /*---------------*/
    /**
     * set_sessione serve a settare all'interno del file di sessione l'ID dell'evidence selezionato, l'ID del host a cui appartiene, l'ID dell'indagato a cui appartiene l'host,
     * l'ID del procedimento a cui è associato l'indagato, l'ID del PM che ha in carico tale dossier, l'ID del cliente (procura, tribunale o ctp).
     * Questo sia per stampare il "path" in cui ci troviamo sia perché così è possibile gestire la navigazione nel gestionale.
     * Ad esempio se dal menù principale seleziono un caso e poi dalla pagina di visualizzazione del caso clicco il tasto
     * indietro, allora andrà nella pagina di visualizzazione del PM a cui appartiene il caso precedentemente selezionato.
     */
    private function set_sessione()
    {
        if(isset($_POST['evi_id']))
        {
            $_SESSION['post_evi_id'] = $_POST['evi_id'];
            $idEvi = $_POST['evi_id'];
            $this->ModelEvidence->select_single_evidence($idEvi);
            $idHost = $this->ModelEvidence->get_ex_id_host();
            $this->ModelHost->select_host($idHost);
            $ex_id_ind = $this->ModelHost->get_ex_id_indagato();
            $this->ModelIndagato->select_one_indagato($ex_id_ind);
            $ex_id_ca = $this->ModelIndagato->get_ex_id_ca();
            $this->ModelCaso->select_one_caso($ex_id_ca);
            $ex_id_pm = $this->ModelCaso->get_ex_id_pm();
            $this->ModelPm->select_single_pm($ex_id_pm);
            $ex_id_cli = $this->ModelPm->get_ex_id_cli();
            $this->ModelProcura->select_single_procura($ex_id_cli);
            $_SESSION['post_ho_id'] = $idHost;
            $_SESSION['post_ind_id'] = $ex_id_ind;
            $_SESSION['post_ca_id'] = $ex_id_ca;
            $_SESSION['post_pm_id'] = $ex_id_pm;
            $_SESSION['post_cli_id'] = $ex_id_cli;
        }
    }


    /**
     * Inserisce un nuovo evidence nel DB
     */
    public function insert_evidence()
    {
        $Etichetta = $_POST['evi_etichetta'] . " " . $_POST['ho_etichetta'];
        $Tipo = $_POST['evi_tipo'];
        if(empty($_POST['evi_modello'])){$Modello = 'N.D.';} else{$Modello = $_POST['evi_modello'];}
        if(empty($_POST['evi_seriale'])){$Seriale = 'N.D.';} else{$Seriale = $_POST['evi_seriale'];}
        if(empty($_POST['evi_pwd'])){$Pwd = null;} else{$Pwd = $_POST['evi_pwd'];}
        if(isset($_POST['evi_pwd_used'])){$Pwd_used = $_POST['evi_pwd_used'];} else {$Pwd_used = 0;}
        $Dimensione = $_POST['evi_dimensione'];
        $kbmbgbtb = $_POST['evi_kbmbgbtb'];
        $ex_ho_id = $_SESSION['post_ho_id'];

        // CONTA EVENTUALI APICI E VIRGOLETTE NEI CAMPI ETICHETTA, MODELLO, SERIALE, PWD, DIMENSIONE
        $tot = $this->count_apici_virgolette($Etichetta, $Modello, $Seriale, $Pwd, $Dimensione);
        if($tot == 0) {
            // Controlla se vi sono già evidence con la stessa etichetta che vogliamo inserire
            $count = $this->ModelEvidence->count_evidence_duplicates_of_indagato($_SESSION['post_ind_id'], $Etichetta);
            if ($count == 0) {
                $this->ModelEvidence->insert_evidence($Etichetta, $Tipo, $Modello, $Seriale, $Pwd, $Pwd_used, $Dimensione, $kbmbgbtb, $ex_ho_id);
                $this->ModelEvidence->select_last_evidence();
                $_SESSION['post_evi_id'] = $this->ModelEvidence->get_evi_id();
                $this->view_evidences_of_host();
            } else {
                $IdHost = $_SESSION['post_ho_id'];
                $this->ModelHost->select_host($IdHost);
                $NomeHost = $this->ModelHost->get_ho_etichetta();
                $TipiEvi = $this->ModelEvidence->select_tipi_evidence();
                $this->Html->HTML_header();
                $this->HtmlEvidence->HTML_add_evidence_deny_duplicate($NomeHost, $TipiEvi, $Etichetta, $Tipo, $Modello, $Seriale, $Pwd, $Pwd_used, $Dimensione, $kbmbgbtb);
                $this->Html->HTML_footer();
            }
        }
        else
        {

            $IdHost = $_SESSION['post_ho_id'];
            $this->ModelHost->select_host($IdHost);
            $NomeHost = $this->ModelHost->get_ho_etichetta();
            $TipiEvi = $this->ModelEvidence->select_tipi_evidence();
            $this->Html->HTML_header();
            $this->HtmlEvidence->HTML_add_evidence_deny_quote($NomeHost, $TipiEvi, $Etichetta, $Tipo, $Modello, $Seriale, $Pwd, $Pwd_used, $Dimensione, $kbmbgbtb);

            $this->Html->HTML_footer();
        }
    }

    private function count_apici_virgolette($Etichetta, $Modello, $Seriale, $Pwd, $Dimensione)
    {
        $tot = 0;
        $result = $this->ModelGeneric->check_if_apice_virgolette($Etichetta);
        $tot = $this->ModelGeneric->sum($tot, $result);
        $result = $this->ModelGeneric->check_if_apice_virgolette($Modello);
        $tot = $this->ModelGeneric->sum($tot, $result);
        $result = $this->ModelGeneric->check_if_apice_virgolette($Seriale);
        $tot = $this->ModelGeneric->sum($tot, $result);
        $result = $this->ModelGeneric->check_if_apice_virgolette($Pwd);
        $tot = $this->ModelGeneric->sum($tot, $result);
        $result = $this->ModelGeneric->check_if_apice_virgolette($Dimensione);
        $tot = $this->ModelGeneric->sum($tot, $result);
        return $tot;
    }


    /**
     * Inserisce nel DB una nuova tipologia di evidence.
     */
    private function insert_evi_tipo()
    {
        $EviTipo = $_POST['evi_tipo'];
        // Esegue upload dell'icona scelta
        $NomeIcona = $this->upload_icona();
        // Elimina gli spazi nel nome del tipo per poter rinominare l'icona senza utilizzare spazi
        $PathIcona = "font/icon/".$EviTipo.".png";
        $PathIcona = str_replace(" ", "", $PathIcona);
        rename("font/icon/".$NomeIcona, $PathIcona);
        // Inserisce il nuovo tipo di evidence
        $this->ModelEvidence->insert_tipo_evi($EviTipo, $PathIcona);
        // Seleziona tutti i tipi degli evidences
        $this->PRINT_add_evidence_page();
    }

    /**
     * @return |null
     * Effettua l'upload dell'icona della tipologia di evidence che si sta aggiungendo.
     */
    private function upload_icona()
    {
        $uploaddir = "font/icon/";
        $uploadfile = $uploaddir . basename($_FILES['icona']['name']);
        if (move_uploaded_file($_FILES['icona']['tmp_name'], $uploadfile)) {
            return $_FILES['icona']['name'];
        }
        else{
            return null;
        }
    }

    /**
     * Stampa la pagina che permette di aggiungere un nuovo evidence
     */
    private function PRINT_add_evidence_page()
    {
        // Valorizzo sessione con ID host corrente
        $IdHost = $_SESSION['post_ho_id'];
        // Riempio classe host corrente selezionandolo dal DB
        $this->ModelHost->select_host($IdHost);
        $NomeHost = $this->ModelHost->get_ho_etichetta();
        // Seleziona tutti le tipologie di evidences
        $TipiEvidence = $this->ModelEvidence->select_tipi_evidence();
        // Stampa pagina di aggiunta di un nuovo host.
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_add_evidence($NomeHost, null, $TipiEvidence);
        $this->Html->HTML_footer();


    }


    /**
     * Esegue l'update sul DB delle informazioni dell'evidence selezionato
     */
    private function update_evidence_info()
    {
        $id = $_POST['evi_id'];
        $etichetta = $_POST['evi_etichetta'];
        $tipo = $_POST['evi_tipo'];
        $modello = $_POST['evi_modello'];
        $seriale = $_POST['evi_seriale'];
        // Se il campo password non è stato riempito mette N.D. in $pwd altrimenti prende il valore della post['ho_pwd]
        if(empty($_POST['evi_pwd'])){$pwd = null;} else{$pwd = $_POST['evi_pwd'];}
        // Controllo del check-box pwd_used
        if(isset($_POST['evi_pwd_used'])){$pwd_used = $_POST['evi_pwd_used'];} else{$pwd_used = 0;}
        $dimensione = $_POST['evi_dimensione'];
        $kbmbgbtb = $_POST['evi_kbmbgbtb'];
        // Controlla se vi sono apici o virgolette nei valori che vogliamo inserire

        $result = $this->ModelGeneric->check_if_apice_virgolette($etichetta, $modello, $seriale);
        if($result == 0){
            $this->ModelEvidence->update_evidence_info($id, $etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $dimensione, $kbmbgbtb);
            $this->view_evidences_of_host();
        }
        else{
            echo"<center><div style='color: red'><b>ATTENZIONE: Apici e Virgolette sono vietati!</b></div></center>";
            $this->view_evidences_of_host();
        }
    }


    /**
     * La funzione viene attivata dal tasto di caricamento foto degli evidence.
     * Esegue l'upload dei files jpg e l'update nel db delle informazioni relative alle foto degli evidence
     */
    private function update_evidence_foto()
    {
        // preleva ID evidence corrente
        $_SESSION['post_evi_id'] = $_POST['evi_id'];
        // preleva le informazioni relative all'evidence e all'host, indagato, caso, pm e cliente correlati ad esso.
        $this->ModelEvidence->select_single_evidence($_SESSION['post_evi_id']);
        $this->ModelHost->select_host($this->ModelEvidence->get_ex_id_host());
        $this->ModelIndagato->select_one_indagato($this->ModelHost->get_ex_id_indagato());
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        // valorizza le variabili contenenti gli ID delle informazioni prelevate siccome serviranno a creare il path in cui saranno presenti le foto.
        $IdEvidence = $this->ModelEvidence->get_evi_id();
        $IdHost = $this->ModelHost->get_ho_id();
        $IdIndagato = $this->ModelIndagato->get_ind_id();
        $IdCaso = $this->ModelCaso->get_ca_id();
        $IdPm = $this->ModelPm->get_pm_id();
        $IdProcura = $this->ModelProcura->get_cli_id();
        $this->ModelEvidence->upload_evidence_images($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost, $IdEvidence);
        // Fa il resize delle immagini appena caricate
        $this->ModelEvidence->select_single_evidence($IdEvidence);
        $path = $this->ModelEvidence->get_evi_pathfoto();
        $img1 = $this->ModelEvidence->get_image1();
        $img2 = $this->ModelEvidence->get_image2();
        $img3 = $this->ModelEvidence->get_image3();
        if($img1!=null) {
            $path1 = $path.$img1;
            $img1 = $this->resize_imagejpg($path.$img1, 335, 252);
            imagejpeg($img1, $path1);
        }
        if($img2!=null) {
            $path2 = $path.$img2;
            $img2 = $this->resize_imagejpg($path.$img2, 335, 252);
            imagejpeg($img2, $path2);
        }
        if($img3!=null) {
            $path3 = $path.$img3;
            $img3 = $this->resize_imagejpg($path.$img3, 335, 252);
            imagejpeg($img3, $path3);
        }
        /*$evi_pathfoto =  'archivioimg/'. 'cli_' . $IdProcura . '/' . 'pm_' . $IdPm . '/' . 'ca_' . $IdCaso . '/' . 'ind_' . $IdIndagato . '/' . 'ho_' . $IdHost . '/' . 'evi_' . $IdEvidence . '/';
        // Utilizzo scandir per ottenere un array contenente il nome dei files appena caricati nel path delle foto
        $NomiFiles = array_diff(scandir($evi_pathfoto, 1), array('..', '.'));
        // Imposto a null le variabili che conterranno i nomi delle immagini
        $image1 = null;
        $image2 = null;
        $image3 = null;
        //Siccome scandir restituisce . e .. dove non ci sono immagini eseguo dei controlli per evitare di sporcare il report
        if(array_key_exists(0, $NomiFiles))
        {
            $image1 = $NomiFiles[0];
        }
        if(array_key_exists(1, $NomiFiles))
        {
            $image2 = $NomiFiles[1];
        }
        if(array_key_exists(2, $NomiFiles))
        {
            $image3 = $NomiFiles[2];
        }
        $this->ModelEvidence->update_pathfoto_and_image($this->ModelEvidence->get_evi_id(), $evi_pathfoto, $image1, $image2, $image3);
        // Rimpicciolisco le immagini appena caricate
        if($image1 != null){
            $file1 = $evi_pathfoto.$image1;
            $toResize1 = $evi_pathfoto.$image1;
            $this->SmartResize->smart_resize_image($file1 , null, 640 , 480 , false , $toResize1 , false , false ,100);
        }
        if($image2 != null){
            $file2 = $evi_pathfoto.$image2;
            $toResize2 = $evi_pathfoto.$image2;
            $this->SmartResize->smart_resize_image($file2 , null, 640 , 480 , false , $toResize2 , false , false ,100);
        }
        if($image3 != null){
            $file3 = $evi_pathfoto.$image3;
            $toResize3 = $evi_pathfoto.$image3;
            $this->SmartResize->smart_resize_image($file3 , null, 640 , 480 , false , $toResize3 , false , false ,100);
        }*/
        $this->view_evidence();
    }


    /**
     * @param $file : l'immagine
     * @param $w : lunghezza
     * @param $h : altezza
     * @return false|resource
     * La funzione effettua il resize delle immagini
     */
    private function resize_imagejpg($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
        // Restituisce dst che è un oggetto di tipo imagejpeg
        return $dst;
    }

    /**
     * Elimina tutte le foto di un evidence
     */
    private function delete_evidence_images()
    {
        //elimina tutte le immagini di un host
        $IdEvi = $_POST['evi_id'];
        $this->ModelEvidence->select_single_evidence($IdEvi);
        $path = $this->ModelEvidence->get_evi_pathfoto();
        $img1 = $this->ModelEvidence->get_image1();
        $img2 = $this->ModelEvidence->get_image2();
        $img3 = $this->ModelEvidence->get_image3();
        if($img1!=null){unlink($path.$img1);}
        if($img2!=null){unlink($path.$img2);}
        if($img3!=null){unlink($path.$img3);}
        $this->ModelEvidence->set_all_evi_images_to_null($IdEvi);
        $this->view_evidence();
    }


    /**
     * Elimina una singola immagine di un evidence
     */
    private function DELETE_evidence_image()
    {
        $IdEvi = $_POST['evi_id'];
        $EviImg = $_POST['evi_image'];
        $EviPath = $_POST['evi_pathfoto'];
        unlink($EviPath.$EviImg);
        $this->ModelEvidence->set_evi_image_to_null($IdEvi, $EviImg);
        $this->view_evidence();
    }


    /**
     * La funzione stampa a video la pagina di aggiunta di un nuovo evidence
     */
    private function add_evidence()
    {
        $IdHost = $_SESSION['post_ho_id'];
        $this->ModelHost->select_host($IdHost);
        $NomeHost = $this->ModelHost->get_ho_etichetta();
        $TipiEvi = $this->ModelEvidence->select_tipi_evidence();
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_add_evidence($NomeHost, null, $TipiEvi);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa a video la pagina di aggiunta nuova tipologia di evidence
     */
    private function page_add_tipo_evi()
    {
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_page_add_tipo_evi();
        $this->Html->HTML_footer();
    }


    /**
     * La funzione inserisce nel DB una nuova tipologia di evidence e ristampa la pagina di aggiunta di un nuovo evidence.
     */
    private function insert_tipo_evi()
    {
        $EviTipo = $_POST['evi_tipo'];
        $this->ModelEvidence->insert_tipo_evi($EviTipo);
        $TipiEvi = $this->ModelEvidence->select_tipi_evidence();
        $IdHost = $_SESSION['post_ho_id'];
        $this->ModelHost->select_host($IdHost);
        $NomeHost = $this->ModelHost->get_ho_etichetta();
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_add_evidence($NomeHost, null, $TipiEvi);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa a video la pagina che permette di eliminare una tipologia di evidence
     */
    private function page_del_tipo_evi()
    {
        $TipiEvi = $this->ModelEvidence->select_tipi_evidence_for_delete();
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_page_del_tipo_evi($TipiEvi);
        $this->Html->HTML_footer();
    }


    /**
     * Elimina una tipologia di evidence
     */
    private function del_tipo_evi()
    {
        $IdTipoEvi = $_POST['evi_id_tipo'];
        $PathIcona = $_POST['evi_icon'];
        unlink($PathIcona);
        //Eliminazione riga dal DB
        $this->ModelEvidence->del_tipo_evi($IdTipoEvi);
        // Selezioni tipi per la pagina di eliminazione
        $TipiEvi = $this->ModelEvidence->select_tipi_evidence_for_delete();
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_page_del_tipo_evi($TipiEvi);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa a video la pagina che permette di modificare le info di un evidence
     */
    private function edit_evidence()
    {
        $this->ModelEvidence->select_single_evidence($_POST['evi_id']);
        $id=$this->ModelEvidence->get_evi_id();
        $etichetta = $this->ModelEvidence->get_evi_etichetta();
        $tipo = $this->ModelEvidence->get_evi_tipo();
        $modello = $this->ModelEvidence->get_evi_modello();
        $seriale = $this->ModelEvidence->get_evi_seriale();
        $pwd = $this->ModelEvidence->get_evi_pwd();
        $pwd_used = $this->ModelEvidence->get_evi_pwd_used();
        $dimensione = $this->ModelEvidence->get_evi_dimensione();
        $kbmbgbtb = $this->ModelEvidence->get_evi_kbmbgbtb();
        $TipiEvi = $this->ModelEvidence->select_tipi_evidence();
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_edit_evidence($id, $etichetta, $tipo, $TipiEvi, $modello, $seriale, $pwd, $pwd_used, $dimensione, $kbmbgbtb);
        $this->Html->HTML_footer();
    }


    /**
     * Elimina un evidence, le sue immagini e i suoi log (sia i files nei rispettivi archivi sia nel db)
     */
    private function delete_evidence()
    {
        $IdEvi = $_POST['evi_id'];
        // Seleziono Cloni dell'evidence per eliminarli
        $this->ModelClone->select_cloni_of_evidence($IdEvi);
        $Cloni = $this->ModelClone->get_res();
        // Avvio un ciclo per l'eliminazione dei log (sia i file .txt sia dal DB)
        foreach($Cloni as $row)
        {
            $log = $row['clo_log'];
            unlink($log);
            $idLog = $row['clo_id'];
            $this->ModelClone->delete_clone($idLog);
        }
        // Elimino le foto dell'evidence
        $this->ModelEvidence->select_single_evidence($IdEvi);
        $pathfoto = $this->ModelEvidence->get_pathfoto();
        $image1 = $this->ModelEvidence->get_image1();
        $image2 = $this->ModelEvidence->get_image2();
        $image3 = $this->ModelEvidence->get_image3();
        if($pathfoto != null)
        {
            if($image1 != null){unlink($pathfoto . $image1);}
            if($image2 != null){unlink($pathfoto . $image2);}
            if($image3 != null){unlink($pathfoto . $image3);}
            rmdir($pathfoto);
        }

        // Infine elimino l'evidence dal DB
        $this->ModelEvidence->delete_evidence($_POST['evi_id']);
        $this->view_evidences_of_host();
    }


    /**
     * La funzione visualizza la pagina contenente i dettagli di un evidence.
     */
    public function view_evidence()
    {
        $this->set_sessione();
        $this->ModelEvidence->select_single_evidence($_SESSION['post_evi_id']);
        $NomeEvidence = $this->ModelEvidence->get_evi_etichetta();
        $this->ModelClone->select_cloni_of_evidence($this->ModelEvidence->get_evi_id());
        $resCloni = $this->ModelClone->get_res();
        $this->ModelHost->select_host($this->ModelEvidence->get_ex_id_host());
        $this->ModelIndagato->select_one_indagato($this->ModelHost->get_ex_id_indagato());
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());

        $NomeProcura = $this->ModelProcura->get_cli_nome();
        $NomeProcura = str_replace('Procura della Repubblica','',$NomeProcura);
        $NomePm = $this->ModelPm->get_pm_cognome(). " " . $this->ModelPm->get_pm_nome();
        $NumCaso = $this->ModelCaso->get_ca_num();
        $NomeIndagato = $this->ModelIndagato->get_ind_cognome(). " " . $this->ModelIndagato->get_ind_nome();
        $IdEvidence = $this->ModelEvidence->get_evi_id();
        $NomeHost = $this->ModelHost->get_ho_etichetta();
        $pathfoto = $this->ModelEvidence->get_pathfoto();
        $image1 = $this->ModelEvidence->get_image1();
        $image2 = $this->ModelEvidence->get_image2();
        $image3 = $this->ModelEvidence->get_image3();
        $image_docx = $this->ModelEvidence->get_image_docx();
        $this->Html->HTML_header();
        $this->HtmlEvidence->HTML_evidence($NomeProcura, $NomePm, $NumCaso, $NomeIndagato, $NomeHost, $IdEvidence, $NomeEvidence, $pathfoto, $image1, $image2, $image3, $image_docx);
        $this->HtmlClone->HTML_clone_of_evidence($resCloni);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione visualizza la pagina contenente tutti gli evidence di un host
     */
    public function view_evidences_of_host()
    {
        $idHost = $_SESSION['post_ho_id'];
        $this->ModelHost->select_host($idHost);
        $this->ModelEvidence->select_evidence_of_host($this->ModelHost->get_ho_id());
        $resEvid = $this->ModelEvidence->getRes();
        $this->ModelIndagato->select_one_indagato($this->ModelHost->get_ex_id_indagato());
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        $NomeProcura = str_replace('Procura della Repubblica','',$NomeProcura);
        $NomePm = $this->ModelPm->get_pm_cognome(). " " . $this->ModelPm->get_pm_nome();
        $NumCaso = $this->ModelCaso->get_ca_num();
        $NomeIndagato = $this->ModelIndagato->get_ind_cognome(). " " . $this->ModelIndagato->get_ind_nome();
        $IdHost = $this->ModelHost->get_ho_id();
        $NomeHost = $this->ModelHost->get_ho_etichetta();
        $ho_pathfoto = $this->ModelHost->get_ho_pathfoto();
        $ho_image1 = $this->ModelHost->get_ho_image1();
        $ho_image2 = $this->ModelHost->get_ho_image2();
        $ho_image3 = $this->ModelHost->get_ho_image3();
        $ho_image4 = $this->ModelHost->get_ho_image4();
        $ho_imgdocx1 = $this->ModelHost->get_ho_image_docx();
        $ho_imgdocx2 = $this->ModelHost->get_ho_image_docx2();
        // Seleziona tipologie di evidence
        $TipiEvidence = $this->ModelEvidence->select_tipi_evidence();
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_host($NomeProcura, $NomePm, $NumCaso, $NomeIndagato, $IdHost, $NomeHost, $ho_pathfoto, $ho_image1, $ho_image2, $ho_image3, $ho_image4, $ho_imgdocx1, $ho_imgdocx2);

            $this->HtmlEvidence->HTML_evidence_of_host($resEvid, $TipiEvidence);

        $this->Html->HTML_footer();
    }

}
