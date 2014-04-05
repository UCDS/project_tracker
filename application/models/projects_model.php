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

		$agreement_date=date("Y-m-d",strtotime($this->input->post('agreement_date')));
		$agreement_completion_date=date("Y-m-d",strtotime($this->input->post('agreement_completion_date')));
		$probable_date_of_completion=date("Y-m-d",strtotime($this->input->post('probable_date_of_completion')));
		$grant=$this->input->post('grant');
		$agency=$this->input->post('agency');
		$work_type=$this->input->post('work_type');
		$data=array(
			'project_name'=>$project_name,
			'project_address'=>$address,
			'facility_id'=>$facility,
			'agreement_id'=>$agreement_id,
			'agreement_amount'=>$agreement_amount,
			'agreement_date'=>$agreement_date,
			'agreement_completion_date'=>$agreement_completion_date,
			'probable_date_of_completion'=>$probable_date_of_completion,
			'grant_phase_id'=>$grant,
			'agency_id'=>$agency,
			'work_type_id'=>$work_type
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
	
	function update_expenses(){
		$expenses=$this->input->post('expenditure');
		$expense_date=$this->input->post('expense_date');
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
	function update_status(){
		$status=$this->input->post('status');
		$status_remarks=$this->input->post('status_remarks');
		$date=date("Y-m-d");
		$probable_date=date("Y-m-d",strtotime($this->input->post('probable_date')));
		$project_id=$this->input->post('selected_project');
		$this->db->where('project_id',$project_id)->update('project_status',array('current'=>0));
		$data=array(
		'project_id'=>$project_id,
		'status_type_id'=>$status,
		'remarks_1'=>$status_remarks,
		'status_date'=>$date,
		'probable_date_of_completion'=>$probable_date,
		'current'=>1
		);
		if($this->db->insert('project_status',$data)){
			return true;
		}
		else return false;
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
