<?php

/**
 * Class HtmlClone
 * La classe gestisce le funzioni di visualizzazione relative ai cloni
 */
class HtmlClone
{

    /**
     * Visualizza i cloni di un evidence
     * @param $CloOfEvi
     */
    public function HTML_clone_of_evidence($CloOfEvi)
    {
        echo"<br><br>
                <div class='container' style='width: 100%'>
                    <h5>Clone</h5>
                    <table class='u-full-width'>
                    <tbody>";
        foreach ($CloOfEvi as $row)
        {
            $id = $row['clo_id'];
            $tipoacq = $row['clo_tipoacq'];
            $stracq = $row['clo_stracq'];
            $md5 = $row['clo_md5'];
            $sha1 = $row['clo_sha1'];
            $sha256 = $row['clo_sha256'];


            echo"
                <tr style='background-color: lightblue'>";
                if ($tipoacq == 'Fisica'){ echo"<th><img src='font/icon/fisica.png' height='30'></th>";}
                if ($tipoacq == 'Logica'){ echo"<th><img src='font/icon/logica.png' height='30'></th>";}
                if ($tipoacq == 'File System'){ echo"<th><img src='font/icon/filesystem.png' height='30'></th>";}
                if ($tipoacq == 'APK Downgrade'){ echo"<th><img src='font/icon/apkdowngrade.png' height='30'></th>";}
                if ($tipoacq == 'Altro'){ echo"<th><img src='font/icon/altro.png' height='30'></th>";}
            echo"
                </tr>";

            echo"
                <tr><td>ACQUISIZIONE: $tipoacq</td></tr>
                <tr><td>STRUMENTO: $stracq</td></tr>
                <tr><td>MD5: $md5</td></tr>
                <tr><td>SHA1: $sha1</td></tr>
                <tr><td>SHA256: $sha256</td></tr>
                <tr><td>
                <form action='index.php'  method='post' target='_blank' style='display: inline;'>
                    <input type='hidden' id='clo_id' name='clo_id'  value=" . $id .">
                    <button class='button_operazioni' type='submit' name='comando' value='view_log' style='border:none;'><i class='fa fa-file fa-2x'></i></button>
                    </form>
                <form action='index.php'  method='post' style='display: inline;'>
                    <input type='hidden' id='clo_id' name='clo_id'  value=" . $id .">
                    <button class='button_operazioni' type='submit' name='comando' value='edit_clone' style='border:none;'><i class='fa fa-pencil-square-o fa-2x'></i></button>
                    <!--Bottone con script JS che chiede conferma-->
                    <button class='button_operazioni' onclick='return confirm(\"Sicuro di voler eliminare questo elemento?\")' type='submit' name='comando' value='delete_clone' style='border:hidden;'><i class='fa fa-trash fa-2x'></i></button>
                    <!--Bottone normale da abilitare in caso di problemi con quello con script JS-->
                    <!--button class='button_operazioni' type='submit' name='comando' value='delete_evidence' style='border:none;'><i class=\"fa fa-trash fa-2x\" aria-hidden=\"true\"></i></button></td-->
                 </form>

                 </td></tr>";
        }

        echo"
        </tbody>
    </table>
        <form action='index.php' method='post'>
                        <button type='submit' name='comando' value='add_clone' title='Aggiungi un Clone' style='border:none'><i class=\"fa fa-plus fa-2x\" aria-hidden=\"true\"></i></button>
                    </form>
      </div>";
    }


    /**
     * Visualizza la pagina per aggiungere un nuovo clone
     * @param $TipoEvi
     * @param $NomeEvi
     */
    public function HTML_add_clone($TipoEvi, $NomeEvi)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_evi_id"]))
            {
                if($_SESSION['cli_type'] == 'P') {
                    echo "<form action='index.php' method='post' style='display: inline;'>
                            <button name='comando' value='view_evidence' style='position: absolute; left: 0%; border: none;' title='Torna ad Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'T') {
                    echo "<form action='index.php' method='post' style='display: inline;'>
                            <button name='comando' value='view_evidence' style='position: absolute; left: 0%; border: none;' title='Torna ad Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
                if($_SESSION['cli_type'] == 'C') {
                    echo "<form action='index.php' method='post' style='display: inline;'>
                            <button name='comando' value='view_evidence' style='position: absolute; left: 0%; border: none;' title='Torna ad Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                            <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                         </form>";
                }
            }
            echo"
            <br><br>
            <center>
                    <img src='font/icon/fisica.png' height='35'>
                    <img src='font/icon/logica.png' height='35'>
                    <img src='font/icon/filesystem.png' height='35'>
                    <h6 class='docs-header'>INSERIMENTO NUOVO CLONE DI $NomeEvi</h6></center>
            <!-- QUESTO SCRIPT ABILITA E DISABILITA IL CAMPO LIBERO PER LE NOTE SU ALTRA ACQUISIZIONE -->
            <script>
                function changeTextBoxState(dropDown) {
                    if(dropDown.value == 'Altro')
                    {
                        $('#clo_altro').prop('disabled', false);
                    }
                    else
                    {
                    $('#clo_altro').prop('disabled', true);
                    }
                }
            </script>
                <form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <center>
                    <select required name='clo_tipoacq' class='form-control' onChange='changeTextBoxState(this)' style='width: 50%;'>
                        <option value=''>Acquisizione:</option>
                        <option value='Fisica'>Fisica</option>
                        <option value='File System'>File System</option>
                        <option value='Logica'>Logica</option>
                        <option value='APK Downgrade'>APK Downgrade</option>
                        <option value='Altro'>Altro</option>
                    </select>
                    <input type='text' class='form-control' id='clo_altro' name='clo_altro' style='width:50%' disabled placeholder='Note Altra Acqusizione'><br>";
                    if(($TipoEvi == 'Memoria') || ($TipoEvi == 'SimCard') || ($TipoEvi == 'MemoryCard'))
                    {
                        echo"<input type = 'text' class='form-control' id = 'clo_stracq' name = 'clo_stracq' style = 'width:50%' placeholder = 'Strumento Acqusizione' value='Cellebrite UFED4PC' required ><br >";
                    }
                    else
                    {
                        echo"<input type = 'text' class='form-control' id = 'clo_stracq' name = 'clo_stracq' style = 'width:50%' placeholder = 'Strumento Acqusizione' required ><br >";
                    }
                    echo"<input type='text' class='form-control' pattern='.{32,32}' id='clo_md5' name='clo_md5' style='width:80%' placeholder='Md5 (32 caratteri)'><br>
                    <input type='text' class='form-control' pattern='.{40,40}' id='clo_sha1' name='clo_sha1' style='width:80%' placeholder='Sha1 (40 caratteri)'><br>
                    <input type='text' class='form-control' pattern='.{64,64}' id='clo_sha256' name='clo_sha256' style='width:80%' placeholder='Sha256 (64 caratteri)'><br>
                    <textarea id='clo_log' name='clo_log' style='width: 100%; height: 35%;' placeholder='Incolla il Log' required></textarea><br>
                    <button type='submit' name='comando' value='insert_clone' style='height: auto;'>Salva</button>
                    </center>
                </form>
        </div>";
    }



    /**
     * Visualizza la pagina di modifica di un dato clone
     * @param int $id
     * @param string $tipoacq
     * @param string $altro
     * @param string $stracq: strumento acquisizione
     * @param string $md5
     * @param string $sha1
     * @param string $sha256
     * @param string $log
     */
    public function HTML_edit_clone($id, $tipoacq, $altro, $stracq, $md5, $sha1, $sha256, $log)
    {
        echo"
        <div class='container'><br>";
            if(isset($_SESSION["post_evi_id"]))
            {
                if($_SESSION['cli_type'] == 'P'){
                    echo"
                    <form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='view_evidence' style='position: absolute; left: 0%; border: none;' title='Torna ad Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_procure' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                    </form>";
                }
                if($_SESSION['cli_type'] == 'T'){
                    echo"
                    <form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='view_evidence' style='position: absolute; left: 0%; border: none;' title='Torna ad Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_tribunali' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                    </form>";
                }
                if($_SESSION['cli_type'] == 'C'){
                    echo"
                    <form action='index.php' method='post' style='display: inline;'>
                        <button name='comando' value='view_evidence' style='position: absolute; left: 0%; border: none;' title='Torna ad Evidence'><i class='fa fa-chevron-circle-left fa-2x' aria-hidden='true'></i></button>
                        <button name='comando' value='menu_ctp' style='position: absolute; left: 6%; border: none;' title='Torna al menu'><i class='fa fa-home fa-2x' aria-hidden='true'></i></button>
                    </form>";
                }
            }
            echo"
            <br><br>
            <center>
                <img src='font/icon/fisica.png' height='35'>
                <img src='font/icon/logica.png' height='35'>
                <img src='font/icon/filesystem.png' height='35'>
                <h6 class='docs-header'>MODIFICA CLONE</h6>
            </center>
                <!-- QUESTO SCRIPT ABILITA E DISABILITA IL CAMPO LIBERO PER LE NOTE SU ALTRA ACQUISIZIONE -->
            <script>
                function changeTextBoxState(dropDown) {
                    if(dropDown.value == 'Altro')
                    {
                        $('#clo_altro').prop('disabled', false);
                    }
                    else
                    {
                    $('#clo_altro').prop('disabled', true);
                    }
                }
            </script>
            <center>
                <form action='index.php' method='post' enctype=\"multipart/form-data\">
                    <input type='hidden' class='form-control' id='clo_id' name='clo_id' style='width:70%' value=$id><br>
                        <select required name='clo_tipoacq' class='form-control' onChange='changeTextBoxState(this)' style='width: 50%;'>
                            <option value='$tipoacq'>$tipoacq</option>
                            <option value='Fisica'>Fisica</option>
                            <option value='File System'>File System</option>
                            <option value='Logica'>Logica</option>
                            <option value='APK Downgrade'>APK Downgrade</option>
                            <option value='Altro'>Altro</option>
                        </select><br>
                        <input type='text' class='form-control' id='clo_altro' name='clo_altro' style='width:50%' value='$altro' placeholder='Note Altra Acqusizione' disabled><br>
                        <input type='text' class='form-control' id='clo_stracq' name='clo_stracq' style='width:50%' value='$stracq' placeholder='Strumento Acqusizione'><br>
                        <input type='text' class='form-control' pattern='.{32,32}' id='clo_md5' name='clo_md5' style='width:80%' value='$md5' placeholder='Md5 (32 caratteri)'><br>
                        <input type='text' class='form-control' pattern='.{40,40}' id='clo_sha1' name='clo_sha1' style='width:80%' value='$sha1' placeholder='Sha1 (40 caratteri)'><br>
                        <input type='text' class='form-control' pattern='.{64,64}' id='clo_sha256' name='clo_sha256' style='width:80%' value='$sha256' placeholder='Sha256 (64 caratteri)'><br>
                        <textarea id='clo_log' name='clo_log' style='width: 100%; height: 35%;' placeholder='Incolla il Log'>$log</textarea><br>
                        <button type='submit' name='comando' value='update_clone' color='black' style='height: auto;'>Salva</button>
                </form>
            </center>
        </div>";
    }

}
