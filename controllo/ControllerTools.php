<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 12:41
 * La classe gestisce le operazioni relative ai Tools di ausilio a FTK (ftktools) e UFED-Reader(ufedtools)
 */


class ControllerTools
{
    /**
     * ControllerTools constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->ModelTools = new ModelTools();
        $this->ModelUfedTools = new ModelUfedTools();
        $this->Html = new HtmlPainter();
        $this->HtmTools = new HtmlTools();
    }


    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {

        switch ($comando) {

            case 'ftktools':
                $this->ftktools();
                break;
            case 'ftktool_item':
                $this->ftktool_item();
                break;
            case 'import_data_1':
                $this->import_data_1();
                break;
            case 'import_data_2':
                $this->import_data_2();
                break;
            case 'import_data_3':
                $this->import_data_3();
                break;
            case 'import_data_4':
                $this->import_data_4();
                break;
            case 'import_data_5':
                $this->import_data_5();
                break;
            case 'import_data_6':
                $this->import_data_6();
                break;
            case 'ftktools_import_emails':
                $this->ftktools_import_emails();
                break;
            case 'GENERATE_md5_filter':
                $this->GENERATE_md5_filter();
                break;
            case 'GENERATE_email_filter':
                $this->GENERATE_email_filter();
                break;
            case 'ftktools_groupby_md5':
                $this->ftktools_group_by_md5();
                break;
            case 'upload_filelist':
                $this->upload_filelist();
                break;
            case 'UPLOAD_filelist_md5_filter':
                $this->upload_filelist_md5_filter();
                break;
            case 'upload_filelist_items':
                $this->upload_filelist_items();
                break;
            case 'upload_filelist_emails':
                $this->upload_filelist_emails();
            break;
            case 'UPLOAD_shortpath_filelist':
                $this->UPLOAD_shortpath_filelist();
                break;
            case 'UPLOAD_longpath_filelist':
                $this->UPLOAD_longpath_filelist();
                break;
            case 'group_by_md5':
                $this->group_by_md5();
                break;
            case 'ftktools_md5_filter':
                $this->ftktools_md5_filter();
                break;
            case 'ftktool_shortpath':
                $this->PRINT_ftktool_shortpath();
                break;
            case 'ftktool_longpath':
                $this->PRINT_ftktool_longpath();
                break;
            case 'ftktools_email':
                $this->PRINT_ftktools_email();
                break;
            case 'GENERATE_filter_by_items':
                $this->GENERATE_filter_by_items();
                break;
            /*case 'del_by_md5_and_shortest_path':
                $this->del_by_md5_and_shortest_path();
                break;*/
            case 'ufedtools':
                $this->ufedtools();
                break;
            case 'ufedtools_chat_whatsapp':
                $this->ufedtools_chat_whatsapp();
                break;
            case 'ufedtools_gen_chat':
                $this->ufedtools_gen_chat();
                break;
            case 'GENERATE_shortpath_filter':
                $this->GENERATE_shortpath_filter();
                break;
            case 'GENERATE_longpath_filter':
                $this->GENERATE_longpath_filter();
                break;
            // _________________________________________________________________________________________________________

        }
    }

    /**
     * La funzione visualizza la pagina dei tools di ausilio a FTK
     */
    private function ftktools()
    {
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktools();
        $this->Html->HTML_footer();

    }

    /**
     * La funzione visualizza la pagina del tool per
     */
    private function ftktool_item()
    {
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktool_item($filelist);
        $this->Html->HTML_footer();
    }

    /**
     * Stampa a video la pagina contenente i tools di ausilio al lavoro con CELLEBRITE Ufed Reader
     */
    private function ufedtools()
    {
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ufedtools();
        $this->Html->HTML_footer();

    }

    /**
     * Apre la pagina del tool di ausilio per le chat WathsApp esportate in formato XLS tramite ufed reader.
     */
    private function ufedtools_chat_whatsapp()
    {
        // Lista le cartelle contenute nella cartella ufedtools
        $dirs = $this->list_directories("ufedtools");
        $this->Html->HTML_header();
        // Visualizza la pagina con la lista delle cartelle presenti (ogni cartella corrisponde ad una chat esportata)
        $this->HtmTools->HTML_ufedtools_whatsapp($dirs);
        $this->Html->HTML_footer();

    }

    /**
     * A partire dal file XLS genera la chat con le stesse caratteristiche grafiche presenti in ufed reader ma senza elementi
     * grafici inutili ai fini degli screenshot da portare nel documento word della consulenza.
     * @TODO Migliorare l'analisi del file XLS soprattutto quando vi sono N allegati ad un unico messaggio
     * @TODO Aggiungere l'analisi e la stampa dei partecipanti alla conversazione.
     * La funzione anche se non completa fornisce già dei risultati accettabili e fruibili per l'utilizzo per cui è stata concepita.
     */
    private function ufedtools_gen_chat()
    {
        // Prelevo il path in cui si trova l'export di ufed
        $ChatPath = $_POST['chat_path'];
        // Carico il rapporto xls in un array
        $arrChat = $this->ModelUfedTools->get_rapporto_xls($ChatPath);
        $this->Html->HTML_header();
        // stampo la chat passando il path del rapporto (per i files) e l'array contenente le informazioni presenti nell'xls
        $this->HtmTools->HTML_chat($ChatPath, $arrChat);
        $this->Html->HTML_footer();

    }

    /**
     * @param $path: percorso della directory di cui si vuole il listing delle sue sotto-directory
     * @return array|false
     * La funzione lista le directory di una directory
     */
    private function list_directories($path)
    {
        $p = $path;
        $dir = glob($p. '/*' , GLOB_ONLYDIR);
        return $dir;
    }


    /**
     * @param $path: percorso di cui si vuole il listing dei files contenuti al suo interno.
     * @return array|false
     * La funzione lista i files di una directory
     */
    private function list_files($path)
    {
        $files = scandir($path);
        return $files;
    }


    /**
     * La funzione importa un FileList.txt (esportato da FTK) nella tabella "tools"
     */
    private function import_data_1()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        // Prima pulisce la tabella "tools"
        $query = $conn->prepare("TRUNCATE TABLE tools");
        $query->execute();

        // Apre il file
        $file = fopen('temp/'.$file_name, 'r');

        while(!feof($file))
        {
            $getTextLine = fgets($file);
            // explode divide la stringa in un array sfruttando \t come delimitatore
            $explodeLine = explode("\t", $getTextLine);
            /*echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";*/
            // Creazione di una lista
            @list($item, $path, $md5) = $explodeLine;
            // Pulisce tags che potrebbero creare problemi all'importazione nel DB
            $path = $this->delete_special_chars($path);
            // Prepara la query di inserimento
            $query = $conn->prepare("insert into tools(item, path, md5)values($item, '$path', '$md5')");
            /*echo"<pre>";
            print_r($query);
            echo"</pre>";*/
            $query->execute();
        }
        fclose($file);

        /*echo"IMPORTAZIONE COMPLETATA";*/
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktools_group_by_md5_import_OK($filelist);
        $this->Html->HTML_footer();
    }



    /**
     * La funzione importa un FileList.txt (esportato da FTK) nella tabella "tools"
     */
    private function import_data_2()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        // Prima pulisce la tabella "tools"
        $query = $conn->prepare("TRUNCATE TABLE tools");
        $query->execute();

        // Apre il file
        $file = fopen('temp/'.$file_name, 'r');

        while(!feof($file))
        {
            $getTextLine = fgets($file);
            // explode divide la stringa in un array sfruttando \t come delimitatore
            $explodeLine = explode("\t", $getTextLine);
            /*echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";*/
            // Creazione di una lista
            @list($item, $path, $md5) = $explodeLine;
            // Pulisce tags che potrebbero creare problemi all'importazione nel DB
            $path = $this->delete_special_chars($path);
            // Prepara la query di inserimento
            $query = $conn->prepare("insert into tools(item, path, md5)values($item, '$path', '$md5')");
            /*echo"<pre>";
            print_r($query);
            echo"</pre>";*/
            $query->execute();
        }
        fclose($file);

        /*echo"IMPORTAZIONE COMPLETATA";*/
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktools_md5_filter_import_OK($filelist);
        $this->Html->HTML_footer();
    }



    /**
     * La funzione importa un FileList.txt a partire dal tasto nella pagina dedicata agli Item Number
     */
    private function import_data_3()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        // Prima pulisce la tabella "tools"
        $query = $conn->prepare("TRUNCATE TABLE tools");
        $query->execute();

        // Apre il file
        $file = fopen('temp/'.$file_name, 'r');

        while(!feof($file))
        {
            $getTextLine = fgets($file);
            // explode divide la stringa in un array sfruttando \t come delimitatore
            $explodeLine = explode("\t", $getTextLine);
            /*echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";*/
            // Creazione di una lista
            @list($item, $path, $md5) = $explodeLine;
            // Pulisce tags che potrebbero creare problemi all'importazione nel DB
            $path = $this->delete_special_chars($path);
            // Prepara la query di inserimento
            $query = $conn->prepare("insert into tools(item, path, md5)values($item, '$path', '$md5')");
            /*echo"<pre>";
            print_r($query);
            echo"</pre>";*/
            $query->execute();
        }
        fclose($file);

        /*echo"IMPORTAZIONE COMPLETATA";*/
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktool_item_import_OK($filelist);
        $this->Html->HTML_footer();
    }



    /**
     * La funzione importa un FileList.txt a partire dal tasto nella pagina dedicata agli Item Number
     */
    private function import_data_4()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        // Prima pulisce la tabella "tools"
        $query = $conn->prepare("TRUNCATE TABLE tools");
        $query->execute();

        // Apre il file
        $file = fopen('temp/'.$file_name, 'r');

        while(!feof($file))
        {
            $getTextLine = fgets($file);
            // explode divide la stringa in un array sfruttando \t come delimitatore
            $explodeLine = explode("\t", $getTextLine);
            /*echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";*/
            // Creazione di una lista
            @list($item, $path, $md5) = $explodeLine;
            // Pulisce tags che potrebbero creare problemi all'importazione nel DB
            $path = $this->delete_special_chars($path);
            // Prepara la query di inserimento
            $query = $conn->prepare("insert into tools(item, path, md5)values($item, '$path', '$md5')");
            /*echo"<pre>";
            print_r($query);
            echo"</pre>";*/
            $query->execute();
        }
        fclose($file);

        /*echo"IMPORTAZIONE COMPLETATA";*/
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktool_shortpath_import_OK($filelist);
        $this->Html->HTML_footer();
    }




    /**
     * La funzione importa un FileList.txt a partire dal tasto nella pagina dedicata agli Item Number
     */
    private function import_data_5()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        // Prima pulisce la tabella "tools"
        $query = $conn->prepare("TRUNCATE TABLE tools");
        $query->execute();

        // Apre il file
        $file = fopen('temp/'.$file_name, 'r');

        while(!feof($file))
        {
            $getTextLine = fgets($file);
            // explode divide la stringa in un array sfruttando \t come delimitatore
            $explodeLine = explode("\t", $getTextLine);
            /*echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";*/
            // Creazione di una lista
            @list($item, $path, $md5) = $explodeLine;
            // Pulisce tags che potrebbero creare problemi all'importazione nel DB
            $path = $this->delete_special_chars($path);
            // Prepara la query di inserimento
            $query = $conn->prepare("insert into tools(item, path, md5)values($item, '$path', '$md5')");
            /*echo"<pre>";
            print_r($query);
            echo"</pre>";*/
            $query->execute();
        }
        fclose($file);

        /*echo"IMPORTAZIONE COMPLETATA";*/
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktool_longpath_import_OK($filelist);
        $this->Html->HTML_footer();
    }



    /**
     * @param $str
     * @return string|string[]
     * La funzione pulisce alcuni caratteri speciali
     */
    private function delete_special_chars($str)
    {
        $str = str_replace(" ", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace('"', '', $str);
        $var = str_replace("*", "", $str);
        return $str;
    }

    /**
     * @TODO: in fase di sviluppo
     * La funzione importa un FileList contenente le emails esportato da FTK.
     */
    private function ftktools_import_emails()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        $query = $conn->prepare("TRUNCATE TABLE ftktool_mail");
        $query->execute();

        $file = fopen('temp/'.$file_name, 'r');
        while(!feof($file))
        {
            $getTextLine = fgets($file);
            $explodeLine = explode("\t", $getTextLine);
            echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";
            @list($item, $receiver, $sender, $submit, $delivery, $attachment, $created, $accessed, $modified, $psize, $lsize, $deleted) = $explodeLine;
            if(empty($item))
            {break;}
            $receiver = $this->delete_special_chars($receiver);
            $sender = $this->delete_special_chars($sender);
            //$path = $this->delete_special_chars($path);
            $query = $conn->prepare("insert into ftktool_mail(item, receiver, sender, submit, delivery, attachment, created, accessed, modified, psize, lsize, deleted)values($item, \"$receiver\", \"$sender\", \"$submit\", \"$delivery\", \"$attachment\", \"$created\", \"$accessed\", \"$modified\", \"$psize\", \"$lsize\", \"$deleted\")");
            echo"<pre>";
            print_r($query);
            echo"</pre>";
            $query->execute();
        }
        fclose($file);

        echo"IMPORTAZIONE COMPLETATA";
    }


    /*private function IMPORT_shortpath_filelist()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        $query = $conn->prepare("TRUNCATE TABLE tools");
        $query->execute();

        $file = fopen('temp/'.$file_name, 'r');
        while(!feof($file))
        {
            $getTextLine = fgets($file);
            $explodeLine = explode("\t", $getTextLine);
            echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";
            @list($item, $path, $md5) = $explodeLine;
            if(empty($item))
            {break;}
            $query = $conn->prepare("insert into tools(item, path, md5)values($item, \"$path\", \"$md5\")");
            echo"<pre>";
            print_r($query);
            echo"</pre>";
            $query->execute();
        }
        fclose($file);

        echo"FileList IMPORT COMPLETE";
    }*/

    /*private function IMPORT_longpath_filelist()
    {
        $file_name = $_POST['file_name'];
        $conn = DbManager::getConnection();
        $query = $conn->prepare("TRUNCATE TABLE tools");
        $query->execute();

        $file = fopen('temp/'.$file_name, 'r');
        while(!feof($file))
        {
            $getTextLine = fgets($file);
            $explodeLine = explode("\t", $getTextLine);
            echo"<pre>";
            print_r($explodeLine);
            echo"</pre>";
            @list($item, $path, $md5) = $explodeLine;
            if(empty($item))
            {break;}
            $query = $conn->prepare("insert into tools(item, path, md5)values($item, \"$path\", \"$md5\")");
            echo"<pre>";
            print_r($query);
            echo"</pre>";
            $query->execute();
        }
        fclose($file);

        echo"FileList IMPORT COMPLETE";
    }*/


    /**
     * @TODO: in fase di sviluppo. Siccome non vi è un ID univoco per ogni email bisogna trovare un criterio tramite cui trovare i duplicati (ES: confrontando diversi parametri per aumentare l'attendibilità della ricerca)
     * La funzione genera un filtro importabile in FTK a seguito della eliminazione delle email doppie
     */
    private function GENERATE_email_filter()
    {
        echo "ftktools_cut_duplicates_emails";
        $res = $this->ModelTools->SELECT_from_ftktool_mail();
        $this->ModelTools->DELETE_email_duplicates($res);
        $res = $this->ModelTools->SELECT_from_ftktool_mail();
        //$this->genera_filtro_by_item($res);
        $this->HtmTools->XML_by_item_number($res);
    }

    /**
     * La funzione genera un filtro importabile in FTK a seguito della eliminazione degli elementi (files) doppi con path maggiore.
     */
    private function GENERATE_shortpath_filter()
    {
        $res = $this->ModelTools->SELECT_from_tools();
        $this->ModelTools->DELETE_shortpath_duplicates($res);
        $res = $this->ModelTools->SELECT_from_tools();
        //$this->genera_filtro_by_item($res);
        $this->Html->HTML_header();
        $this->HtmTools->XML_by_item_number_3($res);
        $this->Html->HTML_footer();
    }

    /**
     * La funzione genera un filtro importabile in FTK a seguito della eliminazione degli elementi (files) doppi con path minore.
     */
    private function GENERATE_longpath_filter()
    {
        $res = $this->ModelTools->SELECT_from_tools();
        $this->ModelTools->DELETE_longpath_duplicates($res);
        $res = $this->ModelTools->SELECT_from_tools();
        //$this->genera_filtro_by_item($res);
        $this->Html->HTML_header();
        $this->HtmTools->XML_by_item_number_4($res);
        $this->Html->HTML_footer();

    }


    /**
     * La funzione visualizza la pagina per importare il FileList (esportato da FTK) e generare un filtro xml a seguito di
     * una group by md5 sugli elementi per farne una RAPIDA eliminazione di doppioni. Il filtro xml sarà importabile in FTK
     * e conterrà unicamente i files scelti per essere selezionati.
     */
    private function ftktools_group_by_md5()
    {
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktools_group_by_md5($filelist);
        $this->Html->HTML_footer();
    }

    /**
     * Visualizza la pagina del tool per eliminare i doppioni come di seguito:
     * FILES RESIDENTI: mantiene quelli con path più corto ed elimina quelli con path più lungo.
     * FILES CARVED: mantiene quelli con path più lungo ed elimina quelli con path più corto.
     */
    private function PRINT_ftktool_shortpath()
    {
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktool_shortpath($filelist);
        $this->Html->HTML_footer();
    }

    /**
     * Visualizza la pagina del tool per eliminare i doppioni come di seguito:
     * FILES RESIDENTI: mantiene quelli con path più lungo ed elimina quelli con path più corto.
     * FILES CARVED: mantiene quelli con path più lungo ed elimina quelli con path più corto.
     */
    private function PRINT_ftktool_longpath()
    {
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktool_longpath($filelist);
        $this->Html->HTML_footer();
    }


    /**
     * Visualizza la pagina del tool per eliminare le email doppie.
     */
    private function PRINT_ftktools_email()
    {
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktools_email($filelist);
        $this->Html->HTML_footer();
    }


    /**
     * Permette di fare l'upload di un FileList (che può avere un nome qualsiasi).
     */
    private function upload_filelist()
    {
        $uploaddir = "temp/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        $this->ftktools_group_by_md5();
        } else {
        echo "Failure.\n";
        }
    }


    /**
     * Permette di fare l'upload di un FileList (che può avere un nome qualsiasi)
     */
    private function upload_filelist_md5_filter()
    {
        $uploaddir = "temp/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $this->ftktools_md5_filter();
        } else {
            echo "Failure.\n";
        }
    }


    /**
     * E' la funzione corrispondente al bottone "UPLOAD" nella pagina relativa al tool per generare un filtro by items numbers
     */
    private function upload_filelist_items()
    {
        $uploaddir = "temp/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $this->ftktool_item();
        } else {
            echo "Failure.\n";
        }
    }

    /**
     * E' la funzione corrispondente al bottone "UPLOAD" nella pagina relativa al tool per le email
     */
    private function upload_filelist_emails()
    {
        $uploaddir = "temp/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $this->ftktools_email();
        } else {
            echo "Failure.\n";
        }
    }

    /**
     * Esegue l'upload di un FIleList (nominato a piacere).
     * Corrisponde al tasto UPLOAD presente nella pagina relativa al filtro "shortpath"
     */
    private function UPLOAD_shortpath_filelist()
    {
        $uploaddir = "temp/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $this->PRINT_ftktool_shortpath();
        } else {
            echo "Failure.\n";
        }
    }

    /**
     * Esegue l'upload di un FIleList (nominato a piacere).
     * Corrisponde al tasto UPLOAD presente nella pagina relativa al filtro "longpath"
     */
    private function UPLOAD_longpath_filelist()
    {
        $uploaddir = "temp/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $this->PRINT_ftktool_longpath();
        } else {
            echo "Failure.\n";
        }
    }


    /**
     * Genera un filtro XML per FTK a seguito di una rapida cernita degli elementi il cui unico criterio è una GROUP BY MD5
     * senza considerare i path.
     */
    private function group_by_md5()
    {
        $res = $this->ModelTools->group_by_md5();
        //$this->genera_filtro_by_item($res);
        $this->Html->HTML_header();
        $this->HtmTools->XML_by_item_number($res);
        $this->Html->HTML_footer();

    }


    /**
     * Visualizza la pagina per generare il filtro XML per FTK contenente gli MD5 correntemente presenti nella tabella TOOLS nel DB
     */
    private function ftktools_md5_filter()
    {
        $filelist = $this->list_files("temp");
        $this->Html->HTML_header();
        $this->HtmTools->HTML_ftktools_md5_filter($filelist);
        $this->Html->HTML_footer();
    }

    /**
     * Genera un filtro XML per FTK contenente tutti gli MD5 correntemente presenti nella tabella TOOLS nel DB
     */
    private function GENERATE_md5_filter()
    {
        $this->Html->HTML_header();
        $res = $this->ModelTools->SELECT_from_tools();
        $this->HtmTools->XML_by_md5($res);
        $this->Html->HTML_footer();
    }

    /**
     * Genera un XML (filtro) per FTK contenente tutti gli ITEMS NUMBERS correntemente presenti nella tabella TOOLS nel DB
     */
    private function GENERATE_filter_by_items()
    {
        $res = $this->ModelTools->select_item_numbers();
        $this->Html->HTML_header();
        $this->HtmTools->XML_by_item_number_2($res);
        $this->Html->HTML_footer();

    }

}
