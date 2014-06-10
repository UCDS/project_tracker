<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('projects_model');
		$this->load->model('staff_model');
		if(!$this->session->userdata('logged_in')){
			redirect('home','refresh');
		}
	}
	public function create()
	{
		$this->load->helper('form');
		$user=$this->session->userdata('logged_in');
		$data['user_id']=$user[0]['user_id'];
		foreach($this->session->userdata('logged_in') as $row){
			$data['districts'][]=$row['district_id'];
		}
		$data['district']=$this->staff_model->get_districts();
		$data['divisions']=$this->staff_model->get_divisions();
		$data['facilities']=$this->staff_model->get_facilities();
		$data['grants']=$this->staff_model->get_grants();
		$data['user_departments']=$this->staff_model->get_user_departments();
		$data['agencies']=$this->staff_model->get_agencies();
		$data['title']="Create Project";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('project_name', 'Project Name',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/add_project_form');
		}
		else{
		if($data['registered']=$this->projects_model->create_project()){
				$data['msg']="Project added successfully";
				$this->load->view('pages/add_project_form',$data);
			}
			else{
				$data['msg']="Error in adding project.";
				$this->load->view('pages/add_project_form',$data);
			}
		
		}
		$this->load->view('templates/footer');
	}
	public function update()
	{
		$this->load->helper('form');
		$this->load->helper('file');
		$user=$this->session->userdata('logged_in');
		$data['user_id']=$user[0]['user_id'];
		foreach($this->session->userdata('logged_in') as $row){
			$data['districts'][]=$row['district_id'];
		}
		$data['district']=$this->staff_model->get_districts(1);
		$data['grant']=$this->staff_model->get_grants(1);
		$data['user_departments']=$this->staff_model->get_user_departments(1);

		$data['title']="Update Projects";
		$data['projects']=$this->staff_model->get_projects(0);
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('project_id', 'Project Name',
		'trim|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/update_project');
		}
		else{
			$data['divisions']=$this->staff_model->get_divisions();
			$data['facilities']=$this->staff_model->get_facilities();
			$data['grants']=$this->staff_model->get_grants();
			$data['user_departments']=$this->staff_model->get_user_departments(1);
			$data['agencies']=$this->staff_model->get_agencies();
			$data['status_types']=$this->staff_model->get_status_types();
			$data['stages']=$this->staff_model->get_work_stages();
			
			if($this->input->post('update_status')){

				if($this->projects_model->update_status()){
				$data['msg']="Updated successfully!";
				}
				else{
				$data['msg']="Error in updating, please retry.";
				}
					
				$data['project']=$this->staff_model->get_projects();
				$data['expenses']=$this->staff_model->get_expenses($this->input->post('selected_project'));
			}
			else if($this->input->post('update_expenses')){
	
				if($this->projects_model->update_expenses()==TRUE){
				$data['msg']="Updated successfully!";			
				}
				else{
				$data['msg']="Error in updating, please retry.";
				}	
				
				$data['project']=$this->staff_model->get_projects();
				$data['expenses']=$this->staff_model->get_expenses($this->input->post('selected_project'));
			}
			else if($this->input->post('update_project')){	
				if($this->projects_model->update_project()==TRUE){
				$data['msg']="Updated successfully!";			
				}
				else{
				$data['msg']="Error in updating, please retry.";
				}	
				
				$data['project']=$this->staff_model->get_projects();
				$data['expenses']=$this->staff_model->get_expenses($this->input->post('selected_project'));	
			}
			if(!empty($_FILES['project_image']['name'])){
						$config['upload_path'] = './assets/images/project_images/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '1000000000';
						$config['max_width']  = '11924';
						$config['max_height']  = '11768';
						$config['overwrite']  = TRUE;
						$ext = end(explode(".", strtolower($_FILES['project_image']['name'])));
						$config['file_name'] = "project_".$this->input->post('selected_project')."_image.".$ext;
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('project_image'))
						{
							$data['project']=$this->staff_model->get_projects();
							$data['expenses']=$this->staff_model->get_expenses($this->input->post('selected_project'));
							echo $this->upload->display_errors();
						}
						else
						{
							$data['project']=$this->staff_model->get_projects();
							$data['expenses']=$this->staff_model->get_expenses($this->input->post('selected_project'));
							$data['msg'] = "Updated image successfully!";

						}
			}

			if($this->input->post('project_id')){
				$data['project']=$this->staff_model->get_projects();
				$data['expenses']=$this->staff_model->get_expenses($this->input->post('project_id'));
			}
			if($this->input->post('district_id') || $this->input->post('grant')){
				$data['projects']=$this->staff_model->get_projects();
				$data['expenses']=$this->staff_model->get_expenses($this->input->post('project_id'));
			}	
			$this->load->view('pages/update_project',$data);
		}
		$this->load->view('templates/footer');
	}
	

}

