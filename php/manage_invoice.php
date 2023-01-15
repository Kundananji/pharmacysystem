<?php

  if(isset($_GET["action"]) && $_GET["action"] == "delete") {
    require "db_connection.php";
    $invoice_number = $_GET["invoice_number"];
    $query = "DELETE FROM invoices WHERE invoice_id = $invoice_number";
    $result = mysqli_query($con, $query);
    if(!empty($result))
  		showInvoices();
  }

  if(isset($_GET["action"]) && $_GET["action"] == "refresh")
    showInvoices();

  if(isset($_GET["action"]) && $_GET["action"] == "search")
    searchInvoice(strtoupper($_GET["text"]), $_GET["tag"]);

  if(isset($_GET["action"]) && $_GET["action"] == "print_invoice")
    printInvoice($_GET["invoice_number"]);

  function showInvoices() {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.customer_id = customers.id";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function showInvoiceRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['invoice_id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['invoice_date']; ?></td>
      <td><?php echo $row['total_amount']; ?></td>
      <td><?php echo $row['total_discount']; ?></td>
      <td><?php echo $row['net_total']; ?></td>
      <td>
        <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['invoice_id']; ?>);">
          <i class="fa fa-fax"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['invoice_id']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

  function searchInvoice($text, $column) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      if($column == 'invoice_id')
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.customer_id = customers.id WHERE CAST(invoices.$column AS VARCHAR(9)) LIKE '%$text%'";
      else if($column == "invoice_date")
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.customer_id = customers.id WHERE invoices.$column = '$text'";
      else
        $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.customer_id = customers.id WHERE UPPER(customers.$column) LIKE '%$text%'";

      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showInvoiceRow($seq_no, $row);
      }
    }
  }

  function printInvoice($invoice_number) {
    require "db_connection.php";
    if($con) {
      $query = "SELECT * FROM sales INNER JOIN customers ON sales.customer_id = customers.id WHERE invoice_number = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $customer_name = $row['name'];
      $address = $row['address'];
      $contact_number = $row['contact_number'];
      $doctor_name = $row['doctor_name'];
      $doctor_address = $row['doctor_address'];

      $query = "SELECT * FROM invoices WHERE invoice_id = $invoice_number";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $invoice_date = $row['invoice_date'];
      $total_amount = $row['total_amount'];
      $total_discount = $row['total_discount'];
      $net_total = $row['net_total'];
    }

    ?>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 h3" style="color: #ff5252;">Customer Invoice<span class="float-right">Invoice Number : <?php echo $invoice_number; ?></span></div>
    </div>
    <div class="row font-weight-bold">
      <div class="col-md-1"></div>
      <div class="col-md-10"><span class="h4 float-right">Invoice Date. : <?php echo $invoice_date; ?></span></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-4">
        <span class="h4">Customer Details : </span><br><br>
        <span class="font-weight-bold">name : </span><?php echo $customer_name; ?><br>
        <span class="font-weight-bold">address : </span><?php echo $address; ?><br>
        <span class="font-weight-bold">Contact Number : </span><?php echo $contact_number; ?><br>
        <span class="font-weight-bold">Doctor's name : </span><?php echo $doctor_name; ?><br>
        <span class="font-weight-bold">Doctor's address : </span><?php echo $doctor_address; ?><br>
      </div>
      <div class="col-md-3"></div>

      <?php

      $query = "SELECT * FROM users";
      $result = mysqli_query($con, $query);
      $row = mysqli_fetch_array($result);
      $p_name = $row['PHARMACY_name'];
      $p_address = $row['address'];
      $p_email = $row['email'];
      $p_contact_number = $row['contact_number'];
      ?>

      <div class="col-md-4">
        <span class="h4">Shop Details : </span><br><br>
        <span class="font-weight-bold"><?php echo $p_name; ?></span><br>
        <span class="font-weight-bold"><?php echo $p_address; ?></span><br>
        <span class="font-weight-bold"><?php echo $p_email; ?></span><br>
        <span class="font-weight-bold">Mob. No.: <?php echo $p_contact_number; ?></span>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 table-responsive">
        <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
          <thead>
            <tr>
              <th>SL</th>
              <th>Medicine name</th>
              <th>Expiry Date</th>
              <th>quantity</th>
              <th>mrp</th>
              <th>discount</th>
              <th>total</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $seq_no = 0;
              $total = 0;
              $query = "SELECT * FROM sales WHERE invoice_number = $invoice_number";
              $result = mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                $seq_no++;
                ?>
                <tr>
                  <td><?php echo $seq_no; ?></td>
                  <td><?php echo $row['medicine_name']; ?></td>
                  <td><?php echo $row['expiry_date']; ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo $row['mrp']; ?></td>
                  <td><?php echo $row['discount']."%"; ?></td>
                  <td><?php echo $row['total']; ?></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
          <tfoot class="font-weight-bold">
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="6">&nbsp;total Amount</td>
              <td><?php echo $total_amount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 18px;">
              <td colspan="6">&nbsp;total discount</td>
              <td><?php echo $total_discount; ?></td>
            </tr>
            <tr style="text-align: right; font-size: 22px;">
              <td colspan="6" style="color: green;">&nbsp;Net Amount</td>
              <td class="text-primary"><?php echo $net_total; ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="col-md-1"></div>
    </div>
    <div class="row text-center">
      <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
    </div>
    <?php
  }

?>
