<?php
/**
 * Class ControllerAzienda
 * Questa classe gestisce le operazioni per l'aggiunta, modifica, eliminazione delle informazioni relative all'azienda che utilizza CFCM.
 * Tali informazioni (rag.sociale, CTU, indirizzo, CAP, p.iva ecc... servono per la stampa a video nella copertina della documentazione tecnica.
 */
class ControllerAzienda
{

    /**
     * ControllerAzienda constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->ModelAzienda = new ModelAzienda();
        $this->Html = new HtmlPainter();
        $this->HtmlAmm = new HtmlAmministrazione();
        $this->modelProcura = new ModelProcura();

    }


    /**
     * @param $comando
     * Questa funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando) {
            case 'amm_azienda':
                $this->amm_azienda();
                break;
            case 'view_azienda':
                $this->view_azienda();
                break;
            case 'add_azienda':
                $this->add_azienda();
                break;
            case 'insert_azienda':
                $this->insert_azienda();
                break;
            case 'edit_azienda':
                $this->edit_azienda();
                break;
            case 'update_azienda':
                $this->update_azienda();
                break;
            case 'delete_azienda':
                $this->delete_azienda();
                break;
        }
    }


    /**
     * Visualizza la lista di aziende. Editando un'azienda è possibile impostarla come default per selezionarla.
     *
     */
    private function amm_azienda()
    {
        $Aziende = $this->ModelAzienda->select_aziende();
        $this->Html->HTML_header();
        $this->HtmlAmm->HTML_nav("amministrazione");
        $this->HtmlAmm->HTML_azienda($Aziende);
        $this->Html->HTML_footer();
    }


    /**
     * Visualizza le informazioni dell'azienda selezionata
     */
    private function view_azienda()
    {
        $id = $_POST['id'];
        $this->ModelAzienda->select_azienda($id);
        $rsoc = $this->ModelAzienda->getRsoc();
        $ctu = $this->ModelAzienda->getCtu();
        $indi = $this->ModelAzienda-> getIndi();
        $cap = $this->ModelAzienda->getCap();
        $citta = $this->ModelAzienda->getCitta();
        $tele = $this->ModelAzienda->getTele();
        $cell = $this->ModelAzienda->getCell();
        $fax = $this->ModelAzienda->getFax();
        $mail = $this->ModelAzienda->getMail();
        $piva = $this->ModelAzienda->getPiva();
        $rea = $this->ModelAzienda->getRea();
        $def = $this->ModelAzienda->getDef();
        $this->Html->HTML_header();
        $this->HtmlAmm->HTML_nav("amm_azienda");
        $this->HtmlAmm->HTML_view_azienda($rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def);
        $this->Html->HTML_footer();
    }


    /**
     * Stampa la pagina di modifica delle informazioni dell'azienda
     */
    private function edit_azienda()
    {
        $id = $_POST['id'];
        $this->ModelAzienda->select_azienda($id);
        $rsoc = $this->ModelAzienda->getRsoc();
        $ctu = $this->ModelAzienda->getCtu();
        $indi = $this->ModelAzienda-> getIndi();
        $cap = $this->ModelAzienda->getCap();
        $citta = $this->ModelAzienda->getCitta();
        $tele = $this->ModelAzienda->getTele();
        $cell = $this->ModelAzienda->getCell();
        $fax = $this->ModelAzienda->getFax();
        $mail = $this->ModelAzienda->getMail();
        $piva = $this->ModelAzienda->getPiva();
        $rea = $this->ModelAzienda->getRea();
        $def = $this->ModelAzienda->getDef();
        $this->Html->HTML_header();
        $this->HtmlAmm->HTML_nav("amm_azienda");
        $this->HtmlAmm->HTML_edit_azienda($id, $rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def);
        $this->Html->HTML_footer();
    }


    /**
     * Stampa la pagina di aggiunta delle informazioni relative all'azienda.
     */
    private function add_azienda()
    {
        $this->Html->HTML_header();
        $this->HtmlAmm->HTML_nav("amm_azienda");
        $this->HtmlAmm->HTML_add_azienda();
    }


    /**
     * Effettua l'insert nel DB delle informazioni relative all'azienda e ristampa la pagina di amministrazione azienda
     */
    private function insert_azienda()
    {
        $rsoc = $_POST['rsoc'];
        $ctu = $_POST['ctu'];
        $indi = $_POST['indi'];
        $cap = $_POST['cap'];
        $citta = $_POST['citta'];
        $tele = $_POST['tele'];
        $cell = $_POST['cell'];
        $fax = $_POST['fax'];
        $mail = $_POST['mail'];
        $piva = $_POST['piva'];
        $rea = $_POST['rea'];
        $def = $_POST['def'];
        $this->ModelAzienda->insert_azienda($rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def);
        $this->amm_azienda();
    }


    /**
     * Effettua l'update nel DB delle informazioni relative all'azienda e ristampa la pagina di amministrazione azienda
     */
    private function update_azienda()
    {
        $id = $_POST['id'];
        $rsoc = $_POST['rsoc'];
        $ctu = $_POST['ctu'];
        $indi = $_POST['indi'];
        $cap = $_POST['cap'];
        $citta = $_POST['citta'];
        $tele = $_POST['tele'];
        $cell = $_POST['cell'];
        $fax = $_POST['fax'];
        $mail = $_POST['mail'];
        $piva = $_POST['piva'];
        $rea = $_POST['rea'];
        $def = $_POST['def'];
        $this->ModelAzienda->update_azienda($id, $rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def);
        $this->amm_azienda();
    }


    /**
     * Elimina l'azienda selezionata e ristampa la pagina di amministrazione azienda
     */
    private function delete_azienda()
    {
       $id = $_POST['id'];
       $this->ModelAzienda->delete_azienda($id);
       $this->amm_azienda();
    }

}
