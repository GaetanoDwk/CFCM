<?php

/**
 * Class ControllerDocx
 * Questa classe serve alla generazione delle informazioni utili alla creazione della consulenza informatica formato word.
 * Le informazioni vengono stampate in modo formattato utile ad essere copiato e incollato nel documento word.
 */
class ControllerDocx
{
    /**
     * ControllerDocx constructor.
     * Vengono istanziate le classi che saranno utilizzate successivamente.
     */
    public function __construct()
    {
        $this->Html = new HtmlPainter();
        $this->HtmlIndagato = new HtmlIndagato();
        $this->ModelProcura = new ModelProcura();
        $this->ModelPm = new ModelPm();
        $this->ModelCliente = new ModelCliente();
        $this->ModelCaso = new ModelCaso();
        $this->ModelIndagato = new ModelIndagato();
        $this->ModelHost = new ModelHost();
        $this->ModelHostSpecial = new ModelHostSpecial();

    }


    /**
     * @param $comando
     * La funzione permette di indirizzare il flusso di esecuzione a seconda del valore assunto dalla variabile $comando.
     */
    public function invoke($comando)
    {
        switch ($comando)
        {
            case "docx":
                $this->genera_consulenza();
                break;
        }

    }


    /**
     * La funzione genera la stampa a video delle informazioni opportunamente formattate relative agli host ed evidence presenti nel caso
     */
    public function genera_consulenza(){
        $this->HtmlIndagato->HTML_REPORT_header(null, null);
        echo"<div class='container'>";
        $IdCaso = $_POST['ca_id'];
        $Indagati = $this->ModelIndagato->select_indagati_of_caso($IdCaso);

        /*echo "<pre>";
        print_r($Indagati);
        echo "</pre>";*/

        foreach ($Indagati as $row) {
            $IdInd = $row['ind_id'];
            $Cognome = $row['ind_cognome'];
            $Nome = $row['ind_nome'];

            // SELEZIONA DATI PER STAMPARE TABELLA DEGLI HOST
            $Hosts = $this->ModelHost->select_hosts_of_indagato($IdInd);
            $HostsSp = $this->ModelHostSpecial->select_hosts_special_of_indagato($IdInd);
            // STAMPA TABELLA HOSTS
            $this->PRINT_hosts_table($Cognome, $Nome, $Hosts, $HostsSp);

            // SELEZIONA DATI PER STAMPARE TABELLA DEI MEDIA/EVIDENCE
            $HostsEvi = $this->ModelHost->select_hosts_evidence_of_indagato_for_docx($IdInd);
            $HostsSp = $this->ModelHostSpecial->select_hosts_special_of_indagato($IdInd);
            // STAMPA TABELLA MEDIA/EVIDENCE
            $this->PRINT_evidences_table($HostsEvi, $HostsSp);

            // SELEZIONA DATI PER STAMPARE DETTAGLI DEGLI HOST ED EVICENCE
            $Hosts = $this->ModelHost->select_hosts_evidence_of_indagato_for_docx($IdInd);
            $HostsSp = $this->ModelHostSpecial->select_hosts_special_of_indagato($IdInd);

            // STAMPA DETTAGLI DEGLI HOSTS
            $this->PRINT_HOST_details($Hosts);

            //STAMPA DETTAGLI DEGLI HOSTS SPECIALI
            $this->PRINT_HOSTSP_details($HostsSp);
            /*echo"<pre>";
            print_r($HostsSp);
            echo"</pre>";*/
        }
        echo"</div>";
        $this->Html->HTML_footer();
    }


    /**
     * @param $Cognome : viene usato nella stampa della dicitura iniziale "Schede tecniche del materiale informatico sequestrato a..."
     * @param $Nome : viene usato nella stampa della dicitura iniziale "Schede tecniche del materiale informatico sequestrato a..."
     * @param $Hosts : array contenente le informazioni degli hosts
     * @param $HostsSp : array contenente le informazioni degli hosts speciali
     * La funzione stampa la tabella con le informazioni degli host
     */
    private function PRINT_hosts_table($Cognome, $Nome, $Hosts, $HostsSp)
    {
        echo"<section><h1 style='font-family: Cambria; font-size: 12pt;'>Schede Tecniche del materiale informatico sequestrato a $Cognome $Nome</h1></section><br>";

            echo"<p style='font-family: Arial; font-size: 14pt;' align='center'><b>Descrizione Host</b></p>
            <table style='width: 690px; border: black; border-style: solid; border-width: 1px;' cellpadding='7px;'>
                    <th style='color: white; font-family: Arial; font-size:9pt;' bgcolor='##003c78' align='center'>ID Host</th>
                    <th style=\"color: white; font-family: Arial; font-size:9pt;\" bgcolor=\"##003c78\">Tipo</th>
                    <th style=\"color: white; font-family: Arial; font-size:9pt;\" bgcolor=\"##003c78\">Modello</th>
                    <th style=\"color: white; font-family: Arial; font-size:9pt;\" bgcolor=\"##003c78\">Nr. Seriale</th>";
            foreach ($Hosts as $Host) {
                $HoEti = $Host['ho_etichetta'];
                $HoTip = $Host['ho_tipo'];
                $HoMod = $Host['ho_modello'];
                $HoSer = $Host['ho_seriale'];
                echo "<tr>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoEti</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoTip</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoMod</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoSer</td>
                      </tr>  ";
            }

            foreach ($HostsSp as $HostSp){
                $HoEti = $HostSp['ho_etichetta'];
                $HoTip = $HostSp['ho_tipo'];
                $HoMod = $HostSp['ho_modello'];
                $HoSer = $HostSp['ho_seriale'];
                echo"<tr>   
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoEti</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoTip</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoMod</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoSer</td>
                    </tr>";
            }
            echo"</table><br>";

    }


    /**
     * @param $HostsEvi : array contenente le informazioni degli evidence
     * @param $HostsSp : array contenente le informazioni degli host special (che in sostanza sono anche evidence).
     * La funzione stampa la tabella con le informazioni degli evidence
     */
    private function PRINT_evidences_table($HostsEvi, $HostsSp)
    {

            echo"<p style='font-family: Arial; font-size: 14pt;' align='center'><b>Descrizione Media</b></p>
            <table style='width: 690px; border: black; border-style: solid; border-width: 1px;' cellpadding='7px;'>
                    <th style='color: white; font-family: Arial; font-size:9pt;' bgcolor='##003c78' align='center'>ID Host</th>
                    <th style=\"color: white; font-family: Arial; font-size:9pt;\" bgcolor=\"##003c78\">Evidence</th>
                    <th style=\"color: white; font-family: Arial; font-size:9pt;\" bgcolor=\"##003c78\">Modello</th>
                    <th style=\"color: white; font-family: Arial; font-size:9pt;\" bgcolor=\"##003c78\">Dim.</th>
                    <th style=\"color: white; font-family: Arial; font-size:9pt;\" bgcolor=\"##003c78\">Nr.Seriale</th>";
            foreach ($HostsEvi as $Evi) {
                $HoEti = $Evi['ho_etichetta'];
                $EviEti = $Evi['evi_etichetta'];
                $EviMod = $Evi['evi_modello'];
                $EviDim = $Evi['evi_dimensione'];
                $EviGb = $Evi['evi_kbmbgbtb'];
                $EviSer = $Evi['evi_seriale'];
                echo "<tr>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HoEti</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$EviEti</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$EviMod</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$EviDim $EviGb</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$EviSer</td>
                      </tr>  ";
            }

            foreach ($HostsSp as $HostSp){
                $HosEti = $HostSp['ho_etichetta'];
                $HosMod = $HostSp['ho_modello'];
                $HosDim = $HostSp['ho_dimensione'];
                $HosGb = $HostSp['ho_kbmbgbtb'];
                $HosSer = $HostSp['ho_seriale'];
                echo"<tr>   
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HosEti</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HosEti</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HosMod</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HosDim $HosGb</td>
                        <td style='font-family: Arial; font-size:9pt;' align='center'>$HosSer</td>
                    </tr>";
            }
            echo"</table><br>";
    }


    /**
     * @param $Hosts : array contenente le informazioni degli hosts.
     * La funzione stampa i dettagli dell'host (modello, s.n.,...) comprensivo delle immagini già dimensionate alla risoluzione che utilizziamo in consulenza
     * pronto per essere copiato e incollato in consulenza.
     */
    private function PRINT_HOST_details($Hosts)
    {
        $prevHoId = 0;
            foreach ($Hosts as $Host){
                $HoId = $Host['ho_id'];
                $HoEti = $Host['ho_etichetta'];
                $HoMod = $Host['ho_modello'];
                $HoSer = $Host['ho_seriale'];
                $HoPat = $Host['ho_pathfoto'];
                $HoImg1 = $Host['ho_image_docx'];
                $HoImg2 = $Host['ho_image_docx2'];
                $EvPat = $Host['evi_pathfoto'];
                $EvImg = $Host['evi_image_docx'];
                if($HoId != $prevHoId){
                    echo"<section><h2>$HoEti - $HoMod - S.N.: $HoSer</h2>
                            <table style='width: 690px'>
                                <tr>";
                                    if($HoImg1 != null){echo"<td style='height: 6.67cm'><img src='$HoPat$HoImg1' style='height: 6.67cm;'></td>";}
                                    if($HoImg2 != null){echo"<td style='height: 6.67cm'><img src='$HoPat$HoImg2' style='height: 6.67cm;'></td>";}
                                    if($EvImg != null){echo"<td style='height: 6.67cm'><img src='$EvPat$EvImg' style='height: 6.67cm;'></td>";}
                                echo"</tr>
                            </table>
                        </section><br>";
                }
                $prevHoId = $HoId;
            }
    }


    /**
     * @param $HostsSp : array contenente le informazioni degli hosts speciali
     * La funzione stampa i dettagli degli host speciali (modello, s.n.,...) comprensivo delle immagini già dimensionate alla risoluzione che utilizziamo in consulenza
     * pronto per essere copiato e incollato in consulenza.
     */
    private function PRINT_HOSTSP_details($HostsSp)
    {
        foreach ($HostsSp as $HostSp){
                $HoEti = $HostSp['ho_etichetta'];
                $HoMod = $HostSp['ho_modello'];
                $HoSer = $HostSp['ho_seriale'];
                $HoPat = $HostSp['ho_pathfoto'];
                $HoImg1 = $HostSp['ho_image_docx'];
                $HoImg2 = $HostSp['ho_image_docx2'];
                //$this->Html->HTML_newpage();
                echo"<section><h2>$HoEti - $HoMod - S.N.: $HoSer</h2>
                        <table>
                            <tr>
                                <td style='height: 6.67cm' '><img src='$HoPat$HoImg1' style='height: 6.67cm'></td>
                                <td style='height: 6.67cm'><img src='$HoPat$HoImg2' style='height: 6.67cm'></td>
                            </tr>
                        </table>
                    </section><br>";
                //$this->Html->HTML_close_newpage();
            }
    }

}
