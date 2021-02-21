<?php

/**
 * Class HtmlCtp
 * La classe si occupa delle operazioni di visualizzazione relative alle CTP (consulenza tecniche private)
 */
class HtmlCtp
{
    /**
     * Stampa l'header della pagina web
     */
    public function HTML_header(){
        echo"<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset=\"utf-8\">
                        <title>Computer Forensic Case Manager</title>
	                    <link rel='stylesheet' href='css/style.css'>
	                    <link rel='stylesheet' href='font/awesome407/css/font-awesome.min.css'>
                    </head>
                    <body background='../images/logo.png'>";
    }


    /**
     * Visualizza il menu principale a tendina relativo alle CTP
     * @param $datiCtp
     * @param $datiPm
     * @param $datiCasi
     * @param $datiIndagati
     */
    public function HTML_menu_ctp($datiCtp, $datiPm, $datiCasi, $datiIndagati)
    {
        echo" <nav class=\"vertical\">
                <ul>";
                // STAMPA BOTTONE IN ALTO CTP
                    $this->print_CTP_button();

                    //PER OGNI TUPLA STAMPA UN BOTTONE CONTENENTE ID (NASCOSTO) E NOME DEL CLIENTE
                    foreach ($datiCtp as $keyPro=>$valuePro){
                        $cli_id = $valuePro['cli_id'];
                        $cli_nome = $valuePro['cli_nome'];
                        echo"<li id='liCtp$cli_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
                        // STAMPA BOTTONE CON ID E NOME DELLE VARIE PROCURE DEL MENU
                        $this->print_ctpname_button($cli_id, $cli_nome);

                        //PER OGNI TUPLA PRESENTE IN datiCtp CICLA ANCHE SU datiPm PER VISUALIZZARE I BOTTONI DEI PM/AVVOCATI RELATIVI AD OGNI CTP
                        echo"<ul>";
                            $this->print_empty_button('PM');
                            foreach ($datiPm as $rowPm){
                                $pm_id = $rowPm['pm_id'];
                                $pm_nome = $rowPm['pm_nome'];
                                $pm_cognome = $rowPm['pm_cognome'];
                                if($rowPm['ex_id_cli'] == $valuePro['cli_id']){
                                    echo"<li id='liPm$pm_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)' style='width: auto;'>";
                                    $this->print_pm_button($pm_id, $pm_nome, $pm_cognome);

                                    //PER OGNI TUPLA PRESENTE IN datiPm CICLA SU TUTTO datiCasi PER VISUALIZZARE I BOTTONI DEI CASI RELATIVI AD OGNI PM
                                    echo"<ul>";
                                        $this->print_empty_button('CASI');
                                        foreach ($datiCasi as $rowCasi){
                                            $ca_id = $rowCasi['ca_id'];
                                            $ca_num = $rowCasi['ca_num'];
                                            if($rowCasi['ex_id_pm'] == $rowPm['pm_id']){
                                                echo"<li id='liCaso$ca_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
                                                $this->print_caso_button($ca_id, $ca_num);

                                                //PER OGNI TUPLA PRESENTE IN datiCasi CICLA SU TUTTO datiIndagati PER VISUALIZZARE I BOTTONI DEGLI INDAGATI RELATIVI AD OGNI CASO
                                                echo"<ul>";
                                                $this->print_empty_button('INDAGATI');
                                                foreach ($datiIndagati as $rowIndagati){
                                                    $ind_id = $rowIndagati['ind_id'];
                                                    $ind_nome = $rowIndagati['ind_nome'];
                                                    $ind_cognome = $rowIndagati['ind_cognome'];
                                                    if($rowIndagati['ex_id_caso'] == $rowCasi['ca_id']){
                                                        echo"<li id='liIndag$ind_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
                                                        $this->print_indagato_button($ind_id, $ind_nome, $ind_cognome);
                                                    }
                                                }
                                                echo"</ul></li>";
                                            }
                                        }
                                    echo"</ul></li>";
                                }
                            }
                        echo"</ul></li>";
                    }
        $this->print_add_ctp_button();
        $this->print_li_button_procure();
        $this->print_li_button_tribunali();
        $this->print_li_button_logout();
    }


    /**
     * Stampa il footer della pagina web
     */
    public function HTML_footer(){
        echo"<script>
                                    function liColorGray(x) {
                                        document.getElementById(x).style.background = 'gray';
                                    }

                                    function liColorBlack(x) {
                                        document.getElementById(x).style.background = 'black';
                                    }
                                </script>
                            </ul>
                        </nav>
                        </div>
                </body>
            </html>";

    }


    /**
     * Visualizza il pulsante CTP che permette di visualizzare la lista delle CTP
     */
    private function print_CTP_button()
    {
        echo"
        <li id='liCtp' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button id='btnCtp' name='comando' value='return_to_ctp' style='border: none; color: white; height: auto; width: 100%;'>CTP</button>
                </form>
            </center>
        </li>";
    }


    /**
     * Visualizza un pulsante senza funzionalità per utilizzarlo solo come contenitore di un'informazione
     * @param $var
     */
    private function print_empty_button($var)
    {
        echo"
        <li id='liEmpty$var' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button id='btnEmpty$var' style='border: none; color: white; height: auto; width: 100%;'>$var</button>
                </form>
            </center>
        </li>";
    }


    /**
     * Visualizza il pulsante di una data CTP
     * @param $cli_id
     * @param $cli_nome
     */
    private function print_ctpname_button($cli_id, $cli_nome)
    {
        echo"
            <form action='index.php' method='post'>
                <input type='hidden' class='form-control' id='cli_id' name='cli_id' value=$cli_id style='width:10%'>
                <button name='comando' value='view_ctp' style='border: none; color: white; height: auto; width: 100%;'>$cli_nome</button>
            </form>";
    }


    /**
     * Visualizza il pulsante di un dato PM
     * @param $pm_id
     * @param $pm_nome
     * @param $pm_cognome
     */
    private function print_pm_button($pm_id, $pm_nome, $pm_cognome)
    {
        echo"
        <form action='index.php' method='post'>
                <input type='hidden' class='form-control' id='pm_id' name='pm_id' value=$pm_id style='width:auto;'>
                <button name='comando' value='view_pm' style='border: none; color: white; height: auto; width: 100%;'>$pm_cognome $pm_nome</button>
            </form>";
    }


    /**
     * Stampa il pulsante di un dato CASO
     * @param $ca_id
     * @param $ca_num
     */
    private function print_caso_button($ca_id, $ca_num)
    {
        echo"
        <form action='index.php' method='post'>
                <input type='hidden' class='form-control' id='ca_id' name='ca_id' value=$ca_id style='width:10%'>
                <button name='comando' value='view_caso' style='border: none; color: white; height: auto; width: 100%;'>$ca_num</button>
            </form>";

    }

    /**
     * Stampa il pulsante di un dato indagato
     * @param $ind_id
     * @param $ind_nome
     * @param $ind_cognome
     */
    private function print_indagato_button($ind_id, $ind_nome, $ind_cognome)
    {
        echo"
        <form action='index.php' method='post'>
                <input type='hidden' class='form-control' id='ind_id' name='ind_id' value=$ind_id style='width:10%'>
                <button name='comando' value='view_indagato' style='border: none; color: white; height: auto; width: 100%;'>$ind_cognome $ind_nome</button>
            </form>";

    }


    /**
     * Stampa il pulsante nel menù per aggiungere una nuova CTP
     */
    private function print_add_ctp_button()
    {
        echo"
        <li id='liaddctp' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='add_ctp' style='border: none; color: white; height: auto; width: 100%;'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }

    private function print_li_button_ctp()
    {
        echo"
        <li id='ctp' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='ctp' style='border: none;  color: lightgrey; height: auto;'>Ctp</button>
                </form>
            </center>
        </li>";
    }

    private function print_li_button_procure()
    {
        echo"
        <li id='procure' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='menu_procure' style='border: none;  color: lightgrey; height: auto;'>PROCURE</button>
                </form>
            </center>
        </li>";
    }

    private function print_li_button_tribunali()
    {
        echo"
        <li id='tribunali' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='menu_tribunali' style='border: none;  color: lightgrey; height: auto;'>TRIBUNALI</button>
                </form>
            </center>
        </li>";
    }

    private function print_li_button_ricerca()
    {
        echo"
        <li id='ricerca' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='ricerca' style='border: none;  color: lightgrey; height: auto;'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }

    private function print_li_button_amministrazione()
    {
        echo"
        <li id='amministrazione' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='amministrazione' style='border: none;  color: lightgrey; height: auto;'>Amministrazione</button>
                </form>
            </center>
        </li>";
    }

    private function print_li_button_lavorazione()
    {
        echo"
        <li id='lavorazione' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='lavorazione' style='border: none;  color: lightgrey; height: auto;'><i class='fa fa-calendar fa-2x'></i></button>
                </form>
            </center>
        </li>";
    }

    private function print_li_button_logout()
    {
        echo"
        <li id='logout' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='logout' style='border: none;  color: red; height: auto;'><i class='fa fa-power-off fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";

    }









    public function HTML_ctp($Ctp)
    {
        echo "
                    <div class=\"container\"><br>";
        echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>
                     <br><br>
                     <center><b>Lista Ctp</b></center><br>
                        <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/ctp.png' height='60'> </th>
                                    <th>CTP</th>
                                    <th>OPERAZIONI</th>
                                </tr>
                            </thead>

                            <tbody>";
        foreach ($Ctp as $row)
        {
            echo"
                                        <form action='index.php'  method='post'>
                                            <tr>
                                                <td><input type='hidden' id='cli_id' name='cli_id'  value=" . $row['cli_id'] ."></td>
                                                <td>". $row['cli_nome'] ."</td>
                                                <td>
                                                <button class='button_operazioni' type='submit' title='Visualizza i PM' name='comando' value='view_ctp' style='border:none;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                                                <button class='button_operazioni' type='submit' name='comando' value='edit_ctp' style='border:none;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                                                <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Ctp' name='comando' value='delete_ctp' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto senza JS da abilitare in caso di problemi con il precedente con JS-->
                                                <!--button class='button_operazioni' type='submit' name='comando' value='delete_procura' style='border:none'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button--></td>
                                            </tr>
                                        </form>
                                        ";
        }
        echo"
                                    </tbody>
                                    </table>
                                    <form action='index.php' method='post'>
                                    <button type='submit' title='Aggiungi Ctp' name='comando' value='add_ctp' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    ";
    }




    public function HTML_add_ctp(){
        echo"<br>
         <div class='container'>
            <form action='index.php' method='post'>
                <button name='comando' value='return_to_ctp' style='position: absolute; left: 0%; border: none;' title='Vai alle Ctp'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>
            <br><br>
            <center><img src='font/icon/ctp.png' height='40'></center><center><h6 class='docs-header'>INSERIMENTO NUOVA CTP</h6></center>
            <form action='index.php' method='post'>
                <div class='form-group'>
                    <center>
                        <input type='text' class='form-control' id='cli_nome' name='cli_nome' style='width:70%;' placeholder='Studio Legale'><br>

                        <input type='text' class='form-control' id='cli_citta' name='cli_citta' style='width:70%;' placeholder='Citta'><br>
                        <!--input type='text' class='form-control' id='info1' name='info1' style='width:70%;' placeholder='info1'><br>
                        <input type='text' class='form-control' id='info2' name='info2' style='width:70%;' placeholder='info2'><br>
                        <input type='text' class='form-control' id='info3' name='info3' style='width:70%;' placeholder='info3'><br>
                        <input type='text' class='form-control' id='info4' name='info4' style='width:70%;' placeholder='info4'><br-->
                    </center>
                </div>
                <center><button type='submit' name='comando' value='insert_ctp' style='height: auto; color: black;'>Salva</button></center>
            </form>
        </div>";
    }




    public function HTML_edit_ctp($id, $nome, $citta)
    {
        echo"<br>
         <div class='container'>
            <form action='index.php' method='post'>
                <button name='comando' value='return_to_ctp' style='position: absolute; left: 0%; border: none;' title='Vai alle CTP'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>
            <br><br>
            <center><img src='font/icon/ctp.png' height='40'></center><center><h6 class='docs-header'>MODIFICA CTP</h6></center>
            <form action='index.php' method='post'>
                <div class='form-group'>
                    <center>
                        <input type='hidden' class='form-control' id='cli_id' name='cli_id' style='width:70%;' value='$id'><br>
                        <input type='text' class='form-control' id='cli_nome' name='cli_nome' style='width:70%;' value='$nome' placeholder='Nome Tribunale'><br>
                        <input type='text' class='form-control' id='cli_citta' name='cli_citta' style='width:70%;' value='$citta' placeholder='Citta'><br>
                    </center>
                </div>
                <center><button type='submit' name='comando' value='update_ctp' style='height: auto; color: black;'>Salva</button></center>
            </form>
        </div>";
    }



}
