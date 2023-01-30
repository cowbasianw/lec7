<?php // http://127.0.0.1:8080/1-first-attempt/ 
?>

<?php

// ⚠️ dsn = data source name
$dsn = "mysql:host=127.0.0.1;port=3306;dbname=cheese_db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, "root", "mariadb");
} catch (PDOException $e) {
    die($e->getMessage()); // ⚠️ this provides a bit too much info
}

// ⚠️ hint: try your queries out FIRST in CLI or in your GUI tool
// ⚠️ hint: use heredoc strings: https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc

// ⚠️ doesn't have to be QUERY...could be BOB, or FNORT, or ...
$query = <<<QUERY
    SELECT ch.name AS cheese
    FROM cheese AS ch 
QUERY;

$results = $pdo->query($query);

$pdo = null;

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