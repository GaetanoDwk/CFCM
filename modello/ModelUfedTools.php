<?php

#require_once 'lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
require_once "lib/simplexlsx/src/SimpleXLSX.php";

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
     */
    public function get_rapporto_xls($ChatPath)
    {
        // Trovo il nome del file excel nella folder della chat
        $rapporto = glob($ChatPath.'*.xlsx');
        try {
            $xlsx = SimpleXLSX::parse($rapporto[0]);
            $arr = json_decode(json_encode((array)$xlsx->rows()), TRUE);
            return $arr;
        }
        catch (Exception $e)
        {
            echo("<h3> Eccezione</h3>". $e);
            exit(1);
        }

        // QUESTO TRY CATCH E' RELATIVO ALLA LIBRERIA PHPExcel-1.8
        /*try{
            //CARICO IL FILE XLSX DEL RAPPORTO IN UN OGGETTO DI TIPO PHPExcel
            $excelObj = PHPExcel_IOFactory::load($rapporto[0]);
            //CARICO IL CONTENUTO DELL'OGGETTO IN UN ARRAY
            $arrChat = $excelObj->getActiveSheet()->toArray(null);
            //RITORNA L'ARRAY CON ALL'INTERNO I DATI DELLA CHAT
            return $arrChat;
        }
        catch (Exception $e)
        {
            echo("<h3> Eccezione</h3>". $e);
            exit(1);
        }*/
    }

}
