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
include_once("../classes/menu.php");
include_once("../daos/menu-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$menuEdit = new Menu();
$menuEditDao = new MenuDao();
if(isset($id)){
  $tempObject = $menuEditDao->select($id);
  if($tempObject !=null){
    $menuEdit = $tempObject;
  }
}
?>
<form onsubmit = "Menu.submitFormMenu(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-menu">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-menu-id" value="<?php echo null!==($menuEdit->getId())?($menuEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-menu-icon">

                 <?php
                  $readonly = in_array('icon',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['icon']=$menuEdit->getIcon();};
                  ?>
                  <label for="input-menu-icon">Icon</label>
  <input type="text" name="icon" id="input-menu-icon" class="form-control " placeholder="Enter Icon " value="<?php echo null!==($menuEdit->getIcon())?($menuEdit->getIcon()):(isset($defaultValues['icon'])?($defaultValues['icon']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-menu-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['name']=$menuEdit->getName();};
                  ?>
                  <label for="input-menu-name">Name*</label>
  <input type="text" name="name" id="input-menu-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($menuEdit->getName())?($menuEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-menu-label">

                 <?php
                  $readonly = in_array('label',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['label']=$menuEdit->getLabel();};
                  ?>
                  <label for="input-menu-label">Label*</label>
  <input type="text" name="label" id="input-menu-label" class="form-control " placeholder="Enter Label " value="<?php echo null!==($menuEdit->getLabel())?($menuEdit->getLabel()):(isset($defaultValues['label'])?($defaultValues['label']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-menu-url">

                 <?php
                  $readonly = in_array('url',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['url']=$menuEdit->getUrl();};
                  ?>
                  <label for="input-menu-url">Url</label>
  <input type="text" name="url" id="input-menu-url" class="form-control " placeholder="Enter Url " value="<?php echo null!==($menuEdit->getUrl())?($menuEdit->getUrl()):(isset($defaultValues['url'])?($defaultValues['url']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-menu-target">

                 <?php
                  $readonly = in_array('target',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['target']=$menuEdit->getTarget();};
                  ?>
                  <label for="input-menu-target">Target</label>
  <?php 
    include_once("../classes/menu-target.php");
    include_once("../daos/menu-target-dao.php");

    $menuTargetDao = new MenuTargetDao(); 
    $objects = $menuTargetDao->selectAll(); 
    ?>
    <select name="target" id="input-menu-target" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Menu&nbsp;target--</option>
      <?php
        foreach($objects as $menuTarget){
          $optionValue  = $menuTarget->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['target']) && $defaultValues['target']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['target']) && $defaultValues['target']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['target']) && $defaultValues['target']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$menuTarget->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-menu-parent-id">

                 <?php
                  $readonly = in_array('parentId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['parentId']=$menuEdit->getParentId();};
                  ?>
                  <label for="input-menu-parent-id">Parent</label>
  <?php 
    include_once("../classes/menu.php");
    include_once("../daos/menu-dao.php");

    $menuDao = new MenuDao(); 
    $objects = $menuDao->selectAll(); 
    ?>
    <select name="parentId" id="input-menu-parent-id" class="form-control "  <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Menu--</option>
      <?php
        foreach($objects as $menu){
          $optionValue  = $menu->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['parentId']) && $defaultValues['parentId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['parentId']) && $defaultValues['parentId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['parentId']) && $defaultValues['parentId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$menu->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-menu-profile-id">

                 <?php
                  $readonly = in_array('profileId',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['profileId']=$menuEdit->getProfileId();};
                  ?>
                  <label for="input-menu-profile-id">Profile*</label>
  <?php 
    include_once("../classes/_profile.php");
    include_once("../daos/_profile-dao.php");

    $profileDao = new ProfileDao(); 
    $objects = $profileDao->selectAll(); 
    ?>
    <select name="profileId" id="input-menu-profile-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select &nbsp;profile--</option>
      <?php
        foreach($objects as $profile){
          $optionValue  = $profile->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['profileId']) && $defaultValues['profileId']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['profileId']) && $defaultValues['profileId']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['profileId']) && $defaultValues['profileId']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$profile->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-menu-id-name">

                 <?php
                  $readonly = in_array('idName',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($menuEdit->getId()!=null){ $defaultValues['idName']=$menuEdit->getIdName();};
                  ?>
                  <label for="input-menu-id-name">Id&nbsp;Name</label>
  <input type="text" name="idName" id="input-menu-id-name" class="form-control " placeholder="Enter Id&nbsp;Name " value="<?php echo null!==($menuEdit->getIdName())?($menuEdit->getIdName()):(isset($defaultValues['idName'])?($defaultValues['idName']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
