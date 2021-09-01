<?php


/**
 * Class HtmlIndagato
 * La classe si occupa delle operazioni di visualizzazione dei dati relativi agli indagati
 */
class HtmlIndagato
{
    private $StyleTdDetttaglio = "align='center' style='font-size: 8pt;'";
    private $StyleTdColTitle = "align='center' style='background: #003c78; color:white; font-family: Arial; font-size:9pt;'";
    /**
     * Visualizza la pagina contenente tutti gli indagati di un determinato caso
     * @param $Indagati
     * @param $NumCaso
     * @param $NomePm
     * @param $NomeProcura
     */
    public function HTML_indagati_of_caso($Indagati, $NumCaso, $NomePm, $NomeProcura)
    {
        echo"
        <div class=\"container\"><br>";
        if(isset($_SESSION["post_pm_id"]))
        {
            if($_SESSION['cli_type'] == 'P') {
                echo "<form action='index.php' method='post'>
                    <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Visualizza i Casi del Pm corrente'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                  </form>
                  <br><br>";
            }
            if($_SESSION['cli_type'] == 'T') {
                echo "<form action='index.php' method='post'>
                    <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Visualizza i Casi del Pm corrente'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                  </form>
                  <br><br>";
            }
            if($_SESSION['cli_type'] == 'C') {
                echo "<form action='index.php' method='post'>
                    <button name='comando' value='return_cases_of_pm' style='position: absolute; left: 0%; border: none;' title='Visualizza i Casi del Pm corrente'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                  </form>
                  <br><br>";
            }

        }
        echo"<center><strong>" . str_replace('Procura della Repubblica','',$NomeProcura) . " / ". $NomePm  ." / </strong> ". $NumCaso ."</center><br>
        <table class=\"u-full-width\">
            <thead style='color: #1188FF'>
                <tr>
                    <th><img src='font/icon/criminal.png' height='60'></th>
                    <th>SOGGETTO</th>
                    <th>TITOLO</th>
                    <th>PDF</th>
                    <th>OPERAZIONI</th>
                </tr>
            </thead>
            <tbody>
                ";
        foreach ($Indagati as $row)
        {
            echo"    <tr>

                            <td>
                            <form action='index.php' method='post'>
                                <input type='hidden' id='ind_id' name='ind_id'  value=" . $row['ind_id'] .">
                                <button type='submit' name='comando' value='status_indagato' title='Enumerazione Dispositivi' style='border:none; padding:0px 0px;'><img src='font/icon/info.png' height='25'></button>
                            </form>
                            </td>
                            <td>".$row['ind_cognome'] . " " . $row['ind_nome'] ."</td>
                            <td>". $row['ind_titolo'] ."</td>
                            <td>
                                <form action='index.php' method='post' target='_blank'>
                                <input type='hidden' id='ind_id' name='ind_id'  value=" . $row['ind_id'] .">
                                <button type='submit' name='comando' value='report_indagato' title='Stampa a video' style='border:none; padding:0px 0px; color: red;'><i class=\"fa fa-file-pdf-o fa-3x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='report_indagato_mpdf' title='Genera e Scarica PDF' style='border:none; padding:0px 0px; color: green;'><i class=\"fa fa-file-pdf-o fa-3x\" aria-hidden=\"true\"></i></button>
                                </form>
                            </td>
                            <form action='index.php'  method='post'>
                            <td>
                            <input type='hidden' id='ind_id' name='ind_id'  value=" . $row['ind_id'] .">
                                <button type='submit' name='comando' value='view_indagato' style='border:none; padding:0px 5px;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='edit_indagato' style='border:none; padding:0px 5px;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                                <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='delete_indagato' style='border:hidden; padding:0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                            </td>
                        </form>
                        </td>
                    </tr>";
        }
        echo"
            </tbody>
        </table>
        <form action='index.php' method='post'>
            <button type='submit' name='comando' value='page_add_indagato' title='Aggiungi un Indagato' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
        </form>
      </div>
    <script>
        function formTarget(x) {
            document.getElementById(x).setAttribute('target', '_blank')
        }
    </script>";
    }


    /**
     * Visualizza la pagina per aggiungere un nuovo indagato
     */
    public function HTML_add_indagato()
    {
        echo"
        <div class='container'><br>";
        if(isset($_SESSION["post_ca_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo"<form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"<form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"<form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
                }
            }
            echo"<br><br><center><img src='font/icon/criminal.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO SOGGETTO</h6></center>
                <form action='index.php' method='post'>
                    <center>
                        <select required name='ind_titolo' class='form-control' style='width: 40%;'>
                            <option value=''>Titolo:</option>
                            <option value='Indagato'>Indagato</option>
                            <option value='Persona Offesa'>Persona Offesa</option>
                            <option value='Proprietario'>Proprietario</option>
                            <option value='Imputato'>Imputato</option>
                        </select><br>
                        <input type='text' class='form-control' id='ind_nome' name='ind_nome' style='width:40%' placeholder='Nome' required><br>
                        <input type='text' class='form-control' id='ind_cognome' name='ind_cognome' style='width:40%' placeholder='Cognome' required><br>
                        <button type='submit' name='comando' value='insert_indagato' style='height: auto;;'>Salva</button></center>
                </form>
        </div>";
    }


    /**
     * Visualizza la pagina per modificare le info di un determinato indagato
     * @param $id
     * @param $titolo
     * @param $nome
     * @param $cognome
     */
    public function HTML_edit_indagato($id, $titolo, $nome, $cognome)
    {
        echo"<div class='container'><br>";
        if(isset($_SESSION["post_ca_id"]))
        {
            if($_SESSION['cli_type'] == 'P') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                                <button name='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Visualizza Indagati Caso Corrente'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                              </form>";
            }
            if($_SESSION['cli_type'] == 'T') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                                <button name='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Visualizza Indagati Caso Corrente'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                              </form>";
            }
            if($_SESSION['cli_type'] == 'C') {
                echo "<form action='index.php' method='post' style='display: inline;'>
                                <button name='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Visualizza Indagati Caso Corrente'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                              </form>";
            }

        }
        echo"<br><br><center><img src='font/icon/criminal.png' height='40'><h6 class='docs-header'>MODIFICA SOGGETTO</h6></center>
                    <form action='index.php' method='post'>
                                <div class='form-group'>
                                <center>
                                    <input type='hidden' class='form-control' id='ind_id' name='ind_id' style='width:90%' value=$id><br>
                                    <select required name='ind_titolo' class='form-control' style='width: 40%;'>
                                        <option value='$titolo'>$titolo</option>
                                        <option value='Indagato'>Indagato</option>
                                        <option value='Persona Offesa'>Persona Offesa</option>
                                        <option value='Proprietario'>Proprietario</option>
                                        <option value='Imputato'>Imputato</option>
                                    </select><br>
                                    <input type='text' class='form-control' id='ind_nome' name='ind_nome' style='width:40%' value=$nome placeholder='Nome'><br>
                                    <input type='text' class='form-control' id='ind_cognome' name='ind_cognome' required style='width:40%' value=$cognome placeholder='Cognome'><br>
                                <button type='submit' name='comando' value='update_indagato' style='height: auto;'>SALVA</button></center>
                                </div>
                            </form>
                            </div>";
    }



    public function HTML_REPORT_header($ind_cognome, $ind_nome){
        echo"<html>
            <head>
                <title>$ind_cognome $ind_nome</title>
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



    public function HTML_REPORT_page_header($titolo)
    {
        echo"
        <table border='1' cellpadding='5px'>
                <tbody>
                    <tr>
                        <td style='width: 160px;'>Computer Forensic Case Manager</td>
                        <td style='width: 395px;'><center><b style='font-size: 14pt'>$titolo</b></center></td>
                        <td style='width: 140px;'><img src='images/logo.png' width='95px' align='left'></td>
                    </tr>
                </tbody>
            </table>
            <br>";
    }


    public function HTML_REPORT_info($ca_num, $ca_tipo, $ind_titolo, $ind_cognome, $ind_nome, $cli_nome, $cli_citta, $pm_titolo, $pm_cognome, $pm_nome, $ctu)
    {
        echo"
        <table border='1' cellpadding='7px'>
            <tbody>
                <tr>
                    <td><strong>Numero del Caso:</strong><br>$ca_num</td>
                    <td colspan='2'><strong>$ind_titolo</strong><br>$ind_cognome $ind_nome</td>
                </tr>
                <tr>
                    <td><strong>Cliente</strong><br>$cli_nome</td>
                    <td colspan='2'><strong>Contatto Cliente</strong><br>";
        if($_SESSION['cli_type'] == 'P'){echo"PM $pm_titolo $pm_cognome $pm_nome";}else{echo"$pm_titolo $pm_cognome $pm_nome";}
        "</td>
                </tr>
                <tr>
                    <td><strong>Luogo</strong><br>$cli_citta</td>";
        if($_SESSION['cli_type']=='P'){echo"<td><strong>C.T.U.</strong><br>$ctu</td>";};
        if($_SESSION['cli_type']=='T'){echo"<td><strong>Perito</strong><br>$ctu</td>";};
        if($_SESSION['cli_type']=='C'){echo"<td><strong>C.T.P.</strong><br>$ctu</td>";};
        echo"<td><strong>Tipo di Investigazione</strong><br>$ca_tipo</td>
                </tr>
            </tbody>
        </table>
        <br>";
    }


    /**
     * Visualizza i dettagli degli host dell'indagato di cui si stà generando il report.
     * @param $ho_etichetta
     * @param $ho_modello
     * @param $ho_seriale
     * @param $ho_pwd
     * @param $ho_pwd_used
     * @param $ho_tipo
     */
    public function HTML_REPORT_dettaglio_host($ho_etichetta, $ho_modello, $ho_seriale, $ho_pwd, $ho_pwd_used, $ho_tipo)
    {
        echo"
        <table border='1' cellpadding='7px'>
                <tbody>
                    <tr bgcolor='#003c78' style='color: white; font-family: Arial; font-size:9pt;'>
                        <td align='center'>ID Host</td>
                        <td align='center'>Tipo</td>
                        <td align='center'>Modello</td>
                        <td align='center'>Nr. Seriale</td>
                        <td align='center'>Password</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td align='center'>" . $ho_etichetta . "</td>
                        <td align='center'>" . $ho_tipo . "</td>
                        <td align='center'>" . $ho_modello . "</td>
                        <td align='center'>" . $ho_seriale . "</td>";
                        if($ho_pwd_used == 0){echo"<td align='center'>" . $ho_pwd . "</td>";}
                        if($ho_pwd_used == 1){echo"<td align='center'>" . $ho_pwd . "&nbsp;&nbsp;" . "<img src='font/icon/check.png' style='height: 12px;'> </td>";}
        echo"       </tr>
                    </tbody>
            </table>
            <br>";
    }


    /**
     * Visualizza i dettagli degli host special dell'indagato di cui si stà generando il report.
     * @param $ho_etichetta
     * @param $ho_modello
     * @param $ho_seriale
     * @param $ho_tipo
     */
    public function HTML_REPORT_dettaglio_host_special($ho_etichetta, $ho_modello, $ho_seriale, $ho_tipo)
    {
        echo"
        <table border='1' cellpadding='7px'>
                <tbody>
                    <tr bgcolor='#003c78' style='color: white; font-family: Arial; font-size:9pt;'>
                        <td align='center'>ID Host</td>
                        <td align='center'>Tipo</td>
                        <td align='center'>Modello</td>
                        <td align='center'>Nr. Seriale</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td align='center'>" . $ho_etichetta . "</td>
                        <td align='center'>" . $ho_tipo . "</td>
                        <td align='center'>" . $ho_modello . "</td>
                        <td align='center'>" . $ho_seriale . "</td>";
        echo"       </tr>
                    </tbody>
            </table>
            <br>";
    }


    /**
     * Visualizza la descrizione degli host (in tabella) dell'indagato di cui si sta generando il report.
     * @param $Info
     * @param $HostsSpecial
     * @param $ho_id
     * @param $ho_spec_id
     */
    public function HTML_REPORT_descrizione_host($Info, $HostsSpecial, $ho_id, $ho_spec_id)
    {
        echo"
        <p align='center' style='font-family: Arial; font-size: 14pt;'><b>Descrizione Host</b></p>
        <table border='1' cellpadding='7px'>
        <tbody>
            <tr bgcolor='##003c78' style='color: white; font-family: Arial; font-size:9pt;'>
                <td align='center'>ID Host</td>
                <td align='center'>Tipo</td>
                <td align='center'>Modello</td>
                <td align='center'>Nr. Seriale</td>
            </tr>
";
                foreach($Info as $row){
                    if ($row['ho_id'] != $ho_id) {
                        echo"
                            <tr style='font-size: 8pt;'>
                                <td align='center'>" . $row['ho_etichetta'] . "</td>
                                <td align='center'>" . $row['ho_tipo'] . "</td>
                                <td align='center'>" . $row['ho_modello'] . "</td>
                                <td align='center'>" . $row['ho_seriale'] . "</td>
                            </tr>
                            ";
                            $ho_id = $row['ho_id'];
                    }
                }
                // Imposto ho_id a null siccome nel DETTAGLIO HOST ci sarà un nuovo controllo sugli ho_id per non stampare duplicati
                $ho_id = null;
                if($HostsSpecial != 0) {

                    foreach ($HostsSpecial as $row) {
                        if ($row['ho_id'] != $ho_spec_id) {
                            echo "
                            <tr style='font-size: 8pt;'>
                                <td align='center'>" . $row['ho_etichetta'] . "</td>
                                <td align='center'>" . $row['ho_tipo'] . "</td>
                                <td align='center'>" . $row['ho_modello'] . "</td>
                                <td align='center'>" . $row['ho_seriale'] . "</td>
                            </tr>
                            ";
                            $ho_spec_id = $row['ho_id'];
                        }
                    }
                }
echo"
        </tbody>
     </table>
    ";

    }




    /**
     * Visualizza le descrizioni dei media (evidence), in tabella, appartenenti all'indagato di cui si sta generando il report.
     * @param $arr
     * @param $HostsSpecial
     */
    public function HTML_REPORT_descrizione_media($arr, $HostsSpecial)
    {
        echo"
        <p align='center' style='font-family: Arial; font-size:14pt;'><b>Descrizione Media</b></p>
        <table border='1' cellpadding='7px'>
    <thead>
    </thead>
    <tbody>
        <tr bgcolor='##003c78' style='color:white; font-family: Arial; font-size:9pt;'>
            <td align='center'>ID Host</td>
            <td align='center'>Evidence</td>
            <td align='center'>Modello</td>
            <td align='center'>Dim.</td>
            <td align='center'>Nr. Seriale</td>
        </tr>";
        $IdEvi = 0;
        $ho_spec_id = 0;
                foreach($arr as $row){
                    if($IdEvi != $row['evi_id']) {
                        echo "<tr style='font-size: 8pt;'>
                                <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_modello'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_dimensione'] . " " . $row['evi_kbmbgbtb'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['evi_seriale'] . "</td>
                     </tr>";
                        $IdEvi = $row['evi_id'];
                    }
                }

                if($HostsSpecial != 0) {
                    foreach ($HostsSpecial as $row) {
                        if ($row['ho_id'] != $ho_spec_id) {
                            echo "
                            <tr style='font-size: 8pt;'>
                                <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_etichetta'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_modello'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_dimensione'] . " " . $row['ho_kbmbgbtb'] . "</td>
                                <td $this->StyleTdDetttaglio>" . $row['ho_seriale'] . "</td>
                            </tr>
                            ";
                            $ho_spec_id = $row['ho_id'];
                        }
                    }
                }
                echo"
    </tbody>
</table>";
    }



    /**
     * Visualizza i dettagli di un evidence appartenente ad un dato host di un dato indagato di cui si sta generando il report.
     * @param $ho_etichetta
     * @param $evi_etichetta
     * @param $evi_tipo
     * @param $evi_modello
     * @param $evi_seriale
     * @param $evi_pwd
     * @param $evi_pwd_used
     * @param $evi_dimensione
     * @param $evi_kbmbgbtb
     */
    public function HTML_REPORT_dettaglio_evidence($ho_etichetta, $evi_etichetta, $evi_tipo, $evi_modello, $evi_seriale, $evi_pwd, $evi_pwd_used, $evi_dimensione, $evi_kbmbgbtb)
    {
        echo"
        <table border='1' cellpadding='7px'>
                <tbody>
                    <tr bgcolor='#003c78' style='color: white; font-family: Arial; font-size:9pt;'>
                        <td align='center'>ID Host</td>
                        <td align='center'>Evidence</td>
                        <td align='center'>Tipo</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td align='center'>" . $ho_etichetta . "</td>
                        <td align='center'>" . $evi_etichetta . "</td>
                        <td align='center'>" . $evi_tipo . "</td>
                    </tr>


                    <tr bgcolor='#003c78' style='color: white; font-family: Arial; font-size:9pt;'>
                        <td align='center'>Modello</td>
                        <td align='center'>Seriale</td>
                        <td align='center'>Dimensione</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td align='center'>" . $evi_modello . "</td>
                        <td align='center'>" . $evi_seriale . "</td>
                        <td align='center'>" . $evi_dimensione . $evi_kbmbgbtb . "</td>
                    </tr>";
                    
                    if($evi_tipo == 'SimCard'){
                        echo"<tr bgcolor='#003c78' style='color: white; font-family: Arial; font-size:9pt;'>
                                <td align='center'>Password</td>
                             </tr>
                             <tr style='font-size: 8pt;'>";
                                if($evi_pwd_used == 0){echo"<td align='center'>" . $evi_pwd . "</td>";};
                                if($evi_pwd_used == 1){echo"<td align='center'>" . $evi_pwd . "&nbsp;&nbsp;<img src='font/icon/check.png' style='height: 12px;'> </td>";}
                             echo"</tr>";
                    }
                        
                    echo"</tbody>
            </table>
            <br>
            <b style='font-family: Arial; font-size: 14pt;'>Note:</b>
            <table border='1' cellpadding='7px'>
                <tbody>
                    <tr>
                        <td height='70px'>

                        </td>
                    </tr>
            </tbody>
            </table><br>";
    }



    /**
     * Visualizza le informazioni relative al clone di un dato evidence, di un dato host di un dato indagato
     * @param $evi_etichetta
     * @param $clo_tipoacq
     * @param $clo_altro_tipo
     * @param $clo_stracq
     * @param $clo_md5
     * @param $clo_sha1
     * @param $clo_sha256
     */
    public function HTML_REPORT_clone($evi_etichetta, $clo_tipoacq, $clo_altro_tipo, $clo_stracq, $clo_md5, $clo_sha1, $clo_sha256)
    {
        echo"
        <table border='1' cellpadding='7px'>
                <tbody>
                    <tr bgcolor='#003c78' style='color: white; font-family: Arial; font-size:9pt;'>
                        <td align='center'>Evidence</td>
                        <td align='center'>Tipo Acquisizione</td>
                        <td align='center'>Strumento</td>

                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td align='center'>" . $evi_etichetta . "</td>";
                        if($clo_tipoacq == "Altro")
                        {
                            echo"<td align='center'>" . $clo_tipoacq . ": " . $clo_altro_tipo ."</td>";
                        }
                        else
                        {
                            echo"<td align='center'>" . $clo_tipoacq . "</td>";
                        }

                        echo"<td align='center'>" . $clo_stracq . "</td>
                    </tr>
                    </tbody>
            </table>

            <table border='1' cellpadding='7px'>
                <tbody>
                    <tr bgcolor='#003c78' style='color: white; font-family: Arial;  font-size:9pt;'>
                        <td align='center'>Hash Generati</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td>MD5: $clo_md5</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td>SHA1: $clo_sha1</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td>SHA256: $clo_sha256</td>
                    </tr>
                    </tbody>
            </table>";
    }


    /**
     * Visualizza il contenuto di un log.
     * @param $log
     */
    public function HTML_REPORT_log($log)
    {
        //$lenlog = strlen($log);
        echo"
        <table border='1' cellpadding='7px'>
                <tbody>
                    <tr bgcolor='#003c78' style='color: white; font-family: Arial;  font-size:9pt;'>
                        <td align='center'>Log</td>
                    </tr>
                    <tr style='font-size: 8pt;'>
                        <td><pre>" . $log . "</pre></td>
                    </tr>
                    </tbody>
            </table>";
    }








    /**
     * Visualizza le foto di un host.
     * @param $ho_pathfoto
     * @param $ho_image1
     * @param $md5_image1
     * @param $ho_image2
     * @param $md5_image2
     * @param $ho_image3
     * @param $md5_image3
     * @param $ho_image4
     * @param $md5_image4
     */
    public function HTML_REPORT_foto($ho_pathfoto, $ho_image1, $md5_image1, $ho_image2, $md5_image2, $ho_image3, $md5_image3, $ho_image4, $md5_image4)
    {
        echo"
        <table border='0' cellpadding='7px'>
                <tbody>
                    <tr bgcolor='#003c78' style='color: white; font-size: 9pt;'>
                        <td>Foto</td>
                        <td></td>
                    </tr>
                    <tr style='font-size: 9pt;'>";
                        if($md5_image1 != null){echo"<td align='center'><img src='$ho_pathfoto$ho_image1' width='250px'><br><br>MD5: " . $md5_image1 . "</td>";}
                        if($md5_image2 != null){echo"<td align='center'><img src='$ho_pathfoto$ho_image2' width='250px'><br><br>MD5: " . $md5_image2 . "</td>";}
                    echo"</tr>";
                    echo"<tr style='font-size: 9pt;'>";
                        if($md5_image3 != null){echo"<td align='center'><img src='$ho_pathfoto$ho_image3' width='250px'><br><br>MD5: " . $md5_image3 . "</td>";}
                        if($md5_image4 != null){echo"<td align='center'><img src='$ho_pathfoto$ho_image4' width='250px'><br><br>MD5: " . $md5_image4 . "</td>";}
                    echo"</tr>";
                  echo"</tbody>
            </table>";
    }



    /**
     * Visualizza la pagina che riassume lo status di un indagato. Ovvero quanti host, host_special, evidence contiene
     * e quanti GB occupano
     * @param $Hosts
     * @param $HostsSpecial
     * @param $Evidences
     * @param $TipiHost
     * @param $TipiHostSp
     * @param $TipiEvi
     * @param $NomeProcura
     * @param $NumCaso
     * @param $NomePm
     * @param $NomeIndagato
     */
    public function HTML_status_indagato($Hosts, $HostsSpecial, $Evidences, $TipiHost, $TipiHostSp, $TipiEvi, $NomeProcura, $NumCaso, $NomePm, $NomeIndagato)
    {
        echo "
        <div class=\"container\"><br>";
            if(isset($_SESSION["post_ca_id"]))
                {
                    if($_SESSION['cli_type'] == 'P'){
                        echo"<form action='index.php' method='post' style='display: inline;'>
                                <button name ='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                            </form>";
                    }
                    if($_SESSION['cli_type'] == 'T'){
                        echo"<form action='index.php' method='post' style='display: inline;'>
                                <button name ='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                            </form>";
                    }
                    if($_SESSION['cli_type'] == 'C'){
                        echo"<form action='index.php' method='post' style='display: inline;'>
                                <button name ='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                            </form>";
                    }
                }

                    echo"<br>
                         <br>
                         <center><b>" . str_replace('Procura della Repubblica','',$NomeProcura) . " / ". $NomePm  ." / ". $NumCaso ." / </b>". $NomeIndagato ."</center><br>";



        echo"<table class=\"u-full-width\">
            <thead style='color: #1188FF'>
                <tr>
                    <th>NR. HOSTS</th>
                    <th>NR. EVIDENCES</th>
                    <th>NR. HOSTS SPECIALI</th>
                    <th>TOTALI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>";

                        $tot_reperti = 0;
                        $count = 0;
                        // FOR PER CONTARE E STAMPARE IL NUMERO DI HOST
                        foreach($TipiHost as $row){
                            $tipo = $row['ho_tipo'];
                            foreach ($Hosts as $row)
                            {
                                if($tipo == $row['ho_tipo']){
                                    $count++;
                                }
                            }
                            if($count != 0){echo "$tipo = $count <br>";}
                            $count = 0;
                        }
        echo"       </td>        
                    <td>";
                        // VARIABILI PER CONTARE E STAMPARE IL NUMERO DI EVIDENCES
                        $TotKb = 0;
                        $TotMb = 0;
                        $TotGb = 0;
                        $TotTb = 0;
                        $count = 0;
                        // FOR PER CONTARE GLI EVIDENCE
                        foreach($TipiEvi as $row){
                            $tipo = $row['evi_tipo'];
                            foreach ($Evidences as $row)
                            {
                                $dim = $row['evi_dimensione'];
                                $kmgt = $row['evi_kbmbgbtb'];
                                if($tipo == $row['evi_tipo']){
                                    // Conta evidences
                                    $count++;
                                    // Somma numero di reperti
                                    $tot_reperti++;
                                    // Somma dimensione
                                    if($kmgt == 'KB'){$TotKb = $TotKb + $dim;}
                                    if($kmgt == 'MB'){$TotMb = $TotMb + $dim;}
                                    if($kmgt == 'GB'){$TotGb = $TotGb + $dim;}
                                    if($kmgt == 'TB'){$TotTb = $TotTb + $dim;}
                                }
                            }
                            if($count != 0){echo "$tipo = $count <br>";}
                            $count = 0;
                        }
        echo"        </td>
                     <td>";
                        // FOR PER CONTARE E STAMPARE IL NUMERO DI HOST SPECIAL
                        $count = 0;
                        foreach($TipiHostSp as $row){
                            $tipo = $row['hos_tipo'];
                            foreach ($HostsSpecial as $row)
                            {
                                $dim = $row['ho_dimensione'];
                                $kmgt = $row['ho_kbmbgbtb'];
                                if($tipo == $row['ho_tipo']){
                                    // Conta gli host special
                                    $count++;
                                    // Somma numero di reperti
                                    $tot_reperti++;
                                    // Somma dimensione
                                    if($kmgt == 'KB'){$TotKb = $TotKb + $dim;}
                                    if($kmgt == 'MB'){$TotMb = $TotMb + $dim;}
                                    if($kmgt == 'GB'){$TotGb = $TotGb + $dim;}
                                    if($kmgt == 'TB'){$TotTb = $TotTb + $dim;}
                                }
                            }
                            if($count != 0){echo "$tipo = $count <br>";}
                            $count = 0;
                        }
    echo"          </td>
                   <td>";


        // STAMPA DEI TOTALI
        echo"Nr. Reperti: $tot_reperti<br>
                KB: $TotKb<br>
                MB: $TotMb<br>
                GB: $TotGb<br>
                TB: $TotTb<br>";
        $TotGb = $TotGb + (1024 * $TotTb);
        $TotGb = $TotGb + (0.001 * $TotMb);
        $TotGb = $TotGb + (0.000001 * $TotKb);

        echo"<b>TOTALE IN GB = $TotGb</b>
        </td></tbody></tr></table>";

    }
}
