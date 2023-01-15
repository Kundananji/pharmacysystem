<?php

if(isset($_GET['action']) && $_GET['action'] == "purchase")
  showPurchases($_GET['start_date'], $_GET['end_date']);

if(isset($_GET['action']) && $_GET['action'] == "sales")
  showSales($_GET['start_date'], $_GET['end_date']);

function showPurchases($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Purchase Date</th>
      <th>Voucher Number</th>
      <th>Invoice No</th>
      <th>Supplier name</th>
      <th>total Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM purchases";
    else
      $query = "SELECT * FROM purchases WHERE purchase_date BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showPurchaseRow($seq_no, $row);
      $total = $total + $row['total_amount'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="5" style="color: green;">&nbsp;total Purchases =</td>
        <td style="color: red;"><?php echo $total; ?></td>
      </tr>
    </tfoot>
    <?php
  }
}

function showPurchaseRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['purchase_date']; ?></td>
    <td><?php echo $row['voucher_number']; ?></td>
    <td><?php echo $row['invoice_number']; ?></td>
    <td><?php echo $row['supplier_name'] ?></td>
    <td><?php echo $row['total_amount']; ?></td>
  </tr>
  <?php
}

function showSales($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Sales Date</th>
      <th>Invoice Number</th>
      <th>Customer name</th>
      <th>total Amount</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.customer_id = customers.id";
    else
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.customer_id = customers.id WHERE invoice_date BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      //print_r($row);
      showSalesRow($seq_no, $row);
      $total = $total + $row['net_total'];
    }
    ?>
    </tbody>
    <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="4" style="color: green;">&nbsp;total Sales =</td>
        <td class="text-primary"><?php echo $total; ?></td>
      </tr>
    </tfoot>
    <?php
  }
}

function showSalesRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['invoice_date']; ?></td>
    <td><?php echo $row['invoice_id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['net_total'] ?></td>
  </tr>
  <?php
}

?>
