<?php
/**
 * Created by PhpStorm.
 * User: dwk
 * Date: 20/11/2016
 * Time: 17:21
 * Class HtmlAmministrazione
 * La classe si occupa di produrre codice HTML per visualizzare le pagine relative al pannello di amministrazione di CFCM
 * Solo l'utente ADMIN può accedere alle funzioni di questa classe
 */

class HtmlAmministrazione {


    /**
     * Visualizza i pulsanti di navigazione "indietro", "home",
     * @param $prev
     */
    public function HTML_nav($prev)
    {
        echo "<br>
              <div class=\"container\">
                <div class='row'>
                    <form action='index.php' method='post'>
                        <button name='comando' value='$prev' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>
                </div>";
    }


    /**
     * Visualizza la pagina contenente le informazioni dell'azienda utilizzatrice di CFCM
     * @param $aziende
     */
    public function HTML_azienda($aziende)
    {

        echo"<br>
                <div class='row'>
                     <center><b>Azienda</b></center><br>
                        <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/azienda.png' height='60' title='Qui puoi gestire i dati della tua azienda che verranno inseriti nel footer della copertina del caso'> </th>
                                    <th>AZIENDA</th>
                                    <th>CTU</th>
                                    <th>DEF.</th>
                                    <th>OPERAZIONI</th>
                                </tr>
                            </thead>

                            <tbody>";
        foreach ($aziende as $row)
        {
            echo"
                                        <form action='index.php'  method='post'>
                                            <tr>
                                                <td><input type='hidden' id='id' name='id'  value=" . $row['id'] ."></td>
                                                <td>". $row['rsoc'] ."</td>
                                                <td>". $row['ctu'] ."</td>
                                                <td>". $row['def'] ."</td>";
                                                $this->HTML_td_operazioni("view_azienda", "edit_azienda", "delete_azienda");
                                            echo"</tr>
                                        </form>
                                        ";
        }
        echo"
                                    </tbody>
                                    </table>
                                    <form action='index.php' method='post'>
                                    <button type='submit' title='Aggiungi Azienda' name='comando' value='add_azienda' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    ";
    }


    /**
     * Visualizza la pagina di inserimento di una nuova azienda
     */
    public function HTML_add_azienda(){
        echo"<br>
                <div class='row'>
                    <div style='text-align: center'><img src='font/icon/azienda.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVA AZIENDA</h6>
                        <form action='index.php' method='post'>
                            <div class='form-group'>
                                <input type='text' class='form-control' id='rsoc' name='rsoc' style='width:35%;' placeholder='Ragione Sociale' required><br>
                                <input type='text' class='form-control' id='ctu' name='ctu' style='width:35%;' placeholder='Cognome Nome del CTU' required><br>
                                <input type='text' class='form-control' id='indi' name='indi' style='width:35%;' placeholder='Indirizzo' required><br>
                                <input type='text' class='form-control' id='cap' name='cap' style='width:35%;' placeholder='Cap' required><br>
                                <input type='text' class='form-control' id='citta' name='citta' style='width:35%;' placeholder='Citta della propria camera di commercio' required><br>
                                <input type='text' class='form-control' id='tele' name='tele' style='width:35%;' placeholder='Telefono' required><br>
                                <input type='text' class='form-control' id='cell' name='cell' style='width:35%;' placeholder='Cellulare' required><br>
                                <input type='text' class='form-control' id='fax' name='fax' style='width:35%;' placeholder='Fax' required><br>
                                <input type='text' class='form-control' id='mail' name='mail' style='width:35%;' placeholder='Mail' required><br>
                                <input type='text' class='form-control' id='piva' name='piva' style='width:35%;' placeholder='P.iva' required><br>
                                <input type='text' class='form-control' id='rea' name='rea' style='width:35%;' placeholder='Nr. REA' required><br>
                                <select id='def' name='def' required>
                                    <option value=''>Imposta Azienda come default</option>
                                    <option value=0>NO</option>
                                    <option value=1>DEFAULT</option>
                                </select>
                            </div>
                                <button type='submit' name='comando' value='insert_azienda' style='height: auto; color: black;'>Salva</button>
                        </form>
                    </div>
                </div>
            </div>";
    }


    /**
     * Visualizza le info dell'azienda utilizzatrice di CFCM
     * @param string $rsoc: ragione sociale
     * @param string $ctu: nome e cognome del ctu
     * @param string $indi: indirizzo
     * @param string $cap: numero cap
     * @param string $citta: nome citta
     * @param string $tele: telefono
     * @param string $cell: cellulare
     * @param string $fax: fax
     * @param string $mail: mail
     * @param string $piva: partita IVA
     * @param string $rea: numero rea
     * @param int $def: 1 = impostata come default quindi viene visualizzata nella stampa della copertina del caso
     *                  0 = non è default quindi non viene visualizzata nella stampa della copertina del caso
     */
    public function HTML_view_azienda($rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def){
        echo"<br><br>
                <div class='row'>
                    <h6><b>RAG.SOCIALE: </b>$rsoc<br>
                    <b>CONSULENTE TECNICO: </b>$ctu<br>
                    <b>INDIRIZZO: </b>$indi<br>
                    <b>CAP: </b>$cap<br>
                    <b>CITTA CCIA: </b>$citta<br>
                    <b>TELEFONO: </b>$tele<br>
                    <b>CELLULARE: </b>$cell<br>
                    <b>FAX: </b>$fax<br>
                    <b>MAIL: </b>$mail<br>
                    <b>PIVA: </b>$piva<br>
                    <b>REA: </b>$rea<br>
                    <b>DEFAULT: </b>$def</h6><br>
                </div>";
    }


    /**
     * Visualizza la pagina di modifica delle info relative all'azienda
     * @param string $rsoc: ragione sociale
     * @param string $ctu: nome e cognome del ctu
     * @param string $indi: indirizzo
     * @param string $cap: numero cap
     * @param string $citta: nome citta
     * @param string $tele: telefono
     * @param string $cell: cellulare
     * @param string $fax: fax
     * @param string $mail: mail
     * @param string $piva: partita IVA
     * @param string $rea: numero rea
     * @param int $def: 1 = impostata come attiva quindi viene visualizzata nella stampa della copertina del caso
     *                  0 = non è default quindi non viene visualizzata nella stampa della copertina del caso
     */
    public function HTML_edit_azienda($id, $rsoc, $ctu, $indi, $cap, $citta, $tele, $cell, $fax, $mail, $piva, $rea, $def){
        echo"<br>
                <div class='row'>
                    <div style='text-align: center'><img src='font/icon/azienda.png' height='40'><h6 class='docs-header'>MODIFICA INFO AZIENDA</h6>
                        <form action='index.php' method='post'>
                            <div class='form-group'>
                                <input type='hidden' class='form-control' id='id' name='id' style='width:35%;' value='$id' required><br>
                                <input type='text' class='form-control' id='rsoc' name='rsoc' style='width:35%;' value='$rsoc' placeholder='Ragione Sociale' required><br>
                                <input type='text' class='form-control' id='ctu' name='ctu' style='width:35%;' value='$ctu' placeholder='Nome e Cognome CTU' required><br>
                                <input type='text' class='form-control' id='indi' name='indi' style='width:35%;' value='$indi' placeholder='Indirizzo' required><br>
                                <input type='text' class='form-control' id='cap' name='cap' style='width:35%;' value='$cap' placeholder='Cap' required><br>
                                <input type='text' class='form-control' id='citta' name='citta' style='width:35%;' value='$citta' placeholder='Citta' required><br>
                                <input type='text' class='form-control' id='tele' name='tele' style='width:35%;' value='$tele' placeholder='Telefono' required><br>
                                <input type='text' class='form-control' id='cell' name='cell' style='width:35%;' value='$cell' placeholder='Cellulare' required><br>
                                <input type='text' class='form-control' id='fax' name='fax' style='width:35%;' value='$fax' placeholder='Fax' required><br>
                                <input type='text' class='form-control' id='mail' name='mail' style='width:35%;' value='$mail' placeholder='E-mail' required><br>
                                <input type='text' class='form-control' id='piva' name='piva' style='width:35%;' value='$piva' placeholder='Partita IVA' required><br>
                                <input type='text' class='form-control' id='rea' name='rea' style='width:35%;' value='$rea' placeholder='Numero REA' required><br>
                                <select id='def' name='def' required>
                                    <option value='$def'>Attiva questa azienda per il report</option>
                                    <option value=0>DISATTIVA</option>
                                    <option value=1>ATTIVA</option>
                                </select>
                            </div>
                                <button type='submit' name='comando' value='update_azienda' style='height: auto; color: black;'>Salva</button>
                        </form>
                    </div>
                </div>
            </div>";
    }


    /**
     * La funzione visualizza la pagina di amministrazione degli utenti di CFCM
     * @param $utenti
     */
    public function HTML_amm_utenti($utenti)
    {

        echo"<br>
                <div class='row'>
                     <center><b>Utenti</b></center><br>
                        <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/utenti.png' height='60' title='Qui puoi aggiungere, modificare o eliminare un utente di CFCM'> </th>
                                    <th>UTENTI</th>
                                    <th>OPERAZIONI</th>
                                </tr>
                            </thead>

                            <tbody>";
        foreach ($utenti as $row)
        {
            echo"
                                        <form action='index.php'  method='post'>
                                            <tr>
                                                <td><input type='hidden' id='ute_id' name='ute_id'  value=" . $row['ute_id'] ."><img src='font/icon/utente.png' height='40'></td>
                                                <td><b>NOME:</b> ". $row['ute_nome'] ." &nbsp&nbsp <b>COGNOME:</b>".$row['ute_cognome']."<br><b>USER:&nbsp</b> ". $row['ute_username'] ." &nbsp&nbsp <b>IS_ADMIN:</b> ". $row['ute_isadmin'] ." </td>";
                                                $this->HTML_amm_utenti_operazioni("edit_utente", "delete_utente", $row['ute_username']);
                                            echo"</tr>
                                        </form>
                                        ";
        }
        echo"
                                    </tbody>
                                    </table>
                                    <form action='index.php' method='post'>
                                    <button type='submit' title='Aggiungi Utente' name='comando' value='add_utente' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    ";
    }


    /**
     * Visualizza la pagina di aggiunta nuovo utente di CFCM
     */
    public function HTML_add_utente(){
    echo"<br>
                <div class='row'>
                    <div style='text-align: center'><img src='font/icon/utente.png' height='40'><h6 class='docs-header'>INSERIMENTO NUOVO UTENTE</h6>
                        <form action='index.php' method='post'>
                            <div class='form-group'>
                                <input type='text' class='form-control' id='ute_nome' name='ute_nome' style='width:30%;' placeholder='Nome' required><br>
                                <input type='text' class='form-control' id='ute_cognome' name='ute_cognome' style='width:30%;' placeholder='Cognome' required><br>
                                <input type='text' class='form-control' id='ute_username' name='ute_username' style='width:30%;' placeholder='Username'><br>
                                <input type='text' class='form-control' id='ute_password' name='ute_password' style='width:30%;' placeholder='Password'><br>
                                <select id='ute_isadmin' name='ute_isadmin' required>
                                    <option value=''>Imposta utente come Admin</option>
                                    <option value=0>USER</option>
                                    <option value=1>ADMIN</option>
                                </select>
                            </div>
                                <button type='submit' name='comando' value='insert_utente' style='height: auto; color: black;'>Salva</button>
                        </form>
                    </div>
                </div>
            </div>";
}


    /**
     * Visualizza la pagina di modifca di un dato utente
     * @param int $id
     * @param string $nome
     * @param string $cognome
     * @param string $username
     * @param int $isadmin: 1=admin | 0=normale utente
     */
    public function HTML_edit_utente($id, $nome, $cognome, $username, $isadmin){
        echo"<br>
                <div class='row'>
                    <div style='text-align: center'><img src='font/icon/utente.png' height='40'><h6 class='docs-header'>MODIFICA UTENTE</h6>
                        <form action='index.php' method='post'>
                            <div class='form-group'>
                                <input type='hidden' class='form-control' id='ute_id' name='ute_id' style='width:30%;' value='$id' required><br>
                                <input type='text' class='form-control' id='ute_nome' name='ute_nome' style='width:30%;' value='$nome' required><br>
                                <input type='text' class='form-control' id='ute_cognome' name='ute_cognome' style='width:30%;' value='$cognome' required><br>
                                <input type='text' class='form-control' id='ute_username' name='ute_username' style='width:30%;' value='$username'><br>
                                <input type='text' class='form-control' id='ute_password' name='ute_password' style='width:30%;' placeholder='Password'><br>
                                <select id='ute_isadmin' name='ute_isadmin' required>
                                    <option value='$isadmin'>$isadmin</option>
                                    <option value=0>USER</option>
                                    <option value=1>ADMIN</option>
                                </select>
                            </div>
                                <button type='submit' name='comando' value='update_utente' style='height: auto; color: black;'>Salva</button>
                        </form>
                    </div>
                </div>
            </div>";
    }


    /**
     * Visualizza i pulsanti relativi alla modifica ed eliminazione degli utenti
     * @param $edit
     * @param $delete
     * @param $username
     */
    private function HTML_amm_utenti_operazioni($edit, $delete, $username)
    {
        echo "<td>
                <button class='button_operazioni' type='submit' name='comando' value='$edit' style='border:none;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>";
        if ($username != 'admin') {
            echo "<button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina' name='comando' value='$delete' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
           </td>";

        }

    }


    /**
     * Visualizza i pulsanti per le operazioni di visualizzazione, edit, eliminazione dell'azienda
     * @param $view
     * @param $edit
     * @param $delete
     */
    private function HTML_td_operazioni($view, $edit, $delete)
    {
        echo "<td>
                <button class='button_operazioni' type='submit' name='comando' value='$view' style='border:none;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\" title='Visualizza'></i></button>
                <button class='button_operazioni' type='submit' name='comando' value='$edit' style='border:none;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\" title='Modifica'></i></button>
                <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina' name='comando' value='$delete' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
           </td>";



    }


}
