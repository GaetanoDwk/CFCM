<?php

/**
 * Class ModelUtente
 * La classe gestisce le operazioni di inserimento, modifica, eliminazione degli elementi nella tabella "utente"
 */
class ModelUtente {

    /**
     * Variabili di classe
     * @var int
     */
    private $id, $username, $password, $nome, $cognome, $isadmin, $res = array();


    /**
     * Variabili di classe statiche
     * @var string
     */
    private $UTE_ID = "ute_id",
            $UTE_USERNAME = "ute_username",
            $UTE_PASSWORD = "ute_password",
            $UTE_NOME = "ute_nome",
            $UTE_COGNOME = "ute_cognome",
            $UTE_ISADMIN = "ute_isadmin";

    //_______
    //SETTERS
    //-------
    public function setId($value){
        $this->id = $value;
    }

    public function setUsername($value){
        $this->username = $value;
    }

    public function setPassword($value){
        $this->password = $value;
    }

    public function setNome($value){
        $this->nome = $value;
    }

    public function setCognome($value){
        $this->cognome = $value;
    }

    public function setIsAdmin($value){
        $this->isadmin = $value;
    }

    public function setLtsLogin($value){
        $this->ltslogin = $value;
    }


    //_______
    //GETTERS
    //-------
    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCognome(){
        return $this->cognome;
    }

    public function getIsAdmin(){
        return $this->isadmin;
    }


    //____________________________________________________________________________SETTERS E GETTERS DELL'ARRAY RES

    public function setRes($uteId, $uteUsername, $utePassword, $uteNome, $uteCognome, $uteIsAdmin)
    {
        $this->res[] = array($this->UTE_ID => $uteId, $this->UTE_USERNAME => $uteUsername, $this->UTE_PASSWORD => $utePassword, $this->UTE_NOME => $uteNome, $this->UTE_COGNOME => $uteCognome, $this->UTE_ISADMIN => $uteIsAdmin);
    }

    public function getRes()
    {
        return $this->res;
    }

    public function getResUteId()
    {
        foreach ($this->res as $row) {
            return $row[$this->UTE_ID];
        }
    }

    public function getResUteUsername()
    {
        foreach ($this->res as $row) {
            return $row[$this->UTE_USERNAME];
        }
    }


    public function getResUtePassword()
    {
        foreach ($this->res as $row) {
            return $row[$this->UTE_PASSWORD];
        }
    }

    public function getResUteNome()
    {
        foreach ($this->res as $row) {
            return $row[$this->UTE_NOME];
        }
    }

    public function getResUteCognome()
    {
        foreach ($this->res as $row) {
            return $row[$this->UTE_COGNOME];
        }
    }

    public function getResUteIsAdmin()
    {
        foreach ($this->res as $row) {
            return $row[$this->UTE_ISADMIN];
        }
    }
    //----------------------------------------------------------------------





   /* //__________________________________________________________________________________________________
    //POICHE' NON ESISTE L'OVERLOADING DEI COSTRUTTORI IN PHP, METTO I PARAMETRI = NULL DI DEFAULT COSI'
    //IN UN UNICO COSTRUTTORE HO LA POSSIBILITA' SIA DI PASSARGLIELI TUTTI SIA DI NON PASSARGLI NESSUNO
    //--------------------------------------------------------------------------------------------------
    public function __construct($id = 0, $username = '0', $password = '0', $nome = '0', $cognome = '0', $isadmin = 0)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->$isadmin = $isadmin;
    }*/


    /**
     * Seleziona i campi di un utente che si sta loggando per farne poi le opportune verifiche
     * @param $username
     * @param $password
     * @return int
     */
    public function checkLogin($username, $password){
        //_____________________________
        // Preleva la connessione al db
        //-----------------------------
        $conn = DbManager::getConnection();

        //PREPARA LA QUERY, LA ESEGUE E CONTA LE RIGHE RESTITUITE
        $sql = $conn->prepare("SELECT * FROM utenti WHERE ute_username = '" . $username . "' AND ute_password = '" . $password . "'");
        $sql->execute();
        $count = $sql->rowCount();

        //SETTA L'ARRAY
        while($row = $sql->fetch())
        {
            $this->setRes($row['ute_id'], $row['ute_username'], $row['ute_password'], $row['ute_nome'], $row['ute_cognome'], $row['ute_isadmin']);

        }

        //SE RITORNA 1 è UN ADMINISTRATOR
        if ($count == 1 AND $this->getResUteIsAdmin() == 1) {
            $_SESSION['username'] = $this->getResUteUsername();
            $_SESSION['is_admin'] = $this->getResUteIsAdmin();
            return 1;
        }
        //SE RITORNA 2 è UN UTENTE NORMALE
        elseif($count == 1 AND $this->getResUteIsAdmin() == 0){
            $_SESSION['username'] = $this->getResUteUsername();
            $_SESSION['is_admin'] = $this->getResUteIsAdmin();
            $this->putThisUserIntoThisSession($this->getResUteId());
            return 2;
        }
        //SE RITORNA 0 NON è AUTORIZZATO
        else {
            return 0;
        }
    }


    /**
     * Modifica il campo password di un dato utente
     * @param $username
     * @param $new_password
     * @return int
     */
    public function update_password($username, $new_password){
        $conn = DbManager::getConnection();
        try{
            $sql = $conn->prepare("UPDATE utenti SET ute_password='$new_password' WHERE ute_username = '$username'");
            $sql->execute();
            return 0;
        }
        catch (Exception $e)  {
            echo "ERRORE" . $e;
            return 1;
        }
    }


    /**
     * Seleziona tutti gli utenti
     * @return array
     */
    public function select_all_utenti(){
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();

        //PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM utenti");
        $sql->execute();
        $res = array();

        //SETTA L'ARRAY
        while($row = $sql->fetch()){
            $res[] = array($this->UTE_ID => $row[$this->UTE_ID], $this->UTE_USERNAME => $row[$this->UTE_USERNAME], $this->UTE_NOME => $row[$this->UTE_NOME], $this->UTE_COGNOME => $row[$this->UTE_COGNOME], $this->UTE_ISADMIN => $row[$this->UTE_ISADMIN]);
        }
        return $res;
    }


    /**
     * Seleziona un unico utente
     * @param $id
     */
    public function select_one_user($id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("SELECT * FROM utenti WHERE ute_id = '$id'");
        $sql->execute();
        while($row = $sql->fetch()){
            $this->setId($row['ute_id']);
            $this->setNome($row['ute_nome']);
            $this->setCognome($row['ute_cognome']);
            $this->setUsername($row['ute_username']);
            $this->setIsAdmin($row['ute_isadmin']);
        }
    }


    /**
     * La funzione setta nel file di sessione le info dell'utente che si è loggato.
     * @param $id_utente_now
     */
    public function putThisUserIntoThisSession($id_utente_now){
        //CONNESSIONE AL DB
        $conn = DbManager::getConnection();
        //PREPARA LA QUERY E LA ESEGUE
        $sql = $conn->prepare("SELECT * FROM utenti WHERE ute_id  = '" . $id_utente_now . "'");
        $sql->execute();
        //SETTA LA SESSIONE
        while($row = $sql->fetch()){
            $_SESSION['ute_id_now'] = $row['ute_id'];
            $_SESSION['ute_nome_now'] = $row['ute_nome'];
            $_SESSION['ute_cognome_now'] = $row['ute_cognome'];
        }
    }


    /**
     * la funzione inserisce un nuovo utente nel DB
     * @param string $nome
     * @param string $cognome
     * @param string $user
     * @param string $pass
     * @param int $isadmin: 1=admin | 0=user
     */
    public function insert_UTENTE($nome, $cognome, $user, $pass, $isadmin){
        $conn = DbManager::getConnection();
        try{
            $sql = $conn->prepare("INSERT INTO utenti (ute_username, ute_password, ute_nome, ute_cognome, ute_isadmin) VALUES ('$user', '$pass', '$nome', '$cognome', '$isadmin')");
            $sql->execute();
        }
        catch (Exception $e)  {
            echo "ERRORE" . $e;
        }
    }


    /**
     * La funzione aggiorna le info nel DB di un utente
     * @param int $id
     * @param string $nome
     * @param string $cognome
     * @param string $user
     * @param string $pass
     * @param int $isadmin: 1=admin | 0=user
     */
    public function update_utente($id, $nome, $cognome, $user, $pass, $isadmin){
        $conn = DbManager::getConnection();
        try{
            $sql = $conn->prepare("UPDATE utenti SET ute_nome='$nome', ute_cognome='$cognome', ute_username='$user', ute_password='$pass', ute_isadmin='$isadmin'  WHERE ute_id = '$id'");
            $sql->execute();
        }
        catch (Exception $e)  {
            echo "ERRORE" . $e;
        }
    }


    /**
     * Elimina un utente dal DB
     * @param $ute_id
     */
    public function delete_utente($ute_id){
        $conn = DbManager::getConnection();
        $sql = $conn->prepare("DELETE FROM utenti WHERE ute_id = $ute_id");
        $sql->execute();
    }

}
