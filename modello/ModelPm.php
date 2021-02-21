<?php

/**
 * Class ModelPm
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione dei PM (tabella "pm")
 */
class ModelPm {


    /**
     * Variabili di classe
     * @var int $pm_id
     * @var string $pm_titolo
     * @var string $pm_nome
     * @var string $pm_cognome
     * @var int $ex_id_cli: chiave esterna relativa all'id cliente (tabella "cliente")
     * @var array $res
     */
    private $pm_id, $pm_titolo, $pm_nome, $pm_cognome, $ex_id_cli, $res = array();

    /**
     * Variabili statiche di classe
     * @var int $PM_ID
     * @var string $PM_TIT
     * @var string $PM_NOME
     * @var string $PM_COGNOME
     * @var int $EX_ID_PRO: chiave esterna relativa all'id cliente (tabella "cliente")
     */
    private $PM_ID = "pm_id",
            $PM_TIT = "pm_titolo",
            $PM_NOME = "pm_nome",
            $PM_COGNOME = "pm_cognome",
            $EX_ID_PRO = "ex_id_cli";



    //SETTERS
    public function set_pm_id($value)
    {
        $this->pm_id = $value;
    }

    public function set_pm_titolo($value)
    {
        $this->pm_titolo = $value;
    }

    public function set_pm_nome($value)
    {
        $this->pm_nome = $value;
    }

    public function set_pm_cognome($value)
    {
        $this->pm_cognome = $value;
    }

    public function set_ex_id_cli($value)
    {
        $this->ex_id_cli = $value;
    }


    //GETTERS
    public function get_pm_id()
    {
        return $this->pm_id;
    }

    public function get_pm_titolo()
    {
        return $this->pm_titolo;
    }

    public function get_pm_nome()
    {
        return $this->pm_nome;
    }

    public function get_pm_cognome()
    {
        return $this->pm_cognome;
    }

    public function get_ex_id_cli()
    {
        return $this->ex_id_cli;
    }

    public function setRes($pm_id, $pm_nome, $pm_cognome, $ex_id_cli)
    {
        $this->res[] = array($this->PM_ID => $pm_id, $this->PM_NOME => $pm_nome, $this->PM_COGNOME => $pm_cognome, $this->EX_ID_PRO => $ex_id_cli);
    }

    /*public function __construct($pm_id = 0, $pm_nome = '0', $pm_cognome = '0', $ex_id_cli = 0)
    {
        $this->pm_id = $pm_id;
        $this->pm_nome = $pm_nome;
        $this->pm_cognome = $pm_cognome;
        $this->ex_id_cli = $ex_id_cli;
    }*/


    /**
     * Seleziona tutti i PM
     * @return array
     */
    public function select_all_pm()
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM pm ORDER BY pm_cognome");
        $sql->execute();

        //VALORIZZA L'ARRAY DA RESTITUIRE
        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->PM_ID], $row[$this->PM_NOME], $row[$this->PM_COGNOME], $row[$this->EX_ID_PRO]);
        }

        return $this->res;
    }


    /**
     * Seleziona un singolo PM
     * @param $pm_id: criterio di ricerca
     */
    public function select_single_pm($pm_id)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM pm WHERE pm_id = '$pm_id'");
        $sql->execute();

        //VALORIZZA LE VARIABILI DI CLASSE
        while ($row = $sql->fetch()) {

            $this->set_pm_id($row[$this->PM_ID]);
            $this->set_pm_titolo($row[$this->PM_TIT]);
            $this->set_pm_nome($row[$this->PM_NOME]);
            $this->set_pm_cognome($row[$this->PM_COGNOME]);
            $this->set_ex_id_cli($row[$this->EX_ID_PRO]);
        }
    }


    /**
     * Conteggia i PM appartenenti ad un cliente (procura/tribunale)
     * @param $cli_id
     * @return int
     */
    public function count_pm_of_cliente($cli_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM pm WHERE ex_id_cli = '$cli_id'");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }


    /**
     * Seleziona tutti i PM di un dato cliente (procura/tribunale)
     * @param $cli_id
     * @return array
     */
    public function select_pm_of_cliente($cli_id){
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM pm WHERE ex_id_cli = " . $cli_id . " ORDER BY pm_cognome");
        $sql->execute();

        while ($row = $sql->fetch()) {
            $this->setRes($row[$this->PM_ID], $row[$this->PM_NOME], $row[$this->PM_COGNOME], $row[$this->EX_ID_PRO]);
        }

        return $this->res;
    }


    /**
     * Conteggia eventuali duplicati al momento
     * @param $IdCli
     * @param $nome
     * @param $cognome
     * @return int
     */
    public function count_pm_of_cliente_duplicates($IdCli, $nome, $cognome)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM pm LEFT OUTER JOIN cliente ON cliente.cli_id = pm.ex_id_cli
                                                      WHERE cli_id = $IdCli AND pm_nome = \"$nome\" AND pm_cognome = \"$cognome\"");
        $sql->execute();
        $count = $sql->rowCount();
        return $count;
    }


    /**
     * Inserisce un nuovo PM nel DB
     * @param $pm_titolo
     * @param $pm_nome
     * @param $pm_cognome
     * @param $ex_id_cli
     */
    public function insert_pm($pm_titolo, $pm_nome, $pm_cognome, $ex_id_cli)
    {
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA QUERY E LA ESEGUE
        $sql = $conn->prepare("INSERT INTO pm (pm_titolo, pm_nome, pm_cognome, ex_id_cli) VALUES (\"$pm_titolo\", \"$pm_nome\", \"$pm_cognome\", $ex_id_cli)");
        $sql->execute();

    }


    /**
     * Aggiorna nel DB le info di un dato PM
     * @param $id
     * @param $titolo
     * @param $nome
     * @param $cognome
     */
    public function pm_update($id, $titolo, $nome, $cognome)
    {
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("UPDATE pm SET pm_titolo = \"$titolo\",
                                             pm_nome = \"$nome\",
                                             pm_cognome = \"$cognome\"
                               WHERE pm_id = $id");
        $sql->execute();
    }


    /**
     * Seleziona un PM tramite il cognome. E' utilizzata nella funzione di ricerca dei PM.
     * @param $txt
     * @return array
     */
    public function select_pm_by_cognome($txt)
    {
        $arr = array();
        //CONNESSIONE AL DB
            $conn = DbManager::getConnection();

            //PREPARA LA QUERY E LA ESEGUE
            $sql = $conn->prepare("SELECT * FROM pm WHERE pm_cognome = '$txt'");
            $sql->execute();

            //VALORIZZA L'ARRAY CHE SARA' RESTITUITO
            while ($row = $sql->fetch()) {
                $arr[] = array(
                    'pm_id' => $row['pm_id'],
                    'pm_nome' => $row['pm_nome'],
                    'pm_cognome' => $row['pm_cognome']);


            return $arr;
        }


    }


    /**
     * Elimina un PM dal DB
     * @param $pm_id
     */
    public function delete_pm($pm_id)
    {   //_____________________________
        // Preleva la connessione al db
        $conn = DbManager::getConnection();

        //_____________________________
        // prepara il delete e lo esegue
        $sql = $conn->prepare("DELETE from pm WHERE pm_id =". $pm_id);
        $sql->execute();
    }
}
