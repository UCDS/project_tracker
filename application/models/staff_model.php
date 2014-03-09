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
	function get_districts(){
		$this->db->select("district_id,district_name")->from("districts");
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
	function get_grants(){
		$this->db->select("phase_id,phase_name")->from("grant_phase")->join('grants','grant_phase.grant_id=grants.grant_id')->order_by('phase_name');
		$query=$this->db->get();
		return $query->result();
	}
	function get_grant_sources(){
		$this->db->select("*")->from("grant_sources")->order_by('grant_source');
		$query=$this->db->get();
		return $query->result();
	}
	
	
	function get_projects($district_id=0,$facility_type=""){
		if($this->input->post('project_id') || $this->input->post('selected_project')){
			if($this->input->post('project_id')) $project_id=$this->input->post('project_id');
			else if($this->input->post('selected_project')) $project_id=$this->input->post('selected_project');
			$this->db->where('projects.project_id',$project_id);
		}
		if($district_id!=0){
			$this->db->where('districts.district_id',$district_id);
		}
		if($this->input->post('district_id')){
			$this->db->where('districts.district_id',$this->input->post('district_id'));
		}
		if($facility_type!="" || $this->input->post('facility_type')){
				if($this->input->post('facility_type')) $facility_type=$this->input->post('facility_type');
				$this->db->where('facilities.facility_type_id',$facility_type);
		}
		if($this->input->post('grant')){
				$this->db->where('grant_phase_id',$this->input->post('grant'));
		}
		if($this->input->post('month')){
			$month=$this->input->post('month');
			$year=$this->input->post('year');
		}
		else{
			$month="MONTH(CURDATE())";
			$year="YEAR(CURDATE())";
		}
		$this->db->select("		SUM(CASE WHEN month(project_expenses.expense_date)<$month AND YEAR(project_expenses.expense_date)<=$year THEN expense_amount ELSE 0 END) expense_upto_last_month,
		SUM(CASE WHEN month(project_expenses.expense_date)=$month AND YEAR(project_expenses.expense_date)=$year THEN expense_amount ELSE 0 END) expense_current_month,
		SUM(CASE WHEN month(project_expenses.expense_date)<=$month AND YEAR(project_expenses.expense_date)<=$year THEN expense_amount ELSE 0 END) expenses,
		projects.*,districts.*,divisions.*,grant_phase.*,facilities.*,facility_type,project_status.*,sanctions.*,status_types.*");
		$this->db->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('status_types','project_status.status_type_id=status_types.status_type_id')
		->join('sanctions','projects.project_id=sanctions.project_id')
		->join('facilities','projects.facility_id=facilities.facility_id')
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
		->join('divisions','facilities.division_id=divisions.division_id')
		->join('districts','divisions.district_id=districts.district_id')
		->join('grant_phase','projects.grant_phase_id=grant_phase.phase_id')
		->join('project_expenses','projects.project_id=project_expenses.project_id','left');
		$this->db->group_by('projects.project_id')
		->order_by('division,facility_type','ASC');
		$this->db->where('current',1);
		if($query=$this->db->get()){
			return $query->result();
		}
		else{ return false;}
	}
}
?>
