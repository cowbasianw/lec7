<?php // http://127.0.0.1:8080/3-db-helper-class-v2/ 
?>

<?php

class DatabaseHelper
{

    public $connection;

    public function __construct($config)
    {
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '3306';
        $dbname = $config['dbname'];
        $charset = $config['charset'] ?? 'utf8mb4';
        $username = $config['username'];
        $password = $config['password'];

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            die("DB problem. Belly up I go.");
        }
    }

    public function close_connection()
    {
        echo "killin' that connection</br>";
        $this->connection = null;
    }

    public function run($sql)
    {
        $statement = $this->connection->prepare($sql);

        $statement->execute();

        return $statement;
    }
}

?>


<?php

$config = [
    "username" => "root",
    "password" => "mariadb",
    "dbname" => "cheese_db"
];

$db_helper = new DatabaseHelper($config);

$query = <<<QUERY
    SELECT ch.name AS cheese
    FROM cheese AS ch 
QUERY;

$results = $db_helper->run($query);

$db_helper->close_connection();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cheese</title>
</head>

<body>
    <ul>
        <?php foreach ($results as $result) : ?>
            <li><?= $result['cheese'] ?> </li>
        <?php endforeach ?>
    </ul>
</body>

</html>