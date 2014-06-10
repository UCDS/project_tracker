<?php 
class Reports_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_summary_districts(){
		$this->db->select("districts.latitude,districts.longitude,
		SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
		status_type AS project_status,district_name,districts.district_id,SUM(expenses) expenses,
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN status_type='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN status_type='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN status_type='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('status_types','project_status.status_type_id=status_types.status_type_id')
		->join('facilities','facilities.facility_id=projects.facility_id','left')
		->join('divisions','facilities.division_id=divisions.division_id','left')
		->join('districts','divisions.district_id=districts.district_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) expenses
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
			 ->group_by('districts.district_id')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_facility_type(){
		$this->db->select("facility_types.facility_type_id,facility_type,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,SUM(expenses) expenses,
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN status_type='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN status_type='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN status_type='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('status_types','project_status.status_type_id=status_types.status_type_id')
		->join('facilities','facilities.facility_id=projects.facility_id','left')
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) expenses
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
			 ->group_by('facility_type')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_grant(){
		$this->db->select("grant_phase_id grant_id,phase_name grant_name,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
          SUM(expenses) expenses,
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN status_type='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN status_type='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN status_type='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id','left')
		->join('status_types','project_status.status_type_id=status_types.status_type_id','left')
		->join('grant_phase','projects.grant_phase_id=grant_phase.phase_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) expenses
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->group_by('grant_phase_id')
		->order_by('phase_name','ASC')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_agency(){
		$this->db->select("projects.agency_id,agency_name,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,SUM(expenses) expenses,
         
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN status_type='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN status_type='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN status_type='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('status_types','project_status.status_type_id=status_types.status_type_id')
		->join('agency','projects.agency_id=agency.agency_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) expenses
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->group_by('agency_id')
		->where('current',1)
		->order_by('agency_name','ASC');
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_user_department(){
		$this->db->select("projects.user_department_id,user_department,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,SUM(expenses) expenses,
         
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN status_type='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN status_type='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN status_type='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('status_types','project_status.status_type_id=status_types.status_type_id')
		->join('user_departments','projects.user_department_id=user_departments.user_department_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount=0 OR expense_amount='' OR expense_amount<=>NULL  THEN 0 ELSE expense_amount END) expenses
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->group_by('user_department_id')
		->where('current',1)
		->order_by('user_department','ASC');
		$query=$this->db->get();
		return $query->result();
	}
}
?>
