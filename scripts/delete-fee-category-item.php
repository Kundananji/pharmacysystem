<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/fee-category-dao.php");

$feeCategoryDao = new FeeCategoryDao();

if(isset($_POST["feeCategoryId"]) && (int)$_POST["feeCategoryId"] > 0){
  $feeCategoryId = $_POST["feeCategoryId"];
  if($feeCategoryDao->delete($feeCategoryId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


