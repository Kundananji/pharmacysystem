<?php 
session_start(); //start session since security is involved
$session_userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:null; //read userId from session
$session_profile = isset($_SESSION['user_profile'])?$_SESSION['user_profile']:null; //read userId from session

//declare env variables for use
$env_dateNow = date("d/m/Y");
$env_timeNow = date("H:i:s");
$env_YearNow = date("Y");
$env_MonthNow = date("m");
$env_MonthFullNow = date("F");
$env_dayNow = date("d");

//variables for holding fields that should not be edited, as well as default values for fields
$uneditableFields = array();
$defaultValues = array();
//Get database connection
include("../config/database.php");
?>
<?php
$arguments = array(); //store arguments for later use
foreach($_GET as $key=>$value){
  $arguments[]="$key:'".$value."'";
  //put arguments in scope
  $$key = $value;
}

//make available variables of yesno available in scope for use:
if(isset($_GET['id']) && $_GET['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of patients available in scope for use:
if(isset($_GET['patientId']) && $_GET['patientId']!=''){
  include_once("../classes/patients.php");
  include_once("../daos/patients-dao.php");

  $patientsDao = new PatientsDao(); 
  $patients =  $patientsDao->select(filter_var($_GET['patientId'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of invoice_status available in scope for use:
if(isset($_GET['invoiceStatusId']) && $_GET['invoiceStatusId']!=''){
  include_once("../classes/invoice-status.php");
  include_once("../daos/invoice-status-dao.php");

  $invoiceStatusDao = new InvoiceStatusDao(); 
  $invoiceStatus =  $invoiceStatusDao->select(filter_var($_GET['invoiceStatusId'],FILTER_SANITIZE_NUMBER_INT)); 
}


 if($_SESSION['user_profile'] == 'Pharamacy User'){
  $uneditableFields=array();
  $defaultValues['isPaidFor']="0";
  $defaultValues['taxAmount']="0";
  $defaultValues['amount']="0";
  $defaultValues['invoiceDate']=isset($env_dateNow)?$env_dateNow:null;
  $defaultValues['status']="1";
}
?> 
<?php
//include scripts
include_once("../classes/invoice.php");
include_once("../daos/invoice-dao.php");
$arguments=array();$invoiceId = isset($_GET['invoiceId'])?filter_var($_GET['invoiceId'], FILTER_VALIDATE_INT):null;
$invoiceEdit = new Invoice();
$invoiceEditDao = new InvoiceDao();
if(isset($invoiceId)){
  $tempObject = $invoiceEditDao->select($invoiceId);
  if($tempObject !=null){
    $invoiceEdit = $tempObject;
  }
}
?>
<form onsubmit = "Invoice.submitFormInvoiceManageinvoices_pharamacyuser(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoice">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

<?php
  $readonly = in_array('invoiceId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['invoiceId']=$invoiceEdit->getInvoiceId();};
?>
  <input type="hidden" name="invoiceId" id="input-invoice-invoice-id" value="<?php echo (isset($defaultValues['invoiceId'])?($defaultValues['invoiceId']): "0");?>"/>
<?php
  $readonly = in_array('invoiceNo',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['invoiceNo']=$invoiceEdit->getInvoiceNo();};
?>

 <!--start of form group-->
<div class="form-group d-none input-invoice-invoice-no">
  <label for="input-invoice-invoice-no">Invoice&nbsp;No</label>
  <input type="text" name="invoiceNo" id="input-invoice-invoice-no" class="form-control " placeholder="Enter Invoice&nbsp;No " value="<?php echo (isset($defaultValues['invoiceNo'])?($defaultValues['invoiceNo']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('description',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['description']=$invoiceEdit->getDescription();};
?>

 <!--start of form group-->
<div class="form-group input-invoice-description">
  <label for="input-invoice-description">Description</label>
  <textarea rows="5" name="description" id="input-invoice-description" class="form-control " placeholder="Enter Description " <?php echo $readonly;?>   ><?php echo (isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->
<?php
  $readonly = in_array('invoiceDate',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['invoiceDate']=$invoiceEdit->getInvoiceDate();};
?>

 <!--start of form group-->
<div class="form-group d-none input-invoice-invoice-date">
  <label for="input-invoice-invoice-date">Invoice&nbsp;Date*</label>
  <input type="text" name="invoiceDate" id="input-invoice-invoice-date" class="form-control  datepicker" placeholder="Enter Invoice&nbsp;Date* " value="<?php echo (isset($defaultValues['invoiceDate'])?($defaultValues['invoiceDate']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('patientId',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['patientId']=$invoiceEdit->getPatientId();};
?>

 <!--start of form group-->
<div class="form-group input-invoice-patient-id">
  <label for="input-invoice-patient-id">Patient*</label>
  <?php 
    include_once("../classes/patients.php");
    include_once("../daos/patients-dao.php");

    $patientsDao = new PatientsDao(); 
    $objects = $patientsDao->selectAll(); 
    ?>
    <select name="patientId" id="input-invoice-patient-id" class="select-2-basic-single w-100 form-control" required <?php echo $readonly;?>  style="width:100%">
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Patient*--</option>
      <?php
        foreach($objects as $patients){
          $optionValue  = $patients->getPatientId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['patientId']) && $defaultValues['patientId']==$optionValue || $invoiceEdit->getPatientId()==$patients->getPatientId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$patients->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('taxAmount',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['taxAmount']=$invoiceEdit->getTaxAmount();};
?>

 <!--start of form group-->
<div class="form-group d-none input-invoice-tax-amount">
  <label for="input-invoice-tax-amount">Tax&nbsp;Amount</label>
  <input type="number" step="any" name="taxAmount" id="input-invoice-tax-amount" class="form-control " placeholder="Enter Tax&nbsp;Amount " value="<?php echo (isset($defaultValues['taxAmount'])?($defaultValues['taxAmount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('amount',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['amount']=$invoiceEdit->getAmount();};
?>

 <!--start of form group-->
<div class="form-group d-none input-invoice-amount">
  <label for="input-invoice-amount">Amount</label>
  <input type="number" step="any" name="amount" id="input-invoice-amount" class="form-control " placeholder="Enter Amount " value="<?php echo (isset($defaultValues['amount'])?($defaultValues['amount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<?php
  $readonly = in_array('isPaidFor',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['isPaidFor']=$invoiceEdit->getIsPaidFor();};
?>

 <!--start of form group-->
<div class="form-group d-none input-invoice-is-paid-for">
  <label for="input-invoice-is-paid-for">Is&nbsp;Paid&nbsp;For</label>
  <?php 
    include_once("../classes/yesno.php");
    include_once("../daos/yesno-dao.php");

    $yesnoDao = new YesnoDao(); 
    $objects = $yesnoDao->selectAll(); 
    ?>
    <select name="isPaidFor" id="input-invoice-is-paid-for" class=" form-control"  <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Is&nbsp;Paid&nbsp;For--</option>
      <?php
        foreach($objects as $yesno){
          $optionValue  = $yesno->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['isPaidFor']) && $defaultValues['isPaidFor']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['isPaidFor']) && $defaultValues['isPaidFor']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['isPaidFor']) && $defaultValues['isPaidFor']==$optionValue || $invoiceEdit->getIsPaidFor()==$yesno->getId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$yesno->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<?php
  $readonly = in_array('status',$uneditableFields)?'readonly':'';
  //override default value with actual value if object is sent
    if($invoiceEdit->getInvoiceId()!=null){ $defaultValues['status']=$invoiceEdit->getStatus();};
?>

 <!--start of form group-->
<div class="form-group d-none input-invoice-status">
  <label for="input-invoice-status">Status*</label>
  <?php 
    include_once("../classes/invoice-status.php");
    include_once("../daos/invoice-status-dao.php");

    $invoiceStatusDao = new InvoiceStatusDao(); 
    $objects = $invoiceStatusDao->selectAll(); 
    ?>
    <select name="status" id="input-invoice-status" class=" form-control" required <?php echo $readonly;?>  >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Status*--</option>
      <?php
        foreach($objects as $invoiceStatus){
          $optionValue  = $invoiceStatus->getInvoiceStatusId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['status']) && $defaultValues['status']==$optionValue || $invoiceEdit->getStatus()==$invoiceStatus->getInvoiceStatusId() ?"selected":"" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'          >'.$invoiceStatus->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
