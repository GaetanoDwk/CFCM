<?php

/**
 * Class HtmlEvidence
 * La classe gestisce le operazioni di visualizzazione relative agli evidence
 */

class HtmlEvidence
{

    /**
     * Visualizza la pagina relativa ad un dato evidence
     * @param string $NomeProcura
     * @param string $NomePm
     * @param string $NumCaso
     * @param string $NomeIndagato
     * @param string $NomeHost
     * @param int $IdEvidence
     * @param string $NomeEvidence
     * @param string $pathfoto
     * @param string $image1
     * @param string $image2
     * @param string $image3
     * @param string $image_docx
     */
    public function HTML_evidence($NomeProcura, $NomePm, $NumCaso, $NomeIndagato, $NomeHost, $IdEvidence, $NomeEvidence, $pathfoto, $image1, $image2, $image3, $image_docx)
    {
        echo "<div class='container'><br>";
        if(isset($_SESSION["post_ho_id"]))
        {
            if($_SESSION['cli_type'] == 'P'){
                echo "<form style='display: inline;' action='index.php'>
                        <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna agli evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'T'){
                echo "<form style='display: inline;' action='index.php'>
                        <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna agli evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'C'){
                echo "<form style='display: inline;' action='index.php'>
                        <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna agli evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }

        }

        echo"<br><br>
             <center><b>$NomeProcura / $NomePm / $NumCaso / $NomeIndagato / $NomeHost / </b>$NomeEvidence</center><br>
                <table>
                    <tbody>
                        <tr>";
                        $this->PRINT_evi_image($IdEvidence, $pathfoto, $image1, $image_docx);
                        $this->PRINT_evi_image($IdEvidence, $pathfoto, $image2, $image_docx);
                        $this->PRINT_evi_image($IdEvidence, $pathfoto, $image3, $image_docx);
                        echo"</tr>
                    </tbody>
                </table>";

        echo"<form method=\"post\" enctype=\"multipart/form-data\" id=\"form\">
                <label for=\"file\">Seleziona le immagini da caricare: </label>
                <input type=\"file\" name=\"file[]\" multiple/><br>
                <input type='hidden' id='evi_id' name='evi_id'  value=" . $IdEvidence .">
                <button type='submit' name='comando' value='update_evidence_foto' color='black' style='height: auto;'><img src='font/icon/upload-image.png' align='left' height='30'></button>&nbsp;&nbsp;&nbsp;
                <button onclick='return confirm(\"Sicuro di voler eliminare tutte le immagini?\")' type='submit' name='comando' value='delete_evidence_images' color='black' style='height: auto;'><img src='font/icon/delete.png' align='left' height='30'></button>  
            </form>
            </div>";
    }


    /**
     * Visualizza un'immagine di un dato evidence
     * @param $IdEvi
     * @param $Path
     * @param $Img
     * @param $ImgEviDocx
     */
    public function PRINT_evi_image($IdEvi, $Path, $Img, $ImgEviDocx){
        if(($Img != null) && ($Img != '') && ($Img != $ImgEviDocx)){
                            echo"<td>
                                <a href='$Path$Img' target='_blank'><img src='$Path$Img' height='100px'/></a>
                                <form action='index.php'  method='post'>
                                    <input type='hidden' id='evi_id' name='evi_id'  value=" . $IdEvi .">
                                    <input type='hidden' id='evi_pathfoto' name='evi_pathfoto'  value=" . $Path .">
                                    <input type='hidden' id='evi_image' name='evi_image'  value=" . $Img .">
                                    <button type = 'submit' name = 'comando' value = 'SET_DOCX_evi_image' style = 'border:hidden; width:5px; position: relative; left: 15%;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                                    <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='DELETE_evidence_image' style = 'border:hidden; width:5px; position: relative; left: 25%;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                                </form>
                            </td>";
                            }

        if(($Img != null) && ($Img != '') && ($Img == $ImgEviDocx)){
                            echo"<td>
                                <a href='$Path$Img' target='_blank'><img src='$Path$Img' height='100px' style='border: red; border-style: solid'/></a>
                                <form action='index.php'  method='post'>
                                    <input type='hidden' id='evi_id' name='evi_id'  value=" . $IdEvi .">
                                    <input type='hidden' id='evi_pathfoto' name='evi_pathfoto'  value=" . $Path .">
                                    <input type='hidden' id='evi_image' name='evi_image'  value=" . $Img .">
                                    <button type = 'submit' name = 'comando' value = 'UNSET_DOCX_evi_image' style = 'border:hidden; width:5px; position: relative; left: 15%; color: red;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                                </form>
                            </td>";
        }

    }


    /**
     * Visualizza tutti gli evidence di un dato HOST
     * @param $eviOfHost
     */
    public function HTML_evidence_of_host($eviOfHost)
    {
        echo "
        <div class=\"container\">";
        echo"<br>
                         <br>
        <table class=\"u-full-width\">
            <thead style='color: #1188FF'>
                <tr>
                    <th><img src='font/icon/evidence.png' height='40'></th>
                    <th>ETI.</th>
                    <th>MOD.</th>
                    <th>SER.</th>
                    <th>DIM</th>
                    <th>OPERAZIONI</th>
                </tr>
            </thead>
            <tbody>
                ";
        foreach ($eviOfHost as $row)
        {
            $evi_icon = str_replace(" ", "", $row['evi_tipo']);
            $path_evi_icon = "font/icon/".$evi_icon.".png";
            $path_evi_icon = strtolower($path_evi_icon);
            echo"<form action='index.php'  method='post'>
                    <tr>
                        <td><input type='hidden' id='evi_id' name='evi_id'  value=" . $row['evi_id'] ."><img src= $path_evi_icon height='35'></td>
                        <td>". $row['evi_etichetta'] ."</td>
                        <td>". $row['evi_modello'] ."</td>
                        <td>". $row['evi_seriale'] ."</td>
                        <td>". $row['evi_dimensione'] . " " . $row['evi_kbmbgbtb'] . "</td>
                        <td><button type='submit' name='comando' value='view_evidence' style='border:none; padding: 0px 5px;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                        <button type='submit' name='comando' value='edit_evidence' style='border:none; padding: 0px 5px;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                        <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='delete_evidence' style='border:none; padding: 0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button></td>
                    </tr>
                  </form>";
        }
        echo"
            </tbody>
        </table>
        <br>
        <form action='index.php' method='post'>
                        <button type='submit' name='comando' value='add_evidence' title='Aggiungi un Evidence' style='border: none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                    </form>
      </div>";
    }


    /**
     * Visualizza la pagina per aggiungere un nuovo evidence
     * @param $NomeHost
     * @param $count
     * @param $TipiEvi
     */
    public function HTML_add_evidence($NomeHost, $count, $TipiEvi)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_ho_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }

            }

            echo"
            <br><br>
            <center><img src='font/icon/evidence.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO EVIDENCE</h6></center>
            <form action='index.php' method='post' enctype=\"multipart/form-data\">
                <center>";
                if($count > 0)
                {
                    echo"<h6 style='color: red; position: absolute; top: 18%;'>Ritenta. Etichetta già esistente</h6>
                         <input type='text' class='form-control' id='evi_etichetta' name='evi_etichetta' style='width:12%; background-color: red;' placeholder='Etichetta' required>&nbsp;<input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' style='width:33%' value=$NomeHost readonly required><br>";
                }
                else{
                    echo"<input type='text' class='form-control' id='evi_etichetta' name='evi_etichetta' style='width:12%;' placeholder='Etichetta' required>&nbsp;<input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' style='width:33%' value=$NomeHost readonly required><br>";

                }

                    echo"<select name='evi_tipo' class='form-control' style='position: relative; left: -6%; width: 33%;' required>
                        <option value=''>Tipologia:</option>";
                                // Stampo le tipologie di host speciali prelevati dal db
                                foreach($TipiEvi as $row){
                                    $tipo = $row['evi_tipo'];
                                    echo"<option value='$tipo'>$tipo</option>";
                                }

                            echo"</select>
                            <br>
                    <input type='text' class='form-control' id='evi_modello' name='evi_modello' style='width:45%' placeholder='Modello'><br>
                    <input type='text' class='form-control' id='evi_seriale' name='evi_seriale' style='width:45%' placeholder='Seriale'><br>
                    <input type='text' class='form-control' id='evi_pwd' name='evi_pwd' style='width:31%' placeholder='Password / PIN'>&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' class='form-control' id='evi_pwd_used' name='evi_pwd_used' value='1'><br>
                    <input type='text' class='form-control' id='evi_dimensione' name='evi_dimensione' style='width:45%' placeholder='Dimensione (separare con virgola i decimali)' required><br>
                    <select name='evi_kbmbgbtb' class='form-control' style='width: 45%;' required>
                        <option value=''>KB-MB-GB-TB:</option>
                        <option value='N.D.'>N.D.</option>
                        <option value='KB'>KB</option>
                        <option value='MB'>MB</option>
                        <option value='GB'>GB</option>
                        <option value='TB'>TB</option>
                    </select><br>
                    <button type='submit' name='comando' value='insert_evidence' style='height: auto;'>Salva</button>
                </center>
            </form>
            <form action='index.php' method='post'>
                                <button type='submit' name='comando' value='page_add_tipo_evi' title='Aggiungi nuovo tipo di Host' style='border:none; position: absolute; top: 35%; left: 60%;'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='page_del_tipo_evi' title='Elimina un tipo di Host' style='border:none; position: absolute; top: 35%; left: 65%;'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                            </form><br>
        </div>";
    }



    /**
     * Visualizza la pagina per aggiungere un nuovo evidence con il messaggio di attenzione siccome si è inserita un'etichetta già presente nel DB
     * Quindi viene negato l'inserimento e dato a video il messaggio di ritentare.
     * @param string $NomeHost
     * @param array $TipiEvi
     * @param string $Etichetta
     * @param string $Tipo
     * @param string $Modello
     * @param string $Seriale
     * @param string $Pwd
     * @param int $Pwd_used
     * @param string $Dimensione
     * @param string $kbmbgbtb
     */
    public function HTML_add_evidence_deny_duplicate($NomeHost, $TipiEvi, $Etichetta, $Tipo, $Modello, $Seriale, $Pwd, $Pwd_used, $Dimensione, $kbmbgbtb)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_ho_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }

            }
            echo"
            <br><br>
            <center><img src='font/icon/evidence.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO EVIDENCE</h6></center>
            <form action='index.php' method='post' enctype=\"multipart/form-data\">
                <center>
                <div style='color: red; position: absolute; top: 26%; left: 22%;'><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i></div>
                <input type='text' class='form-control' id='evi_etichetta' name='evi_etichetta' style='width:22%; color: red;' placeholder='Etichetta già esistente!' required>&nbsp;<input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' style='width:23%' value=$NomeHost readonly required><br>
                <select name='evi_tipo' class='form-control' style='position: relative; left: -6%; width: 33%;' required>
                        <option value='$Tipo'>$Tipo</option>";
                                // Stampo le tipologie di host speciali prelevati dal db
                                foreach($TipiEvi as $row){
                                    $tipo = $row['evi_tipo'];
                                    echo"<option value='$tipo'>$tipo</option>";
                                }

                            echo"</select>
                            <br>
                    <input type='text' class='form-control' id='evi_modello' name='evi_modello' style='width:45%' value='$Modello' placeholder='Modello'><br>
                    <input type='text' class='form-control' id='evi_seriale' name='evi_seriale' style='width:45%' value='$Seriale' placeholder='Seriale'><br>
                    <input type='text' class='form-control' id='evi_pwd' name='evi_pwd' style='width:31%' value='$Pwd' placeholder='Password / PIN'>";
                    if($Pwd_used == 1){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='evi_pwd_used' value='1' checked='checked'><br>";}
                    if($Pwd_used == 0){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='evi_pwd_used' value='1'><br>";}
                    echo"
                    <input type='text' class='form-control' id='evi_dimensione' name='evi_dimensione' style='width:45%' value='$Dimensione' placeholder='Dimensione (separare con virgola i decimali)' required><br>
                    <select name='evi_kbmbgbtb' class='form-control' style='width: 45%;' required>
                        <option value='$kbmbgbtb'>$kbmbgbtb</option>
                        <option value='N.D.'>N.D.</option>
                        <option value='KB'>KB</option>
                        <option value='MB'>MB</option>
                        <option value='GB'>GB</option>
                        <option value='TB'>TB</option>
                    </select><br>
                    <button type='submit' name='comando' value='insert_evidence' style='height: auto;'>Salva</button>
                </center>
            </form>
            <form action='index.php' method='post'>
                                <button type='submit' name='comando' value='page_add_tipo_evi' title='Aggiungi nuovo tipo di Host' style='border:none; position: absolute; top: 35%; left: 60%;'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='page_del_tipo_evi' title='Elimina un tipo di Host' style='border:none; position: absolute; top: 35%; left: 65%;'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                            </form><br>
        </div>";
    }



    /**
     * Visualizza la pagina per aggiungere un nuovo evidence con il messaggio di attenzione siccome si è inserita un apice o delle virgolette
     * nei campi dell'evidence. Quindi bisogna ritentare l'inserimento senza inserire apici o virgolette.
     * @param string $NomeHost
     * @param array $TipiEvi
     * @param string $Etichetta
     * @param string $Tipo
     * @param string $Modello
     * @param string $Seriale
     * @param string $Pwd
     * @param int $Pwd_used
     * @param string $Dimensione
     * @param string $kbmbgbtb
     */
    public function HTML_add_evidence_deny_quote($NomeHost, $TipiEvi, $Etichetta, $Tipo, $Modello, $Seriale, $Pwd, $Pwd_used, $Dimensione, $kbmbgbtb)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_ho_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Torna ad Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }

            }

            echo"
            <div style='color: red; position: absolute; top: 26%; left: 22%;'><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i></div>
            <div style='color: red; position: absolute; top: 24%; left: 7%;'><b>Apici e Virgolette <br> sono vietati!</b></div>
            <br><br>
            <center><img src='font/icon/evidence.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO EVIDENCE</h6></center>
            <form action='index.php' method='post' enctype=\"multipart/form-data\">
                <center>";

                    echo"<input type='text' class='form-control' id='evi_etichetta' name='evi_etichetta' style='width:22%;' placeholder='Etichetta' required>&nbsp;<input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' style='width:23%' value=$NomeHost readonly required><br>
                         <select name='evi_tipo' class='form-control' style='position: relative; left: -6%; width: 33%;' required>
                        <option value='$Tipo'>$Tipo</option>";
                                // Stampo le tipologie di host speciali prelevati dal db
                                foreach($TipiEvi as $row){
                                    $tipo = $row['evi_tipo'];
                                    echo"<option value='$tipo'>$tipo</option>";
                                }

                            echo"</select>
                            <br>
                    <input type='text' class='form-control' id='evi_modello' name='evi_modello' style='width:45%' placeholder='Modello' value='$Modello'><br>
                    <input type='text' class='form-control' id='evi_seriale' name='evi_seriale' style='width:45%' placeholder='Seriale' value='$Seriale'><br>
                    <input type='text' class='form-control' id='evi_pwd' name='evi_pwd' style='width:31%' placeholder='Password / PIN' value='$Pwd'>";
                    if($Pwd_used == 1){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='evi_pwd_used' value='1' checked='checked'><br>";}
                    if($Pwd_used == 0){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='evi_pwd_used' value='1'><br>";}
                    echo"<input type='text' class='form-control' id='evi_dimensione' name='evi_dimensione' style='width:45%' placeholder='Dimensione (separare con virgola i decimali)' value=$Dimensione required><br>
                    <select name='evi_kbmbgbtb' class='form-control' style='width: 45%;' required>
                        <option value='$kbmbgbtb'>$kbmbgbtb</option>
                        <option value='N.D.'>N.D.</option>
                        <option value='KB'>KB</option>
                        <option value='MB'>MB</option>
                        <option value='GB'>GB</option>
                        <option value='TB'>TB</option>
                    </select><br>
                    <button type='submit' name='comando' value='insert_evidence' style='height: auto;'>Salva</button>
                </center>
            </form>
            <form action='index.php' method='post'>
                                <button type='submit' name='comando' value='page_add_tipo_evi' title='Aggiungi nuovo tipo di Host' style='border:none; position: absolute; top: 35%; left: 60%;'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='page_del_tipo_evi' title='Elimina un tipo di Host' style='border:none; position: absolute; top: 35%; left: 65%;'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                            </form><br>
        </div>";
    }


    /**
     * Visualizza la pagina che permette di aggiungere una nuova tipologia di evidence
     */
    public function HTML_page_add_tipo_evi()
    {
        echo"
            <div class='container'><br><br>";
        if(isset($_SESSION["post_ca_id"]))
        {
            if($_SESSION['cli_type'] == 'P'){
                echo"<form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='add_evidence' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
            }
            if($_SESSION['cli_type'] == 'T'){
                echo"<form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='add_evidence' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
            }
            if($_SESSION['cli_type'] == 'C'){
                echo"<form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='add_evidence' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
            }

        }
        echo"
                <br><br>
                <center><img src='font/icon/evidence.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVA TIPOLOGIA DI EVIDENCE</h6></center>
                    <form action='index.php' enctype='multipart/form-data' method='post'>
                        <center>
                        <input type='text' class='form-control' id='evi_tipo' name='evi_tipo' style='width:40%' placeholder='Tipologia'><br>
                        <input name='icona' type='file' />
                        <button name='comando' value='insert_evi_tipo' style='height: 35px;'>Salva</button>
                        <!--button type='submit' name='comando' value='insert_hos_tipo' style='height: auto;'>Salva</button></center-->
                    </form>
                    
                    
                    
            </div>";
    }


    /**
     * La funzione visualizza la pagina che permette di eliminare una tipologia di evidence
     * @param $TipiEvi
     */
    public function HTML_page_del_tipo_evi($TipiEvi)
    {
        echo "
        <div class=\"container\"><br>";
            if(isset($_SESSION["post_ca_id"]))
                {
                    if($_SESSION['cli_type'] == 'P'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='add_evidence' style='position: absolute; left: 0%; border: none;' title='Torna alla pagina di aggiunta Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'T'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='add_evidence' style='position: absolute; left: 0%; border: none;' title='Torna alla pagina di aggiunta Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'C'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='add_evidence' style='position: absolute; left: 0%; border: none;' title='Torna alla pagina di aggiunta Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                }

                    echo"<br>
                         <br>
                         <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/evidence.png' height='50'></th>
                                    <th>TIPO</th>
                                    <th>ELIMINA</th>
                                </tr>
                            </thead>
                            <tbody>";


        foreach ($TipiEvi as $row)
        {
            $evi_icon = $row['evi_icon'];
            echo"    <form action='index.php'  method='post'>
                        <tr>
                            <td><input type='hidden' id='evi_icon' name='evi_icon' value='$evi_icon'><img src='$evi_icon' height='40px'></td>
                            <td><input type='hidden' id='evi_id_tipo' name='evi_id_tipo'  value=" . $row['evi_id_tipo'] .">".$row['evi_tipo']."</td>
                            <td><button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='del_tipo_evi' style='border:hidden; padding: 0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button></td>
                        </tr>
                     </form>";
        }
            echo"</tbody>

        </table>
      </div>";

    }


    /**
     * Visualizza la pagina che permette di modificare un dato evidence
     * @param int $id
     * @param string $etichetta
     * @param string $tipo
     * @param string $TipiEvi
     * @param string $modello
     * @param string $seriale
     * @param string $pwd
     * @param int $pwd_used
     * @param string $dimensione
     * @param string $kbmbgbtb
     */
    public function HTML_edit_evidence($id, $etichetta, $tipo, $TipiEvi, $modello, $seriale, $pwd, $pwd_used, $dimensione, $kbmbgbtb)
    {
        echo"<div class='container'><br>";
                    if(isset($_SESSION["post_ho_id"]))
                        {
                            if($_SESSION["cli_type"] == 'P'){
                                echo "<form action='index.php' method='post'>
                                    <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Visualizza Lista Evidence Host Attuale'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>";
                            }
                            if($_SESSION["cli_type"] == 'T'){
                                echo "<form action='index.php' method='post'>
                                    <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Visualizza Lista Evidence Host Attuale'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>";
                            }
                            if($_SESSION["cli_type"] == 'C'){
                                echo "<form action='index.php' method='post'>
                                    <button name='comando' value='view_host' style='position: absolute; left: 0%; border: none;' title='Visualizza Lista Evidence Host Attuale'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>";
                            }
                        }
                    echo"<br><br><center><img src='font/icon/evidence.png' height='40'><h6 class='docs-header'>MODIFICA EVIDENCE</h6></center>

                                        <form action='index.php' method='post'>

                                            <div class='form-group'>
                                                <center>
                                                <input type='hidden' class='form-control' id='evi_id' name='evi_id' style='width:40%' value=$id><br>
                                                <input type='text' class='form-control' id='evi_etichetta' name='evi_etichetta' style='width:40%' required value='$etichetta' placeholder='Etichetta'><br>
                                                <select required name='evi_tipo' class='form-control' style='width: 26%;'>
                                                    <option value='$tipo'>$tipo</option>";
                                                    // Stampo le tipologie di evidence prelevati dal db
                                                    foreach($TipiEvi as $row){
                                                        $tipo = $row['evi_tipo'];
                                                        echo"<option value='$tipo'>$tipo</option>";
                                                    }

                                                echo"</select>
                                                <!-- Tasto per aggiungere un nuovo tipo di host speciale -->
                                                <form action='index.php' method='post'>
                                                    <button type='submit' name='comando' value='page_add_tipo_evi' title='Aggiungi nuovo tipo Evidence' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                                    <button type='submit' name='comando' value='page_del_tipo_evi' title='Elimina un tipo Evidence' style='border:none'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                                                </form><br>
                                                <input type='text' class='form-control' id='evi_modello' name='evi_modello' style='width:40%' value='$modello' placeholder='Modello'><br>
                                                <input type='text' class='form-control' id='evi_seriale' name='evi_seriale' style='width:40%' value='$seriale' placeholder='Seriale'><br>
                                                <input type='text' class='form-control' id='evi_pwd' name='evi_pwd' style='width:26%' value='$pwd' placeholder='Password'>&nbsp;&nbsp;";
                                                if($pwd_used == 1){echo"Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='evi_pwd_used' value='1' checked='checked'><br>";}
                                                if($pwd_used == 0){echo"Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='evi_pwd_used' value='1'><br>";}
                                        echo"   <input type='text' class='form-control' id='evi_dimensione' name='evi_dimensione' style='width:40%' value='$dimensione' placeholder='Dimensione'><br>
                                                <select required name='evi_kbmbgbtb' class='form-control' style='width: 40%;'>
                                                    <option value='$kbmbgbtb'>$kbmbgbtb</option>
                                                    <option value='N.D.'>N.D.</option>
                                                    <option value='KB'>KB</option>
                                                    <option value='MB'>MB</option>
                                                    <option value='GB'>GB</option>
                                                    <option value='TB'>TB</option>
                                                </select><br>
                                                <button type='submit' name='comando' value='update_evidence_info' color='black' style='height: auto'>Salva</button>
                                                </center>
                                                </div>
                                        </form>

                        </div>";
    }

}
