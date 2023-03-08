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
		$u_email=$this->input->post('u_email');
		$u_pass=md5($this->input->post('u_password'));

		$login_data = array('u_email' => $u_email, 'u_pass' => $u_pass);
		$this->db->select('*');
		$query = $this->db->get('user_data');
		foreach ($query->result() as $user_details)
		{
        	if($login_data['u_email']==$user_details->u_email && $login_data['u_pass']==$user_details->u_pass)
			{
				$_SESSION['u_email']=$user_details->u_email;
				$_SESSION['u_role']=$user_details->u_role;
				if($user_details->u_role=="admin")
				{	
					redirect('Admin','refresh');
				}
				else
			 	{
			   		$this->session->set_flashdata('invalid_user',"failed");
			   		redirect('Home/','refresh');
			 	}
			}
		}
	// 	 $u_data=array('u_email'=>$u_name,'u_pass'=>$u_pass);
	// 	 $this->db->select('*');
	// 	 $users_list = $this->db->get('user_data');
	// 	 if($users_list->num_rows()>0)
	// 	 {
	// 	   foreach($users_list->result() as $users)
	// 	   {
	// 		 if($u_data['u_email']==$users->email && $u_data['u_pass']==$users->password)
	// 		 {
	// 		   $_SESSION['u_id']=$u_data['u_email'];
	// 		   $_SESSION['u_role']=$users->u_role;
	// 		   if($users->role=="admin")
	// 		   {
	// 		   redirect('Admin','refresh');
	// 		   }
	// 		 }
	// 		 else
	// 		 {
	// 		   $this->session->set_flashdata('invalid_user',"failed");
	// 		   redirect('Home/login','refresh');
	// 		 }
	// 	   }
	// 	 }
	// 	 else
	// 		 {
	// 		   $this->session->set_flashdata('invalid_user',"failed");
	// 		   redirect('Home/login','refresh');
	// 		 }
		}
	}
	public function Admin()
	{
	$this->load->view('header');
	$this->load->view('Admin/admin_dash');
	$this->load->view('footer');
	}
}