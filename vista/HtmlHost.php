<?php

/**
 * Class HtmlHost
 * La classe gestisce le operazioni di visualizzazione a video dei dati relativi agli Host
 */

class HtmlHost
{
    /**
     * Visualizza gli host trovati tramite la funzione di ricerca.
     * @param array $arrHosts
     */
    public function HTML_host_by_ricerca($arrHosts)
    {
        echo "
        <div class=\"container\"><br>
            <form action='index.php' method='post' style='display: inline;'>
                <button name ='comando' value='ricerca' style='position: absolute; left: 0%; border: none;' title='Torna alla ricerca'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>
            <br>
            <table class=\"u-full-width\">
            <thead style='color: #1188FF'>
                <tr>
                    <th><img src='font/icon/host.png' height='50'></th>
                    <th>ETI.</th>
                    <th>MOD.</th>
                    <th>SER.</th>
                    <th>OPERAZIONI</th>
                </tr>
            </thead>
            <tbody>";

        foreach ($arrHosts as $row)
        {
            $icona = str_replace(" ", "", $row['ho_tipo']);
            $PathIcona = "font/icon/".$icona.".png";

            echo "<form action='index.php'  method='post'>
                    <tr>
                        <td><input type='hidden' id='ho_id' name='ho_id'  value=" . $row['ho_id'] . "><img src= $PathIcona height='35'></td>
                        <td>" . $row['ho_etichetta'] . "</td>
                        <td>" . $row['ho_modello'] . "</td>
                        <td>" . $row['ho_seriale'] . "</td>
                        <td><button type='submit' name='comando' value='page_view_host' style='border:none; padding: 0px 4px;'><i class='fa fa-chevron-right fa-2x' aria-hidden='true'></i></button></td>
                    </tr>
                 </form>";
        }
        echo"
            </tbody>
        </table>
        <br>
      </div>";
    }


    /**
     * Visualizza la pagina contenente i dettagli di un dato host.
     * @param string $NomeProcura
     * @param string $NomePm
     * @param string $NumCaso
     * @param string $NomeIndagato
     * @param int $IdHost
     * @param string $NomeHost
     * @param string $ho_pathfoto
     * @param string $ho_image1
     * @param string $ho_image2
     * @param string $ho_image3
     * @param string $ho_image4
     * @param string $ImgDocx1
     * @param string $ImgDocx2
     */
    public function HTML_host($NomeProcura, $NomePm, $NumCaso, $NomeIndagato, $IdHost, $NomeHost, $ho_pathfoto, $ho_image1, $ho_image2, $ho_image3, $ho_image4, $ImgDocx1, $ImgDocx2)
    {
        echo "<div class='container'><br>";
        if(isset($_SESSION["post_ca_id"]))
        {
            if($_SESSION['cli_type'] == 'P'){
                echo "<form action='index.php' method='post'>
                        <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'T'){
                echo "<form action='index.php' method='post'>
                        <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'C'){
                echo "<form action='index.php' method='post'>
                        <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }


        }

        echo"<br><br>
                <center><b>$NomeProcura / $NomePm / $NumCaso / $NomeIndagato / </b>$NomeHost</center><br>
                <table>
                    <tbody>
                        <tr>";
        $this->PRINT_ho_image($IdHost, $ho_pathfoto, $ho_image1, $ImgDocx1, $ImgDocx2);
        $this->PRINT_ho_image($IdHost, $ho_pathfoto, $ho_image2, $ImgDocx1, $ImgDocx2);
        $this->PRINT_ho_image($IdHost, $ho_pathfoto, $ho_image3, $ImgDocx1, $ImgDocx2);
        $this->PRINT_ho_image($IdHost, $ho_pathfoto, $ho_image4, $ImgDocx1, $ImgDocx2);
        echo"</tr>
            </tbody>
        </table>";

        echo"<form method=\"post\" enctype=\"multipart/form-data\" id=\"form\">
                <label for=\"file\">Seleziona le immagini da caricare: </label>
                <input type=\"file\" name=\"file[]\" multiple/><br>
                <button type='submit' name='comando' value='update_host_foto' color='black' style='height: auto;'><img src='font/icon/upload-image.png' align='left' height='30'></button>&nbsp;&nbsp;&nbsp;
                <button onclick='return confirm(\"Sicuro di voler eliminare tutte le immagini?\")' type='submit' name='comando' value='delete_host_images' color='black' style='height: auto;'><img src='font/icon/delete.png' align='left' height='30'></button>
            </form>
             </div>";
    }

    /**
     * Stampa le immagini di un dato host
     * @param int $IdHost
     * @param string $path
     * @param string $img
     * @param string $ImgDocx1
     * @param string $ImgDocx2
     */
    private function PRINT_ho_image($IdHost, $path, $img, $ImgDocx1, $ImgDocx2){
        /*SE LA VARIABILE $img E' SETTATA E DIVERSA DA ImgDocx1 e Imgdocx2 ALLORA NON SARA' SELEZIONATA*/
        if((isset($img)) && ($img != $ImgDocx1) && ($img != $ImgDocx2)) {
            echo "<td>
                <a href='$path$img' target='_blank'><img src='$path$img' height='100px'/></a>
                    <form action='index.php'  method='post'>
                        <input type='hidden' id='ho_id' name='ho_id'  value=" . $IdHost . ">
                        <input type='hidden' id='ho_pathfoto' name='ho_pathfoto'  value=" . $path . ">
                        <input type='hidden' id='ho_image' name='ho_image'  value=" . $img . ">
                        <button type = 'submit' name = 'comando' value = 'SET_DOCX_host_image' style = 'border:hidden; width:5px; position: relative; left: 15%;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                        <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='DELETE_host_image' style = 'border:hidden; width:5px; position: relative; left: 15%;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                    </form>
                            </td>";
        }
        /*SE LA VARIABILE $img E' SETTATA E UGUALE A ImgDocx1 ALLORA SARA' SELEZIONATA E NON SARA' POSSIBILE ELIMINARLA SE PRIMA NON SI FA L'UNSET*/
        if((isset($img)) && ($img == $ImgDocx1) && ($img != $ImgDocx2)) {
            echo "<td>
                <a href='$path$img' target='_blank'><img src='$path$img' height='100px' style='border: blue; border-style: solid'/></a>
                    <form action='index.php'  method='post'>
                        <input type='hidden' id='ho_id' name='ho_id'  value=" . $IdHost . ">
                        <input type='hidden' id='ho_pathfoto' name='ho_pathfoto'  value=" . $path . ">
                        <input type='hidden' id='ho_image' name='ho_image'  value=" . $img . ">
                        <button type = 'submit' name = 'comando' value = 'UNSET_DOCX_host_image1' style = 'border:hidden; width:5px; position: relative; left: 15%; color: red;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                        
                    </form>
                            </td>";
        }
        /*SE LA VARIABILE $img E' SETTATA E UGUALE A ImgDocx2 ALLORA SARA' SELEZIONATA E NON SARA' POSSIBILE ELIMINARLA SE PRIMA NON SI FA L'UNSET*/
        if((isset($img)) && ($img != $ImgDocx1) && ($img == $ImgDocx2)) {
            echo "<td>
                <a href='$path$img' target='_blank'><img src='$path$img' height='100px' style='border: blue; border-style: solid'/></a>
                    <form action='index.php'  method='post'>
                        <input type='hidden' id='ho_id' name='ho_id'  value=" . $IdHost . ">
                        <input type='hidden' id='ho_pathfoto' name='ho_pathfoto'  value=" . $path . ">
                        <input type='hidden' id='ho_image' name='ho_image'  value=" . $img . ">
                        <button type = 'submit' name = 'comando' value = 'UNSET_DOCX_host_image2' style = 'border:hidden; width:5px; position: relative; left: 15%; color: red;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                        
                    </form>
                            </td>";
        }
    }


    /**
     * Visualizza la pagina per aggiungere un nuovo host
     * @param int $count
     * @param array $TipiHost
     */
    public function HTML_add_host($count, $TipiHost)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_ca_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
            }

            echo"
                <center><img src='font/icon/host.png' height='50'><h6 class='docs-header'>INSERIMENTO NUOVO HOST</h6></center>";
            if($count > 0){echo"<h6 style='color: red'>Riprova. Host gia' esistente</h6>";}
            echo"
            <form action='index.php' method='post' enctype=\"multipart/form-data\">
                <center>
                <input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' style='width:40%;' placeholder='Etichetta' required><br>
                    <select name='ho_tipo' class='form-control' style='width: 28%; position: relative; left: -6%;' required>
                        <option value=''>Tipologia:</option>";
                                // Stampo le tipologie di host speciali prelevati dal db
                                foreach($TipiHost as $row){
                                    $tipo = $row['ho_tipo'];
                                    echo"<option value='$tipo'>$tipo</option>";
                                }

                            echo"</select><br>
                            <!-- Tasto per aggiungere un nuovo tipo di host speciale -->
                            
                <input type='text' class='form-control' id='ho_modello' name='ho_modello' style='width:40%;' placeholder='Modello' required><br>
                <input type='text' class='form-control' id='ho_seriale' name='ho_seriale' style='width:40%;' placeholder='Seriale' required><br>
                <input type='text' class='form-control' id='ho_pwd' name='ho_pwd' style='width:26%;' placeholder='Password/PIN'>
                &nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='ho_pwd_used' value='1' title='Password / PIN utilizzata/o'><br>
            </form> 
                <button type='submit' name='comando' value='insert_host' color='black' style='height: auto;'>Salva</button></center>
            </form>
            <form action='index.php' method='post'>
                                <button type='submit' name='comando' value='page_add_ho_tipo' title='Aggiungi nuovo tipo di Host' style='border:none; position: absolute; top: 44%; left: 60%;'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='page_del_ho_tipo' title='Elimina un tipo di Host' style='border:none; position: absolute; top: 44%; left: 65%;'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                            </form><br>
        </div>";
    }




    /**
     * Visualizza la pagina per aggiungere un nuovo host con in più il messaggio di avviso che l'etichetta scelta è già presente.
     * Quindi bisogna scegliere un'etichetta differente per poter effettuare l'inserimento
     * @param string $etichetta
     * @param string $tipo
     * @param string $modello
     * @param string $seriale
     * @param string $pwd
     * @param string $pwd_used
     * @param string $TipiHost
     */
    public function HTML_add_host_deny_duplicates($etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $TipiHost)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_ca_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
            }

            echo"
            <center><img src='font/icon/host.png' height='50'><h6 class='docs-header'>INSERIMENTO NUOVO HOST</h6></center>
            <form action='index.php' method='post' enctype=\"multipart/form-data\">
                <center>
                <div style='color: red; position: absolute; top: 33%; left: 25%;'><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i></div>
                <input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' style='width:40%; color: red;' placeholder='Il nome host che hai scelto è già presente' required><br>
                    <select name='ho_tipo' class='form-control' style='width: 28%; position: relative; left: -6%;' required>
                        <option value='$tipo'>$tipo</option>";
                                // Stampo le tipologie di host speciali prelevati dal db
                                foreach($TipiHost as $row){
                                    $tipo = $row['ho_tipo'];
                                    echo"<option value='$tipo'>$tipo</option>";
                                }

                            echo"</select><br>
                            <!-- Tasto per aggiungere un nuovo tipo di host speciale -->
                            
                <input type='text' class='form-control' id='ho_modello' name='ho_modello' style='width:40%;' placeholder='Modello' value='$modello' required><br>
                <input type='text' class='form-control' id='ho_seriale' name='ho_seriale' style='width:40%;' placeholder='Seriale' value='$seriale' required><br>
                <input type='text' class='form-control' id='ho_pwd' name='ho_pwd' style='width:26%;' placeholder='Password/PIN' value='$pwd'>";

                if($pwd_used == 1){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='ho_pwd_used' value='1' title='Password / PIN utilizzata/o' checked='checked'><br>";}
                if($pwd_used == 0){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='ho_pwd_used' value='1' title='Password / PIN utilizzata/o'><br>";}

                echo"</form> 
                <button type='submit' name='comando' value='insert_host' color='black' style='height: auto;'>Salva</button></center>
            </form>
            <form action='index.php' method='post'>
                                <button type='submit' name='comando' value='page_add_ho_tipo' title='Aggiungi nuovo tipo di Host' style='border:none; position: absolute; top: 44%; left: 60%;'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='page_del_ho_tipo' title='Elimina un tipo di Host' style='border:none; position: absolute; top: 44%; left: 65%;'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                            </form><br>
        </div>";
    }



    /**
     * Visualizza la pagina per aggiungere un nuovo host con in più il messaggio di avviso che l'etichetta scelta è già presente.
     * Quindi bisogna scegliere un'etichetta differente per poter effettuare l'inserimento
     * @param string $etichetta
     * @param string $tipo
     * @param string $modello
     * @param string $seriale
     * @param string $pwd
     * @param string $pwd_used
     * @param string $TipiHost
     */
    public function HTML_add_host_deny_quote($etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $TipiHost)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_ca_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo "
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>
                <br><br>";
                }
            }

            echo"
            <center><img src='font/icon/host.png' height='50'><h6 class='docs-header'>INSERIMENTO NUOVO HOST</h6></center>
            <form action='index.php' method='post' enctype=\"multipart/form-data\">
                <center>
                <div style='color: red; position: absolute; top: 33%; left: 25%;'><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i></div>
                <div style='color: red; position: absolute; top: 31%; left: 9%;'><b>Apici e Virgolette <br> sono vietati!</b></div>
                <input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' style='width:40%;' placeholder='Etichetta' value='$etichetta' required><br>
                    <select name='ho_tipo' class='form-control' style='width: 28%; position: relative; left: -6%;' required>
                        <option value='$tipo'>$tipo</option>";
                                // Stampo le tipologie di host speciali prelevati dal db
                                foreach($TipiHost as $row){
                                    $tipo = $row['ho_tipo'];
                                    echo"<option value='$tipo'>$tipo</option>";
                                }

                            echo"</select><br>
                            <!-- Tasto per aggiungere un nuovo tipo di host speciale -->
                            
                <input type='text' class='form-control' id='ho_modello' name='ho_modello' style='width:40%;' placeholder='Modello' value='$modello' required><br>
                <input type='text' class='form-control' id='ho_seriale' name='ho_seriale' style='width:40%;' placeholder='Seriale' value='$seriale' required><br>
                <input type='text' class='form-control' id='ho_pwd' name='ho_pwd' style='width:26%;' placeholder='Password/PIN' value='$pwd'>";

                if($pwd_used == 1){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='ho_pwd_used' value='1' title='Password / PIN utilizzata/o' checked='checked'><br>";}
                if($pwd_used == 0){echo"&nbsp;&nbsp;&nbsp;Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='ho_pwd_used' value='1' title='Password / PIN utilizzata/o'><br>";}

                echo"</form> 
                <button type='submit' name='comando' value='insert_host' color='black' style='height: auto;'>Salva</button></center>
            </form>
            <form action='index.php' method='post'>
                                <button type='submit' name='comando' value='page_add_ho_tipo' title='Aggiungi nuovo tipo di Host' style='border:none; position: absolute; top: 44%; left: 60%;'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                <button type='submit' name='comando' value='page_del_ho_tipo' title='Elimina un tipo di Host' style='border:none; position: absolute; top: 44%; left: 65%;'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                            </form><br>
        </div>";
    }





    /**
     * Visualizza la pagina per aggiungere una nuova tipologia di host
     */
    public function HTML_add_ho_tipo()
    {
        echo"
            <div class='container'><br>";
        if(isset($_SESSION["post_ca_id"]))
        {
            if($_SESSION['cli_type'] == 'P'){
                echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='page_add_host' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
            }
            if($_SESSION['cli_type'] == 'T'){
                echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='page_add_host' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
            }
            if($_SESSION['cli_type'] == 'C'){
                echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='page_add_host' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
            }
        }
        echo"<center><img src='font/icon/host.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVA TIPOLOGIA DI HOST</h6></center>
             <form action='index.php' enctype='multipart/form-data' method='post'>
                <center>
                    <input type='text' class='form-control' id='ho_tipo' name='ho_tipo' style='width:40%' placeholder='Tipologia'><br>
                    <input name='icona' type='file' />
                    <button name='comando' value='insert_ho_tipo' style='height: 35px;'>Salva</button>
                    </form>    
            </div>";
    }


    /**
     * Visualizza la pagina che permette di editare le informazioni di un host.
     * @param int $id
     * @param string $etichetta
     * @param string $tipo
     * @param string $modello
     * @param string $seriale
     * @param string $pwd
     * @param int $pwd_used
     * @param array $TipiHost
     */
    public function HTML_edit_host($id, $etichetta, $tipo, $modello, $seriale, $pwd, $pwd_used, $TipiHost)
    {
        echo"<div class='container'><br>";
                    if(isset($_SESSION["post_ca_id"]))
                        {
                            if($_SESSION['cli_type'] == 'P'){
                                echo "<form action='index.php' method='post' style='display: inline;'>
                                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Vai agli Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>
                                  <br><br>";
                            }
                            if($_SESSION['cli_type'] == 'T'){
                                echo "<form action='index.php' method='post' style='display: inline;'>
                                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Vai agli Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>
                                  <br><br>";
                            }
                            if($_SESSION['cli_type'] == 'C'){
                                echo "<form action='index.php' method='post' style='display: inline;'>
                                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Vai agli Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                  </form>
                                  <br><br>";
                            }
                        }
                    echo"<center><img src='font/icon/host.png' height='50'><h6 class='docs-header'>MODIFICA HOST</h6></center>
                                <form action='index.php' method='post'>
                                    <div class='form-group'>
                                    <center>
                                        <input type='hidden' class='form-control' id='ho_id' name='ho_id' style='width:40%' value=$id><br>
                                        <input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' required style='width:40%' value='$etichetta' placeholder='Etichetta'><br>
                                        <select required name='ho_tipo' class='form-control' style='width: 27%'>
                                            <option value='$tipo'>$tipo</option>";
                                                    // Stampo le tipologie di host prelevati dal db
                                                    foreach($TipiHost as $row){
                                                        $TipoHost = $row['ho_tipo'];
                                                        echo"<option value='$TipoHost'>$TipoHost</option>";
                                                    }

                                                echo"</select>
                                                <!-- Tasto per aggiungere un nuovo tipo di host -->
                                                <form action='index.php' method='post'>
                                                    <button type='submit' name='comando' value='page_add_ho_tipo' title='Aggiungi nuovo tipo di Host' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                                    <button type='submit' name='comando' value='page_del_ho_tipo' title='Elimina un tipo di Host' style='border:none'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                                                </form><br>
                                        <input type='text' class='form-control' id='ho_modello' name='ho_modello' style='width:40%' value='$modello' placeholder='Modello'><br>
                                        <input type='text' class='form-control' id='ho_seriale' name='ho_seriale' style='width:40%' value='$seriale' placeholder='Nr. Seriale'><br>
                                        <input type='text' class='form-control' id='ho_pwd' name='ho_pwd' style='width:26%' value='$pwd' placeholder='Password'>&nbsp;&nbsp;";
                                        if($pwd_used == 1){echo"Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='ho_pwd_used' value='1' checked='checked'><br>";}
                                        if($pwd_used == 0){echo"Utilizzata/o?&nbsp;&nbsp;<input type='checkbox' name='ho_pwd_used' value='1'><br>";}
                                        echo"<button type='submit' name='comando' value='update_host_info' color='black' style='height: auto;'>SALVA</button>
                                    </center>
                                    </div>
                                </form>
                            </div>
            </div>";
    }


    /**
     * Visualizza la pagina che permette di eliminare le tipologie di host
     * @param array $TipiHost
     */
    public function HTML_page_del_ho_tipo($TipiHost)
    {
        echo "
        <div class=\"container\"><br>";
            if(isset($_SESSION["post_ca_id"]))
                {
                    if($_SESSION['cli_type'] == 'P'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='page_add_host' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'T'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='page_add_host' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'C'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='page_add_host' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                }

                    echo"<br>
                         <br>
                         <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/host.png' height='50'></th>
                                    <th>TIPO</th>
                                    <th>ELIMINA</th>
                                </tr>
                            </thead>
                            <tbody>";
        foreach ($TipiHost as $row)
        {
            $icona = $row['ho_icon'];
            echo"    <form action='index.php'  method='post'>
                        <tr>
                            <td><input type='hidden' id='ho_icon' name='ho_icon' value='$icona'><img src='$icona' height='40px'></td>
                            <td><input type='hidden' id='ho_id_tipo' name='ho_id_tipo'  value=" . $row['ho_id_tipo'] .">".$row['ho_tipo']."</td>
                            <td><button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='del_ho_tipo' style='border:hidden; padding: 0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button></td>
                        </tr>
                     </form>";
        }
            echo"</tbody>

        </table>
      </div>";

    }


    /**
     * Visualizza la pagina di ricerca con in più il messaggio che non ha trovato nessun PM corrispondente alla stringa utilizzata
     */
    public function HTML_ricerca_host_not_found()
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
                        <input type='text' align='center' id='ric' name='ric' placeholder='Numero-anno del caso' style='width: 200px;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_caso' title='Ricerca Caso'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>
                    
                    <form action='index.php' method='post'>
                        <input type='text' align='center' id='ric' name='ric' placeholder='Host non trovato' style='width: 200px; color: red; border-color: red;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_host' title='Ricerca Host'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>
                </center>";
     }



}
