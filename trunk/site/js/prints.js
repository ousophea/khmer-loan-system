jQuery.noConflict();
(function($) {
    $(function() {
        // start jquery
        $('.print').click(function(){
            
            var print_css = $('[name="print_css"]').val();
            $("#"+$(this).attr('print')).printArea({
                mode: 'popup',
                popClose:false, 
                extraCss: print_css
            });
        });
    });
})(jQuery);
