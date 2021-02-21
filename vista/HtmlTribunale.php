<?php

/**
 * Class HtmlTribunale
 * La classe si occupa delle funzioni di visualizzazione relative ai tribunali
 */
class HtmlTribunale
{
    /**
     *
     */
    public function HTML_header(){
        echo"<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset=\"utf-8\">
                        <title>Computer Forensic Case Manager</title>
	                    <link rel='stylesheet' href='css/style.css'>
	                    <link rel='stylesheet' href='font/awesome407/css/font-awesome.min.css'>
	                    <!--link rel='stylesheet' href='skeleton/css/skeleton.css'-->
                    </head>
                    <body background='../images/logo.png'>";
    }

    /**
     * Visualizza la pagina contenente il menù principale dei Tribunali
     * @param $datiTribunale
     * @param $datiAvv
     * @param $datiCasi
     * @param $datiIndagati
     */
    public function HTML_menu_tribunali($datiTribunale, $datiAvv, $datiCasi, $datiIndagati)
    {
        echo" <nav class=\"vertical\">
                <ul>";
                // STAMPA BOTTONE IN ALTO TRIBUNALI
                    $this->print_tribunali_button();
                    foreach ($datiTribunale as $keyTrib=>$valueTrib){
                        $cli_id = $valueTrib['cli_id'];
                        $cli_nome = $valueTrib['cli_nome'];
                        echo"<li id='liTribunale$cli_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
                        // STAMPA BOTTONE CON ID E NOME DELLE VARIE PROCURE DEL MENU
                        $this->print_tribunale_button($cli_id, $cli_nome);
                        echo"<ul>";
                            $this->print_empty_button('PM');
                            foreach ($datiAvv as $rowAvv){
                                $pm_id = $rowAvv['pm_id'];
                                $pm_nome = $rowAvv['pm_nome'];
                                $pm_cognome = $rowAvv['pm_cognome'];
                                if($rowAvv['ex_id_cli'] == $valueTrib['cli_id']){
                                    echo"<li id='liPm$pm_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)' style='width: auto;'>";
                                    $this->print_pm_button($pm_id, $pm_nome, $pm_cognome);
                                    echo"<ul>";
                                        $this->print_empty_button('CASI');
                                        foreach ($datiCasi as $rowCasi){
                                            $ca_id = $rowCasi['ca_id'];
                                            $ca_num = $rowCasi['ca_num'];
                                            if($rowCasi['ex_id_pm'] == $rowAvv['pm_id']){
                                                echo"<li id='liCaso$ca_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
                                                $this->print_caso_button($ca_id, $ca_num);
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
        $this->print_add_tribunale_button();
        $this->print_li_button_ctp();
        $this->print_li_button_procure();
        $this->print_li_button_logout();
    }


    /**
     * Stampa i tag del footer della pagina HTML
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
     * Visualizza un tasto che conduce al menù dei tribunali
     */
    private function print_tribunali_button()
    {
        echo"
        <li id='liTribunali' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button id='btnTribunali' name='comando' value='view_tribunali' style='border: none; color: white; height: auto; width: 100%;'>TRIBUNALI</button>
                </form>
            </center>
        </li>";
    }

    /**
     * Visualizza un tasto senza funzionalità. Viene utilizzato solo per un discorso grafico/estetico in alcuni punti.
     * @param $var
     */
    private function print_empty_button($var)
    {
        echo"
        <li id='liEmpty$var' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <!--form action='index.php' method='post'-->
                    <button id='btnEmpty$var' style='border: none; color: white; height: auto; width: 100%;'>$var</button>
                <!--/form-->
            </center>
        </li>";
    }


    /**
     * Visualizza un tasto che conduce ad un dato tribunale
     * @param $cli_id
     * @param $cli_nome
     */
    private function print_tribunale_button($cli_id, $cli_nome)
    {
        //<a href='#' onclick='document.getElementById(\"fprocura$cli_id\").submit();'>". str_replace('della Repubblica Tribunale di','',$cli_nome)."</a>
        echo"
            <form action='index.php' method='post'>
                <input type='hidden' class='form-control' id='cli_id' name='cli_id' value=$cli_id style='width:10%'>
                <button name='comando' value='view_tribunale' style='border: none; color: white; height: auto; width: 100%;'>$cli_nome</button>
            </form>";
    }


    /**
     * Visualizza un tasto nel menù che conduce ad un dato PM
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

    /*private function print_add_pm_button($cli_id)
    {
        echo"
        <li id='liaddpm' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <input type='hidden' class='form-control' id='cli_id' name='cli_id' value=$cli_id style='width:10%'>
                    <button name='comando' value='page_add_pm' style='border: none; color: white; height: auto; width: 100%;'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }*/


    /**
     * Visualizza un tasto che conduce ad un dato caso
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


    /*private function print_add_caso_button()
    {
        echo"
        <li id='liaddcaso' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='page_add_caso' style='border: none; color: white; height: auto; width: 100%;'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }*/


    /**
     * Visualizza un tasto nel menu che conduce ad un dato indagato
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


    /*private function print_add_indagato_button()
    {
        echo"
        <li id='liaddinda' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='page_add_indagato' style='border: none; color: white; height: auto; width: 100%;'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }*/


    /**
     * Visualizza un tasto che conduce alla pagina di aggiunta di un nuovo tribunale.
     */
    private function print_add_tribunale_button()
    {
        echo"
        <li id='liaddtribunale' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='add_tribunale' style='border: none; color: white; height: auto; width: 100%;'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }

    /**
     * Visualizza un tasto che conduce al menu delle CTP
     */
    private function print_li_button_ctp()
    {
        echo"
        <li id='ctp' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='menu_ctp' style='border: none;  color: lightgrey; height: auto;'>CTP</button>
                </form>
            </center>
        </li>";
    }


    /**
     * Visualizza un tasto che conduce al menù delle procure
     */
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









    public function HTML_tribunali($Tribunali)
    {
        echo "
                    <div class=\"container\"><br>";
        echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>
                     <br><br>
                     <center><b>Lista Tribunali</b></center><br>
                        <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/tribunale.png' height='60'> </th>
                                    <th>TRIBUNALE</th>
                                    <th>OPERAZIONI</th>
                                </tr>
                            </thead>

                            <tbody>";
        foreach ($Tribunali as $row)
        {
            echo"
                                        <form action='index.php'  method='post'>
                                            <tr>
                                                <td><input type='hidden' id='cli_id' name='cli_id'  value=" . $row['cli_id'] ."></td>
                                                <td>". $row['cli_nome'] ."</td>
                                                <td>
                                                <button class='button_operazioni' type='submit' title='Visualizza Avvocato/Studio' name='comando' value='view_tribunale' style='border:none;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                                                <button class='button_operazioni' type='submit' name='comando' value='edit_tribunale' style='border:none;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                                                <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Tribunale' name='comando' value='delete_tribunale' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
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
                                    <button type='submit' title='Aggiungi Tribunale' name='comando' value='add_tribunale' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    ";
    }




    public function HTML_view_tribunale($res, $NomeTribunale)
    {
        echo "
            <div class='container'><br>
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='return_to_tribunali' style='position: absolute; left: 0%; border: none;' title='Torna ai Tribunali'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>

        <br><br>
             <center><b>$NomeTribunale</b></center><br>
                <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th><img src='font/icon/pm.png' height='60'> </th>
                            <th>PM</th>
                            <th>OPERAZIONI</th>
                        </tr>
                    </thead>

                    <tbody>";
        foreach ($res as $row)
        {
            echo"

                            <form action='index.php'  method='post'>
                                <tr>
                                    <td><input type='hidden' id='pm_id' name='pm_id'  value=" . $row['pm_id'] ."></td>
                                    <td>". $row['pm_cognome']." " . $row['pm_nome']."</td>
                                    <td><button type='submit' name='comando' title='Visualizza casi' value='view_pm' style='border:hidden; width:5px'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
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


    public function HTML_add_tribunale(){
        echo"<br>
         <div class='container'>
            <form action='index.php' method='post'>
                <button name='comando' value='view_tribunali' style='position: absolute; left: 0%; border: none;' title='Vai ai Tribunali'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>
            <br><br>
            <center><img src='font/icon/tribunale.png' height='40'></center><center><h6 class='docs-header'>INSERIMENTO NUOVO TRIBUNALE</h6></center>
            <form action='index.php' method='post'>
                <div class='form-group'>
                    <center><input type='text' class='form-control' id='cli_nome' name='cli_nome' style='width:70%;' value='Tribunale di '><br>
                    <input type='text' class='form-control' id='cli_citta' name='cli_citta' style='width:70%;' placeholder='Citta'><br></center>
                </div>
                <center><button type='submit' name='comando' value='insert_tribunale' style='height: auto; color: black;'>Salva</button></center>
            </form>
        </div>";
    }




    public function HTML_edit_tribunale($id, $nome, $citta)
    {
        echo"<br>
         <div class='container'>
            <form action='index.php' method='post'>
                <button name='comando' value='view_tribunali' style='position: absolute; left: 0%; border: none;' title='Vai ai Tribunali'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>
            <br><br>
            <center><img src='font/icon/tribunale.png' height='40'></center><center><h6 class='docs-header'>MODIFICA TRIBUNALE</h6></center>
            <form action='index.php' method='post'>
                <div class='form-group'>
                    <center>
                        <input type='hidden' class='form-control' id='cli_id' name='cli_id' style='width:70%;' value='$id'><br>
                        <input type='text' class='form-control' id='cli_nome' name='cli_nome' style='width:70%;' value='$nome' placeholder='Nome Tribunale'><br>
                        <input type='text' class='form-control' id='cli_citta' name='cli_citta' style='width:70%;' value='$citta' placeholder='Citta'><br>
                    </center>
                </div>
                <center><button type='submit' name='comando' value='update_tribunale' style='height: auto; color: black;'>Salva</button></center>
            </form>
        </div>";
    }

}
