<?php

//https://stackoverflow.com/questions/1683794/retrieving-multiple-result-sets-with-stored-procedure-in-php-mysqli

require_once '../api/config/database.php'; 

$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare('CALL Prueba1()');
$stmt->execute();
// read first result set
while ($row = $stmt->fetch()) {
    printf("%d\n", $row[0]);
}
$stmt->nextRowset();
// read second result set
while ($row = $stmt->fetch()) {
    printf("%d\n", $row[0]);
}


?>