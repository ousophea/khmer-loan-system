<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function start_form_model($col){ 
    echo'<div class="form-model">
        <div class="row">';
    if($col == 1){
        echo'<div class="span5">';
    }else{
        echo'<div class="span6">';
    }
}

function close_form_model(){
    echo '</div></div></div>';
}

function open_form($name){
    echo'<div id="'.$name.'">';
              //<form name="'.$name.'" class="form-horizontal bs-docs-form">';
    echo form_open('',array('name'=> $name, 'class'=>'form-horizontal bs-docs-form'));
}
function close_form(){
    echo form_close();  
             echo'</div>';
}
?>
