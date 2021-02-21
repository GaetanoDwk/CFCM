<?php


/**
 * Class HtmlPm
 * La classe si occupa delle funzioni di visualizzazione dei dati relativi ai PM
 */
class HtmlPm {

    /**
     * Visualizza tutti i PM di un cliente
     * @param $res
     * @param $NomeCliente
     */
    public function HTML_pm_of_cliente($res, $NomeCliente)
    {
        echo "
            <div class='container'><br>";

                    echo "<form action='index.php' method='post' style='display: inline;'>";
                        if($_SESSION['cli_type'] == "P")
                        {
                            echo"<button name='comando' value='view_procure' style='position: absolute; left: 0%; border: none;' title='Torna alle Procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                 <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                 <br><br>
                                 <center><b>$NomeCliente</b></center><br>
                                 <table class=\"u-full-width\">
                                    <thead style='color: #1188FF'>
                                        <tr>
                                            <th><img src='font/icon/pm.png' height='60'> </th>
                                            <th>PM</th>
                                            <th>OPERAZIONI</th>
                                        </tr>
                                    </thead>";
                        }
                        if($_SESSION['cli_type'] == "T")
                        {
                            echo"<button name='comando' value='view_tribunali' style='position: absolute; left: 0%; border: none;' title='Torna alle Procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                 <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                 <br><br>
                                 <center><b>$NomeCliente</b></center><br>
                                 <table class=\"u-full-width\">
                                    <thead style='color: #1188FF'>
                                        <tr>
                                            <th><img src='font/icon/pm.png' height='60'> </th>
                                            <th>PM</th>
                                            <th>OPERAZIONI</th>
                                        </tr>
                                    </thead>";
                        }
                        if($_SESSION['cli_type'] == "C")
                        {
                            echo"<button name='comando' value='return_to_ctp' style='position: absolute; left: 0%; border: none;' title='Torna alle Ctp'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                                 <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                                 <br><br>
                            <center><b>$NomeCliente</b></center><br>
                            <table class=\"u-full-width\">
                                <thead style='color: #1188FF'>
                                    <tr>
                                        <th><img src='font/icon/avvocato.png' height='60'> </th>
                                        <th>AVVOCATO</th>
                                        <th>OPERAZIONI</th>
                                    </tr>
                                </thead>";
                        }
                          echo"</form>";

        echo"<tbody>";
                    foreach ($res as $row)
                    {
                        echo"

                            <form action='index.php'  method='post'>
                                <tr>
                                    <td><input type='hidden' id='pm_id' name='pm_id'  value=" . $row['pm_id'] ."></td>
                                    <td>". $row['pm_cognome']." " . $row['pm_nome']."</td>
                                    <td><button type='submit' name='comando' title='Visualizza i casi del PM' value='view_pm' style='border:hidden; width:5px'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                                    <button type='submit' name='comando' value='edit_pm' title='Modifica dati PM' style='border:hidden; width:5px'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                                    <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina PM' name='comando' value='delete_pm' style='border:hidden;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>


                                </tr>
                            </form>";
                    }
                    echo"
                    </tbody>
                    </table>
                    <form action='index.php' method='post'>
                        <button type='submit' title='Aggiungi PM' name='comando' value='page_add_pm' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                    </form>
                    </div>";
    }


    /**
     * Visualizza la pagina di un dato PM
     * @param $Pm
     */
    public function HTML_pm($Pm)
            {
                echo "<div class=\"container\"><br>";

                if($_SESSION['cli_type'] == 'P'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='ricerca' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='ricerca' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='ricerca' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                     echo"<br><br>
                     <center><b>Lista Pm</b></center><br>
                        <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/procura.png' height='60'> </th>
                                    <th>PM</th>
                                    <th>OPERAZIONI</th>
                                </tr>
                            </thead>

                            <tbody>";
                                foreach ($Pm as $row)
                                {
                                    echo"
                                        <form action='index.php'  method='post'>
                                            <tr>
                                                <td><input type='hidden' id='pm_id' name='pm_id'  value=" . $row['pm_id'] ."></td>
                                                <td>". $row['pm_cognome'] ." ". $row['pm_nome'] . "</td>
                                                <td>
                                                <button class='button_operazioni' type='submit' title='Visualizza i CASI' name='comando' value='return_to_pm' style='border:none;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto edit per ora nascosto. Da abilitare quando svilupperò meccanismi di modifica-->
                                                <button class='button_operazioni' type='submit' name='comando' value='edit_pm' style='border:none;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto elimina con evento JS per la richiesta di conferma per l'eliminazione-->
                                                <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Pm' name='comando' value='delete_pm' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto senza JS da abilitare in caso di problemi con il precedente con JS-->
                                                <!--button class='button_operazioni' type='submit' name='comando' value='delete_procura' style='border:none'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button--></td>
                                            </tr>
                                        </form>";
                                }
                                echo"
                                    </tbody>
                                    </table>
                                    <form action='index.php' method='post'>
                                    <button type='submit' title='Aggiungi Pm' name='comando' value='add_pm' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    ";
            }


    /**
     * Visualizza la pagina di ricerca con in più il messaggio che non ha trovato nessun PM corrispondente alla stringa utilizzata
     */
    public function HTML_ricerca_pm_not_found()
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
                        <input type='text' align='center' id='ric' name='ric' placeholder='Pm non trovato' style='width: 200px; color: red; border-color: red;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_pm' title='Ricerca Pm'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>
                
                    <form action='index.php' method='post'>
                        <input type='text' align='center' id='ric' name='ric' placeholder='Numero-anno del caso' style='width: 200px;'>&nbsp
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


    /**
     * Visualizza la pagina di aggiunta di un nuovo pm
     * @param $count
     */
    public function HTML_add_pm_of_cliente($count){
        echo"<div class='container'><br>";
                if(isset($_SESSION["post_cli_id"]))
                {
                    if($_SESSION['cli_type'] == 'P') {
                        echo "<form action='index.php' method='post'>
                            <button name='comando' value='return_to_procura' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                          </form>";
                    }
                    if($_SESSION['cli_type'] == 'T') {
                        echo "<form action='index.php' method='post'>
                            <button name='comando' value='return_to_tribunale' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                          </form>";
                    }
                    if($_SESSION['cli_type'] == 'C') {
                        echo "<form action='index.php' method='post'>
                            <button name='comando' value='return_to_ctp' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                          </form>";
                    }

                }
                echo"<br><br><center><img src='font/icon/pm.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO PM</h6></center>";
                if($count > 0){echo"<h6 style='color: red'>Riprova. PM gia' esistente</h6>";}
                echo"<form action='index.php' method='post'>
                        <center>";
                        // STAMPO  LA SELECT
                        $this->HTML_select_for_pm();

                        echo"<input type='text' class='form-control' id='pm_nome' name='pm_nome' style='width:40%' placeholder='Nome' required><br>
                        <input type='text'  class='form-control' id='pm_cognome' name='pm_cognome' style='width:40%' placeholder='Cognome' required><br>

                            <button type='submit' name='comando' value='insert_pm_of_cliente' style='height: auto;'>Salva</button>
                        </center>
                      </form>
                </div>";
    }

    /**
     * Visualizza l'edit box da cui è possibile selezionare il titolo del pm, avvocato, giudice
     */
    private function HTML_select_for_pm()
    {
        if(($_SESSION['cli_type'] == 'P') || ($_SESSION['cli_type'] == 'T'))
        {
            echo"<select required name='pm_titolo' class='form-control' style='width: 40%;'>
                            <option value=''>Titolo:</option>
                            <option value='Dott.'>Dott.</option>
                            <option value='Dott.ssa'>Dott.ssa</option>
                            <option value='Giudice'>Giudice</option>
                        </select><br>";
        }
        if($_SESSION['cli_type'] == 'C')
        {
            echo"<select required name='pm_titolo' class='form-control' style='width: 40%;'>
                            <option value=''>Titolo:</option>
                            <option value='Avvocato'>Avvocato</option>
                        </select><br>";
        }

    }


    /**
     * Visualizza la pagina che serve a modificare le info di un dato PM
     * @param $id
     * @param $tit
     * @param $nome
     * @param $cognome
     */
    public function HTML_edit_pm($id, $tit, $nome, $cognome)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_cli_id"]))
            {
                if($_SESSION['cli_type'] == 'P') {
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='return_to_procura' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'T') {
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='return_to_tribunale' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'C') {
                    echo"<form action='index.php' method='post'>
                            <button name='comando' value='return_to_ctp' style='position: absolute; left: 0%; border: none;' title='Visualizza Ultima Lista Host aperta'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }

            }
            echo"
            <br><br>
            <center><img src='font/icon/pm.png' height='40'></center><center><h6 class='docs-header'>MODIFICA PM</h6></center>
                <form action='index.php' method='post'>
                    <div class='form-group'>
                    <center>
                        <input type='hidden' class='form-control' id='pm_id' name='pm_id' style='width:90%' value=$id><br>
                        <select required name='pm_titolo' class='form-control' style='width: 40%;'>
                            <option value='$tit'>$tit</option>
                            <option value='Dott.'>Dott.</option>
                            <option value='Dott.ssa'>Dott.ssa</option>
                            <option value='Giudice'>Giudice</option>
                            <option value='Avvocato'>Avvocato</option>
                        </select><br>
                        <input type='text' class='form-control' id='pm_nome' name='pm_nome' style='width:40%' value=$nome placeholder='Nome'><br>
                        <input type='text' class='form-control' id='pm_cognome' name='pm_cognome' required style='width:40%' value='$cognome' placeholder='Cognome'><br>
                        <button type='submit' name='comando' value='pm_update' style='height: auto;'>SALVA</button></center>
                    </div>
                </form>
        </div>";
    }

}
