<?php
session_start();
$userId = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;
//get any set params, pass them to add, delete buttons

//declare env variables for use
$env_dateNow = date("d/m/Y");
$env_timeNow = date("H:i:s");
$env_YearNow = date("Y");
$env_MonthNow = date("m");
$env_MonthFullNow = date("F");
$env_yearNow = date("Y");
$env_monthNow = date("m");
$env_monthFullNow = date("F");
$env_dayNow = date("d");

$arguments = array();
foreach($_POST as $key=>$value){
  $arguments[]=" $key :'".$value."'";
  //put arguments in scope
  $$key = $value;
}
include("../daos/invoice-dao.php");
include("../classes/invoice.php");
include("../config/database.php");
include("../classes/patients.php");
include("../daos/patients-dao.php");
include("../daos/invoice-detail-dao.php");
include("../classes/invoice-detail.php");
include("../daos/invoice-settings-dao.php");
include("../classes/invoice-settings.php");
include("../daos/receipt-dao.php");
include("../classes/receipt.php");

$invoiceSettingDao = new InvoiceSettingsdao();
$invoiceDetailDao = new InvoiceDetaildao();
$dao = new InvoiceDao();
$patientsDao = new PatientsDao(); 

$receiptDao = new ReceiptDao();


$appendQuery='';
foreach($_POST as $key=>$value){
  $$key =filter_var($_POST[$key],FILTER_SANITIZE_STRING);
  if($key == "_term") continue;
  $appendQuery.=' AND '. $key.'='.$$key;
}
//make available variables of yesno available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/yesno.php");
  include_once("../daos/yesno-dao.php");

  $yesnoDao = new YesnoDao(); 
  $yesno =  $yesnoDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of patient_scheme available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/patient-scheme.php");
  include_once("../daos/patient-scheme-dao.php");

  $patientSchemeDao = new PatientSchemeDao(); 
  $patientScheme =  $patientSchemeDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of patients available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){

  $patients =  $patientsDao->select(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT)); 
}

//echo $appendQuery;
//get active invoices
$currentInvoices = $dao->selectByWhereClause($appendQuery==null?'(isPaidFor = 0 AND status=1)':'(1'.$appendQuery.')');
$objects=[];

?>
 <h1 class="h3 mb-4 text-gray-800">Manage Invoices</h1>  
<?php
  //show add button if no invoice exists

  if(sizeof($currentInvoices) ==0){

   //load all invoices if current invoices do not exist
   $objects = $dao->selectByWhereClause('1 AND status =1 ORDER BY invoiceDate Desc LIMIT 50');
?>

 <div class="mb-3">
  <button class="btn btn-primary" onclick="Invoice.addNewInvoiceManageinvoices_pharamacyuser({<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" id="add-new-invoice-manage-invoices-pharamacy-user"><em class="fa fa-plus"></em> Add New  </button>
</div>
<?php
  }

  if(sizeof($currentInvoices) > 0){


   $invoice = $currentInvoices[0]; //fetch pending invoice and display it

   $patient = $patientsDao->select($invoice->getPatientId());

   //get invoice details
   $invoiceDetails = $invoiceDetailDao->selectBy(array("invoiceId"),array($invoice->getInvoiceId()),array("i"));

   $invoiceSettings = $invoiceSettingDao->selectAll();

   $invoiceSetting=sizeof($invoiceSettings)>0?$invoiceSettings[0]:Null;

   echo'<div id="print-area">';

   echo'<table border="1" cellpadding="10" cellspacing="0" style="margin:0px auto;width:100%" class="table">';
   
     echo'<tr>';
	 	echo'<td colspan="3">';
      echo'<table>';  
        echo'<tr>';
          echo'<td style="vertical-align:middle">';
          echo'<img src="img/hms.jpg" style="width:100px;border-radius:50px">';
          echo'</td>';

          echo'<td>';

          echo'<br/><b>MULTI CARE HOSPITAL</b>';
          echo'<br/>Plot No. 27196, Off Chilumbulu Road, Libala South';
          echo'<br/>Lusaka, ZAMBIA</p>';
          echo'<p><b>Tel:</b> 0211262718:<br/>';
          echo'<b>Email:</b> multicare@gmail.com<br/>';
          echo'<b>TPIN:</b> 1004307067</p>';
          echo'<hr>';
          echo'</td>';

        echo'</tr>';

      echo'</table>';

			echo'<b>Billed To: </b>';
			echo'<hr>';
			echo  $patient->toString()."<br/>";	
			echo  str_ireplace("\n","<br/>",$patient->getAddress());			

		echo'</td>';
		echo'<td  colspan="2">';

    echo'<h2>INVOICE</h2>';
    echo'<hr>';
		echo'<p><b>Invoice No:</b> '.$invoice->getInvoiceNo().'<br/>';
		echo'<b>Invoice Date:</b> '.date("j F, Y",strtotime($invoice->getInvoiceDate())).'<br/>';
    echo'<b>Due Date:</b> '.date("j F, Y",strtotime($invoice->getInvoiceDate())).'</p>';
		echo'</td>';
	 echo'</tr>';
	 echo'<tr>';
		echo'<td colspan="5">';

		echo'</td>';
	 echo'</tr>';

	 echo'<tr style="font-weight:bold">';
		echo'<td colspan="2">';
			echo'Description';
		echo'</td>';
		echo'<td colspan="1">';
			echo'Quantity';
		echo'</td>';
		echo'<td colspan="1">';
			echo'Unit Price';
		echo'</td>';
		echo'<td colspan="1">';
			echo'Amount';
		echo'</td>';
  echo'</tr>';
  $total=0;
  foreach($invoiceDetails as $invoiceDetail){
	$total+=(float)$invoiceDetail->getTotalAmount();
	echo'<tr>';
		echo'<td colspan="2">';
    if($invoice->getIsPaidFor()==0){
			echo '<a href="javascript:InvoiceDetail.deleteInvoiceDetail_pharamacyuser('.$invoiceDetail->getId().')"><i class="fa fa-times"></i></a>&nbsp;';
    }
      echo $invoiceDetail->getDescription();
		echo'</td>';
		echo'<td colspan="1">';
		    echo $invoiceDetail->getQuantity();
		echo'</td>';
		echo'<td colspan="1" style="text-align:right">';
			echo $invoiceDetail->getUnitPrice();
		echo'</td>';
		echo'<td colspan="1" style="text-align:right">';

			echo number_format($invoiceDetail->getTotalAmount(),'2','.',',');
		echo'</td>';
    echo'</tr>';

  }
  echo'<tfoot>';

  echo'<tr>';
  echo'<td colspan="4">';
	  echo 'Sub Total';
  echo'</td>';
  echo'<td colspan="1" style="font-weight:bold;text-align:right">';
	  echo number_format($total,'2','.',',');
  echo'</td>';
echo'</tr>';



echo'<tr>';
echo'<td colspan="4">';
  echo 'Tax Rate';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
 if($invoiceSetting!=null){
   $taxRate = $invoiceSetting->getTaxRate();
   echo number_format($taxRate,'1','.',',');
 }
 else{
  echo number_format(0,'1','.',',');
 }
  echo'%</td>';
echo'</tr>';


echo'<tr>';
echo'<td colspan="4">';
  echo 'Total Tax';
echo'</td>';
echo'<td colspan="1" style="font-weight:bold;text-align:right">';
  echo number_format($invoice->getTaxAmount(),'2','.',',');
echo'</td>';
echo'</tr>';


  echo'<tr>';
  echo'<td colspan="4">';
    echo '<b>Balance Due</b>';
  echo'</td>';
  echo'<td colspan="1" style="font-weight:bold;text-align:right">';
    echo number_format($invoice->getAmount(),'2','.',',');
  echo'</td>';
  echo'</tr>';

    echo'<tr>';
    echo'<td colspan="5">';
      if($invoiceSetting!=null){
        if($invoiceSetting->getTerms()){
          echo'<h5>Terms</h5>';
          echo '<div style="font-size:1em">'.$invoiceSetting->getTerms().'</div>';
        }
      }
    echo'</td>';
    echo'</tr>';
      echo'</tfoot>';


   echo'</table>';

   echo'</div>';
   echo'<p class="m-4">';
   if($invoice->getIsPaidFor()==0 || $invoice->getIsPaidFor()==null){
    echo'<a href="javascript:InvoiceDetail.InvoiceAddMedicine({invoiceId:'. $invoice->getInvoiceId() .',})" class="btn btn-primary"> <i class="fa fa-tablets"></i> Add Medicine</a> &nbsp; &nbsp;';
    
    echo'<a href="javascript:InvoiceDetail.InvoiceAddOtherFees({invoiceId:'.$invoice->getInvoiceId().' })" class="btn btn-secondary"> <i class="fa fa-list"></i> Add Other Fees</a> &nbsp; &nbsp;';
   }
   echo'<a href="javascript:printDocument()" class="btn btn-info"> <i class="fa fa-print"></i> Print Invoice</a> &nbsp; &nbsp;';
   if($invoice->getIsPaidFor()==0 || $invoice->getIsPaidFor()==null){
    echo'<a href="javascript:Receipt.InvoiceIssureReceipt({invoiceId:'.$invoice->getInvoiceId().' })" class="btn btn-success"> <i class="fa fa-list"></i> Collect Payment</a> &nbsp; &nbsp;';
   }
   if($invoice->getIsPaidFor()==1){
    $receipts = $receiptDao->selectBy(array("invoiceId"),array($invoice->getInvoiceId()),array("i"));
   if(sizeof($receipts)>0){
    $receipt = $receipts[0];
   echo'
       <a href="javascript:void(0)" onclick="Receipt.viewReceiptViewreceipt_pharamacyuser({receiptId:\''.$receipt->getReceiptId().'\',})" class="btn btn-success"><em class="fa fa-print"></em> Print Receipt</a>
   ';
   }
   }
   //cancel invoice
   if($invoice->getStatus()==1 && $invoice->getIsPaidFor()==0){
    echo' <a href="javascript:void(0)" onclick="Invoice.CancelInvoice({ id:'. $invoice->getInvoiceId().',status:\'2\'})" class="btn btn-danger"><em class="fa fa-times"></em> Cancel Invoice</a>';
   }
   echo'
   </p>';
}

if(sizeof($objects)>0 && sizeof($currentInvoices)==0){
?>

<br/>
<br/>
<h4>Other Invoices: </h4>

<table class="table table-striped" id="table-invoice--manage-invoices-pharamacy-user">
  <thead>
    <tr>
      <th>
        No.
      </th>
      <th>
        Invoice&nbsp;No
      </th>
      <th>
        Description
      </th>
      <th>
        Invoice&nbsp;Date
      </th>
      <th>
        Patient
      </th>
      <th>
        Tax&nbsp;Amount
      </th>
      <th>
        Amount
      </th>
      <th>
        Is&nbsp;Paid&nbsp;For
      </th>
      <th>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
    foreach($objects as $mInvoice){
      if(isset($invoice) &&$invoice->getInvoiceId()== $mInvoice->getId()){
        continue;
      }
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          $invoiceNo=$mInvoice->getInvoiceNo();
          echo str_ireplace("\n","<br/>",$mInvoice->getInvoiceNo());
        ?>
        </td>
        <td>
        <?php
          $description=$mInvoice->getDescription();
          echo str_ireplace("\n","<br/>",$mInvoice->getDescription());
        ?>
        </td>
        <td>
        <?php
          $invoiceDate=$mInvoice->getInvoiceDate();
          echo str_ireplace("\n","<br/>",$mInvoice->getInvoiceDate());
        ?>
        </td>
        <td>
        <?php
          $patientId=$mInvoice->getPatientId();
          include_once("../classes/patients.php");
          include_once("../daos/patients-dao.php");

          $fpatientsDao = new PatientsDao(); 
          $fpatients = $fpatientsDao->select($mInvoice->getPatientId()); 
          echo  $fpatients==null?"-": $fpatients->toString();
        ?>
        </td>
        <td>
        <?php
          $taxAmount=$mInvoice->getTaxAmount();
          echo str_ireplace("\n","<br/>",$mInvoice->getTaxAmount());
        ?>
        </td>
        <td>
        <?php
          $amount=$mInvoice->getAmount();
          echo str_ireplace("\n","<br/>",$mInvoice->getAmount());
        ?>
        </td>
        <td>
        <?php
          $isPaidFor=$mInvoice->getIsPaidFor();
          include_once("../classes/yesno.php");
          include_once("../daos/yesno-dao.php");

          $fyesnoDao = new YesnoDao(); 
          $fyesno = $fyesnoDao->select($mInvoice->getIsPaidFor()); 
          echo  $fyesno==null?"-": $fyesno->toString();
        ?>
        </td>

        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Invoice.viewInvoiceManageinvoices_pharamacyuser({ invoiceId:\''.$mInvoice->getInvoiceId().'\',})"> <em class="fa fa-eye"></em> View </a>';
          
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<?php
}

?>