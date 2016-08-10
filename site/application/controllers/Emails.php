<?php 
//require_once "info.php"; require_once "Mail.php";
   defined('BASEPATH') OR exit('No direct script access allowed');

   class Emails extends CI_Controller { 
 
      function __construct() { 
         parent::__construct(); 
         $this->load->library('session'); 
         $this->load->helper('form'); 
      } 
  
      public function index() {  
      $this->load->library('email'); 
       $this->email->from('darith.ant@gmail.com', 'daney');
       $this->email->to('daney.hak@student.passerellesnumeriques.org');
       $this->email->subject('Return book to library');
       $this->email->message('test send mail');
        if($this->email->send()){
         echo "success!";
        }else{ 
         echo "error!";
         // $this->load->view('emails/send_email'); 
         }
      } 
   }