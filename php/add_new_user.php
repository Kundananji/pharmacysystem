<?php
  require "db_connection.php";
  if($con) {
      $pharmacy_name = "test pharmacy";
      $fname = $_GET["fname"];
      $sname = $_GET["sname"];
      $address = $_GET["address"];
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];
      $username = $_GET["email"];
      $password = "12345";
      $role = $_GET["role"];
      $status = $_GET["status"];

    $query = "SELECT * FROM users WHERE UPPER(USERname) = '".strtoupper($username)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "User with email $email already exists!";
    else {
      $query = "INSERT INTO users (PHARMACY_name, Fname, Sname, address, email, contact_number, USERname, PASSWORD, IS_LOGGED_IN, ROLE, STATUS) VALUES('$pharmacy_name', '$fname' , '$sname', '$address', '$email', '$contact_number', '$username', '$password', 'false', '$role', '$status')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$email added...";
  		else
  			echo "Failed to add $email!";
    }
  }
?>