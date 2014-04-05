<?php 
class Masters_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_data($type){
		if($type=="facility"){
			if($this->input->post('select')){
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
		else if($type=="facility_type"){
			if($this->input->post('select')){
				$facility_type_id=$this->input->post('facility_type_id');
				$this->db->where('facility_type_id',$facility_type_id);
			}
		/*	if($this->input->post('search_facility_type')){
				$facility_type=$this->input->post('search_facility_type');
				$this->db->where('facility_types.facility_type_id',$facility_type);
			}*/

	    	if($this->input->post('search_facility_type')){
				$facility_type=strtolower($this->input->post('search_facility_type'));
				$this->db->like('LOWER(facility_type)',$facility_type,'after');
			}
			
			
			$this->db->select("*")->from("facility_types");	
		}
			else if($type=="user_type"){
			if($this->input->post('select')){
				$user_type_id=$this->input->post('user_type_id');
				$this->db->where('user_type_id',$user_type_id);
			}
		/*	if($this->input->post('search_facility_type')){
				$facility_type=$this->input->post('search_facility_type');
				$this->db->where('facility_types.facility_type_id',$facility_type);
			}*/

	    	if($this->input->post('search_user_type')){
				$user_type=strtolower($this->input->post('search_user_type'));
				$this->db->like('LOWER(user_type)',$user_type,'after');
			}
			
			
			$this->db->select("*")->from("user_types");	
		}
		else if($type=="users"){
			//$this->db->select("user_id,username")->from("users")->order_by('username');
		
				if($this->input->post('select')){
				$user_id=$this->input->post('user_id');
				$this->db->where('users.user_id',$user_id);
			}
				

						
			
	    	if($this->input->post('search')){
				$username=strtolower($this->input->post('search_username'));
				$this->db->like('LOWER(username)',$username,'after');
			}
//$this->db->select("*")->from("users");
			$this->db->select("user_id,user_type,username,password,first_name,last_name,gender,dob,phone_no,email_id,address,city,state,country,pincode,user_types.user_type_id,user_type")->from("users")
	->join('user_types','users.user_type_id=user_types.user_type_id')->order_by('user_type');
		}
		else if($type=="districts"){
			
			$this->db->select("district_id,district_name")->from("districts");
		}
		else if($type=="division"){
			
	$this->db->select("division_id,division")->from("divisions");
		}
		else if($type=="divisions"){
			if($this->input->post('select')){
				$division_id=$this->input->post('division_id');
				$this->db->where('division_id',$division_id);
			}
				if($this->input->post('search')){
					$division=strtolower($this->input->post('search_division'));
				$this->db->like('LOWER(division)',$division,'after');
		}
//if($this->input->post('search_district')){
	//			$district_type=$this->input->post('search_district');
	//			$this->db->where('districts.district_id',$district_type);
	//		}


				//$division=$this->input->post('division_id');
				//$this->db->where('divisions.division',$division);
			
				
             	$this->db->select("*")->from("divisions")
			->join('districts','divisions.district_id=districts.district_id')
			->order_by('division');
		 $this->db->last_query();
		}
		else if($type=="agency"){
			if($this->input->post('select')){
				$agency_id=$this->input->post('agency_id');
				$this->db->where('agency_id',$agency_id);
			}
			if($this->input->post('search')){
			//	$agency_name=$this->input->post('search_agency_name');
			//	$this->db->where('agency.agency_id',$agency_name);
				$agency_name=strtolower($this->input->post('search_agency_name'));
				$this->db->like('LOWER(agency_name)',$agency_name,'after');
		
			}
			
			$this->db->select("*")->from("agency");
		}

		else if($type=="facility_types"){
			$this->db->select("facility_type_id,facility_type")->from("facility_types")->order_by('facility_type');
		}
			else if($type=="grants"){
			if($this->input->post('select')){
				$grant_id=$this->input->post('grant_id');
				$this->db->where('grants.grant_id',$grant_id);
			}
			if($this->input->post('search')){
				$grant_name=strtolower($this->input->post('search_grant_name'));
				$this->db->like('LOWER(grant_name)',$grant_name,'after');
			}
			//if($this->input->post('select')){
			//	$phase_name=$this->input->post('search_phase_name');
			//	$this->db->where('grant_phase.phase_id',$phase_name);
			//}
			
			
			$this->db->select("grant_name,grant_phase.phase_id,grant_phase.phase_name,grant_phase.grant_id,date,grant_sources.grant_source,grant_sources.grant_source_id")->from("grants")
			->join('grant_phase','grants.grant_id=grant_phase.grant_id')
			->join('grant_sources','grants.grant_source_id=grant_sources.grant_source_id')
			
			->order_by('grant_name');	
		}
	else if($type=="grant"){
			$this->db->select("phase_id,phase_name,grant_name,grant_source_id,date")->from("grant_phase")->join('grants','grant_phase.grant_id=grants.grant_name')->order_by('phase_name');
		}
		else if($type=="user"){
			$this->db->select("user_id,username")->from("users")->order_by('username');
		}
		else if($type=="user_type"){
			$this->db->select("user_type_id,user_type")->from("user_types");
		}
		
		
		else if($type=="grant_sources"){
			$this->db->select("grant_source_id,grant_source")->from("grant_sources");
		}
		else if($type=="grant_phases"){
			$this->db->select("phase_id,phase_name")->from("grant_phase")->order_by('phase_name');
		}
		
		
		$query=$this->db->get();
$this->db->last_query();
		return $query->result();
	}
	
	function update_data($type){
		if($type=="facility"){
			$data = array(
					  'facility_type_id'=>$this->input->post('facility_type'),
					  'facility_name'=>$this->input->post('facility_name'),
					  'division_id'=>$this->input->post('divisions'),
					   'longitude'=>$this->input->post('longitude'),
					   'latitude'=>$this->input->post('latitude')
			);
			$this->db->where('facility_id',$this->input->post('facility_id'));
			$table="facilities";
		
		
	}
	else if($type=="user_type"){
			$data = array(
					  'user_type'=>$this->input->post('user_type')
					
			);
			$this->db->where('user_type_id',$this->input->post('user_type_id'));
			$table="user_types";
		
		
	}
	else if($type=="facility_type"){
			$data = array(
					  'facility_type'=>$this->input->post('facility_type')
					
			);
			$this->db->where('facility_type_id',$this->input->post('facility_type_id'));
			$table="facility_types";
		
		
	}
	else if($type=="agency"){
		$agency_name=$this->input->post('agency_name');
			$agency_address=$this->input->post('agency_address');
			$agency_contact_name=$this->input->post('agency_contact_name');
			$agency_contact_designation=$this->input->post('agency_contact_designation');
			$agency_contact_number=$this->input->post('agency_contact_number');
			$agency_email_id=$this->input->post('agency_email_id');
			$account_no=$this->input->post('account_no');
			$bank_name=$this->input->post('bank_name');
			$branch=$this->input->post('branch');
			$pan=$this->input->post('pan');
				$data = array(
					  'agency_name'=>$agency_name,
					  'agency_address'=>$agency_address,
					  'agency_contact_name'=>$agency_contact_name,
					  'agency_contact_designation'=>$agency_contact_designation,
					  'agency_contact_number'=>$agency_contact_number,
					  'agency_email_id'=>$agency_email_id,
					  'account_no'=>$account_no,
					  'bank_name'=>$bank_name,
					  'branch'=>$branch,
					  'pan'=>$pan
					);
			$this->db->where('agency_id',$this->input->post('agency_id'));
			$table="agency";
		}
			else if($type=="users"){
			$data = array(
				
              'user_type_id'=>$this->input->post('user_type'),
              'username'=>$this->input->post('username'),
              'password'=>md5($this->input->post('password')),
              'first_name'=>$this->input->post('first_name'),
              'last_name'=>$this->input->post('last_name'),
              'gender'=>$this->input->post('gender'),
              'dob'=>date("Y-m-d",strtotime($this->input->post('dob'))),
              'phone_no'=>$this->input->post('phone_no'),
              'email_id'=>$this->input->post('email_id'),
              'address'=>$this->input->post('address'),
               'city'=>$this->input->post('city'),
              'state'=>$this->input->post('state'),
              'country'=>$this->input->post('country'),
              'pincode'=>$this->input->post('pincode')
			);
				$this->db->where('user_id',$this->input->post('user_id'));
			$table="users";
		}
			else if($type=="grant"){
				$data = array(
		        'grant_name'=>$this->input->post('grant_name'),
			    'grant_source_id'=>$this->input->post('grant_sources'),
				'date'=>date("Y-m-d",strtotime($this->input->post('date')))
			
					);
			$this->db->where('grant_id',$this->input->post('grant_id'));
			$table="grants";
		$date=array(
                   'phase_name'=>$this->input->post('phase_name')
                    );
                $this->db->where('grant_id',$this->input->post('grant_id'));
             $table="grant_phase";	


			
		}
		

	else if($type=="divisions"){
	
				$data = array(
					  'division'=>$this->input->post('division'),
					  'district_id'=>$this->input->post('district_name'),
					   'longitude'=>$this->input->post('longitude'),
                       'latitude'=>$this->input->post('latitude')
					);
			$this->db->where('division_id',$this->input->post('division_id'));
			$table="divisions";
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
			if($type=="user_type"){
		$data = array(
					  'user_type'=>$this->input->post('user_type')
					
			);
		$table="user_types";
		}	
		else if($type=="users"){
			$data = array(
				
              'user_type_id'=>$this->input->post('user_type'),
              'username'=>$this->input->post('username'),
              'password'=>md5($this->input->post('password')),
              'first_name'=>$this->input->post('first_name'),
              'last_name'=>$this->input->post('last_name'),
              'gender'=>$this->input->post('gender'),
              'dob'=>date("Y-m-d",strtotime($this->input->post('dob'))),
              'phone_no'=>$this->input->post('phone_no'),
              'email_id'=>$this->input->post('email_id'),
              'address'=>$this->input->post('address'),
               'city'=>$this->input->post('city'),
              'state'=>$this->input->post('state'),
              'country'=>$this->input->post('country'),
              'pincode'=>$this->input->post('pincode')
			);
			$table="users";
		}
		else if($type=="divisions"){
			$data = array(
					  'district_id'=>$this->input->post('district_name'),
					  'division'=>$this->input->post('division'),
					   'longitude'=>$this->input->post('longitude'),
                       'latitude'=>$this->input->post('latitude')

					
					);
			$table="divisions";
		}
			else if($type=="grant"){
			$phase_data=array();
			$data = array(
					  'grant_name'=>$this->input->post('grant_name'),
					  'grant_source_id'=>$this->input->post('grant_source'),
					  	  'date'=>date("Y-m-d",strtotime($this->input->post('date'))),
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
		else if($type=="agency"){
				$data = array(
			'agency_name'=>$this->input->post('agency_name'),
			'agency_address'=>$this->input->post('agency_address'),
			'agency_contact_name'=>$this->input->post('agency_contact_name'),
			'agency_contact_designation'=>$this->input->post('agency_contact_designation'),
			'agency_contact_number'=>$this->input->post('agency_contact_number'),
			'agency_email_id'=>$this->input->post('agency_email_id'),
			'account_no'=>$this->input->post('account_no'),
			'bank_name'=>$this->input->post('bank_name'),
			'branch'=>$this->input->post('branch'),
			'pan'=>$this->input->post('pan')
		
			
					);
			$table="agency";
		}
		if($type=="facility_type"){
		$data = array(
					  'facility_type'=>$this->input->post('facility_type')
			);
		$table="facility_types";
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
