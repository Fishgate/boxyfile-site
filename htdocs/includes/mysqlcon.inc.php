<?php

require_once 'constants.inc.php';

$conn = mysql_connect(SERVER, USERNAME, PASSWORD) or die(mysql_error());
mysql_select_db(DB_NAME, $conn) or die(mysql_error($conn));

?>
