/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery.noConflict();
(function($) {
    $(function() {
        // start jquery
        var uri=[
        $('[name="base_url"]').val(),
        $('[name="segment1"]').val(),
        $('[name="segment2"]').val(),
        $('[name="segment3"]').val(),
        ];
        
        
        // check all child
        $("#check_all").click(function(){
            var checked_status = this.checked;

            $(".child_check").each(function(){

                this.checked = checked_status;

            });

        });
        
        // tool edit
        $('#edit,#changepassword').click(function(){
            var checkbox = getCheckBox();
            if(checkbox==0){
                alert("Please select any item");
                return;
            }
            else if(checkbox > 1){
                alert("You can only select one item");
                return;
            }
            else if(checkbox == 1){
                var action = 'link', url = uri[0]+'users/'+this.id+'/'+getCheckBox('value');
                submits(action, url);
            }
        });
        // delete
        $('#delete').click(function(){
            var checkbox = getCheckBox(null);
            if(checkbox==0){
                alert("Please select the item(s)");
                return;
            }
            else if(checkbox > 0){
                if(confirm("Are you sure want to delete this item?")){
                    var action = 'post', url = uri[0]+'users/delete';
                    submits(action, url);
                }
                
            }
        });

        // check checkbox is checked
        function getCheckBox(val){
            var count=0,id = null;
            $(".child_check").each(function(){
                if(this.checked){
                    count++;
                    id = this.value;
                }
            });
            if(val == 'value'){
                return id;
            }
            return count;
        }
    ////////////////

    });
})(jQuery);

/**
 * action type string 'post' or 'link'
 * url type string 'http://'
 * 
 */
function submits(action,url){
    //alert(action); return;
    if(action=='link'){
        window.location =url;
    }
    else{
        document.form_action.action=url;
        document.form_action.submit();
    }
}

