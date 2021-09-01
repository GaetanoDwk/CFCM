<?php


/**
 * Class HtmlIndagato
 * La classe si occupa delle operazioni di visualizzazione dei dati relativi agli indagati
 */
class MpdfIndagato
{

    /**
     * Stampa i tag per creare una nuova pagina. In questo modo quando si stampa la reportistica è possibile suddividere
     * i dati in pagine a seconda delle esigenze
     */
    public function HTML_newpage(){
        $html = "<div style='page-break-before: always;'>";
        return $html;
    }

    /**
     * Stampa il tag di chiusura della pagina aperta dalla funzione Html_newpage()
     */
    public function HTML_close_newpage(){
        $html = "</div>";
        return $html;
    }


    /**
     * Stampa il tag di andata a capo <br>
     */
    public function HTML_br(){
        $html = "<br>";
        return $html;
    }

    /**
     * Visualizza l'intestazione del REPORT di supporto alla creazione del DOCX di un determinato indagato
     * @param $ind_cognome
     * @param $ind_nome
     */
    public function HTML_REPORT_header_mpdf($ind_cognome, $ind_nome){
        $html = "<html>
            <head>
                <title>$ind_cognome $ind_nome</title>
                 <link rel='stylesheet' href='css/report_style.css'>
            </head>
        <body>";
        return $html;
    }

    /**
     * Visualizza l'intestazione della pagina del REPORT PDF di un indagato
     * @param $titolo
     */
    public function HTML_REPORT_page_header_mpdf($titolo)
    {
        $html = "
        <table>
                <tbody>
                    <tr>
                        <td id='cfcm'>Computer Forensics Case Manager</td>
                        <td id='titolo'>$titolo</td>
                        <td id='logotd'><img id='logoimg' alt='logo' src='images/logo.jpg'></td>
                    </tr>
                </tbody>
            </table>
            <br>";
        return $html;
    }


    /**
     * Visualizza le informazioni di prima pagina del report di un indagato
     * @param $ca_num
     * @param $ca_tipo
     * @param $ind_titolo
     * @param $ind_cognome
     * @param $ind_nome
     * @param $cli_nome
     * @param $cli_citta
     * @param $pm_titolo
     * @param $pm_cognome
     * @param $pm_nome
     * @param $ctu
     */
    public function HTML_REPORT_info_mpdf($ca_num, $ca_tipo, $ind_titolo, $ind_cognome, $ind_nome, $cli_nome, $cli_citta, $pm_titolo, $pm_cognome, $pm_nome, $ctu)
    {
        $html = "
        <table>
            <tbody>
                <tr>
                    <td class='textleft'><strong>Numero del Caso:</strong><br>$ca_num</td>
                    <td class='textleft' colspan='2'><strong>$ind_titolo</strong><br>$ind_cognome $ind_nome</td>
                </tr>
                <tr>
                    <td class='textleft'><strong>Cliente</strong><br>$cli_nome</td>
                    <td class='textleft' colspan='2'><strong>Contatto Cliente</strong><br>";
        if($_SESSION['cli_type'] == 'P'){$html .='PM '. $pm_titolo. " " . $pm_cognome . " " . $pm_nome;}else{$html .= $pm_titolo. " " .$pm_cognome. " " .$pm_nome;}
        "</td>
                </tr>
                <tr>
                    <td style='text-align: left;'><strong>Luogo</strong><br>$cli_citta</td>";
        if($_SESSION['cli_type']=='P'){$html .= "<td class='textleft'><strong>C.T.U.</strong><br>$ctu</td>";};
        if($_SESSION['cli_type']=='T'){$html .= "<td class='textleft'><strong>Perito</strong><br>$ctu</td>";};
        if($_SESSION['cli_type']=='C'){$html .= "<td class='textleft'><strong>C.T.P.</strong><br>$ctu</td>";};
        $html .= "<td class='textleft'><strong>Tipo di Investigazione</strong><br>$ca_tipo</td>
                </tr>
            </tbody>
        </table>";
        return $html;
    }


    public function HTML_REPORT_dettaglio_host_mpdf($ho_etichetta, $ho_modello, $ho_seriale, $ho_pwd, $ho_pwd_used, $ho_tipo)
    {
        $html = "
        <table>
                <tbody>
                    <tr>
                        <td class='tabcol'>ID Host</td>
                        <td class='tabcol'>Tipo</td>
                        <td class='tabcol'>Modello</td>
                        <td class='tabcol'>Nr. Seriale</td>
                        <td class='tabcol'>Password</td>
                    </tr>
                    <tr>
                        <td class='tabcell'>" . $ho_etichetta . "</td>
                        <td class='tabcell'>" . $ho_tipo . "</td>
                        <td class='tabcell'>" . $ho_modello . "</td>
                        <td class='tabcell'>" . $ho_seriale . "</td>";
        if($ho_pwd_used == 0){$html .= "<td class='tabcell'>" . $ho_pwd . "</td>";}
        if($ho_pwd_used == 1){$html .= "<td class='tabcell'>" . $ho_pwd . "&nbsp;&nbsp;" . "<img src='font/icon/check.png' style='height: 12px;'> </td>";}
        $html .= "       </tr>
                    </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_dettaglio_host_special_mpdf($ho_etichetta, $ho_modello, $ho_seriale, $ho_tipo)
    {
        $html="
        <table>
                <tbody>
                    <tr>
                        <td class='tabcol'>ID Host</td>
                        <td class='tabcol'>Tipo</td>
                        <td class='tabcol'>Modello</td>
                        <td class='tabcol'>Nr. Seriale</td>
                    </tr>
                    <tr>
                        <td class='tabcell'>" . $ho_etichetta . "</td>
                        <td class='tabcell'>" . $ho_tipo . "</td>
                        <td class='tabcell'>" . $ho_modello . "</td>
                        <td class='tabcell'>" . $ho_seriale . "</td>";
        $html.="       </tr>
                    </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_descrizione_host_mpdf($Info, $HostsSpecial, $ho_id, $ho_spec_id)
    {
        $html = "
        <p class='descrizione'> <b>Descrizione Host</b></p>
        <table>
            <tbody>
                <tr>
                    <td class='tabcol'>ID Host</td>
                    <td class='tabcol'>Tipo</td>
                    <td class='tabcolModello'>Modello</td>
                    <td class='tabcol'>Nr. Seriale</td>
                </tr>";
        foreach($Info as $row){
            if ($row['ho_id'] != $ho_id) {
                $html .= "<tr>
                            <td class='tabcell'>" . $row['ho_etichetta'] . "</td>
                            <td class='tabcell'>" . $row['ho_tipo'] . "</td>
                            <td class='tabcell'>" . $row['ho_modello'] . "</td>
                            <td class='tabcell'>" . $row['ho_seriale'] . "</td>
                         </tr>";
                $ho_id = $row['ho_id'];
            }
        }
        // Imposto ho_id a null siccome nel DETTAGLIO HOST ci sarà un nuovo controllo sugli ho_id per non stampare duplicati
        $ho_id = null;
        if($HostsSpecial != 0) {

            foreach ($HostsSpecial as $row) {
                if ($row['ho_id'] != $ho_spec_id) {
                    $html .= "
                            <tr>
                                <td class='tabcell'>" . $row['ho_etichetta'] . "</td>
                                <td class='tabcell'>" . $row['ho_tipo'] . "</td>
                                <td class='tabcell'>" . $row['ho_modello'] . "</td>
                                <td class='tabcell'>" . $row['ho_seriale'] . "</td>
                            </tr>
                            ";
                    $ho_spec_id = $row['ho_id'];
                }
            }
        }
        $html .="
        </tbody>
     </table>";
        return $html;
    }


    public function HTML_REPORT_descrizione_media_mpdf($arr, $HostsSpecial)
    {
        $html = "
        <p class='descrizione'><b>Descrizione Media</b></p>
        <table>
            <tbody>
                <tr>
                    <td class='tabcol'>ID Host</td>
                    <td class='tabcol'>Evidence</td>
                    <td class='tabcolModello'>Modello</td>
                    <td class='tabcol'>Dim.</td>
                    <td class='tabcol'>Nr. Seriale</td>
                </tr>";
        $IdEvi = 0;
        $ho_spec_id = 0;
        foreach($arr as $row){
            if($IdEvi != $row['evi_id']) {
                $html .= "<tr>
                                <td class='tabcell'>" . $row['ho_etichetta'] . "</td>
                                <td class='tabcell'>" . $row['evi_etichetta'] . "</td>
                                <td class='tabcell'>" . $row['evi_modello'] . "</td>
                                <td class='tabcell'>" . $row['evi_dimensione'] . " " . $row['evi_kbmbgbtb'] . "</td>
                                <td class='tabcell'>" . $row['evi_seriale'] . "</td>
                     </tr>";
                $IdEvi = $row['evi_id'];
            }
        }

        if($HostsSpecial != 0) {
            foreach ($HostsSpecial as $row) {
                if ($row['ho_id'] != $ho_spec_id) {
                    $html .= "
                            <tr>
                                <td class='tabcell'>" . $row['ho_etichetta'] . "</td>
                                <td class='tabcell'>" . $row['ho_etichetta'] . "</td>
                                <td class='tabcell'>" . $row['ho_modello'] . "</td>
                                <td class='tabcell'>" . $row['ho_dimensione'] . " " . $row['ho_kbmbgbtb'] . "</td>
                                <td class='tabcell'>" . $row['ho_seriale'] . "</td>
                            </tr>
                            ";
                    $ho_spec_id = $row['ho_id'];
                }
            }
        }
        $html .="
    </tbody>
</table>";
        return $html;
    }


    public function HTML_REPORT_dettaglio_evidence_mpdf($ho_etichetta, $evi_etichetta, $evi_tipo, $evi_modello, $evi_seriale, $evi_pwd, $evi_pwd_used, $evi_dimensione, $evi_kbmbgbtb)
    {
        $html = "
        <table>
                <tbody>
                    <tr>
                        <td class='tabcol'>ID Host</td>
                        <td class='tabcol'>Evidence</td>
                        <td class='tabcol'>Tipo</td>
                    </tr>
                    <tr>
                        <td class='tabcell'>" . $ho_etichetta . "</td>
                        <td class='tabcell'>" . $evi_etichetta . "</td>
                        <td class='tabcell'>" . $evi_tipo . "</td>
                    </tr>


                    <tr>
                        <td class='tabcol'>Modello</td>
                        <td class='tabcol'>Seriale</td>
                        <td class='tabcol'>Dimensione</td>
                    </tr>
                    <tr>
                        <td class='tabcell'>" . $evi_modello . "</td>
                        <td class='tabcell'>" . $evi_seriale . "</td>
                        <td class='tabcell'>" . $evi_dimensione . $evi_kbmbgbtb . "</td>
                    </tr>";

        if($evi_pwd != null){
            $html.="<tr>
                                <td class='tabcol'>Password</td>
                             </tr>
                             <tr>";
            if($evi_pwd_used == 0){$html.="<td class='tabcell'>" . $evi_pwd . "</td>";};
            if($evi_pwd_used == 1){$html.="<td class='tabcell'>" . $evi_pwd . "&nbsp;&nbsp;<img src='font/icon/check.png' style='height: 12px;'> </td>";}
            $html.="</tr>";
        }

        $html.="</tbody>
            </table>
            <br>
            <b id='note'>Note:</b>
            <table>
                <tbody>
                    <tr><td id='tdNote'></td></tr>
                </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_clone_mpdf($evi_etichetta, $clo_tipoacq, $clo_altro_tipo, $clo_stracq, $clo_md5, $clo_sha1, $clo_sha256)
    {
        $html="<table>
                <tbody>
                    <tr>
                        <td class='tabcol'>Evidence</td>
                        <td class='tabcol'>Tipo Acquisizione</td>
                        <td class='tabcol'>Strumento</td>

                    </tr>
                    <tr>
                        <td class='tabcell'>" . $evi_etichetta . "</td>";
        if($clo_tipoacq == "Altro")
        {
            $html.="<td class='tabcell'>" . $clo_tipoacq . ": " . $clo_altro_tipo ."</td>";
        }
        else
        {
            $html.="<td class='tabcell'>" . $clo_tipoacq . "</td>";
        }

        $html.="<td class='tabcell'>" . $clo_stracq . "</td>
                    </tr>
                    </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td class='tabcol'>Hash Generati</td>
                    </tr>
                    <tr>
                        <td class='hashGenerati'>MD5: $clo_md5</td>
                    </tr>
                    <tr>
                        <td class='hashGenerati'>SHA1: $clo_sha1</td>
                    </tr>
                    <tr>
                        <td class='hashGenerati'>SHA256: $clo_sha256</td>
                    </tr>
                    </tbody>
            </table>";
        return $html;
    }


    public function HTML_REPORT_table_one_tr($stringa)
    {
        $html="<table>
                <tbody>
                    <tr>
                        <td class='tabcol'>$stringa</td>
                    </tr>
                </tbody>
               </table>";
        return $html;
    }

    /**
     * Visualizza le foto di un host.
     * @param $ho_pathfoto
     * @param $ho_image1
     * @param $md5_image1
     * @param $ho_image2
     * @param $md5_image2
     * @param $ho_image3
     * @param $md5_image3
     * @param $ho_image4
     * @param $md5_image4
     */
    public function HTML_REPORT_foto_mpdf_OLD($ho_pathfoto, $ho_image1, $md5_image1, $ho_image2, $md5_image2, $ho_image3, $md5_image3, $ho_image4, $md5_image4)
    {
        echo"<table class='noborder'>
                <tbody>
                    <tr class='noborder'>";
                        if($md5_image1 != null){echo"<td class='noborder hashFoto'><img class='foto' src='$ho_pathfoto$ho_image1'><br><br>MD5: $md5_image1</td>";/*echo"<td class='noborder hashFoto'><img class='foto' src='$ho_pathfoto$ho_image1'><br><br>MD5: " . $md5_image1 . "</td>";*/}
                        if($md5_image2 != null){echo"<td class='noborder hashFoto'><img class='foto' src='$ho_pathfoto$ho_image2'><br><br>MD5: $md5_image2</td>";}
                        echo"</tr>";


                echo"<tr class='noborder'>";
                    if($md5_image3 != null){echo"<td class='noborder hashFoto'><img class='foto' src='$ho_pathfoto$ho_image3'><br><br>MD5: $md5_image3</td>";}
                    if($md5_image4 != null){echo"<td class='noborder hashFoto'><img class='foto' src='$ho_pathfoto$ho_image4'><br><br>MD5: $md5_image4</td>";}
                echo"</tr></tbody></table>";
    }


    public function HTML_REPORT_foto_mpdf($ho_pathfoto, $ho_image1, $md5_image1, $ho_image2, $md5_image2, $ho_image3, $md5_image3, $ho_image4, $md5_image4)
    {
        $html = null;
        if(($md5_image1 != null) || ($md5_image2 != null)) {
            $html .= "
            <table class='noborder'>
                <tr class='noborder'>";
                    if($md5_image1 != null){$html.="<td class='noborder hashFotoCenter'><img class='foto' src='$ho_pathfoto$ho_image1'><br><br>MD5: $md5_image1</td>";}
                    if($md5_image2 != null){$html.="<td class='noborder hashFotoCenter'><img class='foto' src='$ho_pathfoto$ho_image2'><br><br>MD5: $md5_image2</td>";}
            $html.="    
            </tr>
            </table>";
        }
        $html.="<br><br>";
        if(($md5_image3 != null) || ($md5_image4 != null)) {
            $html.= "
            <table class='noborder'>
                <tr class='noborder'>";
                    if($md5_image3 != null){$html.="<td class='noborder hashFotoCenter'><img class='foto' src='$ho_pathfoto$ho_image3'><br><br>MD5: $md5_image3</td>";}
                    if($md5_image4 != null){$html.="<td class='noborder hashFotoCenter'><img class='foto' src='$ho_pathfoto$ho_image4'><br><br>MD5: $md5_image4</td>";}
            $html.="
                </tr>
            </table>";
        }
        return $html;
    }


}