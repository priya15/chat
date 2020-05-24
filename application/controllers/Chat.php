<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');

// Load database
$this->load->model('welcome_database');
$this->load->helper("url");
}


	public function index()
	{
		$this->load->view('header');
		$this->load->view("index");
		//$this->load->view("footer");
	}

	public function regis()
	{
	    $this->load->view('header');
		$this->load->view("regis");	
	}

	public function regisdata(){
		$email    = $this->input->post("email");
		$username = $this->input->post("username");
		$password = md5($this->input->post("password"));

		$userdata = $this->welcome_database->checkusername($username,$email,$password);
		if ($userdata == 0) {
		   $data = array("email"=>$email,"username"=>$username,"password"=>$password,"role"=>"1");
		   $this->db->insert("user",$data);
		   $this->session->set_flashdata("success","data added");
		   redirect("regis");
		}
		else
		{
			$this->session->set_flashdata("error","data added");
			redirect("regis");

		}

	}

   public function login()
	{
	    $this->load->view('header');
		$this->load->view("login");	
	}


	public function logindata(){
		$email    = $this->input->post("email");
		$password = md5($this->input->post("password"));

		$userdata = $this->welcome_database->checkusernamedata($email,$password);
		if ($userdata == 0) {
		  
		   $this->session->set_flashdata("error","data not added");
		   redirect("login");
		}
		else
		{
			$userid = $userdata[0]["id"];
			$role   = $userdata[0]["role"];
			$this->session->set_userdata("userid",$userid);
			$this->session->set_userdata("role",$role);

			$this->session->set_flashdata("suuccess","data added");
			if($role == 0){
              	redirect("adash");
			}
			else
			{
			   redirect("dash");
			}
		

		}

	}

	public function dash(){
		if (isset($this->session->userdata["userid"])==true) {
		
		$this->load->view("header");
		$this->load->view("dash");
	  }
	  else
	  {
	  	$this->load->view("header");
		$this->load->view("login");
	  }
	}

	public function adash(){
		$this->load->view("header");
		$this->load->view("adash");
	}

	public function chatdata(){
		$id = $this->input->post("id");
		$idval = $id;

		$rid = $this->session->userdata("userid");
		$cdata = $this->welcome_database->chatdetails($idval,$rid);
		//print_r($cdata);die();
		$str="";
		if(!empty($cdata)){
		for ($i=0; $i <count($cdata) ; $i++) { 
			$msg     = $cdata[$i]["msg"];
			$date    = $cdata[$i]["date_time"];
			$usrname = $cdata[$i]["username"];
			$rids    = $cdata[$i]["r_id"];
			$sids    = $cdata[$i]["s_id"];
			$datemain = explode(" ", $date);
			$dated    = $datemain[0];
			if($rids == $rid){
			 $str.="<div><b>$usrname $dated</b></div><div style='background-color:red;height:23px;color:white;font-weight:bold'>$msg</div>";	
			}
			else{
               $str.="<div><b>$usrname $dated</b></div><div style='background-color:blue;height:23px;color:white;font-weight:bold'>$msg</div>";	
			}
		}
	  }
        $str.= "<br><div class='col-md-12'></div><div class='col-md-12'><textarea class='msg_$idval' target='$idval' style='width:100%' rows='5' cols='5'></textarea ></div><div><br><input type='button' class='btn btn-default sendmessage' target='$idval' value='SendMessage' style='margin-top:23px'></div></div>";
        echo $str;
 	}

 	public function addchatdata(){
		$rid  = $this->input->post("id");
	    $msg  = $this->input->post("msg");
        $sid  = $this->session->userdata("userid");
        date_default_timezone_set("Asia/Kolkata");
        $date = date("Y-m-d h:i:s");
        $data = array("s_id"=>$sid,"r_id"=>$rid,"msg"=>$msg,"date_time"=>$date);
        $check = $this->db->insert("message",$data);
        if($check == 0){
        	echo "0";
        }
        else
        {
        	echo "1";
        }
	
 	}


 	public function countnewmsg(){
 		$str="";
 		$data = $this->welcome_database->alluserlist();
           if(!empty($data)){
           	for ($i=0; $i <count($data) ; $i++) { 
           	    if($data[$i]["id"]!=$this->session->userdata["userid"]){
           	    	$str.="<tr>";
           	    	$username = $data[$i]["username"];
           	    	$sid      = $data[$i]["id"];
           	    	$rid      = $this->session->userdata["userid"]; 
           	    	$sencodeid = $sid;
           	    	$count = $this->welcome_database->countnewmsg($sid,$rid);
           	    	$countnmsg = $count[0]["count"];
	           $str.="<td>$username</td>";
	           $str.="<td class='countdata'><div class='count'>$countnmsg</div></td>";
	           $str.="<td><input type='button' value='StartChat' target='$sencodeid' class='btn btn-primary schat'></td></tr>";           	
           	    }
           	}
           }
           echo $str;
 	}

	public function delete($id){
         $id = base64_decode($id);
         $data = $this->welcome_database->delete($id);
	     if($data == 0){

	     }
	     else
	     {
	     	
	     }
	}

	public function logout(){
		$this->session->unset_userdata("userid");
		$this->session->sess_destroy();
		redirect("login");
	}
    }
