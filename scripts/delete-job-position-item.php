<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/job-position-dao.php");

$jobPositionDao = new JobPositionDao();

if(isset($_POST["jobPositionId"]) && (int)$_POST["jobPositionId"] > 0){
  $jobPositionId = $_POST["jobPositionId"];
  if($jobPositionDao->delete($jobPositionId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


