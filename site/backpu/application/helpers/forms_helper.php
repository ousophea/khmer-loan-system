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
    function get_form($array=null,$other=NULL) {

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
                if (!empty($array['attr']['upload']))
                    $html.= '<span class="error">' . $array['attr']['upload'] . '</span>';
                $name='userfile';
                break;
            case 'textarea':
                $html.= form_textarea($array['attr'],set_value($array['attr']['name']));
                $name = $array['attr']['name'];
                break;

            case 'label':
                $text = (!empty($array['attr']['text']))?$array['attr']['text']:'';
                $html.= form_label($text,'',$array['attr']);
                $name = $array['attr']['name'];
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

    /**
     * 
     * @param type $arr_content_tap
     * @param type $span
     * @example form_tab(array(array('tab'=>'Table 1','html'=>'<div>----</div>'),array(---)),1,'tab1_');
     */
    function tab_form($arr_content_tap=array(),$tab_id="tab"){
        
            $html='<div class="tabbable bordered">';
                $html.='<ul class="nav nav-tabs">';
                foreach ($arr_content_tap as $key => $val){
                    if($key==0){
                        $html.='<li class="active"><a href="#tab'.$tab_id.$key.'" data-toggle="tab">'.$val[0].'</a></li>';
                    }
                    else{
                        $html.='<li><a href="#tab'.$tab_id.$key.'" data-toggle="tab">'.$val[0].'</a></li>';
                    }
                }
                    
                    
                
                $html.='</ul>';
                $html.='<div class="tab-content">';
                    foreach ($arr_content_tap as $key => $val){
                        if($key==0){
                            $html.='<div class="tab-pane active" id="tab'.$tab_id.$key.'">';
                                $html.=$val[1];
                            $html.='</div>';
                        }
                        else{
                            $html.='<div class="tab-pane" id="tab'.$tab_id.$key.'">';
                                $html.=$val[1];
                            $html.='</div>';
                        }
                    }
                    
                        
                $html.='</div>';
            $html.='</div>';
        return $html;
    }
    function open_block($id=null,$title=null){
        return '<div id="'.$id.'" title="'.$title.'" class="form_block"><div class="bs-docs-form">';
    }
    
    function close_block(){return '</div></div>';}
    
    function open_span($num=5){
        return '<div class="span'.$num.'">';
    }
    
    function close_span(){return '</div>';};
}
?>