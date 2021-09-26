<?php

/**
 * Class HtmlProcura
 * La classe si occupa delle operazioni di visualizzazione dei dati relativi alle procure
 */
class HtmlProcura
{
    /*______________________________________________________________________________________________________*/
    /* STAMPA LA VISTA DELLE PROCURE PER SELEZIONARE UNA PROCURA E VISUALIZZARE I SUOI PM (RICERCA DEL CASO)*/
    /**
     * Visualizza i dati delle procure presenti nel parametro di tipo array che gli viene passato
     * @param array $Procure
     */
    public function HTML_procure($Procure)
            {
                echo "<div class=\"container\"><br>";
                if($_SESSION['cli_type'] == 'P'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"<form action='index.php' method='post'>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                }
                echo"<br><br>
                     <center><b>Lista Procure</b></center><br>
                        <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/procura.png' height='60'> </th>
                                    <th>PROCURA</th>
                                    <th>OPERAZIONI</th>
                                </tr>
                            </thead>

                            <tbody>";
                                foreach ($Procure as $row)
                                {
                                    echo"
                                        <form action='index.php'  method='post'>
                                            <tr>
                                                <td><input type='hidden' id='cli_id' name='cli_id'  value=" . $row['cli_id'] ."></td>
                                                <td>". $row['cli_nome'] ."</td>
                                                <td>
                                                <button class='button_operazioni' type='submit' title='Visualizza i PM' name='comando' value='view_procura' style='border:none;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto edit per ora nascosto. Da abilitare quando svilupperò meccanismi di modifica-->
                                                <button class='button_operazioni' type='submit' name='comando' value='edit_procura' style='border:none;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto elimina con evento JS per la richiesta di conferma per l'eliminazione-->
                                                <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Procura' name='comando' value='delete_procura' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
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
                                    <button type='submit' title='Aggiungi Procura' name='comando' value='add_procura' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    ";
            }


    /**
     * Visualizza i dati delle procure presenti nel parametro di tipo array che gli viene passato.
     * Questa funzione viene chiamata a seguito di una ricerca di una procura (tramite la pagina di ricerca)
     * @param $Procure
     */
    public function HTML_procure_by_ricerca($Procure)
            {
                echo "<div class=\"container\"><br>
                        <form action='index.php' method='post'>
                        <button name='comando' value='ricerca' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>";
                echo"<br><br>
                     <center><b>Lista Procure</b></center><br>
                        <table class=\"u-full-width\">
                            <thead style='color: #1188FF'>
                                <tr>
                                    <th><img src='font/icon/procura.png' height='60'> </th>
                                    <th>PROCURA</th>
                                    <th>OPERAZIONI</th>
                                </tr>
                            </thead>

                            <tbody>";
                                foreach ($Procure as $row)
                                {
                                    echo"
                                        <form action='index.php'  method='post'>
                                            <tr>
                                                <td><input type='hidden' id='cli_id' name='cli_id'  value=" . $row['cli_id'] ."></td>
                                                <td>". $row['cli_nome'] ."</td>
                                                <td>
                                                <button class='button_operazioni' type='submit' title='Visualizza i PM' name='comando' value='view_procura' style='border:none;'><i class=\"fa fa-chevron-right fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto edit per ora nascosto. Da abilitare quando svilupperò meccanismi di modifica-->
                                                <button class='button_operazioni' type='submit' name='comando' value='edit_procura' style='border:none;'><i class=\"fa fa-pencil-square-o fa-2x\" aria-hidden=\"true\"></i></button>
                                                <!-- Tasto elimina con evento JS per la richiesta di conferma per l'eliminazione-->
                                                <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' title='Elimina Procura' name='comando' value='delete_procura' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button>
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
                                    <button type='submit' title='Aggiungi Procura' name='comando' value='add_procura' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    ";
            }


    /**
     * Visualizza la pagina per aggiungere una nuova procura
     */
    public function HTML_add_procura(){
        echo"<br>
             <div class='container'>";
        if($_SESSION['cli_type'] == 'P') {
            echo "<form action='index.php' method='post'>
                    <button name='comando' value='view_procure' style='position: absolute; left: 0%; border: none;' title='Vai alle procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
        }
        if($_SESSION['cli_type'] == 'T') {
            echo "<form action='index.php' method='post'>
                    <button name='comando' value='view_procure' style='position: absolute; left: 0%; border: none;' title='Vai alle procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
        }
        if($_SESSION['cli_type'] == 'C') {
            echo "<form action='index.php' method='post'>
                    <button name='comando' value='view_procure' style='position: absolute; left: 0%; border: none;' title='Vai alle procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                    <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                </form>";
        }
                echo"<br><br>
                <center><img src='font/icon/procura.png' height='40'></center><center><h6 class='docs-header'>INSERIMENTO NUOVA PROCURA</h6></center>
                <form action='index.php' method='post'>
                    <div class='form-group'>
                        <center><input type='text' class='form-control' id='cli_nome' name='cli_nome' style='width:70%;' value='Procura della Repubblica Tribunale di ' required><br>
                        <input type='text' class='form-control' id='cli_citta' name='cli_citta' style='width:70%;' placeholder='Citta' required><br></center>
                    </div>
                    <center><button type='submit' name='comando' value='insert_procura' style='height: auto; color: black;'>Salva</button></center>
                </form>
            </div>";
    }


    /**
     * Visualizza la pagina per modificare le info di una data procura.
     * @param $id
     * @param $nome
     * @param $citta
     */
    public function HTML_edit_procura($id, $nome, $citta)
    {
        echo"<br>
         <div class='container'>";
        if($_SESSION['cli_type'] == 'P'){
            echo"<form action='index.php' method='post'>
                <button name='comando' value='view_procure' style='position: absolute; left: 0%; border: none;' title='Vai alle procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>";
        }
        if($_SESSION['cli_type'] == 'T'){
            echo"<form action='index.php' method='post'>
                <button name='comando' value='view_procure' style='position: absolute; left: 0%; border: none;' title='Vai alle procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>";
        }
        if($_SESSION['cli_type'] == 'C'){
            echo"<form action='index.php' method='post'>
                <button name='comando' value='view_procure' style='position: absolute; left: 0%; border: none;' title='Vai alle procure'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
            </form>";
        }
            echo"<br><br>
            <center><img src='font/icon/procura.png' height='40'></center><center><h6 class='docs-header'>MODIFICA PROCURA</h6></center>
            <form action='index.php' method='post'>
                <div class='form-group'>
                    <center>
                        <input type='hidden' class='form-control' id='cli_id' name='cli_id' style='width:70%;' value='$id'><br>
                        <input type='text' class='form-control' id='cli_nome' name='cli_nome' style='width:70%;' value='$nome' placeholder='Nome Procura'><br>
                        <input type='text' class='form-control' id='cli_citta' name='cli_citta' style='width:70%;' value='$citta' placeholder='Citta Procura'><br>
                    </center>
                </div>
                <center><button type='submit' name='comando' value='update_procura' style='height: auto; color: black;'>Salva</button></center>
            </form>
        </div>";
    }


    /**
     * Stampa i tag di intestazione per la pagina contenente il menù principale di CFCM
     */
    private function HTML_header_menu_procura(){
        echo"<!DOCTYPE html>
                <html>
                    <head>
                        <meta charset=\"utf-8\">
                        <title>Computer Forensic Case Manager</title>
	                    <link rel='stylesheet' href='css/style.css'>
	                    <link rel='stylesheet' href='font/awesome407/css/font-awesome.min.css'>
	                    <!--link rel='stylesheet' href='skeleton/css/skeleton.css'-->
                    </head>
                    <body background='../images/logo.png'>
                    <script type='text/javascript'>
                        function blink() {
                            var blinks = document.getElementsByTagName('blink');
                            for (var i = blinks.length - 1; i >= 0; i--) {
                            var s = blinks[i];
                            s.style.visibility = (s.style.visibility === 'visible') ? 'hidden' : 'visible';
                            }
                            window.setTimeout(blink, 400);
                        }
                        if (document.addEventListener) document.addEventListener('DOMContentLoaded', blink, false);
                        else if (window.addEventListener) window.addEventListener('load', blink, false);
                        else if (window.attachEvent) window.attachEvent('onload', blink);
                        else window.onload = blink;
                    </script>";
    }


    /**
     * Visualizza la pagina contenente il menù principale.
     * @param $datiProcure
     * @param $datiPm
     * @param $datiCasi
     * @param $datiIndagati
     */
    public function HTML_menu_procure($datiProcure, $datiPm, $datiCasi, $datiIndagati)
    {
        $this->HTML_header_menu_procura();
        echo"<nav class=\"vertical\">
                            <ul>";
        // STAMPA BOTTONE IN ALTO PROCURE
        $this->print_procure_button();
        foreach ($datiProcure as $keyPro=>$valuePro)
        {
            $cli_id = $valuePro['cli_id'];
            $cli_nome = $valuePro['cli_nome'];
            $cli_nome = $this->pulisci_nome_procura($cli_nome);
            echo"<li id='liProcura$cli_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
            // STAMPA BOTTONE CON ID E NOME DELLE VARIE PROCURE DEL MENU
            $this->print_procura_button($cli_id, $cli_nome);

            echo"<ul>";
            $this->print_empty_button('PM');
            foreach ($datiPm as $rowPm)
            {

                $pm_id = $rowPm['pm_id'];
                $pm_nome = $rowPm['pm_nome'];
                $pm_cognome = $rowPm['pm_cognome'];
                if($rowPm['ex_id_cli'] == $valuePro['cli_id'])
                {
                    echo"<li id='liPm$pm_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)' style='width: auto;'>";
                    $this->print_pm_button($pm_id, $pm_nome, $pm_cognome);

                    echo"<ul>";
                    $this->print_empty_button('CASI');


                    foreach ($datiCasi as $rowCasi)
                    {
                        $ca_id = $rowCasi['ca_id'];
                        $ca_num = $rowCasi['ca_num'];
                        if($rowCasi['ex_id_pm'] == $rowPm['pm_id'])
                        {
                            echo"<li id='liCaso$ca_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
                            $this->print_caso_button($ca_id, $ca_num);
                            echo"<ul>";
                            $this->print_empty_button('INDAGATI');



                            foreach ($datiIndagati as $rowIndagati)
                            {
                                $ind_id = $rowIndagati['ind_id'];
                                $ind_nome = $rowIndagati['ind_nome'];
                                $ind_cognome = $rowIndagati['ind_cognome'];
                                if($rowIndagati['ex_id_caso'] == $rowCasi['ca_id'])
                                {
                                    echo"<li id='liIndag$ind_id' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>";
                                    $this->print_indagato_button($ind_id, $ind_nome, $ind_cognome);
                                }

                            }

                            //$this->print_add_indagato_button();
                            echo"</ul></li>";
                        }

                    }


                    //$this->print_add_caso_button();
                    echo"</ul></li>";
                }

            }
            //$this->print_add_pm_button($cli_id);
            echo"
                                                    </ul></li>";
        }

        //STAMPA DEI TASTI PER LE VARIE FUNZIONALITA' DI CFCM
        $this->print_add_procura_button();
        $this->print_li_button_ctp();
        $this->print_li_button_tribunali();
        $this->print_li_button_amministrazione();
        $this->print_li_button_tools();
        $this->print_ufedtools_btn();
        $this->print_li_button_ricerca();
        $this->print_li_button_lavorazione();
        $this->print_li_button_magazzino();
        $this->print_li_button_user();
        $this->print_li_button_logout();

        //STAMPA DEL FOOTER DELLA PAGINA
        $this->HTML_footer_menu_procura();
    }


    /**
     * Stampa i tag relativi al footer della pagina del menù principale
     */
    private function HTML_footer_menu_procura()
    {
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
     * Stampa il bottone relativo alle procure
     */
    private function print_procure_button()
    {
        echo"
        <li id='liProcure' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button id='btnProcure' name='comando' value='view_procure' style='border: none; color: white; height: auto; width: 100%;'>PROCURE</button>
                </form>
            </center>
        </li>";
    }


    /**
     * Stampa un bottone "vuoto" nel senso che non ha funzionalità tranne per un discorso di tipo grafico/estetico
     * @param $var
     */
    private function print_empty_button($var)
    {
        echo"
        <li id='liEmpty$var' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
				<button id='btnEmpty$var' style='border: none; color: white; height: auto; width: 100%;'>$var</button>
            </center>
        </li>";
    }


    /**
     * Stampa un bottone relativo ad una data procura
     * @param $cli_id
     * @param $cli_nome
     */
    private function print_procura_button($cli_id, $cli_nome)
    {
        //<a href='#' onclick='document.getElementById(\"fprocura$cli_id\").submit();'>". str_replace('della Repubblica Tribunale di','',$cli_nome)."</a>
        echo"
            <form action='index.php' method='post'>
                <input type='hidden' class='form-control' id='cli_id' name='cli_id' value=$cli_id style='width:10%'>
                <button name='comando' value='view_procura' style='border: none; color: white; height: auto; width: 100%;'>$cli_nome</button>
            </form>";
    }


    /**
     * Stampa un bottone relativo ad un dato PM
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
     * Stampa un bottone relativo ad un dato Caso
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
     * Stampa un bottone relativo ad un dato indagato
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
     * Esegue un taglio al nome completo di una procura andando a prendere solo "Procura" e città
     * @param $nome
     * @return string|string[]
     */
    private function pulisci_nome_procura($nome)
    {
        $nome = str_replace('della Repubblica Tribunale di', '', $nome);
        $nome = str_replace('della Repubblica Tribunale per i', '', $nome);
        return $nome;
    }


    /**
     * Visualizza un tasto tramite cui si apre la pagina di aggiunta di una nuova procura.
     */
    private function print_add_procura_button()
    {
        echo"
        <li id='liaddprocura' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='add_procura' style='border: none; color: white; height: auto; width: 100%;'><i class='fa fa-plus-circle fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }

    /**
     * Stampa un tasto relativo alle CTP
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
     * Stampa un tasto relativo ai tribunali
     */
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


    /**
     * Stampa un tasto che porta alla pagina delle ricerche
     */
    private function print_li_button_ricerca()
    {
        echo"
        <li id='ricerca' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='ricerca' title='Ricerca' style='border: none;  color: lightgrey; height: auto;'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";
    }

    /**
     * Stampa un tasto che porta alla pagina di amministrazione di CFCM (solo admin può accedervi)
     */
    private function print_li_button_amministrazione()
    {
        if($_SESSION['username'] == 'admin') {
            echo "
            <li id='amministrazione' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
                <center>
                    <form action='index.php' method='post'>
                        <button name='comando' value='amministrazione' style='border: none;  color: lightgray; height: auto;' title='Amministrazione'><i class='fa fa-asterisk fa-2x'></i></button>
                    </form>
                </center>
            </li>";
        }

    }

    /**
     * Stampa un tasto che porta alla pagina in cui sono presenti dei tools di ausilio al lavoro con FTK
     */
    private function print_li_button_tools()
    {
            echo "
            <li id='tools' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
                <center>
                    <form action='index.php' method='post'>
                        <button name='comando' value='ftktools' style='border: none; height: 40px;  color: lightgray; padding: 5px;' title='Ftk Tools'><img src='font/icon/ftktools.png' height='30px'></button>
                    </form>
                </center>
            </li>";
     }

    /**
     * Stampa un tasto che porta alla pagina in cui sono presenti i tools di ausilio al lavoro con Cellebrite Ufed Reader
     */
    private function print_ufedtools_btn()
    {
        echo "
            <li id='tools1' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
                <center>
                    <form action='index.php' method='post'>
                        <button name='comando' value='ufedtools' style='border: none;  color: lightgray; height: 40px; padding: 7px;' title='Ufed Tools'><img src='font/icon/ufedreader.png' height='25px'></button>
                    </form>
                </center>
            </li>";
    }


    /**
     * Stampa un tasto che porta alla pagina delle lavorazioni in corso.
     */
    private function print_li_button_lavorazione()
    {
        echo"
        <li id='lavorazione' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='lavorazione' style='border: none;  color: lightgrey; height: auto;' title='Lavorazione'><i class='fa fa-calendar fa-2x'></i></button>
                </form>
            </center>
        </li>";
    }

    /**
     * Stampa un tasto che porta alla pagina del magazzino.
     */
    private function print_li_button_magazzino()
    {
        echo"
        <li id='magazzino' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='magazzino' style='border: none;  color: lightgrey; height: 40px; padding: 7px;' title='Magazzino'><img src='font/icon/magazzino.png' height='25px'> </button>
                </form>
            </center>
        </li>";
    }

    /**
     * Stampa un tasto che porta alla pagina personale dell'utente per poter cambiare la password.
     */
    private function print_li_button_user()
    {
        echo"
        <li id='user' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='user' style='border: none; height: auto; color: lightgrey;' title='Profilo'><i class='fa fa-user fa-2x'></i></button>
                </form>
            </center>
        </li>";
    }

    /**
     * Stampa un tasto per il logout
     */
    private function print_li_button_logout()
    {
        echo"
        <li id='logout' onmouseover='liColorGray(this.id)' onmouseout='liColorBlack(this.id)'>
            <center>
                <form action='index.php' method='post'>
                    <button name='comando' value='logout' style='border: none;  color: red; height: auto;' title='Logout'><i class='fa fa-power-off fa-2x' aria-hidden='true'></i></button>
                </form>
            </center>
        </li>";

    }



    /**
     * Visualizza la pagina di ricerca con in più il messaggio che non ha trovato nessun PM corrispondente alla stringa utilizzata
     */
    public function HTML_ricerca_procura_not_found()
    {
        echo"<br><br>
                <center>
                    <form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='menu_procure' style='border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                    </form><br><br>
                    <form action='index.php' method='post'>
                        <input type='text' align='center' id='ric' name='ric' placeholder='Procura non trovata' style='width: 200px;  color: red; border-color: red;'>&nbsp
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
                        <input type='text' align='center' id='ric' name='ric' placeholder='Modello Host' style='width: 200px;'>&nbsp
                        <button type='submit' name='comando' value='ricerca_host' title='Ricerca Host'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
                        <br>
                    </form>
                </center>";
    }

}
