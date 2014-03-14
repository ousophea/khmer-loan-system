<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!function_exists('message')){
    function alert_error($message){
        return '<div class="alert alert-error">'.$message.'</div>';
    }
}
else{
    die('Helper message already exist');
}
?>
