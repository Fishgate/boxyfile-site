<?php

session_start();

require_once 'libs/classes/session.inc.php';
require_once '../includes/mysqlcon.inc.php';

$session = new session();

if(!$session->is_logged_in()){
    die('You do not have sufficient privileges to run this script. Please click <a href="index.html">here</a> to login.');
}

/*
 * PHP code to export MySQL data to CSV
 * http://911-need-code-help.blogspot.com/2009/07/export-mysql-data-to-csv-using-php.html
 *
 * Sends the result of a MySQL query as a CSV file for download
 */

/*
 * establish database connection
 */

require_once '../includes/mysqlcon.inc.php';

/*
 * execute sql query
 */

$query = sprintf('SELECT ref, name, contact_number, email_address, delivery_address, order_summery, total, date FROM orders ORDER BY unix DESC');
$result = mysql_query($query, $conn) or die(mysql_error($conn));

/*
 * send response headers to the browser
 * following headers instruct the browser to treat the data as a csv file called export.csv
 */

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=orders_export_'.date("Y-m-d").'.csv');

/*
 * output header row (if atleast one row exists)
 */

$row = mysql_fetch_assoc($result);
if ($row) {
    echocsv(array_keys($row));
}

/*
 * output data rows (if atleast one row exists)
 */

while ($row) {
    echocsv($row);
    $row = mysql_fetch_assoc($result);
}

/*
 * echo the input array as csv data maintaining consistency with most CSV implementations
 * - uses double-quotes as enclosure when necessary
 * - uses double double-quotes to escape double-quotes 
 * - uses CRLF as a line separator
 */

function echocsv($fields)
{
    $separator = '';
    foreach ($fields as $field) {
        if (preg_match('/\\r|\\n|,|"/', $field)) {
            $field = '"' . str_replace('"', '""', $field) . '"';
        }
        echo $separator . $field;
        $separator = ',';
    }
    echo "\r\n";
}
?>