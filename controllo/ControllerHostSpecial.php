<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Class ControllerHostSpecial
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative agli host special
 */
class ControllerHostSpecial
{
    /**
     * ControllerHostSpecial constructor.
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
        $this->HtmlCloneSpecial = new HtmlCloneSpecial();
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

    public function invoke($comando)
    {
        switch ($comando)
        {
            case "view_host_special":
                $this->view_host_special();
                    break;

            case "insert_host_special":
                $this->insert_host_special();
                break;

            case "insert_hos_tipo":
                $this->insert_hos_tipo();
                break;

            case "update_host_special":
                $this->update_host_special();
                break;

            case "update_host_special_images":
                $this->update_host_special_images();
                break;

            case "page_del_hos_tipo":
                $this->page_del_hos_tipo();
                break;
                
            case "del_hos_tipo":
                $this->del_hos_tipo();
                break;
                
            case "delete_host_foto":
                $this->delete_host_foto();
                break;

            case "delete_host_special_images":
                $this->delete_host_special_images();
                break;

            case "SET_DOCX_hostSP_image":
                $IdHostSP = $_POST['ho_id'];
                $ImgName = $_POST['ho_image'];
                $this->ModelHostSpecial->select_host_special($IdHostSP);
                $ImgDocx1 = $this->ModelHostSpecial->get_ho_image_docx();
                $ImgDocx2 = $this->ModelHostSpecial->get_ho_image_docx2();
                if(($ImgDocx1 == null) AND ($ImgDocx2 == null))
                {
                    $this->ModelHostSpecial->SET_DOCX_image1($IdHostSP, $ImgName);
                }
                else if(($ImgDocx1 == null) AND ($ImgDocx2 != null))
                {
                    $this->ModelHostSpecial->SET_DOCX_image1($IdHostSP, $ImgName);
                }
                else if(($ImgDocx1 != null) AND ($ImgDocx2 == null))
                {
                    $this->ModelHostSpecial->SET_DOCX_image2($IdHostSP, $ImgName);
                }

                $this->view_host_special();
                break;

            case "UNSET_DOCX_hostSP_image1":
                $IdHost = $_POST['ho_id'];
                $this->ModelHostSpecial->UNSET_DOCX_hostSP_Image1($IdHost);
                $this->view_host_special();
                break;

            case "UNSET_DOCX_hostSP_image2":
                $IdHost = $_POST['ho_id'];
                $this->ModelHostSpecial->UNSET_DOCX_hostSP_Image2($IdHost);
                $this->view_host_special();
                break;

            /*case "delete_host_special_image1":
                $this->delete_host_special_image1();
                break;

            case "delete_host_special_image2":
                $this->delete_host_special_image2();
                break;

            case "delete_host_special_image3":
                $this->delete_host_special_image3();
                break;

            case "delete_host_special_image4":
                $this->delete_host_special_image4();
                break;*/

            case "page_add_host_special":
                $this->page_add_host_special();
                break;

            case "DELETE_host_special_image":
                unlink($_POST['ho_pathfoto'].$_POST['ho_image']);
                $this->ModelHostSpecial->set_hostSP_image_to_null($_POST['ho_id'], $_POST['ho_image']);
                $this->view_host_special();
                break;

            case "add_hos_tipo":
                $this->add_hos_tipo();
            break;

            case "edit_host_special":
                $this->edit_host_special();
                break;

            case "delete_host_special":
                $this->delete_host_special();
                break;
        }

    }

    private function set_sessione(){
        if(isset($_POST['ho_id']))
        {
            //$ModelGeneric->set_sessione("host", $_POST['ho_id']);
            $id = $_POST['ho_id'];
            $this->ModelHostSpecial->select_host_special($id);
            $ex_id_ind = $this->ModelHostSpecial->get_ex_id_indagato();
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

    public function view_host_special()
    {
        $this->set_sessione();
        // SELEZIONO DATI
        $this->ModelHostSpecial->select_host_special($_SESSION['post_ho_id']);
        $this->ModelIndagato->select_one_indagato($this->ModelHostSpecial->get_ex_id_indagato());
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        // VALORIZZO VARIABILI
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        $NomeProcura = str_replace('Procura della Repubblica','',$NomeProcura);
        $NomePm = $this->ModelPm->get_pm_cognome(). " " . $this->ModelPm->get_pm_nome();
        $NumCaso = $this->ModelCaso->get_ca_num();
        $NomeIndagato = $this->ModelIndagato->get_ind_cognome(). " " . $this->ModelIndagato->get_ind_nome();
        $IdHost = $this->ModelHostSpecial->get_ho_id();
        $NomeHost = $this->ModelHostSpecial->get_ho_etichetta();
        $ho_pathfoto = $this->ModelHostSpecial->get_ho_pathfoto();
        $ho_image1 = $this->ModelHostSpecial->get_ho_image1();
        $ho_image2 = $this->ModelHostSpecial->get_ho_image2();
        $ho_image3 = $this->ModelHostSpecial->get_ho_image3();
        $ho_image4 = $this->ModelHostSpecial->get_ho_image4();
        $ho_image_docx = $this->ModelHostSpecial->get_ho_image_docx();
        $ho_image_docx_2 = $this->ModelHostSpecial->get_ho_image_docx2();
        // STAMPO A VIDEO
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_host_special($NomeProcura, $NomePm, $NumCaso, $NomeIndagato, $IdHost, $NomeHost, $ho_pathfoto, $ho_image1, $ho_image2, $ho_image3, $ho_image4, $ho_image_docx, $ho_image_docx_2);
        $ex_id_host_special = $this->ModelHostSpecial->get_ho_id();
        $_SESSION['post_ho_id'] = $ex_id_host_special;
        $this->ModelClone->select_cloni_of_host_special($ex_id_host_special);
        $Cloni = $this->ModelClone->get_res();
        $this->HtmlCloneSpecial->HTML_clone_host_special($Cloni);
        $this->Html->HTML_footer();
    }
    
    private function insert_host_special()
    {
        $etichetta = $_POST['etichetta'];
        $modello = $_POST['modello'];
        $dimensione = $_POST['dimensione'];
        $kbmbgbtb = $_POST['kbmbgbtb'];
        $seriale = $_POST['seriale'];
        $tipo = $_POST['tipo'];
        $result = $this->ModelGeneric->check_if_apice_virgolette($etichetta, $modello, $seriale);
        if($result == 0)
        {
            $this->ModelHostSpecial->insert_host_special($etichetta, $tipo, $modello, $dimensione, $kbmbgbtb, $seriale, $_SESSION['post_ca_id'], $_SESSION['post_ind_id']);
            $this->ModelHostSpecial->select_last_id();
            $this->ControllerIndagato->return_to_indagato();
        }
        else
        {
            echo"<div style='color: red; text-align: center'><b>ATTENZIONE: Apici e Virgolette sono vietati!</b></div>";
            $this->return_to_indagato();
        }
    }
    
    private function insert_hos_tipo()
    {
        $HosTipo = $_POST['hos_tipo'];

        // Esegue upload dell'icona scelta
        $NomeIcona = $this->upload_icona();
        // Elimina gli spazi nel nome del tipo per poter rinominare l'icona senza utilizzare spazi
        $PathIcona = "font/icon/".$HosTipo.".png";
        $PathIcona = str_replace(" ", "", $PathIcona);
        rename("font/icon/".$NomeIcona, $PathIcona);


        // Esegue l'insert della nuova tipologia di host special
        $this->ModelHostSpecial->insert_hos_tipo($HosTipo, $PathIcona);
        $tipi = $this->ModelHostSpecial->select_hos_tipo();
        // Stampa pagina di aggiunta nuovo host speciale.
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_add_host_special($tipi);
        $this->Html->HTML_footer();
    }

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
    
    private function update_host_special()
    {
        $id = $_POST['ho_id'];
        $etichetta = $_POST['ho_etichetta'];
        $tipo = $_POST['ho_tipo'];
        $modello = $_POST['ho_modello'];
        $seriale = $_POST['ho_seriale'];
        $dimensione = $_POST['evi_dimensione'];
        $kbmbgbtb = $_POST['evi_kbmbgbtb'];
        $result = $this->ModelGeneric->check_if_apice_virgolette($etichetta, $modello, $seriale);
        if($result == 0){
            $this->ModelHostSpecial->update_special_host($id, $etichetta, $tipo, $modello, $dimensione, $kbmbgbtb, $seriale, $dimensione, $kbmbgbtb);
            $this->return_to_indagato();
        }
        else{
            echo"<div style='color: red; text-align: center;'><b>ATTENZIONE: Apici e Virgolette sono vietati!</b></div>";
            $this->return_to_indagato();
        }
    }
    
    private function update_host_special_images()
    {
        $this->ModelHostSpecial->select_host_special($_SESSION['post_ho_id']);
        $this->ModelIndagato->select_one_indagato($this->ModelHostSpecial->get_ex_id_indagato());
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        $IdHost = $this->ModelHostSpecial->get_ho_id();
        $IdIndagato = $this->ModelIndagato->get_ind_id();
        $IdCaso = $this->ModelCaso->get_ca_id();
        $IdPm = $this->ModelPm->get_pm_id();
        $IdProcura = $this->ModelProcura->get_cli_id();
        $this->ModelHostSpecial->upload_multiple_image($IdProcura, $IdPm, $IdCaso, $IdIndagato, $IdHost);
        // Fa il resize delle immagini appena caricate
        // @ utilizzato per non dare warning a video
        $this->ModelHostSpecial->select_host_special($IdHost);
        $path = $this->ModelHostSpecial->get_ho_pathfoto();
        $img1 = $this->ModelHostSpecial->get_ho_image1();
        $img2 = $this->ModelHostSpecial->get_ho_image2();
        $img3 = $this->ModelHostSpecial->get_ho_image3();
        $img4 = $this->ModelHostSpecial->get_ho_image4();

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
        $this->view_host_special();
    }

    private function resize_imagejpg($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($w, $h);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
        // Restituisce dst che è un oggetto di tipo imagejpeg
        return $dst;
    }
    
    private function page_del_hos_tipo()
    {
        $tipi = $this->ModelHostSpecial->select_hos_tipo_for_delete();
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_page_del_hos_tipo($tipi);
        $this->Html->HTML_footer();
    }
    
    private function del_hos_tipo()
    {
        $IdTipo = $_POST['hos_tipo_id'];
        $PathIcona = $_POST['hos_icon'];
        //Eliminazione icona dalla cartella font/icon/
        unlink($PathIcona);
        // Eliminazione riga dal DB
        $this->ModelHostSpecial->del_hos_tipo($IdTipo);
        $tipi = $this->ModelHostSpecial->select_hos_tipo_for_delete();
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_page_del_hos_tipo($tipi);
        $this->Html->HTML_footer();
    }
    
    private function delete_host_foto()
    {
        unlink($_POST['foto']);
        $this->view_host_special();
    }
    
    private function delete_host_special_image1()
    {
        unlink($_POST['ho_pathfoto'].$_POST['ho_image1']);
        $this->ModelHostSpecial->set_ho_spec_image1_to_null($_POST['ho_id']);
        $this->view_host_special();
    }
    
    private function delete_host_special_image2()
    {
        unlink($_POST['ho_pathfoto'].$_POST['ho_image2']);
        $this->ModelHostSpecial->set_ho_spec_image2_to_null($_POST['ho_id']);
        $this->view_host_special();
    }
    
    private function delete_host_special_image3()
    {
        unlink($_POST['ho_pathfoto'].$_POST['ho_image3']);
        $this->ModelHostSpecial->set_ho_spec_image3_to_null($_POST['ho_id']);
        $this->view_host_special();
    }
    
    private function delete_host_special_image4()
    {
        unlink($_POST['ho_pathfoto'].$_POST['ho_image4']);
        $this->ModelHostSpecial->set_ho_spec_image4_to_null($_POST['ho_id']);
        $this->view_host_special();
    }
    
    private function page_add_host_special()
    {
        $tipi = $this->ModelHostSpecial->select_hos_tipo();
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_add_host_special($tipi);
        $this->Html->HTML_footer();
    }
    
    private function add_hos_tipo()
    {
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_add_tipo_hosp();
        $this->Html->HTML_footer();
    }
    
    private function edit_host_special()
    {
        $this->ModelHostSpecial->select_host_special($_POST['ho_id']);
        $id=$this->ModelHostSpecial->get_ho_id();
        $etichetta = $this->ModelHostSpecial->get_ho_etichetta();
        $tipo = $this->ModelHostSpecial->get_ho_tipo();
        $modello = $this->ModelHostSpecial->get_ho_modello();
        $dimensione = $this->ModelHostSpecial->get_ho_dimensione();
        $kbmbgbtb = $this->ModelHostSpecial->get_ho_kbmbgbtb();
        $seriale = $this->ModelHostSpecial->get_ho_seriale();
        $TipiHostSpec = $this->ModelHostSpecial->select_hos_tipo();
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_edit_special_host($id, $etichetta, $tipo, $modello, $dimensione, $kbmbgbtb, $seriale, $TipiHostSpec);
        $this->Html->HTML_footer();
    }
    
    private function delete_host_special()
    {
        $this->ModelHostSpecial->select_host_special($_POST['ho_id']);
        $pathfoto = $this->ModelHostSpecial->get_ho_pathfoto();
        if($pathfoto != null)
        {
            $pathfoto = $this->ModelHostSpecial->get_ho_pathfoto();
            //rmdir($del_pathfoto);
            $this->ModelGeneric->remove_dir($pathfoto);
            $pathfoto = str_replace("/images/","",$pathfoto);
            $this->ModelGeneric->remove_dir($pathfoto);
        }
        $this->ModelHostSpecial->delete_host_special($_POST['ho_id']);
        $this->ControllerIndagato->return_to_indagato();
    }


    private function return_to_indagato()
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
        $this->HtmlHostSpecial->HTML_hosts_of_indagato($Hosts, $HostsSpecial, $TipoHost, $TipoHostSpecial, $NomeProcura, $NumCaso, $NomePm, $NomeIndagato);

        $this->Html->HTML_footer();
    }


    private function delete_host_special_images()
    {
        //elimina tutte le immagini di un host special
        $IdHost = $_SESSION['post_ho_id'];
        $this->ModelHostSpecial->select_host_special($IdHost);
        $path = $this->ModelHostSpecial->get_ho_pathfoto();
        $img1 = $this->ModelHostSpecial->get_ho_image1();
        $img2 = $this->ModelHostSpecial->get_ho_image2();
        $img3 = $this->ModelHostSpecial->get_ho_image3();
        $img4 = $this->ModelHostSpecial->get_ho_image4();
        if($img1!=null){unlink($path.$img1);}
        if($img2!=null){unlink($path.$img2);}
        if($img3!=null){unlink($path.$img3);}
        if($img4!=null){unlink($path.$img4);}
        $this->ModelHostSpecial->set_ho_spec_image1_to_null($IdHost);
        $this->ModelHostSpecial->set_ho_spec_image2_to_null($IdHost);
        $this->ModelHostSpecial->set_ho_spec_image3_to_null($IdHost);
        $this->ModelHostSpecial->set_ho_spec_image4_to_null($IdHost);
        $this->ModelHostSpecial->set_hostSP_image_docx_to_null($IdHost);
        $this->ModelHostSpecial->set_hostSP_image_docx2_to_null($IdHost);
        $this->view_host_special();
    }

}
