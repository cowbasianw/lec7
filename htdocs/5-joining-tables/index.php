<?php // http://127.0.0.1:8080/5-joining-tables/ 
?>

<?php

require 'db/DatabaseHelper.php';

$config = require 'db/config.php';

$db_helper = new DatabaseHelper($config);


// ⚠️ hint: try your queries out FIRST in CLI or in your GUI tool
// ⚠️ hint: use heredoc strings
$query = <<<QUERY
    SELECT ch.name as cheese, cl.name as type
    FROM cheese ch inner join classification cl 
    ON ch.classification_id = cl.id
QUERY;

$results = $db_helper->run($query);

$db_helper->close_connection();

require 'views/index.view.php';
