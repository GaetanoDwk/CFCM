<?php

require_once 'lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

/**
 * Class ModelUfedTools
 * Questa classe è stata concepita per la creazione di tools/funzioni di semi-automazione di supporto al lavoro con Cellebrite Ufed Reader
 */
class ModelUfedTools {

    /**
     * A partire da una chat esportata in formato XLS con Cellebrite Ufed Reader; questa funzione permette di generare la stessa chat nel web browser
     * con le stesse caratteristiche grafiche di quella presente in Ufed Reader allo scopo di eliminare le informazioni ridondanti e di conseguenza
     * evitare di farsi manualmente dei montaggi grafici prima di portare in evidenza la chat in consulenza (perizia/file word); limitandosi quindi
     * a farsi il solo screenshot dello spezzone di interesse.
     * @param $ChatPath
     * @return array
     * @throws PHPExcel_Exception
     * @throws PHPExcel_Reader_Exception
     */
    public function get_rapporto_xls($ChatPath)
    {
        //CARICO IL FILE Rapporto.xlsx IN UN OGGETTO DI TIPO PHPExcel
        $excelObj = PHPExcel_IOFactory::load($ChatPath . "Rapporto.xlsx");
        //CARICO IL CONTENUTO DELL'OGGETTO IN UN ARRAY
        $arrChat = $excelObj->getActiveSheet()->toArray(null);
        //RITORNA L'ARRAY CON ALL'INTERNO I DATI DELLA CHAT
        return $arrChat;
    }

}
