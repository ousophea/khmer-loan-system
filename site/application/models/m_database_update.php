<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('Permission Denied!');

class m_database_update extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    /**
     * 
     */
    public function update_db() {
        $sql = $this->string_update();
        $sqls = explode(';', $sql);
        array_pop($sqls);
        $smt="";
        foreach ($sqls as $statement) {
            $statment = $statement . ";";
            $smt = $this->db->query($statement);
        }
        return $smt;
    }
    public function string_update(){
        $sr = "
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_cid` varchar(45) DEFAULT NULL,
  `con_con_typ_id` int(11) DEFAULT NULL,
  `con_con_job_id` varchar(11) DEFAULT '0',
  `con_con_inc_id` int(11) NOT NULL DEFAULT '0',
  `con_use_id` int(11) DEFAULT '0',
  `con_bra_id` int(10) DEFAULT '0',
  `con_en_first_name` varchar(45) NOT NULL,
  `con_en_last_name` varchar(45) NOT NULL,
  `con_en_nickname` varchar(45) DEFAULT NULL,
  `con_kh_first_name` varchar(45) NOT NULL,
  `con_kh_last_name` varchar(45) NOT NULL,
  `con_kh_nickname` varchar(45) DEFAULT NULL,
  `con_sex` char(1) NOT NULL,
  `con_national_identity_card` varchar(20) DEFAULT NULL,
  `con_datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `con_datemodified` timestamp NULL DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`con_id`),
  KEY `con_typ_id` (`con_con_typ_id`),
  KEY `con_job_id` (`con_con_job_id`),
  KEY `con_inc_id` (`con_con_inc_id`),
  KEY `use_id` (`con_use_id`),
  KEY `con_bra_id` (`con_bra_id`),
  KEY `con_id` (`con_id`),
  KEY `con_cid` (`con_cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `contacts_couple`;
CREATE TABLE IF NOT EXISTS `contacts_couple` (
  `con_cou_owner` int(11) NOT NULL,
  `con_cou_couple` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `contacts_detail`;
CREATE TABLE IF NOT EXISTS `contacts_detail` (
  `con_det_con_id` int(11) NOT NULL,
  `con_det_email` varchar(45) DEFAULT NULL,
  `con_det_civil_status` varchar(1) NOT NULL DEFAULT '1',
  `con_det_dob` date DEFAULT NULL,
  `con_det_pro_id` int(11) NOT NULL DEFAULT '0',
  `con_det_dis_id` int(11) NOT NULL DEFAULT '0',
  `con_det_com_id` int(11) NOT NULL DEFAULT '0',
  `con_det_vil_id` int(11) NOT NULL DEFAULT '0',
  `con_det_address_detail` varchar(45) DEFAULT NULL,
  UNIQUE KEY `con_det_con_id` (`con_det_con_id`),
  KEY `con_id` (`con_det_con_id`),
  KEY `vil_id` (`con_det_vil_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `contacts_group`;
CREATE TABLE IF NOT EXISTS `contacts_group` (
  `con_gro_con_id` int(11) NOT NULL,
  `con_gro_gro_id` int(11) NOT NULL,
  PRIMARY KEY (`con_gro_con_id`,`con_gro_gro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;


DROP TABLE IF EXISTS `contacts_income`;
CREATE TABLE IF NOT EXISTS `contacts_income` (
  `con_inc_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_inc_range` varchar(100) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`con_inc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `contacts_number`;
CREATE TABLE IF NOT EXISTS `contacts_number` (
  `con_num_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_num_con_id` int(11) NOT NULL,
  `con_num_line` varchar(15) DEFAULT NULL,
  `status` bit(1) DEFAULT b'1',
  PRIMARY KEY (`con_num_id`),
  KEY `con_num_id` (`con_num_con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `loan_account`;
CREATE TABLE IF NOT EXISTS `loan_account` (
  `loa_acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loa_acc_loa_det_id` int(11) NOT NULL DEFAULT '0',
  `loa_acc_code` varchar(20) DEFAULT NULL,
  `loa_acc_con_id` int(11) DEFAULT NULL,
  `loa_acc_loa_pro_type_code` int(11) DEFAULT NULL,
  `loa_acc_loa_sch_id` int(11) DEFAULT NULL,
  `loa_acc_ownership_type` int(2) DEFAULT NULL,
  `loa_acc_amount` decimal(12,0) DEFAULT NULL,
  `loa_acc_amount_in_word` varchar(200) DEFAULT NULL,
  `loa_acc_cur_id` int(11) DEFAULT NULL,
  `loa_acc_gl_code` varchar(20) DEFAULT NULL,
  `loa_lat_id` int(11) DEFAULT NULL,
  `loa_alternative_account_code` varchar(50) DEFAULT '1',
  `loa_acc_rep_fre_id` int(11) DEFAULT NULL,
  `loa_acc_approval` varchar(20) DEFAULT NULL,
  `loa_acc_created_date` date DEFAULT NULL,
  `loa_acc_modified_date` date DEFAULT NULL,
  `loa_acc_use_id` int(11) DEFAULT NULL,
  `loa_acc_co_id` int(11) DEFAULT NULL,
  `loa_acc_first_repayment` date DEFAULT NULL,
  `loa_acc_disbustment` datetime DEFAULT NULL,
  `loa_status` int(10) DEFAULT '0' COMMENT '0:open,1:close, 2:Pending',
  `loa_acc_maturity` date DEFAULT '0000-00-00' COMMENT '0:open,1:close, 2:Pending',
  `loa_cicle` int(10) DEFAULT '1',
  `loa_lpp_id` int(10) DEFAULT '1',
  PRIMARY KEY (`loa_acc_id`),
  KEY `loa_product_type` (`loa_acc_loa_pro_type_code`),
  KEY `loa_contact` (`loa_acc_con_id`),
  KEY `loa_user_id` (`loa_acc_use_id`),
  KEY `loa_cur_id` (`loa_acc_cur_id`),
  KEY `loa_acc_gl_code` (`loa_acc_gl_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `loan_detail`;
CREATE TABLE IF NOT EXISTS `loan_detail` (
  `loa_det_id` int(10) NOT NULL AUTO_INCREMENT,
  `loa_det_status` char(50) DEFAULT NULL,
  PRIMARY KEY (`loa_det_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

INSERT INTO `loan_detail` (`loa_det_id`, `loa_det_status`) VALUES
	(1, 'Pending'),
	(5, 'Close'),
	(6, 'Blocked'),
	(4, 'Renew'),
	(2, 'Approved'),
	(3, 'Disapproved'),
	(7, 'Disbursment');

DROP TABLE IF EXISTS `loan_disbursments`;
CREATE TABLE IF NOT EXISTS `loan_disbursments` (
  `loa_dis_id` int(10) NOT NULL AUTO_INCREMENT,
  `loa_dis_status` tinyint(4) DEFAULT '1',
  `loa_dis_loa_acc_code` varchar(20) DEFAULT NULL,
  `loa_dis_use_id` int(11) DEFAULT NULL,
  `loa_dis_tra_mod_id` int(11) DEFAULT NULL,
  `loa_dis_description` varchar(200) DEFAULT NULL,
  `loa_dis_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`loa_dis_id`),
  KEY `loa_dis_loa_acc_id` (`loa_dis_loa_acc_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `repayment_schedule`;
CREATE TABLE IF NOT EXISTS `repayment_schedule` (
  `rep_sch_id` int(10) NOT NULL AUTO_INCREMENT,
  `rep_sch_date_repay` date DEFAULT NULL,
  `rep_sch_value_date` datetime DEFAULT NULL,
  `rep_sch_paid` float DEFAULT '0',
  `rep_sch_remain` float DEFAULT '0',
  `rep_sch_forward` float DEFAULT '0',
  `rep_sch_total_repayment` float(10,2) DEFAULT NULL,
  `rep_sch_status` int(10) DEFAULT NULL,
  `rep_sch_principle_amount_repayment` float(10,2) DEFAULT NULL,
  `rep_sch_rate_repayment` float(10,2) DEFAULT NULL,
  `rep_sch_balance` float(10,2) DEFAULT NULL,
  `rep_sch_instalment` float(10,2) DEFAULT NULL,
  `rep_sch_loa_acc_id` int(10) DEFAULT NULL,
  `rep_sch_saving` int(10) DEFAULT NULL,
  `rep_sch_num` int(10) DEFAULT NULL,
  `rep_sch_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rep_sch_id`),
  KEY `FK_repayment_schedule_loan_account` (`rep_sch_loa_acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

        return $sr;
    }

}

?>
