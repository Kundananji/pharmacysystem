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
include("../daos/customers-dao.php");
include("../classes/customers.php");
include("../config/database.php");
$dao = new CustomersDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Customers</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Customers.addNewCustomers({})" id="add-new-customers"><em class="fa fa-plus"></em> Add New Customers </button></div>
<table class="table table-striped" id="table-customers">
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
        Contact&nbsp;Number
      </th>
      <th>
        Address
      </th>
      <th>
        Doctor&nbsp;Name
      </th>
      <th>
        Doctor&nbsp;Address
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
    foreach($objects as $customers){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $customers->getId();
        ?>
        </td>
        <td>
        <?php
          echo $customers->getName();
        ?>
        </td>
        <td>
        <?php
          echo $customers->getContactNumber();
        ?>
        </td>
        <td>
        <?php
          echo $customers->getAddress();
        ?>
        </td>
        <td>
        <?php
          echo $customers->getDoctorName();
        ?>
        </td>
        <td>
        <?php
          echo $customers->getDoctorAddress();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Customers.addNewCustomers({id : \''.$customers->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Customers.deleteCustomers('.$customers->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
