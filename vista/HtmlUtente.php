<?php

/**
 * Class HtmlUtente
 * La classe si occupa delle funzioni di visualizzazione relative agli utenti di CFCM
 */
class HtmlUtente
{
    /**
     * Visualizza la pagina di un utente
     */
    public function HTML_user()
    {
        echo"
            <div class='container'><br><br>
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                </form><br><br>
                <center><img src='font/icon/userblack.png' height='40'><h6 class='docs-header'>MODIFICA PASSWORD</h6></center>
                    <form action='index.php' method='post'>
                        <center>
                        <input type='password' class='form-control' id='old_password' name='old_password' style='width:40%' placeholder='OLD PASSWORD'><br>
                        <input type='password' class='form-control' id='new_password' name='new_password' style='width:40%' placeholder='NEW PASSWORD'><br>
                        <input type='password' class='form-control' id='cnf_password' name='cnf_password' style='width:40%' placeholder='CONFIRM NEW PASSWORD'><br>
                        <button type='submit' name='comando' value='update_password' style='height: auto;'>Cambia password</button></center>
                    </form>
            </div>";
    }


    /**
     * Visualizza la pagina di un utente con in più un messaggio passatogli dal controller dopo i dovuti controlli
     * @param $color
     * @param $message
     */
    public function HTML_user_with_message($color, $message)
    {
        echo"
            <div class='container'><br><br>";
                if($color == "G"){echo"<b style='color: forestgreen;'>$message</b>";}
                if($color == "R"){echo"<b style='color: red;'>$message</b>";}

                echo"<br>
                <form action='index.php' method='post' style='display: inline;'>
                    <button name='comando' value='menu_procure' style='position: absolute; left: 0%; border: none;' title='Ritorna alla pagina di aggiunta Host'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                </form><br><br>
                <center><img src='font/icon/userblack.png' height='40'><h6 class='docs-header'>MODIFICA PASSWORD</h6></center>
                    <form action='index.php' method='post'>
                        <center>
                        <input type='password' class='form-control' id='old_password' name='old_password' style='width:40%' placeholder='OLD PASSWORD'><br>
                        <input type='password' class='form-control' id='new_password' name='new_password' style='width:40%' placeholder='NEW PASSWORD'><br>
                        <input type='password' class='form-control' id='cnf_password' name='cnf_password' style='width:40%' placeholder='CONFIRM NEW PASSWORD'><br>
                        <button type='submit' name='comando' value='update_password' style='height: auto;'>Update Password</button></center>
                    </form>
            </div>";
    }

}
