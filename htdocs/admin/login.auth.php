<?php

session_start();

require_once 'libs/classes/session.inc.php';
require_once '../includes/mysqlcon.inc.php';

$query = "SELECT * FROM users WHERE username = '".$_POST['user']."'";
$result = mysql_query($query) or die(mysql_error());

if(mysql_num_rows($result) < 1){
    echo 'The username "'.$_POST['user'].'" does not exist. Please try again.';
}else{
    $user_data = mysql_fetch_array($result, MYSQL_ASSOC);
    
    $pass = $user_data['salt'] . md5($_POST['pass']);
    
    if($pass != $user_data['hash']){
        echo 'The password entered is incorrect. Please try again';
        
    }else{
        $session = new session();
        $session->validate_user();
        
        echo 'true';
    }
}

?>