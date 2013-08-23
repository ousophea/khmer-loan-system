//You need an anonymous function to wrap around your function to avoid conflict
(function($) {
     
        //Attach this new method to jQuery
        $.fn.extend({ 
                 
                //This is where you write your plugin's name
                numberOnly: function(options) {
             
            //Set the default values, use comma to separate the settings, example:
    
            var defaults = {
                ghover: "#eefefe", // these variable are the parameter.It setted as default value if don't have any argument in function call.
                geven: "#eeeeee",
                godd: "#ccc"
            }
            var options = $.extend(defaults, options);
                        //Iterate over the current set of matched elements
                        return this.each(function() {
                             
                                //code to be inserted here
                var o = options;
                // get current selection id
                //Assign current element to variable, in this case is P element
                //                var obj = $(this);
                //                obj.css({"width": "100%"});
                //                //Get all th,tr in the table
                //                var items = $("tr", obj);
                //                //Change the color according to odd and even rows
                //                $("tr:even", obj).css('background-color', o.geven);
                //                $("tr:odd", obj).css('background-color', o.godd);
                //
                //                $("td", obj).css("padding", "3px");
                //
                //                items.mouseover(function() {
                //                    $(this, "!th").css('background-color', o.ghover);
                //
                //                }).mouseout(function() {
                //                    $("tr:even", obj).css('background-color', o.geven);
                //                    $("tr:odd", obj).css('background-color', o.godd);
                // 
                //                               });
                //var dot=false;
                $(this).keydown(function (e) {
                        
                    var key = e.charCode || e.keyCode || 0;
                    //alert($(this).val().indexOf("."));
//                                            alert(e.keyCode);
                    // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                    if (key == 8 || key == 9 || key==110 || key==190 || key == 46 || (key >= 37 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105)){
                        if(key== 110){ 
                            if($(this).val().indexOf(".")==-1){
                                return true;  
                            }else{
                                return false;
                            } 
                        }else if(key== 190){
                            if($(this).val().indexOf(".")!=1){
                                return true;  
                            }else{
                                return false;
                            } 
                        }else{
                            return true;
                        }
//return true;
                    }else{
                        //$(this).val($(this).val().replace(/.$/g, ''));
                        return false;
                    }
                        
                });
            
                        });
                }
        
        
        });
     

///================== new number check===============

//Attach this new method to jQuery
//        $.fn.extend({ 
//                 
//                //This is where you write your plugin's name
//                onlyNum: function(options) {
//             
//            //Set the default values, use comma to separate the settings, example:
//
//            var defaults = {
//                ghover: "#eefefe", // these variable are the parameter.It setted as default value if don't have any argument in function call.
//                geven: "#eeeeee",
//                godd: "#ccc"
//            }
//
//            var options = $.extend(defaults, options);
//                        //Iterate over the current set of matched elements
//                        return this.each(function() {
//                 
//                $(this).keyup(function () {
//                    alert($(this).val());
//                               
//                    var reg = new RegExp("^[-]?[0-9]+[\.]?[0-9]+$");
//                    return reg.test($(this).val());
//                     
//                        
//                });
//        
//                        });
//                }
//    
//    
//        });

      
})(jQuery);

