/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery.noConflict();
(function($) {
    $(function() {
        // start jquery
        
        //var numForm = $('.form_block').length;
        if($('.form_block')){
            var setStyle='<style type="text/css">';
                            
            $('.form_block').each(function(){
                setStyle+= '#' + this.id + ' .bs-docs-form:after{content: "'+this.title+'";}';
            });
                
            setStyle+='</style>';
            $('.form_model_style').html(setStyle);
        }
        
        
//        $('#gl_code').change(function(){
//            $arr_gl_val = ($('#gl_code').val()).split(':');
//            if($arr_gl_val[1]){
//                $('#code_gl').val($arr_gl_val[0]);
//                $('#gl_description').val($arr_gl_val[1]);
//            }else{
//                alert("Don't have this GL in database..!");
//                this.focus();
//            }
//           
//
//        });

       
        
        
        
        
    /////End jquery
    /////////////
    });
})(jQuery);
