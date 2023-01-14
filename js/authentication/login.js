
 
 let UserAuthentication  = (function($) {
  "use strict";

  //function to check the session
  let sessionChecker = () =>{
    console.log('Session','checking user session');
      $.ajax({
        url: "authentication/session-tracker.php",
        type: "post",
        dataType:"json",
        success: (data)=>{    
          if(data){    
            if(data.status == "USER_LOGGED_OUT"){
              if(window.location.href.indexOf('dashboard')!==-1){
                swal(data.title,"Your session has expired. Please login to continue...","warning");
                window.location = "login";
              }
            }
          
          }
        }
      });
  }

  //function to switch profiles
  let switchProfile = (data) =>{
    
      $.ajax({
        url: "authentication/switch-profile.php",
        type: "post",
        dataType:"json",
        data:data,
        success: (data)=>{    
          if(data){    
            if(data.status == "success"){
                swal(data.title,"Profile Switched Successfully","success");
                window.location.reload();        //reload      
            }
            else{
              swal(data.title,"Failed to Switch Profile","warning");

            }
          
          }
        }
      });
  }

  //function to set main sesison value
  let setMainSession = (label) =>{

    let setterInput = $('#setter-input').val();
    let sessionField =$('#session-field').val();

    if(isEmpty(setterInput)){
       swal('Missing Input','Please specify the '+label+' to switch to ','warning');
    }
    if(isEmpty(sessionField)){
      swal('Missing Input','Please specify the field to set ','warning');
   }
    
    $.ajax({
      url: "authentication/set-main-session.php",
      type: "post",
      dataType:"json",
      data:{
        setter_input: setterInput,
        session_field: sessionField
      
      },
      success: (data)=>{    
        if(data){    
          if(data.status == "success"){
              swal(data.title,"Switched "+data.label+" Successfully!","success");
              window.location.reload();              
          }
          else{
            swal(data.title,"Failed to Switch "+data.label,"warning");

          }
        
        }
      }
    });
}



//function to load account setting form
  let AccountSettingsForm = () =>{
    //laod modal
    $('#generalModal').modal('show');
    //show preloader
    loader($('#generalModalBody'));

      $.ajax({
        url: "authentication/load-user-account-settings-form.php",
        type: "get",
        success: (data)=>{
          $('#generalModalBody').html(data);  $('#form-save-account-details').on('submit',(e)=>{
  e.preventDefault();
  let oForm = document.getElementById('form-save-account-details');
  let elements = oForm.elements;
  let data = {};
  for(let i=0; i<elements.length; i++){
    let element = elements[i];
    data[element.name]=element.value;
  };
  $.ajax({
    url: "authentication/save-user-account-details.php",
    type: "post",
    dataType:"json",
    data:data,
    success: (data)=>{
      if(data.status == "success"){
        swal(data.title,data.message,'success');
      }else{
        swal(data.title,data.message,'warning');
      }
    }
  });
});
      }
      });
  }


    $(document).ready(()=>{ //only fire off events when page loads successfully

      //check session after every 3 mins
      setInterval(sessionChecker, 180000);

      $("#link-login").off().on("click",(e)=>{    
        e.preventDefault();   
    
        let email = $("#inputEmail").val();
        let password = $("#inputPassword").val();
        let rememberMe = false; 
        if(document.getElementById("checkbox-remember-me")){
          rememberMe = $("#checkbox-remember-me");  
        }      
    
      if(isEmpty(email)){
        swal("Email Missing","Please Enter Email Before Proceeding","warning");
        return;
      }
    
      if(isEmpty(password)){
        swal("Password Missing","Please Enter Password Before Proceeding","warning");
        return;
      }
    
      let data = {
        password:password,
        email:email,
        rememberMe:rememberMe.is(":checked")
      }
    
      $.ajax({
        url: "authentication/login.php",
        type: "post",
        dataType:"json",
        data:data,
        success: (data)=>{
    
          if(data && data.status == "success"){    
              swal(data.title,"Success! You have been logged in","success");
              if(data.params){
                window.location = "dashboard?"+data.params;

              }
              else{
                window.location = "dashboard";
              }
          }else{
            swal(data.title,data.message,"warning");
          }
        }
      });  
    
    });  

    $('#form-registration').on('submit',(e)=>{
  e.preventDefault();
  let oForm = document.getElementById('form-registration');
  let elements = oForm.elements;
  let data = {};
  for(let i=0; i<elements.length; i++){
    let element = elements[i];
    data[element.name]=element.value;
  };
  $.ajax({
    url: "authentication/register-user.php",
    type: "post",
    dataType:"json",
    data:data,
    success: (data)=>{
      if(data.status == "success"){
        window.location="login"
        swal(data.title,data.message,'success');
      }else{
        swal(data.title,data.message,'warning');
      }
    }
  });
});

  $("#link-logout").off().on('click',()=>{
    $.ajax({
      url: "authentication/logout.php",
      type: "post",
      dataType:"json",
      success: (data)=>{

        if(data && data.status == "success"){    
            swal(data.title,"Success! You have been logged out","success");
            window.location = "login"
        }else{
          swal(data.title,data.message,"warning");
        }
      }
    });  
  });

  
  $('#link-reset-password').off().on('click',(e)=>{

    swal({
      title: "Enter your Email address",
      text: "Enter the email of your account. We shall send you the password reset link:",
      type: "input",
      showCancelButton: true,
      closeOnConfirm: false,
      animation: "slide-from-top",
      inputPlaceholder: "Enter Email"
    },
    function(email){
      if (email === null) return false;
      
      if (!email) {
        return false

      }

      if ( isEmpty(email)) {
        swal.showInputError("Please enter your email!");
        return false

      }


      $.ajax({
        url: "authentication/reset-password-request.php",
        type: "post",
        dataType:"json",
        data:{
          email:email
        },
        success: (data)=>{
    
          if(data && data.status == "success"){
      
            swal(data.title,"Your request has been successfully sent. If the email exists, we have sent the password reset instructions to it.",'success');
            
          }else{
            swal(data.title,data.message,'warning');
          }
        }
      });    
       
    });

  })


  $('#buttonResetPassword').off().on('click',(e)=>{
    e.preventDefault();

   let email = $('#email').val();
   let password = $('#password').val();
   let confirmPassword = $('#confirm-password').val();
   let resetId = $('#reset-id').val();

   if(isEmpty(resetId)){
    swal('Request Expired','Your request has expired or is invalid','warning');
    return;
   }


   if(isEmpty(email)){
    swal('Email Missing','Please Enter Email Before Proceeding','warning');
    return;
   }

   if(isEmpty(password)){
    swal('Password Missing','Please Enter Password Before Proceeding','warning');
    return;
   }

   if(password!=confirmPassword){
    swal('Passwords do not Match','Entered Passwords do not match','warning');
    return;
   }

   let data = {
     password:password,
     email:email,
     confirmPassword:confirmPassword,
     resetId:resetId
   }

   $.ajax({
    url: "authentication/reset-password-complete.php",
    type: "post",
    dataType:"json",
    data:data,
    success: (data)=>{

      if(data && data.status == "success"){
  
        swal(data.title,"Success! Your password has been successfully reset! You can now login.",'success');
        window.location="login.php";
  
      }else{
        swal(data.title,data.message,'warning');
      }
    }
  });  

  });
  
  });//end document ready function

  return {
    AccountSettingsForm:AccountSettingsForm,
    setMainSession:setMainSession,
    switchProfile:switchProfile,
    sessionChecker:sessionChecker
  }

  })(jQuery); // End of use strict 
 
 