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
				$this->data['reporting_officers']=$this->staff_model->get_staff();
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
  	
	function edit($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$this->data['user_id']=$user['user_id'];
		$this->data['type']=$type;
		
		if($type=="staff"){
			$title="Edit Staff";
			$config=array(
               array(
                     'field'   => 'staff',
                     'label'   => 'Staff',
                     'rules'   => 'trim|xss_clean'
                  ),
               array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'trim|xss_clean'
                  )
		
			);
			$this->data['staff_category']=$this->masters_model->get_data("staff_category",$mode='all');
			$this->data['staff_role']=$this->masters_model->get_data("staff_role",$mode='all');
				$this->data['reporting_officers']=$this->staff_model->get_staff();
		}
		else if($type == 'staff_role')
		{
			$title = 'Edit Staff Role';
			$config = array(
				array(
						 'field'   => 'staff_role',
						 'label'   => 'Staff Role',
						 'rules'   => 'trim|xss_clean'
				)
			);
			$this->data['staff_role'] = $this->masters_model->get_data('staff_role');
			
		}
		else if($type == 'staff_category')
		{
			$title = 'Edit Staff Category';
			//form configuration for staff_category
			$config = array(
				array(
						 'field'   => 'staff_category',
						 'label'   => 'Staff Category',
						 'rules'   => 'trim|xss_clean'
						)
			);
			
		}
		// if none of the options is selected (i.e. any invalid url modifications) 404 error is shown
		else
		{
			show_404();
		}
		
		$page="pages/staff/edit_".$type."_form";
		$this->data['title']=$title;
		$this->load->view('templates/header',$this->data);
      	$this->load->view('templates/left_nav',$this->data);
		//form configuration is set based on the option selected from the menu
		$this->form_validation->set_rules($config);

		//if the form contains any invalid data same page along with error msg is shown.
		if ($this->form_validation->run() === FALSE)
		{
			$this->data['mode'] = 'mode';
			$this->load->view($page,$this->data);
		}
		//if form does not contain any errors
		else
		{
			//there are 3 steps for updating
			// 1. User searches for the record to be updated.
			//    1.1 User can directly press search button without entering any data.
			// 2. User selects the required record.
			// 3. User enter some data and updates the record.
			
			// step 1. 
			if($this->input->post('search'))
			{
				//search results are retrieved from the master_model class
				$this->data['mode'] = 'search';
				$this->data[$type]=$this->masters_model->get_data($type);
				$this->load->view($page,$this->data);
			}
			// step 2.
			else if($this->input->post('select'))
			{
				//selected record's id is taken from  input in master_model
				//all the fields are retrieved and sent to the view
				$this->data['mode'] = 'select';
			   	$this->data[$type]=$this->masters_model->get_data($type);
         		$this->load->view($page,$this->data);
			}
			
			//step 3.
			else if($this->input->post('update'))
			{
				//Data from the input fields are retrieved from view and updates into database
				
				if($this->masters_model->update_data($type))
				{
					$this->data['msg']="Updated Successfully";
					$this->data['mode'] = 'update';
					$this->load->view($page,$this->data);
				}
				//if any failures occurs Failed msg is shown
				else
				{
					$this->data['msg']="Failed";
					$this->load->view($page,$this->data);
				}
			}
		}
		
		$this->load->view('templates/footer');
	}

	
}

