<?php
//include scripts
include("../config/database.php");
include("../util/convert-date.php");
include_once("../daos/invoice-settings-dao.php");

$invoiceSettingsDao = new InvoiceSettingsDao();

if(isset($_POST["invoiceSettingsId"]) && (int)$_POST["invoiceSettingsId"] > 0){
  $invoiceSettingsId = $_POST["invoiceSettingsId"];
  if($invoiceSettingsDao->delete($invoiceSettingsId)){
    exit(json_encode(array("title"=>"Success","status"=>"success","message"=>"Record has been successfully deleted")));
  }else{
    exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"An error occurred. Record not deleted. Try again later.")));
  }
}else{
  exit(json_encode(array("title"=>"Failure","status"=>"error","message"=>"Id is missing. Delete cannot happen.")));
}


