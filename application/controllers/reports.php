<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('reports_model');
		$this->load->model('staff_model');
	}
	public function index(){
		if($this->session->userdata('logged_in')){
		$data['userdata']=$this->session->userdata('logged_in');
		$data['title']="Reports";
		$data['district_summary']=$this->reports_model->get_summary_districts();
		$this->load->view('templates/header',$data);
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
		if($this->session->userdata('logged_in')){
		$data['userdata']=$this->session->userdata('logged_in');
		$data['title']="District Wise Summary Report";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['districts']=$this->reports_model->get_summary_districts();

		$this->form_validation->set_rules('district_id', 'Distrct',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE && $district_id==0)
		{
			$this->load->view('pages/report_district_wise',$data);
		}
		else{

			if($this->input->post('month')){
				$data['projects']=$this->staff_model->get_projects($this->input->post('district_id'));
				$this->load->view('pages/report_district_detailed',$data);
			}
			else if($this->input->post('district_id') || $district_id!=0 ){
				if($district_id!=0){
				$data['projects']=$this->staff_model->get_projects($district_id);
				}
				else{
				$data['projects']=$this->staff_model->get_projects($this->input->post('district_id'));
				}
				$this->load->view('pages/report_district_detailed',$data);
			}
			else if($this->input->post('project_id')){
				$data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$data);
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
		$data['userdata']=$this->session->userdata('logged_in');
		$data['title']="facility type wise Summary Report";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['facility_types']=$this->reports_model->get_summary_facility_type();
		$data['district']=$this->staff_model->get_districts();

		$this->form_validation->set_rules('facility_type', 'facility type',
		'trim|xss_clean');
		if ($this->form_validation->run() === FALSE && $facility_type==0)
		{
			$this->load->view('pages/report_type_wise',$data);
		}
		else{

			if($this->input->post('month') && $this->input->post('year')){
				$data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_facility_type_detailed',$data);
			}
			else if($this->input->post('facility_type') || $facility_type!=0 || $this->input->post('district_id') ){
				$data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_facility_type_detailed',$data);
			}
			else if($this->input->post('project_id')){
				$data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$data);
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
		$data['userdata']=$this->session->userdata('logged_in');
		$data['title']="Grant wise Summary Report";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$data['grants']=$this->reports_model->get_summary_grant();
		$data['district']=$this->staff_model->get_districts();

		$this->form_validation->set_rules('grant', 'Grant',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE && $grant==0)
		{
			$this->load->view('pages/report_grant_wise',$data);
		}
		else{

			if($this->input->post('month') && $this->input->post('year')){
				$data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_grant_detailed',$data);
			}
			else if($this->input->post('grant') || $grant!=0  || $this->input->post('district_id')){
				$data['projects']=$this->staff_model->get_projects();
				$this->load->view('pages/report_grant_detailed',$data);
			}
			else if($this->input->post('project_id')){
				$data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$data);
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
		$data['userdata']=$this->session->userdata('logged_in');
		$data['title']="Project Detailed Report";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/left_nav');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('project_id', 'Project',
		'trim|required|xss_clean');
		if ($this->form_validation->run() === FALSE)
		{
			$data['projects']=$this->staff_model->get_projects();
			$this->load->view('pages/report_projects',$data);
		}
		else{
			if($this->input->post('project_id')){
				$data['project']=$this->staff_model->get_projects();
				$this->load->view('pages/report_project_detailed',$data);
			}
		}
		$this->load->view('templates/footer');
		}
		else{
		show_404();
		}
	}
}

