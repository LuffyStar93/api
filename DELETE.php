<h1>FILM DELETE</h1>

<?php

$con = new MongoDB\Driver\Manager("mongodb+srv://Max:azertyuiop@nsk-jirog.gcp.mongodb.net/test?retryWrites=true");

$delete = new MongoDB\Driver\BulkWrite();

$delete->delete(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

$con->executeBulkWrite("Cinema.Cinema.Cinema",$delete);
header("Location: index.php");
?>