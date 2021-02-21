<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative ai PM
 */


class ControllerPm
{


    /**
     * ControllerPm constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->HtmlPm = new HtmlPm();
        $this->HtmlCaso = new HtmlCaso();
        $this->Html = new HtmlPainter();
        $this->ModelCliente = new ModelCliente();
        $this->ModelPm = new ModelPm();
        $this->ModelCaso = new ModelCaso();
    }

    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando)
        {
            // Visualizza i pm di una procura
            case 'view_pm':
                $this->view_pm();
                break;

            case 'ricerca_pm':
                $this->ricerca_pm();
                break;

            case 'page_add_pm':
                $this->page_add_pm();
                break;

            case 'insert_pm_of_cliente':
                $this->insert_pm_of_cliente();
            break;

            case 'edit_pm':
                $this->edit_pm();
                break;

            case "pm_update":
                $this->pm_update();
                break;

            case "delete_pm":
               $this->delete_pm(); 
            break;


        }

    }


    /**
     * @param $IdPm
     * Setta nel file di sessione l'id del PM appena visualizzato.
     */
    private function set_sessione($IdPm)
    {
        $this->ModelPm->select_single_pm($IdPm);
        $IdPro = $this->ModelPm->get_ex_id_cli();
        $_SESSION['post_cli_id'] = $IdPro;
        $_SESSION['post_pm_id'] = $IdPm;
    }


    /**
     * La funzione visualizza la lista dei casi associati ad un PM.
     */
    private function view_pm()
    {
        $IdPm = $_POST['pm_id'];
        $this->set_sessione($IdPm);
        $this->ModelPm->select_single_pm($IdPm);
        $NomePm = $this->ModelPm->get_pm_cognome() ." " . $this->ModelPm->get_pm_nome();
        $this->ModelCliente->select_single_procura($this->ModelPm->get_ex_id_cli());
        $NomeProcura = $this->ModelCliente->get_cli_nome();
        $res = $this->ModelCaso->select_casi_of_pm($_SESSION["post_pm_id"]);
        $this->Html->HTML_header();
        $this->HtmlCaso->HTML_cases_of_pm($NomeProcura, $NomePm, $res);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione ricerca un pm per cognome.
     */
    private function ricerca_pm()
    {
        $Pm = $this->ModelPm->select_pm_by_cognome($_POST['ric']);
        $this->Html->HTML_header();
        if(empty($Pm))
        {
            $this->HtmlPm->HTML_ricerca_pm_not_found();
        }
        else
        {
            $this->HtmlPm->HTML_pm($Pm);
        }
        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa a video la pagina che permette di aggiungere un nuovo PM.
     */
    private function page_add_pm()
    {
        if(isset($_POST['cli_id'])){
            $_SESSION['post_cli_id'] = $_POST['cli_id'];
        }
        //$lista = $this->ModelCliente->select_procure();
        $this->Html->HTML_header();
        $this->HtmlPm->HTML_add_pm_of_cliente(null);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa a video la pagina che permette di editare un PM.
     */
    private function edit_pm()
    {
        $this->ModelPm->select_single_pm($_POST['pm_id']);
        $id = $this->ModelPm->get_pm_id();
        $tit = $this->ModelPm->get_pm_titolo();
        $nome = $this->ModelPm->get_pm_nome();
        $cognome = $this->ModelPm->get_pm_cognome();
        $this->Html->HTML_header();
        $this->HtmlPm->HTML_edit_pm($id, $tit, $nome, $cognome);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione esegue l'update delle info di un PM.
     */
    private function pm_update()
    {
        $id = $_POST['pm_id'];
        $titolo = $_POST['pm_titolo'];
        $nome = $_POST['pm_nome'];
        $cognome = $_POST['pm_cognome'];
        $this->ModelPm->pm_update($id, $titolo, $nome, $cognome);
        $this->return_to_cliente();
    }


    /**
     * La funzione elimina un pm dal DB.
     */
    private function delete_pm()
    {
        $IdPro = $_SESSION['post_cli_id'];
        $IdPm = $_POST['pm_id'];
        $count = $this->ModelCaso->count_casi_of_pm($IdPm);
        if($count == 0)
        {
            $this->ModelPm->delete_pm($_POST['pm_id']);
            $this->return_to_cliente();
        }
        else if($count > 0)
        {
            $ArrPm = $this->ModelPm->select_pm_of_cliente($IdPro);
            $this->ModelCliente->select_single_procura($IdPro);
            $NomePro = $this->ModelCliente->get_cli_nome();
            $this->Html->HTML_header();
            echo "<div style='text-align: center;'><b style='color: red;'>Impossibile Eliminare il Pm siccome contiene ancora $count Dossier</b></div>";
            $this->HtmlPm->HTML_pm_of_cliente($ArrPm, $NomePro);
            $this->Html->HTML_footer();
        }
    }


    /**
     * La funzione inserisce un nuovo pm
     */
    private function insert_pm_of_cliente()
    {
        $IdPro = $_SESSION['post_cli_id'];
        $nome = $_POST['pm_nome'];
        $cognome = $_POST['pm_cognome'];
        $count = $this->ModelPm->count_pm_of_cliente_duplicates($IdPro, $nome, $cognome);
        if($count == 0)
        {
            $this->ModelPm->insert_pm($_POST['pm_titolo'], $_POST['pm_nome'], $_POST['pm_cognome'], $_SESSION['post_cli_id']);
            $this->return_to_cliente();
        }
        else
        {
            $this->Html->HTML_header();
            $this->HtmlPm->HTML_add_pm_of_cliente($count);
            $this->Html->HTML_footer();
        }
    }


    /**
     * La funzione ritorna sulla pagina del cliente e visualizza la lista dei PM associati a tale cliente.
     */
    private function return_to_cliente()
    {
        $IdCli = $_SESSION['post_cli_id'];
        $this->ModelCliente->select_single_procura($IdCli);
        $NomeCliente = $this->ModelCliente->get_cli_nome();
        $res = $this->ModelPm->select_pm_of_cliente($IdCli);
        $this->Html->HTML_header();
        $this->HtmlPm->HTML_pm_of_cliente($res, $NomeCliente);
        $this->Html->HTML_footer();
    }

}
