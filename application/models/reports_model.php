<?php 
class Reports_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_summary_districts(){
		if($this->input->post('state_submit') && $this->input->post('state')!=""){
			$this->db->where('state',$this->input->post('state'));
		}
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year=date("Y",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		
		$this->db->select("districts.latitude,districts.longitude,
		SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
		status_type AS project_status,district_name,districts.district_id,SUM(expenses_last_year) expenses_last_year,SUM(expenses_current_year) expenses_current_year,targets_current_year,
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
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date<'$year'  THEN expense_amount ELSE 0 END) expenses_last_year,
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date>='$year' AND expense_date<'$year_end'  THEN expense_amount ELSE 0 END) expenses_current_year
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN target_amount!=0 AND target_amount!='' AND target_amount IS NOT NULL AND projection_month>='$year' AND projection_month<'$year_end'  THEN target_amount ELSE 0 END) targets_current_year
			 FROM project_targets WHERE current=1 GROUP BY project_id) table_targets" ,'projects.project_id=table_targets.project_id','left')
			 ->group_by('districts.district_id')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_divisions(){
		if($this->input->post('state_submit') && $this->input->post('state')!=""){
			$this->db->where('state',$this->input->post('state'));
		}
		
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year=date("Y",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		$this->db->select("divisions.latitude,divisions.longitude,
		SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
		status_type AS project_status,division,divisions.division_id,SUM(expenses_last_year) expenses_last_year,SUM(expenses_current_year) expenses_current_year,SUM(targets_current_year) targets_current_year,
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
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date<'$year'  THEN expense_amount ELSE 0 END) expenses_last_year,
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date>='$year' AND expense_date<'$year_end'  THEN expense_amount ELSE 0 END) expenses_current_year
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN target_amount!=0 AND target_amount!='' AND target_amount IS NOT NULL AND projection_month>='$year' AND projection_month<'$year_end'  THEN target_amount ELSE 0 END) targets_current_year
			 FROM project_targets WHERE current=1  GROUP BY project_id) table_targets" ,'projects.project_id=table_targets.project_id','left')
			 ->group_by('divisions.division_id')
		->where('current',1)
		->order_by('divisions.district_id,division','ASC');
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_facility_type(){
		if($this->input->post('state_submit') && $this->input->post('state')!=""){
			$this->db->where('state',$this->input->post('state'));
		}
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year=date("Y",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		
		$this->db->select("facility_types.facility_type_id,facility_type,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
		SUM(expenses_last_year) expenses_last_year,SUM(expenses_current_year) expenses_current_year,SUM(targets_current_year) targets_current_year,
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
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date<'$year'  THEN expense_amount ELSE 0 END) expenses_last_year,
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date>='$year' AND expense_date<'$year_end'  THEN expense_amount ELSE 0 END) expenses_current_year
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN target_amount!=0 AND target_amount!='' AND target_amount IS NOT NULL AND projection_month>='$year' AND projection_month<'$year_end'  THEN target_amount ELSE 0 END) targets_current_year
			 FROM project_targets WHERE current=1 GROUP BY project_id) table_targets" ,'projects.project_id=table_targets.project_id','left')
			 ->group_by('facility_type_id')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_grant(){
		if($this->input->post('state_submit') && $this->input->post('state')!=""){
			$this->db->where('state',$this->input->post('state'));
		}
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year=date("Y",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		
		$this->db->select("grant_phase_id grant_id,phase_name grant_name,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
			SUM(expenses_last_year) expenses_last_year,SUM(expenses_current_year) expenses_current_year,SUM(targets_current_year) targets_current_year,          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN status_type='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN status_type='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN status_type='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id','left')
		->join('status_types','project_status.status_type_id=status_types.status_type_id','left')
		->join('grant_phase','projects.grant_phase_id=grant_phase.phase_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join('facilities','facilities.facility_id=projects.facility_id','left')
		->join('divisions','facilities.division_id=divisions.division_id','left')
		->join('districts','divisions.district_id=districts.district_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date<'$year'  THEN expense_amount ELSE 0 END) expenses_last_year,
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date>='$year' AND expense_date<'$year_end'  THEN expense_amount ELSE 0 END) expenses_current_year
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN target_amount!=0 AND target_amount!='' AND target_amount IS NOT NULL AND projection_month>='$year' AND projection_month<'$year_end'  THEN target_amount ELSE 0 END) targets_current_year
			 FROM project_targets WHERE current=1 GROUP BY project_id) table_targets" ,'projects.project_id=table_targets.project_id','left')
		->group_by('grant_phase_id')
		->order_by('phase_name','ASC')
		->where('current',1);
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_agency(){
		if($this->input->post('state_submit') && $this->input->post('state')!=""){
			$this->db->where('state',$this->input->post('state'));
		}
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year=date("Y",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		
		$this->db->select("projects.agency_id,agency_name,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
		SUM(expenses_last_year) expenses_last_year,SUM(expenses_current_year) expenses_current_year,SUM(targets_current_year) targets_current_year,
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
		->join('facilities','facilities.facility_id=projects.facility_id','left')
		->join('divisions','facilities.division_id=divisions.division_id','left')
		->join('districts','divisions.district_id=districts.district_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date<'$year'  THEN expense_amount ELSE 0 END) expenses_last_year,
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date>='$year' AND expense_date<'$year_end'  THEN expense_amount ELSE 0 END) expenses_current_year
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN target_amount!=0 AND target_amount!='' AND target_amount IS NOT NULL AND projection_month>='$year' AND projection_month<'$year_end'  THEN target_amount ELSE 0 END) targets_current_year
			 FROM project_targets WHERE current=1 GROUP BY project_id) table_targets" ,'projects.project_id=table_targets.project_id','left')
		->group_by('agency_id')
		->where('current',1)
		->order_by('agency_name','ASC');
		$query=$this->db->get();
		return $query->result();
	}
	function get_summary_user_department(){
		if($this->input->post('state_submit') && $this->input->post('state')!=""){
			$this->db->where('state',$this->input->post('state'));
		}
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year=date("Y",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		
		$this->db->select("projects.user_department_id,user_department,SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
		SUM(expenses_last_year) expenses_last_year,SUM(expenses_current_year) expenses_current_year,SUM(targets_current_year) targets_current_year,
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
		->join('facilities','facilities.facility_id=projects.facility_id','left')
		->join('divisions','facilities.division_id=divisions.division_id','left')
		->join('districts','divisions.district_id=districts.district_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date<'$year'  THEN expense_amount ELSE 0 END) expenses_last_year,
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date>='$year' AND expense_date<'$year_end'  THEN expense_amount ELSE 0 END) expenses_current_year
			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN target_amount!=0 AND target_amount!='' AND target_amount IS NOT NULL AND projection_month>='$year' AND projection_month<'$year_end'  THEN target_amount ELSE 0 END) targets_current_year
			 FROM project_targets WHERE current=1 GROUP BY project_id) table_targets" ,'projects.project_id=table_targets.project_id','left')
		->group_by('user_department_id')
		->where('current',1)
		->order_by('user_department','ASC');
		$query=$this->db->get();
		return $query->result();
	}
}
?>
