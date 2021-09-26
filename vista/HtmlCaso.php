<?php

/**
 * Class HtmlCaso
 * La classe si occupa delle funzioni di visualizzazione delle pagine relative ai casi (dossier)
 */
class HtmlCaso
{
    /**
     * Visualizza la pagina per aggiungere un nuovo caso nel DB
     */
    public function HTML_add_caso()
    {
        echo"<div class='container'><br>";
                if(isset($_SESSION["post_pm_id"]))
                {
                    if($_SESSION["cli_type"] == 'P') {
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Torna ai Dossier'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                      </form>
                      <br>";
                    }
                    if($_SESSION["cli_type"] == 'T') {
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Torna ai Dossier'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                      </form>
                      <br>";
                    }
                }
                echo"<center><img src='font/icon/dossier.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO DOSSIER</h6></center>

                <form action='index.php' method='post'>
                    <center>
                        <input type='text' class='form-control' id='ca_num' name='ca_num' style='width:40%' placeholder='Num. Procedimento'><br>
                        <input type='text' class='form-control' id='ca_inc' name='ca_inc' style='width:40%' placeholder='Incarico'><br>
                        <select required name='ca_tipo' class='form-control' style='width: 40%;'>
                            <option value=''>Tipo Investigazione</option>
                            <option value='Penale'>Penale</option>
                            <option value='Civile'>Civile</option>
                        </select><br>
                        <input type='text' class='form-control' id='ca_dss' name='ca_dss' style='width:40%' placeholder='Dss' title='Identificativo Hard Disk in cui sono conservate le copie forensi'><br>
                        <button type='submit' name='comando' value='insert_caso' style='height: auto;'>Salva</button>
                    </center>
                </form>
            </div>";
    }


    /**
     * @TODO: in fase di sviluppo. La funzione voleva essere utilizzata per stampare una pagina graficamente più gradevole
     *   nella visualizzazione dello status di un caso in cui viene restituita una pagina rappresentante l'istantanea di tutte
     *   le informazioni attualmente inserite in merito ad un dato caso.
     *   Non la elimino siccome può essere di spunto per futuri sviluppi.
     *
     */
    public function HTML_status_header(){
        echo"<html>
                <head>
                    <link rel='stylesheet' href='font/awesome407/css/font-awesome.min.css'>
                    <style>
                        body {background: white;}
                            p {color: black;}
                            table
                            {
                                border-collapse: collapse;
                            }
                            thead, tr, td, th, b
                            {
                                font-family: Arial;
                            }
                            pre{
                            word-wrap: break-word;
                            white-space: pre-line;
                            }
                            button{
                            background-color: transparent;
                            }
                    </style>
                </head>
            <body>";
    }

    /**
     * @TODO: in fase di sviluppo. La funzione voleva essere utilizzata per stampare una pagina graficamente più gradevole
     *   nella visualizzazione dello status di un caso in cui viene restituita una pagina rappresentante l'istantanea di tutte
     *   le informazioni attualmente inserite in merito ad un dato caso.
     *   Non la elimino siccome può essere di spunto per futuri sviluppi.
     *
     */
    public function HTML_status_caso($hoImg, $eviImg, $log)
    {
        echo "<div class='container'><br>";
        if(isset($_SESSION["post_pm_id"])){
            if($_SESSION['cli_type'] == 'P') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_pm' style='border: none;' title='Torna ai Casi'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'T') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_pm' style='border: none;' title='Torna ai Casi'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'C') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_pm' style='border: none;' title='Torna ai Casi'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
        }

        echo "<br><br>";
        echo $hoImg;
        echo "<br>";
        echo $eviImg;
        echo "<br>";
        echo $log;
        echo"</div>";
    }


    /**
     * Visualizza la pagina contenente i casi di un dato PM
     * @param $NomeProcura
     * @param $NomePm
     * @param $res
     */
    public function HTML_cases_of_pm($NomeProcura, $NomePm, $res)
    {
        echo "<div class=\"container\"><br>";

        //STAMPA I TASTI DI NAVIGAZIONE IN ALTO
        if(isset($_SESSION["post_cli_id"]))
        {
            if($_SESSION['cli_type'] == 'P')
            {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_procura' style='position: absolute; left: 0%; border: none;' title='Torna ai PM'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                       </form>";
            }
            if($_SESSION['cli_type'] == 'T')
            {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_tribunale' style='position: absolute; left: 0%; border: none;' title='Torna ai PM'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                       </form>";
            }
            if($_SESSION['cli_type'] == 'C')
            {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_ctp' style='position: absolute; left: 0%; border: none;' title='Torna ai PM'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                       </form>";
            }
        }
        //FINE STAMPA TASTI NAVIGAZIONE
        echo"<br>
             <br>
             <center><b>" . str_replace('Procura della Repubblica','',$NomeProcura) . " / </b>". $NomePm ."</center><br>
             <table class=\"u-full-width\">
                <thead style='color: #1188FF'>
                    <tr>
                        <th><img src='font/icon/dossier.png' height='60'></th>
                        <th>DOSSIER</th>
                        <th>TIPO</th>
                        <th>DSS</th>
                        <th>OPERAZIONI</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($res as $row)
        {
            echo "<tr>
                    <td>
                        <form action='index.php' method='post' target='_blank'>
                            <input type='hidden' id='ca_id' name='ca_id'  value=" . $row['ca_id'] . ">
                            <button type='submit' name='comando' value='copertina' title='Genera Copertina' style='border:none; padding:0px 4px;'><img src='font/icon/copertina.png' height='25'></button>
                            <button type='submit' name='comando' value='infocaso' title='Visualizza Info sul caso' style='border:none; padding:0px 4px;'><img src='font/icon/info.png' height='25'></button>
                            <button type='submit' name='comando' value='docx' title='Genera Bozza Consulenza Informatica' style='border:none; padding:0px 4px;'><img src='font/icon/docx.png' height='25'></button>
                        </form>
                    </td>
                    <td><label title='Incarico: ". $row['ca_inc'] ."'>" . $row['ca_num'] . "</label></td>
                    <td>" . $row['ca_tipo'] . "</td>
                    <td>". $row['ca_dss'] ."</td>
                    <td>
                        <form action='index.php'  method='post'>
                            <input type='hidden' id='ca_id' name='ca_id'  value=" . $row['ca_id'] . ">
                            <button type='submit' name='comando' value='view_caso' title='Visualizza Indagati del Caso' style='border:none; padding:0px 7px;'><i class='fa fa-chevron-right fa-2x' aria-hidden='true'></i></button>
                            <button type='submit' name='comando' value='edit_caso' title='Modifica Caso' style='border:none; padding:0px 7px;'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button>
                            <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Caso' name='comando' value='delete_caso' style='border:hidden; padding:0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                        </form>
                    </td>
                  </tr>";
        }
        echo"</tbody>
             </table>
             <form action='index.php' method='post'>
                <button type='submit' name='comando' value='page_add_caso' title='Aggiungi un Caso' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
             </form>
             </div>";
    }


    /**
     * Visualizza la pagina contenente i casi di una CTP
     * @param $NomeStudio
     * @param $NomeAvv
     * @param $res
     */
    public function HTML_cases_of_ctp($NomeStudio, $NomeAvv, $res)
    {
        echo "<div class=\"container\"><br>";
        if(isset($_SESSION["post_cli_id"]))
        {
            if($_SESSION['cli_type'] == 'P') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_procura' style='position: absolute; left: 0%; border: none;' title='Torna ai PM'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'T') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_procura' style='position: absolute; left: 0%; border: none;' title='Torna ai PM'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'C') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='return_to_procura' style='position: absolute; left: 0%; border: none;' title='Torna ai PM'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
        }

        echo"<br>
                         <br>
                         <center><b> $NomeStudio / </b> $NomeAvv </center><br>

                    <table class=\"u-full-width\">
                        <thead style='color: #1188FF'>
                            <tr>
                                <th><img src='font/icon/dossier.png' height='60'></th>
                                <th>DOSSIER</th>
                                <th>TIPO</th>
                                <th>DSS</th>
                                <!--th>Pm</th-->
                                <!--th>Procura</th-->
                                <th>OPERAZIONI</th>
                            </tr>
                        </thead>
                    <tbody>";

        foreach ($res as $row) {
            echo "<tr>
                                    <td>
                                    <form action='index.php' method='post' target='_blank'>
                                    <input type='hidden' id='ca_id' name='ca_id'  value=" . $row['ca_id'] . ">
                                        <button type='submit' name='comando' value='copertinaCtp' title='Genera Copertina Ctp' style='border:none; padding:0px 4px;'><img src='font/icon/copertina.png' height='25'></button>
                                    </form>
                                    </td>
                                    <td>" . $row['ca_num'] . "</td>
                                    <td>" . $row['ca_tipo'] . "</td>
                                    <td>". $row['ca_dss'] ."</td>
                                    <td>
                                    <form action='index.php'  method='post'>
                                        <input type='hidden' id='ca_id' name='ca_id'  value=" . $row['ca_id'] . ">
                                        <button type='submit' name='comando' value='view_caso' title='Visualizza Indagati del Caso' style='border:none; padding:0px 7px;'><i class='fa fa-chevron-right fa-2x' aria-hidden='true'></i></button>
                                        <button type='submit' name='comando' value='edit_caso' title='Modifica Caso' style='border:none; padding:0px 7px;'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button>
                                        <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Caso' name='comando' value='delete_caso' style='border:hidden; padding:0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </td>
                                </tr>";
        }
        echo"
            </tbody>

        </table>
        <form action='index.php' method='post'>
                        <button type='submit' name='comando' value='page_add_caso' title='Aggiungi un Caso' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                    </form>
      </div>";
    }


    /**
     * Visualizza i casi a seguito di una ricerca tramite pagina di ricerca
     * @param $CasiArr
     */
    public function HTML_casi_by_ricerca($CasiArr)
    {
        echo "<div class=\"container\"><br>";
        if($_SESSION['cli_type'] == 'P') {
            echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='ricerca' style='position: absolute; left: 0%; border: none;' title='Torna alla ricerca'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
        }
        if($_SESSION['cli_type'] == 'T') {
            echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
        }
        if($_SESSION['cli_type'] == 'C') {
            echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
        }
                echo"<br><br>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th><img src='font/icon/dossier.png' height='60'></th>
                            <th>DOSSIER</th>
                            <th>TIPO</th>
                            <th>DSS</th>
                            <th>OPERAZIONI</th>
                        </tr>
                    </thead>
                <tbody>";

            foreach ($CasiArr as $row) {
                echo "<form action='index.php'  method='post'>
                                <tr>
                                    <td><input type='hidden' id='ca_id' name='ca_id'  value=" . $row['ca_id'] . "></td>
                                    <td>" . $row['ca_num'] . "</td>
                                    <td>" . $row['ca_tipo'] . "</td>
                                    <td>". $row['ca_dss'] ."</td>
                                    <td>
                                        <button type='submit' name='comando' value='view_caso' title='Visualizza Indagati del Caso' style='border:none; width:5px;'><i class='fa fa-chevron-right fa-2x' aria-hidden='true'></i></button>
                                        <button type='submit' name='comando' value='edit_caso' title='Modifica Caso' style='border:none; width:5px;'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button>
                                        <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Caso' name='comando' value='delete_caso' style='border:hidden;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                                    </td>
                                </tr>
                            </form>";
            }
        echo"
            </tbody>

        </table>
        <form action='index.php' method='post'>
                        <button type='submit' name='comando' value='page_add_caso' title='Aggiungi un Caso' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                    </form>
      </div>";
    }


    /**
     * Visualizza la pagina che permette di editare le info di un caso
     * @param int $id: id del caso
     * @param string $num: numero del caso (ES: 123/2020)
     * @param string $inc: informazioni in merito all'incarico (data / numero incarico)
     * @param string $tipo: tipologia di caso
     * @param string $dss: identificativo dell'hard disk in cui è conservato il caso
     */
    public function HTML_edit_caso($id, $num, $inc, $tipo, $dss)
    {
        echo"<div class='container'><br>";
                    if(isset($_SESSION["post_pm_id"]))
                        {
                            if($_SESSION['cli_type'] == 'P') {
                                echo "<form action='index.php' method='post' style='display: inline;' >
                                    <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Torna ai Dossier'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>";
                            }
                            if($_SESSION['cli_type'] == 'T') {
                                echo "<form action='index.php' method='post' style='display: inline;' >
                                    <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Torna ai Dossier'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>";
                            }
                            if($_SESSION['cli_type'] == 'C') {
                                echo "<form action='index.php' method='post' style='display: inline;' >
                                    <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Torna ai Dossier'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>";
                            }
                        }
               echo"<br><br><center><img src='font/icon/dossier.png' height='40'><h6 class='docs-header'>MODIFICA DOSSIER</h6></center>
                    <form action='index.php' method='post' enctype=\"multipart/form-data\">
                        <div class='form-group'>
                            <center>
                            <input type='hidden' class='form-control' id='ca_id' name='ca_id' style='width:40%' value=$id><br>
                            <input type='text' class='form-control' id='ca_num' name='ca_num' style='width:40%' value='$num' placeholder='Num. Caso'><br>
                            <input type='text' class='form-control' id='ca_inc' name='ca_inc' style='width:40%' value='$inc' placeholder='Incarico'><br>
                            <select required name='ca_tipo' class='form-control' style='width: 40%;'>
                                <option value='$tipo'>$tipo</option>";
                                    if($tipo == 'Penale'){echo"<option value='Civile'>Civile</option>";}
                                        if($tipo == 'Civile'){echo"<option value='Penale'>Penale</option>";}
                            echo"
                            </select><br>
                            <input type='text' class='form-control' id='ca_dss' name='ca_dss' style='width:40%' value='$dss' placeholder='Dss'><br>
                            <button type='submit' name='comando' value='update_caso' style='height: auto;'>SALVA</button>
                            </center>
                        </div>
                    </form>
            </div>";
    }


    /**
     * Visualizza l'intestazione della copertina di un caso
     * @param $ca_num
     */
    public function HTML_REPORT_header_copertina($ca_num){
        echo"<html>
            <head>
                <title>$ca_num</title>
                <style>
        body {background: white;}
                        p {color: black;}
                            table
                            {
                                width: 695px;
                                border-collapse: collapse;
                            }
                            thead, tr, td, th, b
                            {
                                font-family: Arial;
                            }
                            pre{
                            word-wrap: break-word;
                            white-space: pre-line;
                            width: 680px;
                            }

                </style>
            </head>
        <body>";
    }


    /**
     * Visualizza la copertina del caso la quale è possibile salvare in PDF tramite le funzioni del browser (consigliato FIREFOX)
     * @param $ca_num
     * @param $ca_inc
     * @param $ca_tipo
     * @param $procura
     * @param $pm_titolo
     * @param $pm_nome
     * @param $pm_cognome
     * @param $rsoc
     * @param $ctu
     * @param $indi
     * @param $cap
     * @param $citta
     * @param $tele
     * @param $cell
     * @param $fax
     * @param $mail
     * @param $piva
     * @param $rea
     */
    public function HTML_REPORT_copertinaDIM($ca_num, $ca_inc, $ca_tipo, $procura, $pm_titolo, $pm_nome, $pm_cognome, $rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea)
    {
        echo"<div class='content'>
                <div style='position: absolute; left: 10px;'><img src='./images/logo.png' height='75px'></div>
             </div>
             <br>
			 <br>
			 <br>
			 <br>
			 <br>
             <center><div style='font-family: Calibri; font-size: 22pt;'>Procedimento $ca_tipo<br>Nr. $ca_num R.G.N.R.</div></center>
             <br>
			 <br>
			 <br>
             <center><div style='font-family: Cambria; font-size: 38pt; width: 600px;'>Procura della Repubblica<br>presso<br>il ". str_replace('Procura della Repubblica', '', $procura)."</div></center>
             <br>
             <hr>
             <br>
			 <center><div style='font-family: Cambria; font-size: 30pt;'>Allegato Nr. 01</div></center>
			 <center><div style='font-family: Cambria; font-size: 30pt;'>-</div></center>
             <center><div style='font-family: Cambria; font-size: 30pt;'>Computer Forensic Case Manager</div></center>
             <br><br>
             <center><div style='font-family: Cambria; font-size: 18pt;'>Pubblico Ministero<br>$pm_titolo $pm_nome $pm_cognome</div></center>
             <br><br>
             <center><div style='font-family: Cambria; font-size: 18pt;'>Consulente Tecnico del PM<br>$ctu</div></center>
             <center>
                <div style='font-family: Monaco; position: fixed; left: 19%; bottom: 0px; font-size: 10pt;'>
                    $rsoc
                    <br>
                    $indi - $cap $citta
                    <br>
                    Tel. $tele - $cell - Fax $fax
                    <br>
                    $mail
                    <br>
                    P.iva $piva – Iscritto presso la C.C.I.A.A. di $citta – Nr. REA $rea
                </div>
             </center>
             ";
    }



    /**
     * Visualizza la pagina di ricerca con in più il messaggio che non ha trovato nessun PM corrispondente alla stringa utilizzata
     */
    public function HTML_ricerca_caso_not_found()
     {
          echo"<br><br>
                <center>
                    <form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='menu_procure' style='border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                    </form><br><br>
                    <form action='index.php' method='post'>
                        <input type='text' align='center' id='ric' name='ric' placeholder='Ricerca Cliente' style='width: 200px;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_pro' title='Ricerca Procura'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>

                    <form action='index.php' method='post'>
                        <input type='text' align='center' id='ric' name='ric' placeholder='Cognome del PM' style='width: 200px;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_pm' title='Ricerca Pm'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>
                
                    <form action='index.php' method='post'>
                        <input type='text' align='center' id='ric' name='ric' placeholder='Caso non trovato' style='width: 200px; color: red; border-color: red;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_caso' title='Ricerca Caso'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>
                    
                    <form action='index.php' method='post'>
                        <input type='text' align='center' id='ric' name='ric' placeholder='Modello Host' style='width: 200px;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_host' title='Ricerca Host'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>
                </center>";
     }

}
