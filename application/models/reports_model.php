<?php 
class Reports_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_summary_report($type,$user_departments=0,$states=0,$divisions=-1){
		if($this->input->post('state_submit') && $this->input->post('state')!=""){
			$this->db->where('state',$this->input->post('state'));
		}
		
		if($user_departments!=0 && $user_departments!='0' && count($user_departments)>0){
			$ud_id=array();
			foreach($user_departments as $ud){
				$ud_id[] = $ud->user_department_id;
			}
			$this->db->where_in('projects.user_department_id',$ud_id);
			if($divisions!=-1 && count($divisions)>0){
			$division_list=array();
			foreach($divisions as $d){
				$division_list[]=$d->division_id;
			}
			$this->db->where_in('divisions.division_id',$division_list);
			}
		}
		if($states!=0 && $states!='0' && count($states)>0){
			$state_id=array();
			foreach($states as $state){
				$state_id[] = $state->state_id;
			}
			$this->db->where_in('districts.state_id',$state_id);
		}
		if($this->input->post('month')){
			$month=$this->input->post('month');
			$year=$this->input->post('year');
		}
		else{
			$month="MONTH(CURDATE())";
			$year="YEAR(CURDATE())";
		}
		$year_start=date("Y-m-d",strtotime("April 1"));
		$year_current=date("Y-m-d");
		if($year_current>=$year_start){ $year_start=date("Y-m-d",strtotime($year_start)); $year_end=date("Y-m-d",strtotime("March 31 Next year")); }
		else { $year_start=date("Y-m-d",strtotime("April 1 Last year")); $year_end=date("Y-m-d",strtotime("March 31")); }
		$this->db->select("districts.latitude,districts.longitude,
		SUM(admin_sanction_amount) admin_sanction_amount,SUM(tech_sanction_amount) tech_sanction_amount,SUM(agreement_amount) agreement_amount,
		SUM(expenses_last_year) expenses_last_year,SUM(expenses_current_year) expenses_current_year,SUM(targets_current_year) targets_current_year,SUM(expense_current_month) expense_current_month,
		SUM(target_current_month) target_current_month, SUM(targets_total_year) targets_total_year,SUM(bills_pending) bills_pending,
          SUM(CASE WHEN 1  THEN 1 ELSE 0 END) 'total_projects',
          SUM(CASE WHEN status_type='Not Started'  THEN 1 ELSE 0 END) 'not_started',
          SUM(CASE WHEN status_type='Work in Progress'  THEN 1 ELSE 0 END) 'work_in_progress',
          SUM(CASE WHEN status_type='Work completed'  THEN 1 ELSE 0 END) 'work_completed',
          SUM(CASE WHEN work_type_id='M'  THEN 1 ELSE 0 END) 'medical',
          SUM(CASE WHEN work_type_id='N'  THEN 1 ELSE 0 END) 'non_medical'")->from("projects")
		->join('project_status','projects.project_id=project_status.project_id')
		->join('status_types','project_status.status_type_id=status_types.status_type_id')
		->join('facilities','facilities.facility_id=projects.facility_id','left')
		->join('facility_types','facilities.facility_type_id=facility_types.facility_type_id')
		->join('divisions','facilities.division_id=divisions.division_id')
		->join('districts','divisions.district_id=districts.district_id')
		->join('user_departments','projects.user_department_id=user_departments.user_department_id','left')
		->join('agency','projects.agency_id=agency.agency_id','left')
		->join('grant_phase','projects.grant_phase_id=grant_phase.phase_id','left')
		->join('sanctions','projects.project_id=sanctions.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN expense_amount!=0 AND expense_amount!='' AND expense_amount IS NOT NULL AND expense_date<'$year_start'  THEN expense_amount ELSE 0 END) expenses_last_year,
			 SUM(CASE WHEN expense_amount!=0 AND expense_date>='$year_start' AND YEAR(expense_date) <= YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
				AND MONTH(expense_date) <= MONTH(CURRENT_DATE - INTERVAL 1 MONTH)  THEN expense_amount ELSE 0 END) expenses_current_year,
			SUM(CASE WHEN month(project_expenses.expense_date)=$month AND YEAR(project_expenses.expense_date)=$year THEN expense_amount ELSE 0 END) expense_current_month,
			SUM(CASE WHEN ((month(project_expenses.expense_date)<$month AND YEAR(project_expenses.expense_date)=$year) OR (YEAR(project_expenses.expense_date)<$year)) AND expense_date>='$year_start'  THEN expense_amount ELSE 0 END) expense_upto_last_month

			 FROM project_expenses GROUP BY project_id) table_expenses" ,'projects.project_id=table_expenses.project_id','left')
		->join("(SELECT project_id, 
			 SUM(CASE WHEN target_amount!=0 AND projection_month>='$year_start' AND YEAR(projection_month)<=YEAR(CURRENT_DATE-INTERVAL 1 MONTH)
				AND MONTH(projection_month)<=MONTH(CURRENT_DATE-INTERVAL 1 MONTH) THEN target_amount ELSE 0 END) targets_current_year,
			 SUM(CASE WHEN target_amount!=0 AND projection_month>='$year_start' AND projection_month<'$year_end' THEN target_amount ELSE 0 END) targets_total_year,
			SUM(CASE WHEN month(project_targets.projection_month)=$month AND YEAR(project_targets.projection_month)=$year THEN target_amount ELSE 0 END) target_current_month
			 FROM project_targets WHERE current=1  GROUP BY project_id) table_targets" ,'projects.project_id=table_targets.project_id','left')
		->join("(SELECT project_id, 
			 SUM(bill_amount) bills_pending
			 FROM project_bills WHERE active=1  GROUP BY project_id) table_bills" ,'projects.project_id=table_bills.project_id','left')
		->where('current',1)
		->order_by('divisions.district_id,division','ASC');
		switch($type){
			case "divisions" :
					$this->db->select('division,divisions.division_id');
					 $this->db->group_by('divisions.division_id');
					 break;
			case "districts" :
					$this->db->select('district_name,districts.district_id');
					$this->db->group_by('districts.district_id');
					break;
			case "facility_types" :
					$this->db->select('facility_type,facility_types.facility_type_id');
					$this->db->group_by('facility_types.facility_type_id');
					break;
			case "facilities" :
					$this->db->select('facility_name,facilities.facility_id');
					$this->db->group_by('facilities.facility_id');
					break;
			case "user_departments" :
					$this->db->select('user_department,user_departments.user_department_id');
					$this->db->group_by('user_departments.user_department_id');
					break;
			case "schemes" :
					$this->db->select('phase_name,grant_phase.phase_id');
					$this->db->group_by('grant_phase.phase_id');
					break;
			case "agencies" :
					$this->db->select('agency_name,agency.agency_id');
					$this->db->group_by('agency.agency_id');
					break;
			default : return false;
		}
		$query=$this->db->get();
		return $query->result();
	}}
?>
