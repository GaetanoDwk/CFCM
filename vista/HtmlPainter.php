<?php

/**
 * Class HtmlPainter
 * La classe è generica e si occupa di visualizzare strutture HTML generiche che possono essere utili nelle altre classi più specifiche
 */
class HtmlPainter
{

    /**
     * Stampa i tag per creare una nuova pagina. In questo modo quando si stampa la reportistica è possibile suddividere
     * i dati in pagine a seconda delle esigenze
     */
    public function HTML_newpage(){
        echo "<div style='page-break-before: always;'>";
    }

    /**
     * Stampa il tag di chiusura della pagina aperta dalla funzione Html_newpage()
     */
    public function HTML_close_newpage(){
        echo "</div>";
    }


    /**
     * Stampa il tag di andata a capo <br>
     */
    public function HTML_br(){
        echo "<br>";
    }



	// HEADER E FOOTER

    /**
     * Stampa i tag del footer di una pagina html
     */
    public function HTML_footer()
	{
		echo "</body>
            </html>";
	}


    /**
     * Stampa i tag di intestazione delle pagine di cfcm
     */
    public function HTML_header()
	{


		echo "    <html>
                    <!--BASIC PAGE NEEDS -->

                    <meta charset=\"utf-8\">

                    <title>Computer Forensics Case Manager</title>

                    <meta name=\"description\" content=\"\">

                    <meta name=\"author\" content=\"\">
                    <!--_________________________________________________________________-->


                    <!-- MOBILE META -->

                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                    <!--_________________________________________________________________-->


                    <head>

                         <!--FONT -->
                    <link rel='stylesheet' href='font/awesome407/css/font-awesome.min.css'>
                    
                    <!--_____________________________________________________________________________________________-->

                        <link rel=\"stylesheet\" href=\"skeleton/css/normalize.css\">

                        <link rel='stylesheet' href='skeleton/css/skeleton.css'>

                        <link rel='stylesheet' href='skeleton/css/custom.css'>
                        <!--link rel='stylesheet' href='css/treeview_caso.css'-->
                        <link rel='stylesheet' href='css/gallery.css'>

                        <!-- JQUERY -->
                        <script type='text/javascript' src='js/jquery.min.js'></script>


                    </head>

                    <body>";
	}


    /**
     * Stampa un messaggio in rosso.
     * @param $message
     */
    public function HTML_message($message)
    {
        if($message != null)
        {
            echo"<br><center><b style='color: red'>$message</b></center>";
        };
    }


    /**
     * Visualizza la pagina di amministrazione (solo admin può vederla)
     */
    public function HTML_amministrazione()
    {
        echo"<div class='container'><br>
                    <form action='index.php' method='post'>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                     </form>
                     <center><b>Administration</b></center><br>
                 <table class=\"u-full-width\">
                    <thead style='color: #1188FF'>
                        <tr>
                            <th><img src='font/icon/admin.png' height='70px' title='Amministrazione'> </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <form action='index.php' method='post'>
                            <td><button name='comando' value='amm_azienda' style='border: none;'><img src='font/icon/azienda.png' title='Azienda' height='150%'></button></td>
                            <td><button name='comando' value='amm_utenti' style='border: none;'><img src='font/icon/utenti.png' title='Users' height='150%'></button></td>
                            <!--td><button name='comando' value='#' style='border: none;'><img src='font/icon/host.png' title='Default Host Types' height='150%'></button></td>
                            <td><button name='comando' value='#' style='border: none;'><img src='font/icon/collection.png' title='Default Host Special Types' height='150%'></button></td>
                            <td><button name='comando' value='#' style='border: none;'><img src='font/icon/evidence.png' title='Default Evidence Types' height='150%'></button></td-->
                        </form>
                    </tr>
                    </tbody>
                </div>";
    }

    
    
    /**
     * Visualizza la pagina da cui è possibile effettuare delle rapide ricerche per pm, caso, modello host
     */
    function HTML_ricerca()
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
        <input type='text' align='center' id='ric' name='ric' placeholder='Modello Host' style='width: 200px;'>&nbsp
        <button type='submit' name='comando' value='ricerca_host' title='Ricerca Host'><i class='fa fa-search fa-2x' aria-hidden='true'></i></button>
        <br>
    </form>
        </center>";
    }


    /**
     * Visualizza a video in modo ordinato il contenuto di un array
     * Utile in caso di debugging
     * @param $arr
     */
    public function paint_HTML_array($arr)
    {
        echo "<pre>";
                print_r($arr);
        echo"</pre>";
    }


    /**
     * Visualizza a video la pagind di login
     */
    public function HTML_login_page()
    {
        echo"<div class=\"container\">
                <!-- Griglia -->
                <div class=\"docs-section\" id=\"grid\">
                        <div class='row'>
                            <div class='twelve column'>
                                <center><img src='images/logo.png' width='55%'></center>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class=\"row\">
                            <div class='twelve column'>
                                <form action='index.php' method='post'>
                                    <center>
                                        <input type='text' class='form-control' id='username' name='username' style='width:60%' placeholder='Username'><br>
                                        <input type='password' class='form-control' id='password' name='password' style='width:60%' placeholder='Password'><br>
                                    </center>
                                    <center>
                                        <button type='submit' name='comando' value='checkLogin' color='black' style='height: auto;'>Login</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'></div>
                </div>
                </div>";
    }


    /**
     * Visualizza a video la pagina di login con in più il messaggio di errato login
     */
    public function HTML_login_wrong()
    {
        echo"<div class=\"container\">
                <b style='color: red;'>Username o Password errati. Ritenta!</b>
                <!-- Griglia -->
                <div class=\"docs-section\" id=\"grid\">
                        <div class='row'>
                            <div class='twelve column'>
                                <center><img src='images/logo.png' width='55%'></center>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class=\"row\">
                            <div class='twelve column'>
                                <form action='index.php' method='post'>
                                    <center>
                                        <input type='text' class='form-control' id='username' name='username' style='width:60%' placeholder='Username'><br>
                                        <input type='password' class='form-control' id='password' name='password' style='width:60%' placeholder='Password'><br>
                                    </center>
                                    <center>
                                        <button type='submit' name='comando' value='checkLogin' color='black' style='height: auto;'>Login</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'></div>
                </div>
                </div>";
    }

    public function HTML_alert_message($msg){
        echo"<div class='container'>
                <form action='index.php' method='post'>
                <button name='comando' value='return_cases_of_pm' style='position: absolute; top:5%; left: 0%; border: none;'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                <button name='comando' value='menu_procure' style='position: absolute; top: 5%; left: 5%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
             </form>
             </div>
             <i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true' style='color: red; position: absolute; top: 10%; left: 30%;'><br><h5>$msg</h5></i>";
        
    }

}
