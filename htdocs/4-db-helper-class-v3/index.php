<?php // http://127.0.0.1:8080/4-db-helper-class-v3/ 
?>

<?php
require 'db/DatabaseHelper.php';

$config = require 'db/config.php';

$db_helper = new DatabaseHelper($config);

$query = <<<QUERY
    SELECT ch.name AS cheese
    FROM cheese AS ch 
QUERY;

$results = $db_helper->run($query);

$db_helper->close_connection();

require 'views/index.view.php';
