<?php

/**
 * Class HtmlHostSpecial
 * La classe gestisce le operazioni di visualizzazione dei dati relativi agli Host e Host_special
 */
class HtmlHostSpecial
{
    /*private $Html;
    private $ModelHost;

    public function __construct()
    {
        $this->Html = new HtmlPainter();
        $this->ModelHost = new ModelHost();
    }

    public function HTML_titolo_caso($ca_nome)
    {
        echo"<div class='container' style='border: '>
            <h3>Procedimento $ca_nome</h3>
             </div>";

    }*/


    /**
     * Visualizza la lista di tutti gli host_special di un dato indagato.
     * Questa funzione è attualmente impiegata per la stampa SIA degli HOST SIA degli HOST_SPECIAL di un indagato.
     * @TODO: L'intento sarebbe di dividere questa funzione tra le due classi HtmlHost e HtmlHostSpecial in modo da far
     *   stampare a video ad ognuna la sua parte di dati.
     * @param $Hosts
     * @param $HostsSpecial
     * @param $TipoHost
     * @param $TipoHostSpecial
     * @param $NomeProcura
     * @param $NumCaso
     * @param $NomePm
     * @param $NomeIndagato
     */
    public function HTML_hosts_of_indagato($Hosts, $HostsSpecial, $TipoHost, $TipoHostSpecial, $NomeProcura, $NumCaso, $NomePm, $NomeIndagato)
    {
        echo "
        <div class=\"container\"><br>";
            if(isset($_SESSION["post_ca_id"]))
                {
                    if($_SESSION['cli_type'] == 'P'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'T'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'C'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='return_to_caso' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }

                }

                    echo"<br>
                         <br>
                         <center><b>" . str_replace('Procura della Repubblica','',$NomeProcura) . " / ". $NomePm  ." / ". $NumCaso ." / </b>". $NomeIndagato ."</center><br>";
        echo"
        <table class=\"u-full-width\">
            <thead style='color: #1188FF'>
                <tr>
                    <th><img src='font/icon/host.png' height='50'></th>
                    <th>ETI.</th>
                    <th>MOD.</th>
                    <th>SER.</th>
                    <th>PWD</th>
                    <th>OPERAZIONI</th>
                </tr>
            </thead>
            <tbody>
                ";
        foreach ($Hosts as $row)
        {
            $icona = str_replace(" ", "", $row['ho_tipo']);
            $PathIcona = "font/icon/".$icona.".png";
            $PathIcona = strtolower($PathIcona);

            echo "<form action='index.php'  method='post'>
                    <tr>
                        <td><input type='hidden' id='ho_id' name='ho_id'  value=" . $row['ho_id'] . "><img src= $PathIcona height='35'></td>
                        <td>" . $row['ho_etichetta'] . "</td>
                        <td>" . $row['ho_modello'] . "</td>
                        <td>" . $row['ho_seriale'] . "</td>
                        <td>" . $row['ho_pwd'] . "</td>
                        <td>
                            <button type='submit' name='comando' value='page_view_host' style='border:none; padding: 0px 4px;'><i class='fa fa-chevron-right fa-2x' aria-hidden='true'></i></button>
                            <button type='submit' name='comando' value='edit_host' style='border:none; padding: 0px 4px;'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button>
                            <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='delete_host' style='border:hidden; padding: 0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                        </td>
                    </tr>
                 </form>";
        }

        foreach ($HostsSpecial as $row)
        {
            $icona = str_replace(" ", "", $row['ho_tipo']);
            $PathIcona = "font/icon/".$icona.".png";
            $PathIcona = strtolower($PathIcona);
            echo"<form action='index.php' method='post'>
                    <tr>
                        <td><input type='hidden' id='ho_id' name='ho_id'  value=" . $row['ho_id'] ."><img src= $PathIcona height='35'><img src='font/icon/collection.png' height='15'></td>
                        <td>" . $row['ho_etichetta'] . "</td>
                        <td>" . $row['ho_modello'] . "</td>
                        <td>" . $row['ho_seriale'] . "</td>
                        <td></td>
                        <td>
                            <button type='submit' name='comando' value='view_host_special' style='border:none; padding: 0px 4px;'><i class='fa fa-chevron-right fa-2x' aria-hidden='true'></i></button>
                            <button type='submit' name='comando' value='edit_host_special' style='border:none; padding: 0px 4px;'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button>
                            <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='delete_host_special' style='border:hidden; padding: 0px 0px'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                        </td>
                    </tr>
                  </form>";
        }
        echo"
            </tbody>

        </table>
        <br>
        <form action='index.php' method='post'>
            <button type='submit' name='comando' value='page_add_host' title='Aggiungi un Host' style='border: none'><img src='font/icon/addhost.png' height='30px'></button>
            <button type='submit' name='comando' value='page_add_host_special' title='Rientrano tra gli host speciali i dispositivi che rappresentano già un evidence (ES: PenDrive, HardDisk esterno non smontabile, MicroSD) quando non appartengono a nessun dispositivo' style='border: none'><img src='font/icon/addobjcoll.png' height='30px'></button>
        </form>
      </div>";
    }


    /**
     * Visualizza la pagina dell'host special selezionato.
     * @param $NomeProcura
     * @param $NomePm
     * @param $NumCaso
     * @param $NomeIndagato
     * @param $IdHost
     * @param $NomeHost
     * @param $ho_pathfoto
     * @param $ho_image1
     * @param $ho_image2
     * @param $ho_image3
     * @param $ho_image4
     * @param $ImgDocx1
     * @param $ImgDocx2
     */
    public function HTML_host_special($NomeProcura, $NomePm, $NumCaso, $NomeIndagato, $IdHost, $NomeHost, $ho_pathfoto, $ho_image1, $ho_image2, $ho_image3, $ho_image4, $ImgDocx1, $ImgDocx2)
    {
        echo "<div class='container'><br>";
        if(isset($_SESSION["post_ca_id"]))
        {
            if($_SESSION['cli_type'] == 'P'){
                echo "<form action='index.php' method='post'>
                        <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'T'){
                echo "<form action='index.php' method='post'>
                        <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }
            if($_SESSION['cli_type'] == 'C'){
                echo "<form action='index.php' method='post'>
                        <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
            }

        }


        echo"<br><br>
                <center><b>$NomeProcura / $NomePm / $NumCaso / $NomeIndagato / </b>$NomeHost</center><br>
                <table>
                    <tbody>
                        <tr>";
                        $this->PRINT_hostSP_image($IdHost, $ho_pathfoto, $ho_image1, $ImgDocx1, $ImgDocx2);
                        $this->PRINT_hostSP_image($IdHost, $ho_pathfoto, $ho_image2, $ImgDocx1, $ImgDocx2);
                        $this->PRINT_hostSP_image($IdHost, $ho_pathfoto, $ho_image3, $ImgDocx1, $ImgDocx2);
                        $this->PRINT_hostSP_image($IdHost, $ho_pathfoto, $ho_image4, $ImgDocx1, $ImgDocx2);
                        echo"</tr>
                    </tbody>
                </table>";

        echo"<form method=\"post\" enctype=\"multipart/form-data\" id=\"form\">
                <label for=\"file\">Seleziona le immagini da caricare: </label>
                <input type=\"file\" name=\"file[]\" multiple/><br>
                <button type='submit' name='comando' value='update_host_special_images' color='black' style='height: auto;'><img src='font/icon/upload-image.png' align='left' height='30'></button>&nbsp;&nbsp;&nbsp;
                <button onclick='return confirm(\"Sicuro di voler eliminare tutte le immagini?\")' type='submit' name='comando' value='delete_host_special_images' color='black' style='height: auto;'><img src='font/icon/delete.png' align='left' height='30'></button>
                <!--input type=\"submit\" name=\"comando\" value=\"update_host_foto\" /-->
            </form>
             </div>";
    }


    /**
     * Visualizza le immagini di un host special.
     * @param $IdHost
     * @param $path
     * @param $img
     * @param $ImgDocx1
     * @param $ImgDocx2
     */
    private function PRINT_hostSP_image($IdHost, $path, $img, $ImgDocx1, $ImgDocx2){

        /*SE LA VARIABILE $img E' SETTATA E DIVERSA DA ImgDocx1 e Imgdocx2 ALLORA NON SARA' SELEZIONATA*/
        if((isset($img)) && ($img != $ImgDocx1) && ($img != $ImgDocx2)) {
            echo "<td>
                <a href='$path$img' target='_blank'><img src='$path$img' height='100px'/></a>
                    <form action='index.php'  method='post'>
                        <input type='hidden' id='ho_id' name='ho_id'  value=" . $IdHost . ">
                        <input type='hidden' id='ho_pathfoto' name='ho_pathfoto'  value=" . $path . ">
                        <input type='hidden' id='ho_image' name='ho_image'  value=" . $img . ">
                        <button type = 'submit' name = 'comando' value = 'SET_DOCX_hostSP_image' style = 'border:hidden; width:5px; position: relative; left: 15%;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                        <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='DELETE_host_special_image' style = 'border:hidden; width:5px; position: relative; left: 15%;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
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
                        <button type = 'submit' name = 'comando' value = 'UNSET_DOCX_hostSP_image1' style = 'border:hidden; width:5px; position: relative; left: 15%; color: red;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                        
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
                        <button type = 'submit' name = 'comando' value = 'UNSET_DOCX_hostSP_image2' style = 'border:hidden; width:5px; position: relative; left: 15%; color: red;' ><i class=\"fa fa-file-word-o fa-2x\" aria-hidden=\"true\"></i></button>
                        
                    </form>
                            </td>";
        }
    }


    /**
     * Visualizza la pagina per aggiungere un nuovo host special
     * @param $tipi
     */
    public function HTML_add_host_special($tipi)
    {
        echo"
            <div class='container'><br>";
            if(isset($_SESSION["post_ca_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_indagato' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
                }

            }
        echo"
            <center><img src='font/icon/object.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO HOST SPECIALE</h6></center>
            <form action='index.php' method='post'>
                
                    <input type='text' class='form-control' id='etichetta' name='etichetta' style='width:40%; position: relative; left: 30%' placeholder='Etichetta' required><br>
                            <select name='tipo' class='form-control' style='width: 30%; position: relative; left: 30%' required>
                                <option value=''>Tipologia:</option>";
                                // Stampo le tipologie di host speciali prelevati dal db
                                foreach($tipi as $row){
                                    $tipo = $row['hos_tipo'];
                                    echo"<option value='$tipo'>$tipo</option>";
                                }

                            echo"</select>
                            <!-- Tasto per aggiungere un nuovo tipo di host speciale -->
                            <form action='index.php' method='post'>
                                <br>
                                <input type='text' class='form-control' id='modello' name='modello' style='width:40%; position: relative; left: 30%' placeholder='Modello' required><br>
                                <input type='text' class='form-control' id='seriale' name='seriale' style='width:40%; position: relative; left: 30%' placeholder='Seriale' required><br>
                                <input type='text' class='form-control' id='dimensione' name='dimensione' style='width: 40%;  position: relative; left: 30%' placeholder='Dimensione (usare virgola per i decimali)' required><br>
                                <select name='kbmbgbtb' class='form-control' style='width: 40%;  position: relative; left: 30%' required>
                                    <option value=''>KB-MB-GB-TB:</option>
                                    <option value='KB'>KB</option>
                                    <option value='MB'>MB</option>
                                    <option value='GB'>GB</option>
                                    <option value='TB'>TB</option>
                                </select><br>
                                <button type='submit' name='comando' value='insert_host_special' style='height: auto;  position: relative; left: 45%'>Salva</button>
                            </form>
                            
                            <form action='index.php' method='post'>
                                        <!-- AGGIUNGI O ELIMINA UNA TIPOLOGIA -->
                                        <button type='submit' name='comando' value='add_hos_tipo' title='Aggiungi nuovo tipo di Host Special' style='border:none; position: absolute; top: 39%; left: 60%;' ><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                        <button type='submit' name='comando' value='page_del_hos_tipo' title='Elimina un tipo di Host Special' style='border:none; position: absolute; top: 39%; left: 65%;'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form><br>
                            </div>";
    }


    /**
     * Visualizza la pagina per aggiungere una nuova tipologia di host special
     */
    public function HTML_add_tipo_hosp()
    {
        echo"
            <div class='container'><br>";
        if(isset($_SESSION["post_ca_id"]))
        {
            if($_SESSION['cli_type'] == 'P'){
                echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='page_add_host_special' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
            }
            if($_SESSION['cli_type'] == 'T'){
                echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='page_add_host_special' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
            }
            if($_SESSION['cli_type'] == 'C'){
                echo"
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='page_add_host_special' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form><br><br>";
            }

        }
        echo"
                <center><img src='font/icon/object.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVA TIPOLOGIA DI HOST SPECIALE</h6></center>
                    <form action='index.php' enctype='multipart/form-data' method='post'>
                        <center>
                        <input type='text' class='form-control' id='hos_tipo' name='hos_tipo' style='width:40%' placeholder='Tipologia'><br>
                        <input name='icona' type='file' />
                        <button name='comando' value='insert_hos_tipo' style='height: 35px;'>Salva</button>
                        <!--button type='submit' name='comando' value='insert_hos_tipo' style='height: auto;'>Salva</button></center-->
                    </form>
            </div>";
    }


    /**
     * Visualizza la pagina per editare le info di un host special che si vuole modificare
     * @param $id
     * @param $etichetta
     * @param $tipo
     * @param $modello
     * @param $dimensione
     * @param $kbmbgbtb
     * @param $seriale
     * @param $TipiHostSpec
     */
    public function HTML_edit_special_host($id, $etichetta, $tipo, $modello, $dimensione, $kbmbgbtb, $seriale, $TipiHostSpec)
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
        echo"<center><img src='font/icon/object.png' height='40'><h6 class='docs-header'>MODIFICA HOST SPECIALE</h6></center>
                                <form action='index.php' method='post'>
                                    <div class='form-group'>
                                        <center>
                                            <input type='hidden' class='form-control' id='ho_id' name='ho_id' style='width:40%' value=$id><br>
                                            <input type='text' class='form-control' id='ho_etichetta' name='ho_etichetta' required style='width:40%' value='$etichetta' placeholder='Etichetta'><br>
                                            <select name='ho_tipo' class='form-control' style='width: 27%;'>
                                                <option value='$tipo'>$tipo</option>";
                                                    // Stampo le tipologie di host speciali prelevati dal db
                                                    foreach($TipiHostSpec as $row){
                                                        $TipoHostSpec = $row['hos_tipo'];
                                                        echo"<option value='$TipoHostSpec'>$TipoHostSpec</option>";
                                                    }

                                                echo"</select>
                                                <!-- Tasto per aggiungere un nuovo tipo di host speciale -->
                                                <form action='index.php' method='post'>
                                                    <button type='submit' name='comando' value='add_hos_tipo' title='Aggiungi nuovo tipo di Host Special' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                                    <button type='submit' name='comando' value='page_del_hos_tipo' title='Elimina un tipo di Host Special' style='border:none'><i class=\"fa fa-minus fa-2x\" aria-hidden=\"true\"></i></button>
                                                </form><br>
                                            <input type='text' class='form-control' id='ho_modello' name='ho_modello' style='width:40%' value='$modello' placeholder='Modello'><br>
                                            <input type='text' class='form-control' id='ho_seriale' name='ho_seriale' style='width:40%' value='$seriale' placeholder='Nr. Seriale'><br>
                                            <input type='text' class='form-control' id='evi_dimensione' name='evi_dimensione' style='width:40%' value='$dimensione' placeholder='Dimensione (separare con virgola i decimali)'><br>
                                            <select required name='evi_kbmbgbtb' class='form-control' style='width: 40%;'>
                                                <option value='$kbmbgbtb'>$kbmbgbtb</option>
                                                <option value='KB'>KB</option>
                                                <option value='MB'>MB</option>
                                                <option value='GB'>GB</option>
                                                <option value='TB'>TB</option>
                                            </select><br>
                                        <button type='submit' name='comando' value='update_host_special' color='black' style='height: auto'>SALVA</button>
                                        </center>
                                    </div>
                                </form>
                            </div>
            </div>";
    }


    /**
     * Visualizza la pagina che permette l'eliminazione delle tipologie di host special
     * @param $tipi
     */
    public function HTML_page_del_hos_tipo($tipi)
    {
        echo "
        <div class=\"container\"><br>";
            if(isset($_SESSION["post_ca_id"]))
                {
                    if($_SESSION['cli_type'] == 'P'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='page_add_host_special' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'T'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='page_add_host_special' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }
                    if($_SESSION['cli_type'] == 'C'){
                        echo "<form action='index.php' method='post' style='display: inline;'>
                        <button name ='comando' value='page_add_host_special' style='position: absolute; left: 0%; border: none;' title='Torna agli Indagati'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                    }

                }

                    echo"<br>
                         <br>
                         <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/collection.png' height='50'></th>
                                    <th>TIPO</th>
                                    <th>ELIMINA</th>
                                </tr>
                            </thead>
                            <tbody>";
        foreach ($tipi as $row)
        {
            $icona = $row['hos_icon'];
            echo"    <form action='index.php'  method='post'>
                        <tr>
                            <td><input type='hidden' id='hos_icon' name='hos_icon' value='$icona'><img src='$icona' height='40px'></td>
                            <td><input type='hidden' id='hos_tipo_id' name='hos_tipo_id'  value=" . $row['hos_tipo_id'] .">".$row['hos_tipo']."</td>
                            <td><button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='del_hos_tipo' style='border:hidden; padding: 0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button></td>
                        </tr>
                     </form>";
        }
            echo"</tbody>

        </table>
      </div>";

    }

}
