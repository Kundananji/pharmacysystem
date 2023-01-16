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
include_once("../classes/staff.php");
include_once("../daos/staff-dao.php");
$id = isset($_GET['id'])?filter_var($_GET['id'], FILTER_VALIDATE_INT):null;
$staffEdit = new Staff();
$staffEditDao = new StaffDao();
if(isset($id)){
  $tempObject = $staffEditDao->select($id);
  if($tempObject !=null){
    $staffEdit = $tempObject;
  }
}
?>
<form onsubmit = "Staff.submitFormStaff(event,{<?php echo sizeof($arguments)>0?(implode(",",$arguments)):null ?>})" method="post" enctype="multipart/form-data" action="#" id="form-staff">
<div class="alert alert-info">Fields marked with an asterisk(*) are required.</div>

  <input type="hidden" name="id" id="input-staff-id" value="<?php echo null!==($staffEdit->getId())?($staffEdit->getId()):(isset($defaultValues['id'])?($defaultValues['id']): "0");?>"/>

 <!--start of form group-->
<div class="form-group input-staff-name">

                 <?php
                  $readonly = in_array('name',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['name']=$staffEdit->getName();};
                  ?>
                  <label for="input-staff-name">Name*</label>
  <input type="text" name="name" id="input-staff-name" class="form-control " placeholder="Enter Name " value="<?php echo null!==($staffEdit->getName())?($staffEdit->getName()):(isset($defaultValues['name'])?($defaultValues['name']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-staff-title">

                 <?php
                  $readonly = in_array('title',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['title']=$staffEdit->getTitle();};
                  ?>
                  <label for="input-staff-title">Title*</label>
  <input type="text" name="title" id="input-staff-title" class="form-control " placeholder="Enter Title " value="<?php echo null!==($staffEdit->getTitle())?($staffEdit->getTitle()):(isset($defaultValues['title'])?($defaultValues['title']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-staff-position">

                 <?php
                  $readonly = in_array('position',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['position']=$staffEdit->getPosition();};
                  ?>
                  <label for="input-staff-position">Position*</label>
  <?php 
    include_once("../classes/job-position.php");
    include_once("../daos/job-position-dao.php");

    $jobPositionDao = new JobPositionDao(); 
    $objects = $jobPositionDao->selectAll(); 
    ?>
    <select name="position" id="input-staff-position" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Job&nbsp;position--</option>
      <?php
        foreach($objects as $jobPosition){
          $optionValue  = $jobPosition->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['position']) && $defaultValues['position']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['position']) && $defaultValues['position']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['position']) && $defaultValues['position']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$jobPosition->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-staff-phone-number">

                 <?php
                  $readonly = in_array('phoneNumber',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['phoneNumber']=$staffEdit->getPhoneNumber();};
                  ?>
                  <label for="input-staff-phone-number">Phone&nbsp;Number*</label>
  <input type="text" name="phoneNumber" id="input-staff-phone-number" class="form-control " placeholder="Enter Phone&nbsp;Number " value="<?php echo null!==($staffEdit->getPhoneNumber())?($staffEdit->getPhoneNumber()):(isset($defaultValues['phoneNumber'])?($defaultValues['phoneNumber']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-staff-address">

                 <?php
                  $readonly = in_array('address',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['address']=$staffEdit->getAddress();};
                  ?>
                  <label for="input-staff-address">Address*</label>
  <textarea rows="5" name="address" id="input-staff-address" class="form-control " placeholder="Enter Address " required<?php echo $readonly;?>   ><?php echo null!==($staffEdit->getAddress())?($staffEdit->getAddress()):(isset($defaultValues['address'])?($defaultValues['address']): "");?></textarea>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-staff-nationaility">

                 <?php
                  $readonly = in_array('nationaility',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['nationaility']=$staffEdit->getNationaility();};
                  ?>
                  <label for="input-staff-nationaility">Nationaility*</label>
  <input type="text" name="nationaility" id="input-staff-nationaility" class="form-control " placeholder="Enter Nationaility " value="<?php echo null!==($staffEdit->getNationaility())?($staffEdit->getNationaility()):(isset($defaultValues['nationaility'])?($defaultValues['nationaility']): "");?>" required <?php echo $readonly;?>   />
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-staff-status">

                 <?php
                  $readonly = in_array('status',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['status']=$staffEdit->getStatus();};
                  ?>
                  <label for="input-staff-status">Status*</label>
  <?php 
    include_once("../classes/status.php");
    include_once("../daos/status-dao.php");

    $statusDao = new StatusDao(); 
    $objects = $statusDao->selectAll(); 
    ?>
    <select name="status" id="input-staff-status" class="form-control " required <?php echo $readonly;?> >
      <option value="" <?php echo $readonly=='readonly'?'disabled hidden':'';?>>--Select Status--</option>
      <?php
        foreach($objects as $status){
          $optionValue  = $status->getId();
          $hidden  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"hidden":"" ;
          $disabled  =  $readonly=='readonly' && isset($defaultValues['status']) && $defaultValues['status']!=$optionValue?"disabled":"" ;
          $selected  =  isset($defaultValues['status']) && $defaultValues['status']==$optionValue? "selected" : "" ;
          echo'<option value="'.$optionValue.'" '.$selected.' '.$hidden.' '.$hidden.' '.$selected.'>'.$status->toString().'</option>';
        }
      ?>
    </select>
</div> <!--end form-group-->

 <!--start of form group-->
<div class="form-group input-staff-man-no">

                 <?php
                  $readonly = in_array('manNo',$uneditableFields)?'readonly':'';
                  //override default value with actual value if object is sent
                  if($staffEdit->getId()!=null){ $defaultValues['manNo']=$staffEdit->getManNo();};
                  ?>
                  <label for="input-staff-man-no">Man&nbsp;No</label>
  <input type="text" name="manNo" id="input-staff-man-no" class="form-control " placeholder="Enter Man&nbsp;No " value="<?php echo null!==($staffEdit->getManNo())?($staffEdit->getManNo()):(isset($defaultValues['manNo'])?($defaultValues['manNo']): "");?>"  <?php echo $readonly;?>   />
</div> <!--end form-group-->
<input id="form-submit-button" type="submit" name="submit" value="Save" class="btn btn-primary"/>
<div id="form-submit-feedback mt-4"></div> <!--  form feedback -->
</form> <!--  end of form -->
