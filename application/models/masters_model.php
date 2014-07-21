<?php 
class Masters_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_data($type,$division=-1){
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
		else if($type=="districts"){
			$this->db->select("district_id,district_name")->from("districts");
		}
		else if($type=="divisions"){
			$this->db->select("division_id,division")->from("divisions")->order_by('division');
		}
		else if($type=="facility_types"){
			$this->db->select("facility_type_id,facility_type")->from("facility_types")->order_by('facility_type');
		}
		else if($type=="user_department"){
			if($this->input->post('user_department_id')){
				$this->db->where('user_department_id',$this->input->post('user_department_id'));
			}
			$this->db->select("user_department_id,user_department")->from("user_departments")->order_by('user_department');
		}
		else if($type=="grants"){
			$this->db->select("phase_id,phase_name")->from("grant_phase")->join('grants','grant_phase.grant_id=grants.grant_id')->order_by('phase_name');
		}
		else if($type=="grant_sources"){
			$this->db->select("*")->from("grant_sources")->order_by('grant_source');
		}
		else if($type=="agencies"){
			$this->db->select("agency_id,agency_name")->from("agency")->order_by('agency_name');
		}
		else if($type=="staff_category"){
			
			$this->db->select("staff_category_id,staff_category")->from("staff_category");
		}
		else if($type=="staff_role"){
			
			$this->db->select("staff_role_id,staff_role")->from("staff_role");
		}

		$query=$this->db->get();
		return $query->result();
	}
	
	function update_data($type){
		if($type=="facility"){
			$data = array(
					  'facility_type_id'=>$this->input->post('facility_type'),
					  'facility_name'=>$this->input->post('facility_name'),
					  'division_id'=>$this->input->post('division'),
					   'longitude'=>$this->input->post('longitude'),
					   'latitude'=>$this->input->post('latitude')
			);
			$this->db->where('facility_id',$this->input->post('facility_id'));
			$table="facilities";
		}
		
		if($type=="user_department"){
			$data = array(
					  'user_department'=>$this->input->post('user_department')
			);
			$this->db->where('user_department_id',$this->input->post('user_department_id'));
			$table="user_departments";
		}
		
		$this->db->trans_start();
		$this->db->update($table,$data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else{
		  return true;
		}
	}
	
	function insert_data($type){
		if($type=="facility"){
		$data = array(
					  'facility_type_id'=>$this->input->post('facility_type'),
					  'facility_name'=>$this->input->post('facility_name'),
					  'division_id'=>$this->input->post('division'),
					   'longitude'=>$this->input->post('longitude'),
					   'latitude'=>$this->input->post('latitude')
			);
		$table="facilities";
		}
		if($type=="user_department"){
		$data = array(
					  'user_department'=>$this->input->post('user_department')
			);
		$table="user_departments";
		}
		if($type=="facility_type"){
		$data = array(
					  'facility_type'=>$this->input->post('facility_type')
			);
		$table="facility_types";
		}
		else if($type=="agency"){
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
			$table="agency";
		}
		else if($type=="grant"){
			$phase_data=array();
			$data = array(
					  'grant_name'=>$this->input->post('grant_name'),
					  'grant_source_id'=>$this->input->post('grant_source')
					  );
			$this->db->trans_start();
				if($this->db->insert('grants',$data)){
				$grant_id=$this->db->insert_id();
				foreach($this->input->post('phase_name') as $phase){
					$phase_data[]=array(
						'phase_name'=>$phase,
						'grant_id'=>$grant_id
					  );
				}
				$this->db->insert_batch('grant_phase',$phase_data);
				}
			$this->db->trans_complete();
			if($this->db->trans_status()===FALSE){
				return false;
			}
			else{
			  return true;
			}
		}
		else if($type=="division"){
			$data = array(
					  'district_id'=>$this->input->post('district'),
					  'division'=>$this->input->post('division_name')
			);
			$table="divisions";
		}
		else if($type=="user"){
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
              'pincode'=>$this->input->post('pincode')
			);
			$table="users";
		}		elseif($type=="staff"){
		$data = array(
					  'first_name'=>$this->input->post('first_name'),
					  'last_name'=>$this->input->post('last_name'),
					  'gender'=>$this->input->post('gender'),
					  'date_of_birth'=>$this->input->post('date_of_birth'),
					  'staff_role_id'=>$this->input->post('staff_role'),
					  'staff_category_id'=>$this->input->post('staff_category'),
					  'designation'=>$this->input->post('designation'),
					  'staff_type'=>$this->input->post('staff_type'),
					  'email'=>$this->input->post('email'),
					  'phone'=>$this->input->post('phone')
				);

		$table="staff";
		}
		elseif($type=="staff_role"){
		$data = array(
					  'staff_role'=>$this->input->post('staff_role')
		);

		$table="staff_role";
		}
		elseif($type=="staff_category"){
		$data = array(
					  'staff_category'=>$this->input->post('staff_category')
		);

		$table="staff_category";
		}
		$this->db->trans_start();
			$this->db->insert($table,$data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else{
		  return true;
		}	
	}

}
?>
