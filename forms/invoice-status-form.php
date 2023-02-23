<?php
session_start(); //start session since security is involved
$session_userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:null; //read userId from session
$session_profile = isset($_SESSION['user_profile'])?$_SESSION['user_profile']:null; //read userId from session

//declare env variables for use
$env_dateNowHuman = date("d/m/Y");
$env_dateNow = date("Y-m-d");
$env_timeNow = date("H:i:s");
$env_YearNow = date("Y");
$env_MonthNow = date("m");
$env_MonthFullNow = date("F");
$env_dayNow = date("d");

//variables for holding fields that should not be edited, as well as default values for fields
$uneditableFields = array();
$defaultValues = array();
?>
<?php
//include scripts
include("../config/database.php");
include_once("../classes/invoice-status.php");
include_once("../daos/invoice-status-dao.php");
$arguments=array();$invoiceStatusId = isset($_GET['invoiceStatusId'])?filter_var($_GET['invoiceStatusId'], FILTER_VALIDATE_INT):null;
$invoiceStatusEdit = new InvoiceStatus();
$invoiceStatusEditDao = new InvoiceStatusDao();
if(isset($invoiceStatusId)){
  $tempObject = $invoiceStatusEditDao->select($invoiceStatusId);
  if($tempObject !=null){
    $invoiceStatusEdit = $tempObject;
  }
}
?>
<form onsubmit = "InvoiceStatus.submitFormInvoiceStatus(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoice-status">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="invoiceStatusId" id="input-invoice-status-invoice-status-id" value="<?php echo null!==($invoiceStatusEdit->getInvoiceStatusId())?($invoiceStatusEdit->getInvoiceStatusId()):(isset($defaultValues['invoiceStatusId'])?($defaultValues['invoiceStatusId']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-invoice-status-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceStatusEdit->getInvoiceStatusId()!=null){ $defaultValues['name']=$invoiceStatusEdit->getName();};
                  ?>
                  <label for="input-invoice-status-name">Name*</label>
  <input type="text" name="name" id="input-invoice-status-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($invoiceStatusEdit->getName())?($invoiceStatusEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
