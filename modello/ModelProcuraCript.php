<?php

/**
 * CLass ModelProcuraCript
 * Questa classe non è in utilizzo attualmente ma la lascio come da modello per eventualmente convertire anche le altre.
 * La classe concettualmente è uguale a ModelProcura con la differenza che cifra i nuovi INSERT nel DB e decifra
 * gli elementi presi tramite le SELECT
 */
class ModelProcuraCript
{
    //_________________________________
    // Variabili private da valorizzare.
    private $cli_id, $cli_nome, $cli_citta;
    private $res = array();


    //_________________________________________
    // Variabili statiche da usare per le query
    private $PRO_ID = "cli_id";
    private $PRO_NOME = "cli_nome";
    private $PRO_CITTA = "cli_citta";



    //SETTERS
    public function set_cli_id($value)
    {
        $this->cli_id = $value;
    }

    public function set_cli_nome($value)
    {
        $this->cli_nome = $value;
    }

    public function set_cli_citta($value)
    {
        $this->cli_citta = $value;
    }


    //GETTERS
    public function get_cli_id()
    {
        return $this->cli_id;
    }

    public function get_cli_nome()
    {
        return $this->cli_nome;
    }

    public function get_cli_citta()
    {
        return $this->cli_citta;
    }

    public function setRes($cli_id, $cli_nome, $cli_citta)
    {
        $this->res[] = array($this->PRO_ID => $cli_id, $this->PRO_NOME => $cli_nome, $this->PRO_CITTA => $cli_citta);
    }

    public function __construct($cli_id = 0, $cli_nome = '0', $cli_citta = '0')
    {
        $this->cli_id = $cli_id;
        $this->cli_nome = $cli_nome;
        $this->cli_citta = $cli_citta;
    }

    public function select_procure()
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT cli_id,
                                      aes_decrypt(cli_nome, 'password') AS cli_nome,
                                      aes_decrypt(cli_citta, 'password') AS cli_citta
                               FROM cliente");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->PRO_ID], $row[$this->PRO_NOME], $row[$this->PRO_CITTA]);

        }

        return $this->res;
    }



    public function select_single_procura($cli_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_id = '$cli_id'");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            //$this->setRes($row[$this->PRO_ID], $row[$this->PRO_NOME], $row[$this->PRO_CITTA], $row[$this->PRO_IND], $row[$this->PRO_TEL]);
            $this->set_cli_id($row[$this->PRO_ID]);
            $this->set_cli_nome($row[$this->PRO_NOME]);
            $this->set_cli_citta($row[$this->PRO_CITTA]);

        }
    }



    public function insert_procura($cli_nome, $cli_citta)
    {
        //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO procura (cli_nome, cli_citta)
                               VALUES ((aes_encrypt('$cli_nome', 'password')),
                                      (aes_encrypt('$cli_citta', 'password')))");
        $sql->execute();

    }

    public function delete_procura($cli_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from procura WHERE PRO_ID =". $cli_id);
        $sql->execute();
    }
}
