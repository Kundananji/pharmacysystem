<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/regular-checkups-dao.php");

$regularCheckupsDao = new RegularCheckupsDao();

if(isset($_POST["regularCheckupsId"]) && (int)$_POST["regularCheckupsId"] > 0){
  $regularCheckupsId = $_POST["regularCheckupsId"];
  if($regularCheckupsDao->delete($regularCheckupsId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


