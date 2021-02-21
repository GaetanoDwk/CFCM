<?php


/**
 * Class ControllerLavorazione
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative allo stato di lavorazione di un caso.
 */
class ControllerLavorazione
{


    /**
     * ControllerLavorazione constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->Html = new HtmlPainter();
        $this->HtmlLavorazione = new HtmlLavorazione();
        $this->ModelLavorazione = new ModelLavorazione();

    }


    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando) {
            case 'lavorazione':
                $this->lavorazione();
                break;

            case 'refresh_lavorazione':
                $this->update_lavorazione();
                break;

            case "add_lavorazione":
                $this->add_lavorazione();
                break;

            case "edit_lavorazione":
                $this->edit_lavorazione();
                break;

            case "update_lavorazione":
                $this->update_lavorazione();
                break;

            case "insert_lavorazione":
                $this->insert_lavorazione();
                break;

            case "delete_lavorazione":
                $this->delete_lavorazione();
                break;
        }

    }


    /**
     * La funzione seleziona dal db e visualizza lo stato di lavorazione dei casi.
     */
    private function lavorazione()
    {
        //SELEZIONO UNA PRIMA VOLTA LE LAVORAZIONI PER PASSARLE ALLA FUNZIONE DI UPDATE DEI GGRESTANTI
        $lavorazioni = $this->ModelLavorazione->select_all_lavorazione();
        //FA IL CONTROLLO SE BISOGNA AGGIORNARE I GGRESTANTI E NEL CASO LI AGGIORNA
        $this->ModelLavorazione->refresh_ggrestanti_for_all($lavorazioni);
        //SELEZIONO UNA SECONDA VOLTA LE LAVORAZIONI AGGIORNATE PER PASSARLE ALLA FUNZIONE DI VISUALIZZAZIONE
        $lavorazioni = $this->ModelLavorazione->select_all_lavorazione();
        $this->Html->HTML_header();
        $this->HtmlLavorazione->HTML_lavorazione($lavorazioni);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa a video la pagina che permette di aggiungere una nuova lavorazione.
     */
    private function add_lavorazione()
    {
        $this->Html->HTML_header();
        $this->HtmlLavorazione->HTML_add_lavorazione();
        $this->Html->HTML_footer();
    }


    /**
     * La funzione seleziona una lavorazione e stampa a video la pagina che ne permette la modifica.
     */
    private function edit_lavorazione()
    {
        $IdLav = $_POST['idlav'];
        $this->ModelLavorazione->select_single_lavorazione($IdLav);
        $num = $this->ModelLavorazione->getNumero();
        $pm = $this->ModelLavorazione->getPm();
        $pro = $this->ModelLavorazione->getProcura();
        $din = $this->ModelLavorazione->getDinizio();
        $gg = $this->ModelLavorazione->getGg();
        $dfin = $this->ModelLavorazione->getDfine();
        $ggr = $this->ModelLavorazione->getGgrestanti();
        $cop = $this->ModelLavorazione->getCopia();
        $ftk = $this->ModelLavorazione->getFtk();
        $ief = $this->ModelLavorazione->getIef();
        $ana = $this->ModelLavorazione->getAnalisi();
        $exprep = $this->ModelLavorazione->getExprep();
        $dim = $this->ModelLavorazione->getDim();
        $all = $this->ModelLavorazione->getAllegati();
        $liq = $this->ModelLavorazione->getLiquidazione();
        $diff = $this->ModelLavorazione->getDifficolta();
        $prog = $this->ModelLavorazione->getProgresso();
        $note = $this->ModelLavorazione->getNote();
        $ope = $this->ModelLavorazione->getOperatore();
        $this->Html->HTML_header();
        $this->HtmlLavorazione->HTML_edit_lavorazione($IdLav, $num, $pm, $pro, $din, $gg, $dfin, $ggr, $cop, $ftk, $ief, $ana, $exprep, $dim, $all, $liq, $diff, $prog, $note, $ope);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione esegue l'update di un caso sul DB e visualizza a video la lista delle lavorazioni.
     */
    private function update_lavorazione()
    {
        $Id = $_POST['idlav'];
        $num = $_POST['numero'];
        $pm = $_POST['pm'];
        $pro = $_POST['procura'];
        $din = $_POST['dinizio'];
        $gg = $_POST['gg'];
        $cop = $_POST['copia'];
        $ftk = $_POST['ftk'];
        $ief = $_POST['ief'];
        $ana = $_POST['analisi'];
        $exprep = $_POST['exprep'];
        $dim = $_POST['dim'];
        $all = $_POST['allegati'];
        $liq = $_POST['liquidazione'];
        $diff = $_POST['difficolta'];
        $note = $_POST['note'];
        $ope = $_POST['operatore'];
        // CALCOLO IL LIVELLO DEL PROGRESSO
        $prog = 0;
        if($cop != 0){$prog = $prog + 10;}
        if($ftk != 0){$prog = $prog + 10;}
        if($ief != 0){$prog = $prog + 10;}
        if($ana != 0){$prog = $prog + 30;}
        if($exprep != 0){$prog = $prog + 10;}
        if($dim != 0){$prog = $prog + 10;}
        if($all != 0){$prog = $prog + 10;}
        if($liq != 0){$prog = $prog + 10;}
        
        $this->ModelLavorazione->update_lavorazione($Id, $num, $pm, $pro, $din, $gg, $cop, $ftk, $ief, $ana, $exprep, $dim, $all, $liq, $diff, $prog, $note, $ope);
        $this->ModelLavorazione->calcola_dfine($Id, $gg-1);
        $this->ModelLavorazione->calcola_ggrestanti($Id);
        // VISUALIZZAZIONE LAVORAZIONI
        $lavorazioni = $this->ModelLavorazione->select_all_lavorazione();
        $this->Html->HTML_header();
        $this->HtmlLavorazione->HTML_lavorazione($lavorazioni);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione inserisce una nuova lavorazione nel DB
     */
    private function insert_lavorazione()
    {
        $num = $_POST['numero'];
        $pm = $_POST['pm'];
        $pro = $_POST['procura'];
        $din = $_POST['dinizio'];
        $gg = $_POST['gg'];
        $cop = $_POST['copia'];
        $ftk = $_POST['ftk'];
        $ief = $_POST['ief'];
        $ana = $_POST['analisi'];
        $exprep = $_POST['exprep'];
        $dim = $_POST['dim'];
        $all = $_POST['allegati'];
        $liq = $_POST['liquidazione'];
        $note = $_POST['note'];
        $diff = $_POST['difficolta'];
        $ope = $_POST['operatore'];
        
        // CALCOLO IL LIVELLO DEL PROGRESSO
        $prog = 0;
        if($cop != 0){$prog = $prog + 10;}
        if($ftk != 0){$prog = $prog + 10;}
        if($ief != 0){$prog = $prog + 10;}
        if($ana != 0){$prog = $prog + 30;}
        if($exprep != 0){$prog = $prog + 10;}
        if($dim != 0){$prog = $prog + 10;}
        if($all != 0){$prog = $prog + 10;}
        if($liq != 0){$prog = $prog + 10;}
        
        // INSERISCO NUOVA LAVORAZIONE
        $this->ModelLavorazione->insert_lavorazione($num, $pm, $pro, $din, $gg, $cop, $ftk, $ief, $ana, $exprep, $dim, $all, $liq, $prog, $note, $diff, $ope);
        $this->ModelLavorazione->select_last_inserted();
        $id = $this->ModelLavorazione->getId();
        $this->ModelLavorazione->calcola_dfine($id, $gg-1);
        $this->ModelLavorazione->calcola_ggrestanti_after_insert($id);

        // VISUALIZZO LE LAVORAZIONI
        $lavorazioni = $this->ModelLavorazione->select_all_lavorazione();
        $this->Html->HTML_header();
        $this->HtmlLavorazione->HTML_lavorazione($lavorazioni);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione elimina la lavorazione dal DB
     */
    private function delete_lavorazione()
    {
        $IdLav = $_POST['idlav'];
        $this->ModelLavorazione->delete_lavorazione($IdLav);
        
        // VISUALIZZO LE LAVORAZIONI
        $lavorazioni = $this->ModelLavorazione->select_all_lavorazione();
        $this->Html->HTML_header();
        $this->HtmlLavorazione->HTML_lavorazione($lavorazioni);
        $this->Html->HTML_footer();
    }



}
