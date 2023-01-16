<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/staff-dao.php");

$staffDao = new StaffDao();

if(isset($_POST["staffId"]) && (int)$_POST["staffId"] > 0){
  $staffId = $_POST["staffId"];
  if($staffDao->delete($staffId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


