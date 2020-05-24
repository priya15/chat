<?php

Class Welcome_Database extends CI_Model {
   

   public function checkusername($username,$email,$password){
  $data =  	$this->db->select("*")->from("user")->where("email",$email)->get()->result_array();
   if(!empty($data)){
    return 1;
   }
   else
   {
     return 0;
   }
   }

   public function checkusernamedata($email,$password){
  $data =  	$this->db->select("*")->from("user")->where("email",$email)->where("password",$password)->get()->result_array();
   if(!empty($data)){
    return $data;
   }
   else
   {
     return 0;
   }
   }

   public function countnewmsg($sid,$rid){
    $data =   $this->db->select("count(*) as count")->from("message")->where("s_id",$sid)->where("r_id",$rid)->where("status","0")->get()->result_array();
   if(!empty($data)){
    return $data;
   }
   else
   {
     return 0;
   }
   }

   public function chatdetails($sid,$rid){
    $query =  $this->db->select('*')->from('user')->join('message', 'user.id = message.r_id')->where("(message.r_id='$rid' and message.s_id='$sid' OR message.s_id='$rid' and message.r_id='$sid')", NULL, FALSE)->order_by("message.date_time","DESC")->get()->result_array();

        if(!empty($query)){
            $data = array("status"=>"1");
            $this->db->where("r_id",$rid)->where("s_id",$sid)->update("message",$data);
                    return $query;

       }
       else
       {
         return 0;
       }

   }

   public function delete($Id){
    return $data = $this->db->where("id",$Id)->delete("user");

   }

   public function alluserlist(){
    $data = $this->db->select("*")->from("user")->where("role","1")->get()->result_array();
    return $data;
   }
}