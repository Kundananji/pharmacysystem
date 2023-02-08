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
include_once("../classes/invoice-settings.php");
include_once("../daos/invoice-settings-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$invoiceSettingsEdit = new InvoiceSettings();
$invoiceSettingsEditDao = new InvoiceSettingsDao();
if(isset($id)){
  $tempObject = $invoiceSettingsEditDao->select($id);
  if($tempObject !=null){
    $invoiceSettingsEdit = $tempObject;
  }
}
?>
<form onsubmit = "InvoiceSettings.submitFormInvoiceSettings(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoice-settings">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-invoice-settings-id" value="<?php echo null!==($invoiceSettingsEdit->getId())?($invoiceSettingsEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-invoice-settings-terms">

                 <?php
                  $readonly = in_array('terms',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceSettingsEdit->getId()!=null){ $defaultValues['terms']=$invoiceSettingsEdit->getTerms();};
                  ?>
                  <label for="input-invoice-settings-terms">Terms*</label>
  <textarea rows="5" name="terms" id="input-invoice-settings-terms" class="form-control " placeholder="Enter Terms " required<?php echo $readonly;?>   ><?php echo null!==($invoiceSettingsEdit->getTerms())?($invoiceSettingsEdit->getTerms()):(isset($defaultValues['terms'])?($defaultValues['terms']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-settings-tax-rate">

                 <?php
                  $readonly = in_array('taxRate',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceSettingsEdit->getId()!=null){ $defaultValues['taxRate']=$invoiceSettingsEdit->getTaxRate();};
                  ?>
                  <label for="input-invoice-settings-tax-rate">Tax&nbsp;Rate*</label>
  <input type="number" step="any" name="taxRate" id="input-invoice-settings-tax-rate" class="form-control " placeholder="Enter Tax&nbsp;Rate " value="<?php echo null!==($invoiceSettingsEdit->getTaxRate())?($invoiceSettingsEdit->getTaxRate()):(isset($defaultValues['taxRate'])?($defaultValues['taxRate']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
