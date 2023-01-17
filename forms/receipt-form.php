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
include_once("../classes/receipt.php");
include_once("../daos/receipt-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$receiptEdit = new Receipt();
$receiptEditDao = new ReceiptDao();
if(isset($id)){
  $tempObject = $receiptEditDao->select($id);
  if($tempObject !=null){
    $receiptEdit = $tempObject;
  }
}
?>
<form onsubmit = "Receipt.submitFormReceipt(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-receipt">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-receipt-id" value="<?php echo null!==($receiptEdit->getId())?($receiptEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-receipt-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptEdit->getId()!=null){ $defaultValues['description']=$receiptEdit->getDescription();};
                  ?>
                  <label for="input-receipt-description">Description*</label>
  <input type="text" name="description" id="input-receipt-description" class="form-control " placeholder="Enter Description " value="<?php echo null!==($receiptEdit->getDescription())?($receiptEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-patient-id">

                 <?php
                  $readonly = in_array('patientId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptEdit->getId()!=null){ $defaultValues['patientId']=$receiptEdit->getPatientId();};
                  ?>
                  <label for="input-receipt-patient-id">Patient*</label>
  <?php 
    include_once("../classes/patients.php");
    include_once("../daos/patients-dao.php");

    $patientsDao = new PatientsDao(); 
    $objects = $patientsDao->selectAll(); 
    ?>
    <select name="patientId" id="input-receipt-patient-id" class="form-control " required <?php echo $readonly;?> >
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
<div class="form-group input-receipt-receipt-no">

                 <?php
                  $readonly = in_array('receiptNo',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptEdit->getId()!=null){ $defaultValues['receiptNo']=$receiptEdit->getReceiptNo();};
                  ?>
                  <label for="input-receipt-receipt-no">Receipt&nbsp;No*</label>
  <input type="text" name="receiptNo" id="input-receipt-receipt-no" class="form-control " placeholder="Enter Receipt&nbsp;No " value="<?php echo null!==($receiptEdit->getReceiptNo())?($receiptEdit->getReceiptNo()):(isset($defaultValues['receiptNo'])?($defaultValues['receiptNo']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-receipt-date">

                 <?php
                  $readonly = in_array('receiptDate',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptEdit->getId()!=null){ $defaultValues['receiptDate']=$receiptEdit->getReceiptDate();};
                  ?>
                  <label for="input-receipt-receipt-date">Receipt&nbsp;Date*</label>
  <input type="text" name="receiptDate" id="input-receipt-receipt-date" class="form-control datepicker " placeholder="Enter Receipt&nbsp;Date " value="<?php echo null!==($receiptEdit->getReceiptDate())?(date("d/m/Y",strtotime($receiptEdit->getReceiptDate()))):(isset($defaultValues['receiptDate'])?($defaultValues['receiptDate']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-amount">

                 <?php
                  $readonly = in_array('amount',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptEdit->getId()!=null){ $defaultValues['amount']=$receiptEdit->getAmount();};
                  ?>
                  <label for="input-receipt-amount">Amount*</label>
  <input type="number" step="any" name="amount" id="input-receipt-amount" class="form-control " placeholder="Enter Amount " value="<?php echo null!==($receiptEdit->getAmount())?($receiptEdit->getAmount()):(isset($defaultValues['amount'])?($defaultValues['amount']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-receipt-payment-method-id">

                 <?php
                  $readonly = in_array('paymentMethodId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($receiptEdit->getId()!=null){ $defaultValues['paymentMethodId']=$receiptEdit->getPaymentMethodId();};
                  ?>
                  <label for="input-receipt-payment-method-id">Payment&nbsp;Method*</label>
  <?php 
    include_once("../classes/payment-methods.php");
    include_once("../daos/payment-methods-dao.php");

    $paymentMethodsDao = new PaymentMethodsDao(); 
    $objects = $paymentMethodsDao->selectAll(); 
    ?>
    <select name="paymentMethodId" id="input-receipt-payment-method-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Payment&nbsp;methods--</option>
      <?php
        foreach($objects as $paymentMethods){
          $optionValue  = $paymentMethods->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['paymentMethodId']) && $defaultValues['paymentMethodId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['paymentMethodId']) && $defaultValues['paymentMethodId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['paymentMethodId']) && $defaultValues['paymentMethodId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$paymentMethods->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
