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
        
        
        $('#gl_code').change(function(){
            
            $('#gl_description').html($('#gl_code').val());
        });
        
        
        
        
    /////End jquery
    /////////////
    });
})(jQuery);
