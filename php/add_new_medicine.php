<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    $packing = strtoupper($_GET["packing"]);
    $generic_name = ucwords($_GET["generic_name"]);
    $suppliers_name = $_GET["suppliers_name"];

    $query = "SELECT * FROM medicines WHERE UPPER(name) = '".strtoupper($name)."' AND UPPER(packing) = '".strtoupper($packing)."' AND UPPER(supplier_name) = '".strtoupper($suppliers_name)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Medicine $name with $packing already exists by supplier $suppliers_name!";
    else {
      $query = "INSERT INTO medicines (name, packing, generic_name, supplier_name) VALUES('$name', '$packing', '$generic_name', '$suppliers_name')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
?>
