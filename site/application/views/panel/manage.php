<!--<div class="panel-control">
        <div class="row">
        <div class="span"> <a class="row" href="<?php echo site_url('contacts'); ?>"><img title="Contacts Manager" alt="Contacts Manager" src="<?php echo site_url(BOOTSTRAP_MEDIA_PATH); ?>/contact.png"> <span class="row">Contacts</span></a> </div>
    </div>
</div>-->

<div class="panel-control">
    <div class="row">
        <?php if (strtolower($this->session->userdata('gro_name')) != strtolower(TELLER)) { ?>
        <div class="span"> <a class="row" href="<?php echo base_url(); ?>loan/open"><img title="New Loan Account" alt="" src="<?php echo base_url(); echo Variables::$images_path; ?>personal_loan.png"> <span class="row">New Loan</span></a> </div>
        <!--<div class="span"> <a class="row" href="<?php echo site_url('saving/open'); ?>"><img title="New Loan" alt="New Saing Account" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'saving.png'); ?>"> <span class="row">New Saving</span></a> </div>-->
        <div class="span"> <a class="row" href="<?php echo site_url('contacts/add'); ?>"><img title="Contacts" alt="Contacts" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'contact.png'); ?>"> <span class="row">New Contacts</span></a> </div>
        <!--<div class="span"> <a class="row" href="<?php echo site_url('journals/journal#form_journal'); ?>"><img title="Journals Entry" alt="Journals Entry" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'journal.png'); ?>"> <span class="row">Journals Entry</span></a> </div>-->
        <div class="span"> <a class="row" href="<?php echo base_url(); ?>users"><img title="Manage users" alt="" src="<?php echo base_url(); echo Variables::$images_path;            ?>user.png"> <span class="row">User</span></a> </div>
        <div class="span"> <a class="row" href=""><img title="Reports" alt="" src="<?php echo base_url(); echo Variables::$images_path; ?>report.png"> <span class="row">Report</span></a> </div>
                <div class="span"> <a class="row" href="<?php echo site_url('loan/payoff#contents'); ?>"><img title="Loan Payoff" alt="pay off" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'journal.png'); ?>"> <span class="row">Loan Payoff</span></a> </div>

            <?php }else{ ?>
        
        <div class="span"> 
            <a class="row" href="<?php echo site_url('cashs'); ?>">
                <img title="Contacts" alt="cashs" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'payment.png'); ?>"> 
                <span class="row">Cashes</span></a> </div>
        <div class="span"> 
            <a class="row" href="<?php echo base_url(); ?>repayment">
                <img title="Contacts" alt="repayment" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'repayment.png'); ?>"> 
                <span class="row">Loan Repayment</span></a> </div>
        <div class="span"> 
            <a class="row" href="<?php echo base_url(); ?>deposits">
                <img title="Contacts" alt="deposits" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'deposit.png'); ?>"> 
                <span class="row">Deposits</span></a> </div>
                
        <div class="span"> 
            <a class="row" href="<?php echo base_url(); ?>withdrawals">
                <img title="Contacts" alt="withdrawals" src="<?php echo site_url(IMAGES_PATH_BOOTSTRAP . 'withdrawal.png'); ?>"> 
                <span class="row">Withdrawals</span></a> </div>
                
                
        <div class="span"> <a class="row" href=""><img alt="" src="<?php echo base_url(); echo Variables::$images_path; ?>payment.png"> <span class="row">Pay Cash</span></a> </div>
        <div class="span"> <a class="row" href="<?php echo base_url(); ?>receivecashs"><img title="Recive Cash" alt="" src="<?php echo base_url(); echo Variables::$images_path; ?>cash_recive.png"> <span class="row">Recive Cash</span></a> </div>
        
        <?php } ?>

    </div>
</div>