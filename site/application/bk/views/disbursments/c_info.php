<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($query_all->result() as $rows) {
             echo'
                <div class="control-group">
                    <div class="controls" style="font-weight: bold;">
                         CID: ' . $rows->con_cid .
                '<br />
                         Name : ' . $rows->con_en_first_name . " " . $rows->con_en_last_name .
                '<br />
                         Bate of Birth: '.$rows->con_det_dob."&nbsp;&nbsp;".(($rows->con_sex =="m")?"Male":"Female")."/".(($rows->con_det_civil_status==1)?"Single":"Maried").
                     
                '<br />
                         NID: '.$rows->loa_acc_id.
                     
                '<br />
                         Address: '.$rows->con_det_address_detail." ,".$rows->dis_kh_name.", ".$rows->com_kh_name.", ".$rows->vil_kh_name.", ".$rows->pro_kh_name.
                     
                '</div></div>';
            }

?>