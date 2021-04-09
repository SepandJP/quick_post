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
     * @var PDOStatement
     * For bind param
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

    /**
     * Prepare statement with query
     *
     * @param string $sql MySQL query
     */
    public function query($sql)
    {
        $this->statement = $this->dataBaseHandler->prepare($sql);

    }

    /**
     * For binding values of prepare statements
     *
     * @param string $param named parameters in prepared statements of MySql query
     * @param int | bool | string $value values of named parameters
     * @param int $type Predefined Constants of data types in PDO
     */
    public function bind($param, $value, $type = null)
    {
        // Define type
        if (is_null($type))
        {
            switch (true)
            {
                case is_int($type):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($type):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($type):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    /**
     * Execute the prepare statement
     */
    public function executeQuery()
    {
        $this->statement->execute();
    }

    /**
     * Get result set as array of objects
     *
     * @return array return as an array of objects
     */
    public function getAllResult()
    {
        $this->executeQuery();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get single record as object
     *
     * @return mixed
     */
    public function getSingleResult()
    {
        $this->executeQuery();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get row count of result
     *
     * @return int
     */
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}