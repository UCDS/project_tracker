<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('projects_model');
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
	public function create()
	{
	
		$access=0;
		foreach($this->data['functions'] as $f){
			if($f->user_function=="Works" && $f->add==1){
				$access=1;
			}
		}
		if($access==0) show_404();
		$this->load->helper('form');
		$user=$this->session->userdata('logged_in');
		$this->data['user_id']=$user['user_id'];
		$this->data['facilities']=$this->staff_model->get_facilities($this->data['divisions']);
		$this->data['grants']=$this->staff_model->get_grants();
		$this->data['user_departments']=$this->staff_model->get_user_departments();
		$this->data['agencies']=$this->staff_model->get_agencies();
		$this->data['title']="Create Project";
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('project_name', 'Project Name',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/add_project_form');
		}
		else{
		if($this->data['registered']=$this->projects_model->create_project()){
				$this->data['msg']="Project added successfully";
				$this->load->view('pages/add_project_form',$this->data);
			}
			else{
				$this->data['msg']="Error in adding project.";
				$this->load->view('pages/add_project_form',$this->data);
			}
		
		}
		$this->load->view('templates/footer');
	}
	public function update()
	{
		$access=0;
		foreach($this->data['functions'] as $f){
			if($f->user_function=="Works" && $f->edit==1){
				$access=1;
			}
		}
		if($access==0) show_404();
		$this->load->helper('form');
		$this->load->helper('file');
		$user=$this->session->userdata('logged_in');
		$this->data['user_id']=$user['user_id'];
		$this->data['grant']=$this->staff_model->get_grants(1);
		$this->data['user_departments']=$this->staff_model->get_user_departments(1);

		$this->data['title']="Update Projects";
		$this->data['projects']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions'],0);
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('project_id', 'Project Name',
		'trim|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('pages/update_project');
		}
		else{
			$this->data['facilities']=$this->staff_model->get_facilities($this->data['divisions']);
			$this->data['grants']=$this->staff_model->get_grants();
			$this->data['user_departments']=$this->staff_model->get_user_departments(1);
			$this->data['agencies']=$this->staff_model->get_agencies();
			$this->data['status_types']=$this->staff_model->get_status_types();
			$this->data['stages']=$this->staff_model->get_work_stages();
			if($this->input->post('selected_project')){
				$project_id = $this->input->post('selected_project');
			}
			else if($this->input->post('project_id')){
				$project_id=$this->input->post('project_id');
			}
			if(isset($project_id)){
				$this->data['expenses']=$this->staff_model->get_expenses($project_id);
				$this->data['targets']=$this->staff_model->get_targets($project_id);
				$this->data['images']=$this->staff_model->get_images($project_id);
			}
			if($this->input->post('update_status')){

				if($this->projects_model->update_status()){
				$this->data['msg']="Updated successfully!";
				}
				else{
				$this->data['msg']="Error in updating, please retry.";
				}
					
				$this->data['project']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
			}
			else if($this->input->post('update_expenses')){
	
				if($this->projects_model->update_expenses()==TRUE){
				$this->data['msg']="Updated successfully!";			
				$this->data['expenses']=$this->staff_model->get_expenses($project_id);
				}
				else{
				$this->data['msg']="Error in updating, please retry.";
				}	
				
				$this->data['project']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
			}
			else if($this->input->post('update_project')){	
				if($this->projects_model->update_project()==TRUE){
				$this->data['msg']="Updated successfully!";			
				}
				else{
				$this->data['msg']="Error in updating, please retry.";
				}	
				
				$this->data['project']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
			}
			else if($this->input->post('update_targets')){	
				if($this->projects_model->update_targets()==TRUE){
				$this->data['targets']=$this->staff_model->get_targets($project_id);
				$this->data['msg']="Updated successfully!";			
				}
				else{
				$this->data['msg']="Error in updating, please retry.";
				}	
				
				$this->data['project']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
			}
			if(!empty($_FILES['project_image']['name'])){		
				$this->data['project']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
						$config['upload_path'] = './assets/images/project_images/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '1000000000';
						$config['max_width']  = '11924';
						$config['max_height']  = '11768';
						$config['overwrite']  = TRUE;
						$ext = end(explode(".", strtolower($_FILES['project_image']['name'])));
						$config['file_name'] = "project_".$this->input->post('selected_project')."_".date("dmyhis").".".$ext;
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('project_image'))
						{
							echo $this->upload->display_errors();
						}
						else
						{	
							if($this->projects_model->update_image($config['file_name'])){
								$this->data['images']=$this->staff_model->get_images($project_id);
								$this->data['msg'] = "Updated image successfully!";
							}
							else{
								$this->data['msg'] = "Image could not be uploaded.";
							}

						}
			}
			if($this->input->post('remove_image')){
				$this->data['project']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
				$path_to_file = base_url().'assets/images/project_images/'.$this->input->post('remove_image_name');
				if($this->projects_model->remove_image($this->input->post('remove_image'),$path_to_file)) {
					
					$this->data['images']=$this->staff_model->get_images($project_id);
					$this->data['msg'] = "Image was removed successfully!";				
				}
				else{
					$this->data['msg']="Image could not be removed.";
				}
			}
			if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
				$this->data['targets']=$this->staff_model->get_targets($this->input->post('project_id'));
			}
			if($this->input->post('division_id') || $this->input->post('grant')){
				$this->data['projects']=$this->staff_model->get_projects($this->data['user_departments'],$this->data['divisions']);
			}	
			$this->load->view('pages/update_project',$this->data);
		}
		$this->load->view('templates/footer');
	}
	

}

