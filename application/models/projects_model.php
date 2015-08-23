<?php 
class Projects_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function create_project(){
		$project_name=$this->input->post('project_name');
		$facility=$this->input->post('facility');
		$ref_admin=$this->input->post('ref_admin');
		$admin_amount=$this->input->post('admin_amount');
		$ref_tech=$this->input->post('ref_tech');
		$tech_amount=$this->input->post('tech_amount');
		$address=$this->input->post('project_address');
		$agreement_id=$this->input->post('agreement_number');
		$estimate_amount=$this->input->post('admin_amount');
		$agreement_amount=$this->input->post('agreement_amount');
		if($this->input->post('agreement_date')) $agreement_date=date("Y-m-d",strtotime($this->input->post('agreement_date')));
		else $agreement_date=0;
		if($this->input->post('agreement_completion_date')) $agreement_completion_date=date("Y-m-d",strtotime($this->input->post('agreement_completion_date')));
		else $agreement_completion_date = 0;
		$grant=$this->input->post('grant');
		$user_department=$this->input->post('user_department');
		$agency=$this->input->post('agency');
		$work_type=$this->input->post('work_type');
		$staff=$this->input->post('staff');
		$data=array(
			'project_name'=>$project_name,
			'project_address'=>$address,
			'facility_id'=>$facility,
			'agreement_id'=>$agreement_id,
			'agreement_amount'=>$agreement_amount,
			'agreement_date'=>$agreement_date,
			'agreement_completion_date'=>$agreement_completion_date,
			'grant_phase_id'=>$grant,
			'user_department_id'=>$user_department,
			'agency_id'=>$agency,
			'work_type_id'=>$work_type,
			'staff_id'=>$staff
			);
		$this->db->trans_start();
		$this->db->insert('projects',$data);
		$project_id=$this->db->insert_id();
		$status_data=array(
		'project_id'=>$project_id,
		'status_type_id'=>'1',
		'probable_date_of_completion'=>$this->input->post('probable_date_of_completion'),
		'current'=>1
		);

		$sanction_data=array(
			'admin_sanction_id'=>$ref_admin,
			'admin_sanction_amount'=>$admin_amount,
			'tech_sanction_id'=>$ref_tech,
			'tech_sanction_amount'=>$tech_amount,
			'project_id'=>$project_id
		);	
		$this->db->insert('project_status',$status_data);
		$this->db->insert('sanctions',$sanction_data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){	
			return false;
		}
		else{
		return true;
		}
	}
	
	function update_project(){
		$project_name=$this->input->post('project_name');
		$work_type=$this->input->post('work_type');
		$facility_id=$this->input->post('facility');
		$address=$this->input->post('project_address');
		$ref_admin=$this->input->post('ref_admin');
		$admin_amount=$this->input->post('admin_amount');
		$ref_tech=$this->input->post('ref_tech');
		$tech_amount=$this->input->post('tech_amount');
		if($this->input->post('agreement_date')) $agreement_date=date("Y-m-d",strtotime($this->input->post('agreement_date'))); else $agreement_date=0;
		$agreement_amount=$this->input->post('agreement_amount');
		$agreement_number=$this->input->post('agreement_number');
		if($this->input->post('agreement_completion_date')) $agreement_completion_date=date("Y-m-d",strtotime($this->input->post('agreement_completion_date')));else $agreement_completion_date=0;
		$grant_phase_id=$this->input->post('grant');
		$user_department=$this->input->post('user_department');
		$agency=$this->input->post('agency');
		$project_id=$this->input->post('selected_project');
		$staff=$this->input->post('staff');
		
		$project_data=array(
		'project_name'=>$project_name,
		'facility_id'=>$facility_id,
		'project_address'=>$address,
		'agreement_id'=>$agreement_number,
		'agreement_date'=>$agreement_date,
		'agreement_amount'=>$agreement_amount,
		'agreement_completion_date'=>$agreement_completion_date,
		'grant_phase_id'=>$grant_phase_id,
		'user_department_id'=>$user_department,
		'agency_id'=>$agency,
		'work_type_id'=>$work_type,
		'staff_id'=>$staff
		);
		$sanction_data=array(
		'admin_sanction_id'=>$ref_admin,
		'admin_sanction_amount'=>$admin_amount,
		'tech_sanction_id'=>$ref_tech,
		'tech_sanction_amount'=>$tech_amount
		);
		$i=0;
		$expense_dates=$this->input->post('prev_expense_date');
		$expense_amounts=$this->input->post('prev_expense_amount');
		$expense_data=array();
		if($this->input->post('expense_id') && count($this->input->post('expense_id'))>0){
		foreach($this->input->post('expense_id') as $expense_id){
		if($expense_dates[$i]) $expense_dates[$i]=date("Y-m-d",strtotime($expense_dates[$i])); else $expense_dates[$i]=0;
		$expenses_data[]=array(
		'expense_id'=>$expense_id,
		'expense_date'=>$expense_dates[$i],
		'expense_amount'=>$expense_amounts[$i],
		);
		$i++;
		}
		}
		$this->db->trans_start();
		$this->db->where('project_id',$project_id);
		$this->db->update('projects',$project_data);
		$this->db->where('project_id',$project_id);
		$this->db->update('sanctions',$sanction_data);
		if(isset($expenses_data) && count($expenses_data)>0)
		$this->db->update_batch('project_expenses',$expenses_data,'expense_id');
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else return true;
	}
	function update_expenses(){
		$expenses=$this->input->post('expenditure');
		$expense_date=$this->input->post('expense_date');
		if(!$expense_date) return false;
		$project_id=$this->input->post('selected_project');
		$data=array(
		'project_id'=>$project_id,
		'expense_amount'=>$expenses,
		'expense_date'=>$expense_date
		);
		if($this->db->insert('project_expenses',$data)){
			return true;
		}
		else return false;
	}
	function update_bills(){
		$amount=$this->input->post('bill_amount');
		$bill_date=$this->input->post('bill_date');
		$payer=$this->input->post('payer');
		$voucher=$this->input->post('voucher_number');
		if(!$bill_date) return false;
		$project_id=$this->input->post('selected_project');
		$data=array(
		'project_id'=>$project_id,
		'bill_amount'=>$amount,
		'payer'=>$payer,
		'voucher_number'=>$voucher,
		'bill_date'=>$bill_date
		);
		if($this->db->insert('project_bills',$data)){
			return true;
		}
		else return false;
	}
	function delete_bill(){
		$bill_id=$this->input->post('bill_id');
		$this->db->where('bill_id',$bill_id);
		if($this->db->update('project_bills',array('active'=>0))){
			return true;
		}
		else return false;
	}
	function update_pendency(){
		$pendency_type=$this->input->post('pendency_type');
		if(!!$this->input->post('pendency_date')) $pendency_date=date("Y-m-d",strtotime($this->input->post('pendency_date')));
		else $pendency_date=0;
		$project_id=$this->input->post('selected_project');
		$data=array(
		'project_id'=>$project_id,
		'pendency_type_id'=>$pendency_type,
		'pendency_date'=>$pendency_date,
		);
		if($this->db->insert('ho_pendency',$data)){
			return true;
		}
		else return false;
	}
	function delete_pendency(){
		$pendency_id=$this->input->post('pendency_id');
		$this->db->where('pendency_id',$pendency_id);
		if($this->db->update('ho_pendency',array('active'=>0))){
			return true;
		}
		else return false;
	}
	function delete_extension(){
		$extension_id=$this->input->post('extension_id');
		$this->db->where('extension_id',$extension_id);
		if($this->db->update('project_extension',array('active'=>0))){
			return true;
		}
		else return false;
	}
	function update_status(){
		$status=$this->input->post('status');
		$stage=$this->input->post('stage');
		$final_bill=$this->input->post('final_bill');
		$status_remarks=$this->input->post('status_remarks');
		$date=date("Y-m-d");
		if($this->input->post('probable_date_of_completion')) $probable_date=date("Y-m-d",strtotime($this->input->post('probable_date_of_completion')));else $probable_date=0;
		if($this->input->post('final_bill_date')) $final_bill_date=date("Y-m-d",strtotime($this->input->post('final_bill_date')));else $final_bill_date=0;
		$project_id=$this->input->post('selected_project');
		$this->db->trans_start();
		$this->db->where('project_id',$project_id)->update('project_status',array('current'=>0));
		$data=array(
			'project_id'=>$project_id,
			'status_type_id'=>$status,
			'stage_id'=>$stage,
			'remarks_1'=>$status_remarks,
			'status_date'=>$date,
			'probable_date_of_completion'=>$probable_date,
			'current'=>1
		);
		if($this->input->post('final_bill') != NULL){
			$project_data = array(
				'final_bill'=>$final_bill,
				'final_bill_date'=>$final_bill_date
			);
			$this->db->where('project_id',$project_id);
			$this->db->update('projects',$project_data);
		}
		$this->db->insert('project_status',$data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
			$this->db->trans_rollback();
		}
		else 
			return true;
	}
	
	function update_extension(){
		if($this->input->post('extension_date')) $extension_date=date("Y-m-d",strtotime($this->input->post('extension_date')));
		else $extension_date = 0;
		if($this->input->post('approval_date')) $approval_date=date("Y-m-d",strtotime($this->input->post('approval_date')));
		else $approval_date = 0;
		$project_id=$this->input->post('selected_project');
		$data=array(
		'project_id'=>$project_id,
		'extension_date'=>$extension_date,
		'approval_date'=>$approval_date
		);
		if($this->db->insert('project_extension',$data)){
			return true;
		}
		else return false;
	}
	
	function update_targets(){
		$months=$this->input->post('projection_month');
		$years=$this->input->post('projection_year');
		$estimates=$this->input->post('estimate_amount');
		$date=date("Y-m-d");
		$project_id=$this->input->post('selected_project');
		$this->db->where('project_id',$project_id)->update('project_targets',array('current'=>0));
		$data=array();
		for($i=0;$i<12;$i++){
			$data[]=array(
			'project_id'=>$project_id,
			'projection_month'=>date("Y-m-d",mktime(0,0,0,$months[$i],1,$years[$i],-1)),
			'target_amount'=>$estimates[$i]*100000,
			'current'=>1,
			'datetime'=>$date
			);
		}
		$this->db->trans_start();
		if($this->db->insert_batch('project_targets',$data)){
			$this->db->trans_complete();
			return true;
		}
		else return false;
	}
	
	function update_image($image){
		$project_id=$this->input->post('selected_project');
		$title=$this->input->post('image_title');
		$data=array(
			'project_id'=>$project_id,
			'image_name'=>$image,
			'title'=>$title
		);
		$this->db->trans_start();
		if($this->db->insert('project_images',$data)){
			$this->db->trans_complete();
			return true;
		}
		else return false;
	}
	
	function remove_image($image_id,$path){
		$this->db->trans_start();
		$this->db->where('image_id',$image_id);
		$this->db->delete('project_images');
		if(unlink($path))
		$this->db->trans_complete();
		else { $this->db->trans_rollback(); return false; }
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else return true;
	}
		
	/* Ajith's code */
	
	function insert_agency(){
	$agency_name=$this->input->post('agency_name');
	$agency_address=$this->input->post('agency_address');
	$agency_contact_name=$this->input->post('agency_contact_name');
	$agency_designation=$this->input->post('agency_designation');
	$agency_contact_no=$this->input->post('agency_contact_no');
	$agency_email_id=$this->input->post('agency_email_id');
	$account_no=$this->input->post('account_no');
	$bank_name=$this->input->post('bank_name');
	$branch=$this->input->post('branch');
	$pan=$this->input->post('pan');
    $data = array(
              'agency_name'=>$agency_name,
              'agency_address'=>$agency_address,
              'agency_contact_name'=>$agency_contact_name,
              'agency_contact_designation'=>$agency_designation,
              'agency_contact_number'=>$agency_contact_no,
              'agency_email_id'=>$agency_email_id,
              'account_no'=>$account_no,
              'bank_name'=>$bank_name,
              'branch'=>$branch,
              'pan'=>$pan
            );
    if($this->db->insert('agency',$data)){
     return true;

    }
    else 
    {
      return false;
    }
 }

	function insert_division(){
    $this->load->database();
    $data = array(
              'district'=>$this->input->post('district'),
              'division_name'=>$this->input->post('division_name'),  'state'=>$this->input->post('state')
		);
    if($this->db->insert('divisions',$data)){
     return true;

    }
    else 
    {
      return false;
    }
 }
 function insert_facility(){	
    $data = array(
              'facility_type_id'=>$this->input->post('facility_type'),
              'facility_name'=>$this->input->post('facility_name'),
              'division_id'=>$this->input->post('division'),
               'longitude'=>$this->input->post('longitude'),
               'latitude'=>$this->input->post('latitude')
			   );
	$this->db->trans_start();
	if($this->input->post('facility_id')){
		$this->db->where('facility_id',$this->input->post('facility_id'));
		$this->db->update('facilities',$data);
	}
	else{
		$this->db->insert('facilities',$data);
	}
	$this->db->trans_complete();
	if($this->db->trans_status()===FALSE){
		return false;
	}
	else{
      return true;
	
    }
  }

    function insert_grant(){
    $phase_data=array();
    $data = array(
              'grant_name'=>$this->input->post('grant_name'),
              'grant_source'=>$this->input->post('grant_source'),
              'date'=>$this->input->post('date')
              );
    if($this->db->insert('grants',$data)){
      $grant_id=$this->db->insert_id();
      foreach($this->input->post('phase_name') as $phase){
        $phase_data[]=array(
            'phase_name'=>$phase,
            'grant_id'=>$grant_id
          );
      }
      $this->db->insert_batch('grant_phase',$phase_data);
      return true;

    }
    else 
    {
      return false;
    }


  }
  function get_grants(){
    $this->db->select("*")->from('grants');
    $query=$this->db->get();
    return $query->result_array();
  }
 function insert_user(){
    $this->load->database();
    $data = array(
              'user_type'=>$this->input->post('user_type'),
              'username'=>$this->input->post('username'),
              'password'=>$this->input->post('password'),
              'first_name'=>$this->input->post('first_name'),
              'last_name'=>$this->input->post('last_name'),
              'gender'=>$this->input->post('gender'),
              'dob'=>$this->input->post('dob'),
              'phone_no'=>$this->input->post('phone_no'),
              'email_id'=>$this->input->post('email_id'),
              'address'=>$this->input->post('address'),
               'city'=>$this->input->post('city'),
              'state'=>$this->input->post('state'),
              'country'=>$this->input->post('country'),
              'pincode'=>$this->input->post('pincode'));
    if($this->db->insert('users',$data)){
      return true;


    }
    else 
    {
      return false;
    }


  }
}
?>
