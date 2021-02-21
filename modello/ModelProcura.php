<?php

/**
 * @TODO: come ModelTribunale e ModelCtp anche ModelProcura dovrebbe essere eliminata.
 *   Ma prima di eliminarla va migrata all'interno di ModelCliente che ingloba anche le operazioni delle ex classi ModelTribunale e ModelCtp.
 * Class ModelProcura
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione degli elementi nella tabella "procura"
 */
class ModelProcura
{
    //VARIABILI DI CLASSE
    /**
     * Variabili di classe
     * @var int cli_id: identificativo cliente
     * @var string cli_nome: nome del cliente
     * @var string cli_citta: città in cui si trova il cliente
     * @var array res
     */
    private $cli_id, $cli_nome, $cli_citta, $res = array();

    /**
     * Variabili di classe statiche
     * @var string
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

    /*public function __construct($cli_id = 0, $cli_nome = '0', $cli_citta = '0')
    {
        $this->cli_id = $cli_id;
        $this->cli_nome = $cli_nome;
        $this->cli_citta = $cli_citta;
    }*/


    /**
     * Seleziona tutte le procure nel DB e le ordina in ordine alfabetico
     * @return array
     */
    public function select_procure()
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT cli_id, cli_nome, cli_citta FROM cliente WHERE is_procura = 1 ORDER BY cli_citta ASC");
        $sql->execute();

        //SETTA L'ARRAY CHE VERRA RESTITUITO
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->CLI_ID], $row[$this->CLI_NOME], $row[$this->CLI_CITTA]);

        }

        return $this->res;
    }


    /**
     * Seleziona una singola procura e setta le variabili di classe
     * @param $cli_id
     */
    public function select_single_procura($cli_id)
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
     * Seleziona le procure di una città
     * @param $txt: criterio di selezione
     * @return array
     */
    public function select_procure_by_city($txt)
    {
        $arr = array();

        if(!empty($txt))
        {
            //CONNESSIONE AL DB
            $conn = DbManager::getConnection();

            //PREPARA QUERY E LA ESEGUE
            $sql = $conn->prepare("SELECT * FROM cliente WHERE cli_citta LIKE '%$txt%' AND is_procura=1");
            $sql->execute();

            while ($row = $sql->fetch()) {
                $arr[] = array(
                    'cli_id' => $row['cli_id'],
                    'cli_nome' => $row['cli_nome'],
                    'cli_citta' => $row['cli_citta']
                );
            }
        }

        return $arr;
    }


    /**
     * Inserisce una nuova procura nel DB
     * @param $cli_nome
     * @param $cli_citta
     */
    public function insert_procura($cli_nome, $cli_citta)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA QUERY E LA ESEGUE
        $sql = $conn->prepare("INSERT INTO cliente (cli_nome, cli_citta, is_procura) VALUES (\"$cli_nome\", \"$cli_citta\", 1)");
        $sql->execute();

    }


    /**
     * Aggiorna le info di una data procura nel DB
     * @param $id
     * @param $nome
     * @param $citta
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
     * Elimina le info di una data procura
     * @param $cli_id
     */
    public function delete_procura($cli_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from cliente WHERE CLI_ID =". $cli_id);
        $sql->execute();
    }
}
