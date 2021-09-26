<?php
session_start();

/**
 * Class Controllo
 * Questa classe si occupa di gestire la stampa a video della prima pagina e di altre funzioni generiche
 */
class Controllo
{
     /**
     * Controllo constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->CntCaso = new ControllerCaso();
        $this->MdlPm = new ModelPm();
        $this->MdlCaso = new ModelCaso();
        $this->MdlHost = new ModelHost();
        $this->MdlUte = new ModelUtente();
        $this->MdlPro = new ModelProcura();
        $this->MdlInd = new ModelIndagato();
        $this->MdlLav = new ModelLavorazione();
        $this->VstHtml = new HtmlPainter();
        $this->VstPro = new HtmlProcura();

    }

    /**
     * @param $comando
     * @throws Exception
     * Questa funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
      switch ($comando)
      {
          case 'firstpage':
              $this->firstpage();
              break;

          case 'amministrazione':
              $this->amministrazione();
              break;

          case 'logout':
              $this->logout();
              break;

          case 'checkLogin':
              $this->checkLogin();
              break;
              
          case 'ricerca':
              $this->ricerca();
              break;

            default: throw new Exception ("ERRORE SWITCH CASE");
      	break;
      }

    }

    /**
     * Se non esiste una sessione stampa la pagina di login altrimenti se si è già loggati stampa il menù procure.
     */
    private function firstpage()
    {
        // Se la sessione è vuota stampa pagina di login
        if(empty($_SESSION)){
            $this->VstHtml->HTML_header();
            $this->VstHtml->HTML_login_page();
            $this->VstHtml->HTML_footer();
        }
        // altrimenti stampa la prima pagina dopo il login
        else if($_SESSION['username'] != "") {
            $this->menu_procure();
        }
    }


    /**
     * Stampa la pagina di amministrazione di CFCM
     */
    private function amministrazione()
    {
        $this->VstHtml->HTML_header();
        $this->VstHtml->HTML_amministrazione();
        $this->VstHtml->HTML_footer();

    }

    /**
     * Effettua il logout distruggendo la sessione attiva e stampa la pagina di login.
     */
    private function logout()
    {
        session_unset();
        session_destroy();
        $this->VstHtml->HTML_header();
        $this->VstHtml->HTML_login_page();
        $this->VstHtml->HTML_footer();
    }

    /**
     * Effettua i controlli per l'autenticazione.
     */
    private function checkLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // MD5 della password
        $password = md5($password);
        // Confronto delle credenziali
        $checkLogin = $this->MdlUte->checkLogin($username, $password);
        if($checkLogin == 2 || $checkLogin == 1)
        {
            // Stampa menu iniziale dopo una corretta autenticazione
            $this->menu_procure();
        }

        elseif ($checkLogin == 0)
        {
            // Stampa pagina login errato
            $this->VstHtml->HTML_header();
            $this->VstHtml->HTML_login_wrong();
            $this->VstHtml->HTML_footer();
        }
    }

    /**
     * Stampa la pagina per effettuare ricerche.
     */
    private function ricerca()
    {
        $this->VstHtml->HTML_header();
        $this->VstHtml->HTML_ricerca();
        $this->VstHtml->HTML_footer();
    }

    /**
     * Stampa la pagina con il menù principale di CFCM
     */
    private function menu_procure()
    {
        $_SESSION['cli_type'] = 'P';
        // SELEZIONO I DATI DA VISUALIZZARE NEL MENU
        $datiProcure = $this->MdlPro->select_procure();
        $datiPm = $this->MdlPm->select_all_pm();
        $datiCasi = $this->MdlCaso->select_all_casi();
        $datiIndagati = $this->MdlInd->select_all_indagati();
        //VISUALIZZO IL MENU
        $this->VstPro->HTML_menu_procure($datiProcure, $datiPm, $datiCasi, $datiIndagati);
        $this->VstHtml->HTML_footer();
    }
}
?>
