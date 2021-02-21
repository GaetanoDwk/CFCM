<?php

/**
 * Class ModelGeneric
 * La classe è pensata per gestire operazioni generiche che possono essere effettuate in ogni punto del gestionale.
 */
class ModelGeneric
{
    /**
     * Controlla che non ci siano apici o virgolette prima di inserire un host / evidence
     * @param $etichetta
     * @param $modello
     * @param $seriale
     * @return int
     */
    /*public function check_if_apice_virgolette($etichetta, $modello, $seriale, $password, $dimensione)
    {
        $eti_res1 = substr_count($etichetta, "'");
        $eti_res2 = substr_count($etichetta, '"');
        $mod_res1 = substr_count($modello, "'");
        $mod_res2 = substr_count($modello, '"');
        $ser_res1 = substr_count($seriale, "'");
        $ser_res2 = substr_count($seriale, "'");
        if($eti_res1 == 0 && $eti_res2 == 0 && $mod_res1 == 0 && $mod_res2 == 0 && $ser_res1 == 0 && $ser_res2 == 0)
        {
            // SE result = 0 allora tutto OK
            $result = 0;
            return $result;
        }
        else
        {
            // Se result = 1 significa che è stato trovato qualche apice o virgoletta
            $result = 1;
            return $result;
        }
    }*/

    public function check_if_apice_virgolette($stringa)
    {
        $res = substr_count($stringa, "'");
        $res1 = substr_count($stringa, '"');
        if(($res == 0) && ($res1 == 0))
        {
            return 0;
        }
        else{
            return 1;
        }
    }

    public function sum($tot, $num)
    {
        $tot = $tot + $num;
        return $tot;
    }


    /**
     * Rimuove una directory
     * @param string $path: directory da rimuovere
     */
    public function remove_dir($path) {
            $files = glob($path . '/*');
            foreach ($files as $file) {
                is_dir($file) ? $this->remove_dir($file) : unlink($file);
            }
            rmdir($path);
            return;
        }
}
