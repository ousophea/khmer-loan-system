
<style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
</style>
<script>
    // from : http://jqueryui.com/dialog/#modal-form
    var jq = jQuery.noConflict();
    jq(function () {
        jq("#divdeps").dialog({
            autoOpen: false,
            show: 'slide',
            resizable: false,
            position: 'center',
            stack: true,
            height: 'auto',
            width: '300',
            modal: true,
            buttons:
                    {"Cancel": function () {
                            jq(this).dialog("close")
                        },
                        "Submit": function () {
                            addUser();
                        }
                    }

        });
        jq("#create-user").button().on("click", function () {
            jq("#divdeps").dialog("open");
        });

        function addUser() {
            var salary = jq('#newSalary').val();
            jq.ajax({
                url: "<?php echo site_url('cofficer/inc_salary'); ?>",
                type: 'post',
                async: false,
                data: {"salary": salary},
                dataType: 'json',
                success: function () {
                    alert("Success");
                }
            });
        }
//        dialog = jq("#dialog-form").dialog({
//            autoOpen: false,
//            height: 300,
//            width: 350,
//            modal: true,
//            buttons: {
//                "Create an account": addUser,
//                Cancel: function () {
//                    dialog.dialog("close");
//                }
//            },
//            close: function () {
//                form[ 0 ].reset();
//                allFields.removeClass("ui-state-error");
//            }
//        });
//        form = dialog.find("form").on("submit", function (event) {
//            event.preventDefault();
//            addUser();
//        });
//        jq("#create-user").button().on("click", function () {
//            dialog.dialog("open");
//        });


    });
</script>
</head>
<body>
    <!--    <div id="dialog-form" title="Incrss salary">
            <form>
                <fieldset>
                    <label for="old_salary">Old salary</label>
                    <input type="text" name="old_salary" id="oldSalary" value="" class="text ui-widget-content ui-corner-all">
                    <label for="email">New Salary</label>
                    <input type="text" name="new_salary" id="newSalary" value="" class="text ui-widget-content ui-corner-all">
                     Allow form submission with keyboard without duplicating the dialog button 
                    <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                </fieldset>
            </form>
        </div>
        <button id="create-user">Create new user</button>-->

    <button id="create-user">Create new user</button>
    <div id="divdeps" style="display:none" title="ddd">
        <form>
            <fieldset>
                <label for="old_salary">Old salary</label>
                <input type="text" name="old_salary" id="oldSalary" value="" >
                <label for="new_salary">New Salary</label>
                <input type="text" name="new_salary" id="newSalary" value="" >
                <span id="ms"></span>

            </fieldset>
        </form>
    </div>
</body>
</html>