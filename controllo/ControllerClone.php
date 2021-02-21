<?php
/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 14:27
 * Class ControllerClone
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative alle copie forensi (cloni)
 *
 */
class ControllerClone
{
    /**
     * ControllerClone constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->ControllerHost = new ControllerHost();
        $this->ControllerEvidence = new ControllerEvidence();
        $this->Html = new HtmlPainter();
        $this->HtmlClone = new HtmlClone();
        $this->ModelProcura = new ModelProcura();
        $this->ModelPm = new ModelPm();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
        $this->ModelHost = new ModelHost();
        $this->ModelGeneric = new ModelGeneric();
        $this->ModelEvidence = new ModelEvidence();
        $this->ModelClone = new ModelClone();

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

            case "insert_clone":
                $this->insert_clone($ARCHIVIOLOG);
                break;

            case "update_clone":
                $this->update_clone($ARCHIVIOLOG);
                break;

            case "add_clone":
                $this->add_clone();
                break;

            case "edit_clone":
                $this->edit_clone($ARCHIVIOLOG);
                break;

            case "delete_clone":
                $this->delete_clone($ARCHIVIOLOG);
                break;
        }
    }



    /*_________________*/
    /*FUNZIONI PRIVATE*/
    /*---------------*/

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
    private function insert_clone($ARCHIVIOLOG)
    {
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
        $evi_id = $_SESSION['post_evi_id'];
        $this->ModelClone->insert_clone($tipo, $altro, $stracq, $md5, $sha1, $sha256, $evi_id);
        // PRELEVO ULTIMO ID CLONE INSERITO
        $this->ModelClone->select_last_id();
        // LO CARICO IN VARIABILE
        $id = $this->ModelClone->get_clo_id();
        // CREO IL PATH DOVE ANDRA' IL LOG
        $logname = $ARCHIVIOLOG.$id.".txt";
        // AGGIORNO LA RIGA DEL CLONE AGGIUNGENDO IL PATH
        $this->ModelClone->update_clone_log($id, $logname);
        // CREO IL FILE CHE CONTERRA IL LOG
        $this->ModelClone->save_log($logname, $_POST['clo_log']);
        // VADO A PRELEVARE IL CAMPO COLLECTION DENTRO HOST PER DECIDERE DOVE INDIRIZZARE IL FLUSSO
        $this->ModelClone->select_single_clone($id);
        $ex_id_evi = $this->ModelClone->get_ex_id_evi();
        $this->ModelEvidence->select_single_evidence($ex_id_evi);
        $ex_id_ho = $this->ModelEvidence->get_ex_id_host();
        $this->ModelHost->select_host($ex_id_ho);
        $this->ControllerEvidence->view_evidence();
    }


    /**
     * @param $ARCHIVIOLOG
     * La funzione aggiorna le informazioni nel DB di un clone selezionato.
     * Successivamente visualizza nuovamente l'evidence
     */
    private function update_clone($ARCHIVIOLOG)
    {
        $id = $_POST['clo_id'];
        $tipoacq = $_POST['clo_tipoacq'];
        $altro = $_POST['clo_altro'];
        $stracq = $_POST['clo_stracq'];
        $md5 = $_POST['clo_md5'];
        $sha1 = $_POST['clo_sha1'];
        $sha256 = $_POST['clo_sha256'];
        $log = $_POST['clo_log'];
        //$this->ModelEvidence->update_evidence_info($id, $tipoacq, $stracq, $md5, $sha1, $sha256, $log);
        $logname = $ARCHIVIOLOG.$id.".txt";
        // Elimina il vecchio log
        unlink($logname);
        // Salva nuovamente il log
        $this->ModelClone->save_log($logname, $log);
        $this->ModelClone->update_clone($id, $tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $logname);
        $this->ModelClone->select_single_clone($id);
        $ex_id_evi = $this->ModelClone->get_ex_id_evi();
        $this->ModelEvidence->select_single_evidence($ex_id_evi);
        $ex_id_ho = $this->ModelEvidence->get_ex_id_host();
        $this->ModelHost->select_host($ex_id_ho);
        $this->ControllerEvidence->view_evidence();
    }


    /**
     * Stampa la pagina che consente di aggiungere un nuovo clone
     */
    private function add_clone()
    {
        // Preleva dalla sessione l'id evidence dell'evidence attuale.
        $idEvi = $_SESSION['post_evi_id'];
        // Seleziona l'evidence e setta la classe in memoria
        $this->ModelEvidence->select_single_evidence($idEvi);
        // Preleva nome e tipo evidence
        $NomeEvi = $this->ModelEvidence->get_evi_etichetta();
        $TipoEvi = $this->ModelEvidence->get_evi_tipo();
        // Stampa a video la pagina di aggiunta clone
        $this->Html->HTML_header();
        $this->HtmlClone->HTML_add_clone($TipoEvi, $NomeEvi);
        $this->Html->HTML_footer();
    }


    /**
     * Stampa la pagina che consente di modificare le informazioni di un clone
     */
    private function edit_clone($ARCHIVIOLOG)
    {
        $this->ModelClone->select_single_clone($_POST['clo_id']);
        $id=$this->ModelClone->get_clo_id();
        $tipoacq = $this->ModelClone->get_clo_tipoacq();
        $altro = $this->ModelClone->get_clo_altro_tipo();
        $stracq = $this->ModelClone->get_clo_stracq();
        $md5 = $this->ModelClone->get_clo_md5();
        $sha1 = $this->ModelClone->get_clo_sha1();
        $sha256 = $this->ModelClone->get_clo_sha256();
        //$log = $this->ModelClone->get_clo_log();
        $log = file_get_contents("archiviolog/".$id.".txt");
        $this->Html->HTML_header();
        $this->HtmlClone->HTML_edit_clone($id, $tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $log);
        $this->Html->HTML_footer();
    }


    /**
     * @param $ARCHIVIOLOG
     * Elimina un clone
     */
    private function delete_clone($ARCHIVIOLOG)
    {
        $id = $_POST['clo_id'];
        $this->ModelClone->select_single_clone($id);
        $ex_id_evi = $this->ModelClone->get_ex_id_evi();
        $this->ModelEvidence->select_single_evidence($ex_id_evi);
        $ex_id_ho = $this->ModelEvidence->get_ex_id_host();
        $this->ModelHost->select_host($ex_id_ho);

        // ELIMINO DAL DB
        $this->ModelClone->delete_clone($id);
        // ELIMINO IL FILE
        $logname = $ARCHIVIOLOG.$id.".txt";
        unlink($logname);
        // INDIRIZZO IL FLUSSO
        $this->ControllerEvidence->view_evidence();
    }

}











