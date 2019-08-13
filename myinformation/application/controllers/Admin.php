<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__)."/Auth.php");
class Admin extends Auth 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','security'));
        $this->load->library(array('form_validation','session','pagination'));
		$this->load->model(array('admin_model','auth_model','jscss_model')); 
	if (empty($this->session->userdata['admin'])) 
	{
    	redirect(base_url());
	}
	date_default_timezone_set('Asia/Kolkata');
	}
	
	public function index()
	{
		$this->data['page']="Admin";
		$this->data['content']="dashboard/index";
		$this->load->view('admin/admintemplate',$this->data);
		$this->load->model("Admin_model");
	}
	function view_slider()
	{
		$this->data['slider']= $this->admin_model->wholeresult('slider',[],[]);
		$this->data['page'] = "slider";
		$this->data['content'] = "slider/view";
		$this->load->view('admin/admintemplate', $this->data);
	}
	//sliders
	function sliders()
	{
		$this->data['page'] = "slider";
		$this->data['content'] = "slider/index";
		$this->load->view('admin/admintemplate', $this->data);
	}
	function add_slider()
	{
		$allImag = count($_FILES['img']['name']);
		$ext = array('jpg', 'png', 'gif');
		$img = array();
		$rand = rand(10000000, 99999999);
		for ($i = 0; $i < $allImag; $i++) {
			$temp = explode(".", $_FILES["img"]["name"][$i]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$tmpFilePath = $_FILES['img']['tmp_name'][$i];
			if ($tmpFilePath != "") {
				$extension = pathinfo($_FILES['img']['name'][$i], PATHINFO_EXTENSION);
				if (in_array($extension, $ext)) {

					$img[] = $rand . $newfilename[$i];

				} else {
					redirect(view_slider);
				}

				$newFilePath = "uploads/slider/" . $rand . $newfilename[$i];
				if (move_uploaded_file($tmpFilePath, $newFilePath)) {
				}
			}
		}

		$save1['slider_tagline'] = $this->input->post('slider_tagline');
		$save2['description'] = $this->input->post('description');
		$save['slider_tagline'] = serialize($save1);
		$save['description'] = serialize($save2);
		$save['slider_img'] = serialize($img);

		$this->admin_model->insertRecord('slider', $save);
		$this->session->set_flashdata('success', 'Great!');
		$this->session->set_flashdata('message', 'Slider Uploaded Successfully');
		redirect(view_slider);

	}
	public function delete_slider()
	{
		$id=$_GET['id'];
		$this->admin_model->deleteSlider($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Slider Deleted Successfully');

		redirect(view_slider,'refresh');
	}
	private function imageupload($path,$name)
    {
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($name))
        {
            $message = array('message' => 'Only jpg , jpeg, gif, png file allowed','success'=>0);
        }
        else
        {
            $data = $this->upload->data();
            $message = array('message' => $data['file_name'],'success'=>1);
        }
        return $message;
    }
	function adminprofile()
	{
		$id = $this->session->userdata['admin']['id'];
		$this->form_validation->set_rules('full_name', 'Full name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		if ($this->form_validation->run() == false) {} else {
			$save = array();
			$save = $_POST;
			if (!empty($_FILES['image']['name'])) {
				$path = './profile';
				$data = $this->imageupload($path, $_FILES['image']['name']);
				if ($data['success'] == 0) {
					$this->session->set_flashdata('class', 'error');
					$this->session->set_flashdata('success', $data['message']);
				} else {
					$save['image'] = $data['message'];
				}
			}
			if ($this->admin_model->updateRecord(TBL_USER, $save, ['id' => $id])) 
			{
				$this->session->set_flashdata('class', 'custom');
				$this->session->set_flashdata('message', 'Profile successfully updated');
			}
		}
		$this->data['profile'] = $this->admin_model->getsinglerow(TBL_USER, ['id' => $id]);
		$this->data['page'] = 'profile';
		$this->data['content'] = 'profile/profile';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function changepassword()
	{
		$id = $this->session->userdata['admin']['id'];
		$this->form_validation->set_rules('old_password', 'Old Password', 'required');
		$this->form_validation->set_rules('password', 'New Password', 'required');
		$this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');
		if ($this->form_validation->run() == false) {} else {
			extract($_POST);
			if ($this->admin_model->getsinglerow(TBL_USER, ['password' => sha1($old_password), 'id' => $id])) {

				$this->admin_model->updateRecord(TBL_USER, ['password' => sha1($password)], ['id' => $id]);

				$this->session->set_flashdata('class', 'custom');
				$this->session->set_flashdata('message', 'Password successfully updated');

			} else {
				$this->session->set_flashdata('class', 'error');
				$this->session->set_flashdata('message', 'Old password not correct');
			}
		}
		$this->data['page'] = 'changepassword';
		$this->data['content'] = 'profile/changepassword';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function userlist()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'userlist';
		$this->data['content'] = 'user/index';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function active_user_info()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['status'=>1]);
		$this->data['page'] = 'activeuserlist';
		$this->data['content'] = 'user/active_user_info';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function pending_user_info()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['status'=>0,'is_active'=>1]);
		$this->data['page'] = 'pendinguserlist';
		$this->data['content'] = 'user/pending_user_info';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function blockUser()
	{
		$sid = $this->uri->segment(2);
		$data = array(
			'is_active'=>0
	);
		$this->admin_model->updateRecord('user',$data,array('sponsor_id'=>$sid));
		redirect('pending_user_info');
	}
	function block_user_info()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['is_active'=>0]);
		$this->data['page'] = 'blockuserlist';
		$this->data['content'] = 'user/block_user_info';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function unblockUser()
	{
		$sid = $this->uri->segment(2);
		$data = array(
			'is_active'=>1
	);
		$this->admin_model->updateRecord('user',$data,array('sponsor_id'=>$sid));
		redirect('block_user_info');
	}
	function free_user()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0,'upgrade_plan'=>0]);
		$this->data['page'] = 'Free user';
		$this->data['content'] = 'user/free_member';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function user_plan()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'Free user';
		$this->data['content'] = 'user/user_plan_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function user_income()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'Free user';
		$this->data['content'] = 'user/user_income_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function payment_history()
	{
		$this->data['user']= $this->admin_model->wholeresult(TBL_USER,[],['type'=>0]);
		$this->data['page'] = 'payment history';
		$this->data['content'] = 'user/payment_history_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function multiple_id_user()
	{
		$this->data['user']= $this->admin_model->multipleIdUser();
		// echo '<pre>';print_r($this->data['user']);die;
		$this->data['page'] = 'payment history';
		$this->data['content'] = 'user/multiple_id_user_page';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function active_inactive($id)
	{
		$status=$this->input->post('status');
		$response=$this->admin_model->ActivInactive($status,$id); 
		if($response > 0)
		{
			$this->session->set_flashdata('success','Great!');
            $this->session->set_flashdata('message','User Status Change Successfully');
			redirect(userlist);
		}
		else{
				$this->session->set_flashdata('success','Great!');
				$this->session->set_flashdata('message','Sorry! Some thing Wrong');
				redirect(userlist);
		}
	}
	function member_profile()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'User Profile List';
		$this->data['content'] = 'user/member_profile_list';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function full_profile()
	{
		$userId = $_GET['list'];
		
		$this->data['ByIDRecord'] = $this->admin_model->getsinglerow(NRML_INFO_TBL, ['user_id'=>$userId]);
		$this->data['birth'] = $this->admin_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $userId]);
		$this->data['pay'] = $this->admin_model->getsinglerow(PAY_INFO_TBL, ['user_id' => $userId]);
		$this->data['special'] = $this->admin_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $userId]);
		$this->data['cast'] = $this->admin_model->getsinglerow(CST_INFO_TBL, ['user_id' => $userId]);
		$this->data['family'] = $this->admin_model->getsinglerow(FMTY_INFO_TBL, ['user_id' => $userId]);
		$this->data['generation'] = $this->admin_model->getsinglerow(GNRTN_INFO_TBL, ['user_id' => $userId]);
		$this->data['health'] = $this->admin_model->getsinglerow(HLTH_INFO_TBL, ['user_id' => $userId]);
		$this->data['parsad'] = $this->admin_model->getsinglerow(PRSTN_INFO_TBL, ['user_id' => $userId]);
		$this->data['edu'] = $this->admin_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
		$this->data['work'] = $this->admin_model->getsinglerow(WRK_INFO_TBL, ['user_id' => $userId]);
		$this->data['mrg'] = $this->admin_model->getsinglerow(MRG_INFO_TBL, ['user_id' => $userId]);

		$this->data['page'] = 'User Full Profile';
		$this->data['content'] = 'user/get_full_profile_user_wise';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function level_ncome()
	{
		$this->data['Lincome'] = $this->admin_model->getlevelIncome();
		$this->data['page'] = 'Step Income';
		$this->data['content'] = 'income/level_income';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function changestatus($id)
	{
		$status=$this->input->post('status');
		$response=$this->admin_model->change($status,$id); 
		if($response > 0)
		{
			$this->session->set_flashdata('success','Great!');
            $this->session->set_flashdata('message','Amount Release Successfully');
			redirect(step_income);
		}else{
			echo "Some Error Occured";
		}
	}
	function binary_income()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Matching Income';
		$this->data['content'] = 'income/binary_income';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function datewise_income()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Total Income(Date)';
		$this->data['content'] = 'income/income_datewise';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function downlines_earning()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Total Downlines Earning';
		$this->data['content'] = 'income/downlines_earning';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function direct_downlines_earning()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Direct Downlines Earning';
		$this->data['content'] = 'income/direct_downlines_earning';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function matching_planwise_downlines()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Matching Plan Wise Downlines Earning';
		$this->data['content'] = 'income/matching_planwise_downlines';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function step_planwise_downline()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Step Plan Wise Downlines';
		$this->data['content'] = 'income/step_planwise_downline';
		$this->load->view('admin/admintemplate', $this->data);
	}
	  function total_income_weekly(){

        $this->data['page'] = 'totalincomeweekly';
        $this->data['content'] = 'income/total_income_weekly';
        $this->load->view('admin/admintemplate', $this->data);

    }
	function new_step_income()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Step Income(Date)';
		$this->data['content'] = 'income/step_income';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function bank_information()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Bank Information';
		$this->data['content'] = 'income/bank_information';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function paytm_information()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Paytm Information';
		$this->data['content'] = 'income/paytm_information';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function user_total_income_weekly()
	{
		$this->data['page'] = 'User Total Income Weekly';
		$this->data['content'] = 'income/user_total_income_weekly';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function bhim_information()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'BHIM Information';
		$this->data['content'] = 'income/bhim_information';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function googlepay_information()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'GooglePay Information';
		$this->data['content'] = 'income/googlepay_information';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function phonepe_information()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'PhonePe Information';
		$this->data['content'] = 'income/phonepe_information';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function account_information()
	{
		$this->data['user'] = $this->admin_model->wholeresult(TBL_USER, [], ['type' => 0]);
		$this->data['page'] = 'Account Information';
		$this->data['content'] = 'income/account_information';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function all_epin()
	{
		$this->data['epin'] = $this->admin_model->wholeresult('epin', [],[]);
		$this->data['page'] = 'epin history';
		$this->data['content'] = 'epin/all_epin_history';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function epin_history()
	{
		$this->data['epin'] = $this->admin_model->wholeresult(TRNFR_EPN_TBL, [],[]);
		$this->data['page'] = 'epin history';
		$this->data['content'] = 'epin/transfer_epin_history';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function downline_history()
	{
		$sponsorId=$_GET['id'];
		$this->data['mydownline']= Auth::mydownlines($sponsorId);
		$this->data['page'] = 'mydownline';
		$this->data['content'] = 'user/mydownline';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function generate_password()
	{
		
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('cfiorm', 'Password', 'required|matches[cfiorm]');
			if ($this->form_validation->run() == false) 
			{} 	else {
					$userId = $_GET['id'];
					$update['password'] = sha1($this->input->post('password'));
				
					if($this->admin_model->updateRecord(TBL_USER,$update,['id'=>$userId])){
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', ' Great! Successfully New Password Generated.');
					}else{
						$this->session->set_flashdata('error', 'sorry!');
						$this->session->set_flashdata('message', ' oh! Something wrong.');

					}
					redirect(userlist);
				}
		
		$this->data['page'] = 'ChangePassword';
		$this->data['content'] = 'user/password';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function latest_news()
	{
		
		$this->data['newss'] = $this->welcome_model->wholeresult('latest_news', [], []);
		
		if (!empty($_POST)) {
			$this->form_validation->set_rules('heading', 'News Description', 'required');
			
			if ($this->form_validation->run() == false) {
				$this->data['page'] = 'news';
				$this->data['content'] = 'news/news';
				$this->load->view('admin/admintemplate', $this->data);
			} 
			else {
					date_default_timezone_set('Asia/Kolkata');
					$newss['created_at']=date("Y-m-d H:i:s");
					$newss['heading'] = $this->input->post('heading');
					$newss['title'] = $this->input->post('title');
					//echo '<pre>';die;print_r($newss);die;
					$this->admin_model->insertRecord('latest_news', $newss);
					$this->session->set_flashdata('success', 'Great!');
					$this->session->set_flashdata('message', 'News  Successfully Add');
					redirect(latest_news);
				}
		} else {
			$this->data['page'] = 'news';
			$this->data['content'] = 'news/news';
			$this->load->view('admin/admintemplate', $this->data);
		}
	}
 function delete_news()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteNews($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'News Delete Successfully');

		redirect(latest_news);
	}
	 function testmonial()
	{
		$this->data['testData'] = $this->admin_model->wholeresult('testmonials', [], []);
		$this->data['state'] = $this->welcome_model->AllState();
		$this->data['page'] = 'testmonial';
		$this->data['content'] = 'testmonial/testmonial_page';
		$this->load->view('admin/admintemplate', $this->data);

	}
	 function getAllCity($id)
	{
		$data = $this->welcome_model->getCity($id);
		echo "<option> Select City</option>";
		
		foreach($data as $row)
		{
			echo "<option value='$row->name'>$row->name</option>";
		}
	}
	 function addtestmonial()
	{
		$this->data['testData'] = $this->admin_model->wholeresult('testmonials',[],[]);
		$this->data['state'] = $this->welcome_model->AllState();
		if(!empty($_POST))
			{ 
				$this->form_validation->set_rules('client_name', 'name', 'required|xss_clean');
				$this->form_validation->set_rules('position', 'Position', 'required|xss_clean');
				$this->form_validation->set_rules('description', 'Decription', 'required|xss_clean');
				$this->form_validation->set_rules('state', 'state', 'required|xss_clean');
				$this->form_validation->set_rules('city', 'city', 'required|xss_clean');


				if($this->form_validation->run()==FALSE)
				{
					if (empty($_FILES['img']['name']))
					{
						$this->form_validation->set_rules('img', 'image', 'required|xss_clean');
						$this->session->set_flashdata('error', 'Formate!');
						$this->session->set_flashdata('message', 'Sorry Image Wrong Format');

					}
					$this->data['page'] = 'testmonial';
					$this->data['content'] = 'testmonial/testmonial_page';
					$this->load->view('admin/admintemplate', $this->data);

				}
				else{
						$allImag = count($_FILES['img']['name']);
						$ext = array('jpg','png','gif');
						$img=array();
						$rand= rand(10000000,99999999);
						for($i=0; $i<$allImag; $i++) 
						{
							$temp = explode(".", $_FILES["img"]["name"][$i]);
							$newfilename = round(microtime(true)) . '.' . end($temp);
							$tmpFilePath = $_FILES['img']['tmp_name'][$i];
							if ($tmpFilePath != "")
							{
							   $extension = pathinfo($_FILES['img']['name'][$i],PATHINFO_EXTENSION);
							  if(in_array($extension,$ext))
							  {
								
								  $img[] = $rand.$newfilename[$i];
								 
							  }else{ 
								 redirect(testmonial);
								}
							   
							   $newFilePath = "uploads/testmonial/" .$rand.$newfilename[$i];
							   if(move_uploaded_file($tmpFilePath, $newFilePath))
							   {	   
							   }
							}
						}
						//date_default_timezone_set('Asia/Kolkata');
						//$TestmonialData['create_date']=date("Y-m-d H:i:s");
						$TestmonialData['client_name']=$this->input->post('client_name');
						$TestmonialData['position']=$this->input->post('position');
						$TestmonialData['description']=$this->input->post('description');
						$TestmonialData['state']=$this->input->post('state');
						$TestmonialData['city']=$this->input->post('city');
						$TestmonialData['img']= serialize($img);
						
						$this->admin_model->insertRecord('testmonials',$TestmonialData);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Testmonial  Successfully Add');
						redirect(testmonial);
					}
				
			}
			else{
				$this->data['page'] = 'testmonial';
				$this->data['content'] = 'testmonial/testmonial_page';
				$this->load->view('admin/admintemplate', $this->data);

			}
		
	}
	
	function delete_testmonial()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteTestmonial($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Testmonial Delete Successfully');

		redirect(testmonial);
	}
	function marriage()
	{
		$this->data['page'] = 'Marriage';
		$this->data['content'] = 'other/marriage_page ';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function personality()
	{
		$this->data['page'] = 'Personality';
		$this->data['content'] = 'other/personality_page ';
		$this->load->view('admin/admintemplate', $this->data);
	}
	function importent()
	{
	    $this->data['imp'] = $this->admin_model->wholeresult('impartent_note', [], []);
		$this->data['page'] = 'importent';
		$this->data['content'] = 'other/impartent';
		$this->load->view('admin/admintemplate', $this->data);

	}
	function userHistory()
	{
	    $this->data['user'] = $this->admin_model->wholeresult('user', [], ['type'=>0]);
		$this->data['page'] = 'user_history';
		$this->data['content'] = 'user/user_history';
		$this->load->view('admin/admintemplate',$this->data);

	}
	 public function users_my_information()
    {
    	$this->load->model('welcome_model');
        $data = $this->welcome_model->getCountryList();
        // print_r($data);die;
        $userId = $this->uri->segment(2);
        $this->data['uId']=$userId;
         if(!empty($userId)) {
        $this->data['byId'] = $this->welcome_model->getsinglerow('user', ['id' => $userId]);
        $this->data['state'] = $this->welcome_model->AllState();
        $this->data['country'] = $this->welcome_model->wholeresult('countries', [], []);
        $this->data['religionsName'] = $this->welcome_model->getRelegionNameById($userId);
        $this->data['subRName'] = $this->welcome_model->getCasteNameById($userId);

        $this->data['dharm'] = $this->welcome_model->wholeresult('religions', [], []);
        $this->data['subReli'] = $this->welcome_model->wholeresult('sub_religion', [], []);
        $this->data['districts'] = $this->welcome_model->wholeresult('districts', [], []);
        $this->data['ByIDRecord'] = $this->welcome_model->getsinglerowByuser($userId);

        $this->data['birth'] = $this->welcome_model->getsinglerowBirth($userId);
        $this->data['cast'] = $this->welcome_model->getsinglerowCast($userId);

        $this->data['pay'] = $this->welcome_model->getsinglerowPay($userId);
        $this->data['special'] = $this->welcome_model->getsinglerowSpecialay($userId);
        $this->data['family'] = $this->welcome_model->getsinglerowFamily($userId);
        $this->data['generation'] = $this->welcome_model->getsinglerowGeneration($userId);
        $this->data['health'] = $this->welcome_model->getsinglerowHealth($userId);
        $this->data['work'] = $this->welcome_model->getsinglerowWork($userId);
        //   print_r($data);die;
        $this->data['spclById'] = $this->welcome_model->getsinglerow(NRML_INFO_TBL, ['user_id' => $userId]);
        //  print_r($data);die;
        $this->data['education'] = $this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
        //  print_r($data);die;
        $this->data['mrge'] = $this->welcome_model->getsinglerow('marriage_information', ['user_id' => $userId]);
        $this->data['president'] = $this->welcome_model->getsinglerow(PRSTN_INFO_TBL, ['user_id' => $userId]);
    }
        // $this->data['page'] = 'my_information';
        // $this->data['content'] = 'myinformaion/my_information';
        // $this->load->view('user/template', $this->data);

        $this->data['page'] = 'user_all_history';
		$this->data['content'] = 'user/user_all_history';
		$this->load->view('admin/admintemplate',$this->data);
    }
	 function addimportent_note()
	{
		$this->data['imp'] = $this->admin_model->wholeresult('impartent_note',[],[]);
		
		if(!empty($_POST))
			{ 
				$this->form_validation->set_rules('description', 'description', 'required|xss_clean');		
				if($this->form_validation->run()==FALSE)
				{
					$this->data['page'] = 'importent';
					$this->data['content'] = 'other/impartent';
					$this->load->view('admin/admintemplate', $this->data);
				}
				else{
						$imp['date']=date("Y-m-d H:i:s");
						$imp['description']=$this->input->post('description');
						$this->admin_model->insertRecord('impartent_note',$imp);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Record Add Successfully');
						redirect(importent,'refresh');
					}
				
			}
		else{
				$this->data['page'] = 'impartent';
				$this->data['content'] = 'other/impartent';
				$this->load->view('admin/admintemplate', $this->data);
			}
	}
	 function delete_importent()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteImportent($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Record Deleted Successfully');

		redirect(importent);
	}
	function regional_experts()
	{
		$this->data['regi'] = $this->admin_model->wholeresult('regional_experts', [], []);
		$this->data['page'] = 'Regional Experts';
		$this->data['content'] = 'other/regional_experts';
		$this->load->view('admin/admintemplate', $this->data);
	}

	 function addregional_experts()
	{
		$this->data['regi'] = $this->admin_model->wholeresult('regional_experts',[],[]);
		
		if(!empty($_POST))
			{ 
				$this->form_validation->set_rules('first_name', 'First name', 'required|xss_clean');	
				$this->form_validation->set_rules('last_name', 'Surname', 'required|xss_clean');	
				$this->form_validation->set_rules('languege', 'languege', 'required|xss_clean');
				$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|xss_clean');
				$this->form_validation->set_rules('region', 'Region', 'required|xss_clean');

	
				if($this->form_validation->run()==FALSE)
				{
					$this->data['page'] = 'Regional Experts';
					$this->data['content'] = 'other/regional_experts';
					$this->load->view('admin/admintemplate', $this->data);
				}
				else{
						$regi['date']=date("Y-m-d H:i:s");
						$regi['first_name']=$this->input->post('first_name');
						$regi['last_name']=$this->input->post('last_name');
						$regi['languege'] = $this->input->post('languege');
						$regi['mobile'] = $this->input->post('mobile');
						$regi['region'] = $this->input->post('region');

						$this->admin_model->insertRecord('regional_experts',$regi);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Record Add Successfully');
						redirect(regional,'refresh');
					}
				
			}
		else{
				$this->data['page'] = 'Regional Experts';
				$this->data['content'] = 'other/regional_experts';
				$this->load->view('admin/admintemplate', $this->data);
			}
	}
	
	 function delete_regional()
	{
		$id=base64_decode($_GET['id']);
		$this->admin_model->deleteRegional($id);
		$this->session->set_flashdata('error', 'Delete!');
		$this->session->set_flashdata('message', 'Record Deleted Successfully');

		redirect(regional);
	}
	 function religions()
	{
		
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['page']="religions";
		$this->data['content']="religions/religions_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_religions($id=null)
	{
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		if (!empty($id)) {
		
			$this->data['IdByR'] = $this->admin_model->getsinglerow('religions_', ['id' => $id]);

			$this->data['page'] = "religions";
			$this->data['content'] = "religions/religions_list";
			$this->load->view('admin/admintemplate', $this->data);

		} else {
			if (!empty($_POST)) {
				$this->form_validation->set_rules('religions_name', 'Religions', 'required');

				if ($this->form_validation->run() == false) {
					$this->data['page'] = "religions";
					$this->data['content'] = "religions/religions_list";
					$this->load->view('admin/admintemplate', $this->data);

				} 
				else {
						
					if (!empty($this->input->post('id'))) 
					{
						$this->admin_model->updateRecord('religions_', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Religions Successfully Updated');
						redirect(religions, 'refresh');


					} 
					else {
							$this->welcome_model->insertRecord('religions_', $_POST);
							$this->session->set_flashdata('success', 'Great!');
							$this->session->set_flashdata('message', 'Religions Successfully Added');
							redirect(religions,'refresh');
					}
				}
			} 
			else {
				$this->data['page'] = "religions";
				$this->data['content'] = "religions/religions_list";
				$this->load->view('admin/admintemplate', $this->data);

			}
		}

	}
  function upgrade_notice()
	{
		
		$this->data['upgrade_notice'] = $this->admin_model->wholeresult('upgrade_notice', [], []);
		$this->data['page']="upgrade_notice";
		$this->data['content']="upgradenotice/upgrade_notice";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_upgrade_notice($id=null)
	{
		$this->data['upgrade_notice'] = $this->admin_model->wholeresult('upgrade_notice', [], []);
		if (!empty($id)) {
		
			$this->data['IdByR'] = $this->admin_model->getsinglerow('upgrade_notice', ['id' => $id]);

			$this->data['page'] = "upgrade_notice";
			$this->data['content'] = "upgradenotice/upgrade_notice";
			$this->load->view('admin/admintemplate', $this->data);

		} else {
			if (!empty($_POST)) {
				$this->form_validation->set_rules('message', 'message', 'required');
				if ($this->form_validation->run() == false) {
					$this->data['page'] = "upgrade_notice";
					$this->data['content'] = "upgradenotice/upgrade_notice";
					$this->load->view('admin/admintemplate', $this->data);

				} 
				else {
						
					if (!empty($this->input->post('id'))) 
					{
						$this->admin_model->updateRecord('upgrade_notice', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Upgrade notice Successfully Updated');
						redirect(upgrade_notice, 'refresh');


					} 
					else {
							$this->welcome_model->insertRecord('upgrade_notice', $_POST);
							$this->session->set_flashdata('success', 'Great!');
							$this->session->set_flashdata('message', 'Upgrade notice Successfully Added');
							redirect(upgrade_notice,'refresh');
					}
				}
			} 
			else {
				$this->data['page'] = "upgrade_notice";
				$this->data['content'] = "upgradenotice/upgrade_notice";
				$this->load->view('admin/admintemplate', $this->data);

			}
		}

	}
  function plans()
	{
		
		$this->data['plans'] = $this->admin_model->wholeresult('step_income_plan', [], []);
		$this->data['page']="plans_list";
		$this->data['content']="plans/plans_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_plans($id=null)
	{
		$this->data['plans'] = $this->admin_model->wholeresult('step_income_plan', [], []);
		if (!empty($id)) {
		
			$this->data['IdByR'] = $this->admin_model->getsinglerow('step_income_plan', ['id' => $id]);

			$this->data['page'] = "plans_list";
			$this->data['content'] = "plans/plans_list";
			$this->load->view('admin/admintemplate', $this->data);

		} else {
			if (!empty($_POST)) {
				$this->form_validation->set_rules('plan', 'Plan', 'required');
				$this->form_validation->set_rules('income', 'Income', 'required');
				$this->form_validation->set_rules('binary_plan', 'Binary plan', 'required');
				$this->form_validation->set_rules('p1', 'Paragraph 1', 'required');
				$this->form_validation->set_rules('p2', 'Paragraph 2', 'required');
				$this->form_validation->set_rules('p3', 'Paragraph 3', 'required');
				$this->form_validation->set_rules('p4', 'Paragraph 4', 'required');

				if ($this->form_validation->run() == false) {
					$this->data['page'] = "plans_list";
					$this->data['content'] = "plans/plans_list";
					$this->load->view('admin/admintemplate', $this->data);

				} 
				else {
						
					if (!empty($this->input->post('id'))) 
					{
						$this->admin_model->updateRecord('step_income_plan', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Plans Successfully Updated');
						redirect(add_plans, 'refresh');


					} 
					else {
							$this->welcome_model->insertRecord('step_income_plan', $_POST);
							$this->session->set_flashdata('success', 'Great!');
							$this->session->set_flashdata('message', 'Plans Successfully Added');
							redirect(add_plans,'refresh');
					}
				}
			} 
			else {
				$this->data['page'] = "plans_list";
				$this->data['content'] = "plans/plans_list";
				$this->load->view('admin/admintemplate', $this->data);

			}
		}

	}
  function caste()
	{
		//$this->data['caste'] = $this->admin_model->wholeresult('sub_religion_', [], []);
		$this->data['caste']=$this->admin_model->getReligions();
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['page']="religions";
		$this->data['content']="religions/caste_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_caste($id=null)
	{
		//$this->data['caste'] = $this->admin_model->wholeresult('sub_religion_', [], []);
		$this->data['caste'] = $this->admin_model->getReligions();
		
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		if (!empty($id)) {
			$Rid=$this->uri->segment(3);
			
			$this->data['IdByR'] = $this->admin_model->getsinglerow('sub_religion_', ['id' => $id]);
			$this->data['Rselected'] = $this->admin_model->getsinglerow('sub_religion_', ['id' => $Rid]);
			//echo '<pre>';print_r($this->data['Rselected']);die;
			$this->data['page'] = "religions";
			$this->data['content'] = "religions/caste_list";
			$this->load->view('admin/admintemplate', $this->data);


		} else {
			if (!empty($_POST)) {
				$this->form_validation->set_rules('sub_religions', 'caste', 'required');

				if ($this->form_validation->run() == false) {
					$this->data['page'] = "religions";
					$this->data['content'] = "religions/caste_list";
					$this->load->view('admin/admintemplate', $this->data);


				} else {

					if (!empty($this->input->post('id'))) {
						$this->admin_model->updateRecord('sub_religion_', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Caste Successfully Updated');
						redirect(caste,'refresh');

					} else {
						$this->welcome_model->insertRecord('sub_religion_', $_POST);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Caste Successfully Added');
						redirect(caste,'refresh');
					}
				}
			} else {
				$this->data['page'] = "religions";
				$this->data['content'] = "religions/caste_list";
				$this->load->view('admin/admintemplate', $this->data);


			}
		}	

	}
	function getcast()
	{
		$id = $_GET['id'];
		$data = $this->admin_model->wholeresult('sub_religion_', [], ['religions_id' => $id]);
		$array = [];
		foreach ($data as $row) {
			$array[] = "<option value='$row->id'>$row->sub_religions</option>";
		}
		//$temp = "<option value='0786'>Other</option>";
		//array_push($array, $temp);
		echo json_encode($array);
	}

  function sub_caste()
	{
		//$this->data['sub'] = $this->admin_model->wholeresult('sub_religion_category_', [], []);
		$this->data['sub'] = $this->admin_model->AllReligions();
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['page']="religions";
		$this->data['content']="religions/sub_caste_list";
		$this->load->view('admin/admintemplate',$this->data);
	}
	function add_sub_caste($id=null)
	{
		//var_dump($id);die;
		$this->data['sub'] = $this->admin_model->AllReligions();
		$this->data['religions'] = $this->admin_model->wholeresult('religions_', [], []);
		$this->data['sub'] = $this->admin_model->wholeresult('sub_religion_category_', [], []);

		if (!empty($id)) 
		{
			$Rid=$this->uri->segment(3);
			$this->data['Rselected'] = $this->admin_model->getsinglerow('sub_religion_', ['id' => $Rid]);
			
			$this->data['sub'] = $this->admin_model->AllReligions();
			$this->data['IdByR'] = $this->admin_model->getsinglerow('sub_religion_category_', ['id' => $id]);
			$this->data['page'] = "religions";
			$this->data['content'] = "religions/sub_caste_list";
			
			$this->load->view('admin/admintemplate', $this->data);


		} 
		else 
		{
			if (!empty($_POST)) 
			{
				$this->form_validation->set_rules('dharm', 'Sub Caste', 'required');

				if ($this->form_validation->run() == false)
				{
					$this->data['page'] = "religions";
					$this->data['content'] = "religions/sub_caste_list";
					$this->load->view('admin/admintemplate', $this->data);


				} 
				else 
				{

					if (!empty($this->input->post('id'))) 
					{
						$this->admin_model->updateRecord('sub_religion_category_', $_POST, ['id' => $this->input->post('id')]);
						$this->session->set_flashdata('success', 'Update!');
						$this->session->set_flashdata('message', 'Sub Caste Successfully Updated');
						redirect(sub_caste, 'refresh');

					} 
					else 
					{
						$this->welcome_model->insertRecord('sub_religion_category_', $_POST);
						$this->session->set_flashdata('success', 'Great!');
						$this->session->set_flashdata('message', 'Sub Caste Successfully Added');
						redirect(sub_caste, 'refresh');
					}
				}
			} 
			else 
			{
				$this->data['page'] = "religions";
				$this->data['content'] = "religions/sub_caste_list";
				$this->load->view('admin/admintemplate', $this->data);


			}
		}
	}
		  function fetch_user()
          {
            $draw = array();
            $this->load->model("Admin_model");
            $fetch_data = $this->Admin_model->make_datatables1();
             $data = array();
             $count = 1;
             foreach($fetch_data as $row) 
             {
             	
             	$userData = $this->Admin_model->getsinglerow('user',array('sponsor_id'=>$row->user_id));
         
                 $sub_array = array();
                 $sub_array[] = $count++;
                 $sub_array[] = $userData->sponsor_id;
                 $sub_array[] = ucfirst($userData->full_name);
                 $sub_array[] = $userData->mobile;
                 $sub_array[] = $userData->email;
                 $sub_array[] = '';
                 $sub_array[] = date('d-m-Y',strtotime($row->on_date));
                 $sub_array[] = $row->on_pair;
                 $sub_array[] = $row->income;
                 $sub_array[] = $row->leps_income;
                 $data[] = $sub_array;
             }
             $output = array(
                 "draw"            => intval($_POST['draw']),
                 "recordsTotal"    => $this->Admin_model->get_all_data1(),
                 "recordsFiltered" => $this->Admin_model->get_filtered_data1(),
                 "data"            => $data
                 );
                 echo json_encode($output);
          } 
          
         function fetch_income()
          {
            $draw = array();
            $this->load->model("Admin_model");
            $this->load->model("Welcome_model");
            $fetch_data = $this->Admin_model->make_datatables2();
          
             $data = array();
             $count = 1;
             $stepDate = '';
             $stepIncome ='';
             $matchIncome ='';
             $tot_Income ='';
             $epinIncome ='';
             $newEpinIncome ='';
             $price ='';
             foreach($fetch_data as $row) 
             {
                 $userID = $row->sponsor_id;
                 $todaystepIncome = $this->Welcome_model->getTodayStepIncome($userID);
                 $todaymatchIncome = $this->Welcome_model->getTodayMatchIncome($userID);
                 $reacived_epin = $this->Welcome_model->getsinglerow('epin_transfer',array('to_user'=>$userID));
                 if(!empty($todaystepIncome->level_income))
                 {
                     $stepIncome = $todaystepIncome->level_income;
                 }else{
                    $stepIncome = '0.00'; 
                 }
                  if(!empty($todaymatchIncome->income))
                 {
                     $matchIncome = $todaymatchIncome->income;
                 }else{
                    $matchIncome = '0.00'; 
                 }
                  if(!empty($reacived_epin->no_of_epin))
                 {
                     $epinIncome = unserialize($reacived_epin->no_of_epin);
                     foreach($epinIncome as $a) {
                     $epinIncome2 = $a['price'];
                    
                     }
                 }else{
                    $epinIncome2 = '0.00'; 
                 }
                 $tot_Income = $stepIncome + $matchIncome;
                 $sub_array = array();
                 $sub_array[] = $count++;
                 $sub_array[] = $row->sponsor_id;
                 $sub_array[] = ucfirst($row->full_name);
                 $sub_array[] = $row->mobile;
                 $sub_array[] = $row->email;
                 $sub_array[] = $row->upgrade_plan;
                 $sub_array[] = date('d-m-Y',strtotime($row->create_at));
                 $sub_array[] = $stepIncome;
                 $sub_array[] = $matchIncome;
                 $sub_array[] = '0.00';
                 $sub_array[] = $tot_Income;
                 $sub_array[] = $epinIncome2;
                 $sub_array[] = '0.00';
                 $data[] = $sub_array;
             }
  
             $output = array(
                 "draw"            => intval($_POST['draw']),
                 "recordsTotal"    => $this->Admin_model->get_all_data2(),
                 "recordsFiltered" => $this->Admin_model->get_filtered_data2(),
                 "data"            => $data
                 );
                 echo json_encode($output);
              
          }
       
          
          function fetch_step_income()
          {
              $draw = array();
            $this->load->model("Admin_model");
            $fetch_data = $this->Admin_model->make_datatables();
          
             $data = array();
             $userData = '';
             $step1 = '';$step2 = '';$step3 = '';$step4 = '';$step5 = '';$step6 = '';$step7 = '';$step8 = '';$step9 = '';$step10 = '';$step11 = '';$step12 = '';$step13 = '';$step14 = '';$step15 = '';$step16 = '';$step17 = '';$step18 = '';$step19 = '';$step20 = '';
             $tot_step = '';
             $count = 1;
           $upgrade_plan="";
             foreach($fetch_data as $row) 
             {
                 $upgrade_plan="";
                 if(!empty($row)) {
                 $userData = $this->Admin_model->getsinglerow('user',array('sponsor_id'=>$row->sponsor_id));
               
                $upgrade_plan=$userData->upgrade_plan;
            
                     
                 }else{
                     
                    $upgrade_plan="";  
                 }
                //  echo '<pre>';
                //  print_r($userData);
                //  die;
                
                
                  if($row->level==1) {
                 $step1 = $row->level_income;
                 }else{
                      $step1 = '0.00';
                 }
                  if($row->level==2) {
                 $step2 = $row->level_income;
                 }else{
                      $step2 = '0.00';
                 }
                 
                  if($row->level==3) {
                 $step3 = $row->level_income;
                 }else{
                      $step3 = '0.00';
                 }
                 
                  if($row->level==4) {
                 $step4 = $row->level_income;
                 }else{
                      $step4 = '0.00';
                 }
                 
                  if($row->level==5) {
                 $step5 = $row->level_income;
                 }else{
                      $step5 = '0.00';
                 }
                 
                  if($row->level==6) {
                 $step6 = $row->level_income;
                 }else{
                      $step6 = '0.00';
                 }
                 
                  if($row->level==7) {
                 $step7 = $row->level_income;
                 }else{
                      $step7 = '0.00';
                 }
                 
                  if($row->level==8) {
                 $step8 = $row->level_income;
                 }else{
                      $step8 = '0.00';
                 }
                 
                  if($row->level==9) {
                 $step9 = $row->level_income;
                 }else{
                      $step9 = '0.00';
                 }
                 
                  if($row->level==10) {
                 $step10 = $row->level_income;
                 }else{
                      $step10 = '0.00';
                 }
                 
                  if($row->level==11) {
                 $step11 = $row->level_income;
                 }else{
                      $step11 = '0.00';
                 }
                 
                   if($row->level==12) {
                 $step12 = $row->level_income;
                 }else{
                      $step12 = '0.00';
                 }
                 
                   if($row->level==13) {
                 $step13 = $row->level_income;
                 }else{
                      $step13 = '0.00';
                 }
                 
                   if($row->level==14) {
                 $step14 = $row->level_income;
                 }else{
                      $step14 = '0.00';
                 }
                 
                   if($row->level==15) {
                 $step15 = $row->level_income;
                 }else{
                      $step15 = '0.00';
                 }
                 
                   if($row->level==16) {
                 $step16 = $row->level_income;
                 }else{
                      $step16 = '0.00';
                 }
                 
                   if($row->level==17) {
                 $step17 = $row->level_income;
                 }else{
                      $step17 = '0.00';
                 }
                 
                   if($row->level==18) {
                 $step18 = $row->level_income;
                 }else{
                      $step18 = '0.00';
                 }
                 
                   if($row->level==19) {
                 $step19 = $row->level_income;
                 }else{
                      $step19 = '0.00';
                 }
                 
                   if($row->level==20) {
                 $step20 = $row->level_income;
                 }else{
                      $step20 = '0.00';
                 }
                
                  $tot_step = $step1+$step2+$step3+$step4+$step5+$step6+$step7+$step8+$step9+$step10+$step11+$step12+$step13+$step14+$step15+$step16+$step17+$step18+$step19+$step20;
             
                
                 $sub_array = array();
             
                 $sub_array[] = $count++;
                 $sub_array[] = $userData->sponsor_id;
                 $sub_array[] = $userData->full_name;
                 $sub_array[] = $userData->mobile;
                 $sub_array[] = $userData->email;
                 $sub_array[] = $upgrade_plan;
                 $sub_array[] = date('d-m-Y',strtotime($row->create_at));
                 $sub_array[] = $step1;
                 $sub_array[] = $step2;
                 $sub_array[] = $step3;
                 $sub_array[] = $step4;
                 $sub_array[] = $step5;
                 $sub_array[] = $step6;
                 $sub_array[] = $step7;
                 $sub_array[] = $step8;
                 $sub_array[] = $step9;
                 $sub_array[] = $step10;
                 $sub_array[] = $step11;
                 $sub_array[] = $step12;
                 $sub_array[] = $step13;
                 $sub_array[] = $step14;
                 $sub_array[] = $step15;
                 $sub_array[] = $step16;
                 $sub_array[] = $step17;
                 $sub_array[] = $step18;
                 $sub_array[] = $step19;
                 $sub_array[] = $step20;
                 $sub_array[] = $tot_step;
                 
                 $data[] = $sub_array;
                //  echo '<pre>';
                //  print_r($data);
                //  die;
                

             }
            
             $output = array(
                 "draw"            => intval($_POST['draw']),
                 "recordsTotal"    => $this->Admin_model->get_all_data(),
                 "recordsFiltered" => $this->Admin_model->get_filtered_data(),
                 "data"            => $data
                 );
                 echo json_encode($output);
                  
              
          }

        public function fetch_income_weekly()
       {
         $this->load->model("Admin_model");
        $list = $this->Admin_model->get_datatables3();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->sponsor_id;
            $row[] = ucfirst($customers->full_name);
            $row[] = $customers->mobile;
            $row[] = $customers->email;
            $row[] = $customers->upgrade_plan;
            // $row[] = date('d-m-Y',strtotime($customers->sponsor_id));
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
            $row[] = $customers->sponsor_id;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Admin_model->count_all(),
                        "recordsFiltered" => $this->Admin_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
	
function admin_logout()
	{
		$session = array('id', 'id');
		$this->session->unset_userdata($session);
		$this->session->sess_destroy();
		redirect(BASEURL);
	}

}


?>

