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
  $arguments[]="'".$value."'";
}
//make available variables of insurance_provider available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/insurance-provider.php");
  include_once("../daos/insurance-provider-dao.php");

  $insuranceProviderDao = new InsuranceProviderDao(); 
  $insuranceProvider =  $insuranceProviderDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of status available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/status.php");
  include_once("../daos/status-dao.php");

  $statusDao = new StatusDao(); 
  $status =  $statusDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/patient-scheme-dao.php");
include("../classes/patient-scheme.php");
include("../config/database.php");
$dao = new PatientSchemedao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Patient&nbsp;scheme</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="PatientScheme.addNewPatientScheme({})" id="add-new-patient-scheme"><em class="fa fa-plus"></em> Add New PatientScheme </button></div>
<table class="table table-striped" id="table-patient-scheme">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Name
      </th>
      <th>
        Description
      </th>
      <th>
        Patient
      </th>
      <th>
        Insurance&nbsp;Provider&nbsp;Id
      </th>
      <th>
        Status
      </th>
      <th>
      </th>
      <th>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
      $count = 0;
    foreach($objects as $patientScheme){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $patientScheme->getId();
        ?>
        </td>
        <td>
        <?php
          echo $patientScheme->getName();
        ?>
        </td>
        <td>
        <?php
          echo $patientScheme->getDescription();
        ?>
        </td>
        <td>
        <?php
          echo $patientScheme->getPatientId();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/insurance-provider.php");
          include_once("../daos/insurance-provider-dao.php");

          $finsuranceProviderDao = new InsuranceProviderDao(); 
          $finsuranceProvider = $finsuranceProviderDao->select($patientScheme->getInsuranceProviderId()); 
          echo  $finsuranceProvider==null?"-": $finsuranceProvider->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/status.php");
          include_once("../daos/status-dao.php");

          $fstatusDao = new StatusDao(); 
          $fstatus = $fstatusDao->select($patientScheme->getStatus()); 
          echo  $fstatus==null?"-": $fstatus->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="PatientScheme.addNewPatientScheme({id : \''.$patientScheme->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="PatientScheme.deletePatientScheme('.$patientScheme->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
