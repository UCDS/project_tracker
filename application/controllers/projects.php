<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('projects_model');
		$this->load->model('staff_model');
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
		$data['projects']=$this->staff_model->get_projects();
		$data['title']="Update Projects";
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
			if($this->input->post('project_id')){
				$data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/update_project',$data);
			}
			if($this->input->post('status') || $this->input->post('status_remarks')){
				if($this->projects_model->update_status()){
				$data['msg']="Updated successfully!";
				$data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/update_project',$data);
				}
				else{
				$data['msg']="Error in updating, please retry.";
				$this->load->view('pages/update_project',$data);
				}
					
			}
			if($this->input->post('expenditure') && $this->input->post('expense_date')){
				if($this->projects_model->update_expenses()==TRUE){
				$data['msg']="Updated successfully!";
				$data['project']=$this->staff_model->get_projects();
				
				$this->load->view('pages/update_project',$data);
				}
				else{
				$data['msg']="Error in updating, please retry.";
				$data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/update_project',$data);
				}	
			}
			if(!empty($_FILES['project_image']['name'])){
						$config['upload_path'] = './assets/images/project_images/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '1000000000';
						$config['max_width']  = '11924';
						$config['max_height']  = '11768';
						$ext = end(explode(".", strtolower($_FILES['project_image']['name'])));
						$config['file_name'] = "project_".$this->input->post('selected_project')."_image.".$ext;
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('project_image'))
						{
							$data['project']=$this->staff_model->get_projects();
							echo $this->upload->display_errors();

							$this->load->view('pages/update_project',$data);
						}
						else
						{
				$data['project']=$this->staff_model->get_projects();
							$data['msg'] = "Updated image successfully!";

							$this->load->view('pages/update_project', $data);
						}
			}
		}
		$this->load->view('templates/footer');
	}
	

}

