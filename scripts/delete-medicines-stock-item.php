<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/medicines-stock-dao.php");

$medicinesStockDao = new MedicinesStockDao();

if(isset($_POST["medicinesStockId"]) && (int)$_POST["medicinesStockId"] > 0){
  $medicinesStockId = $_POST["medicinesStockId"];
  if($medicinesStockDao->delete($medicinesStockId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


