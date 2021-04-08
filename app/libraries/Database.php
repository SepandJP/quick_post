<?php
class Database
{
    /**
     * DataBase Descriptions
     * Use for connect with DataBase
     */
    private $hostName = DB_HOST;
    private $userName = DB_USER;
    private $password = DB_PASS;
    private $dataBseName = DB_NAME;


    /**
     * @var PDO DataBase Handler
     * Used for prepare PDO commands
     */
    private $dataBaseHandler;
    /**
     * @var PDO
     *
     */
    private $statement;
    /**
     * @var PDOException
     * Get and show errors
     */
    private $error;

    // enf of properties

    public function __construct()
    {
        /**
         * Set DSN
         * for connect to DataBase
        */
        $dsn = 'mysql:host=' . $this->hostName . ';dbname=' . $this->dataBseName . ';';

        /**
         * Set attribute on the database handle.
         *
         * Use persistent connections
         * Error reporting => Throw exceptions
         */
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        /**
         * Instance of PDO
         * Connected to database
         *
         * If get any error, displays it
         */
        try {
            $this->dataBaseHandler = new PDO($dsn, $this->userName, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}