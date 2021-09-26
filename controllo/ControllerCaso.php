<?php

/**
 * Class ControllerCaso
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative ai casi (dossier).
 */
class ControllerCaso
{


    /**
     * ControllerCaso constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->Html = new HtmlPainter();
        $this->HtmlCaso = new HtmlCaso();
        $this->HtmlIndagato = new HtmlIndagato();
        $this->ModelProcura = new ModelProcura();
        $this->ModelPm = new ModelPm();
        $this->ModelCliente = new ModelCliente();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
        $this->ModelHost = new ModelHost();
        $this->ModelHostSpecial = new ModelHostSpecial();
        $this->ModelLavorazione= new ModelLavorazione();
    }


    /**
     * @param $comando
     * Questa funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando)
        {
            case "view_caso":
                $this->view_caso();
                break;

            case "return_cases_of_pm":
                if($_SESSION['cli_type'] == 'C') {
                    $this->view_cases_of_ctp();
                }
                if($_SESSION['cli_type'] == 'P') {
                    $this->return_cases_of_pm();
                }
                if($_SESSION['cli_type'] == 'T') {
                    $this->return_cases_of_pm();
                }
                break;

            case "insert_caso":
                $this->insert_caso();
                break;

            case "update_caso":
                $this->update_caso();
                break;

            case "edit_caso":
                $this->edit_caso();
                break;

            case "page_add_caso":
                $this->page_add_caso();
                break;

            case "delete_caso":
                $this->delete_caso();
            break;

            case "ricerca_caso":
                $this->ricerca_caso();
                break;

            case "copertina":
                $this->copertina();
                break;

            case "copertinaCtp":
                echo "copertina CTP";
                break;

            case "infocaso":
                $this->infocaso();
                break;
        }

    }


    /**
     * @param $IdCa
     * set_sessione serve appunto a settare all'interno del file di sessione l'ID del caso selezionato, l'ID del PM a cui
     * appartiene il caso e l'ID del cliente a cui appartiene il PM.
     * Questo sia per stampare il "path" in cui ci troviamo sia perché così è possibile gestire la navigazione nel gestionale.
     * Ad esempio se dal menù principale seleziono un caso e poi dalla pagina di visualizzazione del caso clicco il tasto
     * indietro, allora andrà nella pagina di visualizzazione del PM a cui appartiene il caso precedentemente selezionato.
     */
    private function set_sessione ($IdCa)
    {
        $_SESSION['post_ca_id'] = $IdCa;
        $this->ModelCaso->select_one_caso($IdCa);
        $ex_id_pm = $this->ModelCaso->get_ex_id_pm();
        $this->ModelPm->select_single_pm($ex_id_pm);
        $ex_id_cli = $this->ModelPm->get_ex_id_cli();
        $this->ModelProcura->select_single_procura($ex_id_cli);
        $IdPro = $this->ModelProcura->get_cli_id();
        $_SESSION['post_pm_id'] = $ex_id_pm;
        $_SESSION['post_cli_id'] = $IdPro;
    }


    /**
     * La funzione serve a contare quanti evidence sono presenti in un caso. Si è dimostrata utile quando vi sono stati casi con molti evidence per conoscerne rapidamente il numero.
     */
    private function infocaso(){
        $ca_id = $_POST['ca_id'];
        $TotEvi = $this->ModelCaso->count_all_evidences_of_case($ca_id);
        echo "Totale degli evidence del caso = <b>$TotEvi</b><br><br>";
        $EviHost = $this->ModelCaso->check_cloni_host($ca_id);
        $EviHostSP = $this->ModelCaso->check_cloni_hostSP($ca_id);

        if($EviHost != 0) {
            foreach ($EviHost as $row) {
                if ($row['clo_id'] == null) {
                    echo "Manca il clone dell'evidence " . $row['ind_cognome'] . " " . $row['ind_nome'] . "/" . $row['ho_etichetta'] . "/ <b>" . $row['evi_etichetta'] . "</b><br>";
                }
            }
        }

        if($EviHostSP != 0)
        {
            foreach ($EviHostSP as $row){
                if($row['clo_id'] == null){
                    echo "Manca il clone dell'Host Special " .  $row['ind_cognome'] . " " . $row['ind_nome'] . "/ <b>" . $row['ho_etichetta'] . "</b><br>";
                }
            }
        }

        /*echo "<pre>";
        print_r($EviHost);
        echo "</pre>";*/


    }


    /**
     * La funzione stampa a video le informazioni del caso selezionato.
     * Visualizza quindi la lista degli indagati presenti nel caso.
     */
    private function view_caso()
    {
        $IdCa = $_POST['ca_id'];
        $this->set_sessione($IdCa);
        $this->ModelCaso->select_one_caso($_SESSION['post_ca_id']);
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


    /**
     * Visualizza la lista dei casi appartenenti ad un PM.
     */
    private function return_cases_of_pm()
    {
        $IdPm = $_SESSION['post_pm_id'];
        $this->ModelPm->select_single_pm($IdPm);
        $NomePm = $this->ModelPm->get_pm_cognome() ." " . $this->ModelPm->get_pm_nome();
        $this->ModelProcura->select_single_procura($this->ModelPm->get_ex_id_cli());
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        $res = $this->ModelCaso->select_casi_of_pm($_SESSION["post_pm_id"]);
        $this->Html->HTML_header();
        $this->HtmlCaso->HTML_cases_of_pm($NomeProcura, $NomePm, $res);
        $this->Html->HTML_footer();
    }




    /**
     * Inserisce nel DB le informazioni di un nuovo caso.
     */
    private function insert_caso()
    {
        $this->ModelCaso->insert_caso($_POST['ca_num'], $_POST['ca_inc'], $_POST['ca_tipo'], $_SESSION['post_pm_id'], $_POST['ca_dss']);
        $this->return_cases_of_pm();
    }


    /**
     * Aggiorna le informazioni sul DB di un caso che stiamo editando.
     */
    private function update_caso()
    {
        $id = $_POST['ca_id'];
        $num = $_POST['ca_num'];
        $inc = $_POST['ca_inc'];
        $tipo = $_POST['ca_tipo'];
        $dss = $_POST['ca_dss'];
        $this->ModelCaso->update_caso($id, $num, $inc, $tipo, $dss);
        $this->return_cases_of_pm();
    }


    /**
     * Elimina dal DB un caso.
     */
    private function delete_caso()
    {
        $IdCli = $_SESSION['post_cli_id'];
        $IdPm = $_SESSION['post_pm_id'];
        $IdCaso = $_POST['ca_id'];
        $count = $this->ModelCaso->count_indagati_of_caso($IdCaso);
        if($count == 0)
        {
            $this->ModelCaso->delete_caso($_POST['ca_id']);
            $this->return_cases_of_pm();

        }
        else if($count > 0)
        {
            $ArrCasi = $this->ModelCaso->select_casi_of_pm($IdPm);
            $this->ModelProcura->select_single_procura($IdCli);
            $this->ModelPm->select_single_pm($IdPm);
            $NomeProcura = $this->ModelProcura->get_cli_nome();
            $NomePm = $this->ModelPm->get_pm_nome() . "" . $this->ModelPm->get_pm_cognome();
            $this->Html->HTML_header();
            echo "<div style='text-align: center'><b style='color: red'>Impossibile Eliminare il Dossier siccome contiene ancora $count Indagati/o</b></div>";
            $this->HtmlCaso->HTML_cases_of_pm($NomeProcura, $NomePm, $ArrCasi);
            $this->Html->HTML_footer();
        }
    }


    /**
     * Stampa a video la pagina per editare/modificare le informazioni di un caso
     */
    private function edit_caso()
    {
        $this->ModelCaso->select_one_caso($_POST['ca_id']);
        $id = $this->ModelCaso->get_ca_id();
        $num = $this->ModelCaso->get_ca_num();
        $inc = $this->ModelCaso->get_ca_inc();
        $tipo = $this->ModelCaso->get_ca_tipo();
        $dss = $this->ModelCaso->get_ca_dss();
        $this->Html->HTML_header();
        $this->HtmlCaso->HTML_edit_caso($id, $num, $inc, $tipo, $dss);
        $this->Html->HTML_footer();
    }


    /**
     * Stampa a video la pagina per aggiungere un nuovo caso.
     */
    private function page_add_caso()
    {
            $this->Html->HTML_header();
            $this->HtmlCaso->HTML_add_caso();
            $this->Html->HTML_footer();        
    }


    /**
     * La funzione ricerca un caso a seconda del valore dato nella pagina di ricerca e successivamente stampa a video i casi che corrispondono al criterio.
     */
    private function ricerca_caso()
    {
        $CasiArr = $this->ModelCaso->select_caso_by_num($_POST['ric']);
        $this->Html->HTML_header();
        if(empty($CasiArr)){
            $this->HtmlCaso->HTML_ricerca_caso_not_found();
        }
        else{
        $this->HtmlCaso->HTML_casi_by_ricerca($CasiArr);
        }

        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa seleziona dal DB e stampa a video i casi appartenenti ad una CTP.
     */
    private function view_cases_of_ctp()
    {
        $IdPm = $_SESSION['post_pm_id'];
        $this->ModelPm->select_single_pm($IdPm);
        $NomePm = $this->ModelPm->get_pm_cognome() ." " . $this->ModelPm->get_pm_nome();
        $this->ModelCliente->select_single_ctp($this->ModelPm->get_ex_id_cli());
        $NomeCtp = $this->ModelCliente->get_cli_nome();
        $res = $this->ModelCaso->select_casi_of_pm($_SESSION["post_pm_id"]);
        $this->Html->HTML_header();
        $this->HtmlCaso->HTML_cases_of_ctp($NomeCtp, $NomePm, $res);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione genera la copertina della documentazione tecnica relativa al caso.
     */
    private function copertina()
        // GENERA LA COPERTINA DEL CASO
    {
        // SELEZIONE DEL CASO TRAMITE ID
        $this->ModelCaso->select_one_caso($_POST['ca_id']);
        // COPIA IN VARIABILE DELL'ID DEL CASO IN QUESTIONE
        $IdCaso = $this->ModelCaso->get_ca_id();
        // SELEZIONE DELLE INFORMAZIONI UTILI (JOIN) PER IL REPORT DEI REPERTI DELL'INDAGATO IN QUESTIONE
        $arr = $this->ModelCaso->select_info_for_copertina($IdCaso);

            // IMPOSTO INFORMAZIONI IN VARIABILI DA PASSARE ALLE FUNZIONI DI STAMPA A VIDEO
            foreach($arr as $row){
                $ca_num = $row['ca_num'];
                $ca_inc = $row['ca_inc'];
                $ca_tipo = $row['ca_tipo'];
                $pm_titolo = $row['pm_titolo'];
                $pm_cognome = $row['pm_cognome'];
                $pm_nome = $row['pm_nome'];
                $cli_nome = $row['cli_nome'];
                break;
            }

            // SELEZIONO INFORMAZINI PER IL FOOTER
            $arr = $this->ModelCaso->select_azienda_for_copertina();
            foreach($arr as $row){
                    $rsoc = $row['rsoc'];
                    $ctu = $row['ctu'];
                    $indi = $row['indi'];
                    $cap = $row['cap'];
                    $citta = $row['citta'];
                    $tele = $row['tele'];
                    $cell = $row['cell'];
                    $fax = $row['fax'];
                    $mail = $row['mail'];
                    $piva = $row['piva'];
                    $rea = $row['rea'];
                break;
            }

            if(!empty($rsoc))
            {
            // GENERAZIONE COPERTINA DEL DIM
            $this->HtmlCaso->HTML_REPORT_header_copertina($ca_num);
            $this->HtmlCaso->HTML_REPORT_copertinaDIM($ca_num, $ca_inc, $ca_tipo, $cli_nome, $pm_titolo, $pm_nome, $pm_cognome, $rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea);
            }
            else{
                $this->Html->HTML_header();
                $this->Html->HTML_alert_message("Devi prima aggiungere un'azienda da impostare come attiva.<br>Recati nel menù di amministrazione/azienda per aggiungerne una.");
                $this->Html->HTML_footer();
            }
    }
}
