<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_panel extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('staff_model');	
		if($this->session->userdata('logged_in')){
		$userdata=$this->session->userdata('logged_in');
		$user_id=$userdata['user_id'];
		$this->data['divisions']=$this->staff_model->user_division($user_id);
		$this->data['user_departments']=$this->staff_model->user_department($user_id);
		$this->data['functions']=$this->staff_model->user_function($user_id);
		}
		else redirect('home','refresh');
	}
	function create_user(){
		$access=0;
		foreach($this->data['functions'] as $f){
			if($f->user_function=="Users" && $f->add==1){
				$access=1;
			}
		}
		if($access==0) show_404();
		$this->load->helper('form');
		$this->data['title']="Create User";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['divisions']=$this->staff_model->get_divisions();
		$this->data['user_functions']=$this->staff_model->get_user_function();
		$this->data['user_departments']=$this->staff_model->get_user_departments();
		$this->data['staff']=$this->staff_model->get_staff();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav',$this->data);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE){
			$this->load->view('pages/create_user',$this->data);
		}
		else{
			if($this->staff_model->create_user()){
				$this->data['msg']="User created successfully";
				$this->load->view('pages/create_user',$this->data);
			}
			else{
				$this->data['msg']="Error creating user. Please retry.";
				$this->load->view('pages/create_user',$this->data);
			}
		}
		$this->load->view('templates/footer');	
	}
	function settings(){
		if($this->session->userdata('logged_in')){
		$this->load->helper('form');
		$this->data['title']="User Panel";
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/leftnav',$this->data);
		$this->load->view('pages/settings',$this->data);
		$this->load->view('templates/footer');	
		}
		else{
			show_404();
		}
	}

}
?>
