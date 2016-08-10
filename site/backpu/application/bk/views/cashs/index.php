<div class="form-model">
    <div class="form_model_style"></div>
    <?php
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
    echo form_open('cashs', array('class' => 'form-horizontal', 'name' => 'open_saving'));
    $tab1 = open_span();
    $tab1 .= open_block("cashin_block", "Cash In");
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'Currency',
        'attr' => array(
            'name' => 'currency',
            'option' => $currencies
        )
    );
    $tab1 .= get_form($data);
    $data = array(
        'type' => 'text', // input type='text'
        'label' => 'Check-in amount',
        'attr' => array(
            'name' => 'amountin',
        )
    );
    $btn = form_button(array('content' => 'Cash In', 'class' => 'btn', 'id' => 'cashin'), 'cashin');
    $tab1 .= get_form($data, $btn);
    $tab1 .= close_block();
    $tab1 .= close_span();
//-------------
    $tab2 = open_span();
    $tab2 .= open_block("cashout_block", "Cash Out");
    $data = array(
        'type' => 'select', // input type='text'
        'label' => 'Currency',
        'attr' => array(
            'name' => 'currencyout',
            'option' => $currencies
        )
    );
    $tab2 .= get_form($data);
    $data = array(
        'type' => 'text', // input type='text'
        'label' => 'Check-out amount',
        'attr' => array(
            'name' => 'amountout',
        )
    );
    $btn = form_button(array('content' => 'Cash Out', 'class' => 'btn', 'id' => 'cashout'), 'cashout');

    $tab2 .= get_form($data, $btn);


    $tab2 .= close_block();
    $tab2 .= close_span();
    $tabs = array(
        array("Cash In", $tab1),
        array("Cash Out", $tab2),
    );
    echo tab_form($tabs);
    echo form_close();
    ?>
</div>
<script type="text/javascript">
    jQuery.noConflict();
    (function($) {
        $(function() {

            var uri = [
                $('[name="base_url"]').val(),
                $('[name="segment1"]').val(),
                $('[name="segment2"]').val(),
                $('[name="segment3"]').val(),
            ];
            // 
            //---------- cashin
            $('#cashin').click(function() {
                
                var currency = $('[name="currency"]');
                var amountin = $('[name="amountin"]');
                
                
                if (currency.val() == "") {
                    currency.addClass('alert-error');
                    alert('Please select currency!');
                    $('#loader').hide();
                    return false;
                }
                var reg = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
                if(!reg.test(amountin.val()) || amountin.val()==0){
                    var yes = confirm('In check-in amount textbox contain letter or invalid number and you value must no zero.\n\
                        \nYou could not Cash in amount.\n\
                        \nExample valid number: 100.001\n\
                        \nDo you want to clear this textbox?');
                    if(yes){
                        amountin.val('');
                    }
                    $('#loader').hide();
                    return false;
            
                }
                $.post(
                    uri[0] + "cashs/cashin",
                    {
                        amountin: $('[name="amountin"]').val(),
                        currency: $('[name="currency"]').val()
                    },
                    function(data) { 
                        if (data.result == 1) {
                            alert('Cash in success');
                            amountin.val(0);
                        }
                        else {
                            alert('Cash in fail, please try again!!!')
                        }
                        $('#loader').hide();
                    },
                    'json'
                );
            });
            //----------- cashout
            $('#cashout').click(function() {
                var currency = $('[name="currencyout"]');
                var amountin = $('[name="amountout"]');
                
                
                if (currency.val() == "") {
                    currency.addClass('alert-error');
                    alert('Please select currency!');
                    $('#loader').hide();
                    return false;
                }
                var reg = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
                if(!reg.test(amountin.val()) || amountin.val()==0){
                    var yes = confirm('In check-in amount textbox contain letter or invalid number and you value must no zero.\n\
                        \nYou could not Cash in amount.\n\
                        \nExample valid number: 100.001\n\
                        \nDo you want to clear this textbox?');
                    if(yes){
                        amountin.val('');
                    }
                    $('#loader').hide();
                    return false;
            
                }
                $.post(
                    uri[0] + "cashs/cashout",
                    {
                        amountout: $('[name="amountout"]').val(),
                        currencyout: $('[name="currencyout"]').val()
                    },
                    function(data) {
                        if (data.result == 1) {
                            alert('Cash out success');
                            amountin.val(0);
                        }
                        else {
                            alert('Cash out fail, please try again!!!')
                        }
                        $('#loader').hide();
                    },
                    'json'
                );
            });




        });
    })(jQuery);
</script>
