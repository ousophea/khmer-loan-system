<!-- Author: Bunthoeurn -->
<?php
// echo $query_all;
//echo form_open('branch', array('name' => 'frm', 'class' => 'form', 'id' => 'frm_branch'));
//echo control_manager();
//$arr_select_field = array(
//'Branch ID' => 'bra_id',
// 'Branch Name' => 'bra_name',
// 'Branch Address' => 'bra_address'
//);
//echo table_manager($query_all, $arr_select_field, TRUE);
//echo form_close();
?>
<div class="tools ">
    <!--<a class="btn btn-mini" href="branch/add" title="Create new branch"><i class="icon-plus-sign"></i>New</a>-->
    <!--<span id="delete" class="print btn btn-mini" title="Print" print="listsaving"><i class="icon-print"></i> Print</span>-->
    <a href="<?php echo site_url(); ?>branch/add/<?php echo $this->uri->segment(4); ?>" class="btn btn-mini"><i class="glyphicon icon-plus"></i> New</a>
        <br />
</div>
 
<div class="panel panel-default">
    
    <div class="panel-body">
       <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Branch Name</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
//                    echo $data->num_rows();exit();
                $i=1;
                if ($data->num_rows() > 0) {
                    ?>
                    <?php
                    foreach ($data->result_array() as $row) {
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['bra_name']; ?></td>
                            <td><?php echo $row['bra_address']; ?></td>
                            <td>
                                <a  href="<?php echo base_url(); ?>branch/edit/<?php
                                echo $row['bra_id'];
                                echo '/' . $this->uri->segment(4);
                                ?>" title="Edit"><i class="glyphicon-edit icon-edit"></i></a>
                                <a  href="<?php echo base_url(); ?>branch/delete/<?php
                                echo $row['bra_id'];
                                echo '/' . $this->uri->segment(4);
                                ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this branch record? This branch record will be deleted permanently.');"><i class="glyphicon icon-remove"></i></a>
                            </td>
                        </tr>

                        <?php
                        $i++;
                    }
                    ?>
                <?php } else { ?>
                    <tr><td colspan="6">Not recode found..!</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>