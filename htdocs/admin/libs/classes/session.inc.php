<?php

class session {
    function validate_user(){
        session_regenerate_id();
        $_SESSION['valid'] = 1;
    }
    
    function is_logged_in(){
        if(empty($_SESSION) || $_SESSION['valid'] != 1){
            return false;
        }else{
            return true;
        }
    }
}

?>
