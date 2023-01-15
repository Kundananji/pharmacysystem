<?php

  if(isset($_GET['action']) && $_GET['action'] == "add_row")
    createMedicineInfoRow();

  if(isset($_GET['action']) && $_GET['action'] == "is_customer")
    isCustomer(strtoupper($_GET['name']), $_GET['contact_number']);

  if(isset($_GET['action']) && $_GET['action'] == "is_invoice")
    isInvoiceExist($_GET['invoice_number']);

  if(isset($_GET['action']) && $_GET['action'] == "is_medicine")
    isMedicine(strtoupper($_GET['name']));

  if(isset($_GET['action']) && $_GET['action'] == "current_invoice_number")
    getInvoiceNumber();

  if(isset($_GET['action']) && $_GET['action'] == "medicine_list")
    showMedicineList(strtoupper($_GET['text']));

  if(isset($_GET['action']) && $_GET['action'] == "fill")
    fill(strtoupper($_GET['name']), $_GET['column']);

  if(isset($_GET['action']) && $_GET['action'] == "check_quantity")
    checkAvailablequantity(strtoupper($_GET['medicine_name']));

  if(isset($_GET['action']) && $_GET['action'] == "update_stock")
    updateStock(strtoupper($_GET['name']), $_GET['batch_id'], intval($_GET['quantity']));

  if(isset($_GET['action']) && $_GET['action'] == "add_sale")
    addSale();

  if(isset($_GET['action']) && $_GET['action'] == "add_new_invoice")
    addNewInvoice();

  function isCustomer($name, $contact_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM customers WHERE UPPER(name) = '$name' AND contact_number = '$contact_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function isInvoiceExist($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM sales WHERE invoice_number = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function isMedicine($name) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM medicines_stock WHERE UPPER(name) = '$name'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? "true" : "false";
    }
  }

  function createMedicineInfoRow() {
    $row_id = $_GET['row_id'];
    $row_number = $_GET['row_number'];
    ?>
    <div class="row col col-md-12">
      <div class="col-md-2">
        <input id="medicine_name_<?php echo $row_number; ?>" name="medicine_name" class="form-control" list="medicine_list_<?php echo $row_number; ?>" placeholder="Select Medicine" onkeydown="medicineOptions(this.value, 'medicine_list_<?php echo $row_number; ?>');" onfocus="medicineOptions(this.value, 'medicine_list_<?php echo $row_number; ?>');" onchange="fillFields(this.value, '<?php echo $row_number; ?>');">
        <code class="text-danger small font-weight-bold float-right" id="medicine_name_error_<?php echo $row_number; ?>" style="display: none;"></code>
        <datalist id="medicine_list_<?php echo $row_number; ?>" style="display: none; max-height: 200px; overflow: auto;">
          <?php showMedicineList("") ?>
        </datalist>
      </div>
      <div class="col col-md-2"><input type="text" class="form-control" id="batch_id_<?php echo $row_number; ?>" disabled></div>
      <div class="col col-md-1"><input type="number" class="form-control" id="available_quantity_<?php echo $row_number; ?>" disabled></div>
      <div class="col col-md-1"><input type="text" class="form-control" id="expiry_date_<?php echo $row_number; ?>" disabled></div>
      <div class="col col-md-1">
        <input type="number" class="form-control" id="quantity_<?php echo $row_number; ?>" value="0" onkeyup="gettotal('<?php echo $row_number; ?>');" onblur="checkAvailablequantity(this.value, '<?php echo $row_number; ?>');">
        <code class="text-danger small font-weight-bold float-right" id="quantity_error_<?php echo $row_number; ?>" style="display: none;"></code>
      </div>
      <div class="col col-md-1"><input type="number" class="form-control" id="mrp_<?php echo $row_number; ?>" onchange="gettotal('<?php echo $row_number; ?>');" disabled></div>
      <div class="col col-md-1">
        <input type="number" class="form-control" id="discount_<?php echo $row_number; ?>" value="0" onkeyup="gettotal('<?php echo $row_number; ?>');">
        <code class="text-danger small font-weight-bold float-right" id="discount_error_<?php echo $row_number; ?>" style="display: none;"></code>
      </div>
      <div class="col col-md-1"><input type="number" class="form-control" id="total_<?php echo $row_number; ?>" disabled></div>
      <div class="col col-md-2">
        <button class="btn btn-primary" onclick="addRow();">
          <i class="fa fa-plus"></i>
        </button>
        <button class="btn btn-danger"  onclick="removeRow('<?php echo $row_id ?>');">
          <i class="fa fa-trash"></i>
        </button>
      </div>
    </div>
    <div class="col col-md-12">
      <hr class="col-md-12" style="padding: 0px;">
    </div>
    <?php
  }

  function getInvoiceNumber() {
    require 'db_connection.php';
    if($con) {
      $query = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'pharmacy' AND TABLE_name = 'invoices';";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo $row['AUTO_INCREMENT'];
    }
  }

  function showMedicineList($text) {
    require 'db_connection.php';
    if($con) {
      if($text == "")
        $query = "SELECT * FROM medicines_stock";
      else
        $query = "SELECT * FROM medicines_stock WHERE UPPER(name) LIKE '%$text%'";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result))
        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
    }
  }

  function fill($name, $column) {
    require 'db_connection.php';
    if($con) {
      $query = "SELECT * FROM medicines_stock WHERE UPPER(name) = '$name'";
      $result = mysqli_query($con, $query);
      if(mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_array($result);
        echo $row[$column];
      }
    }
  }

  function checkAvailablequantity($name) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT quantity FROM medicines_stock WHERE UPPER(name) = '$name'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      echo ($row) ? $row['quantity'] : "false";
    }
  }

  function updateStock($name, $batch_id, $quantity) {
    require "db_connection.php";
    if($con) {
      $query = "UPDATE medicines_stock SET quantity = quantity - $quantity WHERE UPPER(name) = '$name' AND batch_id = '$batch_id'";
      $result = mysqli_query($con, $query);
      echo ($result) ? "stock updated" : "failed to update stock";
    }
  }

  function getCustomerid($name, $contact_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT id FROM customers WHERE UPPER(name) = '$name' AND contact_number = '$contact_number'";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      return ($row) ? $row['id'] : 0;
    }
  }

  function addSale() {
    $customer_id = getCustomerid(strtoupper($_GET['customers_name']), $_GET['customers_contact_number']);
    $invoice_number = $_GET['invoice_number'];
    $medicine_name = $_GET['medicine_name'];
    $batch_id = $_GET['batch_id'];
    $expiry_date = $_GET['expiry_date'];
    $quantity = $_GET['quantity'];
    $mrp = $_GET['mrp'];
    $discount = $_GET['discount'];
    $total = $_GET['total'];

    require "db_connection.php";
    if($con) {
      $query = "INSERT INTO sales (customer_id, invoice_number, medicine_name, batch_id, expiry_date, quantity, mrp, discount, total) VALUES($customer_id, $invoice_number, '$medicine_name', '$batch_id', '$expiry_date', $quantity, $mrp, $discount, $total)";
      $result = mysqli_query($con, $query);
      echo ($result) ? "inserted sale" : "falied to add sale...";
    }
  }

  function addNewInvoice() {
    $customer_id = getCustomerid(strtoupper($_GET['customers_name']), $_GET['customers_contact_number']);
    $invoice_date = $_GET['invoice_date'];
    //$payment_status = ($_GET['payment_type'] == "");
    $total_amount = $_GET['total_amount'];
    $total_discount = $_GET['total_discount'];
    $net_total = $_GET['net_total'];

    require "db_connection.php";
    if($con) {
      $query = "INSERT INTO invoices (customer_id, invoice_date, total_amount, total_discount, net_total) VALUES($customer_id, '$invoice_date', $total_amount, $total_discount, $net_total)";
      $result = mysqli_query($con, $query);
      echo ($result) ? "Invoice saved..." : "falied to add invoice...";
    }
  }
?>
