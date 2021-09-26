<?php
/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Class ControllerCliente
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative ai clienti (procure, tribunali, ctp)
 */
class ControllerCliente
{
    /**
     * ControllerCliente constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->HtmlPainter = new HtmlPainter();
        $this->HtmlProcura = new HtmlProcura();
        $this->HtmlTribunale = new HtmlTribunale();
        $this->HtmlCtp = new HtmlCtp();
        $this->HtmlPm = new HtmlPm();
        $this->ControllerCaso = new ControllerCaso();
        $this->ModelProcura = new ModelProcura();
        $this->ModelCliente = new ModelCliente();
        $this->ModelPm = new ModelPm();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
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
            case 'menu_procure':
                $this->menu_procure();
                break;

            case 'menu_tribunali':
                $this->menu_tribunali();
                break;

            case 'menu_ctp':
                $this->menu_ctp();
                break;

            case 'view_procure':
                $this->view_procure();
                break;

            case 'view_tribunali':
                $this->view_tribunali();
                break;

            case 'return_to_tribunali':
                $this->view_tribunali();
                break;

            case 'return_to_ctp':
                $this->view_all_ctp();
                break;

            // Seleziona le procure
            case 'ricerca_pro':
                $this->ricerca_pro();
                break;

            case 'view_procura':
                $this->view_procura();
                break;

            case 'return_to_procura':
                $this->return_to_procura();
                break;

            case 'view_tribunale':
                $this->view_tribunale();
                break;

            case 'return_to_tribunale':
                $this->return_to_tribunale();
                break;

            case 'view_ctp':
                $this->view_ctp();
                break;

            case 'add_procura':
                $this->add_procura();
                break;

            case 'add_tribunale':
                $this->add_tribunale();
                break;

            case 'add_ctp':
                $this->add_ctp();
                break;

            case 'insert_procura':
                $this->insert_procura();
                break;

            case 'insert_tribunale':
                $this->insert_tribunale();
                break;

            case 'insert_ctp':
                $this->insert_ctp();
                break;

            case 'edit_procura':
                $this->edit_procura();
                break;

            case 'edit_tribunale':
                $this->edit_tribunale();
                break;

            case 'edit_ctp':
                $this->edit_ctp();
                break;

            case "update_procura":
                $this->update_procura();
                break;

            case "update_tribunale":
                $this->update_tribunale();
                break;

            case "update_ctp":
                $this->update_ctp();
                break;

            case 'delete_procura':
                $this->delete_procura();
            break;

            case 'delete_tribunale':
                $this->delete_tribunale();
            break;

            case 'delete_ctp':
                $this->delete_ctp();
            break;
        }
    }





    /*_________________*/
    /*FUNZIONI PRIVATE*/
    /*---------------*/
    /**
     * La funzione seleziona le procure e stampa a video il menu relativo ad esse.
     */
    private function menu_procure()
    {
        // SETTO P NELLA TIPOLOGIA DI CLIENTE NELLA SESSIONE (serve nella navigazione tramite menu per restare nella sezione delle Procure)
        $_SESSION['cli_type'] = 'P';
        // SELEZIONO I DATI DA VISUALIZZARE NEL MENU
        $datiProcure = $this->ModelProcura->select_procure();
        $datiPm = $this->ModelPm->select_all_pm();
        $datiCasi = $this->ModelCaso->select_all_casi();
        $datiIndagati = $this->ModelIndagato->select_all_indagati();
        //VISUALIZZO IL MENU
        $this->HtmlProcura->HTML_menu_procure($datiProcure, $datiPm, $datiCasi, $datiIndagati);
    }


    /**
     * La funzione seleziona i tribunali e stampa il menu relativo ad essi.
     */
    private function menu_tribunali()
    {
        // SETTO T NELLA TIPOLOGIA DI CLIENTE NELLA SESSIONE (serve nella navigazione tramite menu per restare nella sezione dei Tribunali)
        $_SESSION['cli_type'] = 'T';
        // SELEZIONO I DATI DA VISUALIZZARE NEL MENU
        $datiTribunali = $this->ModelCliente->select_tribunali();
        $datiAvvocati = $this->ModelPm->select_all_pm();
        $datiCasi = $this->ModelCaso->select_all_casi();
        $datiIndagati = $this->ModelIndagato->select_all_indagati();
        //VISUALIZZO IL MENU
        $this->HtmlTribunale->HTML_header();
        $this->HtmlTribunale->HTML_menu_tribunali($datiTribunali, $datiAvvocati, $datiCasi, $datiIndagati);
        $this->HtmlTribunale->HTML_footer();
    }


    /**
     * La funzione seleziona le ctp e stampa il menu relativo ad esse
     */
    private function menu_ctp()
    {
        // SETTO C NELLA TIPOLOGIA DI CLIENTE NELLA SESSIONE (serve nella navigazione tramite menu per restare nella sezione dei Tribunali)
        $_SESSION['cli_type'] = 'C';
        // SELEZIONO I DATI DA VISUALIZZARE NEL MENU
        $datiCtp = $this->ModelCliente->select_ctp();
        $datiAvvocati = $this->ModelPm->select_all_pm();
        $datiCasi = $this->ModelCaso->select_all_casi();
        $datiIndagati = $this->ModelIndagato->select_all_indagati();
        //VISUALIZZO IL MENU
        $this->HtmlCtp->HTML_header();
        $this->HtmlCtp->HTML_menu_ctp($datiCtp, $datiAvvocati, $datiCasi, $datiIndagati);
        $this->HtmlCtp->HTML_footer();
    }


    /**
     * Seleziona tutte le procure e stampa a video la lista.
     */
    private function view_procure()
    {
        $Procure = $this->ModelProcura->select_procure();
        $this->HtmlPainter->HTML_header();
        $this->HtmlProcura->HTML_procure($Procure);
        $this->HtmlPainter->HTML_footer();
    }


    /**
     * Seleziona i PM di una procura e ne stampa la lista a video
     */
    private function return_to_procura()
    {
        $IdPro = $_SESSION['post_cli_id'];
        $this->ModelProcura->select_single_procura($IdPro);
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        $res = $this->ModelPm->select_pm_of_cliente($IdPro);
        $this->HtmlPainter->HTML_header();
        $this->HtmlPm->HTML_pm_of_cliente($res, $NomeProcura);
        $this->HtmlPainter->HTML_footer();
    }


    /**
     * Seleziona i tribunali e ne visualizza la lista.
     */
    private function view_tribunali()
    {
        $Tribunali = $this->ModelCliente->select_tribunali();
        $this->HtmlPainter->HTML_header();
        $this->HtmlTribunale->HTML_tribunali($Tribunali);
        $this->HtmlPainter->HTML_footer();
    }


    /**
     * Visualizza le informazioni relative al tribunale selezionato
     */
    private function view_tribunale()
    {
        $IdCli = $_POST['cli_id'];
        $_SESSION['post_cli_id'] = $IdCli;
        $this->ModelCliente->select_single_tribunale($IdCli);
        $NomeTrib = $this->ModelCliente->get_cli_nome();
        $res = $this->ModelPm->select_pm_of_cliente($IdCli);
        $this->HtmlPainter->HTML_header();
        $this->HtmlTribunale->HTML_view_tribunale($res, $NomeTrib);
        $this->HtmlPainter->HTML_footer();
    }


    /**
     * Seleziona
     */
    private function return_to_tribunale()
    {
        $IdCli = $_SESSION['post_cli_id'];
        $this->ModelCliente->select_single_tribunale($IdCli);
        $NomeTribunale = $this->ModelCliente->get_cli_nome();
        $res = $this->ModelPm->select_pm_of_cliente($IdCli);
        $this->HtmlPainter->HTML_header();
        $this->HtmlTribunale->HTML_view_tribunale($res, $NomeTribunale);
        $this->HtmlPainter->HTML_footer();
    }



    private function view_all_ctp()
    {
        $Ctp = $this->ModelCliente->select_ctp();
        $this->HtmlPainter->HTML_header();
        $this->HtmlCtp->HTML_ctp($Ctp);
        $this->HtmlPainter->HTML_footer();
    }



    private function view_ctp()
    {
        $IdCli = $_POST['cli_id'];
        $_SESSION['post_cli_id'] = $IdCli;
        $this->ModelCliente->select_single_ctp($IdCli);
        $NomeCli = $this->ModelCliente->get_cli_nome();
        $res = $this->ModelPm->select_pm_of_cliente($IdCli);
        $this->HtmlPainter->HTML_header();
        $this->HtmlPm->HTML_pm_of_cliente($res, $NomeCli);
        $this->HtmlPainter->HTML_footer();
    }



    private function add_procura()
    {
        $this->HtmlPainter->HTML_header();
        $this->HtmlProcura->HTML_add_procura();
    }



    private function add_tribunale()
    {
        $this->HtmlPainter->HTML_header();
        $this->HtmlTribunale->HTML_add_tribunale();
    }



    private function add_ctp()
    {
        $this->HtmlPainter->HTML_header();
        $this->HtmlCtp->HTML_add_ctp();
    }



    private function insert_procura()
    {
        $this->ModelProcura->insert_procura($_POST['cli_nome'], $_POST['cli_citta']);
        $this->view_procure();
    }



    private function insert_tribunale()
    {
        $this->ModelCliente->insert_tribunale($_POST['cli_nome'], $_POST['cli_citta']);
        $this->view_tribunali();
    }



    private function insert_ctp()
    {
        $this->ModelCliente->insert_ctp($_POST['cli_nome'], $_POST['cli_citta']);
        $this->view_all_ctp();
    }



    private function edit_procura()
    {
        $this->ModelProcura->select_single_procura($_POST['cli_id']);
        $id = $this->ModelProcura->get_cli_id();
        $nome = $this->ModelProcura->get_cli_nome();
        $citta = $this->ModelProcura->get_cli_citta();
        $this->HtmlPainter->HTML_header();
        $this->HtmlProcura->HTML_edit_procura($id, $nome, $citta);
        $this->HtmlPainter->HTML_footer();
    }



    private function edit_tribunale()
    {
        $this->ModelCliente->select_single_tribunale($_POST['cli_id']);
        $id = $this->ModelCliente->get_cli_id();
        $nome = $this->ModelCliente->get_cli_nome();
        $citta = $this->ModelCliente->get_cli_citta();
        $this->HtmlPainter->HTML_header();
        $this->HtmlTribunale->HTML_edit_tribunale($id, $nome, $citta);
        $this->HtmlPainter->HTML_footer();
    }



    private function edit_ctp()
    {
        $this->ModelCliente->select_single_ctp($_POST['cli_id']);
        $id = $this->ModelCliente->get_cli_id();
        $nome = $this->ModelCliente->get_cli_nome();
        $citta = $this->ModelCliente->get_cli_citta();
        $this->HtmlPainter->HTML_header();
        $this->HtmlCtp->HTML_edit_ctp($id, $nome, $citta);
        $this->HtmlPainter->HTML_footer();
    }



    private function update_procura()
    {
        $id = $_POST['cli_id'];
        $nome = $_POST['cli_nome'];
        $citta = $_POST['cli_citta'];
        $this->ModelProcura->update_procura($id, $nome, $citta);
        $this->view_procure();
    }



    private function update_tribunale()
    {
        $id = $_POST['cli_id'];
        $nome = $_POST['cli_nome'];
        $citta = $_POST['cli_citta'];
        $this->ModelCliente->update_tribunale($id, $nome, $citta);
        $this->view_tribunali();
    }



    private function update_ctp()
    {
        $id = $_POST['cli_id'];
        $nome = $_POST['cli_nome'];
        $citta = $_POST['cli_citta'];
        $this->ModelCliente->update_ctp($id, $nome, $citta);
        $this->view_all_ctp();
    }



    private function delete_procura()
    {
        // Valorizzo variabile che occorre ai controlli
        $IdPro = $_POST['cli_id'];
        // Verifico che la procura non abbia PM
        $count = $this->ModelPm->count_pm_of_cliente($IdPro);
        if($count == 0)
        {
            $this->ModelGeneric->remove_dir("archivioimg/cli_" . $IdPro);
            $this->ModelProcura->delete_procura($IdPro);
            $this->view_procure();
        }
        else if($count > 0)
        {
            $this->HtmlPainter->HTML_header();
            echo "<center><b style='color: red'>Impossibile Eliminare la Procura siccome contiene ancora $count Pm</b></center>";
            $ArrProcure = $this->ModelProcura->select_procure();
            $this->HtmlProcura->HTML_procure($ArrProcure);
            $this->HtmlPainter->HTML_footer();
        }
    }



    private function delete_tribunale()
    {
        // Valorizzo variabile che occorre ai controlli
        $IdTrib = $_POST['cli_id'];
        // Verifico che il Tribunale non abbia PM
        $count = $this->ModelPm->count_pm_of_cliente($IdTrib);
        if($count == 0)
        {
            $this->ModelGeneric->remove_dir("archivioimg/cli_" . $IdTrib);
            $this->ModelCliente->delete_tribunale($IdTrib);
            $this->view_tribunali();
        }
        else if($count > 0)
        {
            $this->HtmlPainter->HTML_header();
            echo "<center><b style='color: red'>Impossibile Eliminare la Procura siccome contiene ancora $count Pm</b></center>";
            $this->view_tribunali();
        }
    }



    private function delete_ctp()
    {
        // Valorizzo variabile che occorre ai controlli
        $IdCli = $_POST['cli_id'];
        // Verifico che il Tribunale non abbia PM
        $count = $this->ModelPm->count_pm_of_cliente($IdCli);
        if($count == 0)
        {
            $this->ModelGeneric->remove_dir("archivioimg/cli_" . $IdCli);
            $this->ModelCliente->delete_ctp($IdCli);
            $this->view_all_ctp();
        }
        else if($count > 0)
        {
            $this->HtmlPainter->HTML_header();
            echo "<center><b style='color: red'>Impossibile Eliminare la Procura siccome contiene ancora $count Pm</b></center>";
            $this->view_all_ctp();
        }
    }



    private function ricerca_pro()
    {
        $Procure = $this->ModelProcura->select_procure_by_city($_POST['ric']);
        if(empty($Procure))
        {
            $this->HtmlPainter->HTML_header();
            $this->HtmlProcura->HTML_ricerca_procura_not_found();
        }
        else{
            $this->HtmlPainter->HTML_header();
            $this->HtmlProcura->HTML_procure_by_ricerca($Procure);
        }

        $this->HtmlPainter->HTML_footer();
    }



    private function view_procura()
    {
        $IdCli = $_POST['cli_id'];
        $_SESSION['post_cli_id'] = $IdCli;
        $this->ModelProcura->select_single_procura($IdCli);
        $NomeProcura = $this->ModelProcura->get_cli_nome();
        $res = $this->ModelPm->select_pm_of_cliente($IdCli);
        $this->HtmlPainter->HTML_header();
        $this->HtmlPm->HTML_pm_of_cliente($res, $NomeProcura);
        $this->HtmlPainter->HTML_footer();
    }
}











