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
//make available variables of users available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/users.php");
  include_once("../daos/users-dao.php");

  $usersDao = new UsersDao(); 
  $users =  $usersDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/_user-tokens-dao.php");
include("../classes/_user-tokens.php");
include("../config/database.php");
$dao = new UserTokensdao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">&nbsp;user&nbsp;tokens</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="UserTokens.addNewUserTokens({})" id="add-new-_user-tokens"><em class="fa fa-plus"></em> Add New UserTokens </button></div>
<table class="table table-striped" id="table-_user-tokens">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Selector
      </th>
      <th>
        Hashed&nbsp;Validator
      </th>
      <th>
        User
      </th>
      <th>
        Expiry
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
    foreach($objects as $userTokens){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $userTokens->getId();
        ?>
        </td>
        <td>
        <?php
          echo $userTokens->getSelector();
        ?>
        </td>
        <td>
        <?php
          echo $userTokens->getHashedValidator();
        ?>
        </td>
        <td>
        <?php
          echo $userTokens->getUserId();
        ?>
        </td>
        <td>
        <?php
          echo $userTokens->getExpiry();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="UserTokens.addNewUserTokens({id : \''.$userTokens->getId().'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="UserTokens.deleteUserTokens('.$userTokens->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
