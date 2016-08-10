/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery.noConflict();
(function($) {
    $(function() {
        // start jquery
        
        
        $('#btn_search_cid').click(function(){
			var this_url = $(this).attr('href');
                        alert(this_url);
//			
//			var get_prompt = prompt('Gallery Name','');
//			if(get_prompt == null || get_prompt == '') return false;
//			var form_data = {
//				gal_id : '<?php echo $arr_value['gallery_gal_id']; ?>',
//				gal_name : get_prompt
//			};
		    $.ajax({ 
				url: this_url,
	            type: 'POST',
	            async : false,
	            data: form_data,
	            success: function(output_string){
	            	jq('#c_info').html(output_string);
                }
			});
			return false;
		});
        
        
        
    /////End jquery
    /////////////
    });
})(jQuery);
