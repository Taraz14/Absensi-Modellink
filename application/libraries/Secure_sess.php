<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Secure_sess
{

   protected $CI;

   public function __construct()
   {
      $this->CI = &get_instance();
   }

   public function is_logout()
   {
      $this->CI->session->unset_userdata('id_user');
      $this->CI->session->unset_userdata('username');
      $this->CI->session->unset_userdata('nama');
      // $this->CI->session->unset_userdata('email_user');
      // $this->CI->session->unset_userdata('user_image');
      $this->CI->session->unset_userdata('role');
      $this->CI->session->sess_destroy();
      redirect('auth');
   }
}
