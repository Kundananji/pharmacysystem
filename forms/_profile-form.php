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
include_once("../classes/_profile.php");
include_once("../daos/_profile-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$profileEdit = new Profile();
$profileEditDao = new ProfileDao();
if(isset($id)){
  $tempObject = $profileEditDao->select($id);
  if($tempObject !=null){
    $profileEdit = $tempObject;
  }
}
?>
<form onsubmit = "Profile.submitFormProfile(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-_profile">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-_profile-id" value="<?php echo null!==($profileEdit->getId())?($profileEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-_profile-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($profileEdit->getId()!=null){ $defaultValues['name']=$profileEdit->getName();};
                  ?>
                  <label for="input-_profile-name">Name*</label>
  <input type="text" name="name" id="input-_profile-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($profileEdit->getName())?($profileEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-_profile-description">

                 <?php
                  $readonly = in_array('description',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($profileEdit->getId()!=null){ $defaultValues['description']=$profileEdit->getDescription();};
                  ?>
                  <label for="input-_profile-description">Description*</label>
  <input type="text" name="description" id="input-_profile-description" class="form-control " placeholder="Enter Description " value="<?php echo null!==($profileEdit->getDescription())?($profileEdit->getDescription()):(isset($defaultValues['description'])?($defaultValues['description']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-_profile-is-active">

                 <?php
                  $readonly = in_array('isActive',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($profileEdit->getId()!=null){ $defaultValues['isActive']=$profileEdit->getIsActive();};
                  ?>
                  <label for="input-_profile-is-active">Is&nbsp;Active*</label>
  <?php 
    include_once("../classes/yesno.php");
    include_once("../daos/yesno-dao.php");

    $yesnoDao = new YesnoDao(); 
    $objects = $yesnoDao->selectAll(); 
    ?>
    <select name="isActive" id="input-_profile-is-active" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Yesno--</option>
      <?php
        foreach($objects as $yesno){
          $optionValue  = $yesno->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['isActive']) && $defaultValues['isActive']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['isActive']) && $defaultValues['isActive']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['isActive']) && $defaultValues['isActive']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$yesno->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-_profile-is-default">

                 <?php
                  $readonly = in_array('isDefault',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($profileEdit->getId()!=null){ $defaultValues['isDefault']=$profileEdit->getIsDefault();};
                  ?>
                  <label for="input-_profile-is-default">Is&nbsp;Default*</label>
  <?php 
    include_once("../classes/yesno.php");
    include_once("../daos/yesno-dao.php");

    $yesnoDao = new YesnoDao(); 
    $objects = $yesnoDao->selectAll(); 
    ?>
    <select name="isDefault" id="input-_profile-is-default" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Yesno--</option>
      <?php
        foreach($objects as $yesno){
          $optionValue  = $yesno->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['isDefault']) && $defaultValues['isDefault']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['isDefault']) && $defaultValues['isDefault']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['isDefault']) && $defaultValues['isDefault']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$yesno->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
