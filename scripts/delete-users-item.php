<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/users-dao.php");

$usersDao = new UsersDao();

if(isset($_POST["usersId"]) && (int)$_POST["usersId"] > 0){
  $usersId = $_POST["usersId"];
  if($usersDao->delete($usersId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


