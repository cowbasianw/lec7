<?php // http://127.0.0.1:8080/2-db-helper-class/ 
?>

<?php

class DatabaseHelper
{

    public $connection;

    public function __construct()
    {
        $dsn = "mysql:host=127.0.0.1;port=3306;dbname=cheese_db;charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, "root", "mariadb");
        } catch (PDOException $e) {
            die("DB problem. Belly up I go."); // ⚠️ you'd likely log this and alert a tech in real life
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

$db_helper = new DatabaseHelper();

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