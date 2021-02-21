<?php


/**
 * Class ControllerMagazzino
 * Questa classe gestisce le operazioni di aggiunta, modifica, eliminazione, visualizzazione relative al numero di dispositivi da consegnare al cliente presenti in magazzino
 */
class ControllerMagazzino
{

    /**
     * ControllerMagazzino constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public  function __construct()
    {
        $this->Html = new HtmlPainter();
        $this->HtmlMagazzino = new HtmlMagazzino();
        $this->ModelMagazzino = new ModelMagazzino();
    }

    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando)
        {
            case 'magazzino':
                $this->magazzino();
                break;
            case 'add_magazzino':
                $this->add_magazzino();
                break;
            case 'insert_magazzino':
                $this->insert_magazzino();
                break;
            case 'edit_magazzino':
                $this->edit_magazzino();
                break;
            case 'update_magazzino':
                $this->update_magazzino();
                break;
            case 'delete_magazzino':
                $this->delete_magazzino();
                break;


        }

    }

    /**
     * La funzione seleziona e stampa a video il num di consegne per un cliente.
     */
    private function magazzino()
    {
        $magazzino = $this->ModelMagazzino->select_all();
        $this->Html->HTML_header();
        $this->HtmlMagazzino->HTML_magazzino($magazzino);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione stampa la pagina che permette l'aggiunta di una nuova consegna
     */
    private function add_magazzino()
    {
        $this->Html->HTML_header();
        $this->HtmlMagazzino->HTML_add_magazzino();
        $this->Html->HTML_footer();
    }


    /**
     * La funzione inserisce nel DB una nuova consegna
     */
    private function insert_magazzino()
    {
        $procura = $_POST['procura'];
        $pm = $_POST['pm'];
        $dossier = $_POST['dossier'];
        $plico = $_POST['plico'];
        $data = $_POST['dataC'];
        $note = $_POST['note'];
        // INSERISCO NUOVA RIGA NEL DB
        $this->ModelMagazzino->insert($procura, $pm, $dossier, $plico, $data, $note);
        // VISUALIZZO SCHERMATA MAGAZZINO
        $this->magazzino();
    }


    /**
     * La funzione stampa a video la pagina per editare le informazioni relative ad una consegna.
     */
    private function edit_magazzino()
    {
        $idMag = $_POST['idMag'];
        $this->ModelMagazzino->select_single($idMag);
        $id = $this->ModelMagazzino->getId();
        $procura = $this->ModelMagazzino->getProcura();
        $pm = $this->ModelMagazzino->getPm();
        $dossier = $this->ModelMagazzino->getDossier();
        $plico = $this->ModelMagazzino->getPlico();
        $dataC = $this->ModelMagazzino->getData();
        $note = $this->ModelMagazzino->getNote();
        $this->Html->HTML_header();
        $this->HtmlMagazzino->HTML_edit($id, $procura, $pm, $dossier, $plico, $dataC, $note);
        $this->Html->HTML_footer();
    }


    /**
     * La funzione aggiorna nel DB le informazioni relative alla consegna editata.
     */
    private function update_magazzino()
    {
        $idMag = $_POST['idMag'];
        $procura = $_POST['procura'];
        $pm = $_POST['pm'];
        $dossier = $_POST['dossier'];
        $plico = $_POST['plico'];
        $dataC = $_POST['dataC'];
        $note = $_POST['note'];
        $this->ModelMagazzino->update($idMag, $procura, $pm, $dossier, $plico, $dataC, $note);
        // VISUALIZZO MAGAZZINO
        $this->magazzino();
    }


    /**
     * Elimina nel DB la consegna
     */
    private function delete_magazzino()
    {
        $IdMag = $_POST['idMag'];
        $this->ModelMagazzino->delete($IdMag);
        // VISUALIZZO MAGAZZINO
        $this->magazzino();

    }

}
