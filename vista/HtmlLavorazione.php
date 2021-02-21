<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 25/11/2016
 * Time: 12:32
 */
class HtmlLavorazione
{

    function HTML_lavorazione($lavorazioni)
    {
        if($_SESSION['cli_type'] == 'P') {
            echo "<br><form action='index.php' method='post'>
                <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='lavorazione' style='position: absolute; left: 9%; border: none;' title='Refresh'><i class='fa fa-refresh fa-2x' aria-hidden='true'></i></button>
             </form>";
        }
        if($_SESSION['cli_type'] == 'T') {
            echo "<br><form action='index.php' method='post'>
                <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='lavorazione' style='position: absolute; left: 9%; border: none;' title='Refresh'><i class='fa fa-refresh fa-2x' aria-hidden='true'></i></button>
             </form>";
        }
            if ($_SESSION['cli_type'] == 'C') {
                echo "<br><form action='index.php' method='post'>
                <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='lavorazione' style='position: absolute; left: 9%; border: none;' title='Refresh'><i class='fa fa-refresh fa-2x' aria-hidden='true'></i></button>
             </form>";
        }


        echo"
             <br><br>
             <center><b>Lavorazione</b><br><br>
                <table border='2' style='border-collapse: separate; border-color: black;'>
                    <thead style='color: #1188FF'>
                    <tr>
                        <th style='padding: 10px;'><img src='./font/icon/operazioni.png' width='27px' title='Operazioni'></th>
                        <th style='padding: 10px;'><img src='./font/icon/dossier.png' width='27px' title='Dossier'></th>
                        <th style='padding: 10px;'><img src='./font/icon/pm.png' width='27px' title='Pm'></th>
                        <th style='padding: 10px;'><img src='./font/icon/procura.png' width='27px' title='Procura'></th>
                        <th style='padding: 10px;'>Data Inizio</th>
                        <th style='padding: 10px;'>GG</th>
                        <th style='padding: 10px;'>Data Fine</th>
                        <th style='padding: 10px;'>GGR</th>
                        <th style='padding: 10px;'><img src='./font/icon/copia.png' width='27px' title='Copia'></th>
                        <th style='padding: 10px;'><img src='./font/icon/ad.png' width='27px' title='FTK'></th>
                        <th style='padding: 10px;'><img src='./font/icon/ief.png' width='27px' title='IEF'></th>
                        <th style='padding: 10px;'><img src='./font/icon/analisi.png' width='27px' title='Analisi'></th>
                        <th style='padding: 10px;'><img src='./font/icon/export.png' width='27px' title='Export-Report'></th>
                        <th style='padding: 10px;'><img src='./font/icon/pdf.png' width='27px' title='Case Manager'></th>
                        <th style='padding: 10px;'><img src='./font/icon/allegati.png' width='27px' title='Allegati'></th>
                        <th style='padding: 10px;'><img src='./font/icon/euro.png' width='27px' title='Liquidazione'></th>
                        <th style='padding: 10px;'><img src='./font/icon/difficolta.png' width='27px' title='Diff.'></th>
                        <th style='padding: 10px;'>PROGRESSO</th>
                        <th style='padding: 10px;'><img src='./font/icon/note.png' width='27px' title='Note'></th>
                        <th style='padding: 10px;'><img src='./font/icon/userblack.png' width='27px' title='Assegnato a'></th>
                    </tr>
                    </thead>
                    <tbody>";

                    foreach($lavorazioni as $row)
                     {
                         $id = $row['id'];
                         $numero = $row['numero'];
                         $pm = $row['pm'];
                         $procura = $row['procura'];
                         $dinizio = $row['dinizio'];
                         $gg = $row['gg'];
                         $dfine = $row['dfine'];
                         $ggrestanti = $row['ggrestanti'];
                         $copia = $row['copia'];
                         $ftk = $row['ftk'];
                         $ief = $row['ief'];
                         $analisi = $row['analisi'];
                         $exprep = $row['exprep'];
                         $dim = $row['dim'];
                         $allegati = $row['allegati'];
                         $liquidazione = $row['liquidazione'];
                         $difficolta = $row['difficolta'];
                         $progresso = $row['progresso'];
                         $note = $row['note'];
                         $operatore = $row['operatore'];
                         echo"<form action='index.php' method='post'>
                                <tr>
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'>
                                        <center>
                                        <form action='index.php' method='post'>
                                        <input type='hidden' name='idlav' value=$id>
                                        <button type='submit' name='comando' value='edit_lavorazione' style='border:none; padding: 0px 4px;'><i class='fa fa-pencil-square-o fa-2x' aria-hidden='true'></i></button>
                                        <button onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='delete_lavorazione' style='border:hidden; padding: 0px 0px;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                                        </form>
                                        </center>
                                    </td>
                                    <td bgcolor='#87cefa' style='padding: 10px;'>$numero</td>
                                    <td bgcolor='#87cefa' style='padding: 10px;'>$pm</td>
                                    <td bgcolor='#87cefa' style='padding: 10px;'>$procura</td>
                                    <td bgcolor='#ffa07a' style='padding: 10px;'>$dinizio</td>
                                    <td bgcolor='#ffa07a' style='padding: 10px;'>$gg</td>
                                    <td bgcolor='#ffa07a' style='padding: 10px;'>$dfine</td>";
                                    if($ggrestanti < 10){echo"<td bgcolor='red' style='padding: 10px; border-color: black;'>$ggrestanti</td>";}
                                    if(($ggrestanti >= 10) && ($ggrestanti < 15)){echo"<td bgcolor='orange' style='padding: 10px;'>$ggrestanti</td>";}
                                    if(($ggrestanti >= 15) && ($ggrestanti < 20)){echo"<td bgcolor='yellow' style='padding: 10px;'>$ggrestanti</td>";}
                                    if(($ggrestanti >= 20) && ($ggrestanti < 30)){echo"<td bgcolor='#90ee90' style='padding: 10px;'>$ggrestanti</td>";}
                                    if($ggrestanti >= 30){echo"<td bgcolor='green' style='padding: 10px; color: white;'>$ggrestanti</td>";}
                                    $this->HTML_td($copia);
                                    $this->HTML_td($ftk);
                                    $this->HTML_td($ief);
                                    $this->HTML_td($analisi);
                                    $this->HTML_td($exprep);
                                    $this->HTML_td($dim);
                                    $this->HTML_td($allegati);
                                    $this->HTML_td($liquidazione);
                                    $this->HTML_td_difficolta($difficolta);
                         echo"
                                    <td style='padding: 10px;'><progress value='$progresso' max='100'></progress> $progresso%</td>
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'>$note</td>
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'>$operatore</td>
                                </tr>
                                </form>";

                     }


                        echo"
                            <tr>
                                <td>
                                    <form action='index.php' method='post'>
                                        <button type='submit' name='comando' value='add_lavorazione' title='Aggiungi un lavoro' style='border: none'><img src='font/icon/lavorazione.png' height='30px'></button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </center>
                    <br>";
    }







    public function HTML_add_lavorazione()
    {
        echo"<br><form action='index.php' method='post'>
                <button name='comando' value='lavorazione' style='position: absolute; left: 6%; border: none;' title='Torna Indietro'><i class='fa fa-chevron-left fa-2x' aria-hidden='true'></i></button>
             </form>
             <br><br>
        <center><b>Lavorazione</b><br><br>
                <table border='2' style='border-collapse: separate; border-color: black;'>
                    <thead style='color: #1188FF'>
                    <tr>
                        <th style='padding: 10px;'><img src='./font/icon/dossier.png' width='27px' title='Dossier'></th>
                        <th style='padding: 10px;'><img src='./font/icon/pm.png' width='27px' title='Pm'></th>
                        <th style='padding: 10px;'><img src='./font/icon/procura.png' width='27px' title='Procura'></th>
                        <th style='padding: 10px;'>Data Inizio</th>
                        <th style='padding: 10px;'>GG</th>
                        <th style='padding: 10px;'>Data Fine</th>
                        <th style='padding: 10px;'>GGR</th>
                        <th style='padding: 10px;'><img src='./font/icon/copia.png' width='27px' title='Copia'></th>
                        <th style='padding: 10px;'><img src='./font/icon/ad.png' width='27px' title='FTK'></th>
                        <th style='padding: 10px;'><img src='./font/icon/ief.png' width='27px' title='IEF'></th>
                        <th style='padding: 10px;'><img src='./font/icon/analisi.png' width='27px' title='Analisi'></th>
                        <th style='padding: 10px;'><img src='./font/icon/export.png' width='27px' title='Export-Report'></th>
                        <th style='padding: 10px;'><img src='./font/icon/pdf.png' width='27px' title='Case Manager'></th>
                        <th style='padding: 10px;'><img src='./font/icon/allegati.png' width='27px' title='Allegati'></th>
                        <th style='padding: 10px;'><img src='./font/icon/euro.png' width='27px' title='Liquidazione'></th>
                        <th style='padding: 10px;'><img src='./font/icon/difficolta.png' width='27px' title='Difficolta'></th>
                        <th style='padding: 10px;'>PROGRESSO</th>
                        <th style='padding: 10px;'><img src='./font/icon/note.png' width='27px' title='Note'></th>
                        <th style='padding: 10px;'><img src='./font/icon/userblack.png' width='27px' title='Assegnato a'></th>
                        <th style='padding: 10px;'><img src='./font/icon/operazioni.png' width='27px' title='Operazioni'></th>
                    </tr>
                    </thead>
                    <tbody>
                    <form action='index.php' method='post'>
                        <tr>
                            <td bgcolor='#87cefa' style='padding: 10px;'><input type='text' name='numero' style='width: 90px;'></td>
                            <td bgcolor='#87cefa' style='padding: 10px;'><input type='text' name='pm' style='width: 150px;'></td>
                            <td bgcolor='#87cefa' style='padding: 10px;'><input type='text' name='procura' style='width: 90px;'></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'><input type='date' name='dinizio' style='width: 130px;'></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'><input type='number' name='gg' style='width: 60px;'></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'></td>";
                            $this->HTML_td_add("copia");
                            $this->HTML_td_add("ftk");
                            $this->HTML_td_add("ief");
                            $this->HTML_td_add("analisi");
                            $this->HTML_td_add("exprep");
                            $this->HTML_td_add("dim");
                            $this->HTML_td_add("allegati");
                            $this->HTML_td_add("liquidazione");
                            $this->HTML_td_add_difficolta();
                         echo"
                                    <td style='padding: 10px;'><progress value='0' max='100'></progress></td>
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'><input type='text' name='note' style='width: 90px;'></td>
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'><input type='text' name='operatore' style='width: 90px;'></td>
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'>
                                        <center>
                                        <button type='submit' name='comando' value='insert_lavorazione' style='border:none; padding: 0px 4px;'><i class='fa fa-floppy-o fa-3x' aria-hidden='true'></i></button>
                                        </center>
                                    </td>
                                </tr>
                                </form>";




                        echo"
                            </tbody>
                        </table>
                    </center><br>";
    }






    public function HTML_edit_lavorazione($IdLav, $num, $pm, $pro, $din, $gg, $dfin, $ggr, $cop, $ftk, $ief, $ana, $exprep, $dim, $all, $liq, $diff, $prog, $note, $ope)
    {
        echo"<br><form action='index.php' method='post'>
                <button name='comando' value='lavorazione' style='position: absolute; left: 6%; border: none;' title='Torna Indietro'><i class='fa fa-chevron-left fa-2x' aria-hidden='true'></i></button>
             </form>
             <br><br>
        <center><b>Lavorazione</b><br><br>
                <table border='2' style='border-collapse: separate; border-color: black;'>
                    <thead style='color: #1188FF'>
                    <tr>
                        <th style='padding: 10px;'><img src='./font/icon/operazioni.png' width='27px' title='Operazioni'></th>
                        <th style='padding: 10px;'><img src='./font/icon/dossier.png' width='27px' title='Dossier'></th>
                        <th style='padding: 10px;'><img src='./font/icon/pm.png' width='27px' title='Pm'></th>
                        <th style='padding: 10px;'><img src='./font/icon/procura.png' width='27px' title='Procura'></th>
                        <th style='padding: 10px;'>Data Inizio</th>
                        <th style='padding: 10px;'>GG</th>
                        <th style='padding: 10px;'>Data Fine</th>
                        <th style='padding: 10px;'>GGR</th>
                        <th style='padding: 10px;'><img src='./font/icon/copia.png' width='27px' title='Copia'></th>
                        <th style='padding: 10px;'><img src='./font/icon/ad.png' width='27px' title='FTK'></th>
                        <th style='padding: 10px;'><img src='./font/icon/ief.png' width='27px' title='IEF'></th>
                        <th style='padding: 10px;'><img src='./font/icon/analisi.png' width='27px' title='Analisi'></th>
                        <th style='padding: 10px;'><img src='./font/icon/export.png' width='27px' title='Export-Report'></th>
                        <th style='padding: 10px;'><img src='./font/icon/pdf.png' width='27px' title='Case Manager'></th>
                        <th style='padding: 10px;'><img src='./font/icon/allegati.png' width='27px' title='Allegati'></th>
                        <th style='padding: 10px;'><img src='./font/icon/euro.png' width='27px' title='Liquidazione'></th>
                        <th style='padding: 10px;'><img src='./font/icon/difficolta.png' width='27px' title='Difficolta'></th>
                        <th style='padding: 10px;'><img src='./font/icon/note.png' width='27px' title='Note'></th>
                        <th style='padding: 10px;'><img src='./font/icon/userblack.png' width='27px' title='Assegnato a'></th>
                        </tr>
                    </thead>
                    <tbody>
                    <form action='index.php' method='post'>
                        <tr>
                            <td bgcolor='#d3d3d3' style='padding: 10px;'>
                                <center>
                                    <input type='hidden' name='idlav' value=$IdLav>
                                        <button type='submit' name='comando' value='update_lavorazione' style='border:none; padding: 0px 4px;'><i class='fa fa-floppy-o fa-3x' aria-hidden='true'></i></button>
                                </center>
                            </td>
                            <td bgcolor='#87cefa' style='padding: 10px;'><input type='text' name='numero' style='width: 90px;' value=$num></td>
                            <td bgcolor='#87cefa' style='padding: 10px;'><input type='text' name='pm' style='width: 150px;' value=\"$pm\"></td>
                            <td bgcolor='#87cefa' style='padding: 10px;'><input type='text' name='procura' style='width: 90px;' value=\"$pro\"></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'><input type='date' name='dinizio' style='width: 92px;' value=\"$din\" placeholder='dd-mm-aaaa'></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'><input type='text' name='gg' style='width: 45px;' value=$gg></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'><input type='text' name='dfin' style='width: 92px; background-color: lightgrey' value=$dfin disabled></td>
                            <td bgcolor='#ffa07a' style='padding: 10px;'><input type='text' name='ggr' style='width: 45px; background-color: lightgrey' value=$ggr disabled></td>";
                            $this->HTML_td_edit($cop, "copia");
                            $this->HTML_td_edit($ftk, "ftk");
                            $this->HTML_td_edit($ief, "ief");
                            $this->HTML_td_edit($ana, "analisi");
                            $this->HTML_td_edit($exprep, "exprep");
                            $this->HTML_td_edit($dim, "dim");
                            $this->HTML_td_edit($all, "allegati");
                            $this->HTML_td_edit($liq, "liquidazione");
                            $this->HTML_td_edit_difficolta($diff, "difficolta");
                         echo"
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'><input type='text' name='note' style='width: 90px;' value='$note'></td>
                                    <td bgcolor='#d3d3d3' style='padding: 10px;'><input type='text' name='operatore' style='width: 90px;' value=$ope></td>

                                </tr>
                                </form>";




                        echo"
                            </tbody>
                        </table>
                    </center><br>";
    }





    private function HTML_td($num)
    {
        if($num == 0){echo"<td bgcolor='red' style='padding: 10px;'></td>";}
        if($num == 1){echo"<td bgcolor='green' style='padding: 10px;'></td>";}
        if($num == 2){echo"<td bgcolor='#808080' style='padding: 10px;'></td>";}
    }

    private function HTML_td_difficolta($num)
    {
        if($num == 0){echo"<td style='padding: 10px;'><img src='./font/icon/difficoltaGR.png' width='27px' title='Difficolta'></td>";}
        if($num == 1){echo"<td style='padding: 10px;'><img src='./font/icon/difficoltaV.png' width='27px' title='Difficolta'></td>";}
        if($num == 2){echo"<td style='padding: 10px;'><img src='./font/icon/difficoltaG.png' width='27px' title='Difficolta'></td>";}
        if($num == 3){echo"<td style='padding: 10px;'><img src='./font/icon/difficoltaR.png' width='27px' title='Difficolta'></td>";}
    }

    private function HTML_td_add($name)
    {
            echo"<td bgcolor='white' style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 65px;'>
                        <option value=0>NO</option>
                        <option value=1>SI</option>
                        <option value=2>-</option>
                    </select>
            </td>";
    }

    private function HTML_td_add_difficolta()
    {
        echo"<td bgcolor='white' style='padding: 10px;'>
                    <select required name='difficolta' class='form-control' style='width: 65px;'>
                        <option style='background-color: gray' value=0>GR.</option>
                        <option style='background-color: green' value=1>V.</option>
                        <option style='background-color: yellow' value=2>G.</option>
                        <option style='background-color: red'  value=3>R.</option>
                    </select>
            </td>";
    }

    private function HTML_td_edit($num, $name)
    {
        if($num == 0)
        {
            echo"<td bgcolor='red' style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 62px;'>
                        <option value=0>NO</option>
                        <option value=1>SI</option>
                        <option value=2>-</option>
                    </select>
            </td>";
        }
        if($num == 1)
        {
            echo"<td bgcolor='green' style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 62px;'>
                        <option value=1>SI</option>
                        <option value=0>NO</option>
                        <option value=2>-</option>
                    </select>
            </td>";
        }
        if($num == 2)
        {
            echo"<td bgcolor='#808080' style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 62px;'>
                        <option value=2>-</option>
                        <option value=0>NO</option>
                        <option value=1>SI</option>
                    </select>
            </td>";
        }
    }

    private function HTML_td_edit_difficolta($num, $name)
    {
        if($num == 0)
        {
            echo"<td style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 62px;'>
                        <option style='background-color: gray' value=0>GR.</option>
                        <option style='background-color: green' value=1>V.</option>
                        <option style='background-color: yellow' value=2>G.</option>
                        <option style='background-color: red' value=3>R.</option>
                    </select>
            </td>";
        }

        if($num == 1)
        {
            echo"<td style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 62px;'>
                        <option style='background-color: green' value=1>V.</option>
                        <option style='background-color: yellow' value=2>G.</option>
                        <option style='background-color: red' value=3>R.</option>
                        <option style='background-color: gray' value=0>GR.</option>
                    </select>
            </td>";
        }
        if($num == 2)
        {
            echo"<td style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 62px;'>
                        <option style='background-color: yellow' value=2>G.</option>
                        <option style='background-color: green' value=1>V.</option>
                        <option style='background-color: red' value=3>R.</option>
                        <option style='background-color: gray' value=0>GR.</option>
                    </select>
            </td>";
        }
        if($num == 3)
        {
            echo"<td style='padding: 10px;'>
                    <select required name=$name class='form-control' style='width: 62px;'>
                        <option style='background-color: red' value=3>R.</option>
                        <option style='background-color: yellow' value=2>G.</option>
                        <option style='background-color: green' value=1>V.</option>
                        <option style='background-color: gray' value=0>GR.</option>
                    </select>
            </td>";
        }
    }



}






