<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    $email = $_GET["email"];
    $contact_number = $_GET["contact_number"];
    $address = ucwords($_GET["address"]);

    $query = "SELECT * FROM suppliers WHERE UPPER(name) = '".strtoupper($name)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Supplier with name $name already exists!";
    else {
      $query = "INSERT INTO suppliers (name, email, contact_number, address) VALUES('$name', '$email', '$contact_number', '$address')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
?>
