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
include_once("../classes/menu-target.php");
include_once("../daos/menu-target-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$menuTargetEdit = new MenuTarget();
$menuTargetEditDao = new MenuTargetDao();
if(isset($id)){
  $tempObject = $menuTargetEditDao->select($id);
  if($tempObject !=null){
    $menuTargetEdit = $tempObject;
  }
}
?>
<form onsubmit = "MenuTarget.submitFormMenuTarget(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-menu-target">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-menu-target-id" value="<?php echo null!==($menuTargetEdit->getId())?($menuTargetEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-menu-target-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuTargetEdit->getId()!=null){ $defaultValues['name']=$menuTargetEdit->getName();};
                  ?>
                  <label for="input-menu-target-name">Name*</label>
  <input type="text" name="name" id="input-menu-target-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($menuTargetEdit->getName())?($menuTargetEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
