<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/privilege-dao.php");

$privilegeDao = new PrivilegeDao();

if(isset($_POST["privilegeId"]) && (int)$_POST["privilegeId"] > 0){
  $privilegeId = $_POST["privilegeId"];
  if($privilegeDao->delete($privilegeId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


