<?php

  if(isset($_GET['action']) && $_GET['action'] == 'is_setup_done')
    isSetupDone();

  function isSetupDone() {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM users";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'is_admin')
  isAdmin();
 

  function isAdmin() {
    require "db_connection.php";
    if($con) {
      $username = $_GET["uname"];
      $password = $_GET["pswd"];

      $query = "SELECT * FROM users WHERE USERname = '$username' AND PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      if($row)  {
        $query = "UPDATE users SET IS_LOGGED_IN = 'true'";
        $result = mysqli_query($con, $query);
        echo "true";
      }
      else{
            
             isUser();
      }       
    }
  }

  //isUser login
  function isUser() {
    require "db_connection.php";
    if($con) {
      $username = $_GET["uname"];
      $password = $_GET["pswd"];

      $query = "SELECT * FROM users WHERE USERname = '$username' AND PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      if($row)  {
        $query = "UPDATE users SET IS_LOGGED_IN = 'true'";
        $result = mysqli_query($con, $query);
        echo "true";
      }
      else
        echo "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'store_admin_info')
    storeAdminData();

  function storeAdminData() {
    require "db_connection.php";
    if($con) {
      $pharmacy_name = $_GET["pharmacy_name"];
      $address = $_GET["address"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];
      $username = $_GET["username"];
      $password = $_GET["password"];

      $query = "INSERT INTO users (PHARMACY_name, address, email, contact_number, USERname, PASSWORD, IS_LOGGED_IN) VALUES('$pharmacy_name', '$address', '$email', '$contact_number', '$username', '$password', 'false')";
      $result = mysqli_query($con, $query);
      echo ($result) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'verify_email_number')
    verifyemailNumber();

  function verifyemailNumber() {
    require "db_connection.php";
    if($con) {
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];

      $query = "SELECT * FROM users WHERE email = '$email' AND contact_number = '$contact_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'update_username_password')
    updateUsernamePassword();

  function updateUsernamePassword() {
    require "db_connection.php";
    if($con) {
      $username = $_GET["username"];
      $password = $_GET["password"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];

      $query = "UPDATE users SET USERname = '$username', PASSWORD = '$password' WHERE email = '$email' AND contact_number = '$contact_number'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'validate_password')
    validatePassword();

  function validatePassword() {
    require "db_connection.php";
    if($con) {
      $password = $_GET["password"];

      $query = "SELECT * FROM users WHERE PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'update_admin_info')
    updateAdminInfo();

  function updateAdminInfo() {
    require "db_connection.php";
    if($con) {
      $pharmacy_name = $_GET["pharmacy_name"];
      $address = $_GET["address"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];
      $username = $_GET["username"];

      $query = "UPDATE users SET PHARMACY_name = '$pharmacy_name', address = '$address', email = '$email', contact_number = '$contact_number', USERname = '$username'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "Details updated..." : "Oops! Somthing wrong happend...";
    }
  }

  if(isset($_GET['action']) && $_GET['action'] == 'change_password')
    changePassword();

  function changePassword() {
    require "db_connection.php";
    if($con) {
      $password = $_GET["password"];

      $query = "UPDATE users SET PASSWORD = '$password'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "Password changed..." : "Oops! Somthing wrong happend...";
    }
  }

 ?>
