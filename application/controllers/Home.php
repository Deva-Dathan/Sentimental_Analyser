<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login_page');
		$this->load->view('footer');
	}
	public function login_process()
	{
	  if($this->input->post('u_login'))
	   {
		 $u_name=$this->input->post('u_email');
		 $u_pass=md5($this->input->post('u_password'));
		 $u_data=array('u_email'=>$u_name,'u_pass'=>$u_pass);
		 $this->db->select('u_email, u_pass');
		 $users_list = $this->db->get('user_data');
		 if($users_list->num_rows()>0)
		 {
		   foreach($users_list->result() as $users)
		   {
			 if($u_data['u_email']==$users->email && $u_data['u_pass']==$users->password)
			 {
			   $_SESSION['u_id']=$u_data['u_email'];
			   $_SESSION['u_role']=$users->u_role;
			   if($users->role=="admin")
			   {
			   redirect('Admin','refresh');
			   }
			 }
			 else
			 {
			   $this->session->set_flashdata('invalid_user',"failed");
			   redirect('Home/login','refresh');
			 }
		   }
		 }
		 else
			 {
			   $this->session->set_flashdata('invalid_user',"failed");
			   redirect('Home/login','refresh');
			 }
	   }
	}
	public function Admin()
{
	$this->load->view('header');
	$this->load->view('Admin/admin_dash');
	$this->load->view('footer');
}
}