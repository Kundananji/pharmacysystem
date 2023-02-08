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
include_once("../classes/accounts-invoice-number-sequence.php");
include_once("../daos/accounts-invoice-number-sequence-dao.php");
$arguments=array();$sequenceId = isset($_GET['sequenceId'])?filter_var($_GET['sequenceId'], FILTER_VALIDATE_INT):null;
$accountsInvoiceNumberSequenceEdit = new AccountsInvoiceNumberSequence();
$accountsInvoiceNumberSequenceEditDao = new AccountsInvoiceNumberSequenceDao();
if(isset($sequenceId)){
  $tempObject = $accountsInvoiceNumberSequenceEditDao->select($sequenceId);
  if($tempObject !=null){
    $accountsInvoiceNumberSequenceEdit = $tempObject;
  }
}
?>
<form onsubmit = "AccountsInvoiceNumberSequence.submitFormAccountsInvoiceNumberSequence(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-accounts-invoice-number-sequence">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="sequenceId" id="input-accounts-invoice-number-sequence-sequence-id" value="<?php echo null!==($accountsInvoiceNumberSequenceEdit->getSequenceId())?($accountsInvoiceNumberSequenceEdit->getSequenceId()):(isset($defaultValues['sequenceId'])?($defaultValues['sequenceId']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-accounts-invoice-number-sequence-year">

                 <?php
                  $readonly = in_array('year',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($accountsInvoiceNumberSequenceEdit->getSequenceId()!=null){ $defaultValues['year']=$accountsInvoiceNumberSequenceEdit->getYear();};
                  ?>
                  <label for="input-accounts-invoice-number-sequence-year">Year*</label>
  <input type="number" name="year" id="input-accounts-invoice-number-sequence-year" class="form-control " placeholder="Enter Year " value="<?php echo null!==($accountsInvoiceNumberSequenceEdit->getYear())?($accountsInvoiceNumberSequenceEdit->getYear()):(isset($defaultValues['year'])?($defaultValues['year']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-accounts-invoice-number-sequence-invoice-number">

                 <?php
                  $readonly = in_array('invoiceNumber',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($accountsInvoiceNumberSequenceEdit->getSequenceId()!=null){ $defaultValues['invoiceNumber']=$accountsInvoiceNumberSequenceEdit->getInvoiceNumber();};
                  ?>
                  <label for="input-accounts-invoice-number-sequence-invoice-number">Invoice&nbsp;Number*</label>
  <input type="number" name="invoiceNumber" id="input-accounts-invoice-number-sequence-invoice-number" class="form-control " placeholder="Enter Invoice&nbsp;Number " value="<?php echo null!==($accountsInvoiceNumberSequenceEdit->getInvoiceNumber())?($accountsInvoiceNumberSequenceEdit->getInvoiceNumber()):(isset($defaultValues['invoiceNumber'])?($defaultValues['invoiceNumber']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
