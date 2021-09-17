<?php

/**
 * Class HtmlTools
 * La classe si occupa delle funzioni di visualizzazione relative ai Tools di supporto ad FTK e cellebrite ufed reader
 */
class HtmlTools
{
    /**
     * Visualizza la pagina dei tools di supporto al lavoro con FTK
     */
    public function HTML_ftktools()
    {
        echo"<div class='container'><br>";

                if($_SESSION['cli_type'] == 'P'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }

            echo"<center><b>FTK Tools</b></center><br>
                 <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Tool</th>
                            <th>DESCRIZIONE</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action='index.php' method='post'>
                        <tr>
                            <td><button name='comando' value='ftktools_groupby_md5' style='border: none;'><img src='font/icon/md5.png' height='40px'>GROUP BY MD5</button></td>
                            <td>Esegue una group by md5 per fare una rapida cernita dei files doppioni e genera un filtro xml per FTK</td>
                            <!--td><img src='font/icon/info.png' title='1 STEP: Questo script crea un filtro xml senza doppioni importabile in FTK. Proseguire esportando da FTK un FileList contenente ITEM NUMBER e MD5' height='35px' alt='Info'></td>
                            <td><button name='comando' value='import_data_1' style='border: none;'><img src='font/icon/import.png' title='2 STEP: Dopo aver copiato il FileList.txt nella cartella \temp\ di CFCM, clicca quì per importarlo nel Database.' height='35px' alt='Import'></button></td>
                            <td><button name='comando' value='group_by_md5' style='border: none;'><img src='font/icon/play.png' title='3 STEP: Crea il filtro importabile in FTK che puoi scaricare dal browser (save as..)' height='35px' alt='Play'></button></td-->

                        </tr>
                        <tr>
                            <td><button name='comando' value='ftktools_md5_filter' style='border: none;'><img src='font/icon/md5.png' height='40px'>GENERA FILTRO PER MD5</button></td>
                            <td>Genera un filtro per MD5 di tutti gli elementi presenti nel DB in formato XML ed importabile in FTK. Non elimina doppioni ma genera solamente il filtro.</td>
                            <!--td><img src='font/icon/info.png' title='1 STEP: Questo script crea un filtro xml per MD5 contenente tutti gli elementi presenti nel DB.' height='35px' alt='Info'></td>
                            <td><button name='comando' value='import_data_1' style='border: none;' disabled><img src='font/icon/import.png' height='35px' alt='Import'></button></td>
                            <td><button name='comando' value='group_by_md5' style='border: none;'><img src='font/icon/play.png' title='3 STEP: Crea il filtro importabile in FTK che puoi scaricare dal browser (save as..)' height='35px' alt='Play'></button></td-->

                        </tr>   
                            
                        <tr>
                            <td><button name='comando' value='ftktool_item' style='border: none;'><img src='font/icon/itemnumber.png' height='40px'></button></td>
                            <td>Genera un filtro per ITEM NMBER di tutti gli elementi presenti nel DB in formato XML ed importabile in FTK. Non elimina doppioni ma genera solamente il filtro.</td>
                            <!--td><img src='font/icon/info.png' title='1 STEP: Esporta da FTK un FileList contenente gli ITEM NUMBER di interesse' height='35px'></td>
                            <td><button name='comando' value='import_data_2' style='border: none;'><img src='font/icon/import.png' title='2 STEP: Dopo aver copiato il FileList.txt nella cartella \temp\ di CFCM, clicca quì per importarlo nel Database.' height='35px'></button></td>
                            <td><button name='comando' value='create_filter_2' style='border: none;'><img src='font/icon/play.png' title='3 STEP: Crea il filtro importabile in FTK che puoi scaricare dal browser (save as..)' height='35px'></button></td-->

                        </tr>
                            
                        <tr>
                            <td><button name='comando' value='ftktool_shortpath' style='border: none;'><img src='font/icon/shortpath.png' height='45px'></button></td>
                            <td>La funzione fà una cernita di doppioni degli elementi. Tra gli elementi (files) Carved elimina quelli con path più corto, mentre tra gli elementi residenti elimina quelli con path più lungo mantenendo quelli con path più corto. Infine genera un filtro XML importabile in FTK.</td>
                        </tr>
                        <tr>
                            <td><button name='comando' value='ftktool_longpath' style='border: none;'><img src='font/icon/longpath.png' height='45px'></button></td>
                            <td>La funzione fà una cernita di doppioni degli elementi. Sia tra i Carved che tra i Residenti elimina gli elementi con path più corto. Infine genera un filtro XML importabile in FTK.</td>
                        </tr>
                        <tr>
                            <td><button name='comando' value='ftktools_email' style='border: none;'><img src='font/icon/postaelettronica.png' height='40px'></button><p style='color: red;'>IN FASE DI SVILUPPO</p></td>
                            <td></td>
                            
                            <!--td><img src='font/icon/info.png' title='1 STEP: Questo script crea un filtro xml senza doppioni dando priorità ai files residenti con path più corto. Proseguire esportando da FTK un FileList contenente ITEM NUMBER, PATH e MD5' height='35px'></td>
                            <td><button name='comando' value='#' style='border: none;'><img src='font/icon/import.png' title='2 STEP: Dopo aver copiato il FileList.txt nella cartella \temp\ di CFCM, clicca quì per importarlo nel Database.' height='35px'></button></td>
                            <td><button name='comando' value='#' style='border: none;'><img src='font/icon/play.png' title='3 STEP: Crea il filtro importabile in FTK che puoi scaricare dal browser (save as..)' height='35px'></button></td-->

                        </tr>         
                        <!--tr>
                            <td>2:  SELECT SHORTEST PATH FOR EACH MD5</td>
                            <td><img src='font/icon/info.png' title='FIRST STEP: Export from FTK a FileList with ITEM NUMBER, PATH and MD5.' height='35px'></td>
                            <td><button name='comando' value='import_data_1' style='border: none;'><img src='font/icon/import.png' title='SECOND STEP: After copying FileList.txt into shared folder \"temp\" of CFCM, click here for import it into Database.' height='35px'></button></td>
                            <td><button name='comando' value='import_data_1' style='border: none;'><img src='font/icon/play.png' title='THIRD STEP: This script execute Group By MD5 and create a FTK filter you can download from browser (save as..)' height='35px'></button></td>


                        </tr-->
                    </form>
                    </tbody>
                </div>";
    }


    /**
     * Visualizza la pagina dei tools di supporto a cellebrite ufed reader
     */
    public function HTML_ufedtools()
    {
        echo"
            <div class='container'><br>
            <form action='index.php' method='post'>
                <button name='comando' value='menu_procure' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>
            <center><b>UFED Tools</b></center><br>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Tool</th>
                            <th>Descrizione</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action='index.php' method='post'>
                        <!--tr>
                            <td><button name='comando' value='ufed_chat_facebook' style='border: none;'><i class='fa fa-facebook fa-3x' aria-hidden='true'></button></td>
                            <td>Il tool permette di generare una chat con le stesse caratteristiche grafiche delle chat presenti nell'ufed reader ma ripulite dalle informazioni ridondanti. <br> 
                                Apporta quindi vantaggi in termini di tempo in fase di montaggio grafico delle conversazioni nella consulenza</td>
                        </tr-->
                        <tr>
                            <td><button name='comando' value='ufedtools_chat_whatsapp' style='border: none;'><i class='fa fa-whatsapp fa-3x' aria-hidden='true'></button></td>
                            <td>Il tool permette di generare una chat con le stesse caratteristiche grafiche delle chat presenti nell'ufed reader ma ripulite dalle informazioni ridondanti. <br> 
                                Apporta vantaggi in termini di tempo in fase di montaggio grafico delle conversazioni nella consulenza</td>
                        </tr>
                        <!--tr>
                            <td><button name='comando' value='ufed_chat_instagram' style='border: none;'><i class='fa fa-instagram fa-3x' aria-hidden='true'></button></td>
                            <td>Il tool permette di generare una chat con le stesse caratteristiche grafiche delle chat presenti nell'ufed reader ma ripulite dalle informazioni ridondanti. <br> 
                                Apporta quindi vantaggi in termini di tempo in fase di montaggio grafico delle conversazioni nella consulenza</td>
                        </tr-->
                    </form>
                    </tbody>
                </div>";
    }


    /**
     * Visualizza la pagina del tool specifico per le chat WhatsApp esportate in xls da ufed reader
     * @param $dirs
     */
    public function HTML_ufedtools_whatsapp($dirs)
    {
        echo"
            <div class='container'>
                <br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ufedtools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>
                <i class='fa fa-whatsapp fa-4x' aria-hidden='true'></i>
                <br><br>
                <h6 class='docs-header'>UTILIZZANDO UFED READER ESPORTA LA CHAT, IN FORMATO EXCEL, NELLA CARTELLA CONDIVISA UFEDTOOLS</h6>                
                <img src='images/ufed_excel.png' style='border: 1px solid; height: 200px;'>
                <img src='images/ufedtools_shared.png' style='border: 1px solid; height: 200px;'>
                <br>
                <h6 class='docs-header'>PRIMA DI LANCIARE LA GENERAZIONE DELLA CHAT ASSICURARSI CHE NEL RAPPORTO XLSX SIANO PRESENTI SOLAMENTE LE SEGUENTI COLONNE:</h6>
                <img src='images/pattern.png' style='border: 1px solid;'>
                <hr>
                <h6 class='docs-header'>GENERA UNA CHAT</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Chat Directory</th>
                            <th>Genera Chat</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($dirs as $row){
                            echo"
                            <form action='index.php' method='post' target='_blank'>
                                <tr>
                                    <td><input type='text' id='chat_path' name='chat_path' value='$row/' style='width: 200px;'></td>
                                    <td><button name='comando' value='ufedtools_gen_chat' style='border: none;'><img src='font/icon/chat.png' title='genera chat' height='30px'></button></td>
                                </tr>
                            </form>";
                        }

                    echo"
                    </tbody>
                    </table>
            </div>";

    }


    /**
     * Visualizza la pagina del tool group_by_md5
     * @param $filelist
     */
    public function HTML_ftktools_group_by_md5($filelist)
    {
        echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>
                <img src='font/icon/md5.png' height='80px'>
                <br><br>
                <h6 class='docs-header'>DESCRIZIONE</h6>
                <p>Questo tool esegue una group by md5 per fare una rapida cernita dei files doppioni</p>
                <b>Pre-requisiti</b><br>
                <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item number, path, md5</b></p>
                <br>
                <hr>
                <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
                <form enctype='multipart/form-data' action='index.php' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                    <input name='userfile' type='file' />
                    <button name='comando' value='upload_filelist' style='height: 35px;'>UPLOAD</button>
                </form>
                <br><hr>
                <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
                <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                            <form action='index.php' method='post'>
                                <tr>
                                    <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                    <td><button name='comando' value='import_data_1' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                    <button name='comando' value='group_by_md5' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                </tr>
                            </form>";
                        }

                    echo"
                    </tbody>
                    </table>
            </div>";
    }




    /**
     * Visualizza la pagina del tool group_by_md5
     * @param $filelist
     */
    public function HTML_ftktools_group_by_md5_import_OK($filelist)
    {
        echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>
                <table>
                    <th style='border: none'><img src='font/icon/md5_green.png' height='80px'></th>
                    <th style='border: none'><h5 style='color: green;'>Importazione completata correttamente</h5></th>
                </table>
                <h6 class='docs-header'>DESCRIZIONE</h6>
                <p>Questo tool esegue una group by md5 per fare una rapida cernita dei files doppioni</p>
                <b>Pre-requisiti</b><br>
                <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item number, path, md5</b></p>
                <br>
                <hr>
                <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
                <form enctype='multipart/form-data' action='index.php' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                    <input name='userfile' type='file' />
                    <button name='comando' value='upload_filelist' style='height: 35px;'>UPLOAD</button>
                </form>
                <br><hr>
                <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
                <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                            <form action='index.php' method='post'>
                                <tr>
                                <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                    <td><button name='comando' value='import_data_1' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                    <button name='comando' value='group_by_md5' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                </tr>
                            </form>";
                        }

                    echo"
                    </tbody>
                    </table>
            </div>";
    }




    /**
     * Visualizza la pagina del tool md5_filter
     * @param $filelist
     */
    public function HTML_ftktools_md5_filter($filelist)
    {
        echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>
                <img src='font/icon/md5.png' height='80px'>
                <br><br>
                <h6 class='docs-header'>DESCRIZIONE</h6>
                <p>Genera un XML per FTK contenente tutti gli MD5 correntemente presenti nella tabella TOOLS (nel DB)</p>
                <b>Pre-requisiti</b><br>
                <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item number, path, md5</b></p>
                <br>
                <hr>
                <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
                <form enctype='multipart/form-data' action='index.php' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                    <input name='userfile' type='file' />
                    <button name='comando' value='UPLOAD_filelist_md5_filter' style='height: 35px;'>UPLOAD</button>
                </form>
                <br><hr>
                <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
                <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                            <form action='index.php' method='post'>
                                <tr>
                                    <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                    <td><button name='comando' value='import_data_2' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                    <button name='comando' value='GENERATE_md5_filter' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                </tr>
                            </form>";
                        }

                    echo"
                    </tbody>
                    </table>
            </div>";
    }



    /**
     * Visualizza la pagina del tool md5_filter
     * @param $filelist
     */
    public function HTML_ftktools_md5_filter_import_OK($filelist)
    {
        echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br>
                <br>
                <table>
                    <th style='border: none'><img src='font/icon/md5_green.png' height='80px'></th>
                    <th style='border: none'><h5 style='color: green'>Importazione completata con successo</h5></th>
                </table>
                <h6 class='docs-header'>DESCRIZIONE</h6>
                <p>Genera un XML per FTK contenente tutti gli MD5 correntemente presenti nella tabella TOOLS (nel DB)</p>
                <b>Pre-requisiti</b><br>
                <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item number, path, md5</b></p>
                <br>
                <hr>
                <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
                <form enctype='multipart/form-data' action='index.php' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                    <input name='userfile' type='file' />
                    <button name='comando' value='UPLOAD_filelist_md5_filter' style='height: 35px;'>UPLOAD</button>
                </form>
                <br><hr>
                <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
                <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                            <form action='index.php' method='post'>
                                <tr>
                                    <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                    <td><button name='comando' value='import_data_2' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                    <button name='comando' value='GENERATE_md5_filter' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                </tr>
                            </form>";
                        }

                    echo"
                    </tbody>
                    </table>
            </div>";
    }


    /**
     * Visualizza la pagina del tool ftktool_shortpath
     * @param $filelist
     */
    public function HTML_ftktool_shortpath($filelist)
    {
         echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
            <br><br>
            <img src='font/icon/shortpath.png' height='80px'>
            <br><br>
            <hr>
            <h6 class='docs-header'>DESCRIZIONE</h6>
            <p>Questo tool esegue una cernita dei files duplicati scegliendo il file con il path più corto. Si basa sui seguenti valori: <b>MD5 e Path</b></p>
            <b>Pre-requisiti</b><br>
            <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item, Path, MD5</b></p>
            <br>
            <hr>
            <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
            <form enctype='multipart/form-data' action='index.php' method='POST'>
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input name='userfile' type='file' />
                <button name='comando' value='UPLOAD_shortpath_filelist' style='height: 35px;'>UPLOAD</button>
            </form>
            <br><hr>
            <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
            <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                                <form action='index.php' method='post'>
                                    <tr>
                                        <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                        <td><button name='comando' value='import_data_4' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                        <button name='comando' value='GENERATE_shortpath_filter' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                    </tr>
                                </form>";
                        }
                    echo"
                    </tbody>
                </table>
            </div>";
    }



    /**
     * Visualizza la pagina del tool ftktool_shortpath
     * @param $filelist
     */
    public function HTML_ftktool_shortpath_import_OK($filelist)
    {
         echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
            <br>
            <br>
            <table>
                <th style='border: none'><img src='font/icon/shortpath_green.png' height='80px'></th>
                <th style='border: none'><h5 style='color: green'>Importazione completata</h5></th>
            </table>
            <hr>
            <h6 class='docs-header'>DESCRIZIONE</h6>
            <p>Questo tool esegue una cernita dei files duplicati scegliendo il file con il path più corto. Si basa sui seguenti valori: <b>MD5 e Path</b></p>
            <b>Pre-requisiti</b><br>
            <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item, Path, MD5</b></p>
            <br>
            <hr>
            <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
            <form enctype='multipart/form-data' action='index.php' method='POST'>
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input name='userfile' type='file' />
                <button name='comando' value='UPLOAD_shortpath_filelist' style='height: 35px;'>UPLOAD</button>
            </form>
            <br><hr>
            <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
            <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                                <form action='index.php' method='post'>
                                    <tr>
                                        <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                        <td><button name='comando' value='import_data_4' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                        <button name='comando' value='GENERATE_shortpath_filter' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                    </tr>
                                </form>";
                        }
                    echo"
                    </tbody>
                </table>
            </div>";
    }



    /**
     * Visualizza la pagina del tool ftktool_longpath
     * @param $filelist
     */
    public function HTML_ftktool_longpath($filelist)
    {
         echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
            <br><br>
            <img src='font/icon/longpath.png' height='80px'>
            <br><br>
            <hr>
            <h6 class='docs-header'>DESCRIZIONE</h6>
            <p>Questo tool esegue una cernita dei files duplicati scegliendo il file con il path più lungo. Si basa sui seguenti valori: <b>MD5 e Path</b></p>
            <b>Pre-requisiti</b><br>
            <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item, Path, MD5</b></p>
            <br>
            <hr>
            <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
            <form enctype='multipart/form-data' action='index.php' method='POST'>
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input name='userfile' type='file' />
                <button name='comando' value='UPLOAD_longpath_filelist' style='height: 35px;'>UPLOAD</button>
            </form>
            <br><hr>
            <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
            <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                                <form action='index.php' method='post'>
                                    <tr>
                                        <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                        <td><button name='comando' value='import_data_5' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                        <button name='comando' value='GENERATE_longpath_filter' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                    </tr>
                                </form>";
                        }
                    echo"
                    </tbody>
                </table>
            </div>";
    }



    /**
     * Visualizza la pagina del tool ftktool_longpath
     * @param $filelist
     */
    public function HTML_ftktool_longpath_import_OK($filelist)
    {
         echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
            <br><br>
            <table>
                <th style='border: none'><img src='font/icon/longpath_green.png' height='80px'></th>
                <th style='border: none'><h5 style='color: green'>Importazione Completata</h5></th>
            </table>
            <hr>
            <h6 class='docs-header'>DESCRIZIONE</h6>
            <p>Questo tool esegue una cernita dei files duplicati scegliendo il file con il path più lungo. Si basa sui seguenti valori: <b>MD5 e Path</b></p>
            <b>Pre-requisiti</b><br>
            <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item, Path, MD5</b></p>
            <br>
            <hr>
            <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
            <form enctype='multipart/form-data' action='index.php' method='POST'>
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input name='userfile' type='file' />
                <button name='comando' value='UPLOAD_longpath_filelist' style='height: 35px;'>UPLOAD</button>
            </form>
            <br><hr>
            <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
            <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                                <form action='index.php' method='post'>
                                    <tr>
                                        <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                        <td><button name='comando' value='import_data_5' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                        <button name='comando' value='GENERATE_longpath_filter' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                    </tr>
                                </form>";
                        }
                    echo"
                    </tbody>
                </table>
            </div>";
    }



    /**
     * Visualizza la pagina del tool ftktool_email
     * @param $filelist
     */
    public function HTML_ftktools_email($filelist)
    {
         echo"
            <div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
            <br><br>
            <img src='font/icon/postaelettronica.png' height='80px'>
            <br><br>
            <h6 class='docs-header'>DESCRIZIONE</h6>
            <p>Questo tool esegue una cernita delle email duplicate basandosi sui seguenti dati: <b>To, From, Submit, Delivery, Attachment, Psize, Lsize, Deleted</b></p>
            <b>Pre-requisiti</b><br>
            <p>Il filelist deve contenere le seguenti informazioni e nel seguente ordine: <b>Item, To, From, Submit, Delivery, Attachment, Psize, Lsize, Deleted</b></p>
            <br>
            <hr>
            <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
            <form enctype='multipart/form-data' action='index.php' method='POST'>
                <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                <input name='userfile' type='file' />
                <button name='comando' value='upload_filelist_emails' style='height: 35px;'>UPLOAD</button>
            </form>
            <br><hr>
            <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
            <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

                        foreach($filelist as $row){
                            if(($row == ".") || ($row == "..")){
                                continue;
                            }
                            echo"
                                <form action='index.php' method='post' target='_blank'>
                                    <tr>
                                        <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                        <td><button name='comando' value='ftktools_import_emails' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                        <button name='comando' value='GENERATE_email_filter' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                    </tr>
                                </form>";
                        }
                    echo"
                    </tbody>
                </table>
            </div>";
    }


    /**
     * Visualizza la pagina del tool ftktool_item
     * @param $filelist
     */
    public function HTML_ftktool_item($filelist)
    {
        echo"<div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                
                <br><br>
                
                <img src='font/icon/itemnumber.png' height='80px'>
                <br><br>
                <h6 class='docs-header'>DESCRIZIONE</h6>
                <p>Questo tool genera un filtro utilizzando tutti gli item number presenti nel Database al momento della generazione<b></b></p>
                <b>Pre-requisiti</b><br>
                <p>Il filelist deve contenere solamente il campo <b>item number</b> o in alternativa <b>item number, path, md5</b></p>
                <br>
                <hr>
                <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
                <form enctype='multipart/form-data' action='index.php' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                    <input name='userfile' type='file' />
                    <button name='comando' value='upload_filelist_items' style='height: 35px;'>UPLOAD</button>
                </form>
                <br><hr>
                
                <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
                <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

        foreach($filelist as $row){
            if(($row == ".") || ($row == "..")){
                continue;
            }
            echo"
                            <form action='index.php' method='post'>
                                <tr>
                                    <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                    <td><button name='comando' value='import_data_3' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                    <button name='comando' value='GENERATE_filter_by_items' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                </tr>
                            </form>";
        }

        echo"
                    </tbody>
                    </table>
            </div>";
    }


    /**
     * Visualizza la pagina del tool ftktool_item
     * @param $filelist
     */
    public function HTML_ftktool_item_import_OK($filelist)
    {
        echo"<div class='container'><br>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br>
                <br>
                <table>
                    <th style='border: none'><img src='font/icon/itemnumber_green.png' height='80px'></th>
                    <th style='border: none'><h5 style='color: green'>Importazione completata</h5></th>
                </table>
                <h6 class='docs-header'>DESCRIZIONE</h6>
                <p>Questo tool genera un filtro utilizzando tutti gli item number presenti nel Database al momento della generazione<b></b></p>
                <b>Pre-requisiti</b><br>
                <p>Il filelist deve contenere solamente il campo <b>item number</b> o in alternativa <b>item number, path, md5</b></p>
                <br>
                <hr>
                <h6 class='docs-header'>STEP 1:  CARICA IL Filelist.txt ESPORTATO CON FTK</h6>
                <form enctype='multipart/form-data' action='index.php' method='POST'>
                    <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
                    <input name='userfile' type='file' />
                    <button name='comando' value='upload_filelist_items' style='height: 35px;'>UPLOAD</button>
                </form>
                <br><hr>
                
                <h6 class='docs-header'>STEP 2:  IMPORTA IL FILE CLICCANDO IL TASTO IMPORTAZIONE CORRISPONDENTE AD ESSO</h6>
                <h6 class='docs-header'>STEP 3:  GENERA IL FILTRO CLICCANDO IL TASTO GENERAZIONE</h6>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th>Lista Files</th>
                            <th>Operazioni</th>
                        </tr>
                    </thead>
                    <tbody>";

        foreach($filelist as $row){
            if(($row == ".") || ($row == "..")){
                continue;
            }
            echo"
                            <form action='index.php' method='post'>
                                <tr>
                                    <td><input type='text' id='file_name' name='file_name' value='$row' style='width: 200px;'></td>
                                    <td><button name='comando' value='import_data_3' style='border: none;'><img src='font/icon/import.png' title='Importazione' height='30px'></button>
                                    <button name='comando' value='GENERATE_filter_by_items' style='border: none;'><img src='font/icon/play.png' title='Generazione' height='30px'></button></td>
                                </tr>
                            </form>";
        }

        echo"
                    </tbody>
                    </table>
            </div>";
    }




    /**
     * Visualizza nel browser una determinata chat WhatsApp, ricostruendola avente stesse caratteristiche grafiche della chat in ufed reader
     * ma senza diciture ridondanti causa di molti montaggi grafici prima di essere poi portata in consulenza (documento docx)
     * @param $ChatPath
     * @param $arrChat
     */
    public function HTML_chat($ChatPath, $arrChat)
    {
        echo"
            <div class='container' style='position: absolute; left: 100px; top: 20px; background-color: #f6f6f6;'>";

        //Prendo solo la prima riga che contiene il numero di messaggi
        foreach($arrChat as $row)
        {
            $numMsg = $row[1];
            break;
        }

        $numMsg = preg_replace('/[A-Z]+/', '', $numMsg);
        $numMsg = preg_replace('/[a-z]+/', '', $numMsg);
        echo"<div style='font-family: Calibri; font-size: 20px; height: 33px; position: relative; left: 30px;'><img src='icons/WhatsApp.PNG'> WhatsApp Chat $numMsg</div>";


        foreach($arrChat as $row){
        // Variabili

            $Da = $row[1];
            $Orien = $row[2];
            $Corpo = $row[3];
            $Orari = $row[4];
            $Alle1 = $row[5];
            $Alle2 = $row[6];
            $Elimi = $row[7];



            //$pathAudio = $ChatPath . "files/Audio/$Alle1";
            //$pathImage = $ChatPath . "files/Image/$Alle1";
            //$pathVideo = $ChatPath . "files/Video/$Alle1";

        // Pulisco
        $Da = str_replace("@s.whatsapp.net","", $Da);
        $Da = preg_replace('/[0-9]+/', '', $Da);
        if(($Orien == "Incoming")||($Orien == "In entrata"))
        {
            echo"
                <img src='icons/ricevuto.PNG' style='position: relative; left: 30px; top: 15px;'>
                    <div style='background-color: #1e91e1; width: 255px; padding: 10px; border-radius: 5px; position: relative; left: 60px; font-size: small; color: white;'>
                        <div style='background-color: #3ca0e5;'><b>$Da</b></div>
                        <b>". $Corpo ."</b>
             ";
            $this->print_allegati_ricevuti($ChatPath, $Alle1, $Alle2);
            if(($Elimi == 'Sì') || ($Elimi == 'Yes')){
                echo"<div style='position: relative; left: 0px;'><img src='icons/eliminato_b.PNG'>
                        <b style='position: relative; left: 65px'>". $Orari ."</b>
                            </div>";
            }
            else {
                echo"<div style='position: relative; left: 85px'><b>". $Orari ."</b></div>";
            }
            echo"    </div>";
        }

        else if (($Orien == "Outgoing")||($Orien == "In uscita"))
        {
            echo"
                <img src='icons/inviato.PNG' style='position: relative; left: 440px; top: 15px;'>
                <div style='background-color: #5cc23a; width: 255px; padding: 10px; border-radius: 5px; position: relative; left: 160px; font-size: small; color: white;'>
                    <div style='background-color: #72ca54'><b>$Da</b></div>
                        <b>" . $Corpo . "</b>
            ";
            $this->print_allegati_inviati($ChatPath, $Alle1, $Alle2);

            if(($Elimi == 'Sì') || ($Elimi == 'Yes')){
                echo"<div style='position: relative; left: 0px;'><img src='icons/eliminato_v.png'>
                                    <b style='position: relative; left: 65px'>". $Orari ."</b>
                                 </div>";
            }
            else {
                echo"<div style='position: relative; left: 85px'><b>". $Orari ."</b></div>";

            }


        echo"   </div>";
        }

        else if($Orien == "")
        {
            echo"
                <img src='icons/nonrilevato.PNG' style='position: relative; left: 30px; top: 15px;'>
                <div style='background-color: #c2bdbd; width: 255px; padding: 10px; border-radius: 5px; position: relative; left: 60px; font-size: small; color: white;'>
                    <div style='background-color: #cac6c6;'><b>$Da</b></div>
                        <b>" . $Corpo . "</b><br>
            ";
            $this->print_allegati_nonrilevati($ChatPath, $Alle1, $Alle2);

            if(($Elimi == 'Sì') || ($Elimi == 'Yes')){
                echo"<div style='position: relative; left: 0px;'><img src='icons/eliminato_g.png'>
                                    <b style='position: relative; left: 65px'>". $Orari ."</b>
                                 </div>";
            }
            else {
                echo"<div style='position: relative; left: 85px'><b>". $Orari ."</b></div>";

            }
            echo"</div>";
        }
    }
        echo"<br></div>";

    }



    public function print_allegati_ricevuti($ChatPath, $Alle1, $Alle2)
    {
        $pathAudio = $ChatPath."files/Audio/";
        $pathImage = $ChatPath."files/Image/";
        $pathVideo = $ChatPath."files/Video/";

        if($Alle1 != ''){
            if(strpos($Alle1, '.opus') == true){
                echo "<a href='$pathAudio$Alle1' target='_blank'><img src='icons/AudioRicevuto.PNG'></a><b>&nbsp$Alle1</b>";
                //echo "<audio controls><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'></audio>";
            }
            if(strpos($Alle1, '.jpg') == true){
                echo"<br><a href='$pathImage$Alle1' target='_blank'><img src='$pathImage$Alle1' width='30%' height='8%'></a>&nbsp<b>$Alle1</b>";
            }
            if(strpos($Alle1, '.mp4') == true){
                echo "<a href='$pathVideo$Alle1' target='_blank'><img src='icons/AudioRicevuto.PNG'></a><b>&nbsp$Alle1</b>";
            }
        }

        if($Alle2 != ''){
            if(strpos($Alle2, '.opus') == true){
                echo "<a href='$pathAudio$Alle2' target='_blank'><img src='icons/AudioRicevuto.PNG'></a><b>&nbsp$Alle2</b>";
                //echo "<audio controls><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'></audio>";
            }
            if(strpos($Alle2, '.jpg') == true){
                echo"<br><a href='$pathImage$Alle2' target='_blank'><img src='$pathImage$Alle2' width='30%' height='8%'></a>&nbsp<b>$Alle2</b>";
            }
            if(strpos($Alle2, '.mp4') == true){
                echo "<a href='$pathVideo$Alle2' target='_blank'><img src='icons/AudioRicevuto.PNG'></a><b>&nbsp$Alle2</b>";
            }
        }

    }

    public function print_allegati_inviati($ChatPath, $Alle1, $Alle2)
    {
        $pathAudio = $ChatPath."files/Audio/";
        $pathImage = $ChatPath."files/Image/";
        $pathVideo = $ChatPath."files/Video/";

        if($Alle1 != ''){
            if(strpos($Alle1, '.opus') == true){
                echo "<a href='$pathAudio$Alle1' target='_blank'><img src='icons/AudioInviato.PNG'></a><b>&nbsp$Alle1</b>";
                //echo "<audio controls><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'></audio>";
            }
            if(strpos($Alle1, '.jpg') == true){
                echo"<br><a href='$pathImage$Alle1' target='_blank'><img src='$pathImage$Alle1' width='30%' height='8%'></a>&nbsp<b>$Alle1</b>";
            }
            if(strpos($Alle1, '.mp4') == true){
                echo "<a href='$pathVideo$Alle1' target='_blank'><img src='icons/AudioInviato.PNG'></a><b>&nbsp$Alle1</b>";
            }
        }
        if($Alle2 != ''){
            if(strpos($Alle2, '.opus') == true){
                echo "<a href='$pathAudio$Alle2' target='_blank'><img src='icons/AudioInviato.PNG'></a><b>&nbsp$Alle2</b>";
                //echo "<audio controls><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'><source src='instant_messages/WhatsApp/1/". $nomefile."' type='audio/ogg; codecs=opus'></audio>";
            }
            if(strpos($Alle2, '.jpg') == true){
                echo"<br><a href='$pathImage$Alle2' target='_blank'><img src='$pathImage$Alle2' width='30%' height='8%'></a>&nbsp<b>$Alle2</b>";
            }
            if(strpos($Alle2, '.mp4') == true){
                echo "<a href='$pathVideo$Alle2' target='_blank'><img src='icons/AudioInviato.PNG'></a><b>&nbsp$Alle2</b>";
            }
        }

    }

    public function print_allegati_nonrilevati($ChatPath, $Alle1, $Alle2)
    {
        $pathAudio = $ChatPath."files/Audio/";
        $pathImage = $ChatPath."files/Image/";
        $pathVideo = $ChatPath."files/Video/";

        if($Alle1 != ''){
            if(strpos($Alle1, '.opus') == true){
                echo "<a href='$pathAudio$Alle1' target='_blank'><img src='icons/AudioNonRilevato.PNG'></a><b>&nbsp$Alle1</b>";
            }
            if(strpos($Alle1, '.jpg') == true){
                echo"<br><a href='$pathImage$Alle1' target='_blank'><img src='$pathImage$Alle1' width='30%' height='8%'></a>&nbsp<b>$Alle1</b>";
            }
            if(strpos($Alle1, '.mp4') == true){
                echo "<a href='$pathVideo$Alle1' target='_blank'><img src='icons/AudioNonRilevato.PNG'></a><b>&nbsp$Alle1</b>";
            }
        }
        if($Alle2 != ''){
            if(strpos($Alle2, '.opus') == true){
                echo "<a href='$pathAudio$Alle2' target='_blank'><img src='icons/AudioNonRilevato.PNG'></a><b>&nbsp$Alle2</b>";
            }
            if(strpos($Alle2, '.jpg') == true){
                echo"<br><a href='$pathImage$Alle2' target='_blank'><img src='$pathImage$Alle2' width='30%' height='8%'></a>&nbsp<b>$Alle2</b>";
            }
            if(strpos($Alle2, '.mp4') == true){
                echo "<a href='$pathVideo$Alle2' target='_blank'><img src='icons/AudioNonRilevato.PNG'></a><b>&nbsp$Alle2</b>";
            }
        }

    }





    /**
     * Stampa i tag xml idonei alla creazione di un filtro importabile in FTK.
     * Il criterio del filtro sarà l'MD5
     * @param $res
     */
    public function XML_by_md5($res)
        // Genera un Filtro per item number
    {
        // GENERO XML
        $myfile = fopen("0MD5.xml","w") or die ("unable to open file!");


        $i = 0;

        fwrite($myfile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?><exportedFilter xmlns=\"http://www.accessdata.com/ftk2/filters\"><filter name=\"0MD5\" matchCriterion=\"any\" id=\"f_1000718\" read_only=\"false\" description=\"\">");

        foreach($res as $row){
            $md5 = $row['md5'];

            fwrite($myfile, "<rule position=\"$i\" enabled=\"true\" id=\"a_9010\" operator=\"is\"><one_string value=\"$md5\"/></rule>");

            $i=$i+1;
        }


        fwrite($myfile, "</filter><attribute id=\"a_9010\" type=\"string\"><table>cmn_ObjectHashes</table><column>MD5</column></attribute></exportedFilter>");
        fclose($myfile);
        echo "<br>
              <div class='container'>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools_md5_filter' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br>
                <br><a href='0MD5.xml' target='_blank'>Download FTK Filter</a>
                </div>";

    }


    /**
     * Stampa i tag xml idonei alla creazione di un filtro importabile in FTK.
     * Il criterio del filtro sarà l' Item number
     * @param $res
     */
    public function XML_by_item_number($res)
    {
        // Genera un Filtro per item number
        // GENERO XML
        $myfile = fopen("0ITEM.xml","w") or die ("unable to open file!");


        $i = 0;

        fwrite($myfile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                         <exportedFilter xmlns=\"http://www.accessdata.com/ftk2/filters\"><filter name=\"0ITEM\" matchCriterion=\"any\" id=\"f_1000007\" read_only=\"false\" description=\"\">");

        foreach($res as $row){
            $item = $row['item'];

            fwrite($myfile, "<rule position=\"$i\" enabled=\"true\" id=\"a_9000\" operator=\"is\"><one_int value=\"$item\"/></rule>");

            $i=$i+1;
        }


        fwrite($myfile, "</filter><attribute id=\"a_9000\" type=\"int\"><table>cmn_Objects</table><column>ObjectID</column></attribute></exportedFilter>");
        fclose($myfile);
        echo "<br>
              <div class='container'>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktools_groupby_md5' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br>
                <br>
                <a href='0ITEM.xml' target='_blank'>Download FTK Filter</a>
              </div>";
    }




    /**
     * Stampa i tag xml idonei alla creazione di un filtro importabile in FTK.
     * Il criterio del filtro sarà l' Item number
     * @param $res
     */
    public function XML_by_item_number_2($res)
    {
        // Genera un Filtro per item number
        // GENERO XML
        $myfile = fopen("0ITEM.xml","w") or die ("unable to open file!");


        $i = 0;

        fwrite($myfile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                         <exportedFilter xmlns=\"http://www.accessdata.com/ftk2/filters\"><filter name=\"0ITEM\" matchCriterion=\"any\" id=\"f_1000007\" read_only=\"false\" description=\"\">");

        foreach($res as $row){
            $item = $row['item'];

            fwrite($myfile, "<rule position=\"$i\" enabled=\"true\" id=\"a_9000\" operator=\"is\"><one_int value=\"$item\"/></rule>");

            $i=$i+1;
        }


        fwrite($myfile, "</filter><attribute id=\"a_9000\" type=\"int\"><table>cmn_Objects</table><column>ObjectID</column></attribute></exportedFilter>");
        fclose($myfile);
        echo "<br>
              <div class='container'>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktool_item' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br>
                <br>
                <a href='0ITEM.xml' target='_blank'>Download FTK Filter</a>
              </div>";
    }



    /**
     * Stampa i tag xml idonei alla creazione di un filtro importabile in FTK.
     * Il criterio del filtro sarà l' Item number
     * @param $res
     */
    public function XML_by_item_number_3($res)
    {
        // Genera un Filtro per item number
        // GENERO XML
        $myfile = fopen("0ITEM.xml","w") or die ("unable to open file!");


        $i = 0;

        fwrite($myfile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                         <exportedFilter xmlns=\"http://www.accessdata.com/ftk2/filters\"><filter name=\"0ITEM\" matchCriterion=\"any\" id=\"f_1000007\" read_only=\"false\" description=\"\">");

        foreach($res as $row){
            $item = $row['item'];

            fwrite($myfile, "<rule position=\"$i\" enabled=\"true\" id=\"a_9000\" operator=\"is\"><one_int value=\"$item\"/></rule>");

            $i=$i+1;
        }


        fwrite($myfile, "</filter><attribute id=\"a_9000\" type=\"int\"><table>cmn_Objects</table><column>ObjectID</column></attribute></exportedFilter>");
        fclose($myfile);
        echo "<br>
              <div class='container'>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktool_shortpath' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br>
                <br>
                <a href='0ITEM.xml' target='_blank'>Download FTK Filter</a>
              </div>";
    }



    /**
     * Stampa i tag xml idonei alla creazione di un filtro importabile in FTK.
     * Il criterio del filtro sarà l' Item number
     * @param $res
     */
    public function XML_by_item_number_4($res)
    {
        // Genera un Filtro per item number
        // GENERO XML
        $myfile = fopen("0ITEM.xml","w") or die ("unable to open file!");


        $i = 0;

        fwrite($myfile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                         <exportedFilter xmlns=\"http://www.accessdata.com/ftk2/filters\"><filter name=\"0ITEM\" matchCriterion=\"any\" id=\"f_1000007\" read_only=\"false\" description=\"\">");

        foreach($res as $row){
            $item = $row['item'];

            fwrite($myfile, "<rule position=\"$i\" enabled=\"true\" id=\"a_9000\" operator=\"is\"><one_int value=\"$item\"/></rule>");

            $i=$i+1;
        }


        fwrite($myfile, "</filter><attribute id=\"a_9000\" type=\"int\"><table>cmn_Objects</table><column>ObjectID</column></attribute></exportedFilter>");
        fclose($myfile);
        echo "<br>
              <div class='container'>
                <form action='index.php' method='post'>
                    <button name='comando' value='ftktool_longpath' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br>
                <br>
                <a href='0ITEM.xml' target='_blank'>Download FTK Filter</a>
              </div>";
    }



}
