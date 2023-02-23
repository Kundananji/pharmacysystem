<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/gender-dao.php");

$genderDao = new GenderDao();

if(isset($_POST["genderId"]) && (int)$_POST["genderId"] > 0){
  $genderId = $_POST["genderId"];
  if($genderDao->delete($genderId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


