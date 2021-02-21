<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Class ControllerCloneSpecial
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative alle copie forensi degli evidence degli host special.
 *
 */

class ControllerCloneSpecial
{
    /**
     * ControllerCloneSpecial constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->ControllerHost = new ControllerHost();
        $this->ControllerHostSpecial = new ControllerHostSpecial();
        $this->ControllerEvidence = new ControllerEvidence();
        $this->Html = new HtmlPainter();
        $this->HtmlCloneSpecial = new HtmlCloneSpecial();
        $this->ModelProcura = new ModelProcura();
        $this->ModelPm = new ModelPm();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
        $this->ModelHost = new ModelHost();
        $this->ModelGeneric = new ModelGeneric();
        $this->ModelEvidence = new ModelEvidence();
        $this->ModelClone = new ModelClone();
        $this->ModelCloneSpecial = new ModelCloneSpecial();

    }

    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        $ARCHIVIOLOG = "archiviolog/";

        switch ($comando)
        {
            case "view_log":
                $this->view_log();
                break;

            case "insert_clone_host_special":
                $this->insert_clone_host_special($ARCHIVIOLOG);
                break;

            case "update_clone_special":
                $this->update_clone_special($ARCHIVIOLOG);
                break;

            case "add_clone_host_special":
                $this->add_clone_host_special();
                break;

            case "edit_clone_special":
                $this->edit_clone_special();
                break;

            case "delete_clone_special":
                $this->delete_clone_special($ARCHIVIOLOG);
                break;
        }

    }



    /*__________________*/
    /* FUNZIONI PRIVATE*/
    /*----------------*/
    /**
     * La funzione seleziona e visualizza le informazioni relative ai log dei cloni
     */
    private function view_log()
    {
        $this->ModelClone->select_single_clone($_POST['clo_id']);
        $logpath = $this->ModelClone->get_clo_log();
        $log = file_get_contents($logpath);
        echo"<pre>";
        echo $log;
        echo "</pre>";
    }


    /**
     * @param $ARCHIVIOLOG
     * La funzione inserisce un nuovo clone nel DB.
     * Successivamente seleziona l'ID del clone appena inserito per creare il file txt utilizzando tale ID e lo valorizza con il log.
     * Successivamente ristampa a video le informazioni dell'evidence.
     */
    private function insert_clone_host_special($ARCHIVIOLOG)
    {
        // VALORIZZO VARIABILI DA INSERIRE NELLA TABELLA
        $tipo = $_POST['clo_tipoacq'];
        if(isset($_POST['clo_altro']))
        {
            $altro = $_POST['clo_altro'];
        }
        else
        {
            $altro = null;
        }
        $stracq = $_POST['clo_stracq'];
        $md5 = $_POST['clo_md5'];
        $sha1 = $_POST['clo_sha1'];
        $sha256 = $_POST['clo_sha256'];
        $ex_id_host_special = $_SESSION['post_ho_id'];
        $this->ModelCloneSpecial->insert_clone($tipo, $altro, $stracq, $md5, $sha1, $sha256, $ex_id_host_special);
        // PRELEVO ULTIMO ID CLONE INSERITO
        $this->ModelCloneSpecial->select_last_id();
        // LO CARICO IN VARIABILE
        $id = $this->ModelCloneSpecial->get_clo_id();
        // CREO IL PATH DOVE ANDRA' IL LOG
        $logname = $ARCHIVIOLOG.$id.".txt";
        // AGGIORNO LA RIGA DEL CLONE AGGIUNGENDO IL PATH
        $this->ModelCloneSpecial->update_clone_log($id, $logname);
        // CREO IL FILE CHE CONTERRA IL LOG
        $this->ModelCloneSpecial->save_log($logname, $_POST['clo_log']);
        // VADO A PRELEVARE IL CAMPO COLLECTION DENTRO HOST PER DECIDERE DOVE INDIRIZZARE IL FLUSSO
        $this->ModelCloneSpecial->select_single_clone($id);
        $this->ControllerHostSpecial->view_host_special();
    }


    /**
     * @param $ARCHIVIOLOG
     * La funzione aggiorna le informazioni nel DB di un clone selezionato.
     * Successivamente visualizza nuovamente l'evidence.
     */
    private function update_clone_special($ARCHIVIOLOG)
    {
        $id = $_POST['clo_id'];
        $tipoacq = $_POST['clo_tipoacq'];
        $altro = $_POST['clo_altro'];
        $stracq = $_POST['clo_stracq'];
        $md5 = $_POST['clo_md5'];
        $sha1 = $_POST['clo_sha1'];
        $sha256 = $_POST['clo_sha256'];
        $log = $_POST['clo_log'];
        $logname = $ARCHIVIOLOG.$id.".txt";
        unlink($logname);
        $this->ModelCloneSpecial->save_log($logname, $log);
        $this->ModelCloneSpecial->update_clone($id, $tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $logname);
        $this->ControllerHostSpecial->view_host_special();
    }


    /**
     * Stampa la pagina che consente di aggiungere un nuovo clone
     */
    private function add_clone_host_special()
    {
        $this->Html->HTML_header();
        $this->HtmlCloneSpecial->HTML_add_clone_host_special();
        $this->Html->HTML_footer();
    }


    /**
     * Stampa la pagina che consente di modificare le informazioni di un clone
     */
    private function edit_clone_special()
    {
        $this->ModelCloneSpecial->select_single_clone($_POST['clo_id']);
        $id=$this->ModelCloneSpecial->get_clo_id();
        $tipoacq = $this->ModelCloneSpecial->get_clo_tipoacq();
        $altro = $this->ModelCloneSpecial->get_clo_altro_tipo();
        $stracq = $this->ModelCloneSpecial->get_clo_stracq();
        $md5 = $this->ModelCloneSpecial->get_clo_md5();
        $sha1 = $this->ModelCloneSpecial->get_clo_sha1();
        $sha256 = $this->ModelCloneSpecial->get_clo_sha256();
        //$log = $this->ModelClone->get_clo_log();
        $log = file_get_contents("archiviolog/$id.txt");
        $this->Html->HTML_header();
        $this->HtmlCloneSpecial->HTML_edit_clone_special($id, $tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $log);
        $this->Html->HTML_footer();
    }

    /**
     * @param $ARCHIVIOLOG
     * Elimina un clone
     */
    private function delete_clone_special($ARCHIVIOLOG)
    {
        $id = $_POST['clo_id'];
        $this->ModelCloneSpecial->delete_clone_special($id);
        // ELIMINO IL FILE
        $logname = $ARCHIVIOLOG.$id.".txt";
        unlink($logname);
        // INDIRIZZO IL FLUSSO
        $this->ControllerHostSpecial->view_host_special();
    }

}
