<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Class ControllerHost
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative agli host
 */
class ControllerHost
{
    /**
     * ControllerHost constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->ControllerIndagato = new ControllerIndagato();
        $this->Html = new HtmlPainter();
        $this->HtmlHost = new HtmlHost();
        $this->HtmlHostSpecial = new HtmlHostSpecial();
        $this->HtmlEvidence = new HtmlEvidence();
        $this->HtmlClone = new HtmlClone();
        $this->ModelProcura = new ModelProcura();
        $this->ModelPm = new ModelPm();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
        $this->ModelHost = new ModelHost();
        $this->ModelHostSpecial = new ModelHostSpecial();
        $this->ModelEvidence = new ModelEvidence();
        $this->ModelClone = new ModelClone();
        $this->ModelGeneric = new ModelGeneric();

    }

    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando)
        {
            case "page_return_to_indagato":
                $_SESSION['post_ind_id'] = $_POST['ind_id'];
                $this->return_to_indagato(null);
                break;

            case "view_host":
                $this->view_host();
                break;

            case "ricerca_host":
                $this->ricerca_host();
                break;

            case "return_to_indagato":
                $this->return_to_indagato(null);
                break;

            case "page_view_host":
                $this->view_host();
                break;

            case "page_view_special_host":
                $this->view_host();
                    break;

            case "insert_host":
                $this->insert_host();
                break;

            case "insert_ho_tipo":
                $this->insert_ho_tipo();
                break;

            case "update_host_info":
                $this->update_host_info();
                break;

            case "update_host_foto":
                $this->update_host_foto();
                break;

            case "delete_host_images":
                $this->delete_host_images();
                break;

            /*case "delete_host_image1":
                unlink($_POST['ho_pathfoto'].$_POST['ho_image1']);
                $this->ModelHost->set_ho_image1_to_null($_POST['ho_id']);
                $this->view_host();
                break;

            case "delete_host_image2":
                unlink($_POST['ho_pathfoto'].$_POST['ho_image2']);
                $this->ModelHost->set_ho_image2_to_null($_POST['ho_id']);
                $this->view_host();
                break;

            case "delete_host_image3":
                unlink($_POST['ho_pathfoto'].$_POST['ho_image3']);
                $this->ModelHost->set_ho_image3_to_null($_POST['ho_id']);
                $this->view_host();
                break;

            case "delete_host_image4":
                unlink($_POST['ho_pathfoto'].$_POST['ho_image4']);
                $this->ModelHost->set_ho_image4_to_null($_POST['ho_id']);
                $this->view_host();
                break;*/

            case "SET_DOCX_host_image":
                $IdHost = $_POST['ho_id'];
                $ImgName = $_POST['ho_image'];
                $this->ModelHost->select_host($IdHost);
                $ImgDocx1 = $this->ModelHost->get_ho_image_docx();
                $ImgDocx2 = $this->ModelHost->get_ho_image_docx2();
                if(($ImgDocx1 == null) AND ($ImgDocx2 == null))
                {
                    $this->ModelHost->SET_DOCX_image1($IdHost, $ImgName);
                }
                else if(($ImgDocx1 == null) AND ($ImgDocx2 != null))
                {
                    $this->ModelHost->SET_DOCX_image1($IdHost, $ImgName);
                }
                else if(($ImgDocx1 != null) AND ($ImgDocx2 == null))
                {
                    $this->ModelHost->SET_DOCX_image2($IdHost, $ImgName);
                }

                $this->view_host();
                break;

            case "UNSET_DOCX_host_image1":
                $IdHost = $_POST['ho_id'];
                $this->ModelHost->UNSET_DOCX_host_Image1($IdHost);
                $this->view_host();
                break;

            case "UNSET_DOCX_host_image2":
                $IdHost = $_POST['ho_id'];
                $this->ModelHost->UNSET_DOCX_host_Image2($IdHost);
                $this->view_host();
                break;

            case "DELETE_host_image":
            unlink($_POST['ho_pathfoto'].$_POST['ho_image']);
            $this->ModelHost->set_ho_image_to_null($_POST['ho_id'], $_POST['ho_image']);
            $this->view_host();
            break;

            case "page_add_host":
                $this->page_add_host();
                break;

            case "page_add_ho_tipo":
                $this->page_add_ho_tipo();
                break;

            case "edit_host":
                $this->edit_host();
                break;

            case "delete_host":
                $this->delete_host();
                break;

            case "page_del_ho_tipo":
                $this->page_del_ho_tipo();
                break;

            case "del_ho_tipo":
                $this->del_ho_tipo();
                break;

            case "add_ho_tipo":
                $this->add_ho_tipo();
                break;
        }

    }


    /*__________________*/
    /* FUNZIONI PRIVATE*/
    /*----------------*/
    /**
     * set_sessione serve a settare all'interno del file di sessione l'ID dell'host selezionato, l'ID dell'indagato a cui appartiene, l'ID del caso a cui appartiene l'host
     * Questo sia per stampare il "path" in cui ci troviamo sia perché così è possibile gestire la navigazione nel gestionale.
     *
     */
    private function set_sessione(){
        if(isset($_POST['ho_id']))
        {
            //$ModelGeneric->set_sessione("host", $_POST['ho_id']);
            $id = $_POST['ho_id'];
            $this->ModelHost->select_host($id);
            $ex_id_ind = $this->ModelHost->get_ex_id_indagato();
            $this->ModelIndagato->select_one_indagato($ex_id_ind);
            $ex_id_ca = $this->ModelIndagato->get_ex_id_ca();
            $this->ModelCaso->select_one_caso($ex_id_ca);
            $ex_id_pm = $this->ModelCaso->get_ex_id_pm();
            $this->ModelPm->select_single_pm($ex_id_pm);
            $ex_id_cli = $this->ModelPm->get_ex_id_cli();
            $this->ModelProcura->select_single_procura($ex_id_cli);
            $_SESSION['post_ho_id'] = $id;
            $_SESSION['post_ind_id'] = $ex_id_ind;
            $_SESSION['post_ca_id'] = $ex_id_ca;
            $_SESSION['post_pm_id'] = $ex_id_pm;
            $_SESSION['post_cli_id'] = $ex_id_cli;

        }
    }

    /**
     * La funzione visualizza la pagina contenente gli evidence di un host
     */
    private function view_host()
    {
        // setta la sessione con l'ID dell'host e gli ID di cliente, pm, caso, indagato ad esso correlati
        $this->set_sessione();
        $this->ModelHost->select_host($_SESSION['post_ho_id']);
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
        $ImageDocx1 = $this->ModelHost->get_ho_image_docx();
        $ImageDocx2 = $this->ModelHost->get_ho_image_docx2();
        // Seleziono le tipologie degli Evidence
        $TipiEvidence = $this->ModelEvidence->select_tipi_evidence();
        // Stampa pagina degli evidence dell'Host.
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_host($NomeProcura, $NomePm, $NumCaso, $NomeIndagato, $IdHost, $NomeHost, $ho_pathfoto, $ho_image1, $ho_image2, $ho_image3, $ho_image4, $ImageDocx1, $ImageDocx2);
        $this->HtmlEvidence->HTML_evidence_of_host($resEvid);
        $this->Html->HTML_footer();
    }


    /**
     * Ricerca un host a seconda del criterio di ricerca (modello dell'host).
     * Il modello può anche essere inserito in parte e non per intero.
     */
    private function ricerca_host()
    {
        $ModHost = $_POST['ric'];
        $res = $this->ModelHost->select_host_by_model($ModHost);
        if(empty($res)){
            $this->Html->HTML_header();
            $this->HtmlHost->HTML_ricerca_host_not_found();
        }
        else{
            $this->Html->HTML_header();
            $this->HtmlHost->HTML_host_by_ricerca($res);
        }

        $this->Html->HTML_footer();
    }


    /**
     * Inserisce un nuovo host nel DB
     */
    private function insert_host()
    {
        $etichetta = $_POST['ho_etichetta'];
        $seriale = $_POST['ho_seriale'];
        // Se il campo password non è stato riempito mette N.D. in $pwd altrimenti prende il valore della post['ho_pwd]
        if(empty($_POST['ho_pwd'])){$pwd = 'N.D.';} else{$pwd = $_POST['ho_pwd'];}
        // Controllo del check-box pwd_used
        if(isset($_POST['ho_pwd_used'])){$pwd_used = $_POST['ho_pwd_used'];} else{$pwd_used = 0;}
        $tipo = $_POST['ho_tipo'];
        $modello = $_POST['ho_modello'];
        $caId = $_SESSION['post_ca_id'];
        $indId = $_SESSION['post_ind_id'];

        // CONTA EVENTUALI APICI E VIRGOLETTE NEI CAMPI ETICHETTA, MODELLO, SERIALE, PWD, DIMENSIONE
        $tot = $this->count_apici_virgolette($etichetta, $modello, $seriale);

        if($tot >= 1) {
            $HoTipi = $this->ModelHost->select_ho_tipo();
            $this->Html->HTML_header();
            //echo"<center><div style='color: red'><b>ATTENZIONE: Apici e Virgolette sono vietati!</b></div></center>";
            $this->HtmlHost->HTML_add_host_deny_quote($etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $HoTipi);
            $this->Html->HTML_footer();
        }
        else{
            $count = $this->ModelHost->count_host_duplicates_of_indagato($_SESSION['post_ind_id'], $_POST['ho_etichetta']);
            if ($count == 0) {
                $this->ModelHost->insert_host($etichetta, $seriale, $pwd, $pwd_used, $tipo, $modello, $caId, $indId);
                $this->ControllerIndagato->return_to_indagato();

            } else {
                // IN QUESTO CASO RISTAMPA LA PAGINA DI AGGIUNTA NUOVO HOST CON IN PIù IL MESSAGGIO CHE L'ETICHETTA SCELTA è GIà PRESENTE
                $HoTipi = $this->ModelHost->select_ho_tipo();
                $this->Html->HTML_header();
                $this->HtmlHost->HTML_add_host_deny_duplicates($etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $HoTipi);
                $this->Html->HTML_footer();
            }
        }
    }

    private function count_apici_virgolette($Etichetta, $Modello, $Seriale)
    {
        $tot = 0;
        $result = $this->ModelGeneric->check_if_apice_virgolette($Etichetta);
        $tot = $this->ModelGeneric->sum($tot, $result);
        $result = $this->ModelGeneric->check_if_apice_virgolette($Modello);
        $tot = $this->ModelGeneric->sum($tot, $result);
        $result = $this->ModelGeneric->check_if_apice_virgolette($Seriale);
        $tot = $this->ModelGeneric->sum($tot, $result);
        return $tot;
    }


    /**
     * Inserisce nel DB una nuova tipologia di host.
     */
    private function insert_ho_tipo()
    {
        $HoTipo = $_POST['ho_tipo'];

        // Esegue upload dell'icona scelta
        $NomeIcona = $this->upload_icona();
        // Elimina gli spazi nel nome del tipo per poter rinominare l'icona senza utilizzare spazi
        $PathIcona = "font/icon/".$HoTipo.".png";
        $PathIcona = str_replace(" ", "", $PathIcona);
        rename("font/icon/".$NomeIcona, $PathIcona);
        // Inserisce il nuovo tipo di host
        $this->ModelHost->insert_ho_tipo($HoTipo, $PathIcona);
        // Seleziona tutti i tipi degli host
        $TipiHost = $this->ModelHost->select_ho_tipo();
        // Stampa pagina di aggiunta di un nuovo host.
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_add_host(0, $TipiHost);
        $this->Html->HTML_footer();
    }


    /**
     * @return |null
     * Effettua l'upload dell'icona del nuovo tipo di host che si sta inserendo
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
     * La funzione aggiorna le info nel DB riguardanti un host (pagina di modifica host)
     */
    private function update_host_info()
    {
        $id = $_POST['ho_id'];
        $etichetta = $_POST['ho_etichetta'];
        $tipo = $_POST['ho_tipo'];
        $modello = $_POST['ho_modello'];
        $seriale = $_POST['ho_seriale'];
        // Se il campo password non è stato riempito mette N.D. in $pwd altrimenti prende il valore della post['ho_pwd]
        if(empty($_POST['ho_pwd'])){$pwd = 'N.D.';} else{$pwd = $_POST['ho_pwd'];}
        // Controllo del check-box pwd_used
        if(isset($_POST['ho_pwd_used'])){$pwd_used = $_POST['ho_pwd_used'];} else{$pwd_used = 0;}
        $result = $this->ModelGeneric->check_if_apice_virgolette($etichetta, $modello, $seriale);
        if($result == 1)
        {
            echo"<center><div style='color: red'><b>ATTENZIONE: Apici e Virgolette sono vietati!</b></div></center>";
            $this->return_to_indagato(null);

        }
        else
        {
            $this->ModelHost->update_host_info($id, $etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used);
            $this->return_to_indagato(null);
        }
    }


    /**
     * Aggiorna sia i files negli archivi sia le info nel DB relative alle immagini di un host
     */
    private function update_host_foto()
    {
        $this->ModelHost->select_host($_SESSION['post_ho_id']);
        $this->ModelIndagato->select_one_indagato($this->ModelHost->get_ex_id_indagato());
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        $IdHost = $this->ModelHost->get_ho_id();
        $IdIndagato = $this->ModelIndagato->get_ind_id();
        $IdCaso = $this->ModelCaso->get_ca_id();
        $IdPm = $this->ModelPm->get_pm_id();
        $IdProcura = $this->ModelProcura->get_cli_id();
        $this->ModelHost->upload_images($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost);
        // Fa il resize delle immagini appena caricate
        $this->ModelHost->select_host($IdHost);
        $path = $this->ModelHost->get_ho_pathfoto();
        $img1 = $this->ModelHost->get_ho_image1();
        $img2 = $this->ModelHost->get_ho_image2();
        $img3 = $this->ModelHost->get_ho_image3();
        $img4 = $this->ModelHost->get_ho_image4();
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
        if($img4!=null) {
            $path4 = $path.$img4;
            $img4 = $this->resize_imagejpg($path.$img4, 335, 252);
            imagejpeg($img4, $path4);
        }

        $this->view_host();
    }


    /**
     * @param $file : immagine jpg
     * @param $w : lunghezza
     * @param $h : altezza
     * @return false|resource : oggetto ridimensionato
     * La funzione fà il resize delle immagini passategli come parametri.
     */
    private function resize_imagejpg($file, $w, $h) {
        try {
            list($width, $height) = getimagesize($file);
            $src = imagecreatefromjpeg($file);
            $dst = imagecreatetruecolor($w, $h);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
            // Restituisce dst che è un oggetto di tipo imagejpeg
            return $dst;
        }
        catch (Exception $e) {
            print_r($e);
            exit(1);
        }


    }


    /**
     * Visualizza la pagina che permette di aggiungere un nuovo host.
     */
    private function page_add_host()
    {
        $HoTipi = $this->ModelHost->select_ho_tipo();
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_add_host(null, $HoTipi);
        $this->Html->HTML_footer();
    }


    /**
     * Visualizza la pagina che permette di aggiungere una nuova tipologia di host.
     */
    private function page_add_ho_tipo()
    {
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_add_ho_tipo();
        $this->Html->HTML_footer();
    }


    /**
     * Visualizza la pagina che permette di modificare le informazioni di un host
     */
    private function edit_host()
    {
        $this->ModelHost->select_host($_POST['ho_id']);
        $id=$this->ModelHost->get_ho_id();
        $etichetta = $this->ModelHost->get_ho_etichetta();
        $tipo = $this->ModelHost->get_ho_tipo();
        $modello = $this->ModelHost->get_ho_modello();
        $seriale = $this->ModelHost->get_ho_seriale();
        $pwd = $this->ModelHost->get_ho_pwd();
        $pwd_used = $this->ModelHost->get_ho_pwd_used();
        $TipiHost = $this->ModelHost->select_ho_tipo();
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_edit_host($id, $etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $TipiHost);
        $this->Html->HTML_footer();
    }


    /**
     * Elimina un host se non contiene evidence.
     */
    private function delete_host()
    {
        $IdHost = $_POST['ho_id'];
        $count = 0;
        $count = $this->ModelEvidence->count_evidences_of_host($IdHost);
        if($count > 0)
        {
            // Se ci sono evidence dell'host allora non si può eliminare
            $this->return_to_indagato("Non puoi eliminare l'host perché contiene ancora $count evidence.");
        }
        elseif($count <= 0){
            // Se non ci sono evidence dell'host allora si può eliminare l'host
            $this->ModelHost->select_host($IdHost);
            $pathfoto = $this->ModelHost->get_ho_pathfoto();
            if($pathfoto != null)
            {
                $this->ModelGeneric->remove_dir($pathfoto);
                $pathfoto = str_replace("/images/","",$pathfoto);
                $this->ModelGeneric->remove_dir($pathfoto);
            }
            $this->ModelHost->delete_host($_POST['ho_id']);
            $this->return_to_indagato(null);
        }
    }


    /**
     * Visualizza la pagina che permette di eliminare una tipologia di host.
     */
    private function page_del_ho_tipo()
    {
        $TipiHost = $this->ModelHost->select_ho_tipo_for_delete();
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_page_del_ho_tipo($TipiHost);
        $this->Html->HTML_footer();
    }


    /**
     * Elimina una tipologia di host (sia l'icona sia dal db).
     */
    private function del_ho_tipo()
    {
        $IdTipo = $_POST['ho_id_tipo'];
        $PathIcona = $_POST['ho_icon'];
        //Eliminazione icona dalla cartella font/icon/
        unlink($PathIcona);
        // Elimazione riga dal DB
        $this->ModelHost->del_ho_tipo($IdTipo);
        // Selezioni tipi per la pagina di eliminazione
        $TipiHost = $this->ModelHost->select_ho_tipo_for_delete();
        // Stampa pagina di eliminazione dei tipi di host.
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_page_del_ho_tipo($TipiHost);
        $this->Html->HTML_footer();
    }


    /**
     * Visualizza la pagina che permette di aggiungere una nuova tipologia di host.
     */
    private function add_ho_tipo()
    {
        $this->Html->HTML_header();
        $this->HtmlHost->HTML_add_ho_tipo();
        $this->Html->HTML_footer();
    }


    /**
     * @param $message : messaggio da visualizzare in caso non può essere eliminato un indagato siccome contiene ancora hosts
     * Visualizza la pagina contenente gli host di un indagato.
     */
    private function return_to_indagato($message)
    {
        $idInd = $_SESSION['post_ind_id'];
        $this->ModelIndagato->select_one_indagato($idInd);
        $NomeIndagato = $this->ModelIndagato->get_ind_cognome() . " " . $this->ModelIndagato->get_ind_nome();
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $NumCaso = $this->ModelCaso->get_ca_num();
        //Seleziono il PM relativo a questo caso e Prelevo il nome e cognome del pm mappato nel modello ModelPm
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $NomePm = $this->ModelPm->get_pm_cognome() . " " . $this->ModelPm->get_pm_nome();
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        $NomeProcura = $this->ModelProcura->get_cli_nome();

        $Hosts = $this->ModelHost->select_hosts_of_indagato($_SESSION['post_ind_id']);
        $HostsSpecial = $this->ModelHostSpecial->select_hosts_special_of_indagato($_SESSION['post_ind_id']);

        $TipoHost = $this->ModelHost->select_ho_tipo();
        $TipoHostSpecial = $this->ModelHostSpecial->select_hos_tipo();

        $this->Html->HTML_header();
        $this->Html->HTML_message($message);
        $this->HtmlHostSpecial->HTML_hosts_of_indagato($Hosts, $HostsSpecial, $TipoHost, $TipoHostSpecial, $NomeProcura, $NumCaso, $NomePm, $NomeIndagato);
        $this->Html->HTML_footer();
    }


    /**
     * Elimina tutte le foto degli host. (sia files che nel DB)
     */
    private function delete_host_images()
    {
        //elimina tutte le immagini di un host
        $IdHost = $_SESSION['post_ho_id'];
        $this->ModelHost->select_host($IdHost);
        $path = $this->ModelHost->get_ho_pathfoto();
        $img1 = $this->ModelHost->get_ho_image1();
        $img2 = $this->ModelHost->get_ho_image2();
        $img3 = $this->ModelHost->get_ho_image3();
        $img4 = $this->ModelHost->get_ho_image4();
        if($img1!=null){unlink($path.$img1);}
        if($img2!=null){unlink($path.$img2);}
        if($img3!=null){unlink($path.$img3);}
        if($img4!=null){unlink($path.$img4);}
        $this->ModelHost->set_all_host_images_to_null($IdHost);
        /*$this->ModelHost->set_ho_image1_to_null($IdHost);
        $this->ModelHost->set_ho_image2_to_null($IdHost);
        $this->ModelHost->set_ho_image3_to_null($IdHost);
        $this->ModelHost->set_ho_image4_to_null($IdHost);*/
        $this->view_host();
    }

}
