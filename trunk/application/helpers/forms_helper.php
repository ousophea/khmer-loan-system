<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$CI = &get_instance();
$CI->load->helper('form');
if (!function_exists('forms')) {

    function legend($text){
        return '<legend>'.$text.'</legend>';
    }
    
    /**
     * 
     * @param type $array
     * @param type $other
     * @return string
     */
    function get_form($array,$other=NULL) {

        if(!empty($array['attr']['name'])) $array['attr']['id'] = $array['attr']['name'];
        $html = '<div class="control-group">';
        
        $html.= form_label($array['label'],$array['attr']['name'],array('class'=>'control-label'));
        $html.= (!empty($array['required'])) ? '<span class="required"> * </span>' : '';
        
        $html.= '<div class="controls">';

        switch ($array['type']) {
            case 'text':
                $html.= form_input($array['attr'],set_value($array['attr']['name']));
                $name = $array['attr']['name'];
                break;
            case 'password':
                $html.= form_password($array,set_value($array['attr']['name']));
                $name = $array['attr']['name'];
                break;
            case 'select':
                $html.= form_dropdown($array['attr']['name'], $array['attr']['option'], set_value($array['attr']['name']));
                $name = $array['attr']['name'];
                break;
            case 'file':
                $html.= form_upload($array['attr']['name']);
                if ($array['attr']['upload'] == 1)
                    $html.= '<span class="error">' . $this->upload->display_errors() . '</span>';
                //$name='userfile';
                break;
            case 'textarea':
                $html.= form_textarea($array['attr'],set_value($array['attr']['name']));
                $name = $array['attr']['name'];
                break;

            case 'label':
                $html.= form_label($array['attr']['text'],'',$array['attr']);
                break;

            default:
                $name = 'Missing or incorrect type of input';
                break;
        }
        $html.= ($other!==NULL)?$other:'';
        $html.= (!empty($array['validated'])) ? '<span class="error">' . form_error($name) . '</span>' : '';
        
        $html.= '</div></div>';
        return $html;
    }

}
?>