<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/department-dao.php");

$departmentDao = new DepartmentDao();

if(isset($_POST["departmentId"]) && (int)$_POST["departmentId"] > 0){
  $departmentId = $_POST["departmentId"];
  if($departmentDao->delete($departmentId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


