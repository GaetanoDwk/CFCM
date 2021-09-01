<?php
/* Il file index.php ha la funzione di router verso i vari controller a seconda del tipo di operazione che si sta svolgendo.
 * Tutte le POST e le GET sono indirizzate sempre a index.php che poi andrà a gestirle.
 * Per poter funzionare correttamente l'applicativo ha bisogno di includere tramite require_once i vari files dei controller, modelli e viste come di seguito.
 * Dopo tali inclusioni vi è uno switch-case che permette di redirezionare il flusso di esecuzione dell'applicativo.
 * */
require_once "modello/DbManager.php";
require_once __DIR__ . '/lib/vendor/autoload.php';

require_once("controllo/Controllo.php");
require_once("controllo/ControllerAzienda.php");
require_once("controllo/ControllerUtente.php");
require_once("controllo/ControllerCliente.php");
require_once("controllo/ControllerPm.php");
require_once("controllo/ControllerCaso.php");
require_once("controllo/ControllerIndagato.php");
require_once("controllo/ControllerHost.php");
require_once("controllo/ControllerHostSpecial.php");
require_once("controllo/ControllerEvidence.php");
require_once("controllo/ControllerClone.php");
require_once("controllo/ControllerCloneSpecial.php");
require_once("controllo/ControllerLavorazione.php");
require_once("controllo/ControllerMagazzino.php");
require_once("controllo/ControllerTools.php");
require_once("controllo/ControllerDocx.php");

require_once("modello/ModelAzienda.php");
require_once("modello/ModelProcura.php");
require_once("modello/ModelPm.php");
require_once("modello/ModelCaso.php");
require_once("modello/ModelIndagato.php");
require_once("modello/ModelHost.php");
require_once("modello/ModelHostSpecial.php");
require_once("modello/ModelEvidence.php");
require_once("modello/ModelClone.php");
require_once("modello/ModelGeneric.php");
require_once("modello/ModelCloneSpecial.php");
require_once("modello/ModelCliente.php");
require_once("modello/ModelLavorazione.php");
require_once("modello/ModelMagazzino.php");
require_once("modello/ModelTools.php");
require_once("modello/ModelUfedTools.php");
require_once("modello/ModelUtente.php");

require_once("vista/HtmlAmministrazione.php");
require_once("vista/HtmlProcura.php");
require_once("vista/HtmlPm.php");
require_once("vista/HtmlCaso.php");
require_once("vista/HtmlIndagato.php");
require_once("vista/HtmlPainter.php");
require_once("vista/HtmlClone.php");
require_once("vista/HtmlCloneSpecial.php");
require_once("vista/HtmlLavorazione.php");
require_once("vista/HtmlMagazzino.php");
require_once("vista/HtmlTribunale.php");
require_once("vista/HtmlCtp.php");
require_once("vista/HtmlHostSpecial.php");
require_once("vista/HtmlHost.php");
require_once("vista/HtmlEvidence.php");
require_once("vista/HtmlTools.php");
require_once("vista/HtmlUtente.php");
require_once("vista/MpdfIndagato.php");


$controller = "default";
$comando = "default";
$controllo = new Controllo();
$ControllerAzienda = new ControllerAzienda();
$ControllerUtente = new ControllerUtente();
$ControllerCliente = new ControllerCliente();
$ControllerPm = new ControllerPm();
$ControllerCaso = new ControllerCaso();
$ControllerIndagato = new ControllerIndagato();
$ControllerHost = new ControllerHost();
$ControllerHostSpecial = new ControllerHostSpecial();
$ControllerEvid = new ControllerEvidence();
$ControllerClone = new ControllerClone();
$ControllerCloneSpecial = new ControllerCloneSpecial();
$ControllerLavorazione = new ControllerLavorazione();
$ControllerMagazzino= new ControllerMagazzino();
$ControllerTools = new ControllerTools();
$ControllerDocx = new ControllerDocx();



if (!isset($_REQUEST["comando"])){
	$_REQUEST["comando"] = "firstpage";
	$controllo->invoke($_REQUEST["comando"]);
}

else{
	$comando = $_REQUEST["comando"];

	switch ($comando) {


        //__________________________________________ GESTIONE PRIMA PAGINA
		case 'checkLogin':
			$controllo->invoke($comando);
			break;

        case 'logout':
            $controllo->invoke($comando);
            break;

        case 'ricerca':
            $controllo->invoke($comando);
            break;


        //_________________________________________ USER
        case 'user':
            $ControllerUtente->invoke($comando);
            break;
        case 'update_password':
            $ControllerUtente->invoke($comando);
            break;

        //__________________________________________ AMMINISTRAZIONE
        case 'amministrazione':
            $controllo->invoke($comando);
            break;
        case 'amm_azienda':
            $ControllerAzienda->invoke($comando);
            break;
        case 'view_azienda':
            $ControllerAzienda->invoke($comando);
            break;
        case 'add_azienda':
            $ControllerAzienda->invoke($comando);
            break;
        case 'insert_azienda':
            $ControllerAzienda->invoke($comando);
            break;
        case 'edit_azienda':
            $ControllerAzienda->invoke($comando);
            break;
        case 'update_azienda':
            $ControllerAzienda->invoke($comando);
            break;
        case 'delete_azienda':
            $ControllerAzienda->invoke($comando);
            break;
        case 'amm_utenti':
            $ControllerUtente->invoke($comando);
            break;
        case 'add_utente':
            $ControllerUtente->invoke($comando);
            break;
        case 'insert_utente':
            $ControllerUtente->invoke($comando);
            break;
        case 'edit_utente':
            $ControllerUtente->invoke($comando);
            break;
        case 'update_utente':
            $ControllerUtente->invoke($comando);
            break;
        case "delete_utente":
            $ControllerUtente->invoke($comando);
            break;
        case 'amm_tipi_host':
            $ControllerHost->invoke($comando);
            break;
        case 'amm_tipi_host_special':
            $ControllerHostSpecial->invoke($comando);
            break;
        case 'amm_tipi_evidence':
            $ControllerEvid->invoke($comando);
            break;



        //___________________________________________ OPERAZIONI SULLE PROCURE
        // Visualizzazione pagine procure
        case "menu_procure":
            $ControllerCliente->invoke($comando);
            break;
        case "view_procure":
            $ControllerCliente->invoke($comando);
            break;
        case "view_procura":
            $ControllerCliente->invoke($comando);
            break;
        case "return_to_procura":
            $ControllerCliente->invoke($comando);
            break;
        case "add_procura":
            $ControllerCliente->invoke($comando);
            break;
        case "page_add_procura":
		    $ControllerCliente->invoke($comando);
            break;

        // Operazioni su DB per le PROCURE
        case "insert_procura":
            $ControllerCliente->invoke($comando);
            break;
        case "edit_procura":
            $ControllerCliente->invoke($comando);
            break;
        case "update_procura":
            $ControllerCliente->invoke($comando);
            break;
        case "delete_procura":
            $ControllerCliente->invoke($comando);
            break;
        case "ricerca_pro":
            $ControllerCliente->invoke($comando);
            break;

        // _____________________________________________ OPERAZIONI TRIBUNALI
        case 'menu_tribunali':
            $ControllerCliente->invoke($comando);
            break;
        case 'view_tribunali':
            $ControllerCliente->invoke($comando);
            break;
        case 'return_to_tribunali':
            $ControllerCliente->invoke($comando);
            break;
        case 'view_tribunale':
            $ControllerCliente->invoke($comando);
            break;
        case "return_to_tribunale":
            $ControllerCliente->invoke($comando);
            break;
        case 'add_tribunale':
            $ControllerCliente->invoke($comando);
            break;
        case 'insert_tribunale':
            $ControllerCliente->invoke($comando);
            break;
        case 'edit_tribunale':
            $ControllerCliente->invoke($comando);
            break;
        case 'update_tribunale':
            $ControllerCliente->invoke($comando);
            break;
        case 'delete_tribunale':
            $ControllerCliente->invoke($comando);
            break;

        // _____________________________________________ OPERAZIONI CTP
        case 'menu_ctp':
            $ControllerCliente->invoke($comando);
            break;
        case 'return_to_ctp':
            $ControllerCliente->invoke($comando);
            break;
        case 'view_ctp':
            $ControllerCliente->invoke($comando);
            break;
        case 'add_ctp':
            $ControllerCliente->invoke($comando);
            break;
        case 'insert_ctp':
            $ControllerCliente->invoke($comando);
            break;
        case 'edit_ctp':
            $ControllerCliente->invoke($comando);
            break;
        case 'update_ctp':
            $ControllerCliente->invoke($comando);
            break;
        case 'delete_ctp':
            $ControllerCliente->invoke($comando);
            break;

        //__________________________________________ OPERAZIONI SUI PM
        // Visualizzazione pagine PM
        case "page_add_pm":
            $ControllerPm->invoke($comando);
            break;
        case "view_pm":
            $ControllerPm->invoke($comando);
            break;
        // Operazioni su DB per i PM
        case 'insert_pm_of_cliente':
            $ControllerPm->invoke($comando);
            break;
        case "edit_pm":
            $ControllerPm->invoke($comando);
            break;
        case "pm_update":
            $ControllerPm->invoke($comando);
            break;
        case "delete_pm":
            $ControllerPm->invoke($comando);
            break;
        case "ricerca_pm":
            $ControllerPm->invoke($comando);
            break;


        //________________________________________ OPERAZIONI SU AVVOCATI
        // Visualizzazione pagine avvocati
        case "view_avvocato":
            $ControllerPm->invoke($comando);
            break;


        //______________________________________________ OPERAZIONI SUGLI UTENTI DEL GESTIONALE
        case "delete_utente":
            $ControllerUtente->invoke($comando);
            break;



        //______________________________________________ OPERAZIONI SUI CASI
        // Visualizzazione pagine dei CASI
        case "return_cases_of_pm":
            $ControllerCaso->invoke($comando);
            break;
        case "view_caso":
            $ControllerCaso->invoke($comando);
            break;
        case "page_add_caso":
            $ControllerCaso->invoke($comando);
            break;
        case "scadenze":
            $ControllerCaso->invoke($comando);
            break;
        case "infocaso":
            $ControllerCaso->invoke($comando);
            break;
        // Generazione PDF copertina CASO
        case "rep_caso":
            $ControllerCaso->invoke($comando);
            break;
        case "copertina":
            $ControllerCaso->invoke($comando);
            break;
        case "copertinaCtp":
            $ControllerCaso->invoke($comando);
            break;
        case "opendir":
            $ControllerCaso->invoke($comando);
            break;
        case "consulenza":
            $ControllerCaso->invoke($comando);
            break;

        // Operazione su DB per i CASI
        case "insert_caso":
            $ControllerCaso->invoke($comando);
            break;
        case "update_caso":
            $ControllerCaso->invoke($comando);
            break;
        case "delete_caso":
            $ControllerCaso->invoke($comando);
            break;
        case "edit_caso":
            $ControllerCaso->invoke($comando);
            break;
        case "ricerca_caso":
            $ControllerCaso->invoke($comando);
            break;






        //______________________________________________ OPERAZIONI INDAGATI
        // Visualizzazione pagine INDAGATI
        /*case "page_view_indagati_of_caso":
            $ControllerIndagato->invoke($comando);
            break;*/
        case "status_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        case "return_to_caso":
            $ControllerIndagato->invoke($comando);
            break;
        case "view_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        case "page_add_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        case "edit_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        // Operazioni sul DB per gli INDAGATI
        case "insert_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        case "update_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        case "delete_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        // Reportistica PDF INDAGATO
        case "report_indagato":
            $ControllerIndagato->invoke($comando);
            break;
        case "report_indagato_mpdf":
            $ControllerIndagato->invoke($comando);
            break;


        //______________________________________________ OPERAZIONI SUGLI HOST

        case "insert_host":
            $ControllerHost->invoke($comando);
            break;

        case "view_host":
            $ControllerHost->invoke($comando);
            break;

        case "ricerca_host":
            $ControllerHost->invoke($comando);
        break;

        case "return_to_indagato":
            $ControllerHost->invoke($comando);
            break;

        case "update_host_info":
            $ControllerHost->invoke($comando);
            break;

        case "update_host_foto":
            $ControllerHost->invoke($comando);
            break;

        case "delete_host_images":
            $ControllerHost->invoke($comando);
            break;

        case "SET_DOCX_host_image":
        $ControllerHost->invoke($comando);
        break;

        case "UNSET_DOCX_host_image1":
            $ControllerHost->invoke($comando);
            break;

        case "UNSET_DOCX_host_image2":
            $ControllerHost->invoke($comando);
            break;

        case "DELETE_host_image":
            $ControllerHost->invoke($comando);
            break;

        case "delete_host":
            $ControllerHost->invoke($comando);
            break;

        case "page_view_host":
            $ControllerHost->invoke($comando);
            break;

        case "page_add_host":
            $ControllerHost->invoke($comando);
            break;

        case "edit_host":
            $ControllerHost->invoke($comando);
            break;

        //Gestione dei tipi host
        case "page_add_ho_tipo":
            $ControllerHost->invoke($comando);
            break;
        case "page_del_ho_tipo":
            $ControllerHost->invoke($comando);
            break;
        case "del_ho_tipo":
            $ControllerHost->invoke($comando);
            break;
        case "insert_ho_tipo":
            $ControllerHost->invoke($comando);
            break;
        case "delete_ho_tipo":
            $ControllerHost->invoke($comando);
            break;


        //______________________________________________ OPERAZIONI SUGLI HOST SPECIALI
        case "edit_host_special":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "view_host_special":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "page_add_host_special":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "add_hos_tipo":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "insert_host_special":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "insert_hos_tipo":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "update_host_special":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "page_del_hos_tipo":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "del_hos_tipo":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "delete_host_special":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "update_host_special_images":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "delete_host_special_images":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "delete_host_special_image1":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "delete_host_special_image2":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "delete_host_special_image3":
            $ControllerHostSpecial->invoke($comando);
            break;
        case "delete_host_special_image4":
            $ControllerHostSpecial->invoke($comando);
            break;

        case "SET_DOCX_hostSP_image":
            $ControllerHostSpecial->invoke($comando);
            break;

        case "UNSET_DOCX_hostSP_image1":
            $ControllerHostSpecial->invoke($comando);
            break;

        case "UNSET_DOCX_hostSP_image2":
            $ControllerHostSpecial->invoke($comando);
            break;

        case "DELETE_host_special_image":
            $ControllerHostSpecial->invoke($comando);
            break;


        //______________________________________________ OPERAZIONI EVIDENCE

        case "insert_evidence":
            $ControllerEvid->invoke($comando);
            break;

        case "insert_evi_tipo":
            $ControllerEvid->invoke($comando);
            break;

        case "update_evidence_foto":
            $ControllerEvid->invoke($comando);
            break;

        case "update_evidence_info":
            $ControllerEvid->invoke($comando);
            break;

        case "delete_evidence_images":
            $ControllerEvid->invoke($comando);
            break;

        /*case "delete_evidence_image1":
            $ControllerEvid->invoke($comando);
            break;

        case "delete_evidence_image2":
            $ControllerEvid->invoke($comando);
            break;

        case "delete_evidence_image3":
            $ControllerEvid->invoke($comando);
            break;*/

        case "DELETE_evidence_image":
            $ControllerEvid->invoke($comando);
            break;

        case "delete_evidence":
            $ControllerEvid->invoke($comando);
            break;

        case "add_evidence":
            $ControllerEvid->invoke($comando);
            break;

        case "edit_evidence":
            $ControllerEvid->invoke($comando);
            break;

        case "view_evidence":
            $ControllerEvid->invoke($comando);
            break;
        //Operazioni sui Tipi Evidence
        case "page_add_tipo_evi":
            $ControllerEvid->invoke($comando);
            break;
        case "insert_tipo_evi":
            $ControllerEvid->invoke($comando);
            break;
        case "page_del_tipo_evi":
            $ControllerEvid->invoke($comando);
            break;
        case "del_tipo_evi":
            $ControllerEvid->invoke($comando);
            break;
        case "delete_tipo_evi":
            $ControllerEvid->invoke($comando);
            break;
        case "SET_DOCX_evi_image":
            $ControllerEvid->invoke($comando);
            break;
        case "UNSET_DOCX_evi_image":
            $ControllerEvid->invoke($comando);
            break;




        //______________________________________________ OPERAZIONI CLONE
        case "add_clone":
            $ControllerClone->invoke($comando);
            break;

        case "insert_clone":
            $ControllerClone->invoke($comando);
            break;


        case "edit_clone":
            $ControllerClone->invoke($comando);
            break;

        case "update_clone":
            $ControllerClone->invoke($comando);
            break;

        case "delete_clone":
            $ControllerClone->invoke($comando);
            break;

        case "view_log":
            $ControllerClone->invoke($comando);
            break;




        // _____________________________________________ OPERAZIONI CLONE HOST SPECIAL
        case "add_clone_host_special":
            $ControllerCloneSpecial->invoke($comando);
            break;

        case "insert_clone_host_special":
            $ControllerCloneSpecial->invoke($comando);
            break;

        case "edit_clone_special":
            $ControllerCloneSpecial->invoke($comando);
            break;

        case "update_clone_special":
            $ControllerCloneSpecial->invoke($comando);
            break;

        case "delete_clone_special":
            $ControllerCloneSpecial->invoke($comando);
            break;









        // _____________________________________________ OPERAZIONI LAVORAZIONE
        case 'lavorazione':
            $ControllerLavorazione->invoke($comando);
            break;

        case 'refresh_lavorazione':
            $ControllerLavorazione->invoke($comando);
            break;

        case "add_lavorazione":
            $ControllerLavorazione->invoke($comando);
            break;

        case "insert_lavorazione":
            $ControllerLavorazione->invoke($comando);
            break;

        case "edit_lavorazione":
            $ControllerLavorazione->invoke($comando);
            break;

        case "update_lavorazione":
            $ControllerLavorazione->invoke($comando);
            break;

        case "delete_lavorazione":
            $ControllerLavorazione->invoke($comando);
            break;


        // _____________________________________________ OPERAZIONI MAGAZZINO
        case 'magazzino':
            $ControllerMagazzino->invoke($comando);
            break;
        case 'add_magazzino':
            $ControllerMagazzino->invoke($comando);
            break;
        case 'insert_magazzino':
            $ControllerMagazzino->invoke($comando);
            break;
        case 'edit_magazzino':
            $ControllerMagazzino->invoke($comando);
            break;
        case 'update_magazzino':
            $ControllerMagazzino->invoke($comando);
            break;
        case 'delete_magazzino':
            $ControllerMagazzino->invoke($comando);
            break;




            // _____________________________________________ OPERAZIONI FTK TOOLS
        case 'ftktools':
            $ControllerTools->invoke($comando);
            break;
        case 'ftktool_item':
            $ControllerTools->invoke($comando);
            break;
        case 'import_data_1':
            $ControllerTools->invoke($comando);
            break;
        case 'import_data_2':
            $ControllerTools->invoke($comando);
            break;
        case 'import_data_3':
            $ControllerTools->invoke($comando);
            break;
        case 'import_data_4':
            $ControllerTools->invoke($comando);
            break;
        case 'import_data_5':
            $ControllerTools->invoke($comando);
            break;
        case 'import_data_6':
            $ControllerTools->invoke($comando);
            break;
        case "ftktools_import_emails":
            $ControllerTools->invoke($comando);
            breaK;
        case "GENERATE_email_filter":
            $ControllerTools->invoke($comando);
            break;
        case 'group_by_md5':
            $ControllerTools->invoke($comando);
            break;
        case 'ftktools_groupby_md5':
            $ControllerTools->invoke($comando);
            break;
        case 'upload_filelist':
            $ControllerTools->invoke($comando);
            break;
        case 'upload_filelist_items':
            $ControllerTools->invoke($comando);
            break;
        case 'upload_filelist_emails':
            $ControllerTools->invoke($comando);
            break;
        case 'ftktools_md5_filter':
            $ControllerTools->invoke($comando);
            break;
        case 'group_by_md5_and_path':
            $ControllerTools->invoke($comando);
            break;
        case 'ftktool_shortpath':
            $ControllerTools->invoke($comando);
            break;
        case 'ftktool_longpath':
            $ControllerTools->invoke($comando);
            break;
        case 'ftktools_email':
            $ControllerTools->invoke($comando);
            break;
        case 'UPLOAD_filelist_md5_filter':
            $ControllerTools->invoke($comando);
            break;
        case 'UPLOAD_shortpath_filelist':
            $ControllerTools->invoke($comando);
            break;
        case 'UPLOAD_longpath_filelist':
            $ControllerTools->invoke($comando);
            break;
        case 'GENERATE_md5_filter':
            $ControllerTools->invoke($comando);
            break;
        case 'GENERATE_filter_by_items':
            $ControllerTools->invoke($comando);
            break;
        case 'GENERATE_shortpath_filter':
            $ControllerTools->invoke($comando);
            break;
        case 'GENERATE_longpath_filter':
            $ControllerTools->invoke($comando);
            break;


        // _____________________________________________ OPERAZIONI UFED TOOLS
        case 'ufedtools':
            $ControllerTools->invoke($comando);
            break;
        case 'ufedtools_chat_whatsapp':
            $ControllerTools->invoke($comando);
            break;
        case 'ufedtools_gen_chat':
            $ControllerTools->invoke($comando);
        breaK;



        case 'docx':
            $ControllerDocx->invoke($comando);
            break;

    }



}

?>
