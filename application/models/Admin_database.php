<?php

Class Admin_Database extends CI_Model {
   

  

   public function delete($Id){
    return $data = $this->db->where("id",$Id)->delete("user");

   }

    public function update($Id){
    return $data = $this->db->select("*")->from("user")->where("id",$Id)->get()->result_array();

   }

   public function alluserlist(){
    $data = $this->db->select("*")->from("user")->where("role","1")->get()->result_array();
    return $data;
   }

   public function quizlist(){
    $data = $this->db->select("*")->from("answer")->get()->result_array();
    return $data;
   }


   public function quizid(){
    $data = $this->db->select("*")->from("quiz")->order_by("id","desc")->limit(1,1)->get()->result_array();
    return $data;
   }
}