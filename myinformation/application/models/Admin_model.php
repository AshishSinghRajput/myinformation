<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    
	public function __construct()
	{
		parent::__construct();
	  // $this->table = "user";
	  // $this->select_column = array("id","sponsor_id","user_name","full_name","gender","email");
	  // $this->order_column = array(null,"sponsor_id",null,"full_name",null,null);
     
  /*************************************** STEP INCOME *********************************************/
	  $this->table = "level_income";
	  $this->select_column = array("id","sponsor_id","level","level_income","create_at");
	  $this->order_column = array(null,"sponsor_id","level","level_income","create_at");
  /******************************************** STEP INCOME *********************************************/

  /******************************************** MATCH INCOME *******************************************/
  
    $this->table1 = "daily_matching_income";
	  $this->select_column1 = array("id","user_id","on_pair","income","leps_income","on_date");
	  $this->order_column1 = array(null,"user_id","on_pair","income","leps_income","on_date");
  
  /********************************** MATCH INCOME *********************************************/
  /********************************** STEP PLAN WISE DOWNLINES LIST ******************************/
  
      $this->table2 = "user";
	  $this->select_column2 = array("id","type","sponsor_id","position","full_name","mobile","email","upgrade_plan","create_at","status","joining_plan");
	  $this->order_column2 = array(null,"type","sponsor_id","position","full_name","mobile","email","upgrade_plan","create_at","status","joining_plan");
  
  /******************************** STEP PLAN WISE DOWNLINES LIST ********************************/
  /************************************* TOTAL INCOME WEEKLY ***************************************/
  
    $this->table3 = 'user';
    $this->column_order = array(null,"type","sponsor_id","position","full_name","mobile","upgrade_plan","create_at","status","joining_plan"); //set column field database for datatable orderable
    $this->column_search = array("id","type","sponsor_id","position","full_name","mobile","upgrade_plan","create_at","status","joining_plan","email"); //set column field database for datatable searchable 
    $this->order = array('id' => 'asc'); // default order 
  
  /*********************************** TOTAL INCOME WEEKLY ********************************************/

	  $this->load->database();
		
	}
  /********************************** TOTAL INCOME WEEKLY END **********************************/
private function _get_datatables_query()
    {
        
        //add custom filter here
        if($this->input->post('from_date'))
        {
            $this->db->where('create_at', $this->input->post('from_date'));
        }
        if($this->input->post('to_date'))
        {
            $this->db->like('create_at', $this->input->post('to_date'));
        }
       
 
        $this->db->from($this->table3);
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    public function get_datatables3()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table3);
        return $this->db->count_all_results();
    }
 
    public function get_list_countries()
    {
        $this->db->select('create_at');
        $this->db->from($this->table3);
        $this->db->order_by('create_at','asc');
        $query = $this->db->get();
        $result = $query->result();
     echo $this->db->last_query();die;
        $countries = array();
        foreach ($result as $row) 
        {
            $countries[] = $row->create_at;
        }
        return $countries;
    }
 

  /****************************** TOTAL INCOME WEEKLY END ***************************************/

	/*************************************** STEP INCOME *******************************************/
	function make_query()
    {
         
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("sponsor_id", $_POST["search"]["value"]);
            $this->db->or_like("level", $_POST["search"]["value"]);
            $this->db->or_like("level_income", $_POST["search"]["value"]);
            $this->db->or_like("create_at", $_POST["search"]["value"]);
           
        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by("id", "DESC");
        }
    }
	
	 function make_datatables() {
        $this->make_query();
        if(isset($_POST["length"]) && $_POST["length"] != -1)
        {
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
        }
	    
	    function get_filtered_data() {
            $this->make_query();
             $query = $this->db->get();
             return $query->num_rows();
        }
	    
	   function get_all_data() 
        {
          $getId = $this->session->userdata('user');
          
          $stepId = $getId['sponsor_id'];
         //print_r($stepId);die;
        // echo $this->table;
           $this->db->select("*");
           
          $this->db->where('level_income.sponsor_id', $stepId);
           $this->db->from($this->table);
        
          $this->db->join('user','user.sponsor_id=level_income.sponsor_id');
      
           return $this->db->count_all_results();
        //   echo $this->db->last_query();die;
        }
  /*********************************** STEP INCOME ********************************************/
  /************************************** MATCH INCOME *******************************************/
	function make_query1()
    {
         $getId = $this->session->userdata('user');
       
        $this->db->select($this->select_column1);
        $this->db->where('daily_matching_income.user_id',$getId['sponsor_id']);
        $this->db->from($this->table1);
        if(isset($_POST["search"]["value"]))
        { 
             $this->db->or_like("user_id", $_POST["search"]["value"]);
            $this->db->like("on_pair", $_POST["search"]["value"]);
            $this->db->or_like("income", $_POST["search"]["value"]);
            $this->db->or_like("leps_income", $_POST["search"]["value"]);
            $this->db->or_like("on_date", $_POST["search"]["value"]);
           

        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_column1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by("id", "DESC");
        }
    }
	
	 function make_datatables1() {
	    
        $this->make_query1();
        if(isset($_POST["length"]) && $_POST["length"] != -1)
        {
            $this->db->limit($_POST["length"], $_POST["start"]);
           
        }
         
        $query = $this->db->get();
        return $query->result();
        }
	    
	    function get_filtered_data1() {
            $this->make_query1();
             $query = $this->db->get();
             return $query->num_rows();
        }
	    
	   function get_all_data1() 
        {
          $getId = $this->session->userdata('user');
        //   echo $getId['sponsor_id'];
        //   print_r($getId);
        //   die;
        
          $this->db->select("*");
           
         $this->db->where(array('daily_matching_income.user_id'=>$getId['sponsor_id']));
          $this->db->from($this->table1);
         // echo $this->db->last_query();die;
          $this->db->join('user','user.sponsor_id=daily_matching_income.user_id');
          return $this->db->count_all_results();
          //   echo $this->db->last_query();die;
        }
  /**************************************** MATCH INCOME *********************************************/

  /*********************************** STEP PLAN WISE DOWNLINES LIST *******************************/
	function make_query2()
    {
         
        $this->db->select($this->select_column2);
        $this->db->from($this->table2);
        if(isset($_POST["search"]["value"]))
        {
            $this->db->like("type", $_POST["search"]["value"]);
            $this->db->or_like("sponsor_id", $_POST["search"]["value"]);
            $this->db->or_like("position", $_POST["search"]["value"]);
            $this->db->or_like("full_name", $_POST["search"]["value"]);
            $this->db->or_like("mobile", $_POST["search"]["value"]);
            $this->db->or_like("email", $_POST["search"]["value"]);
            $this->db->or_like("upgrade_plan", $_POST["search"]["value"]);
            $this->db->or_like("create_at", $_POST["search"]["value"]);
            $this->db->or_like("status", $_POST["search"]["value"]);
            $this->db->or_like("joining_plan", $_POST["search"]["value"]);
           
        }
        if(isset($_POST["order"]))
        {
            $this->db->order_by($this->order_column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by("id", "DESC");
        }
    }
	
	 function make_datatables2() {
        $this->make_query2();
        if(isset($_POST["length"]) && $_POST["length"] != -1)
        {
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
        }
	    
	    function get_filtered_data2() {
            $this->make_query2();
             $query = $this->db->get();
             return $query->num_rows();
        }
	    
	   function get_all_data2() 
        {
          $getId = $this->session->userdata('user');
          $stepId = $getId['sponsor_id'];
          
           $this->db->select("*");
           $this->db->where('user.sponsor_id', $stepId);
           $this->db->from($this->table2);

           return $this->db->count_all_results();
        //   echo $this->db->last_query();die;
        }
  /*************************** STEP PLAN WISE DOWNLINES LIST ***********************************/
	function insertRecord($table, $Arrayy)
	{
		return $this->db->insert($table, $Arrayy);
	}
	function getsinglerow($table, $where)
	{
		return $this->db->get_where($table, $where)->row();
	}
	function updateRecord($table, $data, $where)
	{
		return $this->db->update($table, $data, $where);
	}
	public function getInfo($id)
	{
		return $this->db->get_where('users',array('id'=>$id))->row();
	}
	public function updateadminprofile($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		return $this->db->affected_rows();
	}
	public function checkpassword($id,$old)
	{
		return $this->db->get_where('users',array('id'=>$id,'password'=>md5($old)))->row();
	}
	public function updatepassword($id,$data)
	{
		 $this->db->where('id',$id);
		 $this->db->update('users',$data);
	}	
	function wholeresult($table, $select, $where)
	{
		$this->db->select(implode(',', $select));
		return $this->db->get_where($table, $where)->result();
	}
	function getlevelIncome()
	{
		$this->db->select('user.full_name, user.sponsor_id,user.mobile,user.email,level_income.level,level_income.level_income,level_income.on_month,level_income.create_at,level_income.status,level_income.behalf_of,level_income.id');
		$this->db->from('level_income');
		$this->db->join('user', 'user.sponsor_id=level_income.sponsor_id', 'inner');
		
		return $this->db->get()->result();
	}
	public function change($status,$id)
	{ 
		$this->db->where('id',$id);
		$this->db->update('level_income',array('status'=>$status));
		return $this->db->affected_rows() ;
	}
	public function ActivInactive($status,$id)
	{ 
		$this->db->where('id',$id);
		$this->db->update('user',array('is_active'=>$status));
		return $this->db->affected_rows() ;
	}
	public function deleteTestmonial($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('testmonials');
	}
	public function deleteSlider($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('slider');
	}
	public function deleteNews($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('latest_news');
	}
	public function deleteImportent($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('impartent_note');
	}
	public function deleteRegional($id)
	{
		$this->db->where('id',$id);
		$this->db->delete(' regional_experts');
	}
	
	/*======================================== */
	function getReligions()
	{
		$this->db->select('religions_.religions_name,sub_religion_.religions_id,sub_religion_.sub_religions,sub_religion_.id');
		$this->db->from('sub_religion_');
		$this->db->join('religions_', 'religions_.id=sub_religion_.religions_id', 'inner');
		$this->db->order_by('id','desc');
		return $this->db->get()->result();
	}
	function AllReligions()
	{
		$sql="SELECT sub_religion_category_.*, t1.sub_religions as subreName , t1.religions_id as rid , religions_.religions_name as mainname FROM sub_religion_category_ LEFT JOIN sub_religion_ t1 ON sub_religion_category_.religions_id=t1.id LEFT JOIN religions_ ON t1.religions_id=religions_.id";
		return	$this->db->query($sql)->result();
	}
	

	function multipleIdUser()
	{
		
	}
	    

	
	public function getallBankData($ids)
   	{
   		$query = $this->db->query("select * from pay_information where user_id='".$ids."'");
   		return $query->row();
   		
   		 // echo $this->db->last_query();die;
   	}
}

?>