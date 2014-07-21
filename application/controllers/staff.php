<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('masters_model');
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
	function add($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$this->data['user_id']=$user['user_id'];
		switch($type){
			case "staff":
				$access=0;
				foreach($this->data['functions'] as $f){
					if($f->user_function=="Staff" && $f->add==1){
						$access=1;
					}
				}
				if($access==0) show_404();
				$title="Add Staff Details";
			
				$config=array(
						array(
						 'field'   => 'first_name',
						 'label'   => 'First Name',
						 'rules'   => 'required|trim|xss_clean'
						),
						array(
						 'field'   => 'gender',
						 'label'   => 'Gender',
						 'rules'   => 'required|trim|xss_clean'
						)
				);
				$this->data['staff_category']=$this->masters_model->get_data("staff_category");
				$this->data['staff_role']=$this->masters_model->get_data("staff_role");
				break;
			case "staff_role":
				$access=0;
				foreach($this->data['functions'] as $f){
					if($f->user_function=="Staff Roles" && $f->add==1){
						$access=1;
					}
				}
				if($access==0) show_404();
				$title="Add Staff Role";
			
				$config=array(
						array(
						 'field'   => 'staff_role',
						 'label'   => 'Staff Role',
						 'rules'   => 'required|trim|xss_clean'
						)
				);
				break;
			case "staff_category":
				$access=0;
				foreach($this->data['functions'] as $f){
					if($f->user_function=="Staff Categories" && $f->add==1){
						$access=1;
					}
				}
				if($access==0) show_404();
				$title="Add Staff Category";
			
				$config=array(
						array(
						 'field'   => 'staff_category',
						 'label'   => 'Staff Category',
						 'rules'   => 'required|trim|xss_clean'
						)
				);
				break;
			default: show_404();	
		}
		$page="pages/staff/add_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->form_validation->set_rules($config);
 		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$this->data);
		}
		else{
				if(($this->input->post('submit'))||($this->masters_model->insert_data($type))){
					$this->data['msg']=" Inserted  Successfully";
					$this->load->view($page,$this->data);
				}
				else{
					$this->data['msg']="Failed";
					$this->load->view($page,$this->data);
				}
		}
		$this->load->view('templates/footer');
  	}	
  	
}

