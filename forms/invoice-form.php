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
?>
<?php
//include scripts
include("../config/database.php");
include_once("../classes/invoice.php");
include_once("../daos/invoice-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$invoiceEdit = new Invoice();
$invoiceEditDao = new InvoiceDao();
if(isset($id)){
  $tempObject = $invoiceEditDao->select($id);
  if($tempObject !=null){
    $invoiceEdit = $tempObject;
  }
}
?>
<form onsubmit = "Invoice.submitFormInvoice(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-invoice">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-invoice-id" value="<?php echo null!==($invoiceEdit->getId())?($invoiceEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-invoice-invoice-no">

                 <?php
                  $readonly = in_array('invoiceNo',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['invoiceNo']=$invoiceEdit->getInvoiceNo();};
                  ?>
                  <label for="input-invoice-invoice-no">Invoice&nbsp;No*</label>
  <input type="text" name="invoiceNo" id="input-invoice-invoice-no" class="form-control " placeholder="Enter Invoice&nbsp;No " value="<?php echo null!==($invoiceEdit->getInvoiceNo())?($invoiceEdit->getInvoiceNo()):(isset($defaultValues['invoiceNo'])?($defaultValues['invoiceNo']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['description']=$invoiceEdit->getDescription();};
                  ?>
                  <label for="input-invoice-description">Description*</label>
  <textarea rows="5" name="description" id="input-invoice-description" class="form-control " placeholder="Enter Description " required<?php echo $readonly;?>   ><?php echo null!==($invoiceEdit->getDescription())?($invoiceEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-invoice-date">

                 <?php
                  $readonly = in_array('invoiceDate',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['invoiceDate']=$invoiceEdit->getInvoiceDate();};
                  ?>
                  <label for="input-invoice-invoice-date">Invoice&nbsp;Date*</label>
  <input type="text" name="invoiceDate" id="input-invoice-invoice-date" class="form-control datepicker " placeholder="Enter Invoice&nbsp;Date " value="<?php echo null!==($invoiceEdit->getInvoiceDate())?(date("d/m/Y",strtotime($invoiceEdit->getInvoiceDate()))):(isset($defaultValues['invoiceDate'])?($defaultValues['invoiceDate']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-patient-id">

                 <?php
                  $readonly = in_array('patientId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['patientId']=$invoiceEdit->getPatientId();};
                  ?>
                  <label for="input-invoice-patient-id">Patient*</label>
  <?php 
    include_once("../classes/patients.php");
    include_once("../daos/patients-dao.php");

    $patientsDao = new PatientsDao(); 
    $objects = $patientsDao->selectAll(); 
    ?>
    <select name="patientId" id="input-invoice-patient-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Patients--</option>
      <?php
        foreach($objects as $patients){
          $optionValue  = $patients->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['patientId']) && $defaultValues['patientId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['patientId']) && $defaultValues['patientId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$patients->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-tax-amount">

                 <?php
                  $readonly = in_array('taxAmount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['taxAmount']=$invoiceEdit->getTaxAmount();};
                  ?>
                  <label for="input-invoice-tax-amount">Tax&nbsp;Amount</label>
  <input type="number" step="any" name="taxAmount" id="input-invoice-tax-amount" class="form-control " placeholder="Enter Tax&nbsp;Amount " value="<?php echo null!==($invoiceEdit->getTaxAmount())?($invoiceEdit->getTaxAmount()):(isset($defaultValues['taxAmount'])?($defaultValues['taxAmount']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-amount">

                 <?php
                  $readonly = in_array('amount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['amount']=$invoiceEdit->getAmount();};
                  ?>
                  <label for="input-invoice-amount">Amount*</label>
  <input type="number" step="any" name="amount" id="input-invoice-amount" class="form-control " placeholder="Enter Amount " value="<?php echo null!==($invoiceEdit->getAmount())?($invoiceEdit->getAmount()):(isset($defaultValues['amount'])?($defaultValues['amount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-is-paid">

                 <?php
                  $readonly = in_array('isPaid',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['isPaid']=$invoiceEdit->getIsPaid();};
                  ?>
                  <label for="input-invoice-is-paid">Is&nbsp;Pa*</label>
  <?php 
    include_once("../classes/yesno.php");
    include_once("../daos/yesno-dao.php");

    $yesnoDao = new YesnoDao(); 
    $objects = $yesnoDao->selectAll(); 
    ?>
    <select name="isPaid" id="input-invoice-is-paid" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Yesno--</option>
      <?php
        foreach($objects as $yesno){
          $optionValue  = $yesno->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['isPaid']) && $defaultValues['isPaid']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['isPaid']) && $defaultValues['isPaid']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['isPaid']) && $defaultValues['isPaid']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$yesno->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-invoice-patient-scheme-id">

                 <?php
                  $readonly = in_array('patientSchemeId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($invoiceEdit->getId()!=null){ $defaultValues['patientSchemeId']=$invoiceEdit->getPatientSchemeId();};
                  ?>
                  <label for="input-invoice-patient-scheme-id">Patient&nbsp;Scheme</label>
  <?php 
    include_once("../classes/patient-scheme.php");
    include_once("../daos/patient-scheme-dao.php");

    $patientSchemeDao = new PatientSchemeDao(); 
    $objects = $patientSchemeDao->selectAll(); 
    ?>
    <select name="patientSchemeId" id="input-invoice-patient-scheme-id" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Patient&nbsp;scheme--</option>
      <?php
        foreach($objects as $patientScheme){
          $optionValue  = $patientScheme->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['patientSchemeId']) && $defaultValues['patientSchemeId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['patientSchemeId']) && $defaultValues['patientSchemeId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['patientSchemeId']) && $defaultValues['patientSchemeId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$patientScheme->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
