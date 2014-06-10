<?php 
class Staff_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function login($username, $password){
	   $this -> db -> select('users.user_id,username,district_id');
	   $this -> db -> from('users');
	   $this -> db -> join('user_district_link','users.user_id=user_district_link.user_id','left');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	 
	   $query = $this -> db -> get();
	   if($query -> num_rows() > 0)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	}
	function get($type){
		if($type=="facility"){
			if($this->input->post('facility_id')){
				$facility_id=$this->input->post('facility_id');
				$this->db->where('facility_id',$facility_id);
			}
			if($this->input->post('search_facility_type')){
				$facility_type=$this->input->post('search_facility_type');
				$this->db->where('facility_types.facility_type_id',$facility_type);
			}
			if($this->input->post('search_division')){
				$division=$this->input->post('search_division');
				$this->db->where('divisions.division_id',$division);
			}
			if($this->input->post('search_facility_name')){
				$name=strtolower($this->input->post('search_facility_name'));
				$this->db->like('LOWER(facility_name)',$name,'after');
			}
			$this->db->select("facility_id,facility_types.facility_type_id,facility_name,facilities.longitude,facilities.latitude,facility_type,division,divisions.division_id")->from("facilities")
			->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
			->join('divisions','facilities.division_id=divisions.division_id')
			->order_by('facility_name');	
		}

		$query=$this->db->get();
		return $query->result();
	}
	function get_districts($projects=-1){
		if($this->input->post('facility_type') || $this->input->post('grant') || $projects==1){
			$this->db->select("districts.district_id,district_name")->from('districts')
			->join('divisions','districts.district_id=divisions.district_id')
			->join('facilities','divisions.division_id=facilities.division_id')
			->join('projects','facilities.facility_id=projects.facility_id');
		}
		else
		$this->db->select("district_id,district_name")->from("districts");
		$this->db->order_by('district_name');
		$query=$this->db->get();
		return $query->result();
	}
	function get_divisions(){
		$this->db->select("division_id,division")->from("divisions")->order_by('division');
		$query=$this->db->get();
		return $query->result();
	}
	function get_facilities(){
		if($this->input->post('facility_id')){
			$facility_id=$this->input->post('facility_id');
			$this->db->where('facility_id',$facility_id);
		}
		if($this->input->post('search_facility_type')){
			$facility_type=$this->input->post('search_facility_type');
			$this->db->where('facility_types.facility_type_id',$facility_type);
		}
		if($this->input->post('search_division')){
			$division=$this->input->post('search_division');
			$this->db->where('divisions.division_id',$division);
		}
		if($this->input->post('search_facility_name')){
			$name=strtolower($this->input->post('search_facility_name'));
			$this->db->like('LOWER(facility_name)',$name,'after');
		}
		$this->db->select("facility_id,facility_types.facility_type_id,facility_name,facilities.longitude,facilities.latitude,facility_type,division,divisions.division_id")->from("facilities")
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
		->join('divisions','facilities.division_id=divisions.division_id')
		->order_by('facility_name');
		$query=$this->db->get();
		return $query->result();
	}
	function get_facility_types(){
		$this->db->select("facility_type_id,facility_type")->from("facility_types")->order_by('facility_type');
		$query=$this->db->get();
		return $query->result();
	}
	function get_agencies(){
		$this->db->select("agency_id,agency_name")->from("agency")->order_by('agency_name');
		$query=$this->db->get();
		return $query->result();
	}
	function get_grants($projects=-1){
		if($this->input->post('grant') || $projects==1){
			$this->db->select("*")->from('grants')
			->join('grant_phase','grants.grant_id=grant_phase.grant_id')
			->join('projects','grant_phase.phase_id=projects.grant_phase_id');
			if($this->input->post('facility_type'))
			$this->db->where('facility_type_id',$this->input->post('facility_type'));
			else if($this->input->post('district'))
			$this->db->where('district_id',$this->input->post('district'));
		}
		else{
		$this->db->select("phase_id,phase_name")->from("grant_phase")->join('grants','grant_phase.grant_id=grants.grant_id')->order_by('phase_name');
		}
		$query=$this->db->get();
		return $query->result();
	}
	function get_user_departments(){
		$this->db->select("*")->from("user_departments")->order_by('user_department');
		$query=$this->db->get();
		return $query->result();
	}
	function get_grant_sources(){
		$this->db->select("*")->from("grant_sources")->order_by('grant_source');
		$query=$this->db->get();
		return $query->result();
	}
	function get_status_types(){
		$this->db->select("*")->from("status_types")->order_by('status_type_id');
		$query=$this->db->get();
		return $query->result();
	}
	function get_work_stages(){
		$this->db->select("*")->from("work_stages")->order_by('status_type_id');
		$query=$this->db->get();
		return $query->result();
	}
	function get_expenses($project_id){
		$this->db->select("*")->from("project_expenses")->where('project_id',$project_id)->order_by('expense_id');
		$query=$this->db->get();
		return $query->result();
	}
	
	
	function get_projects($district_id=-1,$facility_type=-1,$agency_id=-1,$grant=-1,$user_department=-1){
		if($this->input->post('project_id') || $this->input->post('selected_project')){
			if($this->input->post('project_id')) $project_id=$this->input->post('project_id');
			else if($this->input->post('selected_project')) $project_id=$this->input->post('selected_project');
			$this->db->where('projects.project_id',$project_id);
		}
		if($district_id!=-1 || $facility_type!=-1){
			if($district_id==0){
			$this->db->where('projects.facility_id',0);
			}
			else{
				$this->db->where('districts.district_id',$district_id);
			}
		}
		if($this->input->post('district_id')){
			$this->db->where('districts.district_id',$this->input->post('district_id'));
		}
		if($facility_type!=-1 || $this->input->post('facility_type')){
				if($this->input->post('facility_type')) $facility_type=$this->input->post('facility_type');
				$this->db->where('facilities.facility_type_id',$facility_type);
		}
		if($this->input->post('grant')){
				$this->db->where('grant_phase_id',$this->input->post('grant'));
		}
		if($this->input->post('agency')){
				$this->db->where('projects.agency_id',$this->input->post('agency'));
		}
		if($this->input->post('user_department')){
				$this->db->where('projects.user_department_id',$this->input->post('user_department'));
		}
		if($agency_id!=-1){
				$this->db->where('projects.agency_id',0);
		}
		if($user_department!=-1){
				$this->db->where('projects.user_department_id',0);
		}
		if($grant!=-1){
				$this->db->where('projects.grant_phase_id',0);
		}
		if($this->input->post('month')){
			$month=$this->input->post('month');
			$year=$this->input->post('year');
		}
		else{
			$month="MONTH(CURDATE())";
			$year="YEAR(CURDATE())";
		}
		$this->db->select("expense_upto_last_month,expense_current_month,expenses,
		projects.*,districts.*,divisions.*,grant_phase.*,facilities.*,facility_type,project_status.*,sanctions.*,status_types.*,work_stages.stage_id,work_stages.stage,work_stages.status_type_id as status_id,agency.*,user_departments.*");
		$this->db->from("projects")
		->join('agency','projects.agency_id=agency.agency_id','left')
		->join('project_status','projects.project_id=project_status.project_id')
		->join('status_types','project_status.status_type_id=status_types.status_type_id','left')
		->join('work_stages','project_status.stage_id=work_stages.stage_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join('facilities','projects.facility_id=facilities.facility_id','left')
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id','left')
		->join('divisions','facilities.division_id=divisions.division_id','left')
		->join('districts','divisions.district_id=districts.district_id','left')
		->join('grant_phase','projects.grant_phase_id=grant_phase.phase_id','left')
		->join('user_departments','projects.user_department_id=user_departments.user_department_id','left')
		->join("(SELECT project_id,SUM(CASE WHEN (month(project_expenses.expense_date)<$month AND YEAR(project_expenses.expense_date)=$year) OR (YEAR(project_expenses.expense_date)<$year)  THEN expense_amount ELSE 0 END) expense_upto_last_month,
		SUM(CASE WHEN month(project_expenses.expense_date)=$month AND YEAR(project_expenses.expense_date)=$year THEN expense_amount ELSE 0 END) expense_current_month,
		SUM(CASE WHEN (month(project_expenses.expense_date)<=$month AND YEAR(project_expenses.expense_date)<=$year) OR (YEAR(project_expenses.expense_date)<$year) THEN expense_amount ELSE 0 END) expenses
		FROM project_expenses GROUP BY project_id) table_expenses",'projects.project_id=table_expenses.project_id','left');
		$this->db->group_by('projects.project_id')
		->order_by('grant_phase_id,facility_type','ASC');
		$this->db->where('current',1);
		if($query=$this->db->get()){
			return $query->result();
		}
		else{ return false;}
	}
}
?>
