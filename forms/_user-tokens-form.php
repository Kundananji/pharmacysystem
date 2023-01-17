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
include_once("../classes/_user-tokens.php");
include_once("../daos/_user-tokens-dao.php");
$arguments=array();$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$userTokensEdit = new UserTokens();
$userTokensEditDao = new UserTokensDao();
if(isset($id)){
  $tempObject = $userTokensEditDao->select($id);
  if($tempObject !=null){
    $userTokensEdit = $tempObject;
  }
}
?>
<form onsubmit = "UserTokens.submitFormUserTokens(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-_user-tokens">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-_user-tokens-id" value="<?php echo null!==($userTokensEdit->getId())?($userTokensEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-_user-tokens-selector">

                 <?php
                  $readonly = in_array('selector',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($userTokensEdit->getId()!=null){ $defaultValues['selector']=$userTokensEdit->getSelector();};
                  ?>
                  <label for="input-_user-tokens-selector">Selector*</label>
  <input type="text" name="selector" id="input-_user-tokens-selector" class="form-control " placeholder="Enter Selector " value="<?php echo null!==($userTokensEdit->getSelector())?($userTokensEdit->getSelector()):(isset($defaultValues['selector'])?($defaultValues['selector']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-_user-tokens-hashed-validator">

                 <?php
                  $readonly = in_array('hashed_validator',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($userTokensEdit->getId()!=null){ $defaultValues['hashed_validator']=$userTokensEdit->getHashedValidator();};
                  ?>
                  <label for="input-_user-tokens-hashed-validator">Hashed&nbsp;Validator*</label>
  <input type="text" name="hashedValidator" id="input-_user-tokens-hashed-validator" class="form-control " placeholder="Enter Hashed&nbsp;Validator " value="<?php echo null!==($userTokensEdit->getHashedValidator())?($userTokensEdit->getHashedValidator()):(isset($defaultValues['hashed_validator'])?($defaultValues['hashed_validator']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-_user-tokens-user-id">

                 <?php
                  $readonly = in_array('user_id',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($userTokensEdit->getId()!=null){ $defaultValues['user_id']=$userTokensEdit->getUserId();};
                  ?>
                  <label for="input-_user-tokens-user-id">User&nbsp;*</label>
  <?php 
    include_once("../classes/users.php");
    include_once("../daos/users-dao.php");

    $usersDao = new UsersDao(); 
    $objects = $usersDao->selectAll(); 
    ?>
    <select name="userId" id="input-_user-tokens-user-id" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Users--</option>
      <?php
        foreach($objects as $users){
          $optionValue  = $users->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['user_id']) && $defaultValues['user_id']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['user_id']) && $defaultValues['user_id']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['user_id']) && $defaultValues['user_id']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$users->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-_user-tokens-expiry">

                 <?php
                  $readonly = in_array('expiry',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($userTokensEdit->getId()!=null){ $defaultValues['expiry']=$userTokensEdit->getExpiry();};
                  ?>
                  <label for="input-_user-tokens-expiry">Expiry*</label>
  <input type="text" name="expiry" id="input-_user-tokens-expiry" class="form-control datepicker " placeholder="Enter Expiry " value="<?php echo null!==($userTokensEdit->getExpiry())?(date("d/m/Y",strtotime($userTokensEdit->getExpiry()))):(isset($defaultValues['expiry'])?($defaultValues['expiry']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
