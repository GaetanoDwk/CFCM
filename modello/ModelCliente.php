<?php
/**
 * Created by PhpStorm.
 * User: gaetano
 * Date: 10/11/2016
 * Time: 15:05
 */
class ModelCliente
{
    /**Variabili private
     * @var int cli_id: identificativo del cliente
     * @var string cli_nome: nome del cliente
     * @var string cli_citta: nome della città
     * @var array res
     */
    private $cli_id, $cli_nome, $cli_citta, $res = array();

    /**Variabili di classe statiche
     * @var int CLI_ID: identificativo del cliente.
     * @var string CLI_NOME: nome del cliente
     * @var string CLI_CITTA: nome città del cliente
     */
    private $CLI_ID = "cli_id",
            $CLI_NOME = "cli_nome",
            $CLI_CITTA = "cli_citta";

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
        $this->res[] = array($this->CLI_ID => $cli_id, $this->CLI_NOME => $cli_nome, $this->CLI_CITTA => $cli_citta);
    }

    /**
     * ModelCliente constructor.
     * @param int $cli_id
     * @param string $cli_nome
     * @param string $cli_citta*/

    public function __construct($cli_nome = '0', $cli_citta = '0')
    {
        $this->cli_nome = $cli_nome;
        $this->cli_citta = $cli_citta;
    }

    /**
     * Seleziona tutte le procure e le ordina per nome della città
     * @return array: ritorna l'array con le procure selezionate
     */
    public function select_procure()
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT cli_id, cli_nome, cli_citta FROM cliente WHERE is_procura = 1 ORDER BY cli_citta ASC");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CLI_ID], $row[$this->CLI_NOME], $row[$this->CLI_CITTA]);

        }

        return $this->res;
    }

    /**
     * Seleziona tutte le CTP e le ordina per nome città
     * @return array: ritorna array contenente le ctp selezionate
     */
    public function select_ctp()
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT cli_id, cli_nome, cli_citta FROM cliente WHERE is_ctp = 1 ORDER BY cli_citta ASC");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CLI_ID], $row[$this->CLI_NOME], $row[$this->CLI_CITTA]);

        }

        return $this->res;
    }

    /**
     * Seleziona tutti i tribunali e li ordina per nome città
     * @return array: ritorna array contenente i tribunali selezionati
     */
    public function select_tribunali()
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT cli_id, cli_nome, cli_citta FROM cliente WHERE is_tribunale = 1 ORDER BY cli_citta ASC");
        $sql->execute();

        //______________________________________________________________________________________
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CLI_ID], $row[$this->CLI_NOME], $row[$this->CLI_CITTA]);

        }

        return $this->res;
    }


    /**
     * Seleziona una procura singola
     * @param $cli_id: id cliente è il criterio di selezione
     */
    public function select_single_procura($cli_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_id = $cli_id");
        $sql->execute();
        while ($row = $sql->fetch()) {
            $this->set_cli_id($row[$this->CLI_ID]);
            $this->set_cli_nome($row[$this->CLI_NOME]);
            $this->set_cli_citta($row[$this->CLI_CITTA]);
        }
    }

    /**
     * Seleziona una singola CTP
     * @param $cli_id: id cliente è il criterio di selezione
     */
    public function select_single_ctp($cli_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_id = $cli_id");
        $sql->execute();
        while ($row = $sql->fetch()) {
            $this->set_cli_id($row[$this->CLI_ID]);
            $this->set_cli_nome($row[$this->CLI_NOME]);
            $this->set_cli_citta($row[$this->CLI_CITTA]);
        }
    }

    /**
     * Seleziona un singolo tribunale
     * @param $cli_id: id cliente è il criterio di selezione
     */
    public function select_single_tribunale($cli_id)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_id = $cli_id");
        $sql->execute();
        while ($row = $sql->fetch()) {
            $this->set_cli_id($row[$this->CLI_ID]);
            $this->set_cli_nome($row[$this->CLI_NOME]);
            $this->set_cli_citta($row[$this->CLI_CITTA]);
        }
    }

    /**
     * Inserisce nel DB una nuova procura
     * @param $cli_nome: nome cliente
     * @param $cli_citta: nome città
     */
    public function insert_procura($cli_nome, $cli_citta)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO cliente (cli_nome, cli_citta, is_procura) VALUES (\"$cli_nome\", \"$cli_citta\", 1)");
        $sql->execute();
    }

    /**
     * Inserisce nel DB una nuova CTP
     * @param $cli_nome: nome cliente
     * @param $cli_citta: nome città
     */
    public function insert_ctp($cli_nome, $cli_citta)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO cliente (cli_nome, cli_citta, is_ctp) VALUES ('$cli_nome', '$cli_citta', 1)");
        $sql->execute();
    }

    /**
     * Inserisce nel DB un nuovo tribunale
     * @param $cli_nome: nome cliente
     * @param $cli_citta: nome città
     */
    public function insert_tribunale($cli_nome, $cli_citta)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara la query, la esegue
        $sql = $conn->prepare("INSERT INTO cliente (cli_nome, cli_citta, is_tribunale) VALUES ('$cli_nome', '$cli_citta', 1)");
        $sql->execute();
    }

    /**
     * Modifica nel DB una procura
     * @param $id: id cliente
     * @param $nome: nome cliente
     * @param $citta: nome città
     */
    public function update_procura($id, $nome, $citta)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE cliente
                               SET cli_nome = \"$nome\", cli_citta = \"$citta\"
                               WHERE cli_id = $id");
        $sql->execute();
    }

    /**
     * Modifica nel DB una ctp
     * @param $id: id cliente
     * @param $nome: nome cliente
     * @param $citta: nome città
     */
    public function update_ctp($id, $nome, $citta)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE cliente
                               SET cli_nome = '$nome', cli_citta = '$citta'
                               WHERE cli_id = '$id'");
        $sql->execute();
    }

    /**
     * Modifica nel DB un tribunale
     * @param $id: id cliente
     * @param $nome: nome cliente
     * @param $citta: nome città
     */
    public function update_tribunale($id, $nome, $citta)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE cliente
                               SET cli_nome = '$nome', cli_citta = '$citta'
                               WHERE cli_id = '$id'");
        $sql->execute();
    }

    /**
     * Elimina nel DB una procura.
     * @param $cli_id: id cliente
     */
    public function delete_procura($cli_id)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from cliente WHERE CLI_ID =". $cli_id);
        $sql->execute();
    }

    /**
     * Elimna nel DB una ctp
     * @param $cli_id: id cliente.
     */
    public function delete_ctp($cli_id)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from cliente WHERE CLI_ID =". $cli_id);
        $sql->execute();
    }

    /**
     * Elimina nel DB un tribunale
     * @param $cli_id: id cliente
     */
    public function delete_tribunale($cli_id)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from cliente WHERE CLI_ID =". $cli_id);
        $sql->execute();
    }

    /**
     * Seleziona una procura tramite nome
     * @param $txt
     */
    public function select_procura_by_name($txt)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_nome LIKE \"%$txt%\"");
        $sql->execute();
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            //$this->setRes($row[$this->CLI_ID], $row[$this->CLI_NOME], $row[$this->CLI_CITTA], $row[$this->PRO_IND], $row[$this->PRO_TEL]);
            $this->set_cli_id($row[$this->CLI_ID]);
            $this->set_cli_nome($row[$this->CLI_NOME]);
            $this->set_cli_citta($row[$this->CLI_CITTA]);
        }
    }

    /**
     * Seleziona un tribunale tramite il nome
     * @param $txt
     */
    public function select_tribunale_by_name($txt)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_nome LIKE '%$txt%'");
        $sql->execute();
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->set_cli_id($row[$this->CLI_ID]);
            $this->set_cli_nome($row[$this->CLI_NOME]);
            $this->set_cli_citta($row[$this->CLI_CITTA]);
        }
    }

    /** Seleziona una procura tramite il nome della città
     * @param $txt
     * @return array
     */
    public function select_procure_by_city($txt)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_citta = \"$txt\"");
        $sql->execute();
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CLI_ID], $row[$this->CLI_NOME], $row[$this->CLI_CITTA]);
        }
        return $this->res;
    }

    /** Seleziona un tribunale tramite il nome della città
     * @param $txt
     * @return array
     */
    public function select_tribunali_by_city($txt)
    {
        // Preleva la connessione al db
        $conn = DbManager::getConnection();
        // prepara la query, la esegue
        $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_citta = '$txt'");
        $sql->execute();
        // istanzia la classe utenti ed esegue il fetch dei dati settando tutti i suoi attributi
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CLI_ID], $row[$this->CLI_NOME], $row[$this->CLI_CITTA]);
        }
        return $this->res;
    }

}
