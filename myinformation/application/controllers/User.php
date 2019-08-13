<?php defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/Auth.php");
ini_set('memory_limit', '-1');
ini_set('max_execution_time', '250MB');
class User extends Auth
{
    public $i = 0;
    public $mybenifit = 0;

    public $allorder = array();
    public $alldata = array();
    public $isNotFirstTime = 0;
    public $isRightStart = 0;
    public $tempFirstRightSponsorId = "";
    public $tempSponsorArray = array();
    public $downlineleft = array();
    public $downlineright = array();
    public $allrightids = array();
    public $allleftids = array();
    public $rightPending  = array();
    public $leftPending  = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'encrypt'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->model(array('welcome_model', 'jscss_model'));
        $this->load->database();
        if (empty($this->session->userdata['user'])) {
            redirect(login);
        }
        date_default_timezone_set('Asia/Kolkata');
        $income = $this->welcome_model->getspecificcolomn(TBL_USER, ['binary_benifi'], ['sponsor_id' => sponsorid()]);
        $this->mybenifit = $income->binary_benifi;
    }


    function model()
    {
        $this->data['page'] = 'model';
        $this->data['content'] = 'dashboard/model';
        $this->load->view('user/template', $this->data);
    }
    function update_member()
    {
        $id = $this->session->userdata['user']['id'];
        if (!empty($_POST)) {
            $this->form_validation->set_rules('profile_type', 'Member type', 'required');

            if ($this->form_validation->run() == false) {
                $this->data['page'] = 'model';
                $this->data['content'] = 'dashboard/model';
                $this->load->view('user/template', $this->data);
            } else {
                $up['profile_type'] = $this->input->post('profile_type');
                if ($this->welcome_model->updateRecord(TBL_USER, $up, ['id' => $id])) {
                    $this->session->set_flashdata('class', 'custom');
                    $this->session->set_flashdata('success', 'Member Type updated successfully');
                    redirect(activation);
                }
            }
        }
    }
    private function singleImage($path, $imagename)
    {

        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($imagename)) {
            return false;
        } else {
            $data = $this->upload->data();
            return  $data['file_name'];
        }
    }
    function index()
    {
        $sposorId = $this->session->userdata['user']['sponsor_id'];
        $sponser = $this->welcome_model->getsinglerow(TBL_TREE, ['self_id' => $sposorId]);

        $addedby = $sponser->added_by;
        $this->data['My_Sponsor_User_ID'] = $this->welcome_model->getsinglerow(TBL_USER, ['sponsor_id' => $addedby]);
        // print_r($data);die;
        if ($this->mybenifit != 0)
            Auth::getincome(sponsorid(), $this->mybenifit);

        $this->data['page'] = 'index';
        $this->data['content'] = 'dashboard/index';
        $this->load->view('user/template', $this->data);
    }
    function graphicalView()
    {
        $this->data['page'] = 'graphical_view';
        $this->data['content'] = 'geneoalogy/graphical_view';
        $this->load->view('user/template', $this->data);
    }
    /**
     *  get tree view 27 May, 2019 7PM 
     *  dev: sudheer
     */
    function gettreeview($id = '12345678')
    {
        $data = $this->welcome_model->getsponsername($id);
        $res = $this->welcome_model->gettreeinfo();
        foreach ($res as $row) {
            $this->alldata[$row->self_id] = array($row->child_left, $row->child_right);
        }
        $orderarr = $this->welcome_model->getcustomebillinfo();
        foreach ($orderarr as $row) {
            $this->allorder[] = $row->user_id;
        }
        $this->isNotFirstTime = 0;
        $this->isRightStart = 0;
        $this->tempFirstRightSponsorId = "";
        $this->downlineleft = array();
        $this->downlineright = array();
        $this->allrightids = array();
        $this->allleftids = array();
        $this->isDownlineExist($id);
        return $array = array('name'=>$data->name,'member_id' => $data->self_id, 'added_by' => $data->added_by, 'child_left'=>$data->child_left, 'child_right'=>$data->child_right,'activation_date' => $data->is_active_date, 'totalLeft' => count($this->allleftids), 'totalRight' => count($this->allrightids), 'leftActive' => count($this->downlineleft), 'rightActive' => count($this->downlineright), 'leftPending' => count($this->leftPending), 'rightPending' => count($this->rightPending));
        echo "<pre>";
        print_r($array);
    }
    private function imageupload($path, $name)
    {
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($name)) {
            $message = array('message' => 'Only jpg , jpeg, gif, png file allowed', 'success' => 0);
        } else {
            $data = $this->upload->data();
            $message = array('message' => $data['file_name'], 'success' => 1);
        }
        return $message;
    }
    private function MultipleImageUpload($files, $path, $title)
    {
        $tempp = array_filter($files['name']);
        // for multiple file uploads
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => 1,
        );
        $this->load->library('upload', $config);
        $images = array();
        foreach ($tempp as $key => $image) {
            $_FILES['images[]']['name'] = $files['name'][$key];
            $_FILES['images[]']['type'] = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error'] = $files['error'][$key];
            $_FILES['images[]']['size'] = $files['size'][$key];
            $fileName = $title . '_' . $image;
            $images[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        //print_r($images);die;
        return $images;
    }
    function userprofile()
    {
        $id = $this->session->userdata['user']['id'];
        $this->form_validation->set_rules('full_name', 'Full name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        if ($this->form_validation->run() == false) { } else {
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

            //echo '<pre>'; print_r($save);die;
            if ($this->welcome_model->updateRecord(TBL_USER, $save, ['id' => $id])) {
                $this->session->set_flashdata('class', 'custom');
                $this->session->set_flashdata('success', 'Profile updated successfully');
            }
        }
        $this->data['profile'] = $this->welcome_model->getsinglerow(TBL_USER, ['id' => $id]);
        $this->data['page'] = 'show_profile';
        $this->data['content'] = 'Profile_manager/show_profile';
        $this->load->view('user/template', $this->data);
    }
    function setting()
    {
        $id = $this->session->userdata['user']['id'];
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('password', 'New Password', 'required');
        $this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run() == false) { } else {
            extract($_POST);
            if ($this->welcome_model->getsinglerow(TBL_USER, ['password' => sha1($old_password), 'id' => $id])) {

                $this->welcome_model->updateRecord(TBL_USER, ['password' => sha1($password)], ['id' => $id]);

                $this->session->set_flashdata('class', 'custom');
                $this->session->set_flashdata('message', 'Password successfully updated');
            } else {
                $this->session->set_flashdata('class', 'error');
                $this->session->set_flashdata('message', 'Old password not correct');
            }
        }
        $this->data['page'] = 'show_profile';
        $this->data['content'] = 'Profile_manager/setting';
        $this->load->view('user/template', $this->data);
    }
    public function personal_details()
    {
        $this->data['page'] = 'other_details';
        $this->data['content'] = 'Profile_manager/other_details';
        $this->load->view('user/template', $this->data);
    }
    // public function getAllCity($id)
    // {
    // 	$data = $this->welcome_model->getCity($id);
    // 	echo "<option> Select City</option>";
    // 	foreach($data as $row)
    // 	{
    // 		echo "<option value='$row->name'>$row->name</option>";
    // 	}
    // }
    public function getallstate($id)
    {
        $data = $this->welcome_model->getstateRecored($id);
        foreach ($data as $row) {
            echo "<option value='$row->id'>$row->name</option>";
        }
    }
    public function getallcity($id)
    {
        $data = $this->welcome_model->getcityRecored($id);
        foreach ($data as $row) {
            echo "<option value='$row->name'>$row->name</option>";
        }
    }
    //  public function getallCountry()
    //  {
    // 	  $data=$this->welcome_model->getCountryList();
    //  }
    public function my_information()
    {
        $data = $this->welcome_model->getCountryList();
        // print_r($data);die;
        $userId = $this->session->userdata['user']['id'];
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

        $this->data['page'] = 'my_information';
        $this->data['content'] = 'myinformaion/my_information';
        $this->load->view('user/template', $this->data);
    }

    function dummy()
    {
        $array = [];
        $this->form_validation->set_rules('fname', 'your name', 'required');
        //$this->form_validation->set_rules('gender','your gender','required');
        $this->form_validation->set_rules('father_name1', 'father name', 'required');
        // $this->form_validation->set_rules('married_status','married status','required');
        // $this->form_validation->set_rules('religions','religions','required');
        // $this->form_validation->set_rules('language','language','required');
        // $this->form_validation->set_rules('district','district','required');
        //$this->form_validation->set_rules('city', 'city', 'required');
        // $this->form_validation->set_rules('country','country','required');

        if ($this->form_validation->run() == FALSE) {
            $array = array(
                'fname' => form_error('fname'),
                //'gender' => form_error('gender'),
                'father_name' => form_error('father_name1'),
                //'city' => form_error('city')
                // 'language' => form_error('language'),
                // 'district' => form_error('district'),
                // 'religions' => form_error('religions'),
                // 'state' => form_error('state'),
                // 'country' => form_error('country')
            );
        } else {
            $newGender = ''; $newunmarrid_type ='';
            
            if(!empty($this->input->post('gender1')))
            {
                $newGender = $this->input->post('gender1');
            }elseif(!empty($this->input->post('gender2')))
            {
                $newGender = $this->input->post('gender2');
            }elseif (!empty($this->input->post('gender3'))) 
            {
                $newGender = $this->input->post('gender3');
            }elseif (!empty($this->input->post('gender4'))) 
            {
                $newGender = $this->input->post('gender4');
            }else{
               $newGender = 'N/A'; 
            }

            if(!empty($this->input->post('unmarrid_type1')))
            {
                $newunmarrid_type = $this->input->post('unmarrid_type1');
            }elseif(!empty($this->input->post('unmarrid_type2')))
            {
                $newunmarrid_type = $this->input->post('unmarrid_type2');
            }elseif (!empty($this->input->post('unmarrid_type3'))) 
            {
                $newunmarrid_type = $this->input->post('unmarrid_type3');
           }else{
               $newunmarrid_type = 'N/A'; 
            }

            extract($_POST);
            unset($_POST['gender1']);
            unset($_POST['gender2']);
            unset($_POST['gender3']);
            unset($_POST['gender4']);
            unset($_POST['unmarrid_type1']);
            unset($_POST['unmarrid_type2']);
            unset($_POST['unmarrid_type3']);
            unset($_POST['father_name1']);
            $data = $_POST;

            $data['gender'] = $newGender;
            $data['unmarrid_type'] = $newunmarrid_type;
            // $data['dharm'] = $this->input->post('dharm');
           
          
            if (is_numeric($country) && is_numeric($state)) {
                $countryName =  $this->welcome_model->getspecificcolomn('countries', ['name'], ['id' => $country]);
                $stateName =  $this->welcome_model->getspecificcolomn('states', ['name'], ['id' => $state]);
                $data['country'] =   $countryName->name;
                $data['state'] =   $stateName->name;
            } else {
                unset($data['country']);
                unset($data['state']);
            }
            $id = userid();
            $istrue = 1;
            $arrayFilter = array_values(array_filter($_FILES['photo_1']['name']));
            if (!empty($arrayFilter)) {
                $image = $this->MultipleImageUpload($_FILES['photo_1'], './uploads/profile', 'photo_1');
                if ($image != false) {
                    $data['photo_1'] = serialize($image);
                } else {
                    $istrue = 0;
                }
            }
            // echo '<pre>';
            // print_r($data);
            // die;

            if ($istrue != 0) {
                if ($this->welcome_model->getsinglerow(NRML_INFO_TBL, ['user_id' => $id])) {

                    $this->welcome_model->updateRecord(NRML_INFO_TBL, $data, ['user_id' => $id]);

                    $array = array('success' =>  'General Information Successfully Updated');
                } else {
                    $this->welcome_model->insertRecord(NRML_INFO_TBL, $data);
                    $array = array('success' => ' General Information Successfully Saved');
                }
            } else {
                $array = array('success' => 'Wrong Format');
            }
        }
        //    echo '<pre>';print_r($array);die;
        echo json_encode($array);
    }
    public function birth_info()
    {
        $array = [];
        $this->form_validation->set_rules('birth_of_name', 'birth-name', 'required');
        $this->form_validation->set_rules('place_of_birth', 'palce of birth', 'required');
        $this->form_validation->set_rules('birth_village', 'birth_village', 'required');
        $this->form_validation->set_rules('tehsil', 'tehsil', 'required');
        if ($this->form_validation->run() == false) {
            $array = array(
                'birth_of_name' => form_error('birth_of_name'),
                'place_of_birth' => form_error('place_of_birth'),
                'birth_village' => form_error('birth_village'),
                'tehsil' => form_error('tehsil'),
            );
        } else {
              $bithDate = $this->input->post('dob');
            $newbirthDate = date('Y-m-d',strtotime($bithDate));
            $data = array(
                'user_id' => $this->input->post('user_id'),
                'dob' => $newbirthDate,
                'time' => $this->input->post('time'),
                'birth_of_name' => $this->input->post('birth_of_name'),
                'place_of_birth' => $this->input->post('place_of_birth'),
                'birth_village' => $this->input->post('birth_village'),
                'tehsil' => $this->input->post('tehsil'),
                'district' => $this->input->post('district'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country')
            );
           // $data = $_POST;
            $id = userid();
            $istrue = 1;
            $arrayFilter = array_values(array_filter($_FILES['kundli_img']['name']));
            if (!empty($arrayFilter)) {
                $image = $this->MultipleImageUpload($_FILES['kundli_img'], './uploads/birth_kundali', 'kundli_img');
                if ($image != false) {
                    $data['kundli_img'] = serialize($image);
                } else {
                    $istrue = 0;
                }
            }
            // echo '<pre>';
            // print_r($data); die;

            if ($istrue != 0) {
                if ($this->welcome_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $id])) {
                    $this->welcome_model->updateRecord(BIRT_INFO_TBL, $data, ['user_id' => $id]);
                    $array = array('success' => 'Birth Information Successfully Updated');
                } else {
                    $this->welcome_model->insertRecord(BIRT_INFO_TBL, $data);
                    $array = array('success' => ' Birth Information Successfully Saved');
                }
            } else {
                $array = array('success' => 'Wrong Format');
            }
        }
        echo json_encode($array);
    }
    function cast_information()
    {
        $array = [];
        // $this->form_validation->set_rules('gauta', 'your gauta', 'required');
        // $this->form_validation->set_rules('kul', 'your kul', 'required');
        // $this->form_validation->set_rules('kuldevi_name', 'kuldevi name', 'required');
        // $this->form_validation->set_rules('address_of_kuldevi', 'address of kuldevi', 'required');
        // $this->form_validation->set_rules('kuldevata_name', 'kuldevata name', 'required');
        // $this->form_validation->set_rules('kuldevata_address', 'kuldevata address', 'required');
        // $this->form_validation->set_rules('maama_gautr', 'maama-gautr', 'required');
        // $this->form_validation->set_rules('maama_kul', 'maama-kul', 'required');



        // if ($this->form_validation->run() == false) {
        //     $array = array(
        //                 'gauta' => form_error('gauta'),
        //                 'kul' => form_error('kul'),
        //                 'kuldevi_name' => form_error('kuldevi_name'),
        //                 'address_of_kuldevi' => form_error('address_of_kuldevi'),
        //                 'kuldevata_name' => form_error('kuldevata_name'),
        //                 'kuldevata_address' => form_error('kuldevata_address'),
        //                 'maama_gautr' => form_error('maama_gautr'),
        //                 'maama_kul' => form_error('maama_kul'),
        //             );

        // } else {
        // $data['user_id'] = $this->input->post('user_id');
        $data = $_POST;
        $id = userid();
        $istrue = 1;
        /*=========--------------Kuldevi Image--------========================== */
        $arrayFilter = array_values(array_filter($_FILES['kuldevi_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['kuldevi_img'], './uploads/kuldevi', 'kuldevi_img');
            if ($image != false) {
                $data['kuldevi_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        } 
        /*=========--------------Kuldevata Image--------========================== */
        $arrayFilterKul = array_values(array_filter($_FILES['kuldevata_img']['name']));
        if (!empty($arrayFilterKul)) {
            $imageKul = $this->MultipleImageUpload($_FILES['kuldevata_img'], './uploads/kuldevata', 'kuldevata_img');
            if ($imageKul != false) {
                $data['kuldevata_img'] = serialize($imageKul);
            } else {
                $istrue = 0;
            }
        }
         /*=========----------------------========================== */
        $arrayFilterInfo = array_values(array_filter($_FILES['info_img']['name']));
        if (!empty($arrayFilterInfo)) {
            $imageInfo = $this->MultipleImageUpload($_FILES['info_img'], './uploads/information', 'info_img');
            if ($imageInfo != false) {
                $data['info_img'] = serialize($imageInfo);
            } else {
                $istrue = 0;
            }
        }
        // echo '<pre>';
        // print_r($data);
        // die;

        //if ($istrue != 0) {
        if ($this->welcome_model->getsinglerow(CST_INFO_TBL, ['user_id' => $id])) {
            $this->welcome_model->updateRecord(CST_INFO_TBL, $data, ['user_id' => $id]);
            $array = array('success' => 'Caste Information Successfully Updated');
        } else {
            $this->welcome_model->insertRecord(CST_INFO_TBL, $data);
            $array = array('success' => ' Caste Information Successfully Saved');
        }

        //  } else {
        //    $array = array('success' => 'Wrong Format');
        // }

        // }
        echo json_encode($array);
    }
    function pay_information()
    {
        $array = [];
        // if($this->form_validation->run()==false)
        // {
        //     echo "hii";die; 
        // }else{
        // echo '<pre>';print_r($_FILES);die;

        $id = userid();
        // $arrayFilterInfo12 = array_values(array_filter($_FILES['passbook_front_img']['name']));
        // if (!empty($arrayFilterInfo12)) {
        //     $imageInfo = $this->MultipleImageUpload($_FILES['passbook_front_img'], './uploads/passbookimg', 'passbook_front_img');
        //     if ($imageInfo != false) {
        //         $data['passbook_front_img'] = serialize($imageInfo);
        //     } else {
        //         $istrue = 0;
        //     }
        // }
        $save['ac_holder_name'] = $this->input->post('ac_holder_name');
        $save['account_no'] = $this->input->post('account_no');
        $save['bank_name'] = $this->input->post('bank_name');
        $save['branch'] = $this->input->post('branch');
        $save['ifsc'] = $this->input->post('ifsc');

        // $save['ac_holder_name']=serialize($add1);
        // $save['account_no']=serialize($add2);
        // $save['branch']=serialize($add3);
        // $save['bank_name']=serialize($add4);
        // $save['ifsc']=serialize($add5);

        $save['paytm_no'] = $this->input->post('paytm_no');
        $save['paytm_address'] = $this->input->post('paytm_address');
        $save['bhim_address'] = $this->input->post('bhim_address');
        $save['bhim_no'] = $this->input->post('bhim_no');
        $save['google_pay'] = $this->input->post('google_pay');
        $save['phonepe_no'] = $this->input->post('phonepe_no');
        $save['google_upi'] = $this->input->post('google_upi');
        $save['phonepe_upi'] = $this->input->post('phonepe_upi');
        $save['other_pay_no'] = $this->input->post('other_pay_no');
        $save['other_upi'] = $this->input->post('other_upi');
        $save['other_address'] = $this->input->post('other_address');
        $save['user_id'] = $id;

        if (!empty($_FILES['passbook_front_img']['name'])) {
            // echo '<pre>';print_r($_FILES);die;
            $arrayFilterInfo12 = array_values(array_filter($_FILES['passbook_front_img']['name']));
            if (!empty($arrayFilterInfo12)) {
                $imageInfo = $this->MultipleImageUpload($_FILES['passbook_front_img'], './uploads/passbookimg', 'passbook_front_img');
                if ($imageInfo != false) {
                    $save['passbook_front_img'] = serialize($imageInfo);
                } else {
                    $istrue = 0;
                }
            }
        }

        if ($this->welcome_model->getsinglerow(PAY_INFO_TBL, ['user_id' => $id])) {
            $this->welcome_model->updateRecord(PAY_INFO_TBL, $save, ['user_id' => $id]);
            $array = array('success' => 'Record Updated');
        } else {
            $this->welcome_model->insertRecord(PAY_INFO_TBL, $save);
            $array = array('success' => 'Record Saved');
        }

        // echo '<pre>';print_r($array);die;
        echo json_encode($array);
    }


    function special_information()
    {
        $array = [];
        // $this->form_validation->set_rules('votar_no', 'Voter number', 'required');
        // if ($this->form_validation->run() == false)
        //  {
        //     $array = array(
        //                 'votar_no' => form_error('votar_no'),

        //             );

        // } else {
        $data = $_POST;
        $id = userid();
        $istrue = 1;
        /*=============------------------Votar Id------================ */

        $arrayFilter = array_values(array_filter($_FILES['votar_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['votar_img'], './uploads/special/voter', 'votar_img');
            if ($image != false) {
                $data['votar_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        }

        $arrayFilter = array_values(array_filter($_FILES['cast_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['cast_img'], './uploads/special/cast', 'cast_img');
            if ($image != false) {
                $data['cast_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        }
        /*=============------------------Aadhar Cart------================ */

        $arrayFilterAd = array_values(array_filter($_FILES['aadhar_img']['name']));
        if (!empty($arrayFilterAd)) {
            $imageAd = $this->MultipleImageUpload($_FILES['aadhar_img'], './uploads/special/addhar', 'aadhar_img');
            if ($imageAd != false) {
                $data['aadhar_img'] = serialize($imageAd);
            } else {
                $istrue = 0;
            }
        }
        /*=============------------------ Pan Card------================ */
        $arrayFilterPan = array_values(array_filter($_FILES['pan_img']['name']));
        if (!empty($arrayFilterPan)) {
            $imagePan = $this->MultipleImageUpload($_FILES['pan_img'], './uploads/special/pan', 'pan_img');
            if ($imagePan != false) {
                $data['pan_img'] = serialize($imagePan);
            } else {
                $istrue = 0;
            }
        }
        /*=============------------------ Birth Certificate------================ */
        $arrayFilterBRTH = array_values(array_filter($_FILES['birth_img']['name']));
        if (!empty($arrayFilterBRTH)) {
            $imageBRTH = $this->MultipleImageUpload($_FILES['birth_img'], './uploads/special/birth', 'birth_img');
            if ($imageBRTH != false) {
                $data['birth_img'] = serialize($imageBRTH);
            } else {
                $istrue = 0;
            }
        }
        /*=============------------------ Birth Certificate------================ */
        $arrayFilterINCM = array_values(array_filter($_FILES['income_img']['name']));
        if (!empty($arrayFilterINCM)) {
            $imageINCM = $this->MultipleImageUpload($_FILES['income_img'], './uploads/special/income', 'income_img');
            if ($imageINCM != false) {
                $data['income_img'] = serialize($imageINCM);
            } else {
                $istrue = 0;
            }
        }

        $arrayFilterDes = array_values(array_filter($_FILES['disability_img']['name']));
        if (!empty($arrayFilterDes)) {
            $imageDes = $this->MultipleImageUpload($_FILES['disability_img'], './uploads/special/desable', 'disability_img');
            if ($imageDes != false) {
                $data['disability_img'] = serialize($imageDes);
            } else {
                $istrue = 0;
            }
        }
        /*=============------------------ speciality_img------================ */
        $arrayFilterDes1 = array_values(array_filter($_FILES['speciality_img']['name']));
        if (!empty($arrayFilterDes1)) {
            $imageDes1 = $this->MultipleImageUpload($_FILES['speciality_img'], './uploads/special/speciality_img', 'speciality_img');
            if ($imageDes1 != false) {
                $data['speciality_img'] = serialize($imageDes1);
            } else {
                $istrue = 0;
            }
        }
        if ($istrue != 0) {
            if ($this->welcome_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $id])) {
                $this->welcome_model->updateRecord(SPCL_INFO_TBL, $data, ['user_id' => $id]);
                $array = array('success' => 'Special Information Successfully Updated');
            } else {
                $this->welcome_model->insertRecord(SPCL_INFO_TBL, $data);
                $array = array('success' => ' Special Information Successfully Saved');
            }
        } else {
            $array = array('success' => 'Wrong Format');
        }


        //  echo '<pre>';print_r($array);die;
        echo json_encode($array);
    }
    function education_information()
    {

        $array = [];
        $data = $_POST;

        $id = userid();
        $istrue = 1;
        /*=========--------------School's  Education--------========================== */
        $arrayFilter = array_values(array_filter($_FILES['tenth_class_certificate_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['tenth_class_certificate_img'], './uploads/education/school', 'tenth_class_certificate_img');
            if ($image != false) {
                $data['tenth_class_certificate_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        }
        $arrayFilter = array_values(array_filter($_FILES['twelfth_class_certificate_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['twelfth_class_certificate_img'], './uploads/education/school', 'twelfth_class_certificate_img');
            if ($image != false) {
                $data['twelfth_class_certificate_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        }
        $arrayFilter = array_values(array_filter($_FILES['graduation_certificate_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['graduation_certificate_img'], './uploads/education/school', 'graduation_certificate_img');
            if ($image != false) {
                $data['graduation_certificate_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        }
        $arrayFilter = array_values(array_filter($_FILES['postgraduation_certificate_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['postgraduation_certificate_img'], './uploads/education/school', 'postgraduation_certificate_img');
            if ($image != false) {
                $data['postgraduation_certificate_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        }
        $arrayFilter = array_values(array_filter($_FILES['other_education_certificate_img']['name']));
        if (!empty($arrayFilter)) {
            $image = $this->MultipleImageUpload($_FILES['other_education_certificate_img'], './uploads/education/school', 'other_education_certificate_img');
            if ($image != false) {
                $data['other_education_certificate_img'] = serialize($image);
            } else {
                $istrue = 0;
            }
        }
        /*=========--------------Collage certificate Image--------========================== */
        // $arrayFilterCLLG = array_values(array_filter($_FILES['certificate']['name']));
        // if (!empty($arrayFilterCLLG)) {
        //     $imageCLLG = $this->MultipleImageUpload($_FILES['certificate'], './uploads/education/college', 'certificate');
        //     if ($imageCLLG != false) {
        //         $data['certificate'] = serialize($imageCLLG);
        //     } else {
        //         $istrue = 0;
        //     }
        // }
        // /*=========-------------------Other certificate---========================== */
        // $arrayFilterInfo = array_values(array_filter($_FILES['other_certificate']['name']));
        // if (!empty($arrayFilterInfo)) {
        //     $imageInfo = $this->MultipleImageUpload($_FILES['other_certificate'], './uploads/education/other', 'other_certificate');
        //     if ($imageInfo != false) {
        //         $data['other_certificate'] = serialize($imageInfo);
        //     } else {
        //         $istrue = 0;
        //     }
        // }

        // $schooName['school_name']           =    $this->input->post('school_name');
        // $CollageName['collage_class_name']  =    $this->input->post('collage_class_name');
        // $OtherName['other_class_name']      =    $this->input->post('other_class_name');

        // $data['school_name'] =  serialize($schooName);
        // $data['collage_class_name'] = serialize($CollageName);
        // $data['other_class_name'] = serialize($OtherName);


        if ($istrue != 0) {
            if ($this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $id])) {
                $this->welcome_model->updateRecord(EDU_INFO_TBL, $data, ['user_id' => $id]);
                $array = array('success' => 'Education Information Successfully Updated');
            } else {
                $this->welcome_model->insertRecord(EDU_INFO_TBL, $data);
                $array = array('success' => ' Education Information Successfully Saved');
            }
        } else {
            $array = array('success' => 'Wrong Format');
        }

        //  echo '<pre>';print_r($array);die;
        echo json_encode($array);
    }

    function family_information()
    {
        $array = [];
        if ($_POST['Mstatus'] == 'Married') {
            // $this->form_validation->set_rules('home_length','home length','required');
            // $this->form_validation->set_rules('home_width','home width','required');
            // $this->form_validation->set_rules('no_of_room','number of room','required');
            if ($this->form_validation->run() == false) {
                $array = array( //'no_of_family' => form_error('no_of_family'),
                    // 'present_no_of_family' => form_error('present_no_of_family'),
                    // 'home_length' => form_error('home_length'),
                    // 'home_width' => form_error('home_width'),
                    // 'no_of_room' => form_error('no_of_room')
                );
            }
        } else {
            $id = userid('id');
            if ($this->welcome_model->getsinglerow(FMTY_INFO_TBL, ['user_id' => $id])) {
                $this->welcome_model->updateRecord(FMTY_INFO_TBL, $_POST, ['user_id' => $id]);
                $array = array('success' => 'Family Information Successfully Updated');
            } else {
                $this->welcome_model->insertRecord(FMTY_INFO_TBL, $_POST);
                $array = array('success' => 'Family Information Successfully Saved');
            }
        }
        echo json_encode($array);
    }

    function generation_information()
    {
        $array = [];
        //  $this->form_validation->set_rules('father', 'father', 'required');
        // // $this->form_validation->set_rules('mother', 'mother', 'required');
        // // $this->form_validation->set_rules('grandfather', 'grandfather', 'required');
        // // $this->form_validation->set_rules('grandmother', 'grandmother', 'required');
        // if ($this->form_validation->run() == false) 
        // {
        //     $array = array('father' => form_error('father')
        //                         // 'mother' => form_error('mother'),
        //                         // 'grandfather' => form_error('grandfather'),
        //                         // 'grandmother' => form_error('grandmother'),
        //                     );
        // } 
        // else {
        $data = $_POST;
        //  echo '<pre>';print_r($_FILES);die;
        //  echo '<pre>';print_r($data);die;

        $id = userid();
        $istrue = 1;
        /*=========------------------father_img----========================== */
        if (!empty($_FILES['father_img']['name'])) {
            $arrayFilter1 = array_values(array_filter($_FILES['father_img']['name']));;
            if (!empty($arrayFilter1)) {
                $image1 = $this->MultipleImageUpload($_FILES['father_img'], './uploads/generation', 'father_img');
                if ($image1 != false) {
                    $data['father_img'] = serialize($image1);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*=========--------------mother_img--------========================== */
        if (!empty($_FILES['mother_img']['name'])) {
            $arrayFilter2 = array_values(array_filter($_FILES['mother_img']['name']));
            if (!empty($arrayFilter2)) {
                $image2 = $this->MultipleImageUpload($_FILES['mother_img'], './uploads/generation', 'mother_img');
                if ($image2 != false) {
                    $data['mother_img'] = serialize($image2);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*=========----------------------========================== */
        if (!empty($_FILES['grandfather_img']['name'])) {
            $arrayFilter3 = array_values(array_filter($_FILES['grandfather_img']['name']));
            if (!empty($arrayFilter3)) {
                $image3 = $this->MultipleImageUpload($_FILES['grandfather_img'], './uploads/generation', 'grandfather_img');
                if ($image3 != false) {
                    $data['grandfather_img'] = serialize($image3);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*=========----------------------========================== */
        if (!empty($_FILES['grandmother_img']['name'])) {
            $arrayFilter4 = array_values(array_filter($_FILES['grandmother_img']['name']));
            if (!empty($arrayFilter4)) {
                $image4 = $this->MultipleImageUpload($_FILES['grandmother_img'], './uploads/generation', 'grandmother_img');
                if ($image4 != false) {
                    $data['grandmother_img'] = serialize($image4);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*=========----------------------========================== */
        if (!empty($_FILES['great_grandfather_img']['name'])) {
            $arrayFilter5 = array_values(array_filter($_FILES['great_grandfather_img']['name']));
            if (!empty($arrayFilter5)) {
                $image5 = $this->MultipleImageUpload($_FILES['great_grandfather_img'], './uploads/generation', 'great_grandfather_img');
                if ($image5 != false) {
                    $data['great_grandfather_img'] = serialize($image5);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*=========----------------------========================== */
        if (!empty($_FILES['great_grandmother_img']['name'])) {
            $arrayFilter6 = array_values(array_filter($_FILES['great_grandmother_img']['name']));
            if (!empty($arrayFilter6)) {
                $image6 = $this->MultipleImageUpload($_FILES['great_grandmother_img'], './uploads/generation', 'great_grandmother_img');
                if ($image6 != false) {
                    $data['great_grandmother_img'] = serialize($image6);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['great_grandfather_father_img']['name'])) {
            $arrayFilter7 = array_values(array_filter($_FILES['great_grandfather_father_img']['name']));
            if (!empty($arrayFilter7)) {
                $image7 = $this->MultipleImageUpload($_FILES['great_grandfather_father_img'], './uploads/generation', 'great_grandfather_father_img');
                if ($image7 != false) {
                    $data['great_grandfather_father_img'] = serialize($image7);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['great_grandmother_mother_img']['name'])) {
            $arrayFilter8 = array_values(array_filter($_FILES['great_grandmother_mother_img']['name']));
            if (!empty($arrayFilter8)) {
                $image8 = $this->MultipleImageUpload($_FILES['great_grandmother_mother_img'], './uploads/generation', 'great_grandmother_mother_img');
                if ($image8 != false) {
                    $data['great_grandmother_mother_img'] = serialize($image8);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['father5_img']['name'])) {
            $arrayFilter9 = array_values(array_filter($_FILES['father5_img']['name']));
            if (!empty($arrayFilter9)) {
                $image9 = $this->MultipleImageUpload($_FILES['father5_img'], './uploads/generation', 'father5_img');
                if ($image9 != false) {
                    $data['father5_img'] = serialize($image9);
                } else {
                    $istrue = 0;
                }
            }
        }
        if (!empty($_FILES['mother5_img']['name'])) {
            $arrayFilter10 = array_values(array_filter($_FILES['mother5_img']['name']));
            if (!empty($arrayFilter10)) {
                $image10 = $this->MultipleImageUpload($_FILES['mother5_img'], './uploads/generation', 'mother5_img');
                if ($image10 != false) {
                    $data['mother5_img'] = serialize($image10);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['father6_img']['name'])) {
            $arrayFilter11 = array_values(array_filter($_FILES['father6_img']['name']));
            if (!empty($arrayFilter11)) {
                $image11 = $this->MultipleImageUpload($_FILES['father6_img'], './uploads/generation', 'father6_img');
                if ($image11 != false) {
                    $data['father6_img'] = serialize($image11);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['mother6_img']['name'])) {
            $arrayFilter12 = array_values(array_filter($_FILES['mother6_img']['name']));
            if (!empty($arrayFilter12)) {
                $image12 = $this->MultipleImageUpload($_FILES['mother6_img'], './uploads/generation', 'mother6_img');
                if ($image12 != false) {
                    $data['mother6_img'] = serialize($image12);
                } else {
                    $istrue = 0;
                }
            }
        }
        if (!empty($_FILES['father7_img']['name'])) {
            $arrayFilter13 = array_values(array_filter($_FILES['father7_img']['name']));
            if (!empty($arrayFilter13)) {
                $image13 = $this->MultipleImageUpload($_FILES['father7_img'], './uploads/generation', 'father7_img');
                if ($image13 != false) {
                    $data['father7_img'] = serialize($image13);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['mother7_img']['name'])) {
            $arrayFilter14 = array_values(array_filter($_FILES['mother7_img']['name']));
            if (!empty($arrayFilter14)) {
                $image14 = $this->MultipleImageUpload($_FILES['mother7_img'], './uploads/generation', 'mother7_img');
                if ($image14 != false) {
                    $data['mother7_img'] = serialize($image14);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['my_mother_img']['name'])) {
            $arrayFilter15 = array_values(array_filter($_FILES['my_mother_img']['name']));
            if (!empty($arrayFilter15)) {
                $image15 = $this->MultipleImageUpload($_FILES['my_mother_img'], './uploads/generation', 'my_mother_img');
                if ($image15 != false) {
                    $data['my_mother_img'] = serialize($image15);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*---------------------------------------------------------*/
        if (!empty($_FILES['my_father_img']['name'])) {
            $arrayFilter16 = array_values(array_filter($_FILES['my_father_img']['name']));
            if (!empty($arrayFilter16)) {
                $image16 = $this->MultipleImageUpload($_FILES['my_father_img'], './uploads/generation', 'my_father_img');
                if ($image16 != false) {
                    $data['my_father_img'] = serialize($image16);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_img']['name'])) {
            $arrayFilter17 = array_values(array_filter($_FILES['maternal_grandmother_img']['name']));
            if (!empty($arrayFilter17)) {
                $image17 = $this->MultipleImageUpload($_FILES['maternal_grandmother_img'], './uploads/generation', 'maternal_grandmother_img');
                if ($image17 != false) {
                    $data['maternal_grandmother_img'] = serialize($image17);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandfather_img']['name'])) {
            $arrayFilter18 = array_values(array_filter($_FILES['maternal_grandfather_img']['name']));
            if (!empty($arrayFilter18)) {
                $image18 = $this->MultipleImageUpload($_FILES['maternal_grandfather_img'], './uploads/generation', 'maternal_grandfather_img');
                if ($image18 != false) {
                    $data['maternal_grandfather_img'] = serialize($image18);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_img']['name'])) {
            $arrayFilter19 = array_values(array_filter($_FILES['maternal_grandmother_m_img']['name']));
            if (!empty($arrayFilter19)) {
                $image19 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_img'], './uploads/generation', 'maternal_grandmother_m_img');
                if ($image19 != false) {
                    $data['maternal_grandmother_m_img'] = serialize($image19);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_granfather_f_img']['name'])) {
            $arrayFilter20 = array_values(array_filter($_FILES['maternal_granfather_f_img']['name']));
            if (!empty($arrayFilter20)) {
                $image20 = $this->MultipleImageUpload($_FILES['maternal_granfather_f_img'], './uploads/generation', 'maternal_granfather_f_img');
                if ($image20 != false) {
                    $data['maternal_granfather_f_img'] = serialize($image20);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_1']['name'])) {
            $arrayFilter21 = array_values(array_filter($_FILES['maternal_grandmother_1']['name']));
            if (!empty($arrayFilter21)) {
                $image21 = $this->MultipleImageUpload($_FILES['maternal_grandmother_1'], './uploads/generation', 'maternal_grandmother_1');
                if ($image21 != false) {
                    $data['maternal_grandmother_1'] = serialize($image21);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_f_img']['name'])) {
            $arrayFilter22 = array_values(array_filter($_FILES['maternal_grandmother_m_f_img']['name']));
            if (!empty($arrayFilter22)) {
                $image22 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_f_img'], './uploads/generation', 'maternal_grandmother_m_f_img');
                if ($image22 != false) {
                    $data['maternal_grandmother_m_f_img'] = serialize($image22);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_m_m_img']['name'])) {
            $arrayFilter23 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_img']['name']));
            if (!empty($arrayFilter23)) {
                $image23 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_m_img');
                if ($image23 != false) {
                    $data['maternal_grandmother_m_m_m_img'] = serialize($image23);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_m_f_img']['name'])) {
            $arrayFilter24 = array_values(array_filter($_FILES['maternal_grandmother_m_m_f_img']['name']));
            if (!empty($arrayFilter24)) {
                $image24 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_f_img'], './uploads/generation', 'maternal_grandmother_m_m_f_img');
                if ($image24 != false) {
                    $data['maternal_grandmother_m_m_f_img'] = serialize($image24);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_m_m_m_img']['name'])) {
            $arrayFilter25 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_m_img']['name']));
            if (!empty($arrayFilter25)) {
                $image25 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_m_m_img');
                if ($image25 != false) {
                    $data['maternal_grandmother_m_m_m_m_img'] = serialize($image25);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_m_m_f_img']['name'])) {
            $arrayFilter26 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_f_img']['name']));
            if (!empty($arrayFilter26)) {
                $image26 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_f_img'], './uploads/generation', 'maternal_grandmother_m_m_m_f_img');
                if ($image26 != false) {
                    $data['maternal_grandmother_m_m_m_f_img'] = serialize($image26);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_m_m_m_m_img']['name'])) {
            $arrayFilter27 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_m_m_img']['name']));
            if (!empty($arrayFilter27)) {
                $image27 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_m_m_img'], './uploads/generation', 'maternal_grandmother_m_m_m_m_m_img');
                if ($image27 != false) {
                    $data['maternal_grandmother_m_m_m_m_m_img'] = serialize($image27);
                } else {
                    $istrue = 0;
                }
            }
        }
        /*----------------------------------------------------------*/
        if (!empty($_FILES['maternal_grandmother_m_m_m_m_f_img']['name'])) {
            $arrayFilter28 = array_values(array_filter($_FILES['maternal_grandmother_m_m_m_m_f_img']['name']));
            if (!empty($arrayFilter28)) {
                $image28 = $this->MultipleImageUpload($_FILES['maternal_grandmother_m_m_m_m_f_img'], './uploads/generation', 'maternal_grandmother_m_m_m_m_f_img');
                if ($image28 != false) {
                    $data['maternal_grandmother_m_m_m_m_f_img'] = serialize($image28);
                } else {
                    $istrue = 0;
                }
            }
        }

        // if ($istrue != 0) {
        if ($this->welcome_model->getsinglerow(GNRTN_INFO_TBL, ['user_id' => $id])) {
            $this->welcome_model->updateRecord(GNRTN_INFO_TBL, $data, ['user_id' => $id]);
            $array = array('success' => 'Gereration Information Successfully Updated');
        } else {
            $this->welcome_model->insertRecord(GNRTN_INFO_TBL, $data);
            $array = array('success' => ' Gereration Information Successfully Saved');
        }

        //  } else {
        //    $array = array('success' => 'Wrong Format');
        //  }

        //  echo '<pre>';print_r($array);die;
        echo json_encode($array);
    }
    function health_information()
    {
        // echo '<pre>';print_r($_POST);die;
        $array = [];
        $this->form_validation->set_rules('disabled', 'disabled', 'required');
        //$this->form_validation->set_rules('crippled_side','in which side of crippled ','required'); 

        if ($this->form_validation->run() == false) {
            $array = array(
                'disabled' => form_error('disabled'),
                //'mother' => form_error('crippled_side')
            );
        } else {
            extract($_POST);
            $data=$_POST;
            // echo '<pre>';
            // print_r($data);
            // die;
            $id = userid('id');
            if ($this->welcome_model->getsinglerow(HLTH_INFO_TBL, ['user_id' => $id])) {
                $this->welcome_model->updateRecord(HLTH_INFO_TBL, $data, ['user_id' => $id]);
                $array = array('success' => 'Health Information Successfully Updated');
            } else {
                $this->welcome_model->insertRecord(HLTH_INFO_TBL, $data);
                $array = array('success' => 'Health Information Successfully Saved');
            }
        }

        echo json_encode($array);
    }

    function working_information()
    {
        $array = [];

        $this->form_validation->set_rules('work_situation', 'current situation ', 'required');


        if ($this->form_validation->run() == false) {
            $array = array('work_situation' => form_error('work_situation'),);
        } else {
           
             $totexp = '';
            if(!empty($this->input->post('job_experience1')))
            {
                $totexp = $this->input->post('job_experience1');
            }elseif(!empty($this->input->post('job_experience2'))){
               
               $totexp = $this->input->post('job_experience2');
            }else{
                 $totexp = 'N/A';
            }

            
           extract($_POST);
            unset($_POST['job_experience1']);
            unset($_POST['job_experience2']);
           
         
            $data=$_POST;
            $data['job_experience'] = $totexp;
           
            $id = userid('id');
         

            //

            if ($this->welcome_model->getsinglerow(WRK_INFO_TBL, ['user_id' => $id])) {
                $this->welcome_model->updateRecord(WRK_INFO_TBL, $data, ['user_id' => $id]);
                $array = array('success' => 'Work Information Successfully');
            } else {
                $this->welcome_model->insertRecord(WRK_INFO_TBL, $data);
                $array = array('success' => 'Work Information Successfully Saved');
            }
        }

        echo json_encode($array);
    }

    function marriage_information()
    {
        $array = [];
        // $this->form_validation->set_rules('cast_marry','caste marry','required');
        // $this->form_validation->set_rules('devoce_w','devoce woman','required'); 

        // if($this->form_validation->run()==false){
        //     // $array = array();
        //     // $array = array('cast_marry' => form_error('cast_marry'),
        //     //   'devoce_w' => form_error('devoce_w') 

        // //    );
        // }else{
        //    echo "aaa";die;
        // echo '<pre>';print_r($_POST);die;
        //         $sql = 'CREATE TABLE testu';
        //         $value=[];
        //         foreach($_POST as $key=>$value){
        //              $value[]  = $key;
        //             //print_r($key);
        //         }
        // print_r($value);
        //         echo $sql. $value; die;

   $gfPlace=''; $gfDept=''; $mgmMobile=''; $gmSalaryY=''; $gmWork=''; $gmPost=''; $gmDept=''; $nmMobile=''; $nmSalaryY=''; $nmSalaryM=''; $naCond=''; $mgmMobile=''; $mgmSalaryY=''; $mgmSalaryM=''; $mgmDept=''; $mgmAge=''; $mgmName=''; $niCond=''; $bCond=''; $fCond=''; $fMobile=''; $fSalaryY=''; $fSalaryM=''; $fPlace=''; $fPost = ''; $fDept=''; $fAge=''; $fName=''; $bSalaryY=''; $bSalary=''; $bPlace=''; $bPost=''; $bMrg=''; $bDept=''; $bAge =''; $bMobile = ''; $mCond=''; $mMobile = ''; $mSalaryY = ''; $mSalaryM = ''; $mDept=''; $mPost=''; $mName=''; $mWork=''; $broName=''; $gName=''; $gAge=''; $gfName=''; $gfPost=''; $gfMobile=''; $gmName=''; $gmAge=''; $nName=''; $nAge=''; $mgmDept=''; $mgmPost=''; $mgmWork='';$gmSalaryM=''; $gmCond=''; $gfAge=''; $gSalaryM=''; $gSalaryY=''; $gCond=''; $sName=''; $sAge=''; $sAge=''; $sMrg=''; $sDept='';  $sSalaryM=''; $sSalaryY=''; $sMobile=''; $sCond=''; $sRJob=''; $bRJob=''; $sPlace=''; $bStudy=''; $bStudyPlace=''; $sStudy=''; $sStudyPlace=''; $uName=''; $uAge=''; $uMrg=''; $uDept=''; $uPost=''; $uPlace=''; $uSalaryY=''; $uSalaryM=''; $uMobile=''; $uCond=''; $buaMrg=''; $buaAge=''; $buaName=''; $buaPlace=''; $buaPost=''; $buaDept=''; $buaSalaryM=''; $buaSalaryY=''; $buaMobile=''; $buaCond=''; $buaRjob=''; $mbName=''; $mbAge=''; $mbMrg=''; $mbDept=''; $mbPost=''; $mbPlace=''; $mbSalaryM=''; $mbSalaryY=''; $mbMobile=''; $mbCond=''; $msName=''; $msAge=''; $msMrg=''; $msDept=''; $msPost=''; $msPlace=''; $msSalaryY=''; $msSalaryM=''; $msMobile=''; $msCond=''; $nmRjob='';
    
              
        if(!empty($this->input->post('nm_retired_job1')))
            {
                $nmRjob = $this->input->post('nm_retired_job1');
            }elseif(!empty($this->input->post('nm_retired_job2'))){
               
               $nmRjob = $this->input->post('nm_retired_job2');
               
                }else{
                     $nmRjob = '';
                }
     if(!empty($this->input->post('ms_mobile1')))
            {
                $msMobile = $this->input->post('ms_mobile1');
            }elseif(!empty($this->input->post('ms_mobile2'))){
               
               $msMobile = $this->input->post('ms_mobile2');
               }elseif(!empty($this->input->post('ms_mobile3'))){
               
               $msMobile = $this->input->post('ms_mobile3');
               }elseif(!empty($this->input->post('ms_mobile4'))){
               
               $msMobile = $this->input->post('ms_mobile4');
                }elseif(!empty($this->input->post('ms_mobile5'))){
               
               $msMobile = $this->input->post('ms_mobile5');
                }elseif(!empty($this->input->post('ms_mobile6'))){
               
               $msMobile = $this->input->post('ms_mobile6');
               
                }else{
                     $msMobile = '';
                } 
     if(!empty($this->input->post('ms_conditions1')))
            {
                $msCond = $this->input->post('ms_conditions1');
            }elseif(!empty($this->input->post('ms_conditions2'))){
               
               $msCond = $this->input->post('ms_conditions2');
               }elseif(!empty($this->input->post('ms_conditions3'))){
               
               $msCond = $this->input->post('ms_conditions3');
               }elseif(!empty($this->input->post('ms_conditions4'))){
               
               $msCond = $this->input->post('ms_conditions4');
                }elseif(!empty($this->input->post('ms_conditions5'))){
               
               $msCond = $this->input->post('ms_conditions5');
                }elseif(!empty($this->input->post('ms_conditions6'))){
               
               $msCond = $this->input->post('ms_conditions6');
               
                }else{
                     $msCond = '';
                } 
      if(!empty($this->input->post('monthly_salary_ms1')))
            {
                $msSalaryM = $this->input->post('monthly_salary_ms1');
            }elseif(!empty($this->input->post('monthly_salary_ms2'))){
               
               $msSalaryM = $this->input->post('monthly_salary_ms2');
               }elseif(!empty($this->input->post('monthly_salary_ms3'))){
               
               $msSalaryM = $this->input->post('monthly_salary_ms3');
               }elseif(!empty($this->input->post('monthly_salary_ms4'))){
               
               $msSalaryM = $this->input->post('monthly_salary_ms4');
               
                }else{
                     $msSalaryM = '';
                } 


                if(!empty($this->input->post('yearly_salary_ms1')))
            {
                $msSalaryY = $this->input->post('yearly_salary_ms1');
            }elseif(!empty($this->input->post('yearly_salary_ms2'))){
               
               $msSalaryY = $this->input->post('yearly_salary_ms2');
               }elseif(!empty($this->input->post('yearly_salary_ms3'))){
               
               $msSalaryY = $this->input->post('yearly_salary_ms3');
               }elseif(!empty($this->input->post('yearly_salary_ms4'))){
               
               $msSalaryY = $this->input->post('yearly_salary_ms4');
               
                }else{
                     $msSalaryY = '';
                } 
        if(!empty($this->input->post('ms_Working_place1')))
            {
                $msPlace = $this->input->post('ms_Working_place1');
            }elseif(!empty($this->input->post('ms_Working_place2'))){
               
               $msPlace = $this->input->post('ms_Working_place2');
               }elseif(!empty($this->input->post('ms_Working_place3'))){
               
               $msPlace = $this->input->post('ms_Working_place3');
               }elseif(!empty($this->input->post('ms_Working_place4'))){
               
               $msPlace = $this->input->post('ms_Working_place4');
               
                }else{
                     $msPlace = '';
                } 
        if(!empty($this->input->post('ms_post1')))
            {
                $msPost = $this->input->post('ms_post1');
            }elseif(!empty($this->input->post('ms_post2'))){
               
               $msPost = $this->input->post('ms_post2');
               
                }else{
                     $msPost = '';
                } 
        if(!empty($this->input->post('ms_department1')))
            {
                $msDept = $this->input->post('ms_department1');
            }elseif(!empty($this->input->post('ms_department2'))){
               
               $msDept = $this->input->post('ms_department2');
                }elseif(!empty($this->input->post('ms_department3'))){
               
               $msDept = $this->input->post('ms_department3');
                }else{
                     $msDept = '';
                } 
       if(!empty($this->input->post('married_status_ms1')))
            {
                $msMrg = $this->input->post('married_status_ms1');
            }elseif(!empty($this->input->post('married_status_ms2'))){
               
               $msMrg = $this->input->post('married_status_ms2');
                }elseif(!empty($this->input->post('married_status_ms3'))){
               
               $msMrg = $this->input->post('married_status_ms3');
                }elseif(!empty($this->input->post('married_status_ms4'))){
               
               $msMrg = $this->input->post('married_status_ms4');
                }elseif(!empty($this->input->post('married_status_ms5'))){
               
               $msMrg = $this->input->post('married_status_ms5');
                }elseif(!empty($this->input->post('married_status_ms6'))){
               
               $msMrg = $this->input->post('married_status_ms6');

                }else{
                     $msMrg = '';
                }
       if(!empty($this->input->post('ms_age1')))
            {
                $msAge = $this->input->post('ms_age1');
            }elseif(!empty($this->input->post('ms_age2'))){
               
               $msAge = $this->input->post('ms_age2');
                }elseif(!empty($this->input->post('ms_age3'))){
               
               $msAge = $this->input->post('ms_age3');
                }elseif(!empty($this->input->post('ms_age4'))){
               
               $msAge = $this->input->post('ms_age4');
                }elseif(!empty($this->input->post('ms_age5'))){
               
               $msAge = $this->input->post('ms_age5');
                }elseif(!empty($this->input->post('ms_age6'))){
               
               $msAge = $this->input->post('ms_age6');

                }else{
                     $msAge = '';
                }
         if(!empty($this->input->post('ms_name1')))
            {
                $msName = $this->input->post('ms_name1');
            }elseif(!empty($this->input->post('ms_name2'))){
               
               $msName = $this->input->post('ms_name2');
                }elseif(!empty($this->input->post('ms_name3'))){
               
               $msName = $this->input->post('ms_name3');
                }elseif(!empty($this->input->post('ms_name4'))){
               
               $msName = $this->input->post('ms_name4');
                }elseif(!empty($this->input->post('ms_name5'))){
               
               $msName = $this->input->post('ms_name5');
                }elseif(!empty($this->input->post('ms_name6'))){
               
               $msName = $this->input->post('ms_name6');

                }else{
                     $msName = '';
                }

        if(!empty($this->input->post('mb_conditions1')))
            {
                $mbCond = $this->input->post('mb_conditions1');
            }elseif(!empty($this->input->post('mb_conditions2'))){
               
               $mbCond = $this->input->post('mb_conditions2');
                }elseif(!empty($this->input->post('mb_conditions3'))){
               
               $mbCond = $this->input->post('mb_conditions3');
                }elseif(!empty($this->input->post('mb_conditions4'))){
               
               $mbCond = $this->input->post('mb_conditions4');
                }elseif(!empty($this->input->post('mb_conditions5'))){
               
               $mbCond = $this->input->post('mb_conditions5');
                }elseif(!empty($this->input->post('mb_conditions6'))){
               
               $mbCond = $this->input->post('mb_conditions6');

                }else{
                     $mbCond = '';
                } 
    if(!empty($this->input->post('mb_mobile1')))
            {
                $mbMobile = $this->input->post('mb_mobile1');
            }elseif(!empty($this->input->post('mb_mobile2'))){
               
               $mbMobile = $this->input->post('mb_mobile2');
                }elseif(!empty($this->input->post('mb_mobile3'))){
               
               $mbMobile = $this->input->post('mb_mobile3');
                }elseif(!empty($this->input->post('mb_mobile4'))){
               
               $mbMobile = $this->input->post('mb_mobile4');
                }elseif(!empty($this->input->post('mb_mobile5'))){
               
               $mbMobile = $this->input->post('mb_mobile5');
                }elseif(!empty($this->input->post('mb_mobile6'))){
               
               $mbMobile = $this->input->post('mb_mobile6');

                }else{
                     $mbMobile = '';
                } 
     if(!empty($this->input->post('yearly_salary_mb1')))
            {
                $mbSalaryY = $this->input->post('yearly_salary_mb1');
            }elseif(!empty($this->input->post('yearly_salary_mb2'))){
               
               $mbSalaryY = $this->input->post('yearly_salary_mb2');
                }elseif(!empty($this->input->post('yearly_salary_mb3'))){
               
               $mbSalaryY = $this->input->post('yearly_salary_mb3');
               }elseif(!empty($this->input->post('yearly_salary_mb4'))){
               
               $mbSalaryY = $this->input->post('yearly_salary_mb4');
                }elseif(!empty($this->input->post('yearly_salary_mb5'))){
               
               $mbSalaryY = $this->input->post('yearly_salary_mb5');
               }elseif(!empty($this->input->post('yearly_salary_mb6'))){
               
               $mbSalaryY = $this->input->post('yearly_salary_mb6');
                }else{
                     $mbSalaryY = '';
                } 
     if(!empty($this->input->post('monthly_salary_mb1')))
            {
                $mbSalaryM = $this->input->post('monthly_salary_mb1');
            }elseif(!empty($this->input->post('monthly_salary_mb2'))){
               
               $mbSalaryM = $this->input->post('monthly_salary_mb2');
                }elseif(!empty($this->input->post('monthly_salary_mb3'))){
               
               $mbSalaryM = $this->input->post('monthly_salary_mb3');
               }elseif(!empty($this->input->post('monthly_salary_mb4'))){
               
               $mbSalaryM = $this->input->post('monthly_salary_mb4');
                 }elseif(!empty($this->input->post('monthly_salary_mb5'))){
               
               $mbSalaryM = $this->input->post('monthly_salary_mb5');
                 }elseif(!empty($this->input->post('monthly_salary_mb6'))){
               
               $mbSalaryM = $this->input->post('monthly_salary_mb6');
                }else{
                     $mbSalaryM = '';
                } 
   if(!empty($this->input->post('mb_Working_place1')))
            {
                $mbPlace = $this->input->post('mb_Working_place1');
            }elseif(!empty($this->input->post('mb_Working_place2'))){
               
               $mbPlace = $this->input->post('mb_Working_place2');
                }elseif(!empty($this->input->post('mb_Working_place3'))){
               
               $mbPlace = $this->input->post('mb_Working_place3');
               }elseif(!empty($this->input->post('mb_Working_place4'))){
               
               $mbPlace = $this->input->post('mb_Working_place4');
                }else{
                     $mbPlace = '';
                } 
    if(!empty($this->input->post('mb_Working_place1')))
            {
                $mbPlace = $this->input->post('mb_Working_place1');
            }elseif(!empty($this->input->post('mb_Working_place2'))){
               
               $mbPlace = $this->input->post('mb_Working_place2');
                }elseif(!empty($this->input->post('mb_Working_place3'))){
               
               $mbPlace = $this->input->post('mb_Working_place3');
               }elseif(!empty($this->input->post('mb_Working_place4'))){
               
               $mbPlace = $this->input->post('mb_Working_place4');
                }else{
                     $mbPlace = '';
                } 
    if(!empty($this->input->post('mb_post1')))
            {
                $mbPost = $this->input->post('mb_post1');
            }elseif(!empty($this->input->post('mb_post2'))){
               
               $mbPost = $this->input->post('mb_post2');
               
                }else{
                     $mbPost = '';
                } 
    if(!empty($this->input->post('mb_department1')))
            {
                $mbDept = $this->input->post('mb_department1');
            }elseif(!empty($this->input->post('mb_department2'))){
               
               $mbDept = $this->input->post('mb_department2');
                }elseif(!empty($this->input->post('mb_department3'))){
               
               $mbDept = $this->input->post('mb_department3');
                }else{
                     $mbDept = '';
                } 
   if(!empty($this->input->post('married_status_mb1')))
            {
                $mbMrg = $this->input->post('married_status_mb1');
            }elseif(!empty($this->input->post('married_status_mb2'))){
               
               $mbMrg = $this->input->post('married_status_mb2');
                }elseif(!empty($this->input->post('married_status_mb3'))){
               
               $mbMrg = $this->input->post('married_status_mb3');
                }elseif(!empty($this->input->post('married_status_mb4'))){
               
               $mbMrg = $this->input->post('married_status_mb4');
                }elseif(!empty($this->input->post('married_status_mb5'))){
               
               $mbMrg = $this->input->post('married_status_mb5');
                }elseif(!empty($this->input->post('married_status_mb6'))){
               
               $mbMrg = $this->input->post('married_status_mb6');

               
                }else{
                     $mbMrg = '';
                } 
   if(!empty($this->input->post('mb_age1')))
            {
                $mbAge = $this->input->post('mb_age1');
            }elseif(!empty($this->input->post('mb_age2'))){
               
               $mbAge = $this->input->post('mb_age2');
                }elseif(!empty($this->input->post('mb_age3'))){
               
               $mbAge = $this->input->post('mb_age3');
                }elseif(!empty($this->input->post('mb_age4'))){
               
               $mbAge = $this->input->post('mb_age4');
                }elseif(!empty($this->input->post('mb_age5'))){
               
               $mbAge = $this->input->post('mb_age5');
                }elseif(!empty($this->input->post('mb_age6'))){
               
               $mbAge = $this->input->post('mb_age6');
               
                }else{
                     $mbAge = '';
                } 
   if(!empty($this->input->post('mb_name1')))
            {
                $mbName = $this->input->post('mb_name1');
            }elseif(!empty($this->input->post('mb_name2'))){
               
               $mbName = $this->input->post('mb_name2');
                }elseif(!empty($this->input->post('mb_name3'))){
               
               $mbName = $this->input->post('mb_name3');
                }elseif(!empty($this->input->post('mb_name4'))){
               
               $mbName = $this->input->post('mb_name4');
                }elseif(!empty($this->input->post('mb_name5'))){
               
               $mbName = $this->input->post('mb_name5');
                }elseif(!empty($this->input->post('mb_name6'))){
               
               $mbName = $this->input->post('mb_name6');
                
                }else{
                     $mbName = '';
                } 
   if(!empty($this->input->post('bua_mobile1')))
            {
                $buaMobile = $this->input->post('bua_mobile1');
            }elseif(!empty($this->input->post('bua_mobile2'))){
               
               $buaMobile = $this->input->post('bua_mobile2');
                }elseif(!empty($this->input->post('bua_mobile3'))){
               
               $buaMobile = $this->input->post('bua_mobile3');
                }elseif(!empty($this->input->post('bua_mobile4'))){
               
               $buaMobile = $this->input->post('bua_mobile4');
                }elseif(!empty($this->input->post('bua_mobile5'))){
               
               $buaMobile = $this->input->post('bua_mobile5');
                }elseif(!empty($this->input->post('bua_mobile6'))){
               
               $buaMobile = $this->input->post('bua_mobile6');
               
                }else{
                     $buaMobile = '';
                } 

   if(!empty($this->input->post('bua_conditions1')))
            {
                $buaCond = $this->input->post('bua_conditions1');
            }elseif(!empty($this->input->post('bua_conditions2'))){
               
               $buaCond = $this->input->post('bua_conditions2');
                }elseif(!empty($this->input->post('bua_conditions3'))){
               
               $buaCond = $this->input->post('bua_conditions3');
                }elseif(!empty($this->input->post('bua_conditions3=4'))){
               
               $buaCond = $this->input->post('bua_conditions4');
                }elseif(!empty($this->input->post('bua_conditions5'))){
               
               $buaCond = $this->input->post('bua_conditions5');
                }elseif(!empty($this->input->post('bua_conditions6'))){
               
               $buaCond = $this->input->post('bua_conditions6');
               
                }else{
                     $buaCond = '';
                } 
 
if(!empty($this->input->post('u_conditions1')))
            {
                $uCond = $this->input->post('u_conditions1');
            }elseif(!empty($this->input->post('u_conditions2'))){
               
               $uCond = $this->input->post('u_conditions2');
                }elseif(!empty($this->input->post('u_conditions3'))){
               
               $uCond = $this->input->post('u_conditions3');
                }elseif(!empty($this->input->post('u_conditions4'))){
               
               $uCond = $this->input->post('u_conditions4');
                }elseif(!empty($this->input->post('u_conditions5'))){
               
               $uCond = $this->input->post('u_conditions5');
                }elseif(!empty($this->input->post('u_conditions6'))){
               
               $uCond = $this->input->post('u_conditions6');
               
                }else{
                     $uCond = '';
                } 
   if(!empty($this->input->post('married_status_u1')))
            {
                $uMrg = $this->input->post('married_status_u1');
            }elseif(!empty($this->input->post('married_status_u2'))){
               
               $uMrg = $this->input->post('married_status_u2');
                }elseif(!empty($this->input->post('married_status_u3'))){
               
               $uMrg = $this->input->post('married_status_u3');
                }elseif(!empty($this->input->post('married_status_u4'))){
               
               $uMrg = $this->input->post('married_status_u4');
                }elseif(!empty($this->input->post('married_status_u5'))){
               
               $uMrg = $this->input->post('married_status_u5');
                }elseif(!empty($this->input->post('married_status_u6'))){
               
               $uMrg = $this->input->post('married_status_u6');
               
                }else{
                     $uMrg = '';
                } 
 
  if(!empty($this->input->post('uncle_age1')))
            {
                $uAge = $this->input->post('uncle_age1');
            }elseif(!empty($this->input->post('uncle_age2'))){
               
               $uAge = $this->input->post('uncle_age2');
                }elseif(!empty($this->input->post('uncle_age3'))){
               
               $uAge = $this->input->post('uncle_age3');
                }elseif(!empty($this->input->post('uncle_age4'))){
               
               $uAge = $this->input->post('uncle_age4');
                }elseif(!empty($this->input->post('uncle_age5'))){
               
               $uAge = $this->input->post('uncle_age5');
                }elseif(!empty($this->input->post('uncle_age6'))){
               
               $uAge = $this->input->post('uncle_age6');
               
                }else{
                     $uAge = '';
                }
          if(!empty($this->input->post('uncle_name1')))
            {
                $uName = $this->input->post('uncle_name1');
            }elseif(!empty($this->input->post('uncle_name2'))){
               
               $uName = $this->input->post('uncle_name2');
                }elseif(!empty($this->input->post('uncle_name3'))){
               
               $uName = $this->input->post('uncle_name3');
                }elseif(!empty($this->input->post('uncle_name4'))){
               
               $uName = $this->input->post('uncle_name4');
                }elseif(!empty($this->input->post('uncle_name5'))){
               
               $uName = $this->input->post('uncle_name5');
                }elseif(!empty($this->input->post('uncle_name6'))){
               
               $uName = $this->input->post('uncle_name6');
               
                }else{
                     $uName = '';
                }
 


              if(!empty($this->input->post('yearly_salary1')))
            {
                $fSalaryY = $this->input->post('yearly_salary1');
            }elseif(!empty($this->input->post('yearly_salary2'))){
               
               $fSalaryY = $this->input->post('yearly_salary2');
                }elseif(!empty($this->input->post('yearly_salary3'))){
               
               $fSalaryY = $this->input->post('yearly_salary3');
                }elseif(!empty($this->input->post('yearly_salary4'))){
               
               $fSalaryY = $this->input->post('yearly_salary4');
               
            }else{
                 $fSalaryY = '';
            }


            if(!empty($this->input->post('gfather_department1')))
            {
                $gfDept = $this->input->post('gfather_department1');
            }elseif(!empty($this->input->post('gfather_department2'))){
               
               $gfDept = $this->input->post('gfather_department2');
                }elseif(!empty($this->input->post('gfather_department3'))){
               
               $gfDept = $this->input->post('gfather_department3');
              
            }else{
                 $gfDept = '';
            }
            

            if(!empty($this->input->post('u_post1')))
            {
                $uPost = $this->input->post('u_post1');
            }elseif(!empty($this->input->post('u_post2'))){
               
               $uPost = $this->input->post('u_post2');
              
            }else{
                 $uPost = '';
            }


if(!empty($this->input->post('monthly_salary_gm1')))
            {
                $gmSalaryM = $this->input->post('monthly_salary_gm1');
            }elseif(!empty($this->input->post('monthly_salary_gm2'))){
               
               $gmSalaryM = $this->input->post('monthly_salary_gm2');
                }elseif(!empty($this->input->post('monthly_salary_gm3'))){
               
               $gmSalaryM = $this->input->post('monthly_salary_gm3');

                }elseif(!empty($this->input->post('monthly_salary_gm4'))){
               
               $gmSalaryM = $this->input->post('monthly_salary_gm4');
                
            }else{
                 $gmSalaryM = '';
            }

            if(!empty($this->input->post('monthly_salary_g1')))
            {
                $gSalaryM = $this->input->post('monthly_salary_g1');
            }elseif(!empty($this->input->post('monthly_salary_g2'))){
               
               $gSalaryM = $this->input->post('monthly_salary_g2');
                }elseif(!empty($this->input->post('monthly_salary_g3'))){
               
               $gSalaryM = $this->input->post('monthly_salary_g3');

                }elseif(!empty($this->input->post('monthly_salary_g4'))){
               
               $gSalaryM = $this->input->post('monthly_salary_g4');
                
            }else{
                 $gmSalaryM = '';
            }

            if(!empty($this->input->post('yearly_salary_gm1')))
            {
                $gmSalaryY = $this->input->post('yearly_salary_gm1');
            }elseif(!empty($this->input->post('yearly_salary_gm2'))){
               
               $gmSalaryY = $this->input->post('yearly_salary_gm2');
                }elseif(!empty($this->input->post('yearly_salary_gm3'))){
               
               $gmSalaryY = $this->input->post('yearly_salary_gm3');

                }elseif(!empty($this->input->post('yearly_salary_gm4'))){
               
               $gmSalaryY = $this->input->post('yearly_salary_gm4');
                
            }else{
                 $gmSalaryY = '';
            }

             if(!empty($this->input->post('yearly_salary_g1')))
            {
                $gSalaryY = $this->input->post('yearly_salary_g1');
            }elseif(!empty($this->input->post('yearly_salary_g2'))){
               
               $gSalaryY = $this->input->post('yearly_salary_g2');
                }elseif(!empty($this->input->post('yearly_salary_g3'))){
               
               $gSalaryY = $this->input->post('yearly_salary_g3');

                }elseif(!empty($this->input->post('yearly_salary_g4'))){
               
               $gSalaryY = $this->input->post('yearly_salary_g4');
                
            }else{
                 $gSalaryY = '';
            }



 if(!empty($this->input->post('monthly_salary_mgm1')))
            {
                $mgmSalaryM = $this->input->post('monthly_salary_mgm1');
            }elseif(!empty($this->input->post('monthly_salary_mgm2'))){
               
               $mgmSalaryM = $this->input->post('monthly_salary_mgm2');
                }elseif(!empty($this->input->post('monthly_salary_mgm3'))){
               
               $mgmSalaryM = $this->input->post('monthly_salary_mgm3');
                
            }else{
                 $mgmSalaryM = '';
            }

            

             if(!empty($this->input->post('nm_mobile1')))
            {
                $nmMobile = $this->input->post('nm_mobile1');
            }elseif(!empty($this->input->post('nm_mobile2'))){
               
               $nmMobile = $this->input->post('nm_mobile2');

                }elseif(!empty($this->input->post('nm_mobile3'))){
               
               $nmMobile = $this->input->post('nm_mobile3');
                }elseif(!empty($this->input->post('nm_mobile4'))){
               
               $nmMobile = $this->input->post('nm_mobile4');

                }elseif(!empty($this->input->post('nm_mobile5'))){
               
               $nmMobile = $this->input->post('nm_mobile5');
               
            }else{
                 $nmMobile = '';
            }

            if(!empty($this->input->post('mgm_mobile1')))
            {
                $mgmMobile = $this->input->post('mgm_mobile1');
            }elseif(!empty($this->input->post('mgm_mobile2'))){
               
               $mgmMobile = $this->input->post('mgm_mobile2');

                }elseif(!empty($this->input->post('mgm_mobile3'))){
               
               $mgmMobile = $this->input->post('mgm_mobile3');
                }elseif(!empty($this->input->post('mgm_mobile4'))){
               
               $mgmMobile = $this->input->post('mgm_mobile4');

                }elseif(!empty($this->input->post('mgm_mobile5'))){
               
               $mgmMobile = $this->input->post('mgm_mobile5');
               
            }else{
                 $mgmMobile = '';
            }
             if(!empty($this->input->post('gm_mobile1')))
            {
                $gmMobile = $this->input->post('gm_mobile1');
            }elseif(!empty($this->input->post('gm_mobile2'))){
               
               $gmMobile = $this->input->post('gm_mobile2');

                }elseif(!empty($this->input->post('gm_mobile3'))){
               
               $gmMobile = $this->input->post('gm_mobile3');
                }elseif(!empty($this->input->post('gm_mobile4'))){
               
               $gmMobile = $this->input->post('gm_mobile4');

                }elseif(!empty($this->input->post('gm_mobile5'))){
               
               $gmMobile = $this->input->post('gm_mobile5');
               
            }else{
                 $gmMobile = '';
            }

            if(!empty($this->input->post('yearly_salary_mgm1')))
            {
                $mgmSalaryY = $this->input->post('yearly_salary_mgm1');
            }elseif(!empty($this->input->post('yearly_salary_mgm2'))){
               
               $mgmSalaryY = $this->input->post('yearly_salary_mgm2');
                }elseif(!empty($this->input->post('yearly_salary_mgm3'))){
               
               $mgmSalaryY = $this->input->post('yearly_salary_mgm3');
                
            }else{
                 $mgmSalaryY = '';
            }


if(!empty($this->input->post('sis_retired_job1')))
            {
                $sRJob = $this->input->post('sis_retired_job1');
            }elseif(!empty($this->input->post('sis_retired_job2'))){
               
               $sRJob = $this->input->post('sis_retired_job2');
                }elseif(!empty($this->input->post('sis_retired_job3'))){
               
               $sRJob = $this->input->post('sis_retired_job3');
                }elseif(!empty($this->input->post('sis_retired_job4'))){
               
               $sRJob = $this->input->post('sis_retired_job4');

            }else{
                 $sRJob = '';
            }

if(!empty($this->input->post('bro_retired_job1')))
            {
                $bRJob = $this->input->post('bro_retired_job1');
            }elseif(!empty($this->input->post('bro_retired_job2'))){
               
               $bRJob = $this->input->post('bro_retired_job2');
                }elseif(!empty($this->input->post('bro_retired_job3'))){
               
               $bRJob = $this->input->post('bro_retired_job3');
                }elseif(!empty($this->input->post('bro_retired_job4'))){
               
               $bRJob = $this->input->post('bro_retired_job4');

            }else{
                 $bRJob = '';
            }


        if(!empty($this->input->post('conditions1')))
            {
                $fCond = $this->input->post('conditions1');
            }elseif(!empty($this->input->post('conditions2'))){
               
               $fCond = $this->input->post('conditions2');
                }elseif(!empty($this->input->post('conditions3'))){
               
               $fCond = $this->input->post('conditions3');
                }elseif(!empty($this->input->post('conditions4'))){
               
               $fCond = $this->input->post('conditions4');
                }elseif(!empty($this->input->post('conditions5'))){
               
               $fCond = $this->input->post('conditions5');
            }else{
                 $fCond = '';
            }

             if(!empty($this->input->post('conditions_bro1')))
            {
                $bCond = $this->input->post('conditions_bro1');
            }elseif(!empty($this->input->post('conditions_bro2'))){
               
               $bCond = $this->input->post('conditions_bro2');
                }elseif(!empty($this->input->post('conditions_bro3'))){
               
               $bCond = $this->input->post('conditions_bro3');
                }elseif(!empty($this->input->post('conditions_bro4'))){
               
               $bCond = $this->input->post('conditions_bro4');
                }elseif(!empty($this->input->post('conditions_bro5'))){
               
               $bCond = $this->input->post('conditions_bro5');
                }elseif(!empty($this->input->post('conditions_bro6'))){
               
               $bCond = $this->input->post('conditions_bro6');
                }elseif(!empty($this->input->post('conditions_bro7'))){
               
               $bCond = $this->input->post('conditions_bro7');
                }elseif(!empty($this->input->post('conditions_bro8'))){
               
               $bCond = $this->input->post('conditions_bro8');
                }elseif(!empty($this->input->post('conditions_bro9'))){
               
               $bCond = $this->input->post('conditions_bro9');
                }elseif(!empty($this->input->post('conditions_bro10'))){
               
               $bCond = $this->input->post('conditions_bro10');
                }elseif(!empty($this->input->post('conditions_bro11'))){
               
               $bCond = $this->input->post('conditions_bro11');
                }elseif(!empty($this->input->post('conditions_bro12'))){
               
               $bCond = $this->input->post('conditions_bro12');
                }elseif(!empty($this->input->post('conditions_bro13'))){
               
               $bCond = $this->input->post('conditions_bro13');
                }elseif(!empty($this->input->post('conditions_bro14'))){
               
               $bCond = $this->input->post('conditions_bro14');
                }elseif(!empty($this->input->post('conditions_bro15'))){
               
               $bCond = $this->input->post('conditions_bro15');
                }elseif(!empty($this->input->post('conditions_bro16'))){
               
               $bCond = $this->input->post('conditions_bro16');
                }elseif(!empty($this->input->post('conditions_bro17'))){
               
               $bCond = $this->input->post('conditions_bro17');
                }elseif(!empty($this->input->post('conditions_bro18'))){
               
               $bCond = $this->input->post('conditions_bro18');
                }elseif(!empty($this->input->post('conditions_bro19'))){
               
               $bCond = $this->input->post('conditions_bro19');
                }elseif(!empty($this->input->post('conditions_bro20'))){
               
               $bCond = $this->input->post('conditions_bro20');
                }elseif(!empty($this->input->post('conditions_bro21'))){
               
               $bCond = $this->input->post('conditions_bro21');
                }elseif(!empty($this->input->post('conditions_bro22'))){
               
               $bCond = $this->input->post('conditions_bro22');
                }elseif(!empty($this->input->post('conditions_bro23'))){
               
               $bCond = $this->input->post('conditions_bro23');
                }elseif(!empty($this->input->post('conditions_bro24'))){
               
               $bCond = $this->input->post('conditions_bro24');
            }else{
                 $bCond = '';
            }

            
              if(!empty($this->input->post('sis_conditions1')))
            {
                $sCond = $this->input->post('sis_conditions1');
            }elseif(!empty($this->input->post('sis_conditions2'))){
               
               $sCond = $this->input->post('sis_conditions2');
                }elseif(!empty($this->input->post('sis_conditions3'))){
               
               $sCond = $this->input->post('sis_conditions3');
                }elseif(!empty($this->input->post('sis_conditions4'))){
               
               $sCond = $this->input->post('sis_conditions4');
                }elseif(!empty($this->input->post('sis_conditions5'))){
               
               $sCond = $this->input->post('sis_conditions5');
                }elseif(!empty($this->input->post('sis_conditions6'))){
               
               $sCond = $this->input->post('sis_conditions6');
                }elseif(!empty($this->input->post('sis_conditions7'))){
               
               $sCond = $this->input->post('sis_conditions7');
                }elseif(!empty($this->input->post('sis_conditions8'))){
               
               $sCond = $this->input->post('sis_conditions8');
                }elseif(!empty($this->input->post('sis_conditions9'))){
               
               $sCond = $this->input->post('sis_conditions9');
                }elseif(!empty($this->input->post('sis_conditions10'))){
               
               $sCond = $this->input->post('sis_conditions10');
                }elseif(!empty($this->input->post('sis_conditions11'))){
               
               $sCond = $this->input->post('sis_conditions11');
                }elseif(!empty($this->input->post('sis_conditions12'))){
               
               $sCond = $this->input->post('sis_conditions12');
                }elseif(!empty($this->input->post('sis_conditions13'))){
               
               $sCond = $this->input->post('sis_conditions13');
                }elseif(!empty($this->input->post('sis_conditions14'))){
               
               $sCond = $this->input->post('sis_conditions14');
                }elseif(!empty($this->input->post('sis_conditions15'))){
               
               $sCond = $this->input->post('sis_conditions15');
                }elseif(!empty($this->input->post('sis_conditions16'))){
               
               $sCond = $this->input->post('sis_conditions16');
                }elseif(!empty($this->input->post('sis_conditions17'))){
               
               $sCond = $this->input->post('sis_conditions17');
                }elseif(!empty($this->input->post('sis_conditions18'))){
               
               $sCond = $this->input->post('sis_conditions18');
                }elseif(!empty($this->input->post('sis_conditions19'))){
               
               $sCond = $this->input->post('sis_conditions19');
                }elseif(!empty($this->input->post('sis_conditions20'))){
               
               $sCond = $this->input->post('sis_conditions20');
                }elseif(!empty($this->input->post('sis_conditions21'))){
               
               $sCond = $this->input->post('sis_conditions21');
                }elseif(!empty($this->input->post('sis_conditions22'))){
               
               $sCond = $this->input->post('sis_conditions22');
                }elseif(!empty($this->input->post('sis_conditions23'))){
               
               $sCond = $this->input->post('sis_conditions23');
                }elseif(!empty($this->input->post('sis_conditions24'))){
               
               $sCond = $this->input->post('sis_conditions24');
               
            }else{
                 $sCond = '';
            }

          if(!empty($this->input->post('sis_Working_place1')))
            {
                $sPlace = $this->input->post('sis_Working_place1');
            }elseif(!empty($this->input->post('sis_Working_place2'))){
               
               $sPlace = $this->input->post('sis_Working_place2');
                }elseif(!empty($this->input->post('sis_Working_place3'))){
               
               $sPlace = $this->input->post('sis_Working_place3');
                }elseif(!empty($this->input->post('sis_Working_place4'))){
               
               $sPlace = $this->input->post('sis_Working_place4');
                }elseif(!empty($this->input->post('sis_Working_place5'))){
               
               $sPlace = $this->input->post('sis_Working_place5');
                }elseif(!empty($this->input->post('sis_Working_place6'))){
               
               $sPlace = $this->input->post('sis_Working_place6');
                }elseif(!empty($this->input->post('sis_Working_place7'))){
               
               $sPlace = $this->input->post('sis_Working_place7');
                }elseif(!empty($this->input->post('sis_Working_place8'))){
               
               $sPlace = $this->input->post('sis_Working_place8');
                }elseif(!empty($this->input->post('sis_Working_place9'))){
               
               $sPlace = $this->input->post('sis_Working_place9');
                }elseif(!empty($this->input->post('sis_Working_place10'))){
               
               $sPlace = $this->input->post('sis_Working_place10');
                }elseif(!empty($this->input->post('sis_Working_place11'))){
               
               $sPlace = $this->input->post('sis_Working_place11');
                }elseif(!empty($this->input->post('sis_Working_place12'))){
               
               $sPlace = $this->input->post('sis_Working_place12');
                }elseif(!empty($this->input->post('sis_Working_place13'))){
               
               $sPlace = $this->input->post('sis_Working_place13');
                }elseif(!empty($this->input->post('sis_Working_place14'))){
               
               $sPlace = $this->input->post('sis_Working_place14');
                }elseif(!empty($this->input->post('sis_Working_place15'))){
               
               $sPlace = $this->input->post('sis_Working_place15');
                }elseif(!empty($this->input->post('sis_Working_place16'))){
               
               $sPlace = $this->input->post('sis_Working_place16');
              
            }else{
                 $sPlace = '';
            }



            if(!empty($this->input->post('yearly_salary_sis1')))
            {
                $sSalaryY = $this->input->post('yearly_salary_sis1');
            }elseif(!empty($this->input->post('yearly_salary_sis2'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis2');
                }elseif(!empty($this->input->post('yearly_salary_sis3'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis3');
                }elseif(!empty($this->input->post('yearly_salary_sis4'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis4');
                }elseif(!empty($this->input->post('yearly_salary_sis5'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis5');
                }elseif(!empty($this->input->post('yearly_salary_sis6'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis6');
                }elseif(!empty($this->input->post('yearly_salary_sis7'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis7');
                }elseif(!empty($this->input->post('yearly_salary_sis8'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis8');
                }elseif(!empty($this->input->post('yearly_salary_sis9'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis9');
                }elseif(!empty($this->input->post('yearly_salary_sis10'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis10');
                }elseif(!empty($this->input->post('yearly_salary_sis11'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis11');
                }elseif(!empty($this->input->post('yearly_salary_sis12'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis12');
                }elseif(!empty($this->input->post('yearly_salary_sis13'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis13');
                }elseif(!empty($this->input->post('yearly_salary_sis14'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis14');
                }elseif(!empty($this->input->post('yearly_salary_sis15'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis15');
                }elseif(!empty($this->input->post('yearly_salary_sis16'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis16');
                }elseif(!empty($this->input->post('yearly_salary_sis17'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis17');
                }elseif(!empty($this->input->post('yearly_salary_sis18'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis18');
                }elseif(!empty($this->input->post('yearly_salary_sis19'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis19');
                }elseif(!empty($this->input->post('yearly_salary_sis20'))){
               
               $sSalaryY = $this->input->post('yearly_salary_sis20');
              
              
            }else{
                 $sSalaryY = '';
            }


            if(!empty($this->input->post('monthly_salary_sis1')))
            {
                $sSalaryM = $this->input->post('monthly_salary_sis1');
            }elseif(!empty($this->input->post('monthly_salary_sis2'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis2');
                }elseif(!empty($this->input->post('monthly_salary_sis3'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis3');
                }elseif(!empty($this->input->post('monthly_salary_sis4'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis4');
                }elseif(!empty($this->input->post('monthly_salary_sis5'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis5');
                }elseif(!empty($this->input->post('monthly_salary_sis6'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis6');
                }elseif(!empty($this->input->post('monthly_salary_sis7'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis7');
                }elseif(!empty($this->input->post('monthly_salary_sis8'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis8');
                }elseif(!empty($this->input->post('monthly_salary_sis9'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis9');
                }elseif(!empty($this->input->post('monthly_salary_sis10'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis10');
                }elseif(!empty($this->input->post('monthly_salary_sis11'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis11');
                }elseif(!empty($this->input->post('monthly_salary_sis12'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis12');
                }elseif(!empty($this->input->post('monthly_salary_sis13'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis13');
                }elseif(!empty($this->input->post('monthly_salary_sis14'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis14');
                }elseif(!empty($this->input->post('monthly_salary_sis15'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis15');
                }elseif(!empty($this->input->post('monthly_salary_sis16'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis16');
                }elseif(!empty($this->input->post('monthly_salary_sis17'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis17');
                }elseif(!empty($this->input->post('monthly_salary_sis18'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis18');
                }elseif(!empty($this->input->post('monthly_salary_sis19'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis19');
                }elseif(!empty($this->input->post('monthly_salary_sis20'))){
               
               $sSalaryM = $this->input->post('monthly_salary_sis20');
              
              
            }else{
                 $sSalaryM = '';
            }


             if(!empty($this->input->post('sister_age1')))
            {
                $sAge = $this->input->post('sister_age1');
            }elseif(!empty($this->input->post('sister_age2'))){
               
               $sAge = $this->input->post('sister_age2');
                }elseif(!empty($this->input->post('sister_age3'))){
               
               $sAge = $this->input->post('sister_age3');
                }elseif(!empty($this->input->post('sister_age4'))){
               
               $sAge = $this->input->post('sister_age4');
                }elseif(!empty($this->input->post('sister_age5'))){
               
               $sAge = $this->input->post('sister_age5');
                }elseif(!empty($this->input->post('sister_age6'))){
               
               $sAge = $this->input->post('sister_age6');
                }elseif(!empty($this->input->post('sister_age7'))){
               
               $sAge = $this->input->post('sister_age7');
                }elseif(!empty($this->input->post('sister_age8'))){
               
               $sAge = $this->input->post('sister_age8');
                }elseif(!empty($this->input->post('sister_age9'))){
               
               $sAge = $this->input->post('sister_age9');
                }elseif(!empty($this->input->post('sister_age10'))){
               
               $sAge = $this->input->post('sister_age10');
                }elseif(!empty($this->input->post('sister_age11'))){
               
               $sAge = $this->input->post('sister_age11');
                }elseif(!empty($this->input->post('sister_age12'))){
               
               $sAge = $this->input->post('sister_age12');
                }elseif(!empty($this->input->post('sister_age13'))){
               
               $sAge = $this->input->post('sister_age13');
                }elseif(!empty($this->input->post('sister_age14'))){
               
               $sAge = $this->input->post('sister_age14');
                }elseif(!empty($this->input->post('sister_age15'))){
               
               $sAge = $this->input->post('sister_age15');
                }elseif(!empty($this->input->post('sister_age16'))){
               
               $sAge = $this->input->post('sister_age16');
                }elseif(!empty($this->input->post('sister_age17'))){
               
               $sAge = $this->input->post('sister_age17');
                }elseif(!empty($this->input->post('sister_age18'))){
               
               $sAge = $this->input->post('sister_age18');
                }elseif(!empty($this->input->post('sister_age19'))){
               
               $sAge = $this->input->post('sister_age19');
                }elseif(!empty($this->input->post('sister_age20'))){
               
               $sAge = $this->input->post('sister_age20');
                }elseif(!empty($this->input->post('sister_age21'))){
               
               $sAge = $this->input->post('sister_age21');
                }elseif(!empty($this->input->post('sister_age22'))){
               
               $sAge = $this->input->post('sister_age22');
                }elseif(!empty($this->input->post('sister_age23'))){
               
               $sAge = $this->input->post('sister_age23');
                }elseif(!empty($this->input->post('sister_age24'))){
               
               $sAge = $this->input->post('sister_age24');
            }else{
                 $sAge = '';
            }

             if(!empty($this->input->post('sis_mobile1')))
            {
                $sMobile = $this->input->post('sis_mobile1');
            }elseif(!empty($this->input->post('sis_mobile2'))){
               
               $sMobile = $this->input->post('sis_mobile2');
                }elseif(!empty($this->input->post('sis_mobile3'))){
               
               $sMobile = $this->input->post('sis_mobile3');
                }elseif(!empty($this->input->post('sis_mobile4'))){
               
               $sMobile = $this->input->post('sis_mobile4');
                }elseif(!empty($this->input->post('sis_mobile5'))){
               
               $sMobile = $this->input->post('sis_mobile5');
                }elseif(!empty($this->input->post('sis_mobile6'))){
               
               $sMobile = $this->input->post('sis_mobile6');
                }elseif(!empty($this->input->post('sis_mobile7'))){
               
               $sMobile = $this->input->post('sis_mobile7');
                }elseif(!empty($this->input->post('sis_mobile8'))){
               
               $sMobile = $this->input->post('sis_mobile8');
                }elseif(!empty($this->input->post('sis_mobile9'))){
               
               $sMobile = $this->input->post('sis_mobile9');
                }elseif(!empty($this->input->post('sis_mobile10'))){
               
               $sMobile = $this->input->post('sis_mobile10');
                }elseif(!empty($this->input->post('sis_mobile11'))){
               
               $sMobile = $this->input->post('sis_mobile11');
                }elseif(!empty($this->input->post('sis_mobile12'))){
               
               $sMobile = $this->input->post('sis_mobile12');
                }elseif(!empty($this->input->post('sis_mobile13'))){
               
               $sMobile = $this->input->post('sis_mobile13');
                }elseif(!empty($this->input->post('sis_mobile14'))){
               
               $sMobile = $this->input->post('sis_mobile14');
                }elseif(!empty($this->input->post('sis_mobile15'))){
               
               $sMobile = $this->input->post('sis_mobile15');
                }elseif(!empty($this->input->post('sis_mobile16'))){
               
               $sMobile = $this->input->post('sis_mobile16');
                }elseif(!empty($this->input->post('sis_mobile17'))){
               
               $sMobile = $this->input->post('sis_mobile17');
                }elseif(!empty($this->input->post('sis_mobile18'))){
               
               $sMobile = $this->input->post('sis_mobile18');
                }elseif(!empty($this->input->post('sis_mobile19'))){
               
               $sMobile = $this->input->post('sis_mobile19');
                }elseif(!empty($this->input->post('sis_mobile20'))){
               
               $sMobile = $this->input->post('sis_mobile20');
                }elseif(!empty($this->input->post('sis_mobile21'))){
               
               $sMobile = $this->input->post('sis_mobile21');
                }elseif(!empty($this->input->post('sis_mobile22'))){
               
               $sMobile = $this->input->post('sis_mobile22');
                }elseif(!empty($this->input->post('sis_mobile23'))){
               
               $sMobile = $this->input->post('sis_mobile23');
                }elseif(!empty($this->input->post('sis_mobile24'))){
               
               $sMobile = $this->input->post('sis_mobile24');
            }else{
                 $sMobile = '';
            }

           if(!empty($this->input->post('m_conditions1')))
            {
                $mCond = $this->input->post('m_conditions1');
            }elseif(!empty($this->input->post('m_conditions2'))){
               
               $mCond = $this->input->post('m_conditions2');
                }elseif(!empty($this->input->post('m_conditions3'))){
               
               $mCond = $this->input->post('m_conditions3');
                }elseif(!empty($this->input->post('m_conditions4'))){
               
               $mCond = $this->input->post('m_conditions4');
                }elseif(!empty($this->input->post('m_conditions5'))){
               
               $mCond = $this->input->post('m_conditions5');
            }else{
                 $mCond = '';
            }
            
             if(!empty($this->input->post('father_Working_place1')))
            {
                $fPlace = $this->input->post('father_Working_place1');
            }elseif(!empty($this->input->post('father_Working_place2'))){
               
               $fPlace = $this->input->post('father_Working_place2');
                }elseif(!empty($this->input->post('father_Working_place3'))){
               
               $fPlace = $this->input->post('father_Working_place3');
                
            }else{
                 $fPlace = '';
            }

            if(!empty($this->input->post('father_department1')))
            {
                $fDept = $this->input->post('father_department1');
            }elseif(!empty($this->input->post('father_department2'))){
               
               $fDept = $this->input->post('father_department2');
                }elseif(!empty($this->input->post('father_department3'))){
               
               $fDept = $this->input->post('father_department3');
                
            }else{
                 $fDept = '';
            }


          if(!empty($this->input->post('mother_name1')))
            {
                $mName = $this->input->post('mother_name1');
            }elseif(!empty($this->input->post('mother_name2'))){
               
               $mName = $this->input->post('mother_name2');
                }elseif(!empty($this->input->post('mother_name3'))){
               
               $mName = $this->input->post('mother_name3');
                }elseif(!empty($this->input->post('mother_name4'))){
               
               $mName = $this->input->post('mother_name4');
                }elseif(!empty($this->input->post('mother_name5'))){
               
               $mName = $this->input->post('mother_name5');
                }elseif(!empty($this->input->post('mother_name6'))){
               
               $mName = $this->input->post('mother_name6');
            }else{
                 $mName = '';
            }

          
            if(!empty($this->input->post('learning_bro1')))
            {
                $sStudy = $this->input->post('learning_bro1');
            }elseif(!empty($this->input->post('learning_bro2'))){
               
               $sStudy = $this->input->post('learning_bro2');
                }elseif(!empty($this->input->post('learning_bro3'))){
               
               $sStudy = $this->input->post('learning_bro3');
                }elseif(!empty($this->input->post('learning_bro4'))){
               
               $sStudy = $this->input->post('learning_bro4');
                }else{
                     $sStudy = '';
                }

           if(!empty($this->input->post('learning_bro5'))){
               
               $bStudy = $this->input->post('learning_bro5');
                }elseif(!empty($this->input->post('learning_bro6'))){
               
               $bStudy = $this->input->post('learning_bro6');
                 }elseif(!empty($this->input->post('learning_bro7'))){
               
               $bStudy = $this->input->post('learning_bro7');
                  }elseif(!empty($this->input->post('learning_bro8'))){
               
               $bStudy = $this->input->post('learning_bro8');
            }else{
                 $bStudy = '';
            }

         if(!empty($this->input->post('bro_teaching_place1')))
            {
                $sStudyPlace = $this->input->post('bro_teaching_place1');
            }elseif(!empty($this->input->post('bro_teaching_place2'))){
               
               $sStudyPlace = $this->input->post('bro_teaching_place2');
                }elseif(!empty($this->input->post('bro_teaching_place3'))){
               
               $sStudyPlace = $this->input->post('bro_teaching_place3');
                }elseif(!empty($this->input->post('bro_teaching_place4'))){
               
               $sStudyPlace = $this->input->post('bro_teaching_place4');
                
            }else{
                 $sStudyPlace = '';
            }


                if(!empty($this->input->post('bro_teaching_place5'))){
               
               $bStudyPlace = $this->input->post('bro_teaching_place5');
                }elseif(!empty($this->input->post('bro_teaching_place6'))){
               
               $bStudyPlace = $this->input->post('bro_teaching_place6');
                 }elseif(!empty($this->input->post('bro_teaching_place7'))){
               
               $bStudyPlace = $this->input->post('bro_teaching_place7');
                }elseif(!empty($this->input->post('bro_teaching_place8'))){
               
               $bStudyPlace = $this->input->post('bro_teaching_place8');
                }else{
                     $bStudyPlace = '';
                }

        if(!empty($this->input->post('mother_department1')))
            {
                $mDept = $this->input->post('mother_department1');
            }elseif(!empty($this->input->post('mother_department2'))){
               
               $mDept = $this->input->post('mother_department2');
                }elseif(!empty($this->input->post('mother_department3'))){
               
               $mDept = $this->input->post('mother_department3');
            }else{
                 $mDept = '';
            }


            if(!empty($this->input->post('mother_age1')))
            {
                $mAge = $this->input->post('mother_age1');
            }elseif(!empty($this->input->post('mother_age2'))){
               
               $mAge = $this->input->post('mother_age2');
                }elseif(!empty($this->input->post('mother_age3'))){
               
               $mAge = $this->input->post('mother_age3');
                }elseif(!empty($this->input->post('mother_age4'))){
               
               $mAge = $this->input->post('mother_age4');
                }elseif(!empty($this->input->post('mother_age5'))){
               
               $mAge = $this->input->post('mother_age5');
            }else{
                 $mAge = '';
            }


         if(!empty($this->input->post('mother_post1')))
            {
                $mPost = $this->input->post('mother_post1');
            }elseif(!empty($this->input->post('mother_post2'))){
               
               $mPost = $this->input->post('mother_post2');
            }else{
                 $mPost = '';
            }              


     if(!empty($this->input->post('mother_Working_place1')))
            {
                $mWork = $this->input->post('mother_Working_place1');
            }elseif(!empty($this->input->post('mother_Working_place2'))){
               
               $mWork = $this->input->post('mother_Working_place2');
                }elseif(!empty($this->input->post('mother_Working_place3'))){
               
               $mWork = $this->input->post('mother_Working_place3');
            }else{
                 $mWork = '';
            }

        if(!empty($this->input->post('mgm_Working_place1')))
            {
                $mgmWork = $this->input->post('mgm_Working_place1');
            }elseif(!empty($this->input->post('mgm_Working_place2'))){
               
               $mgmWork = $this->input->post('mgm_Working_place2');
                }elseif(!empty($this->input->post('mgm_Working_place3'))){
               
               $mgmWork = $this->input->post('mgm_Working_place3');
              
            }else{
                 $mgmWork = '';
            }        

              if(!empty($this->input->post('gm_Working_place1')))
            {
                $gmWork = $this->input->post('gm_Working_place1');
            }elseif(!empty($this->input->post('gm_Working_place2'))){
               
               $gmWork = $this->input->post('gm_Working_place2');
                }elseif(!empty($this->input->post('gm_Working_place3'))){
               
               $gmWork = $this->input->post('gm_Working_place3');
              
            }else{
                 $gmWork = '';
            }       

             if(!empty($this->input->post('mgm_post1')))
            {
                $mgmPost = $this->input->post('mgm_post1');
            }elseif(!empty($this->input->post('mgm_post2'))){
               
               $mgmPost = $this->input->post('mgm_post2');
                }elseif(!empty($this->input->post('mgm_post3'))){
               
               $mgmPost = $this->input->post('mgm_post3');
              
            }else{
                 $mgmPost = '';
            }     

              if(!empty($this->input->post('gm_post1')))
            {
                $gmPost = $this->input->post('gm_post1');
            }elseif(!empty($this->input->post('gm_post2'))){
               
               $gmPost = $this->input->post('gm_post2');
                }elseif(!empty($this->input->post('gm_post3'))){
               
               $gmPost = $this->input->post('gm_post3');
              
            }else{
                 $gmPost = '';
            }     

        if(!empty($this->input->post('mgm_department1')))
            {
                $mgmDept = $this->input->post('mgm_department1');
            }elseif(!empty($this->input->post('mgm_department2'))){
               
               $mgmDept = $this->input->post('mgm_department2');
                }elseif(!empty($this->input->post('mgm_department3'))){
               
               $mgmDept = $this->input->post('mgm_department3');
              
            }else{
                 $mgmDept = '';
            }   

            if(!empty($this->input->post('gm_department1')))
            {
                $gmDept = $this->input->post('gm_department1');
            }elseif(!empty($this->input->post('gm_department2'))){
               
               $gmDept = $this->input->post('gm_department2');
                }elseif(!empty($this->input->post('gm_department3'))){
               
               $gmDept = $this->input->post('gm_department3');
              
            }else{
                 $gmDept = '';
            }   

              
               if(!empty($this->input->post('u_department1')))
            {
                $uDept = $this->input->post('u_department1');
            }elseif(!empty($this->input->post('u_department2'))){
               
               $uDept = $this->input->post('u_department2');
                }elseif(!empty($this->input->post('u_department3'))){
               
               $uDept = $this->input->post('u_department3');
              
            }else{
                 $uDept = '';
            }   

            if(!empty($this->input->post('mgm_name1')))
            {
                $mgmName = $this->input->post('mgm_name1');
            }elseif(!empty($this->input->post('mgm_name2'))){
               
               $mgmName = $this->input->post('mgm_name2');
                }elseif(!empty($this->input->post('mgm_name3'))){
               
               $mgmName = $this->input->post('mgm_name3');
                }elseif(!empty($this->input->post('mgm_name4'))){
               
               $mgmName = $this->input->post('mgm_name4');
                }elseif(!empty($this->input->post('mgm_name5'))){
               
               $mgmName = $this->input->post('mgm_name5');
                 }elseif(!empty($this->input->post('mgm_name6'))){
               
               $mgmName = $this->input->post('mgm_name6');
                }elseif(!empty($this->input->post('mgm_name7'))){
               
               $mgmName = $this->input->post('mgm_name7');
            }else{
                 $mgmName = '';
            }      
             
            if(!empty($this->input->post('father_name1')))
            {
                $fName = $this->input->post('father_name1');
            }elseif(!empty($this->input->post('father_name2'))){
               
               $fName = $this->input->post('father_name2');
                }elseif(!empty($this->input->post('father_name3'))){
               
               $fName = $this->input->post('father_name3');
                }elseif(!empty($this->input->post('father_name4'))){
               
               $fName = $this->input->post('father_name4');
                }elseif(!empty($this->input->post('father_name5'))){
               
               $fName = $this->input->post('father_name5');
                 }elseif(!empty($this->input->post('father_name6'))){
               
               $fName = $this->input->post('father_name6');
                }elseif(!empty($this->input->post('father_name7'))){
               
               $fName = $this->input->post('father_name7');
            }else{
                 $fName = '';
            }     
  
            if(!empty($this->input->post('nm_age1')))
            {
                $nAge = $this->input->post('nm_age1');
            }elseif(!empty($this->input->post('nm_age2'))){
               
               $nAge = $this->input->post('nm_age2');
                }elseif(!empty($this->input->post('nm_age3'))){
               
               $nAge = $this->input->post('nm_age3');
                }elseif(!empty($this->input->post('nm_age4'))){
               
               $nAge = $this->input->post('nm_age4');
                }elseif(!empty($this->input->post('nm_age5'))){
               
               $nAge = $this->input->post('nm_age5');
                 }elseif(!empty($this->input->post('nm_age6'))){
               
               $nAge = $this->input->post('nm_age6');
            }else{
                 $nAge = '';
            }     

             if(!empty($this->input->post('monthly_salary_nm1')))
            {
                $nmSalaryM = $this->input->post('monthly_salary_nm1');
            }elseif(!empty($this->input->post('monthly_salary_nm2'))){
               
               $nmSalaryM = $this->input->post('monthly_salary_nm2');
                }elseif(!empty($this->input->post('monthly_salary_nm3'))){
               
               $nmSalaryM = $this->input->post('monthly_salary_nm3');
                }elseif(!empty($this->input->post('monthly_salary_nm4'))){
               
               $nmSalaryM = $this->input->post('monthly_salary_nm4');
                }elseif(!empty($this->input->post('monthly_salary_nm5'))){
               
               $nmSalaryM = $this->input->post('monthly_salary_nm5');
               
            }else{
                 $nmSalaryM = '';
            } 

              if(!empty($this->input->post('yearly_salary_nm1')))
            {
                $nmSalaryY = $this->input->post('yearly_salary_nm1');
            }elseif(!empty($this->input->post('yearly_salary_nm2'))){
               
               $nmSalaryY = $this->input->post('yearly_salary_nm2');
                }elseif(!empty($this->input->post('yearly_salary_nm3'))){
               
               $nmSalaryY = $this->input->post('yearly_salary_nm3');
                }elseif(!empty($this->input->post('yearly_salary_nm4'))){
               
               $nmSalaryY = $this->input->post('yearly_salary_nm4');
                }elseif(!empty($this->input->post('yearly_salary_nm5'))){
               
               $nmSalaryY = $this->input->post('yearly_salary_nm5');
               
            }else{
                 $nmSalaryY = '';
            }    


       if(!empty($this->input->post('nm_name1')))
            {
                $nName = $this->input->post('nm_name1');
            }elseif(!empty($this->input->post('nm_name2'))){
               
               $nName = $this->input->post('nm_name2');
                }elseif(!empty($this->input->post('nm_name3'))){
               
               $nName = $this->input->post('nm_name3');
                }elseif(!empty($this->input->post('nm_name4'))){
               
               $nName = $this->input->post('nm_name4');
                }elseif(!empty($this->input->post('nm_name5'))){
               
               $nName = $this->input->post('nm_name5');

           }elseif(!empty($this->input->post('nm_name6'))){
               
               $nName = $this->input->post('nm_name6');
            }else{
                 $nName = '';
            }            

 if(!empty($this->input->post('yearly_salary_m1')))
            {
                $mSalaryY = $this->input->post('yearly_salary_m1');
            }elseif(!empty($this->input->post('yearly_salary_m2'))){
               
               $mSalaryY = $this->input->post('yearly_salary_m2');
                }elseif(!empty($this->input->post('yearly_salary_m3'))){
               
               $mSalaryY = $this->input->post('yearly_salary_m3');
                }elseif(!empty($this->input->post('yearly_salary_m4'))){
               
               $mSalaryY = $this->input->post('yearly_salary_m4');
            }else{
                 $mSalaryY = '';
            }    

 if(!empty($this->input->post('monthly_salary_m1')))
            {
                $mSalaryM = $this->input->post('monthly_salary_m1');
            }elseif(!empty($this->input->post('monthly_salary_m2'))){
               
               $mSalaryM = $this->input->post('monthly_salary_m2');
                }elseif(!empty($this->input->post('monthly_salary_m3'))){
               
               $mSalaryM = $this->input->post('monthly_salary_m3');
                }elseif(!empty($this->input->post('monthly_salary_m4'))){
               
               $mSalaryM = $this->input->post('monthly_salary_m4');
            }else{
                 $mSalaryM = '';
            }  

              

            if(!empty($this->input->post('gfather_Working_place1')))
            {
                $gfPlace = $this->input->post('gfather_Working_place1');
            }elseif(!empty($this->input->post('gfather_Working_place2'))){
               
               $gfPlace = $this->input->post('gfather_Working_place2');
                }elseif(!empty($this->input->post('gfather_Working_place3'))){
               
               $gfPlace = $this->input->post('gfather_Working_place3');
               
            }else{
                 $gfPlace = '';
            }       

      if(!empty($this->input->post('gmoth_age1')))
            {
                $gmAge = $this->input->post('gmoth_age1');
            }elseif(!empty($this->input->post('gmoth_age2'))){
               
               $gmAge = $this->input->post('gmoth_age2');
                }elseif(!empty($this->input->post('gmoth_age3'))){
               
               $gmAge = $this->input->post('gmoth_age3');
                }elseif(!empty($this->input->post('gmoth_age4'))){
               
               $gmAge = $this->input->post('gmoth_age4');
            }else{
                 $gmAge = '';
            }           


      

        if(!empty($this->input->post('g_mobile1')))
            {
                $gfMobile = $this->input->post('g_mobile1');
            
                }elseif(!empty($this->input->post('g_mobile2'))){
               
               $gfMobile = $this->input->post('g_mobile2');
                }elseif(!empty($this->input->post('g_mobile3'))){
               
               $gfMobile = $this->input->post('g_mobile3');
                }elseif(!empty($this->input->post('g_mobile4'))){
               
               $gfMobile = $this->input->post('g_mobile4');
                }elseif(!empty($this->input->post('g_mobile5'))){
               
               $gfMobile = $this->input->post('g_mobile5');
            }else{
                 $gfMobile = '';
            }    

             if(!empty($this->input->post('father_post1')))
            {
                $fPost = $this->input->post('father_post1');
            }elseif(!empty($this->input->post('father_post2'))){
               
               $fPost = $this->input->post('father_post2');
            }else{
                 $fPost = '';
            }   

     if(!empty($this->input->post('gfather_post1')))
            {
                $gfPost = $this->input->post('gfather_post1');
            }elseif(!empty($this->input->post('gfather_post2'))){
               
               $gfPost = $this->input->post('gfPost');
            }else{
                 $gfPost = '';
            }      

          if(!empty($this->input->post('f_mobile1')))
            {
                $fMobile = $this->input->post('f_mobile1');
            }elseif(!empty($this->input->post('f_mobile2'))){
               
               $fMobile = $this->input->post('f_mobile2');
                }elseif(!empty($this->input->post('f_mobile3'))){
               
               $fMobile = $this->input->post('f_mobile3');
                }elseif(!empty($this->input->post('f_mobile4'))){
               
               $fMobile = $this->input->post('f_mobile4');
                }elseif(!empty($this->input->post('f_mobile5'))){
               
               $fMobile = $this->input->post('f_mobile5');
            }else{
                 $fMobile = '';
            } 

           if(!empty($this->input->post('mgm_age1')))
            {
                $mgmAge = $this->input->post('mgm_age1');
            }elseif(!empty($this->input->post('mgm_age2'))){
               
               $mgmAge = $this->input->post('mgm_age2');
                }elseif(!empty($this->input->post('mgm_age3'))){
               
               $mgmAge = $this->input->post('mgm_age3');
                }elseif(!empty($this->input->post('mgm_age4'))){
               
               $mgmAge = $this->input->post('mgm_age4');
                }elseif(!empty($this->input->post('mgm_age5'))){
               
               $mgmAge = $this->input->post('mgm_age5');
            }else{
                 $mgmAge = '';
            } 

            if(!empty($this->input->post('m_mobile1')))
            {
                $mMobile = $this->input->post('m_mobile1');
            }elseif(!empty($this->input->post('m_mobile2'))){
               
               $mMobile = $this->input->post('m_mobile2');
                }elseif(!empty($this->input->post('m_mobile3'))){
               
               $mMobile = $this->input->post('m_mobile3');
                }elseif(!empty($this->input->post('m_mobile4'))){
               
               $mMobile = $this->input->post('m_mobile4');
                }elseif(!empty($this->input->post('m_mobile5'))){
               
               $mMobile = $this->input->post('m_mobile5');
            }else{
                 $mMobile = '';
            } 

 if(!empty($this->input->post('gfather_name2')))
            {
                $gfName = $this->input->post('gfather_name2');
            }elseif(!empty($this->input->post('gfather_name4'))){
               
               $gfName = $this->input->post('gfather_name3');
                }elseif(!empty($this->input->post('gfather_name4'))){
               
               $gfName = $this->input->post('gfather_name4');
                }elseif(!empty($this->input->post('gfather_name5'))){
               
               $gfName = $this->input->post('gfather_name5');
                }elseif(!empty($this->input->post('gfather_name6'))){
               
               $gfName = $this->input->post('gfather_name6');
            }else{
                 $gfName = '';
            }
             

              if(!empty($this->input->post('married_status_bua1')))
            {
                $buaMrg = $this->input->post('married_status_bua1');
            }elseif(!empty($this->input->post('married_status_bua2'))){
               
               $buaMrg = $this->input->post('married_status_bua2');
                }elseif(!empty($this->input->post('married_status_bua3'))){
               
               $buaMrg = $this->input->post('married_status_bua3');
                }elseif(!empty($this->input->post('married_status_bua4'))){
               
               $buaMrg = $this->input->post('married_status_bua4');
                }elseif(!empty($this->input->post('married_status_bua5'))){
               
               $buaMrg = $this->input->post('married_status_bua5');
                 }elseif(!empty($this->input->post('married_status_bua6'))){
               
               $buaMrg = $this->input->post('married_status_bua6');
            }else{
                 $buaMrg = '';
            }

            if(!empty($this->input->post('bua_age1')))
            {
                $buaAge = $this->input->post('bua_age1');
            }elseif(!empty($this->input->post('bua_age2'))){
               
               $buaAge = $this->input->post('bua_age2');
                }elseif(!empty($this->input->post('bua_age3'))){
               
               $buaAge = $this->input->post('bua_age3');
                }elseif(!empty($this->input->post('bua_age4'))){
               
               $buaAge = $this->input->post('bua_age4');
                }elseif(!empty($this->input->post('bua_age5'))){
               
               $buaAge = $this->input->post('bua_age5');
                 }elseif(!empty($this->input->post('bua_age6'))){
               
               $buaAge = $this->input->post('bua_age6');
            }else{
                 $buaAge = '';
            }

            if(!empty($this->input->post('bua_name1')))
            {
                $buaName = $this->input->post('bua_name1');
            }elseif(!empty($this->input->post('bua_name2'))){
               
               $buaName = $this->input->post('bua_name2');
                }elseif(!empty($this->input->post('bua_name3'))){
               
               $buaName = $this->input->post('bua_name3');
                }elseif(!empty($this->input->post('bua_name4'))){
               
               $buaName = $this->input->post('bua_name4');
                }elseif(!empty($this->input->post('bua_name5'))){
               
               $buaName = $this->input->post('bua_name5');
                 }elseif(!empty($this->input->post('bua_name6'))){
               
               $buaName = $this->input->post('bua_name6');
            }else{
                 $buaName = '';
            }

           
              if(!empty($this->input->post('bua_Working_place1')))
            {
                $buaPlace = $this->input->post('bua_Working_place1');
            }elseif(!empty($this->input->post('bua_Working_place2'))){
               
               $buaPlace = $this->input->post('bua_Working_place2');
                }elseif(!empty($this->input->post('bua_Working_place3'))){
               
               $buaPlace = $this->input->post('bua_Working_place3');

               }elseif(!empty($this->input->post('bua_Working_place4'))){
               
               $buaPlace = $this->input->post('bua_Working_place4');
             
            }else{
                 $buaPlace = '';
            }


               if(!empty($this->input->post('bua_department1')))
            {
                $buaDept = $this->input->post('bua_department1');
            }elseif(!empty($this->input->post('bua_department2'))){
               
               $buaDept = $this->input->post('bua_department2');
                }elseif(!empty($this->input->post('bua_department3'))){
               
               $buaDept = $this->input->post('bua_department3');
             
            }else{
                 $buaDept = '';
            }

            if(!empty($this->input->post('bua_post1')))
            {
                $buaPost = $this->input->post('bua_post1');
            }elseif(!empty($this->input->post('bua_post2'))){
               
               $buaPost = $this->input->post('bua_post2');
                
            }else{
                 $buaPost = '';
            }



 if(!empty($this->input->post('monthly_salary1')))
            {
                $fSalaryM = $this->input->post('monthly_salary1');
            }elseif(!empty($this->input->post('monthly_salary2'))){
               
               $fSalaryM = $this->input->post('monthly_salary2');
                }elseif(!empty($this->input->post('monthly_salary3'))){
               
               $fSalaryM = $this->input->post('monthly_salary3');
                }elseif(!empty($this->input->post('monthly_salary4'))){
               
               $fSalaryM = $this->input->post('monthly_salary4');
            }else{
                 $fSalaryM = '';
            }

             if(!empty($this->input->post('gmoth_age1')))
            {
                $gAge = $this->input->post('gmoth_age1');
            }elseif(!empty($this->input->post('gmoth_age2'))){
               
               $gAge = $this->input->post('gmoth_age2');
                }elseif(!empty($this->input->post('gmoth_age3'))){
               
               $gAge = $this->input->post('gmoth_age3');
                }elseif(!empty($this->input->post('gmoth_age4'))){
               
               $gAge = $this->input->post('gmoth_age4');
                }elseif(!empty($this->input->post('gmoth_age5'))){
               
               $gAge = $this->input->post('gmoth_age5');
            }else{
                 $gAge = '';
            }
            
             if(!empty($this->input->post('u_Working_place1')))
            {
                $uPlace = $this->input->post('u_Working_place1');
            }elseif(!empty($this->input->post('u_Working_place2'))){
               
               $uPlace = $this->input->post('u_Working_place2');
                }elseif(!empty($this->input->post('u_Working_place3'))){
               
               $uPlace = $this->input->post('u_Working_place3');
                }elseif(!empty($this->input->post('u_Working_place4'))){
               
               $uPlace = $this->input->post('u_Working_place4');
            }else{
                 $uPlace = '';
            }
          
             if(!empty($this->input->post('yearly_salary_u1')))
            {
                $uSalaryY = $this->input->post('yearly_salary_u1');
            }elseif(!empty($this->input->post('yearly_salary_u2'))){
               
               $uSalaryY = $this->input->post('yearly_salary_u2');
                }elseif(!empty($this->input->post('yearly_salary_u3'))){
               
               $uSalaryY = $this->input->post('yearly_salary_u3');
                }elseif(!empty($this->input->post('yearly_salary_u4'))){
               
               $uSalaryY = $this->input->post('yearly_salary_u4');
                }elseif(!empty($this->input->post('yearly_salary_u5'))){
               
               $uSalaryY = $this->input->post('yearly_salary_u5');
            }else{
                 $uSalaryY = '';
            }
             if(!empty($this->input->post('monthly_salary_u1')))
            {
                $uSalaryM = $this->input->post('monthly_salary_u1');
            }elseif(!empty($this->input->post('monthly_salary_u2'))){
               
               $uSalaryM = $this->input->post('monthly_salary_u2');
                }elseif(!empty($this->input->post('monthly_salary_u3'))){
               
               $uSalaryM = $this->input->post('monthly_salary_u3');
                }elseif(!empty($this->input->post('monthly_salary_u4'))){
               
               $uSalaryM = $this->input->post('monthly_salary_u4');
                }elseif(!empty($this->input->post('monthly_salary_u5'))){
               
               $uSalaryM = $this->input->post('monthly_salary_u5');
            }else{
                 $uSalaryM = '';
            }

            if(!empty($this->input->post('monthly_salary_bua1')))
            {
                $buaSalaryM = $this->input->post('monthly_salary_bua1');
            }elseif(!empty($this->input->post('monthly_salary_bua2'))){
               
               $buaSalaryM = $this->input->post('monthly_salary_bua2');
                }elseif(!empty($this->input->post('monthly_salary_bua3'))){
               
               $buaSalaryM = $this->input->post('monthly_salary_bua3');
                }elseif(!empty($this->input->post('monthly_salary_bua4'))){
               
               $buaSalaryM = $this->input->post('monthly_salary_bua4');
                }elseif(!empty($this->input->post('monthly_salary_bua5'))){
               
               $buaSalaryM = $this->input->post('monthly_salary_bua5');
               
            }else{
                 $buaSalaryM = '';
            }

           

            if(!empty($this->input->post('yearly_salary_bua1')))
            {
                $buaSalaryY = $this->input->post('yearly_salary_bua1');
            }elseif(!empty($this->input->post('yearly_salary_bua2'))){
               
               $buaSalaryY = $this->input->post('yearly_salary_bua2');
                }elseif(!empty($this->input->post('yearly_salary_bua3'))){
               
               $buaSalaryY = $this->input->post('yearly_salary_bua3');
                }elseif(!empty($this->input->post('yearly_salary_bua4'))){
               
               $buaSalaryY = $this->input->post('yearly_salary_bua4');
                }elseif(!empty($this->input->post('yearly_salary_bua5'))){
               
               $buaSalaryY = $this->input->post('yearly_salary_bua5');
               
            }else{
                 $buaSalaryY = '';
            }

           

             if(!empty($this->input->post('father_age1')))
            {
                $fAge = $this->input->post('father_age1');
            }elseif(!empty($this->input->post('father_age2'))){
               
               $fAge = $this->input->post('father_age2');
                }elseif(!empty($this->input->post('father_age3'))){
               
               $fAge = $this->input->post('father_age3');
                }elseif(!empty($this->input->post('father_age4'))){
               
               $fAge = $this->input->post('father_age4');
            }else{
                 $fAge = '';
            }

            if(!empty($this->input->post('gmoth_name1')))
            {
                $gName = $this->input->post('gmoth_name1');
            }elseif(!empty($this->input->post('gmoth_name2'))){
               
               $gName = $this->input->post('gmoth_name2');
                }elseif(!empty($this->input->post('gmoth_name3'))){
               
               $gName = $this->input->post('gmoth_name3');
                }elseif(!empty($this->input->post('gmoth_name4'))){
               
               $gName = $this->input->post('gmoth_name4');
                }elseif(!empty($this->input->post('gmoth_name5'))){
               
               $gName = $this->input->post('gmoth_name5');
            }else{
                 $gName = '';
            }
               

               
               if(!empty($this->input->post('brother_age1')))
               {
                $bAge = $this->input->post('brother_age1');
               }elseif(!empty($this->input->post('brother_age2'))){
               
               $bAge = $this->input->post('brother_age2');
            
               }elseif(!empty($this->input->post('brother_age3'))){
               
               $bAge = $this->input->post('brother_age3');
               }elseif(!empty($this->input->post('brother_age4'))){
               
               $bAge = $this->input->post('brother_age4');
               }elseif(!empty($this->input->post('brother_age5'))){
               
               $bAge = $this->input->post('brother_age5');

               }elseif(!empty($this->input->post('brother_age6'))){
               
               $bAge = $this->input->post('brother_age6');
               }elseif(!empty($this->input->post('brother_age7'))){
               
               $bAge = $this->input->post('brother_age7');
               }elseif(!empty($this->input->post('brother_age8'))){
               
               $bAge = $this->input->post('brother_age8');
               }elseif(!empty($this->input->post('brother_age9'))){
               
               $bAge = $this->input->post('brother_age9');
               }elseif(!empty($this->input->post('brother_age10'))){
               
               $bAge = $this->input->post('brother_age10');
               }elseif(!empty($this->input->post('brother_age11'))){
               
               $bAge = $this->input->post('brother_age11');
               }elseif(!empty($this->input->post('brother_age12'))){
               
               $bAge = $this->input->post('brother_age12');
               }elseif(!empty($this->input->post('brother_age13'))){
               
               $bAge = $this->input->post('brother_age13');
               }elseif(!empty($this->input->post('brother_age14'))){
               
               $bAge = $this->input->post('brother_age14');
              
               }elseif(!empty($this->input->post('brother_age15'))){
               
               $bAge = $this->input->post('brother_age15');
               }elseif(!empty($this->input->post('brother_age16'))){
               
               $bAge = $this->input->post('brother_age16');
               }elseif(!empty($this->input->post('brother_age17'))){
               
               $bAge = $this->input->post('brother_age17');
               }elseif(!empty($this->input->post('brother_age18'))){
               
               $bAge = $this->input->post('brother_age18');
               }elseif(!empty($this->input->post('brother_age19'))){
               
               $bAge = $this->input->post('brother_age19');
               }elseif(!empty($this->input->post('brother_age20'))){
               
               $bAge = $this->input->post('brother_age20');
               }elseif(!empty($this->input->post('brother_age21'))){
               
               $bAge = $this->input->post('brother_age21');
               }elseif(!empty($this->input->post('brother_age22'))){
               
               $bAge = $this->input->post('brother_age22');

               }elseif(!empty($this->input->post('brother_age23'))){
                   
                   $bAge = $this->input->post('brother_age23');

               }elseif(!empty($this->input->post('brother_age24'))){
                   
                   $bAge = $this->input->post('brother_age24');

                }else{
                     $bAge = '';
                }

               if(!empty($this->input->post('brother_name1')))
               {
                $broName = $this->input->post('brother_name1');
               }elseif(!empty($this->input->post('brother_name2'))){
               
               $broName = $this->input->post('brother_name2');
            
               }elseif(!empty($this->input->post('brother_name3'))){
               
               $broName = $this->input->post('brother_name3');
               }elseif(!empty($this->input->post('brother_name4'))){
               
               $broName = $this->input->post('brother_name4');
               }elseif(!empty($this->input->post('brother_name5'))){
               
               $broName = $this->input->post('brother_name5');

               }elseif(!empty($this->input->post('brother_name6'))){
               
               $broName = $this->input->post('brother_name6');
               }elseif(!empty($this->input->post('brother_name7'))){
               
               $broName = $this->input->post('brother_name7');
               }elseif(!empty($this->input->post('brother_name8'))){
               
               $broName = $this->input->post('brother_name8');
               }elseif(!empty($this->input->post('brother_name9'))){
               
               $broName = $this->input->post('brother_name9');
               }elseif(!empty($this->input->post('brother_name10'))){
               
               $broName = $this->input->post('brother_name10');
               }elseif(!empty($this->input->post('brother_name11'))){
               
               $broName = $this->input->post('brother_name11');
               }elseif(!empty($this->input->post('brother_name12'))){
               
               $broName = $this->input->post('brother_name12');
               }elseif(!empty($this->input->post('brother_name13'))){
               
               $broName = $this->input->post('brother_name13');
               }elseif(!empty($this->input->post('brother_name14'))){
               
               $broName = $this->input->post('brother_name14');
              
               }elseif(!empty($this->input->post('brother_name15'))){
               
               $broName = $this->input->post('brother_name15');
               }elseif(!empty($this->input->post('brother_name16'))){
               
               $broName = $this->input->post('brother_name16');
               }elseif(!empty($this->input->post('brother_name17'))){
               
               $broName = $this->input->post('brother_name17');
               }elseif(!empty($this->input->post('brother_name18'))){
               
               $broName = $this->input->post('brother_name18');
               }elseif(!empty($this->input->post('brother_name19'))){
               
               $broName = $this->input->post('brother_name19');
               }elseif(!empty($this->input->post('brother_name20'))){
               
               $broName = $this->input->post('brother_name20');
               }elseif(!empty($this->input->post('brother_name21'))){
               
               $broName = $this->input->post('brother_name21');
               }elseif(!empty($this->input->post('brother_name22'))){
               
               $broName = $this->input->post('brother_name22');

               }elseif(!empty($this->input->post('brother_name23'))){
                   
                   $broName = $this->input->post('brother_name23');

                }else{
                     $broName = '';
                }

                 if(!empty($this->input->post('b_mobile1')))
               {
                $bMobile = $this->input->post('b_mobile1');
               }elseif(!empty($this->input->post('b_mobile2'))){
               
               $bMobile = $this->input->post('b_mobile2');
            
               }elseif(!empty($this->input->post('b_mobile3'))){
               
               $bMobile = $this->input->post('b_mobile3');
               }elseif(!empty($this->input->post('b_mobile4'))){
               
               $bMobile = $this->input->post('b_mobile4');
               }elseif(!empty($this->input->post('b_mobile5'))){
               
               $bMobile = $this->input->post('b_mobile5');

               }elseif(!empty($this->input->post('b_mobile6'))){
               
               $bMobile = $this->input->post('b_mobile6');
               }elseif(!empty($this->input->post('b_mobile7'))){
               
               $bMobile = $this->input->post('b_mobile7');
               }elseif(!empty($this->input->post('b_mobile8'))){
               
               $bMobile = $this->input->post('b_mobile8');
               }elseif(!empty($this->input->post('b_mobile9'))){
               
               $bMobile = $this->input->post('b_mobile9');
               }elseif(!empty($this->input->post('b_mobile10'))){
               
               $bMobile = $this->input->post('b_mobile10');
               }elseif(!empty($this->input->post('b_mobile11'))){
               
               $bMobile = $this->input->post('b_mobile11');
               }elseif(!empty($this->input->post('b_mobile12'))){
               
               $bMobile = $this->input->post('b_mobile12');
               }elseif(!empty($this->input->post('b_mobile13'))){
               
               $bMobile = $this->input->post('b_mobile13');
               }elseif(!empty($this->input->post('b_mobile14'))){
               
               $bMobile = $this->input->post('b_mobile14');
              
               }elseif(!empty($this->input->post('b_mobile15'))){
               
               $bMobile = $this->input->post('b_mobile15');
               }elseif(!empty($this->input->post('b_mobile16'))){
               
               $bMobile = $this->input->post('b_mobile16');
               }elseif(!empty($this->input->post('b_mobile17'))){
               
               $bMobile = $this->input->post('b_mobile17');
               }elseif(!empty($this->input->post('b_mobile18'))){
               
               $bMobile = $this->input->post('b_mobile18');
               }elseif(!empty($this->input->post('b_mobile19'))){
               
               $bMobile = $this->input->post('b_mobile19');
               }elseif(!empty($this->input->post('b_mobile20'))){
               
               $bMobile = $this->input->post('b_mobile20');
               }elseif(!empty($this->input->post('b_mobile21'))){
               
               $bMobile = $this->input->post('b_mobile21');
               }elseif(!empty($this->input->post('b_mobile22'))){
               
               $bMobile = $this->input->post('b_mobile22');

               }elseif(!empty($this->input->post('b_mobile23'))){
                   
                   $bMobile = $this->input->post('b_mobile23');

                    }elseif(!empty($this->input->post('b_mobile24'))){
                   
                   $bMobile = $this->input->post('b_mobile24');
                  }elseif(!empty($this->input->post('b_mobile25'))){
                   
                   $bMobile = $this->input->post('b_mobile25');
                }else{
                     $bMobile = '';
                }

            
             if(!empty($this->input->post('sister_name1')))
               {
                $sName = $this->input->post('sister_name1');
               }elseif(!empty($this->input->post('sister_name2'))){
               
               $sName = $this->input->post('sister_name2');
            
               }elseif(!empty($this->input->post('sister_name3'))){
               
               $sName = $this->input->post('sister_name3');
               }elseif(!empty($this->input->post('sister_name4'))){
               
               $sName = $this->input->post('sister_name4');
               }elseif(!empty($this->input->post('sister_name5'))){
               
               $sName = $this->input->post('sister_name5');

               }elseif(!empty($this->input->post('sister_name6'))){
               
               $sName = $this->input->post('sister_name6');
               }elseif(!empty($this->input->post('sister_name7'))){
               
               $sName = $this->input->post('sister_name7');
               }elseif(!empty($this->input->post('sister_name8'))){
               
               $sName = $this->input->post('sister_name8');
               }elseif(!empty($this->input->post('sister_name9'))){
               
               $sName = $this->input->post('sister_name9');
               }elseif(!empty($this->input->post('sister_name10'))){
               
               $sName = $this->input->post('sister_name10');
               }elseif(!empty($this->input->post('sister_name11'))){
               
               $sName = $this->input->post('sister_name11');
               }elseif(!empty($this->input->post('sister_name12'))){
               
               $sName = $this->input->post('sister_name12');
               }elseif(!empty($this->input->post('sister_name13'))){
               
               $sName = $this->input->post('sister_name13');
               }elseif(!empty($this->input->post('sister_name14'))){
               
               $sName = $this->input->post('sister_name14');
              
               }elseif(!empty($this->input->post('sister_name14'))){
               
               $sName = $this->input->post('sister_name15');
               }elseif(!empty($this->input->post('sister_name15'))){
               
               $sName = $this->input->post('sister_name16');
               }elseif(!empty($this->input->post('sister_name16'))){
               
               $sName = $this->input->post('sister_name17');
               }elseif(!empty($this->input->post('sister_name17'))){
               
               $sName = $this->input->post('sister_name18');
               }elseif(!empty($this->input->post('sister_name19'))){
               
               $sName = $this->input->post('sister_name19');
               }elseif(!empty($this->input->post('sister_name20'))){
               
               $sName = $this->input->post('sister_name20');
               }elseif(!empty($this->input->post('sister_name21'))){
               
               $sName = $this->input->post('sister_name21');
               }elseif(!empty($this->input->post('sister_name22'))){
               
               $sName = $this->input->post('sister_name22');

               }elseif(!empty($this->input->post('sister_name23'))){
                   
                   $sName = $this->input->post('sister_name23');

                    }elseif(!empty($this->input->post('sister_name24'))){
                   
                   $sName = $this->input->post('sister_name24');
                 
                }else{
                     $sName = '';
                }
            

if(!empty($this->input->post('married_status_sis1')))
               {
                $sMrg = $this->input->post('married_status_sis1');
               }elseif(!empty($this->input->post('married_status_sis2'))){
               
               $sMrg = $this->input->post('married_status_sis2');
            
               }elseif(!empty($this->input->post('married_status_sis3'))){
               
               $sMrg = $this->input->post('married_status_sis3');
               }elseif(!empty($this->input->post('married_status_sis4'))){
               
               $sMrg = $this->input->post('married_status_sis4');
               }elseif(!empty($this->input->post('married_status_sis5'))){
               
               $sMrg = $this->input->post('married_status_sis5');

               }elseif(!empty($this->input->post('married_status_sis6'))){
               
               $sMrg = $this->input->post('married_status_sis6');
               }elseif(!empty($this->input->post('married_status_sis7'))){
               
               $sMrg = $this->input->post('married_status_sis7');
               }elseif(!empty($this->input->post('married_status_sis8'))){
               
               $sMrg = $this->input->post('married_status_sis8');
               }elseif(!empty($this->input->post('married_status_sis9'))){
               
               $sMrg = $this->input->post('married_status_sis9');
               }elseif(!empty($this->input->post('married_status_sis10'))){
               
               $sMrg = $this->input->post('married_status_sis10');
               }elseif(!empty($this->input->post('married_status_sis11'))){
               
               $sName = $this->input->post('married_status_sis11');
               }elseif(!empty($this->input->post('married_status_sis12'))){
               
               $sMrg = $this->input->post('married_status_sis12');
               }elseif(!empty($this->input->post('married_status_sis13'))){
               
               $sMrg = $this->input->post('married_status_sis13');
               }elseif(!empty($this->input->post('married_status_sis14'))){
               
               $sMrg = $this->input->post('married_status_sis14');
              
               }elseif(!empty($this->input->post('married_status_sis14'))){
               
               $sMrg = $this->input->post('married_status_sis15');
               }elseif(!empty($this->input->post('married_status_sis15'))){
               
               $sMrg = $this->input->post('married_status_sis16');
               }elseif(!empty($this->input->post('married_status_sis16'))){
               
               $sMrg = $this->input->post('married_status_sis17');
               }elseif(!empty($this->input->post('married_status_sis17'))){
               
               $sMrg = $this->input->post('married_status_sis18');
               }elseif(!empty($this->input->post('married_status_sis19'))){
               
               $sMrg = $this->input->post('married_status_sis19');
               }elseif(!empty($this->input->post('married_status_sis20'))){
               
               $sMrg = $this->input->post('married_status_sis20');
               }elseif(!empty($this->input->post('married_status_sis21'))){
               
               $sMrg = $this->input->post('married_status_sis21');
               }elseif(!empty($this->input->post('married_status_sis22'))){
               
               $sMrg = $this->input->post('married_status_sis22');

               }elseif(!empty($this->input->post('married_status_sis23'))){
                   
                   $sMrg = $this->input->post('married_status_sis23');

                    }elseif(!empty($this->input->post('married_status_sis24'))){
                   
                   $sMrg = $this->input->post('married_status_sis24');
                 
                }else{
                     $sMrg = '';
                }

              if(!empty($this->input->post('bro_department1')))
               {
                $bDept = $this->input->post('bro_department1');
               }elseif(!empty($this->input->post('bro_department2'))){
               
               $bDept = $this->input->post('bro_department2');
            
               }elseif(!empty($this->input->post('bro_department3'))){
               
               $bDept = $this->input->post('bro_department3');
               }elseif(!empty($this->input->post('bro_department4'))){
               
               $bDept = $this->input->post('bro_department4');
               }elseif(!empty($this->input->post('bro_department5'))){
               
               $bDept = $this->input->post('bro_department5');

               }elseif(!empty($this->input->post('bro_department6'))){
               
               $bDept = $this->input->post('bro_department6');
               }elseif(!empty($this->input->post('bro_department7'))){
               
               $bDept = $this->input->post('bro_department7');
               }elseif(!empty($this->input->post('bro_department8'))){
               
               $bDept = $this->input->post('bro_department8');
               }elseif(!empty($this->input->post('bro_department9'))){
               
               $bDept = $this->input->post('bro_department9');
               }elseif(!empty($this->input->post('bro_department10'))){
               
               $bDept = $this->input->post('bro_department10');
               }elseif(!empty($this->input->post('bro_department11'))){
               
               $bDept = $this->input->post('bro_department11');
               }elseif(!empty($this->input->post('bro_department12'))){
               
               $bDept = $this->input->post('bro_department12');
               
                }else{
                     $bDept = '';
                }


if(!empty($this->input->post('sis_department1')))
               {
                $sDept = $this->input->post('sis_department1');
               }elseif(!empty($this->input->post('sis_department2'))){
               
               $sDept = $this->input->post('sis_department2');
            
               }elseif(!empty($this->input->post('sis_department3'))){
               
               $sDept = $this->input->post('sis_department3');
               }elseif(!empty($this->input->post('sis_department4'))){
               
               $sDept = $this->input->post('sis_department4');
               }elseif(!empty($this->input->post('sis_department5'))){
               
               $sDept = $this->input->post('sis_department5');

               }elseif(!empty($this->input->post('sis_department6'))){
               
               $sDept = $this->input->post('sis_department6');
               }elseif(!empty($this->input->post('sis_department7'))){
               
               $sDept = $this->input->post('sis_department7');
               }elseif(!empty($this->input->post('sis_department8'))){
               
               $sDept = $this->input->post('sis_department8');
               }elseif(!empty($this->input->post('sis_department9'))){
               
               $sDept = $this->input->post('sis_department9');
               }elseif(!empty($this->input->post('sis_department10'))){
               
               $sDept = $this->input->post('sis_department10');
               }elseif(!empty($this->input->post('sis_department11'))){
               
               $sDept = $this->input->post('sis_department11');
               }elseif(!empty($this->input->post('sis_department12'))){
               
               $sDept = $this->input->post('sis_department12');
               
                }else{
                     $sDept = '';
                }
                
               if(!empty($this->input->post('gfather_age1')))
               {
                $gfAge = $this->input->post('gfather_age1');
               }elseif(!empty($this->input->post('gfather_age2'))){
               
               $gfAge = $this->input->post('gfather_age2');
            
               }elseif(!empty($this->input->post('gfather_age3'))){
               
               $gfAge = $this->input->post('gfather_age3');
               }elseif(!empty($this->input->post('gfather_age4'))){
               
               $gfAge = $this->input->post('gfather_age4');
               }elseif(!empty($this->input->post('gfather_age5'))){
               
               $gfAge = $this->input->post('gfather_age5');
               
                }else{
                     $gfAge = '';
                }

 if(!empty($this->input->post('u_mobile1')))
               {
                $uMobile = $this->input->post('u_mobile1');
               }elseif(!empty($this->input->post('u_mobile2'))){
               
               $uMobile = $this->input->post('u_mobile2');
            
               }elseif(!empty($this->input->post('u_mobile3'))){
               
               $uMobile = $this->input->post('u_mobile3');
               }elseif(!empty($this->input->post('u_mobile4'))){
               
               $uMobile = $this->input->post('u_mobile4');
               }elseif(!empty($this->input->post('u_mobile5'))){
               
               $uMobile = $this->input->post('u_mobile5');
               
                }else{
                     $uMobile = '';
                }

             

                if(!empty($this->input->post('nm_conditions1')))
               {
                $niCond = $this->input->post('nm_conditions1');
               }elseif(!empty($this->input->post('nm_conditions2'))){
               
               $niCond = $this->input->post('nm_conditions2');
            
               }elseif(!empty($this->input->post('nm_conditions3'))){
               
               $niCond = $this->input->post('nm_conditions3');
               }elseif(!empty($this->input->post('nm_conditions4'))){
               
               $niCond = $this->input->post('nm_conditions4');
               }elseif(!empty($this->input->post('nm_conditions5'))){
               
               $niCond = $this->input->post('nm_conditions5');
               
                }else{
                     $niCond = '';
                }

                
                 if(!empty($this->input->post('g_conditions1')))
               {
                $gCond = $this->input->post('g_conditions1');
               }elseif(!empty($this->input->post('g_conditions2'))){
               
               $gCond = $this->input->post('g_conditions2');
            
               }elseif(!empty($this->input->post('g_conditions3'))){
               
               $gCond = $this->input->post('g_conditions3');
               }elseif(!empty($this->input->post('g_conditions4'))){
               
               $gCond = $this->input->post('g_conditions4');
               }elseif(!empty($this->input->post('g_conditions5'))){
               
               $gCond = $this->input->post('g_conditions5');
               
                }else{
                     $gCond = '';
                }

                  if(!empty($this->input->post('gm_conditions1')))
               {
                $gmCond = $this->input->post('gm_conditions1');
               }elseif(!empty($this->input->post('gm_conditions2'))){
               
               $gmCond = $this->input->post('gm_conditions2');
            
               }elseif(!empty($this->input->post('gm_conditions3'))){
               
               $gmCond = $this->input->post('gm_conditions3');
               }elseif(!empty($this->input->post('gm_conditions4'))){
               
               $gmCond = $this->input->post('gm_conditions4');
               }elseif(!empty($this->input->post('gm_conditions5'))){
               
               $gmCond = $this->input->post('gm_conditions5');
               
                }else{
                     $gmCond = '';
                }

                if(!empty($this->input->post('nm_conditions6'))){
               
               $naCond = $this->input->post('nm_conditions6');
               }elseif(!empty($this->input->post('nm_conditions7'))){
               
               $naCond = $this->input->post('nm_conditions7');
               }elseif(!empty($this->input->post('nm_conditions8'))){
               
               $naCond = $this->input->post('nm_conditions8');
               }elseif(!empty($this->input->post('nm_conditions9'))){
               
               $naCond = $this->input->post('nm_conditions6');
               }elseif(!empty($this->input->post('nm_conditions10'))){
               
               $naCond = $this->input->post('nm_conditions10');
               
                }else{
                     $naCond = '';
                }

                if(!empty($this->input->post('married_status_b1')))
               {
                $bMrg = $this->input->post('married_status_b1');
               }elseif(!empty($this->input->post('married_status_b2'))){
               
               $bMrg = $this->input->post('married_status_b2');
            
               }elseif(!empty($this->input->post('married_status_b3'))){
               
               $bMrg = $this->input->post('married_status_b3');
               }elseif(!empty($this->input->post('married_status_b4'))){
               
               $bMrg = $this->input->post('married_status_b4');
               }elseif(!empty($this->input->post('married_status_b5'))){
               
               $bMrg = $this->input->post('married_status_b5');

               }elseif(!empty($this->input->post('married_status_b6'))){
               
               $bMrg = $this->input->post('married_status_b6');
               }elseif(!empty($this->input->post('married_status_b7'))){
               
               $bMrg = $this->input->post('married_status_b7');
               }elseif(!empty($this->input->post('married_status_b8'))){
               
               $bMrg = $this->input->post('married_status_b8');
               }elseif(!empty($this->input->post('married_status_b9'))){
               
               $bMrg = $this->input->post('married_status_b9');
               }elseif(!empty($this->input->post('married_status_b10'))){
               
               $bMrg = $this->input->post('married_status_b10');
               }elseif(!empty($this->input->post('married_status_b11'))){
               
               $bMrg = $this->input->post('married_status_b11');
               }elseif(!empty($this->input->post('married_status_b12'))){
               
               $bMrg = $this->input->post('married_status_b12');
                }elseif(!empty($this->input->post('married_status_b13'))){
               
               $bMrg = $this->input->post('married_status_b13');
                }elseif(!empty($this->input->post('married_status_b14'))){
               
               $bMrg = $this->input->post('married_status_b14');
                }elseif(!empty($this->input->post('married_status_b15'))){
               
               $bMrg = $this->input->post('married_status_b15');
                }else{
                     $bMrg = '';
                }

 if(!empty($this->input->post('bro_post1')))
               {
                $bPost = $this->input->post('bro_post1');
               }elseif(!empty($this->input->post('bro_post2'))){
               
               $bPost = $this->input->post('bro_post2');
            
               }elseif(!empty($this->input->post('bro_post3'))){
               
               $bPost = $this->input->post('bro_post3');
               }elseif(!empty($this->input->post('bro_post4'))){
               
               $bPost = $this->input->post('bro_post4');
               }elseif(!empty($this->input->post('bro_post5'))){
               
               $bPost = $this->input->post('bro_post5');

               }elseif(!empty($this->input->post('bro_post6'))){
               
               $bPost = $this->input->post('bro_post6');
               }elseif(!empty($this->input->post('bro_post7'))){
               
               $bPost = $this->input->post('bro_post7');
               }elseif(!empty($this->input->post('bro_post8'))){
               
               $bPost = $this->input->post('bro_post8');
               }elseif(!empty($this->input->post('bro_post9'))){
               
               $bPost = $this->input->post('bro_post9');
               }elseif(!empty($this->input->post('bro_post10'))){
               
               $bPost = $this->input->post('bro_post10');
               }elseif(!empty($this->input->post('bro_post11'))){
               
               $bPost = $this->input->post('bro_post11');
               }elseif(!empty($this->input->post('bro_post12'))){
               
               $bPost = $this->input->post('bro_post12');
                }elseif(!empty($this->input->post('bro_post13'))){
               
               $bPost = $this->input->post('bro_post13');
                }elseif(!empty($this->input->post('bro_post14'))){
               
               $bPost = $this->input->post('bro_post14');
                }elseif(!empty($this->input->post('bro_post15'))){
               
               $bPost = $this->input->post('bro_post15');
                }else{
                     $bPost = '';
                }


if(!empty($this->input->post('bro_Working_place1')))
               {
                $bPlace = $this->input->post('bro_Working_place1');
               }elseif(!empty($this->input->post('bro_Working_place2'))){
               
               $bPlace = $this->input->post('bro_Working_place2');
            
               }elseif(!empty($this->input->post('bro_Working_place3'))){
               
               $bPlace = $this->input->post('bro_Working_place3');
               }elseif(!empty($this->input->post('bro_Working_place4'))){
               
               $bPlace = $this->input->post('bro_Working_place4');
               }elseif(!empty($this->input->post('bro_Working_place5'))){
               
               $bPlace = $this->input->post('bro_Working_place5');

               }elseif(!empty($this->input->post('bro_Working_place6'))){
               
               $bPlace = $this->input->post('bro_Working_place6');
               }elseif(!empty($this->input->post('bro_Working_place7'))){
               
               $bPlace = $this->input->post('bro_Working_place7');
               }elseif(!empty($this->input->post('bro_Working_place8'))){
               
               $bPlace = $this->input->post('bro_Working_place8');
               }elseif(!empty($this->input->post('bro_Working_place9'))){
               
               $bPlace = $this->input->post('bro_Working_place9');
               }elseif(!empty($this->input->post('bro_Working_place10'))){
               
               $bPlace = $this->input->post('bro_Working_place10');
               }elseif(!empty($this->input->post('bro_Working_place11'))){
               
               $bPlace = $this->input->post('bro_Working_place11');
               }elseif(!empty($this->input->post('bro_Working_place12'))){
               
               $bPlace = $this->input->post('bro_Working_place12');
                }elseif(!empty($this->input->post('bro_Working_place13'))){
               
               $bPlace = $this->input->post('bro_Working_place13');
                }elseif(!empty($this->input->post('bro_Working_place14'))){
               
               $bPlace = $this->input->post('bro_Working_place14');
                }elseif(!empty($this->input->post('bro_Working_place15'))){
               
               $bPlace = $this->input->post('bro_Working_place15');
           }elseif(!empty($this->input->post('bro_Working_place16'))){
               
               $bPlace = $this->input->post('bro_Working_place16');
                }else{
                     $bPlace = '';
                }

                
                if(!empty($this->input->post('monthly_salary_bro1')))
               {
                $bSalary = $this->input->post('monthly_salary_bro1');
               }elseif(!empty($this->input->post('monthly_salary_bro2'))){
               
               $bSalary = $this->input->post('monthly_salary_bro2');
            
               }elseif(!empty($this->input->post('monthly_salary_bro3'))){
               
               $bSalary = $this->input->post('monthly_salary_bro3');
               }elseif(!empty($this->input->post('monthly_salary_bro4'))){
               
               $bSalary = $this->input->post('monthly_salary_bro4');
               }elseif(!empty($this->input->post('monthly_salary_bro5'))){
               
               $bSalary = $this->input->post('monthly_salary_bro5');

               }elseif(!empty($this->input->post('monthly_salary_bro6'))){
               
               $bSalary = $this->input->post('monthly_salary_bro6');
               }elseif(!empty($this->input->post('monthly_salary_bro7'))){
               
               $bSalary = $this->input->post('monthly_salary_bro7');
               }elseif(!empty($this->input->post('monthly_salary_bro8'))){
               
               $bSalary = $this->input->post('monthly_salary_bro8');
               }elseif(!empty($this->input->post('monthly_salary_bro9'))){
               
               $bSalary = $this->input->post('monthly_salary_bro9');
               }elseif(!empty($this->input->post('monthly_salary_bro10'))){
               
               $bSalary = $this->input->post('monthly_salary_bro10');
               }elseif(!empty($this->input->post('monthly_salary_bro11'))){
               
               $bSalary = $this->input->post('monthly_salary_bro11');
               }elseif(!empty($this->input->post('monthly_salary_bro12'))){
               
               $bSalary = $this->input->post('monthly_salary_bro12');
                }elseif(!empty($this->input->post('monthly_salary_bro13'))){
               
               $bSalary = $this->input->post('monthly_salary_bro13');
                }elseif(!empty($this->input->post('monthly_salary_bro14'))){
               
               $bSalary = $this->input->post('monthly_salary_bro14');
                }elseif(!empty($this->input->post('monthly_salary_bro15'))){
               
               $bSalary = $this->input->post('monthly_salary_bro15');
           }elseif(!empty($this->input->post('monthly_salary_bro16'))){
               
               $bSalary = $this->input->post('monthly_salary_bro16');
               }elseif(!empty($this->input->post('monthly_salary_bro17'))){
               
               $bSalary = $this->input->post('monthly_salary_bro17');
               }elseif(!empty($this->input->post('monthly_salary_bro18'))){
               
               $bSalary = $this->input->post('monthly_salary_bro18');
               }elseif(!empty($this->input->post('monthly_salary_bro19'))){
               
               $bSalary = $this->input->post('monthly_salary_bro19');
               }elseif(!empty($this->input->post('monthly_salary_bro20'))){
               
               $bSalary = $this->input->post('monthly_salary_bro20');
                }else{
                     $bSalary = '';
                }

                
                 if(!empty($this->input->post('yearly_salary_bro1')))
               {
                $bSalaryY = $this->input->post('yearly_salary_bro1');
               }elseif(!empty($this->input->post('yearly_salary_bro2'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro2');
            
               }elseif(!empty($this->input->post('yearly_salary_bro3'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro3');
               }elseif(!empty($this->input->post('yearly_salary_bro4'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro4');
               }elseif(!empty($this->input->post('yearly_salary_bro5'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro5');

               }elseif(!empty($this->input->post('yearly_salary_bro6'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro6');
               }elseif(!empty($this->input->post('yearly_salary_bro7'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro7');
               }elseif(!empty($this->input->post('yearly_salary_bro8'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro8');
               }elseif(!empty($this->input->post('yearly_salary_bro9'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro9');
               }elseif(!empty($this->input->post('yearly_salary_bro10'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro10');
               }elseif(!empty($this->input->post('yearly_salary_bro11'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro11');
               }elseif(!empty($this->input->post('yearly_salary_bro12'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro12');
                }elseif(!empty($this->input->post('yearly_salary_bro13'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro13');
                }elseif(!empty($this->input->post('yearly_salary_bro14'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro14');
                }elseif(!empty($this->input->post('yearly_salary_bro15'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro15');
           }elseif(!empty($this->input->post('yearly_salary_bro16'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro16');
               }elseif(!empty($this->input->post('yearly_salary_bro17'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro17');
               }elseif(!empty($this->input->post('yearly_salary_bro18'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro18');
               }elseif(!empty($this->input->post('yearly_salary_bro19'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro19');
               }elseif(!empty($this->input->post('yearly_salary_bro20'))){
               
               $bSalaryY = $this->input->post('yearly_salary_bro20');
                }else{
                     $bSalaryY = '';
                }

        if(!empty($this->input->post('son_name'))) {
        $girl='';  $son=''; $sonData=''; $girlData='';
        $sonsName = $this->input->post('son_name');
        $sonsAge = $this->input->post('son_age');
        $sonsClass = $this->input->post('son_class');
        $sonsFollowing = $this->input->post('sons_following');
        $result = [];
        for($i=0; $i<count($sonsName); $i++){
            for($j=$i; $j<count($sonsAge); $j++){
                $sdetail['Son_name'] = $sonsName[$i];
                $sdetail['Son_age'] = $sonsAge[$j];
                $sdetail['Son_class'] = $sonsClass[$j];
                $sdetail['Son_following'] = $sonsFollowing[$j];
                $result[] = $sdetail;
                break;
            }
        }
         $data['son_detail'] = serialize($result);
     }
        
        if(!empty($this->input->post('daughter_name'))) {
        $girlName = $this->input->post('daughter_name');
        $girlAge = $this->input->post('daughter_age');
        $girlClass = $this->input->post('daughter_class');
        $girlFollowing = $this->input->post('daught_following');
         $gresult = [];
        for($i=0; $i<count($girlName); $i++){
            for($j=$i; $j<count($girlAge); $j++){
                $gdetail['Girl_name'] = $girlName[$i];
                $gdetail['Girl_age'] = $girlAge[$j];
                $gdetail['Girl_class'] = $girlClass[$j];
                $gdetail['Girl_following'] = $girlFollowing[$j];
                $gresult[] = $gdetail;
                break;
            }
        }
          $data['daughter_detail'] = serialize($gresult);
      }
       
       
 // echo '<pre>';
 //        print_r($data);
 //        die;

        extract($_POST);
        unset($_POST['daughter_name']);
        unset($_POST['daughter_age']);
        unset($_POST['daughter_class']);
        unset($_POST['daught_following']);
        unset($_POST['son_name']);
        unset($_POST['son_age']);
        unset($_POST['son_class']);
        unset($_POST['sons_following']);
        unset($_POST['mother_Working_place1']);
        unset($_POST['mother_Working_place2']);
        unset($_POST['mother_Working_place3']);
        unset($_POST['brother_name1']);
        unset($_POST['brother_name2']);
        unset($_POST['brother_name3']);
        unset($_POST['brother_name4']);
        unset($_POST['brother_name5']);
        unset($_POST['brother_name6']);
        unset($_POST['brother_name7']);
        unset($_POST['brother_name8']);
        unset($_POST['brother_name9']);
        unset($_POST['brother_name10']);
        unset($_POST['brother_name11']);
        unset($_POST['brother_name12']);
        unset($_POST['brother_name13']);
        unset($_POST['brother_name14']);
        unset($_POST['brother_name15']);
        unset($_POST['brother_name16']);
        unset($_POST['brother_name17']);
        unset($_POST['brother_name18']);
        unset($_POST['brother_name19']);
        unset($_POST['brother_name20']);
        unset($_POST['brother_name21']);
        unset($_POST['brother_name22']);
        unset($_POST['brother_name23']);
        unset($_POST['gmoth_age1']);
        unset($_POST['gmoth_age2']);
        unset($_POST['gmoth_age3']);
        unset($_POST['gmoth_age4']);
        unset($_POST['gmoth_age5']);
        unset($_POST['gfather_age1']);
        unset($_POST['gfather_age2']);
        unset($_POST['gfather_age3']);
        unset($_POST['gfather_age4']);
        unset($_POST['gfather_age5']);
        unset($_POST['gfather_name2']);
        unset($_POST['gfather_name3']);
        unset($_POST['gfather_name4']);
        unset($_POST['gfather_name5']);
        unset($_POST['gfather_name6']);
        unset($_POST['gfather_post1']);
        unset($_POST['gfather_post2']);
        unset($_POST['g_mobile1']);
        unset($_POST['g_mobile2']);
        unset($_POST['g_mobile3']);
        unset($_POST['g_mobile4']);
        unset($_POST['g_mobile5']);
        unset($_POST['gmoth_name1']);
        unset($_POST['gmoth_name2']);
        unset($_POST['gmoth_name3']);
        unset($_POST['gmoth_name4']);
        unset($_POST['gmoth_name5']);
        unset($_POST['gmoth_age1']);
        unset($_POST['gmoth_age2']);
        unset($_POST['gmoth_age3']);
        unset($_POST['gmoth_age4']);
        unset($_POST['nm_name1']);
        unset($_POST['nm_name2']);
        unset($_POST['nm_name3']);
        unset($_POST['nm_name4']);
        unset($_POST['nm_name5']);
        unset($_POST['nm_name6']);
        unset($_POST['nm_age1']);
        unset($_POST['nm_age2']);
        unset($_POST['nm_age3']);
        unset($_POST['nm_age4']);
        unset($_POST['nm_age5']);
        unset($_POST['nm_age6']);
        unset($_POST['mgm_department1']);
        unset($_POST['mgm_department2']);
        unset($_POST['mgm_department3']);
        unset($_POST['gm_department1']);
        unset($_POST['gm_department2']);
        unset($_POST['gm_department3']);
        unset($_POST['mgm_post1']);
        unset($_POST['mgm_post2']);
        unset($_POST['mgm_post3']);
        unset($_POST['gm_post1']);
        unset($_POST['gm_post2']);
        unset($_POST['gm_post3']);
        unset($_POST['mgm_Working_place1']);
        unset($_POST['mgm_Working_place2']);
        unset($_POST['mgm_Working_place3']);
        unset($_POST['gm_Working_place1']);
        unset($_POST['gm_Working_place2']);
        unset($_POST['gm_Working_place3']);
        unset($_POST['mother_name1']);
        unset($_POST['mother_name2']);
        unset($_POST['mother_name3']);
        unset($_POST['mother_name4']);
        unset($_POST['mother_name5']);
        unset($_POST['mother_name6']);
        unset($_POST['mother_post1']);
        unset($_POST['mother_post2']);
        unset($_POST['mother_age1']);
        unset($_POST['mother_age2']);
        unset($_POST['mother_age3']);
        unset($_POST['mother_age4']);
        unset($_POST['mother_age5']);
        unset($_POST['mother_department1']);
        unset($_POST['mother_department2']);
        unset($_POST['mother_department3']);
        unset($_POST['monthly_salary_m1']);
        unset($_POST['monthly_salary_m2']);
        unset($_POST['monthly_salary_m3']);
        unset($_POST['monthly_salary_m4']);
        unset($_POST['yearly_salary_m1']);
        unset($_POST['yearly_salary_m2']);
        unset($_POST['yearly_salary_m3']);
        unset($_POST['yearly_salary_m4']);
        unset($_POST['m_mobile1']);
        unset($_POST['m_mobile2']);
        unset($_POST['m_mobile3']);
        unset($_POST['m_mobile4']);
        unset($_POST['m_mobile5']);
        unset($_POST['m_conditions1']);
        unset($_POST['m_conditions2']);
        unset($_POST['m_conditions3']);
        unset($_POST['m_conditions4']);
        unset($_POST['m_conditions5']);
        unset($_POST['b_mobile1']);
        unset($_POST['b_mobile2']);
        unset($_POST['b_mobile3']);
        unset($_POST['b_mobile4']);
        unset($_POST['b_mobile5']);
        unset($_POST['b_mobile6']);
        unset($_POST['b_mobile7']);
        unset($_POST['b_mobile8']);
        unset($_POST['b_mobile9']);
        unset($_POST['b_mobile10']);
        unset($_POST['b_mobile11']);
        unset($_POST['b_mobile12']);
        unset($_POST['b_mobile13']);
        unset($_POST['b_mobile14']);
        unset($_POST['b_mobile15']);
        unset($_POST['b_mobile16']);
        unset($_POST['b_mobile17']);
        unset($_POST['b_mobile18']);
        unset($_POST['b_mobile19']);
        unset($_POST['b_mobile20']);
        unset($_POST['b_mobile21']);
        unset($_POST['b_mobile22']);
        unset($_POST['b_mobile23']);
        unset($_POST['b_mobile24']);
        unset($_POST['b_mobile25']);
        unset($_POST['sis_mobile1']);
        unset($_POST['sis_mobile2']);
        unset($_POST['sis_mobile3']);
        unset($_POST['sis_mobile4']);
        unset($_POST['sis_mobile5']);
        unset($_POST['sis_mobile6']);
        unset($_POST['sis_mobile7']);
        unset($_POST['sis_mobile8']);
        unset($_POST['sis_mobile9']);
        unset($_POST['sis_mobile10']);
        unset($_POST['sis_mobile11']);
        unset($_POST['sis_mobile12']);
        unset($_POST['sis_mobile13']);
        unset($_POST['sis_mobile14']);
        unset($_POST['sis_mobile15']);
        unset($_POST['sis_mobile16']);
        unset($_POST['sis_mobile17']);
        unset($_POST['sis_mobile18']);
        unset($_POST['sis_mobile19']);
        unset($_POST['sis_mobile20']);
        unset($_POST['sis_mobile21']);
        unset($_POST['sis_mobile22']);
        unset($_POST['sis_mobile23']);
        unset($_POST['sis_mobile24']);
        unset($_POST['brother_age1']);
        unset($_POST['brother_age2']);
        unset($_POST['brother_age3']);
        unset($_POST['brother_age4']);
        unset($_POST['brother_age5']);
        unset($_POST['brother_age6']);
        unset($_POST['brother_age7']);
        unset($_POST['brother_age8']);
        unset($_POST['brother_age9']);
        unset($_POST['brother_age10']);
        unset($_POST['brother_age11']);
        unset($_POST['brother_age12']);
        unset($_POST['brother_age13']);
        unset($_POST['brother_age14']);
        unset($_POST['brother_age15']);
        unset($_POST['brother_age16']);
        unset($_POST['brother_age17']);
        unset($_POST['brother_age18']);
        unset($_POST['brother_age19']);
        unset($_POST['brother_age20']);
        unset($_POST['brother_age21']);
        unset($_POST['brother_age22']);
        unset($_POST['brother_age23']);
        unset($_POST['brother_age24']);
        unset($_POST['bro_department1']);
        unset($_POST['bro_department2']);
        unset($_POST['bro_department3']);
        unset($_POST['bro_department4']);
        unset($_POST['bro_department5']);
        unset($_POST['bro_department6']);
        unset($_POST['bro_department7']);
        unset($_POST['bro_department8']);
        unset($_POST['bro_department9']);
        unset($_POST['bro_department10']);
        unset($_POST['bro_department11']);
        unset($_POST['bro_department12']);
        unset($_POST['married_status_b1']);
        unset($_POST['married_status_b2']);
        unset($_POST['married_status_b3']);
        unset($_POST['married_status_b4']);
        unset($_POST['married_status_b5']);
        unset($_POST['married_status_b6']);
        unset($_POST['married_status_b7']);
        unset($_POST['married_status_b8']);
        unset($_POST['married_status_b9']);
        unset($_POST['married_status_b10']);
        unset($_POST['married_status_b11']);
        unset($_POST['married_status_b12']);
        unset($_POST['married_status_b13']);
        unset($_POST['married_status_b14']);
        unset($_POST['married_status_b15']);
        unset($_POST['bro_post1']);
        unset($_POST['bro_post2']);
        unset($_POST['bro_post3']);
        unset($_POST['bro_post4']);
        unset($_POST['bro_post5']);
        unset($_POST['bro_post6']);
        unset($_POST['bro_post7']);
        unset($_POST['bro_post8']);
        unset($_POST['bro_post9']);
        unset($_POST['bro_post10']);
        unset($_POST['bro_post11']);
        unset($_POST['bro_post12']);
        unset($_POST['bro_post13']);
        unset($_POST['bro_post14']);
        unset($_POST['bro_post15']);
        unset($_POST['bro_Working_place1']);
        unset($_POST['bro_Working_place2']);
        unset($_POST['bro_Working_place3']);
        unset($_POST['bro_Working_place4']);
        unset($_POST['bro_Working_place5']);
        unset($_POST['bro_Working_place6']);
        unset($_POST['bro_Working_place7']);
        unset($_POST['bro_Working_place8']);
        unset($_POST['bro_Working_place9']);
        unset($_POST['bro_Working_place10']);
        unset($_POST['bro_Working_place11']);
        unset($_POST['bro_Working_place12']);
        unset($_POST['bro_Working_place13']);
        unset($_POST['bro_Working_place14']);
        unset($_POST['bro_Working_place15']);
        unset($_POST['bro_Working_place16']);
        unset($_POST['monthly_salary_bro1']);
        unset($_POST['monthly_salary_bro2']);
        unset($_POST['monthly_salary_bro3']);
        unset($_POST['monthly_salary_bro4']);
        unset($_POST['monthly_salary_bro5']);
        unset($_POST['monthly_salary_bro6']);
        unset($_POST['monthly_salary_bro7']);
        unset($_POST['monthly_salary_bro8']);
        unset($_POST['monthly_salary_bro9']);
        unset($_POST['monthly_salary_bro10']);
        unset($_POST['monthly_salary_bro11']);
        unset($_POST['monthly_salary_bro12']);
        unset($_POST['monthly_salary_bro13']);
        unset($_POST['monthly_salary_bro14']);
        unset($_POST['monthly_salary_bro15']);
        unset($_POST['monthly_salary_bro16']);
        unset($_POST['monthly_salary_bro17']);
        unset($_POST['monthly_salary_bro18']);
        unset($_POST['monthly_salary_bro19']);
        unset($_POST['monthly_salary_bro20']);
        unset($_POST['yearly_salary_bro1']);
        unset($_POST['yearly_salary_bro2']);
        unset($_POST['yearly_salary_bro3']);
        unset($_POST['yearly_salary_bro4']);
        unset($_POST['yearly_salary_bro5']);
        unset($_POST['yearly_salary_bro6']);
        unset($_POST['yearly_salary_bro7']);
        unset($_POST['yearly_salary_bro8']);
        unset($_POST['yearly_salary_bro9']);
        unset($_POST['yearly_salary_bro10']);
        unset($_POST['yearly_salary_bro11']);
        unset($_POST['yearly_salary_bro12']);
        unset($_POST['yearly_salary_bro13']);
        unset($_POST['yearly_salary_bro14']);
        unset($_POST['yearly_salary_bro15']);
        unset($_POST['yearly_salary_bro16']);
        unset($_POST['yearly_salary_bro17']);
        unset($_POST['yearly_salary_bro18']);
        unset($_POST['yearly_salary_bro19']);
        unset($_POST['yearly_salary_bro20']);
        unset($_POST['father_name1']);
        unset($_POST['father_name2']);
        unset($_POST['father_name3']);
        unset($_POST['father_name4']);
        unset($_POST['father_name5']);
        unset($_POST['father_name6']);
        unset($_POST['father_name7']);
        unset($_POST['father_age1']);
        unset($_POST['father_age2']);
        unset($_POST['father_age3']);
        unset($_POST['father_age4']);
        unset($_POST['father_age5']);
        unset($_POST['father_department1']);
        unset($_POST['father_department2']);
        unset($_POST['father_department3']);
        unset($_POST['father_post1']);
        unset($_POST['father_post2']);
        unset($_POST['father_Working_place1']);
        unset($_POST['father_Working_place2']);
        unset($_POST['father_Working_place3']);
        unset($_POST['monthly_salary1']);
        unset($_POST['monthly_salary2']);
        unset($_POST['monthly_salary3']);
        unset($_POST['monthly_salary4']);
        unset($_POST['yearly_salary1']);
        unset($_POST['yearly_salary2']);
        unset($_POST['yearly_salary3']);
        unset($_POST['yearly_salary4']);
        unset($_POST['f_mobile1']);
        unset($_POST['f_mobile2']);
        unset($_POST['f_mobile3']);
        unset($_POST['f_mobile4']);
        unset($_POST['f_mobile5']);
        unset($_POST['conditions1']);
        unset($_POST['conditions2']);
        unset($_POST['conditions3']);
        unset($_POST['conditions4']);
        unset($_POST['conditions5']);
        unset($_POST['conditions_bro1']);
        unset($_POST['conditions_bro2']);
        unset($_POST['conditions_bro3']);
        unset($_POST['conditions_bro4']);
        unset($_POST['conditions_bro5']);
        unset($_POST['conditions_bro6']);
        unset($_POST['conditions_bro7']);
        unset($_POST['conditions_bro8']);
        unset($_POST['conditions_bro9']);
        unset($_POST['conditions_bro10']);
        unset($_POST['conditions_bro11']);
        unset($_POST['conditions_bro12']);
        unset($_POST['conditions_bro13']);
        unset($_POST['conditions_bro14']);
        unset($_POST['conditions_bro15']);
        unset($_POST['conditions_bro16']);
        unset($_POST['conditions_bro17']);
        unset($_POST['conditions_bro18']);
        unset($_POST['conditions_bro19']);
        unset($_POST['conditions_bro20']);
        unset($_POST['conditions_bro21']);
        unset($_POST['conditions_bro22']);
        unset($_POST['conditions_bro23']);
        unset($_POST['conditions_bro24']);
        unset($_POST['nm_conditions1']);
        unset($_POST['nm_conditions2']);
        unset($_POST['nm_conditions3']);
        unset($_POST['nm_conditions4']);
        unset($_POST['nm_conditions5']);
        unset($_POST['nm_conditions6']);
        unset($_POST['nm_conditions7']);
        unset($_POST['nm_conditions8']);
        unset($_POST['nm_conditions9']);
        unset($_POST['nm_conditions10']);
        unset($_POST['mgm_name1']);
        unset($_POST['mgm_name2']);
        unset($_POST['mgm_name3']);
        unset($_POST['mgm_name4']);
        unset($_POST['mgm_name5']);
        unset($_POST['mgm_name6']);
        unset($_POST['mgm_name7']);
        unset($_POST['mgm_age1']);
        unset($_POST['mgm_age2']);
        unset($_POST['mgm_age3']);
        unset($_POST['mgm_age4']);
        unset($_POST['mgm_age5']);
        unset($_POST['monthly_salary_mgm1']);
        unset($_POST['monthly_salary_mgm2']);
        unset($_POST['monthly_salary_mgm3']);
        unset($_POST['mgm_mobile1']);
        unset($_POST['mgm_mobile2']);
        unset($_POST['mgm_mobile3']);
        unset($_POST['mgm_mobile4']);
        unset($_POST['mgm_mobile5']);
         unset($_POST['gm_mobile1']);
        unset($_POST['gm_mobile2']);
        unset($_POST['gm_mobile3']);
        unset($_POST['gm_mobile4']);
        unset($_POST['gm_mobile5']);
        unset($_POST['monthly_salary_nm5']);
        unset($_POST['monthly_salary_nm4']);
        unset($_POST['monthly_salary_nm3']);
        unset($_POST['monthly_salary_nm2']);
        unset($_POST['monthly_salary_nm1']);
        unset($_POST['yearly_salary_nm1']);
        unset($_POST['yearly_salary_nm2']);
        unset($_POST['yearly_salary_nm3']);
        unset($_POST['yearly_salary_nm4']);
        unset($_POST['yearly_salary_nm5']);
        unset($_POST['nm_mobile1']);
        unset($_POST['nm_mobile2']);
        unset($_POST['nm_mobile3']);
        unset($_POST['nm_mobile4']);
        unset($_POST['nm_mobile5']);
        unset($_POST['monthly_salary_gm1']);
        unset($_POST['monthly_salary_gm2']);
        unset($_POST['monthly_salary_gm3']);
        unset($_POST['monthly_salary_gm4']);
         unset($_POST['monthly_salary_g1']);
        unset($_POST['monthly_salary_g2']);
        unset($_POST['monthly_salary_g3']);
        unset($_POST['monthly_salary_g4']);
        unset($_POST['yearly_salary_gm1']);
        unset($_POST['yearly_salary_gm2']);
        unset($_POST['yearly_salary_gm3']);
        unset($_POST['yearly_salary_gm4']);
         unset($_POST['yearly_salary_g1']);
        unset($_POST['yearly_salary_g2']);
        unset($_POST['yearly_salary_g3']);
        unset($_POST['yearly_salary_g4']);
        unset($_POST['gfather_department1']);
        unset($_POST['gfather_department2']);
        unset($_POST['gfather_department3']);
        unset($_POST['gfather_Working_place1']);
        unset($_POST['gfather_Working_place2']);
        unset($_POST['gfather_Working_place3']);
        unset($_POST['g_conditions1']);
        unset($_POST['g_conditions2']);
        unset($_POST['g_conditions3']);
        unset($_POST['g_conditions4']);
        unset($_POST['g_conditions5']);
        unset($_POST['sister_name1']);
        unset($_POST['sister_name2']);
        unset($_POST['sister_name3']);
        unset($_POST['sister_name4']);
        unset($_POST['sister_name5']);
        unset($_POST['sister_name6']);
        unset($_POST['sister_name7']);
        unset($_POST['sister_name8']);
        unset($_POST['sister_name9']);
        unset($_POST['sister_name10']);
        unset($_POST['sister_name11']);
        unset($_POST['sister_name12']);
        unset($_POST['sister_name13']);
        unset($_POST['sister_name14']);
        unset($_POST['sister_name15']);
        unset($_POST['sister_name16']);
        unset($_POST['sister_name17']);
        unset($_POST['sister_name18']);
        unset($_POST['sister_name19']);
        unset($_POST['sister_name20']);
        unset($_POST['sister_name21']);
        unset($_POST['sister_name22']);
        unset($_POST['sister_name23']);
        unset($_POST['sister_name24']);
        unset($_POST['sister_age1']);
        unset($_POST['sister_age2']);
        unset($_POST['sister_age3']);
        unset($_POST['sister_age4']);
        unset($_POST['sister_age5']);
        unset($_POST['sister_age6']);
        unset($_POST['sister_age7']);
        unset($_POST['sister_age8']);
        unset($_POST['sister_age9']);
        unset($_POST['sister_age10']);
        unset($_POST['sister_age11']);
        unset($_POST['sister_age12']);
        unset($_POST['sister_age13']);
        unset($_POST['sister_age14']);
        unset($_POST['sister_age15']);
        unset($_POST['sister_age16']);
        unset($_POST['sister_age17']);
        unset($_POST['sister_age18']);
        unset($_POST['sister_age19']);
        unset($_POST['sister_age20']);
        unset($_POST['sister_age21']);
        unset($_POST['sister_age22']);
        unset($_POST['sister_age23']);
        unset($_POST['sister_age24']);
        unset($_POST['married_status_sis1']);
        unset($_POST['married_status_sis2']);
        unset($_POST['married_status_sis3']);
        unset($_POST['married_status_sis4']);
        unset($_POST['married_status_sis5']);
        unset($_POST['married_status_sis6']);
        unset($_POST['married_status_sis7']);
        unset($_POST['married_status_sis8']);
        unset($_POST['married_status_sis9']);
        unset($_POST['married_status_sis10']);
        unset($_POST['married_status_sis11']);
        unset($_POST['married_status_sis12']);
        unset($_POST['married_status_sis13']);
        unset($_POST['married_status_sis14']);
        unset($_POST['married_status_sis']);
        unset($_POST['married_status_sis16']);
        unset($_POST['married_status_sis17']);
        unset($_POST['married_status_sis18']);
        unset($_POST['married_status_sis19']);
        unset($_POST['married_status_sis20']);
        unset($_POST['married_status_sis21']);
        unset($_POST['married_status_sis22']);
        unset($_POST['married_status_sis23']);
        unset($_POST['married_status_sis24']); 
        unset($_POST['sis_department1']);
        unset($_POST['sis_department2']);
        unset($_POST['sis_department3']);
        unset($_POST['sis_department4']);
        unset($_POST['sis_department5']);
        unset($_POST['sis_department6']);
        unset($_POST['sis_department7']);
        unset($_POST['sis_department8']);
        unset($_POST['sis_department9']);
        unset($_POST['sis_department10']);
        unset($_POST['sis_department11']);
        unset($_POST['sis_department12']);
         unset($_POST['married_status_sis1']);
        unset($_POST['married_status_sis2']);
        unset($_POST['married_status_sis3']);
        unset($_POST['married_status_sis4']);
        unset($_POST['married_status_sis5']);
        unset($_POST['married_status_sis6']);
        unset($_POST['married_status_sis7']);
        unset($_POST['married_status_sis8']);
        unset($_POST['married_status_sis9']);
        unset($_POST['married_status_sis10']);
        unset($_POST['married_status_sis11']);
        unset($_POST['married_status_sis12']);
        unset($_POST['married_status_sis13']);
        unset($_POST['married_status_sis14']);
        unset($_POST['married_status_sis15']);
        unset($_POST['married_status_sis16']);
        unset($_POST['married_status_sis17']);
        unset($_POST['married_status_sis18']);
        unset($_POST['married_status_sis19']);
        unset($_POST['married_status_sis20']);
        unset($_POST['yearly_salary_sis1']);
        unset($_POST['yearly_salary_sis2']);
        unset($_POST['yearly_salary_sis3']);
        unset($_POST['yearly_salary_sis4']);
        unset($_POST['yearly_salary_sis5']);
        unset($_POST['yearly_salary_sis6']);
        unset($_POST['yearly_salary_sis7']);
        unset($_POST['yearly_salary_sis8']);
        unset($_POST['yearly_salary_sis9']);
        unset($_POST['yearly_salary_sis10']);
        unset($_POST['yearly_salary_sis11']);
        unset($_POST['yearly_salary_sis12']);
        unset($_POST['yearly_salary_sis13']);
        unset($_POST['yearly_salary_sis14']);
        unset($_POST['yearly_salary_sis15']);
        unset($_POST['yearly_salary_sis16']);
        unset($_POST['yearly_salary_sis17']);
        unset($_POST['yearly_salary_sis18']);
        unset($_POST['yearly_salary_sis19']);
        unset($_POST['yearly_salary_sis20']);
        unset($_POST['monthly_salary_sis1']);
        unset($_POST['monthly_salary_sis2']);
        unset($_POST['monthly_salary_sis3']);
        unset($_POST['monthly_salary_sis4']);
        unset($_POST['monthly_salary_sis5']);
        unset($_POST['monthly_salary_sis6']);
        unset($_POST['monthly_salary_sis7']);
        unset($_POST['monthly_salary_sis8']);
        unset($_POST['monthly_salary_sis9']);
        unset($_POST['monthly_salary_sis10']);
        unset($_POST['monthly_salary_sis11']);
        unset($_POST['monthly_salary_sis12']);
        unset($_POST['monthly_salary_sis13']);
        unset($_POST['monthly_salary_sis14']);
        unset($_POST['monthly_salary_sis15']);
        unset($_POST['monthly_salary_sis16']);
        unset($_POST['monthly_salary_sis17']);
        unset($_POST['monthly_salary_sis18']);
        unset($_POST['monthly_salary_sis19']);
        unset($_POST['monthly_salary_sis20']);
        unset($_POST['sis_conditions1']);
        unset($_POST['sis_conditions2']);
        unset($_POST['sis_conditions3']);
        unset($_POST['sis_conditions4']);
        unset($_POST['sis_conditions5']);
        unset($_POST['sis_conditions6']);
        unset($_POST['sis_conditions7']);
        unset($_POST['sis_conditions8']);
        unset($_POST['sis_conditions9']);
        unset($_POST['sis_conditions10']);
        unset($_POST['sis_conditions11']);
        unset($_POST['sis_conditions12']);
        unset($_POST['sis_conditions13']);
        unset($_POST['sis_conditions14']);
        unset($_POST['sis_conditions15']);
        unset($_POST['sis_conditions16']);
        unset($_POST['sis_conditions17']);
        unset($_POST['sis_conditions18']);
        unset($_POST['sis_conditions19']);
        unset($_POST['sis_conditions20']);
        unset($_POST['sis_conditions21']);
        unset($_POST['sis_conditions22']);
        unset($_POST['sis_conditions23']);
        unset($_POST['sis_conditions24']);
        unset($_POST['sis_retired_job1']);
        unset($_POST['sis_retired_job2']);
        unset($_POST['sis_retired_job3']);
        unset($_POST['sis_retired_job4']);
         unset($_POST['bro_retired_job1']);
        unset($_POST['bro_retired_job2']);
        unset($_POST['bro_retired_job3']);
        unset($_POST['bro_retired_job4']);
        unset($_POST['sis_Working_place1']);
        unset($_POST['sis_Working_place2']);
        unset($_POST['sis_Working_place3']);
        unset($_POST['sis_Working_place4']);
        unset($_POST['sis_Working_place5']);
        unset($_POST['sis_Working_place6']);
        unset($_POST['sis_Working_place7']);
        unset($_POST['sis_Working_place8']);
        unset($_POST['sis_Working_place9']);
        unset($_POST['sis_Working_place10']);
        unset($_POST['sis_Working_place11']);
        unset($_POST['sis_Working_place12']);
        unset($_POST['sis_Working_place13']);
        unset($_POST['sis_Working_place14']);
        unset($_POST['sis_Working_place15']);
        unset($_POST['sis_Working_place16']);
        unset($_POST['learning_bro1']);
        unset($_POST['learning_bro2']);
        unset($_POST['learning_bro3']);
        unset($_POST['learning_bro4']);
        unset($_POST['learning_bro5']);
        unset($_POST['learning_bro6']);
        unset($_POST['learning_bro7']);
        unset($_POST['learning_bro8']);
        unset($_POST['bro_teaching_place1']);
        unset($_POST['bro_teaching_place2']);
        unset($_POST['bro_teaching_place3']);
        unset($_POST['bro_teaching_place4']);
        unset($_POST['bro_teaching_place5']);
        unset($_POST['bro_teaching_place6']);
        unset($_POST['bro_teaching_place7']);
        unset($_POST['bro_teaching_place8']);
        unset($_POST['uncle_name1']);
        unset($_POST['uncle_name2']);
        unset($_POST['uncle_name3']);
        unset($_POST['uncle_name4']);
        unset($_POST['uncle_name5']);
        unset($_POST['uncle_name6']);
        unset($_POST['uncle_age1']);
        unset($_POST['uncle_age2']);
        unset($_POST['uncle_age3']);
        unset($_POST['uncle_age4']);
        unset($_POST['uncle_age5']);
        unset($_POST['uncle_age6']);
        unset($_POST['married_status_u1']);
        unset($_POST['married_status_u2']);
        unset($_POST['married_status_u3']);
        unset($_POST['married_status_u4']);
        unset($_POST['married_status_u5']);
        unset($_POST['married_status_u6']);
        unset($_POST['u_department1']);
        unset($_POST['u_department2']);
        unset($_POST['u_department3']);
        unset($_POST['u_post1']);
        unset($_POST['u_post2']);
        unset($_POST['u_Working_place1']);
        unset($_POST['u_Working_place2']);
        unset($_POST['u_Working_place3']);
        unset($_POST['u_Working_place4']);
        unset($_POST['monthly_salary_u5']);
        unset($_POST['monthly_salary_u1']);
        unset($_POST['monthly_salary_u2']);
        unset($_POST['monthly_salary_u3']);
        unset($_POST['monthly_salary_u4']);
        unset($_POST['yearly_salary_u1']);
        unset($_POST['yearly_salary_u2']);
        unset($_POST['yearly_salary_u3']);
        unset($_POST['yearly_salary_u4']);
        unset($_POST['yearly_salary_u5']);
        unset($_POST['u_mobile1']);
        unset($_POST['u_mobile2']);
        unset($_POST['u_mobile3']);
        unset($_POST['u_mobile4']);
        unset($_POST['u_mobile5']);
        unset($_POST['u_mobile6']);
        unset($_POST['u_conditions1']);
        unset($_POST['u_conditions2']);
        unset($_POST['u_conditions3']);
        unset($_POST['u_conditions4']);
        unset($_POST['u_conditions5']);
        unset($_POST['u_conditions6']);
        unset($_POST['bua_name1']);
        unset($_POST['bua_name2']);
        unset($_POST['bua_name3']);
        unset($_POST['bua_name4']);
        unset($_POST['bua_name5']);
        unset($_POST['bua_name6']);
        unset($_POST['bua_age1']);
        unset($_POST['bua_age2']);
        unset($_POST['bua_age3']);
        unset($_POST['bua_age4']);
        unset($_POST['bua_age5']);
        unset($_POST['bua_age6']);
        unset($_POST['married_status_bua1']);
        unset($_POST['married_status_bua2']);
        unset($_POST['married_status_bua3']);
        unset($_POST['married_status_bua4']);
        unset($_POST['married_status_bua5']);
        unset($_POST['married_status_bua6']);
        unset($_POST['bua_department1']);
        unset($_POST['bua_department2']);
        unset($_POST['bua_department3']);
        unset($_POST['bua_Working_place1']);
        unset($_POST['bua_Working_place2']);
        unset($_POST['bua_Working_place3']);
        unset($_POST['bua_Working_place4']);
        unset($_POST['bua_post1']);
        unset($_POST['bua_post2']);
        unset($_POST['monthly_salary_bua1']);
        unset($_POST['monthly_salary_bua2']);
        unset($_POST['monthly_salary_bua3']);
        unset($_POST['monthly_salary_bua4']);
        unset($_POST['monthly_salary_bua5']);
        unset($_POST['yearly_salary_bua1']);
        unset($_POST['yearly_salary_bua2']);
        unset($_POST['yearly_salary_bua3']);
        unset($_POST['yearly_salary_bua4']);
        unset($_POST['yearly_salary_bua5']);
        unset($_POST['gm_conditions1']);
        unset($_POST['gm_conditions2']);
        unset($_POST['gm_conditions3']);
        unset($_POST['gm_conditions4']);
        unset($_POST['gm_conditions5']);
        unset($_POST['gm_conditions6']);
        unset($_POST['bua_mobile1']);
        unset($_POST['bua_mobile2']);
        unset($_POST['bua_mobile3']);
        unset($_POST['bua_mobile4']);
        unset($_POST['bua_mobile5']);
        unset($_POST['bua_mobile6']);
        unset($_POST['bua_conditions1']);
        unset($_POST['bua_conditions2']);
        unset($_POST['bua_conditions3']);
        unset($_POST['bua_conditions4']);
        unset($_POST['bua_conditions5']);
        unset($_POST['bua_conditions6']);
        unset($_POST['mb_name1']);
        unset($_POST['mb_name2']);
        unset($_POST['mb_name3']);
        unset($_POST['mb_name4']);
        unset($_POST['mb_name5']);
        unset($_POST['mb_name6']);
        unset($_POST['mb_age1']);
        unset($_POST['mb_age2']);
        unset($_POST['mb_age3']);
        unset($_POST['mb_age4']);
        unset($_POST['mb_age5']);
        unset($_POST['mb_age6']);
        unset($_POST['married_status_mb1']);
        unset($_POST['married_status_mb2']);
        unset($_POST['married_status_mb3']);
        unset($_POST['married_status_mb4']);
        unset($_POST['married_status_mb5']);
        unset($_POST['married_status_mb6']);
        unset($_POST['mb_department1']);
        unset($_POST['mb_department2']);
        unset($_POST['mb_department3']);
        unset($_POST['mb_post1']);
        unset($_POST['mb_post2']);
        unset($_POST['mb_Working_place1']);
        unset($_POST['mb_Working_place2']);
        unset($_POST['mb_Working_place3']);
        unset($_POST['mb_Working_place4']);
        unset($_POST['monthly_salary_mb1']);
        unset($_POST['monthly_salary_mb2']);
        unset($_POST['monthly_salary_mb3']);
        unset($_POST['monthly_salary_mb4']);
        unset($_POST['monthly_salary_mb5']);
        unset($_POST['monthly_salary_mb6']);
        unset($_POST['yearly_salary_mb1']);
        unset($_POST['yearly_salary_mb2']);
        unset($_POST['yearly_salary_mb3']);
        unset($_POST['yearly_salary_mb4']);
        unset($_POST['yearly_salary_mb5']);
        unset($_POST['yearly_salary_mb6']);
        unset($_POST['mb_mobile1']);
        unset($_POST['mb_mobile2']);
        unset($_POST['mb_mobile3']);
        unset($_POST['mb_mobile4']);
        unset($_POST['mb_mobile5']);
        unset($_POST['mb_mobile6']);
        unset($_POST['mb_conditions1']);
        unset($_POST['mb_conditions2']);
        unset($_POST['mb_conditions3']);
        unset($_POST['mb_conditions4']);
        unset($_POST['mb_conditions5']);
        unset($_POST['mb_conditions6']);
        unset($_POST['ms_Working_place1']);
        unset($_POST['ms_Working_place2']);
        unset($_POST['ms_Working_place3']);
        unset($_POST['ms_Working_place4']);
        unset($_POST['ms_post1']);
        unset($_POST['ms_post2']);
        unset($_POST['ms_department1']);
        unset($_POST['ms_department2']);
        unset($_POST['ms_department3']);
        unset($_POST['married_status_ms1']);
        unset($_POST['married_status_ms2']);
        unset($_POST['married_status_ms3']);
        unset($_POST['married_status_ms4']);
        unset($_POST['married_status_ms5']);
        unset($_POST['married_status_ms6']);
        unset($_POST['ms_name1']);
        unset($_POST['ms_name2']);
        unset($_POST['ms_name3']);
        unset($_POST['ms_name4']);
        unset($_POST['ms_name5']);
        unset($_POST['ms_name6']);
        unset($_POST['ms_age1']);
        unset($_POST['ms_age2']);
        unset($_POST['ms_age3']);
        unset($_POST['ms_age4']);
        unset($_POST['ms_age5']);
        unset($_POST['ms_age6']);
        unset($_POST['monthly_salary_ms1']);
        unset($_POST['monthly_salary_ms2']);
        unset($_POST['monthly_salary_ms3']);
        unset($_POST['monthly_salary_ms4']);
        unset($_POST['yearly_salary_ms4']);
        unset($_POST['yearly_salary_ms3']);
        unset($_POST['yearly_salary_ms2']);
        unset($_POST['yearly_salary_ms1']);
        unset($_POST['ms_mobile1']);
        unset($_POST['ms_mobile2']);
        unset($_POST['ms_mobile3']);
        unset($_POST['ms_mobile4']);
        unset($_POST['ms_mobile5']);
        unset($_POST['ms_mobile6']);
        unset($_POST['ms_conditions1']);
        unset($_POST['ms_conditions2']);
        unset($_POST['ms_conditions3']);
        unset($_POST['ms_conditions4']);
        unset($_POST['ms_conditions5']);
        unset($_POST['ms_conditions6']);
        unset($_POST['nm_retired_job1']);
        unset($_POST['nm_retired_job2']);
        unset($_POST['yearly_salary_mgm1']);
        unset($_POST['yearly_salary_mgm2']);
        unset($_POST['yearly_salary_mgm3']);

        $data=$_POST;
   
        $data['nm_retired_job'] = $nmRjob;
        $data['ms_conditions'] = $msCond;
        $data['ms_mobile'] = $msMobile;
        $data['monthly_salary_ms'] = $msSalaryM;
        $data['yearly_salary_ms'] = $msSalaryY;
        $data['ms_name'] = $msAge;
        $data['ms_name'] = $msName;
        $data['married_status_ms'] = $msMrg;
        $data['ms_department'] = $msDept;
        $data['ms_post'] = $msPost;
        $data['ms_Working_place'] = $msPlace;
        $data['mb_conditions'] = $mbCond;
        $data['mb_mobile'] = $mbMobile;
        $data['yearly_salary_mb'] = $mbSalaryY;
        $data['monthly_salary_mb'] = $mbSalaryM;
        $data['mb_Working_place'] = $mbPlace;
        $data['mb_post'] = $mbPost;
        $data['mb_department'] = $mbDept;
        $data['married_status_mb'] = $mbMrg;
        $data['mb_age'] = $mbAge;
        $data['mb_name'] = $mbName;
        $data['bua_mobile'] = $buaMobile;
        $data['bua_conditions'] = $buaCond;
        $data['yearly_salary_bua'] = $buaSalaryY;
        $data['monthly_salary_bua'] = $buaSalaryM;
        $data['bua_post'] = $buaPost;
        $data['bua_Working_place'] = $buaPlace;
        $data['bua_department'] = $buaDept;
        $data['bua_name'] = $buaName;
        $data['bua_age'] = $buaAge;
        $data['married_status_bua'] = $buaMrg;
        $data['u_conditions'] = $uCond;
        $data['u_mobile'] = $uMobile;
        $data['monthly_salary_u'] = $uSalaryM;
        $data['yearly_salary_u'] = $uSalaryY;
        $data['u_Working_place'] = $uPlace;
        $data['u_post'] = $uPost;
        $data['u_department'] = $uDept;
        $data['married_status_u'] = $uMrg;
        $data['uncle_age'] = $uAge;
        $data['uncle_name'] = $uName;
        $data['learning_sis'] = $sStudy;
        $data['learning_bro'] = $bStudy;
        $data['bro_teaching_place'] = $bStudyPlace;
        $data['sis_teaching_place'] = $sStudyPlace;
        $data['sis_Working_place'] = $sPlace;
        $data['sis_mobile'] = $sMobile;
        $data['sis_retired_job'] = $sRJob;
        $data['bro_retired_job'] = $bRJob;
        $data['sis_conditions'] = $sCond;
        $data['monthly_salary_sis'] = $sSalaryM;
        $data['yearly_salary_sis'] = $sSalaryY;
        $data['sis_department'] = $sDept;
        $data['sister_age'] = $sAge;
        $data['married_status_sis'] = $sMrg;
        $data['sister_name'] = $sName;
        $data['g_conditions'] = $gCond;
        $data['gfather_department'] = $gfDept;
        $data['gfather_Working_place'] = $gfPlace;
        $data['nm_mobile'] = $nmMobile;
        $data['gfather_age'] = $gfAge;
        $data['mgm_mobile'] = $mgmMobile;
        $data['gm_mobile'] = $gmMobile;
        $data['yearly_salary_nm'] = $nmSalaryY;
        $data['monthly_salary_nm'] = $nmSalaryM;
        $data['yearly_salary_mgm'] = $mgmSalaryY;
        $data['yearly_salary_mgm'] = $mgmSalaryY;
        $data['mother_name'] = $mName;
        $data['mgm_name'] = $mgmName;
        $data['mgm_age'] = $mgmAge;
        $data['father_name'] = $fName;
        $data['mgm_conditions'] = $naCond;
        $data['gm_conditions'] = $gmCond;
        $data['father_department'] = $fDept;
        $data['father_Working_place'] = $fPlace;
        $data['father_post'] = $fPost;
        $data['monthly_salary'] = $fSalaryM;
        $data['yearly_salary'] = $fSalaryY;
        $data['f_mobile'] = $fMobile;
        $data['conditions_bro'] = $bCond;
        $data['conditions'] = $fCond;
        $data['father_age'] = $fAge;
        $data['monthly_salary_bro'] = $bSalary;
        $data['yearly_salary_bro'] = $bSalaryY;
        $data['bro_Working_place'] = $bPlace;
        $data['bro_post'] = $bPost;
        $data['married_status_b'] = $bMrg;
        $data['bro_department'] = $bDept;
        $data['mother_Working_place'] = $mWork;
        $data['mother_department'] = $mDept;
        $data['mother_post'] = $mPost;
        $data['monthly_salary_m'] = $mSalaryM;
        $data['b_mobile'] = $bMobile;
        $data['m_mobile'] = $mMobile;
        $data['yearly_salary_m'] = $mSalaryY;
        $data['m_conditions'] = $mCond;
        $data['mother_age'] = $mAge;
        $data['brother_name'] = $broName;
        $data['gmoth_name'] = $gName;
        $data['gmoth_age'] = $gAge;
        $data['gfather_name'] = $gfName;
        $data['gfather_post'] = $gfPost;
        $data['g_mobile'] = $gfMobile;
       
        $data['gmoth_age'] = $gmAge;
        $data['nm_name'] = $nName;
        $data['nm_age'] = $nAge;
        $data['mgm_department'] = $mgmDept;
        $data['gm_department'] = $gmDept;
        $data['mgm_post'] = $mgmPost;
        $data['gm_post'] = $gmPost;
        $data['mgm_Working_place'] = $mgmWork;
        $data['gm_Working_place'] = $gmWork;
        $data['brother_age'] = $bAge;
        $data['nm_conditions'] = $niCond;
        $data['monthly_salary_gm'] = $gmSalaryM;
        $data['monthly_salary_g'] = $gSalaryM;
        $data['yearly_salary_gm'] = $gmSalaryY;
        $data['yearly_salary_g'] = $gSalaryY;
        // echo '<pre>';
        // print_r($data);
        // die;
       
        if ($this->welcome_model->getsinglerow(MRG_INFO_TBL, ['user_id' => userid()])) {
            // echo"fddf";die;
            $this->welcome_model->updateRecord(MRG_INFO_TBL, $data, ['user_id' => userid()]);
            $array = array('success' => 'Record Updated');
        } else {
            // echo"fdhhhhhhhhhhdf";die;
            $this->welcome_model->insertRecord(MRG_INFO_TBL, $data);
            $array = array('success' => 'Record Saved');
        }
        echo json_encode($array);
        // }  
        //  echo '<pre>';print_r($_POST);die;


    }
    function president_information()
    {

        $array = [];
        $this->form_validation->set_rules('president_name', 'name', 'required');
        if ($this->form_validation->run() == false) {
            $array = array(
                'president_name' => form_error('president_name')
            );
        } else {
            $data = $_POST;
            $id = userid();
            $istrue = 1;
            /*=========-------------- Image--------========================== */
            $arrayFilter = array_values(array_filter($_FILES['president_img']['name']));
            if (!empty($arrayFilter)) {
                $image = $this->MultipleImageUpload($_FILES['president_img'], './uploads/caste_president', 'president_img');
                if ($image != false) {
                    $data['president_img'] = serialize($image);
                } else {
                    $istrue = 0;
                }
            }
            /*=========-------------- Image--------========================== */
            $arrayFilterKul = array_values(array_filter($_FILES['img']['name']));
            if (!empty($arrayFilterKul)) {
                $imageKul = $this->MultipleImageUpload($_FILES['img'], './uploads/caste_president', 'img');
                if ($imageKul != false) {
                    $data['img'] = serialize($imageKul);
                } else {
                    $istrue = 0;
                }
            }
             // echo '<pre>';
             // print_r($data);
             // die;

            if ($istrue != 0) {
                if ($this->welcome_model->getsinglerow(PRSTN_INFO_TBL, ['user_id' => $id])) {
                    $this->welcome_model->updateRecord(PRSTN_INFO_TBL, $data, ['user_id' => $id]);
                    $array = array('success' => 'Caste President Information Successfully Updated');
                } else {
                    $this->welcome_model->insertRecord(PRSTN_INFO_TBL, $data);
                    $array = array('success' => ' Caste President Information Successfully Saved');
                }
            } else {
                $array = array('success' => 'Wrong Format');
            }
        }
        echo json_encode($array);
    }
    function profile_matching()
    {
        $Self_id = userid('id');

        $data1 = $this->data['religion'] = $this->welcome_model->getReligions($Self_id);
        if(!empty($data1)) {
        $dataall = array(
            'gender' => $data1->gender,
            'religions' => $data1->religions,
            'sub_religions' => $data1->sub_religions,
            'dharm' => $data1->dharm
        );
   
        $this->data['alldata'] = $this->welcome_model->getalluser($dataall);
        $datarelg   =   $dataall['religions'];
        $datasubrel =   $dataall['sub_religions'];
        $this->data['getreligion'] = $this->welcome_model->getreligionformatprofile($datarelg);
        $this->data['getsubreligion'] = $this->welcome_model->getsubreliprofile($datasubrel);
         }
        $this->data['page'] = 'marriage_profile';
        $this->data['content'] = 'marriage_profile/marriage_profile';
        $this->load->view('user/template', $this->data);
    }
    public function add_photos_marriage()
    {
        $Self_id = userid('id');
        $this->data['religion'] = $this->welcome_model->getReligions($Self_id);
        $this->data['subreli'] = $this->welcome_model->getSubReligions($Self_id);

        if (!empty($_POST)) {
            //$this->form_validation->set_rules('first_name', 'First name', 'required|xss_clean');	
            if ($this->form_validation->run() == FALSE) {
                $this->data['page'] = 'marriage_profile';
                $this->data['content'] = 'marriage_profile/marriage_profile';
                $this->load->view('user/template', $this->data);
            } else {

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
                            redirect(profile_matching, 'refresh');
                        }

                        $newFilePath = "uploads/marriage/" . $rand . $newfilename[$i];
                        if (move_uploaded_file($tmpFilePath, $newFilePath)) { }
                    }
                }
                $photo['marriage_profile_img'] = serialize($img);
                if ($this->input->post('id')) {
                    $this->welcome_model->updateRecord('normal_information', $photo, $this->input->post('id'));
                    $this->session->set_flashdata('success', 'Great!');
                    $this->session->set_flashdata('message', 'Profile Updated Successfully');
                    redirect(profile_matching, 'refresh');
                }
            }
        } else {
            $this->data['page'] = 'marriage_profile';
            $this->data['content'] = 'marriage_profile/marriage_profile';
            $this->load->view('user/template', $this->data);
        }
    }


    function send_message()
    {
        //$user_id = userid('id');
        // $this->data['match'] = $this->welcome_model->FetchDataMultipleTBL($user_id);
        $matchId = $_GET['id'];
        //echo $matchId;die;
        $this->data['match'] = $this->welcome_model->matchingUser($matchId);
        $this->data['page'] = 'marriage_profile';
        $this->data['content'] = 'marriage_profile/member_marriage_list';
        $this->load->view('user/template', $this->data);
    }
    function all_document()
    {
        $userId = userid('id');
        $this->data['allcertificatedata'] = $this->welcome_model->allcertificate($userId);
        // echo '<pre>'; print_r($data);die;
        $this->data['page'] = 'my_information';
        $this->data['content'] = 'myinformaion/document';
        $this->load->view('user/template', $this->data);
    }
    function download_resume()
    {
        $userId = userid('id');
        $this->data['byId'] = $this->welcome_model->getsinglerow('user', ['id' => $userId]);
        $this->data['ByIDRecord'] =   $this->welcome_model->getsinglerow(NRML_INFO_TBL, ['user_id' => $userId]);
        $this->data['work']             =   $this->welcome_model->getsinglerow(WRK_INFO_TBL, ['user_id' => $userId]);
        $this->data['special']         =   $this->welcome_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $userId]);
        $this->data['birthinfo']         =   $this->welcome_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $userId]);
        $this->data['education']        =   $this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
        $this->data['page'] = 'download_resume';
        $this->data['content'] = 'resume/download_resume';
        $this->load->view('user/template1', $this->data);
    }
    function download_pdf()
    {
        $userId = userid('id');
        $this->data['byId'] = $this->welcome_model->getsinglerow('user', ['id' => $userId]);
        $this->data['ByIDRecord'] =   $this->welcome_model->getsinglerow(NRML_INFO_TBL, ['user_id' => $userId]);
        $this->data['work']             =   $this->welcome_model->getsinglerow(WRK_INFO_TBL, ['user_id' => $userId]);
        $this->data['special']         =   $this->welcome_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $userId]);
        $this->data['birthinfo']         =   $this->welcome_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $userId]);
        $this->data['education']        =   $this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
        $this->data['page'] = 'download_resume';
        $this->data['content'] = 'resume/download_resume';
        // $this->load->view('user/template1', $this->data); 
        $this->load->library('pdfgenerator');

        $html = $this->load->view('user/template1', $this->data, true);
        $filename = 'report_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }
    function resume()
    {
        $userId = userid('id');
        $this->data['byId'] = $this->welcome_model->getsinglerow('user', ['id' => $userId]);
        $data = $this->data['ByIDRecord'] =   $this->welcome_model->getsinglerow(NRML_INFO_TBL, ['user_id' => $userId]);
        // print_r($data);die;
        $this->data['work']             =   $this->welcome_model->getsinglerow(WRK_INFO_TBL, ['user_id' => $userId]);
        $this->data['special']         =   $this->welcome_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $userId]);
        $data22 = $this->data['birthinfo']         =   $this->welcome_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $userId]);
        //   print_r($data22);die;
        $this->data['education']        =   $this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);

        $this->data['page'] = 'resume';
        $this->data['content'] = 'resume/resume';
        $this->load->view('user/template', $this->data);
    }
    function plan()
    {
        $this->data['income'] = $this->welcome_model->getAllPlan();
        $this->data['page'] = 'plan';
        $this->data['content'] = 'plan/plan';
        $this->load->view('user/template', $this->data);
    }
    function level()
    {
        $id = $this->session->userdata['user']['sponsor_id'];
        $data = $this->welcome_model->getlevel($id);
        //echo '<pre>';print_r($data);die;

        $array = array();
        if (!empty($data)) {
            foreach ($data as $first) {
                $array['first'][] = $first;

                /*========================= for second level===================*/
                $second = $this->welcome_model->getlevel($first->sponsor_id);

                if (!empty($second)) {
                    foreach ($second as $sec) {
                        $array['second'][] = $sec;

                        /*========================= for thired level===================*/
                        $third = $this->welcome_model->getlevel($sec->sponsor_id);
                        if (!empty($third)) {
                            foreach ($third as $thireded) {
                                $array['third'][] = $thireded;

                                /*========================= for fourth level===================*/
                                $fourth = $this->welcome_model->getlevel($thireded->sponsor_id);
                                if (!empty($fourth)) {
                                    foreach ($fourth as $fourthed) {
                                        $array['fourth'][] = $fourthed;
                                        /*========================= for 5th level===================*/
                                        $fifth = $this->welcome_model->getlevel($fourthed->sponsor_id);
                                        if (!empty($fifth)) {
                                            foreach ($fifth as $fipthed) {
                                                $array['fifth'][] = $fipthed;
                                                /*========================= for 6th level===================*/
                                                $sixth = $this->welcome_model->getlevel($fipthed->sponsor_id);
                                                if (!empty($sixth)) {
                                                    foreach ($sixth as $sixed) {
                                                        $array['sixth'][] =   $sixed;
                                                        /*========================= for 7th level===================*/
                                                        $seventh = $this->welcome_model->getlevel($sixed->sponsor_id);
                                                        if (!empty($seventh)) {
                                                            foreach ($seventh as $seventhd) {
                                                                $array['seventh'][]    =   $seventhd;
                                                                /*========================= for 8th level===================*/
                                                                $eighth = $this->welcome_model->getlevel($seventhd->sponsor_id);
                                                                if (!empty($eighth)) {
                                                                    foreach ($eighth as $eightt) {
                                                                        $array['eighth'][]    =  $eightt;
                                                                        /*========================= for 9th level===================*/
                                                                        $ninth = $this->welcome_model->getlevel($eightt->sponsor_id);
                                                                        if (!empty($ninth)) {
                                                                            foreach ($ninth as $Ninth) {
                                                                                $array['ninth'][]  =   $Ninth;
                                                                                /*========================= for 10th level===================*/

                                                                                $tenth  = $this->welcome_model->getlevel($Ninth->sponsor_id);
                                                                                if (!empty($tenth)) {
                                                                                    foreach ($tenth as $Tenth) {
                                                                                        $array['tenth'][]  = $Tenth;
                                                                                        /*========================= for 11th level===================*/
                                                                                        $eleventh = $this->welcome_model->getlevel($Tenth->sponsor_id);
                                                                                        if (!empty($eleventh)) {
                                                                                            foreach ($eleventh as $Eleven) {
                                                                                                $array['eleventh'][]  =   $Eleven;
                                                                                                /*========================= for 12th level===================*/
                                                                                                $twelfth = $this->welcome_model->getlevel($Eleven->sponsor_id);
                                                                                                if (!empty($twelfth)) {
                                                                                                    foreach ($twelfth as $Twol) {
                                                                                                        $array['twelfth'][]  =   $Twol;
                                                                                                        /*========================= for 13th level===================*/
                                                                                                        $therteenth = $this->welcome_model->getlevel($Twol->sponsor_id);
                                                                                                        if (!empty($therteenth)) {
                                                                                                            foreach ($therteenth as $Thertyn) {
                                                                                                                $array['therteenth'][]  =   $Thertyn;
                                                                                                                /*========================= for 14th level===================*/
                                                                                                                $fourteenth = $this->welcome_model->getlevel($Thertyn->sponsor_id);
                                                                                                                if (!empty($fourteenth)) {
                                                                                                                    foreach ($fourteenth as $Fourthn) {
                                                                                                                        $array['fourteenth'][]  =   $Fourthn;
                                                                                                                        /*========================= for 15th level===================*/
                                                                                                                        $fefteenth = $this->welcome_model->getlevel($Fourthn->sponsor_id);
                                                                                                                        if (!empty($fefteenth)) {
                                                                                                                            foreach ($fefteenth as $Feptin) {
                                                                                                                                $array['fefteenth'][] = $Feptin;
                                                                                                                                /*========================= for 16th level===================*/
                                                                                                                                $sixteenth = $this->welcome_model->getlevel($Feptin->sponsor_id);
                                                                                                                                if (!empty($sixteenth)) {
                                                                                                                                    foreach ($sixteenth as $Sixtin) {
                                                                                                                                        $array['sixteenth'][] = $Sixtin;
                                                                                                                                        /*========================= for 17th level===================*/
                                                                                                                                        $seventeenth = $this->welcome_model->getlevel($Sixtin->sponsor_id);
                                                                                                                                        if (!empty($seventeenth)) {
                                                                                                                                            foreach ($seventeenth as $Seventin) {
                                                                                                                                                $array['seventeenth'][] = $Seventin;
                                                                                                                                                /*========================= for 18th level===================*/
                                                                                                                                                $eighteenth = $this->welcome_model->getlevel($Seventin->sponsor_id);
                                                                                                                                                if (!empty($eighteenth)) {
                                                                                                                                                    foreach ($eighteenth as $Eightin) {
                                                                                                                                                        $array['eighteenth'][] = $Eightin;
                                                                                                                                                        /*========================= for 19th level===================*/
                                                                                                                                                        $ninteenth  = $this->welcome_model->getlevel($Eightin->sponsor_id);
                                                                                                                                                        if (!empty($ninteenth)) {
                                                                                                                                                            foreach ($ninteenth as $Nintin) {
                                                                                                                                                                $array['ninteenth'][] = $Nintin;
                                                                                                                                                                /*========================= for 20th level===================*/
                                                                                                                                                                $twentyth = $this->welcome_model->getlevel($Nintin->sponsor_id);
                                                                                                                                                                if (!empty($twentyth)) {
                                                                                                                                                                    foreach ($twentyth as $Townty) {
                                                                                                                                                                        $array['twentyth'][] = $Townty;
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $this->data['leveldata'] = $array;
        $this->data['page'] = 'level';
        $this->data['content'] = 'level/level';
        $this->load->view('user/template', $this->data);
    }
    function steps_income()
    {
        $userId             =   $this->session->userdata['user']['sponsor_id'];
        //$data['incm']       =   $this->welcome_model->getsinglerow(TBL_USER,['id' => $userId]);
        // $data['treeData']   =   $this->welcome_model->getsinglerow(TBL_TREE,['id' => $userId]);
        $this->data['Lincome']         =   $this->welcome_model->getlevelIncome($userId);

        // $date               =   date('Y-m-d', strtotime($data['incm']->create_at));
        $this->data['page'] = 'income';
        $this->data['content'] = 'income/step_income';
        $this->load->view('user/template', $this->data);
    }
    function matching_incomes()
    {
        $sponsorId = $this->session->userdata['user']['sponsor_id'];
        $this->data['income'] = $this->welcome_model->wholeresult('daily_matching_income', [], ['user_id' => $sponsorId]);
        $this->data['page'] = 'income';
        $this->data['content'] = 'income/matching_income';
        $this->load->view('user/template', $this->data);
    }
    function search($id)
    {
        $result = $this->welcome_model->getspecificcolomn(TBL_USER, ['full_name'], ['sponsor_id' => $id]);
        if (!empty($result)) {
            $array['success'] = array('name' => $result->full_name);
        } else {
            $array['error'] = array('name' => 'Invalid Sponsor id');
        }
        echo json_encode($array);
    }
    function create_pin()
    {
        $sponsorId = $this->session->userdata['user']['sponsor_id'];
        $userId = $this->session->userdata['user']['id'];
        $this->data['epin'] = $this->welcome_model->wholeresult(EPN_TBL, [], ['user_id' => $sponsorId]);
        $this->data['plans'] = $this->welcome_model->getAllPlan();
        if (!empty($_POST)) {
            $this->form_validation->set_rules('epin_code', 'Choose ePin', 'required');
            $this->form_validation->set_rules('no_of_epin', 'Number of epin', 'required');
            if ($this->form_validation->run() == false) {
                $this->data['page'] = 'income';
                $this->data['content'] = 'income/create_pin';
                $this->load->view('user/template', $this->data);
            } else {
                $data['wallet'] = $this->welcome_model->getsinglerow(TBL_USER, ['sponsor_id' => $sponsorId]);
                $date = date("Y-m-d H:i:s");
                if ($data['wallet']->wallet_amount >= $this->input->post('epin_code') * $this->input->post('no_of_epin')) {
                    $this->welcome_model->genratepins($this->input->post('no_of_epin'), $sponsorId, $this->input->post('epin_code'), $date);
                    $this->session->set_flashdata(
                        'createPin',
                        '<div class="alert alert-success alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Congratulation! ePin Created Successfully</strong> 
                                                        </div>'
                    );
                    redirect(create_pin);
                } else {
                    $this->session->set_flashdata('amt', 'Sorry! not sufficient balance available');
                    $this->data['page'] = 'income';
                    $this->data['content'] = 'income/create_pin';
                    $this->load->view('user/template', $this->data);
                }
            }
        } else {

            $this->data['page'] = 'income';
            $this->data['content'] = 'income/create_pin';
            $this->load->view('user/template', $this->data);
        }
    }
    function upgrade_plan()
    {
        $id = $this->session->userdata['user']['id'];
        $this->data['userRecord'] = $this->welcome_model->getsinglerow(TBL_USER, ['id' => $id]);
        $this->data['plans'] = $this->welcome_model->getAllPlan();
        if (!empty($_POST)) {
            $this->form_validation->set_rules('upgrade', 'Choose plan type', 'required');
            if ($this->form_validation->run() == false) {
                $this->data['page'] = 'Plan';
                $this->data['content'] = 'plan/upgrade_plan';
                $this->load->view('user/template', $this->data);
            } else {
                $update['create_at'] = date("Y-m-d H:i:s");
                $update['upgrade_plan'] = $this->input->post('upgrade');
                if (!empty($this->input->post('id'))) {
                    $this->welcome_model->updateRecord(TBL_USER, $update, ['id' => $this->input->post('id')]);
                    $this->session->set_flashdata('upgrade', '<div class="alert alert-success alert-dismissible">
                                                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong> Contratulation! Your Account Activated Successfully</strong>
                                                </div>');
                    redirect('user');
                } else { }
            }
        } else {
            $this->data['page'] = 'Plan';
            $this->data['content'] = 'plan/upgrade_plan';
            $this->load->view('user/template', $this->data);
        }
    }
    function letest($id = NULL, $amount = 1)
    {
        $this->levelinfo($id, $amount, $id);
    }
    function levelinfo($id, $amount, $fromId)
    {
        date_default_timezone_set('Asia/Kolkata');
        $month = date('Ym');
        $array = array();
        $data = $this->welcome_model->levlele($id);
        if (!empty($data->added_by && $this->i < 20)) {

            if ($this->i == 0) {
                $level = 1;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 1) {

                $level = 2;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 2) {
                $level = 3;

                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 3) {
                $level = 4;

                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 4) {

                $level = 5;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 5) {

                $level = 6;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 6) {

                $level = 7;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 7) {

                $level = 8;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 8) {

                $level = 9;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 9) {

                $level = 10;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 10) {

                $level = 11;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 11) {

                $level = 12;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 12) {

                $level = 13;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 13) {

                $level = 14;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 14) {

                $level = 15;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 15) {

                $level = 16;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 16) {

                $level = 17;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 17) {

                $level = 18;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 18) {

                $level = 19;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            if ($this->i == 19) {

                $level = 20;
                $this->welcome_model->forlevelupdatation($data->added_by, $level, $amount, $month, $fromId);
            }
            $this->i++;
            $this->levelinfo($data->added_by, $amount, $fromId);
            //echo "<pre>"; print_r($data);


        }
    }

    function activation()
    {
        $data = $this->data['upgrade_notice'] = $this->welcome_model->wholeresult(upgrade_notice, [], []);
        //  echo "<pre>"; print_r($data);
        $this->form_validation->set_rules('epin', 'E-pin', 'required|numeric');
        $this->form_validation->set_rules('method', 'Method', 'required|numeric');
        if ($this->form_validation->run() == false) { } else {
            extract($_POST);
            if ($getin = $this->welcome_model->getspecificcolomn(EPN_TBL, ['epin_code', 'price'], ['epin_code' => $epin, 'is_used' => 0])) {
                $income = $this->welcome_model->getsinglerow(STEP_INCOME, ['plan' => $getin->price]);
                if ($method == 1) {
                    if ($this->welcome_model->getspecificcolomn(TBL_USER, ['status'], ['status' => 0])) {
                        $this->welcome_model->updateRecord(EPN_TBL, ['is_used' => 1, 'reason' => 'Activated self id'], ['epin_code' => $epin]);
                        $this->welcome_model->updateRecord(TBL_USER, ['binary_benifi' => $income->binary_plan, 'plan_benifit' => $income->income, 'status' => 1, 'upgrade_plan' => $income->plan], ['id' => userid()]);
                        $this->welcome_model->updateRecord(TBL_TREE, ['is_active' => 1, 'is_active_date' => date('Y-m-d')], ['user_id' => userid()]);
                        $this->levelinfo(sponsorid(), $income->income, sponsorid());
                        if ($this->welcome_model->getsinglerow(USER_ORDER, ['user_id!=' => sponsorid()])) // is allow only activation time  
                            $this->welcome_model->insertRecord(USER_ORDER, ['user_id' => sponsorid()]);
                        $this->session->set_flashdata('success', 'Great!');
                        $this->session->set_flashdata('message', 'Yo! your id successfully activated');
                        /*========================plan activation information======*/
                        $this->planActivationHistory($getin->price, 'Plan Activation');
                        /*==========================end==========end===============*/
                    } else {
                        $this->session->set_flashdata('error', 'Opps! Sorry');
                        $this->session->set_flashdata('message', 'Your id already activated please go to upgration');
                    }
                } elseif ($method == 2) {
                    if ($this->welcome_model->getspecificcolomn(TBL_USER, ['status'], ['status>' => 1])) {
                        $this->welcome_model->updateRecord(EPN_TBL, ['is_used' => 1, 'reason' => 'Upgrade self id'], ['epin_code' => $epin]);
                        $this->welcome_model->updateRecord(TBL_USER, ['binary_benifi' => $income->binary_plan, 'plan_benifit' => $income->income, 'status' => 1, 'upgrade_plan' => $income->plan], ['id' => userid()]);
                        $this->welcome_model->updateRecord(TBL_TREE, ['is_active' => 1, 'is_active_date' => date('Y-m-d')], ['user_id' => userid()]);
                        $this->levelinfo(sponsorid(), $income->income, sponsorid());
                        $this->session->set_flashdata('success', 'Great!');
                        $this->session->set_flashdata('message', 'Yo! your id successfully activated');

                        /*========================plan upgration information======*/
                        $this->planActivationHistory($getin->price, 'Plan Upgration');
                        /*==========================end==========end===============*/
                    } else {
                        $this->session->set_flashdata('error', 'Opps! Sorry');
                        $this->session->set_flashdata('message', 'Your id not activated please go to activate first');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Opps! Invalid Parameter');
                    $this->session->set_flashdata('message', 'Ohh! you trying to another method for activation or upgration');
                }
            } else {
                $this->session->set_flashdata('error', 'Opps! something went wrong');
                $this->session->set_flashdata('message', 'E-pin not valid');
            }
        }
        $this->data['page'] = 'activation_upgration';
        $this->data['content'] = 'activation/activation_upgration';
        $this->load->view('user/template', $this->data);
    }

    private function planActivationHistory($plan, $remark)
    {
        /*
        user plan activation information July 07, 2019
    */
        $activation['sponsor_id'] = sponsorid();
        $activation['plan_amount'] = $plan;
        $activation['remark'] = $remark;
        $this->welcome_model->insertRecord(PLAN_ACTIVATION_HISTORY, $activation);

        /*========================================================*/
    }
    function transferpin()
    {
        extract($_POST);
        $fromid = $this->session->userdata['user']['sponsor_id'];
        if ($this->welcome_model->getspecificcolomn(TBL_USER, ['full_name'], ['sponsor_id' => $toid])) {
            $pin = explode(',', $ids);
            $del_val = 'on';
            if (($key = array_search($del_val, $pin)) !== false) {
                unset($pin[$key]);
            }
            $pin = array_values($pin);
            $arrayy = array();
            for ($i = 0; $i < count($pin); $i++) {
                $epindata = $this->welcome_model->getspecificcolomn(EPN_TBL, ['price'], ['epin_code' => $pin[$i]]);
                $arrayy[] = array('epincode' => $pin[$i], 'price' => $epindata->price);
            }
            $this->welcome_model->transferepin($arrayy, $toid, $fromid, $pin);
            $array['success'] = array('success' => 1, 'msg' => 'Pin successfully Transfer to user');
        } else {
            $array['success'] = array('success' => 0, 'msg' => 'Invalid sponsor id');
        }
        echo json_encode($array);
    }
    /*===================Transfer Epin History============================*/
    function transfer_epin()
    {

        $userId = $this->session->userdata['user']['sponsor_id'];

        $this->data['history'] = $this->welcome_model->devitEpin($userId);
        $this->data['page'] = 'income';
        $this->data['content'] = 'income/transfer_epin';
        $this->load->view('user/template', $this->data);
    }
    function transfer_epin_history()
    {
        //table Name TRNFR_EPN_TBL
        $userId = $this->session->userdata['user']['sponsor_id'];
        $this->data['epin'] = $this->welcome_model->creditEpin($userId);
        $this->data['page'] = 'income';
        $this->data['content'] = 'income/transfer_epin_self';
        $this->load->view('user/template', $this->data);
    }
    function mydownline()
    {

        // $this->data['mydownline']= Auth::mydownlines(sponsorid());
        $this->data['page'] = 'mydownline';
        $this->data['content'] = 'geneoalogy/mydownline';
        $this->load->view('user/template', $this->data);
    }
    function matching_downlines()
    {

        $this->data['mydownline'] = Auth::mydownlines(sponsorid());
        $this->data['page'] = 'matchingdownline';
        $this->data['content'] = 'income/matching_planwise_downlines';
        $this->load->view('user/template', $this->data);
    }
    function direct_downlines()
    {

        $this->data['mydownline'] = Auth::mydownlines(sponsorid());
        $this->data['page'] = 'directdownline';
        $this->data['content'] = 'income/direct_downlines_earning';
        $this->load->view('user/template', $this->data);
    }
    function total_downlines_earning()
    {

        $this->data['mydownline'] = Auth::mydownlines(sponsorid());
        $this->data['page'] = 'totaldownline';
        $this->data['content'] = 'income/total_downlines_earning';
        $this->load->view('user/template', $this->data);
    }
    function total_income_datewise()
    {

        // $this->data['mydownline']= Auth::mydownlines(sponsorid());
        $this->data['page'] = 'totalincome';
        $this->data['content'] = 'income/income_datewise';
        $this->load->view('user/template', $this->data);
    }
    function total_income_weekly()
    {

        // $this->data['mydownline']= Auth::mydownlines(sponsorid());
        $this->data['page'] = 'totalincome';
        $this->data['content'] = 'income/total_income_weekly';
        $this->load->view('user/template', $this->data);
    }
    function mydirect()
    {
        $this->data['mydirect'] = $this->welcome_model->mydirect(sponsorid());
        $this->data['page'] = 'mydirect';
        $this->data['content'] = 'geneoalogy/mydirect';
        $this->load->view('user/template', $this->data);
    }
    function expenses()
    {
        $id = $this->session->userdata['user']['id'];
        $this->data['expen'] = $this->welcome_model->wholeresult('expenses', [], ['user_id' => $id]);
        $this->data['page'] = 'expenses';
        $this->data['content'] = 'income/expenses';
        $this->load->view('user/template', $this->data);
    }
    function edit_expenses($id = null)
    {
        $userId = $this->session->userdata['user']['id'];
        if (!empty($id)) {
            $this->data['IdBy'] = $this->welcome_model->getsinglerow('expenses', ['id' => $id]);
            $this->data['page'] = 'expenses';
            $this->data['content'] = 'income/add_expenses';
            $this->load->view('user/template', $this->data);
        } else {
            if (!empty($_POST)) {
                $this->form_validation->set_rules('expenses_name', 'expenses name', 'required');
                $this->form_validation->set_rules('expenses_amount', 'expenses amount', 'required');
                $this->form_validation->set_rules('expenses_date', 'expenses date', 'required');

                if ($this->form_validation->run() == false) {
                    $this->data['page'] = 'expenses';
                    $this->data['content'] = 'income/add_expenses';
                    $this->load->view('user/template', $this->data);
                } else {
                    $save['expenses_name'] = $this->input->post('expenses_name');
                    $save['expenses_amount'] = $this->input->post('expenses_amount');
                    $save['expenses_date'] = $this->input->post('expenses_date');
                    $save['current_date'] = date("Y-m-d H:i:s");
                    $save['remark'] = $this->input->post('remark');
                    $save['user_id'] = $userId;
                    if (!empty($this->input->post('id'))) {

                        $this->welcome_model->updateRecord('expenses', $save, ['id' => $this->input->post('id')]);
                        $this->session->set_flashdata('success', 'Update!');
                        $this->session->set_flashdata('message', 'Record Updated Successfully');
                        redirect(expenses);
                    } else {
                        $this->welcome_model->insertRecord('expenses', $save);
                        $this->session->set_flashdata('success', 'Add!');
                        $this->session->set_flashdata('message', 'Record Inserted Successfully');
                        redirect(expenses);
                    }
                }
            } else {
                $this->data['page'] = 'expenses';
                $this->data['content'] = 'income/add_expenses';
                $this->load->view('user/template', $this->data);
            }
        }
    }
    function other_income()
    {
        $id = $this->session->userdata['user']['id'];
        $this->data['income'] = $this->welcome_model->wholeresult('other_income', [], ['user_id' => $id]);
        $this->data['page'] = 'other income';
        $this->data['content'] = 'income/other/other_income_list';
        $this->load->view('user/template', $this->data);
    }
    function edit_other_income($id = null)
    {
        $userId = $this->session->userdata['user']['id'];
        if (!empty($id)) {
            $this->data['IdBy'] = $this->welcome_model->getsinglerow('other_income', ['id' => $id]);
            $this->data['page'] = 'Income';
            $this->data['content'] = 'income/other/add_other_income';
            $this->load->view('user/template', $this->data);
        } else {
            if (!empty($_POST)) {
                $this->form_validation->set_rules('income_source', 'source', 'required');
                $this->form_validation->set_rules('incom_amount', 'amount', 'required');
                $this->form_validation->set_rules('date', 'date', 'required');

                if ($this->form_validation->run() == false) {
                    $this->data['page'] = 'Income';
                    $this->data['content'] = 'income/other/add_other_income';
                    $this->load->view('user/template', $this->data);
                } else {
                    $save['income_name'] = $this->input->post('income_name');
                    $save['income_source'] = $this->input->post('income_source');
                    $save['incom_amount'] = $this->input->post('incom_amount');
                    $save['date'] = $this->input->post('date');
                    $save['remark'] = $this->input->post('remark');
                    $save['user_id'] = $userId;
                    if (!empty($this->input->post('id'))) {

                        $this->welcome_model->updateRecord('other_income', $save, ['id' => $this->input->post('id')]);
                        $this->session->set_flashdata('success', 'Update!');
                        $this->session->set_flashdata('message', 'Record Updated Successfully');
                        redirect(other_income);
                    } else {
                        $this->welcome_model->insertRecord('other_income', $save);
                        $this->session->set_flashdata('success', 'Add!');
                        $this->session->set_flashdata('message', 'Record Inserted Successfully');
                        redirect(other_income);
                    }
                }
            } else {
                $this->data['page'] = 'Income';
                $this->data['content'] = 'income/other/add_other_income';
                $this->load->view('user/template', $this->data);
            }
        }
    }
    function refferal_signup()
    {
        $this->data['page'] = 'signup';
        $this->data['content'] = 'registration/registration';
        $this->load->view('user/template', $this->data);
    }
    function special()
    {
        $userId = $this->session->userdata['user']['id'];
        $this->data['special']           = $this->welcome_model->getsinglerowSpecialay($userId);
        $this->data['religionsName']     = $this->welcome_model->getRelegionsNameById($userId);
        $this->data['SubreligionsName']  = $this->welcome_model->getSubRelegionsNameById($userId);
        $this->data['DharmName']         = $this->welcome_model->getSubRelegionsCategoryNameById($userId);
        $this->data['IdByNormal']        = $this->welcome_model->getsinglerow(NRML_INFO_TBL, ['user_id' => $userId]);
        $this->data['birth']             = $this->welcome_model->getsinglerow(BIRT_INFO_TBL, ['user_id' => $userId]);
        $this->data['caste']             = $this->welcome_model->getsinglerow(CST_INFO_TBL, ['user_id' => $userId]);
        $this->data['pay']               = $this->welcome_model->getsinglerow(PAY_INFO_TBL, ['user_id' => $userId]);
        $this->data['specials']          = $this->welcome_model->getsinglerow(SPCL_INFO_TBL, ['user_id' => $userId]);
        $this->data['education']         = $this->welcome_model->getsinglerow(EDU_INFO_TBL, ['user_id' => $userId]);
        $this->data['family']            = $this->welcome_model->getsinglerow(FMTY_INFO_TBL, ['user_id' => $userId]);
        $this->data['geration']          = $this->welcome_model->getsinglerow(GNRTN_INFO_TBL, ['user_id' => $userId]);
        $this->data['health']            = $this->welcome_model->getsinglerow(HLTH_INFO_TBL, ['user_id' => $userId]);
        $this->data['work']              = $this->welcome_model->getsinglerow(WRK_INFO_TBL, ['user_id' => $userId]);
        $this->data['mrge']              = $this->welcome_model->getsinglerow(MRG_INFO_TBL, ['user_id' => $userId]);
        $this->data['president']         = $this->welcome_model->getsinglerow(PRSTN_INFO_TBL, ['user_id' => $userId]);

        $this->data['page'] = 'Special profile';
        $this->data['content'] = 'special/special_page';
        $this->load->view('user/template', $this->data);
    }
    /* ==================================Android View Page Start============================================================ */
    public function graph()
    {
        $this->load->view('user/android/graphical_view');
    }
    public function my_downline()
    {
        $this->data['mydownline'] = Auth::mydownlines(sponsorid());
        $this->load->view('user/android/mydownline', $this->data);
    }
    public function my_direct()
    {
        $this->data['mydirect'] = $this->welcome_model->mydirect(sponsorid());
        $this->load->view('user/android/mydirect', $this->data);
    }
    /* ==================================Android View Page End============================================================ */
    function tree_demo()
    {
        $this->data['page'] = 'demo';
        $this->data['content'] = 'geneoalogy/tree';
        $this->load->view('user/template', $this->data);
    }

    /*================06-march-2019  getcast And Subcast Ajax ==================== */

    function getcast()
    {
        $Rid = $_GET['id'];
        $data = $this->welcome_model->wholeresult('sub_religion', [], ['religions_id' => $Rid]);
        $array = [];
        foreach ($data as $row) {
            $array[] = "<option value=$row->id>$row->sub_religions</option>";
        }
        $temp = "<option value='0786'>Other</option>";
        array_push($array, $temp);
        echo json_encode($array);
    }
    function getsub_cast()
    {
        $id = $_GET['id'];
        // $data = $this->welcome_model->wholeresult('sub_religion_category', [], ['sub_religion_id' => $id]);
        $data = $this->welcome_model->getAllData('sub_religion_category',array('sub_religion_id' => $id));
        echo '<pre>'; print_r($data); die;
        $array = [];
        foreach ($data as $row) {
            $array[] = "<option value=$row->sub_religion_id>$row->dharm</option>";
        }
        $temp = "<option value='0786'>Other</option>";
        array_push($array, $temp);
        echo json_encode($array);
    }


    /**
     *  get downline member list 7: 15Pm 27-may, 2019
     *  dev: sudheer
     *  
     */


    private function isDownlineExist($selfid1)
    {

        if (array_key_exists($selfid1, $this->alldata)) {
            if ($this->isNotFirstTime) {

                if ($this->isRightStart) {

                    $this->tempFirstRightSponsorId = "";
                    if (in_array($selfid1, $this->allorder)) {
                        $this->downlineright[] = $selfid1;
                    } else {
                        $this->rightPending[] = $selfid1;
                    }
                    $this->allrightids[] = $selfid1;
                } else {
                    if (in_array($selfid1, $this->allorder)) {
                        $this->downlineleft[] = $selfid1;
                    } else {
                        $this->leftPending[] = $selfid1;
                    }
                    $this->allleftids[] = $selfid1;
                }
            }
            if ($this->alldata[$selfid1][0] != "" && $this->alldata[$selfid1][1] != "") {

                if ($this->isNotFirstTime) {
                    $this->tempSponsorArray[] = $this->alldata[$selfid1][1];
                    $this->isDownlineExist($this->alldata[$selfid1][0]);
                } else {
                    $this->isNotFirstTime = 1;
                    $this->tempFirstRightSponsorId = $this->alldata[$selfid1][1];
                    $this->isDownlineExist($this->alldata[$selfid1][0]);
                }
            } elseif ($this->alldata[$selfid1][0] != "") {
                $this->isNotFirstTime = 1;
                $this->isDownlineExist($this->alldata[$selfid1][0]);
            } elseif ($this->alldata[$selfid1][1] != "") {

                if (!$this->isNotFirstTime) {

                    $this->isRightStart = 1;
                }
                $this->isNotFirstTime = 1;
                $this->isDownlineExist($this->alldata[$selfid1][1]);
            } elseif (!empty($this->tempSponsorArray)) {
                $tempSpoID =  end($this->tempSponsorArray);
                $key = key($this->tempSponsorArray);
                unset($this->tempSponsorArray[$key]);
                $this->isDownlineExist($tempSpoID);
            } elseif ($this->tempFirstRightSponsorId != "") {

                $this->isRightStart = 1;
                $this->isDownlineExist($this->tempFirstRightSponsorId);
            }
        }
    }
    public function fetch_step_income()
    {
        $draw = array();
        $this->load->model("Welcome_model");
        $fetch_data = $this->Welcome_model->make_datatables();

        $data = array();
        $userData = '';
        $step1 = '';
        $step2 = '';
        $step3 = '';
        $step4 = '';
        $step5 = '';
        $step6 = '';
        $step7 = '';
        $step8 = '';
        $step9 = '';
        $step10 = '';
        $step11 = '';
        $step12 = '';
        $step13 = '';
        $step14 = '';
        $step15 = '';
        $step16 = '';
        $step17 = '';
        $step18 = '';
        $step19 = '';
        $step20 = '';
        $tot_step = '';
        $count = 1;
        $upgrade_plan = "";
        foreach ($fetch_data as $row) {
            $upgrade_plan = "";
            if (!empty($row)) {
                $userData = $this->Welcome_model->getsinglerow('user', array('sponsor_id' => $row->sponsor_id));

                $upgrade_plan = $userData->upgrade_plan;
            } else {

                $upgrade_plan = "";
            }
            //  echo '<pre>';
            //  print_r($userData);
            //  die;


            if ($row->level == 1) {
                $step1 = $row->level_income;
            } else {
                $step1 = '0.00';
            }
            if ($row->level == 2) {
                $step2 = $row->level_income;
            } else {
                $step2 = '0.00';
            }

            if ($row->level == 3) {
                $step3 = $row->level_income;
            } else {
                $step3 = '0.00';
            }

            if ($row->level == 4) {
                $step4 = $row->level_income;
            } else {
                $step4 = '0.00';
            }

            if ($row->level == 5) {
                $step5 = $row->level_income;
            } else {
                $step5 = '0.00';
            }

            if ($row->level == 6) {
                $step6 = $row->level_income;
            } else {
                $step6 = '0.00';
            }

            if ($row->level == 7) {
                $step7 = $row->level_income;
            } else {
                $step7 = '0.00';
            }

            if ($row->level == 8) {
                $step8 = $row->level_income;
            } else {
                $step8 = '0.00';
            }

            if ($row->level == 9) {
                $step9 = $row->level_income;
            } else {
                $step9 = '0.00';
            }

            if ($row->level == 10) {
                $step10 = $row->level_income;
            } else {
                $step10 = '0.00';
            }

            if ($row->level == 11) {
                $step11 = $row->level_income;
            } else {
                $step11 = '0.00';
            }

            if ($row->level == 12) {
                $step12 = $row->level_income;
            } else {
                $step12 = '0.00';
            }

            if ($row->level == 13) {
                $step13 = $row->level_income;
            } else {
                $step13 = '0.00';
            }

            if ($row->level == 14) {
                $step14 = $row->level_income;
            } else {
                $step14 = '0.00';
            }

            if ($row->level == 15) {
                $step15 = $row->level_income;
            } else {
                $step15 = '0.00';
            }

            if ($row->level == 16) {
                $step16 = $row->level_income;
            } else {
                $step16 = '0.00';
            }

            if ($row->level == 17) {
                $step17 = $row->level_income;
            } else {
                $step17 = '0.00';
            }

            if ($row->level == 18) {
                $step18 = $row->level_income;
            } else {
                $step18 = '0.00';
            }

            if ($row->level == 19) {
                $step19 = $row->level_income;
            } else {
                $step19 = '0.00';
            }

            if ($row->level == 20) {
                $step20 = $row->level_income;
            } else {
                $step20 = '0.00';
            }

            $tot_step = $step1 + $step2 + $step3 + $step4 + $step5 + $step6 + $step7 + $step8 + $step9 + $step10 + $step11 + $step12 + $step13 + $step14 + $step15 + $step16 + $step17 + $step18 + $step19 + $step20;


            $sub_array = array();

            $sub_array[] = $count++;

            $sub_array[] = $upgrade_plan;

            $sub_array[] = date('d-m-Y', strtotime($row->create_at));

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
            "recordsTotal"    => $this->Welcome_model->get_all_data(),
            "recordsFiltered" => $this->Welcome_model->get_filtered_data(),
            "data"            => $data
        );
        echo json_encode($output);
    }

    public function fetch_user()
    {
        $draw = array();
        $this->load->model("Welcome_model");
        $fetch_data = $this->Welcome_model->make_datatables1();
        //   echo '<pre>';
        //   print_r($fetch_data);die;
        $data = array();
        $count = 1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = '';
            $sub_array[] = date('d-m-Y', strtotime($row->on_date));
            $sub_array[] = $row->on_pair;
            $sub_array[] = $row->income;
            $sub_array[] = $row->leps_income;
            $data[] = $sub_array;
        }
        $output = array(
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $this->Welcome_model->get_all_data1(),
            "recordsFiltered" => $this->Welcome_model->get_filtered_data1(),
            "data"            => $data
        );
        echo json_encode($output);
    }

    public function fetch_step_planwise_downlines()
    {
        $draw = array();
        $this->load->model("Welcome_model");
        $fetch_data = $this->Welcome_model->make_datatables2();

        $data = array();
        $count = 1;
        $sts = '';
        foreach ($fetch_data as $row) {
            if ($row->status == 0) {
                $sts = 'Pending';
            } else {
                $sts = 'Active';
            }
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = $row->sponsor_id;
            $sub_array[] = ucfirst($row->full_name);
            $sub_array[] = $row->mobile;
            $sub_array[] = date('d-m-Y', strtotime($row->create_at));
            $sub_array[] = $row->joining_plan;
            $sub_array[] = $row->upgrade_plan;
            $sub_array[] = ucfirst($row->position);
            $sub_array[] =  $sts;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $this->Welcome_model->get_all_data2(),
            "recordsFiltered" => $this->Welcome_model->get_filtered_data2(),
            "data"            => $data
        );
        echo json_encode($output);
    }

    public function fetch_matching_planwise_downlines()
    {
        $draw = array();
        $this->load->model("Welcome_model");
        $fetch_data = $this->Welcome_model->make_datatables2();

        $data = array();
        $count = 1;
        $sts = '';
        foreach ($fetch_data as $row) {
            if ($row->status == 0) {
                $sts = 'Pending';
            } else {
                $sts = 'Active';
            }
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = $row->sponsor_id;
            $sub_array[] = ucfirst($row->full_name);
            $sub_array[] = $row->mobile;
            $sub_array[] = date('d-m-Y', strtotime($row->create_at));
            $sub_array[] = $row->joining_plan;
            $sub_array[] = $row->upgrade_plan;
            $sub_array[] = ucfirst($row->position);
            $sub_array[] =  $sts;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $this->Welcome_model->get_all_data2(),
            "recordsFiltered" => $this->Welcome_model->get_filtered_data2(),
            "data"            => $data
        );
        echo json_encode($output);
    }

    public function fetch_direct_downlines()
    {
        $draw = array();
        $count = 1;
        $sts = '';
        $stepIncome = '';
        $matchIncome = '';
        $sIncome = '';
        $mIncome = '';
        $total_income = '';
        $userID = '';
        $this->load->model("Welcome_model");
        $fetch_data = $this->Welcome_model->make_datatables2();

        $data = array();
        foreach ($fetch_data as $row) {
            $userID = $row->sponsor_id;
            $stepIncome = $this->Welcome_model->getStepIncome($userID);
            $matchIncome = $this->Welcome_model->getmatchIncome($userID);


            if (!empty($stepIncome->tot_step_income)) {
                $sIncome = $stepIncome->tot_step_income;
            } else {
                $sIncome = '0.00';
            }

            if (!empty($matchIncome->tot_match_income)) {
                $mIncome = $matchIncome->tot_match_income;
            } else {
                $mIncome = '0.00';
            }

            $total_income = $sIncome + $mIncome;

            if ($row->status == 0) {
                $sts = 'Pending';
            } else {
                $sts = 'Active';
            }
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = $row->sponsor_id;
            $sub_array[] = ucfirst($row->full_name);
            $sub_array[] = $row->mobile;
            $sub_array[] = date('d-m-Y', strtotime($row->create_at));
            $sub_array[] = $row->joining_plan;
            $sub_array[] = $row->upgrade_plan;
            $sub_array[] = ucfirst($row->position);
            $sub_array[] = $sIncome;
            $sub_array[] = $mIncome;
            $sub_array[] = $total_income;
            $sub_array[] =  $sts;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $this->Welcome_model->get_all_data2(),
            "recordsFiltered" => $this->Welcome_model->get_filtered_data2(),
            "data"            => $data
        );
        echo json_encode($output);
    }

    public function fetch_downlines()
    {
        $draw = array();
        $count = 1;
        $sts = '';
        $stepIncome = '';
        $matchIncome = '';
        $sIncome = '';
        $mIncome = '';
        $total_income = '';
        $userID = '';
        $this->load->model("Welcome_model");
        $fetch_data = $this->Welcome_model->make_datatables2();

        $data = array();
        foreach ($fetch_data as $row) {
            $userID = $row->sponsor_id;
            $stepIncome = $this->Welcome_model->getStepIncome($userID);
            $matchIncome = $this->Welcome_model->getMatchIncome($userID);

            if ($stepIncome->tot_step_income != '') {
                $sIncome = $stepIncome->tot_step_income;
            } else {
                $sIncome = '0.00';
            }

            if (!empty($matchIncome->tot_match_income)) {
                $mIncome = $matchIncome->tot_match_income;
            } else {
                $mIncome = '0.00';
            }

            $total_income = $sIncome + $mIncome;

            if ($row->status == 0) {
                $sts = 'Pending';
            } else {
                $sts = 'Active';
            }
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = $row->sponsor_id;
            $sub_array[] = ucfirst($row->full_name);
            $sub_array[] = $row->mobile;
            $sub_array[] = date('d-m-Y', strtotime($row->create_at));
            $sub_array[] = $row->joining_plan;
            $sub_array[] = $row->upgrade_plan;
            $sub_array[] = ucfirst($row->position);
            $sub_array[] = $sIncome;
            $sub_array[] =  $mIncome;
            $sub_array[] = $total_income;
            $sub_array[] =  $sts;
            $data[] = $sub_array;
        }

        $output = array(
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $this->Welcome_model->get_all_data2(),
            "recordsFiltered" => $this->Welcome_model->get_filtered_data2(),
            "data"            => $data
        );
        echo json_encode($output);
    }
    public function fetch_income()
    {
        $draw = array();
        $this->load->model("Welcome_model");
        $fetch_data = $this->Welcome_model->make_datatables2();

        $data = array();
        $count = 1;
        $stepDate = '';
        $stepIncome = '';
        $matchIncome = '';
        $tot_Income = '';
        $epinIncome = '';
        $newEpinIncome = '';
        $price = '';
        foreach ($fetch_data as $row) {
            $userID = $row->sponsor_id;
            $todaystepIncome = $this->Welcome_model->getTodayStepIncome($userID);
            $todaymatchIncome = $this->Welcome_model->getTodayMatchIncome($userID);
            $reacived_epin = $this->Welcome_model->getsinglerow('epin_transfer', array('to_user' => $userID));
            if (!empty($todaystepIncome->level_income)) {
                $stepIncome = $todaystepIncome->level_income;
            } else {
                $stepIncome = '0.00';
            }
            if (!empty($todaymatchIncome->income)) {
                $matchIncome = $todaymatchIncome->income;
            } else {
                $matchIncome = '0.00';
            }
            if (!empty($reacived_epin->no_of_epin)) {
                $epinIncome = unserialize($reacived_epin->no_of_epin);
                foreach ($epinIncome as $a) {
                    $epinIncome2 = $a['price'];
                }
            } else {
                $epinIncome2 = '0.00';
            }
            $tot_Income = $stepIncome + $matchIncome;
            $sub_array = array();
            $sub_array[] = $count++;
            $sub_array[] = $row->upgrade_plan;
            $sub_array[] = date('d-m-Y', strtotime($row->create_at));
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
            "recordsTotal"    => $this->Welcome_model->get_all_data2(),
            "recordsFiltered" => $this->Welcome_model->get_filtered_data2(),
            "data"            => $data
        );
        echo json_encode($output);
    }

    //  public function fetch_income_weekly()
    //   {
    //     $draw = array();
    //     $this->load->model("Welcome_model");
    //     $fetch_data = $this->Welcome_model->make_datatables();

    //      $data = array();
    //      foreach($fetch_data as $row) 
    //      {
    //          $sub_array = array();
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $sub_array[] = $row->sponsor_id;
    //          $data[] = $sub_array;
    //      }

    //      $output = array(
    //          "draw"            => intval($_POST['draw']),
    //          "recordsTotal"    => $this->Welcome_model->get_all_data(),
    //          "recordsFiltered" => $this->Welcome_model->get_filtered_data(),
    //          "data"            => $data
    //          );
    //          echo json_encode($output);

    //   }

    public function fetch_income_weekly()
    {

        $list = $this->welcome_model->get_datatables3();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
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
            "recordsTotal" => $this->welcome_model->count_all(),
            "recordsFiltered" => $this->welcome_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /** end==========end=================================end============================= */
    function logout()
    {
        $session = array('id', 'sponsor_id');
        $this->session->unset_userdata($session);
        $this->session->sess_destroy();
        redirect(logout);
    }
}
