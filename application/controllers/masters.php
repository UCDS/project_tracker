<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('projects_model');
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
		if($type=="facility"){

			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Facilities" && $f->add==1){
					$access=1;
				}
			}
			if($access==0) show_404();
		$title="Add Facility";
			$config=array(
               array(
                     'field'   => 'facility_name',
                     'label'   => 'Facility Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
			$this->data['facility_types']=$this->masters_model->get_data("facility_types");
			$this->data['divisions']=$this->masters_model->get_data("divisions");	
		}
		else if($type=="facility_type"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Facility Types" && $f->add==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Add Facility Type";
			$config=array(
               array(
                     'field'   => 'facility_type',
                     'label'   => 'Facility Type',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
		}
		else if($type=="agency"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Agencies" && $f->add==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Add Agency";
			$config=array(
               array(
                     'field'   => 'agency_name',
                     'label'   => 'Agency Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
		}
		else if($type=="user_department"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="User Departments" && $f->add==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Add User Department";
			$config=array(
               array(
                     'field'   => 'user_department',
                     'label'   => 'User Department',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
		}
		else if($type=="division"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Divisions" && $f->add==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Add Division";
			$config=array(
               array(
                     'field'   => 'division_name',
                     'label'   => 'Division Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);	
			$this->data['district']=$this->masters_model->get_data("districts");
		}
		else if($type=="grant"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Schemes" && $f->add==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Add Grant";
			$config=array(
               array(
                     'field'   => 'grant_name',
                     'label'   => 'Grant Name',
                     'rules'   => 'required|trim|xss_clean'
                  ),
			  array(
                     'field'   => 'phase_name[]',
                     'label'   => 'Phase Name',
                     'rules'   => 'required|trim|xss_clean'
               )
			);
			$this->data['grant_sources']=$this->masters_model->get_data("grant_sources");
		}
			
		else{
			show_404();
		}
		$page="pages/add_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$this->data);
		}
		else{
				if($this->masters_model->insert_data($type)){
					$this->data['msg']="Inserted Successfully";
					$this->load->view($page,$this->data);
				}
				else{
					$this->data['msg']="Failed";
					$this->load->view($page,$this->data);
				}
		}
		$this->load->view('templates/footer');
	}	
	function edit($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$this->data['user_id']=$user['user_id'];
		if($type=="facility"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Facilities" && $f->edit==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Edit Facility";
			$config=array(
               array(
                     'field'   => 'facility_id',
                     'label'   => 'Facility',
                     'rules'   => 'trim|xss_clean'
                  )
			);
			$this->data['facility_types']=$this->masters_model->get_data("facility_types");
			$this->data['divisions']=$this->masters_model->get_data("divisions");	
		}
		else if($type=="agency"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Agencies" && $f->edit==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Edit Agency";
			$config=array(
               array(
                     'field'   => 'agency_id',
                     'label'   => 'Agency',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
		}
		else if($type=="user_department"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="User Departments" && $f->edit==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Edit User Department";
			$config=array(
               array(
                     'field'   => 'user_department',
                     'label'   => 'User Department',
                     'rules'   => 'trim|xss_clean'
                  )
			);
		}
		else if($type=="division"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Divisions" && $f->edit==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Edit Division";
			$config=array(
               array(
                     'field'   => 'division_id',
                     'label'   => 'Division',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);	
			$this->data['district']=$this->masters_model->get_data("districts");
		}
		else if($type=="grant"){
			$access=0;
			foreach($this->data['functions'] as $f){
				if($f->user_function=="Schemes" && $f->edit==1){
					$access=1;
				}
			}
			if($access==0) show_404();
			$title="Edit Grant";
			$config=array(
               array(
                     'field'   => 'grant_phase_id',
                     'label'   => 'Grant',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
			$this->data['grant_sources']=$this->masters_model->get_data("grant_sources");
		}			
		else{
			show_404();
		}
		$page="pages/edit_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$this->data);
		}
		else{
			if($this->input->post('update')){
				if($this->masters_model->update_data($type)){
					$this->data['msg']="Updated Successfully";
					$this->load->view($page,$this->data);
				}
				else{
					$this->data['msg']="Failed";
					$this->load->view($page,$this->data);
				}
			}
			else if($this->input->post('select')){
				$this->data[$type]=$this->masters_model->get_data($type);
				$this->data['mode']="select";
				$this->load->view($page,$this->data);
			}
			else if($this->input->post('search')){
				$this->data['mode']="search";
				$this->data[$type]=$this->masters_model->get_data($type);
				$this->load->view($page,$this->data);
			}
		}
		$this->load->view('templates/footer');
	}
	
}

