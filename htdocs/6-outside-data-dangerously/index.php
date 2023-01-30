<?php // http://127.0.0.1:8080/5-joining-tables/ 
?>

<?php

require 'db/DatabaseHelper.php';

$config = require 'db/config.php';

$db_helper = new DatabaseHelper($config);


// ⚠️ hint: try your queries out FIRST in CLI or in your GUI tool
// ⚠️ hint: use heredoc strings
$ch_type_id = $_GET['type'];
$query = <<<QUERY
    SELECT ch.name as cheese, cl.name as type
    FROM cheese ch inner join classification cl 
    ON ch.classification_id = cl.id
    WHERE cl.id = $ch_type_id
QUERY;

// tru http://127.0.0.1:8080/6-outside-data-dangerously/?type=1
// 💀 try http://127.0.0.1:8080/6-outside-data-dangerously/?type=1%20or%201=1
// 💀💀💀 try http://127.0.0.1:8080/6-outside-data-dangerously/?type=1;%20drop%20table%20cheese

die(var_dump($query));

$results = $db_helper->run($query);

$db_helper->close_connection();

require 'views/index.view.php';
