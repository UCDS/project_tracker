<?php 
class Reports_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_summary_districts(){
		$this->db->select("districts.latitude,districts.longitude,estimate_amount,agreement_amount,project_status,district_name,districts.district_id,
          SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) 'expenses',
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN project_status='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN project_status='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN project_status='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('facilities','facilities.facility_id=projects.facility_id')
		->join('divisions','facilities.division_id=divisions.division_id')
		->join('districts','divisions.district_id=districts.district_id')
		->join('project_expenses','projects.project_id=project_expenses.project_id','left')
		->group_by('districts.district_id')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_facility_type(){
		$this->db->select("facility_types.facility_type_id,facility_type,estimate_amount,agreement_amount,project_status,district_name,districts.district_id,
          SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) 'expenses',
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN project_status='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN project_status='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN project_status='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('facilities','facilities.facility_id=projects.facility_id')
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
		->join('divisions','facilities.division_id=divisions.division_id')
		->join('districts','divisions.district_id=districts.district_id')
		->join('project_expenses','projects.project_id=project_expenses.project_id','left')
		->group_by('facility_type')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_grant(){
		$this->db->select("grant_phase_id grant_id,phase_name grant_name,estimate_amount,agreement_amount,project_status,division,divisions.division_id,
          SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) 'expenses',
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN project_status='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN project_status='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN project_status='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('facilities','facilities.facility_id=projects.facility_id')
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
		->join('divisions','facilities.division_id=divisions.division_id')
		->join('districts','divisions.district_id=districts.district_id')
		->join('grant_phase','projects.grant_phase_id=grant_phase.phase_id')
		->join('project_expenses','projects.project_id=project_expenses.project_id','left')
		->group_by('grant_phase_id')
		->order_by('division','ASC')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
}
?>
