<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Class ControllerIndagato
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative agli indagati
 */
class ControllerIndagato
{
    /**
     * ControllerIndagato constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->Html = new HtmlPainter();
        $this->PdfInd = new MpdfIndagato();
        $this->HtmlIndagato = new HtmlIndagato();
        $this->HtmlHost = new HtmlHost();
        $this->HtmlHostSpecial = new HtmlHostSpecial();
        $this->ModelAzienda = new ModelAzienda();
        $this->ModelProcura = new ModelProcura();
        $this->ModelPm = new ModelPm();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
        $this->ModelHost= new ModelHost();
        $this->ModelHostSpecial= new ModelHostSpecial();
        $this->ModelEvidence = new ModelEvidence();
        $this->ModelClone = new ModelClone();

    }


    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando)
        {
            case "return_to_caso":
                $this->return_to_caso();
                break;

            case "view_indagato":
                $this->view_indagato();
                break;

            case "status_indagato":
                $this->status_indagato();
                break;

            case "insert_indagato":
                $this->insert_indagato();
                break;

            case 'edit_indagato':
                $this->edit_indagato();
                break;

            case "update_indagato":
                $this->update_indagato();
                break;

            case "page_add_indagato":
                $this->page_add_indagato();
                break;

            case "report_indagato":
                $this->report_indagato();
                break;

            case "report_indagato_mpdf":
                $this->report_indagato_mpdf();
                break;

            case "delete_indagato":
                $this->delete_indagato();
                break;
                
            case "delete_indagato1":
                $this->ModelIndagato->delete_indagato($_POST['ind_id']);
                $this->return_to_caso();
                break;
        }

    }

    /**
     * Visualizza la pagina che visualizza gli host appartenenti ad un indagato.
     */
    private function view_indagato()
    {
        $IdInd = $_POST['ind_id'];
        // SETTO LA SESSIONE
        $this->set_sessione($IdInd);
        // PRELEVO DATI CHE SERVIRANNO PER VISUALIZZARE IL PATH IN ALTO
        $this->ModelIndagato->select_one_indagato($IdInd);
        $NomeIndagato = $this->ModelIndagato->get_ind_cognome() . " " . $this->ModelIndagato->get_ind_nome();
        $idCa = $this->ModelIndagato->get_ex_id_ca();
        $this->ModelCaso->select_one_caso($idCa);
        $NumCaso = $this->ModelCaso->get_ca_num();
        $idPm = $this->ModelCaso->get_ex_id_pm();
        $this->ModelPm->select_single_pm($idPm);
        $NomePm = $this->ModelPm->get_pm_cognome() . " " . $this->ModelPm->get_pm_nome();
        $idPro = $this->ModelPm->get_ex_id_cli();
        $this->ModelProcura->select_single_procura($idPro);
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        // Seleziono tutti gli host dell'indagato
        $Hosts = $this->ModelHost->select_hosts_of_indagato($IdInd);
        $HostsSpecial = $this->ModelHostSpecial->select_hosts_special_of_indagato($IdInd);
        // Seleziono le tipologie degli Host e Host Speciali
        $TipoHost = $this->ModelHost->select_ho_tipo();
        $TipoHostSpecial = $this->ModelHostSpecial->select_hos_tipo();
        // Stampa la pagina degli host dell'indagato
        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_hosts_of_indagato($Hosts, $HostsSpecial, $TipoHost, $TipoHostSpecial, $NomeProcura, $NumCaso, $NomePm, $NomeIndagato);
        $this->Html->HTML_footer();
    }

    /**
     * Visualizza lo status di un indagato ovvero quanti hosts, quanti evidence, quanti host special e la somma di quanti GB occupano
     */
    private function status_indagato()
    {
        $IdInd = $_POST['ind_id'];
        // PRELEVO DATI CHE SERVIRANNO PER VISUALIZZARE IL PATH IN ALTO
        $this->ModelIndagato->select_one_indagato($IdInd);
        $NomeIndagato = $this->ModelIndagato->get_ind_cognome() . " " . $this->ModelIndagato->get_ind_nome();
        $idCa = $this->ModelIndagato->get_ex_id_ca();
        $this->ModelCaso->select_one_caso($idCa);
        $NumCaso = $this->ModelCaso->get_ca_num();
        $idPm = $this->ModelCaso->get_ex_id_pm();
        $this->ModelPm->select_single_pm($idPm);
        $NomePm = $this->ModelPm->get_pm_cognome() . " " . $this->ModelPm->get_pm_nome();
        $idPro = $this->ModelPm->get_ex_id_cli();
        $this->ModelProcura->select_single_procura($idPro);
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        // PRELEVO DATI PER L'ENUMERAZIONE DEI DISPOSITIVI
        $Hosts = $this->ModelHost->select_hosts_of_indagato($IdInd);
        $HostsSpecial = $this->ModelHostSpecial->select_hosts_special_of_indagato($IdInd);
        $Evidences = $this->ModelHost->select_hosts_evidence_of_indagato($IdInd);
        $TipiHost = $this->ModelHost->select_ho_tipo();
        $TipiHostSp = $this->ModelHostSpecial->select_hos_tipo();
        $TipiEvi = $this->ModelEvidence->select_tipi_evidence();
        // STAMPO A VIDEO
        $this->Html->HTML_header();
        $this->HtmlIndagato->HTML_status_indagato($Hosts, $HostsSpecial, $Evidences, $TipiHost, $TipiHostSp, $TipiEvi, $NomeProcura, $NumCaso, $NomePm, $NomeIndagato);
        $this->Html->HTML_footer();
    }
    
    private function insert_indagato()
    {
        // Prelevo il nome del Pm che stà gestendo questo indagato
        $this->ModelCaso->select_one_caso($_SESSION['post_ca_id']);
        $IdCaso = $this->ModelCaso->get_ca_id();
        $titolo = $_POST['ind_titolo'];
        $nome = $_POST['ind_nome'];
        $cognome = $_POST['ind_cognome'];
        $this->ModelIndagato->insert_indagato($titolo, $nome, $cognome, $IdCaso);
        $this->return_to_caso();
    }
    
    private function edit_indagato()
    {
        $this->ModelIndagato->select_one_indagato($_POST['ind_id']);
        $id = $this->ModelIndagato->get_ind_id();
        $titolo = $this->ModelIndagato->get_ind_titolo();
        $nome = $this->ModelIndagato->get_ind_nome();
        $cognome = $this->ModelIndagato->get_ind_cognome();
        $this->Html->HTML_header();
        $this->HtmlIndagato->HTML_edit_indagato($id, $titolo, $nome, $cognome);
        $this->Html->HTML_footer();
    }
    
    private function update_indagato()
    {
        $id = $_POST['ind_id'];
        $titolo = $_POST['ind_titolo'];
        $nome = $_POST['ind_nome'];
        $cognome = $_POST['ind_cognome'];
        $this->ModelIndagato->update_indagato($id, $titolo, $nome, $cognome);
        $this->return_to_caso();
    }
    
    private function page_add_indagato()
    {
            $this->Html->HTML_header();
            $this->HtmlIndagato->HTML_add_indagato();
            $this->Html->HTML_footer();
    }
    
    private function report_indagato()
    {
        //SELEZIONE DEL CTU
        $this->ModelAzienda->select_azienda_default();
        $ctu = $this->ModelAzienda->getCtu();
        // SELEZIONE DELL'INDAGATO TRAMITE ID
        $this->ModelIndagato->select_one_indagato($_POST['ind_id']);
        // COPIA IN VARIABILE DELL'ID DELL'INDAGATO IN QUESTIONE
        $IdIndagato = $this->ModelIndagato->get_ind_id();
        // SELEZIONE DEL CASO RELATIVO A TALE INDAGATO
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        // COPIA ID IN VARIABILE ID DEL CASO IN QUESTIONE
        $IdCaso = $this->ModelCaso->get_ca_id();
        // SELEZIONE HOST DELL'INDAGATO
        $Info = $this->ModelIndagato->select_info_for_report($IdIndagato);
        // SELEZIONE HOST SPECIALI
        $HostsSpecial = $this->ModelHostSpecial->select_host_special_report($IdIndagato);
        //$arr = $this->ModelIndagato->select_info_for_report($IdCaso, $IdIndagato);
        // IMPOSTO INFORMAZIONI INIZIALI CHE SERVIRANNO NEI CONTROLLI INIZIALI DELLE ITERAZIONI PER LA STAMPA DELLE INFORMAZIONI
        $ho_id = 0;
        $ho_spec_id = 0;
        $evi_id = 0;
        $clo_id = 0;
        $ca_num = 0;
        $ca_tipo = 0;
        $pm_titolo = 0;
        $pm_cognome = 0;
        $pm_nome = 0;
        $cli_nome = 0;
        $cli_citta = 0;
        $ind_titolo = 0;
        $ind_cognome = 0;
        $ind_nome = 0;
        foreach($Info as $row){
            $ca_num = $row['ca_num'];
            $ca_tipo = $row['ca_tipo'];
            $pm_titolo = $row['pm_titolo'];
            $pm_cognome = $row['pm_cognome'];
            $pm_nome = $row['pm_nome'];
            $cli_nome = $row['cli_nome'];
            $cli_citta = $row['cli_citta'];
            $ind_titolo = $row['ind_titolo'];
            $ind_cognome = $row['ind_cognome'];
            $ind_nome = $row['ind_nome'];
            break;
        }

        $this->HtmlIndagato->HTML_REPORT_header($ind_cognome, $ind_nome);
        $this->HtmlIndagato->HTML_REPORT_page_header("Supporti Acquisiti");
        $this->HtmlIndagato->HTML_REPORT_info($ca_num, $ca_tipo, $ind_titolo, $ind_cognome, $ind_nome, $cli_nome, $cli_citta, $pm_titolo, $pm_cognome, $pm_nome, $ctu);
        //STAMPA DESCRIZIONE HOST
        $this->HtmlIndagato->HTML_REPORT_descrizione_host($Info, $HostsSpecial, $ho_id, $ho_spec_id);
        // STAMPA DESCRIZIONE MEDIA
        $this->Html->HTML_br();
        $this->HtmlIndagato->HTML_REPORT_descrizione_media($Info, $HostsSpecial);
        
        // STAMPA DETTAGLIO HOST, MEDIA E ACQUISIZIONE DI UN HOST NORMALE
        $this->print_dettaglio_host($Info, $ho_id, $evi_id, $clo_id);
        $this->print_dettaglio_host_special($HostsSpecial, 0, 0);
        $this->Html->HTML_footer();
    }













    private function report_indagato_mpdf()
    {
        try {
            //SELEZIONE DEL CTU
            $this->ModelAzienda->select_azienda_default();
            $ctu = $this->ModelAzienda->getCtu();
            // SELEZIONE DELL'INDAGATO TRAMITE ID
            $this->ModelIndagato->select_one_indagato($_POST['ind_id']);
            // COPIA IN VARIABILE DELL'ID DELL'INDAGATO IN QUESTIONE
            $IdIndagato = $this->ModelIndagato->get_ind_id();
            // SELEZIONE DEL CASO RELATIVO A TALE INDAGATO
            $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
            // COPIA ID IN VARIABILE ID DEL CASO IN QUESTIONE
            $IdCaso = $this->ModelCaso->get_ca_id();
            // SELEZIONE HOST DELL'INDAGATO
            $Info = $this->ModelIndagato->select_info_for_report($IdIndagato);
            // SELEZIONE HOST SPECIALI
            $HostsSpecial = $this->ModelHostSpecial->select_host_special_report($IdIndagato);
            //$arr = $this->ModelIndagato->select_info_for_report($IdCaso, $IdIndagato);
            // IMPOSTO INFORMAZIONI INIZIALI CHE SERVIRANNO NEI CONTROLLI INIZIALI DELLE ITERAZIONI PER LA STAMPA DELLE INFORMAZIONI
            $ho_id = 0;
            $ho_spec_id = 0;
            $evi_id = 0;
            $clo_id = 0;
            $ca_num = 0;
            $ca_tipo = 0;
            $pm_titolo = 0;
            $pm_cognome = 0;
            $pm_nome = 0;
            $cli_nome = 0;
            $cli_citta = 0;
            $ind_titolo = 0;
            $ind_cognome = 0;
            $ind_nome = 0;
            foreach ($Info as $row) {
                $ca_num = $row['ca_num'];
                $ca_tipo = $row['ca_tipo'];
                $pm_titolo = $row['pm_titolo'];
                $pm_cognome = $row['pm_cognome'];
                $pm_nome = $row['pm_nome'];
                $cli_nome = $row['cli_nome'];
                $cli_citta = $row['cli_citta'];
                $ind_titolo = $row['ind_titolo'];
                $ind_cognome = $row['ind_cognome'];
                $ind_nome = $row['ind_nome'];
                break;
            }


            $mpdf = new \Mpdf\Mpdf();
            $mpdf->setFooter('{PAGENO} di {nb}');
            ob_start();
            echo $this->PdfInd->HTML_REPORT_header_mpdf($ind_cognome, $ind_nome);
            echo $this->PdfInd->HTML_REPORT_page_header_mpdf("Supporti Acquisiti");
            echo $this->PdfInd->HTML_REPORT_info_mpdf($ca_num, $ca_tipo, $ind_titolo, $ind_cognome, $ind_nome, $cli_nome, $cli_citta, $pm_titolo, $pm_cognome, $pm_nome, $ctu);
            //STAMPA DESCRIZIONE HOST
            echo $this->PdfInd->HTML_REPORT_descrizione_host_mpdf($Info, $HostsSpecial, $ho_id, $ho_spec_id);
            // STAMPA DESCRIZIONE MEDIA
            echo $this->PdfInd->HTML_br();
            echo $this->PdfInd->HTML_REPORT_descrizione_media_mpdf($Info, $HostsSpecial);

            // PRINT DETTAGLIO HOST
            foreach ($Info as $row) {
                if ($ho_id != $row['ho_id']) {
                    // SE NON E' UN HOST SPECIALE (collection) STAMPO IL DETTAGLIO HOST, QUINDI IN CASO SIA UN HOST SPECIALE NON STAMPA E VADO DIRETTAMENTE A STAMPANRE IL DETTAGLIO MEDIA.
                    $ho_pathfoto = $row['ho_pathfoto'];
                    $ho_image1 = $row['ho_image1'];
                    $ho_image2 = $row['ho_image2'];
                    $ho_image3 = $row['ho_image3'];
                    $ho_image4 = $row['ho_image4'];
                    //$ho_image4 = $row['ho_image2'];
                    if (($ho_image1 != null) && ($ho_image1 != '.') && ($ho_image1 != '..')) {
                        $md5_image1 = md5_file($ho_pathfoto . $ho_image1);
                    } else {
                        $md5_image1 = null;
                    }
                    if (($ho_image2 != null) && ($ho_image2 != '.') && ($ho_image2 != '..')) {
                        $md5_image2 = md5_file($ho_pathfoto . $ho_image2);
                    } else {
                        $md5_image2 = null;
                    }
                    if (($ho_image3 != null) && ($ho_image3 != '.') && ($ho_image3 != '..')) {
                        $md5_image3 = md5_file($ho_pathfoto . $ho_image3);
                    } else {
                        $md5_image3 = null;
                    }
                    if (($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')) {
                        $md5_image4 = md5_file($ho_pathfoto . $ho_image4);
                    } else {
                        $md5_image4 = null;
                    }
                    echo $this->PdfInd->HTML_newpage();
                    //if(($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')){$md5_image4 = md5_file($ho_pathfoto.$ho_image4);}else{$md5_image4 = null;}

                    echo $this->PdfInd->HTML_REPORT_page_header_mpdf("Dettaglio Host");
                    echo $this->PdfInd->HTML_REPORT_dettaglio_host_mpdf($row['ho_etichetta'], $row['ho_modello'], $row['ho_seriale'], $row['ho_pwd'], $row['ho_pwd_used'], $row['ho_tipo']);
                    //echo $this->PdfInd->HTML_REPORT_table_one_tr('Foto');

                    // STAMPA IMMAGINI
                    echo $this->PdfInd->HTML_REPORT_table_one_tr("Foto");
                    echo $this->PdfInd->HTML_br();
                    echo $this->PdfInd->HTML_REPORT_foto_mpdf($ho_pathfoto, $ho_image1, $md5_image1, $ho_image2, $md5_image2, $ho_image3, $md5_image3, $ho_image4, $md5_image4);

                    echo $this->PdfInd->HTML_close_newpage();

                }


                $ho_id = $row['ho_id'];

                if ($evi_id != $row['evi_id']) {
                    $evi_pathfoto = $row['evi_pathfoto'];
                    $evi_image1 = $row['evi_image1'];
                    $evi_image2 = $row['evi_image2'];
                    $evi_image3 = $row['evi_image3'];
                    if (($evi_image1 != null) && ($evi_image1 != '.') && ($evi_image1 != '..')) {
                        $md5_image1 = md5_file($evi_pathfoto . $evi_image1);
                    } else {
                        $md5_image1 = null;
                    }
                    if (($evi_image2 != null) && ($evi_image2 != '.') && ($evi_image2 != '..')) {
                        $md5_image2 = md5_file($evi_pathfoto . $evi_image2);
                    } else {
                        $md5_image2 = null;
                    }
                    if (($evi_image3 != null) && ($evi_image3 != '.') && ($evi_image3 != '..')) {
                        $md5_image3 = md5_file($evi_pathfoto . $evi_image3);
                    } else {
                        $md5_image3 = null;
                    }
                    // PRINT DETTAGLIO MEDIA/EVIDENCE
                    echo $this->PdfInd->HTML_newpage();
                    echo $this->PdfInd->HTML_REPORT_page_header_mpdf("Dettaglio Media");
                    echo $this->PdfInd->HTML_REPORT_dettaglio_evidence_mpdf($row['ho_etichetta'], $row['evi_etichetta'], $row['evi_tipo'], $row['evi_modello'], $row['evi_seriale'], $row['evi_pwd'], $row['evi_pwd_used'], $row['evi_dimensione'], $row['evi_kbmbgbtb']);
                    //echo "</div>";
                    //echo $this->PdfInd->HTML_REPORT_table_one_tr('Foto');

                    // STAMPA IMMAGINI EVIDENCES
                    // Se evi_tipo è SimCard allora le immagini saranno posizionate ad un'altezza differente rispetto agli evidence di diversa tipologia.
                    echo $this->PdfInd->HTML_REPORT_table_one_tr("Foto");
                    echo $this->PdfInd->HTML_br();
                    echo $this->PdfInd->HTML_REPORT_foto_mpdf($evi_pathfoto, $evi_image1, $md5_image1, $evi_image2, $md5_image2, $evi_image3, $md5_image3, null, null);
                    echo $this->PdfInd->HTML_close_newpage();

                }

                $evi_id = $row['evi_id'];

                if ($clo_id != $row['clo_id']) {
                    echo $this->PdfInd->HTML_newpage();
                    echo $this->PdfInd->HTML_br();
                    echo $this->PdfInd->HTML_REPORT_page_header_mpdf("Acquisizione");
                    echo $this->PdfInd->HTML_REPORT_clone_mpdf($row['evi_etichetta'], $row['clo_tipoacq'], $row['clo_altro_tipo'], $row['clo_stracq'], $row['clo_md5'], $row['clo_sha1'], $row['clo_sha256']);
                    echo $this->PdfInd->HTML_REPORT_table_one_tr('Log');
                    $logpath = $row['clo_log'];
                    $log = $this->ModelClone->get_log_file($logpath);
                    echo "<pre>$log</pre>";
                    echo $this->PdfInd->HTML_close_newpage();
                }

                $clo_id = $row['clo_id'];

            }

            // PRINT DETTAGLIO HOSTS SPECIAL
            foreach ($HostsSpecial as $row) {
                if ($ho_id != $row['ho_id']) {
                    // SE NON E' UN HOST SPECIALE (collection) STAMPO IL DETTAGLIO HOST, QUINDI IN CASO SIA UN HOST SPECIALE NON STAMPA E VADO DIRETTAMENTE A STAMPANRE IL DETTAGLIO MEDIA.
                    $ho_pathfoto = $row['ho_pathfoto'];
                    $ho_image1 = $row['ho_image1'];
                    $ho_image2 = $row['ho_image2'];
                    $ho_image3 = $row['ho_image3'];
                    $ho_image4 = $row['ho_image4'];
                    if (($ho_image1 != null) && ($ho_image1 != '.') && ($ho_image1 != '..')) {
                        $md5_image1 = md5_file($ho_pathfoto . $ho_image1);
                    } else {
                        $md5_image1 = null;
                    }
                    if (($ho_image2 != null) && ($ho_image2 != '.') && ($ho_image2 != '..')) {
                        $md5_image2 = md5_file($ho_pathfoto . $ho_image2);
                    } else {
                        $md5_image2 = null;
                    }
                    if (($ho_image3 != null) && ($ho_image3 != '.') && ($ho_image3 != '..')) {
                        $md5_image3 = md5_file($ho_pathfoto . $ho_image3);
                    } else {
                        $md5_image3 = null;
                    }
                    if (($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')) {
                        $md5_image4 = md5_file($ho_pathfoto . $ho_image4);
                    } else {
                        $md5_image4 = null;
                    }

                    echo $this->PdfInd->HTML_newpage();
                    echo $this->PdfInd->HTML_br();
                    echo $this->PdfInd->HTML_REPORT_page_header_mpdf("Dettaglio Host");
                    echo $this->PdfInd->HTML_REPORT_dettaglio_host_special_mpdf($row['ho_etichetta'], $row['ho_modello'], $row['ho_seriale'], $row['ho_tipo']);
                    //echo $this->PdfInd->HTML_REPORT_table_one_tr('Foto');

                    // STAMPA IMMAGINI HOST SPECIAL
                    echo $this->PdfInd->HTML_REPORT_table_one_tr("Foto");
                    echo $this->PdfInd->HTML_br();
                    echo $this->PdfInd->HTML_REPORT_foto_mpdf($ho_pathfoto, $ho_image1, $md5_image1, $ho_image2, $md5_image2, $ho_image3, $md5_image3, $ho_image4, $md5_image4);
                    echo $this->PdfInd->HTML_close_newpage();


                }

                $ho_id = $row['ho_id'];

                if ($clo_id != $row['clo_id']) {
                    echo $this->PdfInd->HTML_newpage();
                    echo $this->PdfInd->HTML_br();
                    echo $this->PdfInd->HTML_REPORT_page_header_mpdf("Acquisizione");
                    echo $this->PdfInd->HTML_REPORT_clone_mpdf($row['ho_etichetta'], $row['clo_tipoacq'], $row['clo_altro_tipo'], $row['clo_stracq'], $row['clo_md5'], $row['clo_sha1'], $row['clo_sha256']);
                    $logpath = $row['clo_log'];
                    $log = file_get_contents($logpath);
                    echo $this->PdfInd->HTML_REPORT_table_one_tr('Log');
                    echo"<pre>$log</pre>";
                    //$mpdf->WriteHTML($html);
                    echo $this->PdfInd->HTML_close_newpage();
                }

                $clo_id = $row['clo_id'];
            }

            $html = ob_get_contents();
            ob_clean();
            //echo $html;
            $mpdf->WriteHTML($html);
            //$mpdf->Output();
            $mpdf->Output($ind_cognome . " " . $ind_nome . '.pdf', 'D');
        }
        catch (Exception $e)
        {
            echo "ECCEZIONE: $e";
        }
    }
















    private function report_indagato_mpdf_OLD()
    {
        try {
            //SELEZIONE DEL CTU
            $this->ModelAzienda->select_azienda_default();
            $ctu = $this->ModelAzienda->getCtu();
            // SELEZIONE DELL'INDAGATO TRAMITE ID
            $this->ModelIndagato->select_one_indagato($_POST['ind_id']);
            // COPIA IN VARIABILE DELL'ID DELL'INDAGATO IN QUESTIONE
            $IdIndagato = $this->ModelIndagato->get_ind_id();
            // SELEZIONE DEL CASO RELATIVO A TALE INDAGATO
            $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
            // COPIA ID IN VARIABILE ID DEL CASO IN QUESTIONE
            $IdCaso = $this->ModelCaso->get_ca_id();
            // SELEZIONE HOST DELL'INDAGATO
            $Info = $this->ModelIndagato->select_info_for_report($IdIndagato);
            // SELEZIONE HOST SPECIALI
            $HostsSpecial = $this->ModelHostSpecial->select_host_special_report($IdIndagato);
            //$arr = $this->ModelIndagato->select_info_for_report($IdCaso, $IdIndagato);
            // IMPOSTO INFORMAZIONI INIZIALI CHE SERVIRANNO NEI CONTROLLI INIZIALI DELLE ITERAZIONI PER LA STAMPA DELLE INFORMAZIONI
            $ho_id = 0;
            $ho_spec_id = 0;
            $evi_id = 0;
            $clo_id = 0;
            $ca_num = 0;
            $ca_tipo = 0;
            $pm_titolo = 0;
            $pm_cognome = 0;
            $pm_nome = 0;
            $cli_nome = 0;
            $cli_citta = 0;
            $ind_titolo = 0;
            $ind_cognome = 0;
            $ind_nome = 0;
            foreach ($Info as $row) {
                $ca_num = $row['ca_num'];
                $ca_tipo = $row['ca_tipo'];
                $pm_titolo = $row['pm_titolo'];
                $pm_cognome = $row['pm_cognome'];
                $pm_nome = $row['pm_nome'];
                $cli_nome = $row['cli_nome'];
                $cli_citta = $row['cli_citta'];
                $ind_titolo = $row['ind_titolo'];
                $ind_cognome = $row['ind_cognome'];
                $ind_nome = $row['ind_nome'];
                break;
            }


            $mpdf = new \Mpdf\Mpdf();
            $mpdf->setFooter('{PAGENO} di {nb}');
            $mpdf->WriteHTML($this->PdfInd->HTML_REPORT_header_mpdf($ind_cognome, $ind_nome));
            $mpdf->WriteHTML($this->PdfInd->HTML_REPORT_page_header_mpdf("Supporti Acquisiti"));
            $html = $this->PdfInd->HTML_REPORT_info_mpdf($ca_num, $ca_tipo, $ind_titolo, $ind_cognome, $ind_nome, $cli_nome, $cli_citta, $pm_titolo, $pm_cognome, $pm_nome, $ctu);
            $mpdf->WriteHTML($html);
            //STAMPA DESCRIZIONE HOST
            $html = $this->PdfInd->HTML_REPORT_descrizione_host_mpdf($Info, $HostsSpecial, $ho_id, $ho_spec_id);
            $mpdf->WriteHTML($html);
            // STAMPA DESCRIZIONE MEDIA
            $mpdf->WriteHTML("<br>");
            $html = $this->PdfInd->HTML_REPORT_descrizione_media_mpdf($Info, $HostsSpecial);
            $mpdf->WriteHTML($html);

            // PRINT DETTAGLIO HOST
            foreach ($Info as $row) {
                if ($ho_id != $row['ho_id']) {
                    // SE NON E' UN HOST SPECIALE (collection) STAMPO IL DETTAGLIO HOST, QUINDI IN CASO SIA UN HOST SPECIALE NON STAMPA E VADO DIRETTAMENTE A STAMPANRE IL DETTAGLIO MEDIA.
                    $ho_pathfoto = $row['ho_pathfoto'];
                    $ho_image1 = $row['ho_image1'];
                    $ho_image2 = $row['ho_image2'];
                    $ho_image3 = $row['ho_image3'];
                    $ho_image4 = $row['ho_image4'];
                    //$ho_image4 = $row['ho_image2'];
                    if (($ho_image1 != null) && ($ho_image1 != '.') && ($ho_image1 != '..')) {
                        $md5_image1 = md5_file($ho_pathfoto . $ho_image1);
                    } else {
                        $md5_image1 = null;
                    }
                    if (($ho_image2 != null) && ($ho_image2 != '.') && ($ho_image2 != '..')) {
                        $md5_image2 = md5_file($ho_pathfoto . $ho_image2);
                    } else {
                        $md5_image2 = null;
                    }
                    if (($ho_image3 != null) && ($ho_image3 != '.') && ($ho_image3 != '..')) {
                        $md5_image3 = md5_file($ho_pathfoto . $ho_image3);
                    } else {
                        $md5_image3 = null;
                    }
                    if (($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')) {
                        $md5_image4 = md5_file($ho_pathfoto . $ho_image4);
                    } else {
                        $md5_image4 = null;
                    }
                    //if(($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')){$md5_image4 = md5_file($ho_pathfoto.$ho_image4);}else{$md5_image4 = null;}
                    $mpdf->AddPage();
                    $mpdf->Ln();
                    $mpdf->WriteHTML($this->PdfInd->HTML_REPORT_page_header_mpdf("Dettaglio Host"));
                    $html = $this->PdfInd->HTML_REPORT_dettaglio_host_mpdf($row['ho_etichetta'], $row['ho_modello'], $row['ho_seriale'], $row['ho_pwd'], $row['ho_pwd_used'], $row['ho_tipo']);
                    $mpdf->WriteHTML($html);
                    $html = $this->PdfInd->HTML_REPORT_table_one_tr('Foto');
                    $mpdf->WriteHTML($html);
                    // STAMPA IMMAGINI
                    $mpdf->Ln();
                    $mpdf->WriteHTML("<br><br><br><br><br><br>");
                    if ($md5_image1 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image1, 25, 70, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 100px; font-size: 8pt;'>MD5: $md5_image1</pre>");
                    }
                    if ($md5_image2 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image2, 115, 70, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 450px; font-size: 8pt;'>MD5: $md5_image2</pre>");
                    }
                    if ($md5_image3 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image3, 25, 150, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 100px; font-size: 8pt;'>MD5: $md5_image3</pre>");
                    }
                    if ($md5_image4 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image4, 115, 150, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 450px; font-size: 8pt;'>MD5: $md5_image4</pre>");
                    }
                }


                $ho_id = $row['ho_id'];

                if ($evi_id != $row['evi_id']) {
                    $evi_pathfoto = $row['evi_pathfoto'];
                    $evi_image1 = $row['evi_image1'];
                    $evi_image2 = $row['evi_image2'];
                    $evi_image3 = $row['evi_image3'];
                    if (($evi_image1 != null) && ($evi_image1 != '.') && ($evi_image1 != '..')) {
                        $md5_image1 = md5_file($evi_pathfoto . $evi_image1);
                    } else {
                        $md5_image1 = null;
                    }
                    if (($evi_image2 != null) && ($evi_image2 != '.') && ($evi_image2 != '..')) {
                        $md5_image2 = md5_file($evi_pathfoto . $evi_image2);
                    } else {
                        $md5_image2 = null;
                    }
                    if (($evi_image3 != null) && ($evi_image3 != '.') && ($evi_image3 != '..')) {
                        $md5_image3 = md5_file($evi_pathfoto . $evi_image3);
                    } else {
                        $md5_image3 = null;
                    }
                    // PRINT DETTAGLIO MEDIA/EVIDENCE
                    $mpdf->AddPage();
                    $mpdf->WriteHTML("<br>");
                    $mpdf->WriteHTML($this->PdfInd->HTML_REPORT_page_header_mpdf("Dettaglio Media"));
                    $html = $this->PdfInd->HTML_REPORT_dettaglio_evidence_mpdf($row['ho_etichetta'], $row['evi_etichetta'], $row['evi_tipo'], $row['evi_modello'], $row['evi_seriale'], $row['evi_pwd'], $row['evi_pwd_used'], $row['evi_dimensione'], $row['evi_kbmbgbtb']);
                    $mpdf->WriteHTML($html);
                    $mpdf->WriteHTML("</div>");
                    $html = $this->PdfInd->HTML_REPORT_table_one_tr('Foto');
                    $mpdf->WriteHTML($html);
                    // STAMPA IMMAGINI EVIDENCES
                    // Se evi_tipo è SimCard allora le immagini saranno posizionate ad un'altezza differente rispetto agli evidence di diversa tipologia.
                    if($row['evi_tipo'] == 'SimCard'){
                        if ($md5_image1 != null) {
                            $mpdf->Image($evi_pathfoto . $evi_image1, 25, 128, 70, 0, 'jpg', '', true, true);
                            $mpdf->Ln();
                            $mpdf->WriteHTML("<pre style='position: absolute; left: 105px; font-size: 8pt;'>MD5: $md5_image1</pre>");
                        }
                        if ($md5_image2 != null) {
                            $mpdf->Image($evi_pathfoto . $evi_image2, 115, 128, 70, 0, 'jpg', '', true, true);
                            $mpdf->Ln();
                            $mpdf->WriteHTML("<pre style='position: absolute; left: 450px; font-size: 8pt;'>MD5: $md5_image2</pre>");
                        }
                        if ($md5_image3 != null) {
                            $mpdf->Image($evi_pathfoto . $evi_image3, 25, 208, 70, 0, 'jpg', '', true, true);
                            $mpdf->Ln();
                            $mpdf->WriteHTML("<pre style='position: absolute; left: 105px; font-size: 8pt;'>MD5: $md5_image3</pre>");
                        }
                    }
                    else{
                        if ($md5_image1 != null) {
                            $mpdf->Image($evi_pathfoto . $evi_image1, 25, 115, 70, 0, 'jpg', '', true, true);
                            $mpdf->Ln();
                            $mpdf->WriteHTML("<pre style='position: absolute; left: 105px; font-size: 8pt;'>MD5: $md5_image1</pre>");
                        }
                        if ($md5_image2 != null) {
                            $mpdf->Image($evi_pathfoto . $evi_image2, 115, 115, 70, 0, 'jpg', '', true, true);
                            $mpdf->Ln();
                            $mpdf->WriteHTML("<pre style='position: absolute; left: 450px; font-size: 8pt;'>MD5: $md5_image2</pre>");
                        }
                        if ($md5_image3 != null) {
                            $mpdf->Image($evi_pathfoto . $evi_image3, 25, 195, 70, 0, 'jpg', '', true, true);
                            $mpdf->Ln();
                            $mpdf->WriteHTML("<pre style='position: absolute; left: 105px; font-size: 8pt;'>MD5: $md5_image3</pre>");
                        }
                    }
                }

                $evi_id = $row['evi_id'];

                if ($clo_id != $row['clo_id']) {
                    $mpdf->AddPage();
                    $mpdf->WriteHTML("<br>");
                    $mpdf->WriteHTML($this->PdfInd->HTML_REPORT_page_header_mpdf("Acquisizione"));
                    $html = $this->PdfInd->HTML_REPORT_clone_mpdf($row['evi_etichetta'], $row['clo_tipoacq'], $row['clo_altro_tipo'], $row['clo_stracq'], $row['clo_md5'], $row['clo_sha1'], $row['clo_sha256']);
                    $mpdf->WriteHTML($html);
                    $html = $this->PdfInd->HTML_REPORT_table_one_tr('Log');
                    $mpdf->WriteHTML($html);
                    $logpath = $row['clo_log'];
                    $log = $this->ModelClone->get_log_file($logpath);
                    if($log != 0){
                        $mpdf->WriteHTML("<pre>$log</pre>");
                    }
                    else{
                        $mpdf->WriteText(100, 100, "Log assente.");
                    }
                }

                $clo_id = $row['clo_id'];

            }

            // PRINT DETTAGLIO HOSTS SPECIAL
            foreach ($HostsSpecial as $row) {
                if ($ho_id != $row['ho_id']) {
                    // SE NON E' UN HOST SPECIALE (collection) STAMPO IL DETTAGLIO HOST, QUINDI IN CASO SIA UN HOST SPECIALE NON STAMPA E VADO DIRETTAMENTE A STAMPANRE IL DETTAGLIO MEDIA.
                    $ho_pathfoto = $row['ho_pathfoto'];
                    $ho_image1 = $row['ho_image1'];
                    $ho_image2 = $row['ho_image2'];
                    $ho_image3 = $row['ho_image3'];
                    $ho_image4 = $row['ho_image4'];
                    if (($ho_image1 != null) && ($ho_image1 != '.') && ($ho_image1 != '..')) {
                        $md5_image1 = md5_file($ho_pathfoto . $ho_image1);
                    } else {
                        $md5_image1 = null;
                    }
                    if (($ho_image2 != null) && ($ho_image2 != '.') && ($ho_image2 != '..')) {
                        $md5_image2 = md5_file($ho_pathfoto . $ho_image2);
                    } else {
                        $md5_image2 = null;
                    }
                    if (($ho_image3 != null) && ($ho_image3 != '.') && ($ho_image3 != '..')) {
                        $md5_image3 = md5_file($ho_pathfoto . $ho_image3);
                    } else {
                        $md5_image3 = null;
                    }
                    if (($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')) {
                        $md5_image4 = md5_file($ho_pathfoto . $ho_image4);
                    } else {
                        $md5_image4 = null;
                    }
                    $mpdf->AddPage();
                    $mpdf->WriteHTML("<br>");
                    $mpdf->WriteHTML($this->PdfInd->HTML_REPORT_page_header_mpdf("Dettaglio Host"));
                    $html = $this->PdfInd->HTML_REPORT_dettaglio_host_special_mpdf($row['ho_etichetta'], $row['ho_modello'], $row['ho_seriale'], $row['ho_tipo']);
                    $mpdf->WriteHTML($html);
                    $html = $this->PdfInd->HTML_REPORT_table_one_tr('Foto');
                    $mpdf->WriteHTML($html);
                    // STAMPA IMMAGINI HOST SPECIAL
                    if ($md5_image1 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image1, 25, 70, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 100px; font-size: 8pt;'>MD5: $md5_image1</pre>");
                    }
                    if ($md5_image2 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image2, 115, 70, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 450px; font-size: 8pt;'>MD5: $md5_image2</pre>");
                    }
                    if ($md5_image3 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image3, 25, 150, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 100px; font-size: 8pt;'>MD5: $md5_image3</pre>");
                    }
                    if ($md5_image4 != null) {
                        $mpdf->Image($ho_pathfoto . $ho_image4, 115, 150, 70, 0, 'jpg', '', true, true);
                        $mpdf->Ln();
                        $mpdf->WriteHTML("<pre style='position: absolute; left: 450px; font-size: 8pt;'>MD5: $md5_image4</pre>");
                    }

                }

                $ho_id = $row['ho_id'];

                if ($clo_id != $row['clo_id']) {
                    $mpdf->AddPage();
                    $mpdf->WriteHTML("<br>");
                    $mpdf->WriteHTML($this->PdfInd->HTML_REPORT_page_header_mpdf("Acquisizione"));
                    $html = $this->PdfInd->HTML_REPORT_clone_mpdf($row['ho_etichetta'], $row['clo_tipoacq'], $row['clo_altro_tipo'], $row['clo_stracq'], $row['clo_md5'], $row['clo_sha1'], $row['clo_sha256']);
                    $mpdf->WriteHTML($html);
                    $logpath = $row['clo_log'];
                    $log = file_get_contents($logpath);
                    $html = $this->PdfInd->HTML_REPORT_table_one_tr('Log');
                    $mpdf->WriteHTML($html);
                    $mpdf->WriteHTML("<pre>$log</pre>");
                    //$mpdf->WriteHTML($html);

                }

                $clo_id = $row['clo_id'];
            }

            $mpdf->Output($ind_cognome . " " . $ind_nome . '.pdf', 'I');
        }
        catch (Exception $e)
        {
            echo "ECCEZIONE: $e";
        }
    }
















    
    private function delete_indagato()
    {
        $IdIndagato = $_POST['ind_id'];
        $count_hosts = $this->ModelIndagato->count_hosts_of_indagato($IdIndagato);
        $count_hosts_special = $this->ModelIndagato->count_hosts_special_of_indagato($IdIndagato);
        $count = $count_hosts + $count_hosts_special;
        if($count == 0)
        {
            $this->ModelIndagato->delete_indagato($_POST['ind_id']);
            $this->return_to_caso();
        }
        else if($count > 0)
        {
            echo "<center><b style='color: red'>Impossibile Eliminare l'Indagato siccome contiene ancora $count Host</b></center>";
            $this->return_to_caso();
        }
    }
    


    private function print_dettaglio_host($Info, $ho_id, $evi_id, $clo_id)
    {
        // PAGINA DETTAGLIO HOST
        foreach($Info as $row)
        {
            if($ho_id != $row['ho_id'])
            {
                // SE NON E' UN HOST SPECIALE (collection) STAMPO IL DETTAGLIO HOST, QUINDI IN CASO SIA UN HOST SPECIALE NON STAMPA E VADO DIRETTAMENTE A STAMPANRE IL DETTAGLIO MEDIA.
                $ho_pathfoto = $row['ho_pathfoto'];
                $ho_image1 = $row['ho_image1'];
                $ho_image2 = $row['ho_image2'];
                $ho_image3 = $row['ho_image3'];
                $ho_image4 = $row['ho_image4'];
                //$ho_image4 = $row['ho_image2'];
                if (($ho_image1 != null) && ($ho_image1 != '.') && ($ho_image1 != '..')){$md5_image1 = md5_file($ho_pathfoto . $ho_image1);}else{$md5_image1 = null;}
                if (($ho_image2 != null) && ($ho_image2 != '.') && ($ho_image2 != '..')){$md5_image2 = md5_file($ho_pathfoto . $ho_image2);}else{$md5_image2 = null;}
                if (($ho_image3 != null) && ($ho_image3 != '.') && ($ho_image3 != '..')){$md5_image3 = md5_file($ho_pathfoto . $ho_image3);}else{$md5_image3 = null;}
                if (($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')){$md5_image4 = md5_file($ho_pathfoto . $ho_image4);}else{$md5_image4 = null;}
                //if(($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')){$md5_image4 = md5_file($ho_pathfoto.$ho_image4);}else{$md5_image4 = null;}
                $this->Html->HTML_newpage();
                $this->Html->HTML_br();
                $this->HtmlIndagato->HTML_REPORT_page_header("Dettaglio Host");
                $this->HtmlIndagato->HTML_REPORT_dettaglio_host($row['ho_etichetta'], $row['ho_modello'], $row['ho_seriale'], $row['ho_pwd'], $row['ho_pwd_used'], $row['ho_tipo']);
                // SE E' PRESENTE ALMENO UNA MD5 DI UNA FOTO ALLORA STAMPO IL PEZZO DI REPORT RELATIVO ALLE FOTO
                if(($md5_image1 != null) || ($md5_image2 != null) || ($md5_image3 != null) || ($md5_image4 != null))
                {
                    $this->HtmlIndagato->HTML_REPORT_foto($ho_pathfoto, $ho_image1, $md5_image1, $ho_image2, $md5_image2, $ho_image3, $md5_image3, $ho_image4, $md5_image4);
                }
                    $this->Html->HTML_close_newpage();
            }

        $ho_id = $row['ho_id'];

        if($evi_id != $row['evi_id'])
        {
            $evi_pathfoto = $row['evi_pathfoto'];
            $evi_image1 = $row['evi_image1'];
            $evi_image2 = $row['evi_image2'];
            $evi_image3 = $row['evi_image3'];
            if (($evi_image1 != null) && ($evi_image1 != '.') && ($evi_image1 != '..')){$md5_image1 = md5_file($evi_pathfoto . $evi_image1);}else{$md5_image1 = null;}
            if (($evi_image2 != null) && ($evi_image2 != '.') && ($evi_image2 != '..')){$md5_image2 = md5_file($evi_pathfoto . $evi_image2);}else{$md5_image2 = null;}
            if (($evi_image3 != null) && ($evi_image3 != '.') && ($evi_image3 != '..')){$md5_image3 = md5_file($evi_pathfoto . $evi_image3);}else{$md5_image3 = null;}
            $this->Html->HTML_newpage();
            $this->Html->HTML_br();
            $this->HtmlIndagato->HTML_REPORT_page_header("Dettaglio Media");
            $this->HtmlIndagato->HTML_REPORT_dettaglio_evidence($row['ho_etichetta'], $row['evi_etichetta'], $row['evi_tipo'], $row['evi_modello'], $row['evi_seriale'], $row['evi_pwd'], $row['evi_pwd_used'], $row['evi_dimensione'], $row['evi_kbmbgbtb']);
            $this->Html->HTML_close_newpage();
            // SE E' PRESENTE ALMENO UNA MD5 DI UNA FOTO ALLORA STAMPO IL PEZZO DI REPORT RELATIVO ALLE FOTO
            if(($md5_image1 != null) || ($md5_image2 != null) || ($md5_image3 != null))
            {
                $this->HtmlIndagato->HTML_REPORT_foto($evi_pathfoto, $evi_image1, $md5_image1, $evi_image2, $md5_image2, $evi_image3, $md5_image3, null, null);
            }

        }

        $evi_id = $row['evi_id'];

        if($clo_id != $row['clo_id'])
        {
            $this->Html->HTML_newpage();
            $this->Html->HTML_br();
            $this->HtmlIndagato->HTML_REPORT_page_header("Acquisizione");
            $this->HtmlIndagato->HTML_REPORT_clone($row['evi_etichetta'], $row['clo_tipoacq'], $row['clo_altro_tipo'], $row['clo_stracq'], $row['clo_md5'], $row['clo_sha1'], $row['clo_sha256']);
            $logpath = $row['clo_log'];
            @$log = file_get_contents($logpath);
            $this->HtmlIndagato->HTML_REPORT_log($log);
            $this->Html->HTML_close_newpage();
        }

        $clo_id = $row['clo_id'];

        }
    }




    private function print_dettaglio_host_special($HostsSpecial, $ho_id, $clo_id)
    {
        foreach($HostsSpecial as $row)
        {
            if($ho_id != $row['ho_id'])
        {
            // SE NON E' UN HOST SPECIALE (collection) STAMPO IL DETTAGLIO HOST, QUINDI IN CASO SIA UN HOST SPECIALE NON STAMPA E VADO DIRETTAMENTE A STAMPANRE IL DETTAGLIO MEDIA.
            $ho_pathfoto = $row['ho_pathfoto'];
            $ho_image1 = $row['ho_image1'];
            $ho_image2 = $row['ho_image2'];
            $ho_image3 = $row['ho_image3'];
            $ho_image4 = $row['ho_image4'];
            //$ho_image4 = $row['ho_image2'];
            if (($ho_image1 != null) && ($ho_image1 != '.') && ($ho_image1 != '..')){$md5_image1 = md5_file($ho_pathfoto . $ho_image1);}else{$md5_image1 = null;}
            if (($ho_image2 != null) && ($ho_image2 != '.') && ($ho_image2 != '..')){$md5_image2 = md5_file($ho_pathfoto . $ho_image2);}else{$md5_image2 = null;}
            if (($ho_image3 != null) && ($ho_image3 != '.') && ($ho_image3 != '..')){$md5_image3 = md5_file($ho_pathfoto . $ho_image3);}else{$md5_image3 = null;}
            if (($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')){$md5_image4 = md5_file($ho_pathfoto . $ho_image4);}else{$md5_image4 = null;}
            //if(($ho_image4 != null) && ($ho_image4 != '.') && ($ho_image4 != '..')){$md5_image4 = md5_file($ho_pathfoto.$ho_image4);}else{$md5_image4 = null;}
            $this->Html->HTML_newpage();
            $this->Html->HTML_br();
            $this->HtmlIndagato->HTML_REPORT_page_header("Dettaglio Host");
            $this->HtmlIndagato->HTML_REPORT_dettaglio_host_special($row['ho_etichetta'], $row['ho_modello'], $row['ho_seriale'], $row['ho_tipo']);
            // SE E' PRESENTE ALMENO UNA MD5 DI UNA FOTO ALLORA STAMPO IL PEZZO DI REPORT RELATIVO ALLE FOTO
            if(($md5_image1 != null) || ($md5_image2 != null) || ($md5_image3 != null) || ($md5_image4 != null))
            {
                $this->HtmlIndagato->HTML_REPORT_foto($ho_pathfoto, $ho_image1, $md5_image1, $ho_image2, $md5_image2, $ho_image3, $md5_image3, $ho_image4, $md5_image4);
            }
                $this->Html->HTML_close_newpage();
        }

        $ho_id = $row['ho_id'];

        if($clo_id != $row['clo_id'])
        {
            $this->Html->HTML_newpage();
            $this->Html->HTML_br();
            $this->HtmlIndagato->HTML_REPORT_page_header("Acquisizione");
            $this->HtmlIndagato->HTML_REPORT_clone($row['ho_etichetta'], $row['clo_tipoacq'], $row['clo_altro_tipo'], $row['clo_stracq'], $row['clo_md5'], $row['clo_sha1'], $row['clo_sha256']);
            $logpath = $row['clo_log'];
            $log = file_get_contents($logpath);
            $this->HtmlIndagato->HTML_REPORT_log($log);
            $this->Html->HTML_close_newpage();
        }

    $clo_id = $row['clo_id'];
        }
    }

    private function set_sessione($idInd){
        $this->ModelIndagato->select_one_indagato($idInd);
        $ex_id_ca = $this->ModelIndagato->get_ex_id_ca();
        $this->ModelCaso->select_one_caso($ex_id_ca);
        $ex_id_pm = $this->ModelCaso->get_ex_id_pm();
        $this->ModelPm->select_single_pm($ex_id_pm);
        $ex_id_cli = $this->ModelPm->get_ex_id_cli();
        $this->ModelProcura->select_single_procura($ex_id_cli);
        $_SESSION['post_ind_id'] = $idInd;
        $_SESSION['post_ca_id'] = $ex_id_ca;
        $_SESSION['post_pm_id'] = $ex_id_pm;
        $_SESSION['post_cli_id'] = $ex_id_cli;
    }

    // return_to_caso : funzione che stampa la lista degli indagati apparteneneti al caso corrente.
    private function return_to_caso()
    {
        $IdCa = $_SESSION['post_ca_id'];
        $this->ModelCaso->select_one_caso($IdCa);
        $NumCaso = $this->ModelCaso->get_ca_num();
        //Seleziono il PM relativo a questo caso e prelevo il nome pm mappato all'interno della classe
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $NomePm = $this->ModelPm->get_pm_cognome() . " " . $this->ModelPm->get_pm_nome();
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        $Indagati = $this->ModelIndagato->select_indagati_of_caso($_SESSION['post_ca_id']);
        $this->Html->HTML_header();
        $this->HtmlIndagato->HTML_indagati_of_caso($Indagati, $NumCaso, $NomePm, $NomeProcura);
        $this->Html->HTML_footer();
    }




    public function return_to_indagato()
    {
        $IdInd = $_SESSION['post_ind_id'];
        $this->ModelIndagato->select_one_indagato($IdInd);
        $NomeIndagato = $this->ModelIndagato->get_ind_cognome() . " " . $this->ModelIndagato->get_ind_nome();
        $this->ModelCaso->select_one_caso($this->ModelIndagato->get_ex_id_ca());
        $NumCaso = $this->ModelCaso->get_ca_num();
        //Seleziono il PM relativo a questo caso e Prelevo il nome e cognome del pm mappato nel modello ModelPm
        $this->ModelPm->select_single_pm($this->ModelCaso->get_ex_id_pm());
        $NomePm = $this->ModelPm->get_pm_cognome() . " " . $this->ModelPm->get_pm_nome();
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        $NomeProcura = $this->ModelProcura->get_cli_nome();

        $Hosts = $this->ModelHost->select_hosts_of_indagato($IdInd);
        $HostsSpecial = $this->ModelHostSpecial->select_hosts_special_of_indagato($IdInd);

        $TipoHost = $this->ModelHost->select_ho_tipo();
        $TipoHostSpecial = $this->ModelHostSpecial->select_hos_tipo();

        $this->Html->HTML_header();
        $this->HtmlHostSpecial->HTML_hosts_of_indagato($Hosts, $HostsSpecial, $TipoHost, $TipoHostSpecial, $NomeProcura, $NumCaso, $NomePm, $NomeIndagato);
        $this->Html->HTML_footer();
    }



}
