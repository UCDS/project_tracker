<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('reports_model');
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
	public function index(){
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Reports";
		$this->data['district_summary']=$this->reports_model->get_summary_districts();
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->view('pages/reports');
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function districts($district_id=0)
	{
		$access=0;
		foreach($this->data['functions'] as $f){
			if($f->user_function=="Reports - District" && $f->view==1){
				$access=1;
			}
		}
		if($access==0) show_404();
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="District Wise Summary Report";
		$this->load->view('templates/header',$this->data);
		$this->data['report_type']="districts";
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['districts']=$this->reports_model->get_summary_districts();

		$this->form_validation->set_rules('district_id', 'Distrct',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE && $district_id==0)
		{
			$this->load->view('pages/report_district_wise',$this->data);
		}
		else{

			if($this->input->post('month')){
				$this->data['projects']=$this->staff_model->get_projects($this->input->post('district_id'));
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('district_id')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$this->data);
			}
			else{
				$this->data['projects']=$this->staff_model->get_projects(-1,0,-1,-1,-1);
				$this->load->view('pages/report_detailed',$this->data);
			}

		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function divisions($division_id=0)
	{
		$access=0;
		foreach($this->data['functions'] as $f){
			if($f->user_function=="Reports - District" && $f->view==1){
				$access=1;
			}
		}
		if($access==0) show_404();
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Division Wise Summary Report";
		$this->data['report_type']="divisions";
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['districts']=$this->reports_model->get_summary_divisions();

		$this->form_validation->set_rules('division_id', 'Division',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE && $division_id==0)
		{
			$this->load->view('pages/report_division_wise',$this->data);
		}
		else{

			if($this->input->post('month')){
				$this->data['projects']=$this->staff_model->get_projects(-1,$this->input->post('division_id'));
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('division_id')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$this->data);
			}
			else{
				$this->data['projects']=$this->staff_model->get_projects(-1,0,-1,-1,-1);
				$this->load->view('pages/report_detailed',$this->data);
			}

		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function facility_types($facility_type=0)
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Facility Type wise Project Report";
		$this->data['report_type']="facility_types";
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['facility_types']=$this->reports_model->get_summary_facility_type();
		$this->data['district']=$this->staff_model->get_districts();

		$this->form_validation->set_rules('facility_type', 'facility type',
		'trim|xss_clean');
		if ($this->form_validation->run() === FALSE && $facility_type==0)
		{
			$this->load->view('pages/report_type_wise',$this->data);
		}
		else{

			if($this->input->post('month') && $this->input->post('year')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('facility_type') || $facility_type!=0 || $this->input->post('district_id') ){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$this->data);
			}
			else{
				$this->data['projects']=$this->staff_model->get_projects(-1,-1,0,-1,-1);
				$this->load->view('pages/report_detailed',$this->data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function grants($grant=0)
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Grant wise Summary Report";
		$this->data['report_type']="grants";
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['grants']=$this->reports_model->get_summary_grant();
		$this->data['district']=$this->staff_model->get_districts();

		$this->form_validation->set_rules('grant', 'Grant',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE && $grant==0)
		{
			$this->load->view('pages/report_grant_wise',$this->data);
		}
		else{

			if($this->input->post('month') && $this->input->post('year')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('grant') || $grant!=0  || $this->input->post('district_id')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$this->data);
			}
			else{
				$this->data['projects']=$this->staff_model->get_projects(-1,-1,-1,-1,0);
				$this->load->view('pages/report_detailed',$this->data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function agencies($agency=0)
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Agency wise Project Report";
		$this->data['report_type']="agencies";
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['agencies']=$this->reports_model->get_summary_agency();
		$this->data['district']=$this->staff_model->get_districts();

		$this->form_validation->set_rules('agency', 'Agency',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE && $agency==0)
		{
			$this->load->view('pages/report_agency_wise',$this->data);
		}
		else{

			if($this->input->post('month') && $this->input->post('year')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('agency') || $agency!=0  || $this->input->post('district_id')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$this->data);
			}
			else{
				$this->data['projects']=$this->staff_model->get_projects(-1,-1,-1,0,-1);
				$this->load->view('pages/report_detailed',$this->data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function user_departments($user_department=0)
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="User Department wise Summary Report";
		$this->data['report_type']="user_departments";
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data['user_departments']=$this->reports_model->get_summary_user_department();
		$this->data['district']=$this->staff_model->get_districts();

		$this->form_validation->set_rules('user_department', 'User Department',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE && $user_department==0)
		{
			$this->load->view('pages/report_user_department_wise',$this->data);
		}
		else{

			if($this->input->post('month') && $this->input->post('year')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('user_department') || $user_department!=0  || $this->input->post('district_id')){
				$this->data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_detailed',$this->data);
			}
			else if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$this->data);
			}
			else{
				$this->data['projects']=$this->staff_model->get_projects(-1,-1,-1,-1,-1,0);
				$this->load->view('pages/report_detailed',$this->data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
	public function projects()
	{
		if($this->session->userdata('logged_in')){
		$this->data['userdata']=$this->session->userdata('logged_in');
		$this->data['title']="Project Detailed Report";
		$this->load->view('templates/header',$this->data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('project_id', 'Project',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$this->data['projects']=$this->staff_model->get_projects();
			$this->load->view('pages/report_projects',$this->data);
		}
		else{
			if($this->input->post('project_id')){
				$this->data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$this->data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
}

