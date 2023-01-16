<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/patients-details-dao.php");

$patientsDetailsDao = new PatientsDetailsDao();

if(isset($_POST["patientsDetailsId"]) && (int)$_POST["patientsDetailsId"] > 0){
  $patientsDetailsId = $_POST["patientsDetailsId"];
  if($patientsDetailsDao->delete($patientsDetailsId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


