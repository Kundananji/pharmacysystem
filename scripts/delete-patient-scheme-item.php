<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/patient-scheme-dao.php");

$patientSchemeDao = new PatientSchemeDao();

if(isset($_POST["patientSchemeId"]) && (int)$_POST["patientSchemeId"] > 0){
  $patientSchemeId = $_POST["patientSchemeId"];
  if($patientSchemeDao->delete($patientSchemeId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


