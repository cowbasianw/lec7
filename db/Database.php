<?php

class Database
{
    public $connection;

    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['db']};charset={$config['charset']}";
        try {
            $this->connection = new PDO($dsn, $config['username'], $config['password']);
        } catch (PDOException $e) {
            die("DB problem. Belly up I go."); // ⚠️ you'd likely log this and alert a tech in real life
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function run($query)
    {
        $statement = $this->connection->prepare($query);

        $statement->execute();

        return $statement;
    }
}
