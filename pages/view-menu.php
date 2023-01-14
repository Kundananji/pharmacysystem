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
//make available variables of menu available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/menu.php");
  include_once("../daos/menu-dao.php");

  $menuDao = new MenuDao(); 
  $menu =  $menuDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of _profile available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/_profile.php");
  include_once("../daos/_profile-dao.php");

  $profileDao = new ProfileDao(); 
  $profile =  $profileDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
//make available variables of menu_target available in scope for use:
if(isset($_POST['id']) && $_POST['id']!=''){
  include_once("../classes/menu-target.php");
  include_once("../daos/menu-target-dao.php");

  $menuTargetDao = new MenuTargetDao(); 
  $menuTarget =  $menuTargetDao->select(filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT)); 
}
include("../daos/menu-dao.php");
include("../classes/menu.php");
include("../config/database.php");
$dao = new MenuDao();

 $objects = $dao->selectAll();
             ?>
             <h1 class="h3 mb-4 text-gray-800">Menu</h1>  
<div class="mb-3"><button class="btn btn-primary" onclick="Menu.addNewMenu({})" id="add-new-menu"><em class="fa fa-plus"></em> Add New Menu </button></div>
<table class="table table-striped" id="table-menu">
  <thead>
    <tr>
      <th>
      </th>
      <th>
        
      </th>
      <th>
        Icon
      </th>
      <th>
        Name
      </th>
      <th>
        Label
      </th>
      <th>
        Url
      </th>
      <th>
        Target
      </th>
      <th>
        Parent
      </th>
      <th>
        Profile
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
    foreach($objects as $menu){
    ?>
      <tr>
      <th>
        <?php echo ++$count;?>
      </th>
        <td>
        <?php
          echo $menu->getId();
        ?>
        </td>
        <td>
        <?php
          echo $menu->getIcon();
        ?>
        </td>
        <td>
        <?php
          echo $menu->getName();
        ?>
        </td>
        <td>
        <?php
          echo $menu->getLabel();
        ?>
        </td>
        <td>
        <?php
          echo $menu->getUrl();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/menu-target.php");
          include_once("../daos/menu-target-dao.php");

          $fmenuTargetDao = new MenuTargetDao(); 
          $fmenuTarget = $fmenuTargetDao->select($menu->getTarget()); 
          echo  $fmenuTarget==null?"-": $fmenuTarget->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/menu.php");
          include_once("../daos/menu-dao.php");

          $fmenuDao = new MenuDao(); 
          $fmenu = $fmenuDao->select($menu->getParentId()); 
          echo  $fmenu==null?"-": $fmenu->toString();
        ?>
        </td>
        <td>
        <?php
          include_once("../classes/_profile.php");
          include_once("../daos/_profile-dao.php");

          $fprofileDao = new ProfileDao(); 
          $fprofile = $fprofileDao->select($menu->getProfileId()); 
          echo  $fprofile==null?"-": $fprofile->toString();
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-primary" onclick="Menu.addNewMenu({id : \''.$menu->getId.'\',})"> <em class="fa fa-edit"></em></a>';
        ?>
        </td>
        <td>
        <?php
          echo '<a href="javascript:void(0)" class="btn btn-danger" onclick="Menu.deleteMenu('.$menu->getId().' )"><em class="fa fa-trash"></em></a>';
        ?>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
