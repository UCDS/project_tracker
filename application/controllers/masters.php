<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('projects_model');
		$this->load->model('masters_model');
	}
	function add($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$data['user_id']=$this->session->userdata('logged_in')[0]['user_id'];
		if($type=="facility"){
			$title="Add Facility";
			$config=array(
               array(
                     'field'   => 'facility_name',
                     'label'   => 'Facility Name',
                     'rules'   => 'trim|xss_clean'
                  )
			);
				$data['facility']=$this->masters_model->get_data("facility");
			$data['facility_types']=$this->masters_model->get_data("facility_types");
			$data['divisions']=$this->masters_model->get_data("divisions");	
		}
		else if($type=="facility_type"){
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
			$title="Add Agency";
			$config=array(
               array(
                     'field'   => 'agency_name',
                     'label'   => 'Agency Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
			$data['agency']=$this->masters_model->get_data("agency");
		
		}
		else if($type=="divisions"){
			$title="Add Division";
			$config=array(
               array(
                     'field'   => 'division',
                     'label'   => 'Division ',
                     'rules'   => 'trim|xss_clean'
                  )
			);	
			$data['division']=$this->masters_model->get_data("divisions");
			$data['district']=$this->masters_model->get_data("districts");

		}
		else if($type=="grant"){
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
		    $data['grants']=$this->masters_model->get_data("grant");
			$data['grant_sources']=$this->masters_model->get_data("grant_sources");
			$data['grant_phases']=$this->masters_model->get_data("grant_phases");
		}
		else if($type=="user_type"){
			$title="Add User Type";
			$config=array(
               array(
                     'field'   => 'user_type',
                     'label'   => 'User Type',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);

		}
		else if($type=="users"){
			$title="Add User";
			$config=array(
               array(
                     'field'   => 'user_type',
                     'label'   => 'User Type',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                array(
                     'field'   => 'username',
                     'label'   => 'User Name',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                 array(
                     'field'   => 'password',
                     'label'   => ' password',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                  array(
                     'field'   => 'first_name',
                     'label'   => 'first_name ',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                   array(
                     'field'   => 'last_name',
                     'label'   => 'Last Name',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                     array(
                     'field'   => 'dob',
                     'label'   => 'dob ',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                   array(
                     'field'   => 'phone_no',
                     'label'   => 'phone_no',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                    array(
                     'field'   => 'email_id',
                     'label'   => 'email_id',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                     array(
                     'field'   => 'address',
                     'label'   => 'address',
                     'rules'   => 'required|trim|xss_clean'
                  ),   array(
                     'field'   => 'pincode',
                     'label'   => 'pincode',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
$data['users']=$this->masters_model->get_data("users");
//$data['users']=$this->masters_model->get_data("user");
$data['user_type']=$this->masters_model->get_data("user_type");
		}
			
		else{
			show_404();
		}
		$page="pages/add_".$type."_form";
		$data['title']=$title;
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$data);
		}
		else{
				if($this->masters_model->insert_data($type)){
					
					$data['msg']="Inserted Successfully";
					$this->load->view($page,$data);
				}
				else{
					$data['msg']="Failed";
					$this->load->view($page,$data);
				}
		}
		$this->load->view('templates/footer');
	}	
	function edit($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$data['user_id']=$this->session->userdata('logged_in')[0]['user_id'];
		if($type=="facility"){
			$title="Edit Facility";
			$config=array(
               array(
                     'field'   => 'facility_id',
                     'label'   => 'Facility',
                     'rules'   => 'trim|xss_clean'
                  )
			);
			$data['facility_types']=$this->masters_model->get_data("facility_types");
			$data['division']=$this->masters_model->get_data("division");	
		}
			else if($type=="grant"){
			$title="Edit Grant";
			$config=array(
               array(
                     'field'   => 'grant_id',
                     'label'   => 'Grant',
                     'rules'   => 'trim|xss_clean'
                  )
			);
            $data['grants']=$this->masters_model->get_data("grants");

			$data['grant_sources']=$this->masters_model->get_data("grant_sources");
			$data['grant_phases']=$this->masters_model->get_data("grant_phases");
		
							}
		else if($type=="facility_type"){
			$title="Add Facility Type";
			$config=array(
               array(
                     'field'   => 'facility_type',
                     'label'   => 'Facility Type',
                     'rules'   => 'trim|xss_clean'
                  )
			);
			
		}	
		else if($type=="user_type"){
			$title="Add User Type";
			$config=array(
               array(
                     'field'   => 'user_type',
                     'label'   => 'User Type',
                     'rules'   => 'trim|xss_clean'
                  )
			);
			$data['user_type']=$this->masters_model->get_data("user_type");
		}				
		else if($type=="agency"){
			$title="Edit Agency";
			$config=array(
               array(
                     'field'   => 'search_agency_name',
                     'label'   => 'Agency',
                     'rules'   => 'trim|xss_clean'
                  )
			);
			$data['agency']=$this->masters_model->get_data("agency");

		}
		else if($type=="divisions"){
			$title="Edit Division";
			$config=array(
               array(
                     'field'   => 'division_id',
                     'label'   => 'Division',
                     'rules'   => 'trim|xss_clean'
                  )
			);	
			$data['districts']=$this->masters_model->get_data("districts");
			$data['divisions']=$this->masters_model->get_data("divisions");

		}
	
		else if($type=="users"){
			$title="Edit User";
			$config=array(
               array(
                     'field'   => 'user_id',
                     'label'   => 'User',
                     'rules'   => 'trim|xss_clean'
                  )
			);   
				$data['users']=$this->masters_model->get_data("users");
				$data['user_type']=$this->masters_model->get_data("user_type");

       

		}
			
		else{
			show_404();
		}
		$page="pages/edit_".$type."_form";
		$data['title']=$title;
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$data);
		}
		else{
			if($this->input->post('update')){
				if($this->masters_model->update_data($type)){
					$data['msg']="Updated Successfully";
					$this->load->view($page,$data);
				}
				else{
					$data['msg']="Failed";
					$this->load->view($page,$data);
				}
			}
			else if($this->input->post('select')){
				$data[$type]=$this->masters_model->get_data($type);
				$data['mode']="select";
				$this->load->view($page,$data);
			}
			else if($this->input->post('search')){
				$data['mode']="search";
				$data[$type]=$this->masters_model->get_data($type);
				$this->load->view($page,$data);
			}
		}
		$this->load->view('templates/footer');
	}
	
}

