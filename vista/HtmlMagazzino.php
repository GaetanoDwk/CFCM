<?php

/**
 * Class HtmlMagazzino
 * La classe si occupa delle operazioni di visualizzazione dei dati relativi al magazzino
 */
class HtmlMagazzino
{
    /**
     * Visualizza tutti i "colli" (pacchi) presenti in magazzino e da dover riconsegnare al cliente
     * @param $magazzino
     */
    public function HTML_magazzino($magazzino)
    {
        echo "<br><form action='index.php' method='post'>
                <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='magazzino' style='position: absolute; left: 9%; border: none;' title='Refresh'><i class='fa fa-refresh fa-2x' aria-hidden='true'></i></button>
             </form>
             
             <br><br>
             <center><b>Magazzino</b><br><br>
                <table border='2' style='border-collapse: separate; border-color: black;'>
                    <thead>
                    <tr>
                        <th style='padding: 10px;'><center><img src='./font/icon/operazioni.png' width='35px' title='Operazioni'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/procura.png' width='35px' title='Procura'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/pm.png' width='35px' title='Pm'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/dossier.png' width='35px' title='Dossier'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/plico.png' width='35px' title='Plichi'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/data.png' width='35px' title='Data Creazione'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/note.png' width='35px' title='Note'></center></th>
                    </tr>
                    </thead>
                    <tbody>";

        foreach ($magazzino as $row) {
            $id = $row['id'];
            $procura = $row['procura'];
            $pm = $row['pm'];
            $dossier = $row['dossier'];
            $plico = $row['plico'];
            $data = $row['dataC'];
            $note = $row['note'];


            echo "<form action='index.php' method='post'>
                <tr>
                    <td style='padding: 10px;'>
                        <center>
                            <form action='index.php' method='post'>
                                <input type='hidden' name='idMag' value=$id>
                                <button type='submit' name='comando' value='edit_magazzino' style='border:none; padding: 0px 4px;'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button>
                                <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='delete_magazzino' style='border:hidden; padding: 0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                            </form>
                        </center>
                    </td>
                    <td style='padding: 10px;'>$procura</td>
                    <td style='padding: 10px;'>$pm</td>
                    <td style='padding: 10px;'>$dossier</td>
                    <td style='padding: 10px;'>$plico</td>
                    <td style='padding: 10px;'>$data</td>
                    <td style='padding: 10px;'>$note</td>
                </tr>
             </form>";
        }

        echo"<tr>
                <td>
                    <form action='index.php' method='post'>
                        <button type='submit' name='comando' value='add_magazzino' title='Aggiungi una consegna' style='border: none'><img src='font/icon/magazzino_.png' height='30px'></button>
                    </form>
                </td>
            </tr>
            </tbody>
            </table>
            <br>";


    }


    /**
     * Visualizza la pagina che permette di aggiungere un nuovo collo (pacchi)
     */
    public function HTML_add_magazzino()
    {
        echo"<br><form action='index.php' method='post'>
                <button name='comando' value='magazzino' style='position: absolute; left: 6%; border: none;' title='Torna Indietro'><i class='fa fa-chevron-left fa-2x' aria-hidden='true'></i></button>
             </form>
             <br><br>
        <center><b>Magazzino</b><br><br>
                <table border='2' style='border-collapse: separate; border-color: black;'>
                    <thead>
                    <tr>
                        <th style='padding: 10px;'><center><img src='./font/icon/procura.png' width='35px' title='Procura'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/pm.png' width='35px' title='Pm'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/dossier.png' width='35px' title='Dossier'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/plico.png' width='35px' title='Plico'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/data.png' width='35px' title='Data Creazione'></center></th>
                        <th style='padding: 10px;'><center><img src='./font/icon/note.png' width='35px' title='Note'></center></th>
                    </tr>
                    </thead>
                    <tbody>
                        <form action='index.php' method='post'>
                            <tr>
                                <td style='padding: 10px;'><input type='text' name='procura' style='width: 150px;' required></td>
                                <td style='padding: 10px;'><input type='text' name='pm' style='width: 150px;' required></td>
                                <td style='padding: 10px;'><input type='text' name='dossier' style='width: 100px;' required></td>
                                <td style='padding: 10px;'><input type='number' name='plico' style='width: 70px;' required></td>
                                <td style='padding: 10px;'><input type='date' name='dataC' style='width: 120px;' required placeholder='dd-mm-aaaa'></td>
                                <td style='padding: 10px;'><input type='text' name='note' style='width: 200px;'></td>
                                <td bgcolor='#d3d3d3' style='padding: 10px;'>
                                    <center>
                                        <button type='submit' name='comando' value='insert_magazzino' style='border:none; padding: 0px 4px;'><img src='./font/icon/floppydisk.png' width='35px' title='Salva'></button>
                                    </center>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
        </center><br>";
    }


    /**
     * Visualizza la pagina che permette di modificare le informazioni relative ad un collo (pacchi)
     * @param $id
     * @param $procura
     * @param $pm
     * @param $dossier
     * @param $plico
     * @param $dataC
     * @param $note
     */
    public function HTML_edit($id, $procura, $pm, $dossier, $plico, $dataC, $note)
    {
        echo"<br><form action='index.php' method='post'>
                <button name='comando' value='magazzino' style='position: absolute; left: 6%; border: none;' title='Torna Indietro'><i class='fa fa-chevron-left fa-2x' aria-hidden='true'></i></button>
             </form>
             <br><br>
        <center><b>Magazzino</b><br><br>
                <table border='2' style='border-collapse: separate; border-color: black;'>
                    <thead>
                    <tr>
                        <th style='padding: 10px;'><img src='./font/icon/operazioni.png' width='35px' title='Operazioni'></th>
                        <th style='padding: 10px;'><img src='./font/icon/procura.png' width='35px' title='Procura'></th>
                        <th style='padding: 10px;'><img src='./font/icon/pm.png' width='35px' title='Pm'></th>
                        <th style='padding: 10px;'><img src='./font/icon/dossier.png' width='35px' title='Dossier'></th>
                        <th style='padding: 10px;'><img src='./font/icon/plico.png' width='35px' title='Plico'></th>
                        <th style='padding: 10px;'><img src='./font/icon/data.png' width='35px' title='Data Creazione'></th>
                        <th style='padding: 10px;'><img src='./font/icon/note.png' width='35px' title='Note'></th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action='index.php' method='post'>
                        <tr>
                            <td style='padding: 10px;'>
                                <center>
                                    <input type='hidden' name='idMag' value=$id>
                                        <button type='submit' name='comando' value='update_magazzino' style='border:none; padding: 0px 4px;'><i class='fa fa-floppy-o fa-3x' aria-hidden='true'></i></button>
                                </center>
                            </td>
                            <td style='padding: 10px;'><input type='text' name='procura' style='width: 90px;' value=\"$procura\" required></td>
                            <td style='padding: 10px;'><input type='text' name='pm' style='width: 150px;' value=\"$pm\" required></td>
                            <td style='padding: 10px;'><input type='text' name='dossier' style='width: 150px;' value=\"$dossier\" required></td>
                            <td style='padding: 10px;'><input type='number' name='plico' style='width: 150px;' value=\"$plico\" required></td>
                            <td style='padding: 10px;'><input type='date' name='dataC' style='width: 150px;' value=$dataC placeholder='dd-mm-aaaa' required></td>
                            <td style='padding: 10px;'><input type='text' name='note' style='width: 150px;' value=\"$note\"></td>
                            </tr>
                                </form>
                            </tbody>
                        </table>
                    </center><br>";
    }
    
}
