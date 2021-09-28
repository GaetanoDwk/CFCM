<?php

/**
 * Class DbManager
 * Questa classe è stata creata sfruttando il design pattern Singleton per avere
 * una classe che abbia una sola istanza fornendo un punto di accesso globale al database.
 *
 */
class DbManager{

    // variabili
    protected static $db;

    /**
     * DbManager constructor.
     * Dichiarazione privata del costruttore.
     * Crea la connessione al database allocandola nella variabile $db.
     *
     */
    private function __construct() {

        try {
            // assign PDO object to db variable
            //self::$db = new PDO( 'mysql:host=localhost;dbname=cfcm', 'service', '8926e0a3a69ffaa31509f40a841025cf' );
            self::$db = new PDO( 'mysql:host=localhost;dbname=cfcm', 'admin', 'passw0rd' );
        	self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch (PDOException $e) {
            //Output error - would normally log this to error file rather than output to user.
            echo "Connection Error: " . $e->getMessage();
        }

    }



    /**
     * Questa funzione serve a farsi restituire la connessione dall'esterno.
     * E' accessibile senza istanziare la classe DbManager ma con una chiamata diretta al metodo statico.
     * Evita di creare connessioni multiple al DB.
     * Se non esiste nessuna istanza allora ne crea una "new DbManager()" altrimenti ritorna quella esistente "self::$db"
     * @return PDO
     */
    public static function getConnection() {

        if (!self::$db)
        {
            new DbManager();
        }
        return self::$db;
    }
}

?>
