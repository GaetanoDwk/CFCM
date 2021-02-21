<?php

/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 14/11/2016
 * Time: 12:41
 */


class ControllerUtente
{
    /**
     * ControllerUtente constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->ModelUtente = new ModelUtente();
        $this->Html = new HtmlPainter();
        $this->HtmlAmm = new HtmlAmministrazione();
        $this->HtmlUtente = new HtmlUtente();
        $this->modelProcura = new ModelProcura();

    }


    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {

        switch ($comando) {
            case 'amm_utenti':
                $this->amm_utenti();
                break;
            case 'add_utente':
                $this->add_utente();
                break;
            case 'edit_utente':
                $this->edit_utente();
                break;
            case 'insert_utente':
                $this->insert_utente();
                break;
            case 'update_utente':
                $this->update_utente();
                break;
            case 'delete_utente':
                $this->delete_utente();
                break;
            case 'user':
                $this->user();
                break;
            case 'update_password':
                $this->update_password();
                break;
            // _________________________________________________________________________________________________________

        }
    }

    /**
     * Inserisce nuovo utente nel DB e visualizza la pagina di gestione utenti
     */
    private function insert_utente()
    {
        $nome = $_POST['ute_nome'];
        $cognome = $_POST['ute_cognome'];
        $username = $_POST['ute_username'];
        $password = $_POST['ute_password'];
        $isadmin = $_POST['ute_isadmin'];
        $password = md5($password);
        $this->ModelUtente->insert_UTENTE($nome, $cognome, $username, $password, $isadmin);
        $this->amm_utenti();
    }

    /**
     * Modifica un utente nel DB e visualizza la pagina di gestione utenti
     */
    private function update_utente()
    {
        $id = $_POST['ute_id'];
        $nome = $_POST['ute_nome'];
        $cognome = $_POST['ute_cognome'];
        $username = $_POST['ute_username'];
        $password = $_POST['ute_password'];
        $isadmin = $_POST['ute_isadmin'];
        $password = md5($password);
        $this->ModelUtente->update_utente($id, $nome, $cognome, $username, $password, $isadmin);
        $this->amm_utenti();
    }

    /**
     * Elimina un utente e visualizza la pagina di gestione utenti
     */
    private function delete_utente()
    {
        $this->ModelUtente->delete_utente($_POST['ute_id']);
        $this->amm_utenti();

    }

    /**
     * Visualizza la pagina per il cambio password di un utente
     */
    private function user()
    {
        $this->Html->HTML_header();
        $this->HtmlUtente->HTML_user();
        $this->Html->HTML_footer();
    }

    /**
     * Visualizza la pagina di gestione utenti (solo ADMIN è autorizzato)
     */
    private function amm_utenti()
    {
        $Utenti = $this->ModelUtente->select_all_utenti();
        $this->Html->HTML_header();
        $this->HtmlAmm->HTML_nav("amministrazione");
        $this->HtmlAmm->HTML_amm_utenti($Utenti);
        $this->Html->HTML_footer();
    }

    /**
     * Visualizza pagina di aggiunta nuovo utente (solo ADMIN è autorizzato)
     */
    private function add_utente()
    {
        $this->Html->HTML_header();
        $this->HtmlAmm->HTML_nav("amm_utenti");
        $this->HtmlAmm->HTML_add_utente();
        $this->Html->HTML_footer();
    }

    /**
     * Visualizza pagina di modifica utente (solo ADMIN è autorizzato)
     */
    private function edit_utente()
    {
        $id = $_POST['ute_id'];
        $this->ModelUtente->select_one_user($id);
        $nome = $this->ModelUtente->getNome();
        $cognome = $this->ModelUtente->getCognome();
        $username = $this->ModelUtente->getUsername();
        $isadmin = $this->ModelUtente->getIsAdmin();
        $this->Html->HTML_header();
        $this->HtmlAmm->HTML_nav("amm_utenti");
        $this->HtmlAmm->HTML_edit_utente($id, $nome, $cognome, $username, $isadmin);
        $this->Html->HTML_footer();
    }

    /**
     * Esegue il cambio password (tutti gli utenti sono autorizzati unicamente per il loro account)
     */
    private function update_password()
    {
        $old_password = $_POST['old_password'];
        $old_password = md5($old_password);
        $new_password = $_POST['new_password'];
        $cnf_password = $_POST['cnf_password'];
        $username = $_SESSION['username'];
        // Controlla se l'utente ha inserito la giusta password attuale nel campo old password
        $login = $this->ModelUtente->checkLogin($username, $old_password);
        if ($login == 1)
        {
            //Se la password è giusta verifica che new password e cnf password corrispondano
            if($new_password == $cnf_password)
            {
                $new_password = md5($new_password);
                $this->ModelUtente->update_password($username, $new_password);
                $this->Html->HTML_header();
                $this->HtmlUtente->HTML_user_with_message("G","Password modificata!");
                $this->Html->HTML_footer();
            }
            else
            {
                $this->Html->HTML_header();
                $this->HtmlUtente->HTML_user_with_message("R","Nuova password e password di Conferma non corrispondenti!");
                $this->Html->HTML_footer();
            }
        }
        elseif ($login == 0)
        {
            $this->Html->HTML_header();
            $this->HtmlUtente->HTML_user_with_message("R", "Vecchia password errata!");
            $this->Html->HTML_footer();
        }
    }

}
