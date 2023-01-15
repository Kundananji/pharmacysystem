<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM medicines WHERE id = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showMedicinesStock("0");
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showMedicinesStock($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $batch_id = $_GET["batch_id"];
      $expiry_date = ucwords($_GET["expiry_date"]);
      $quantity = ucwords($_GET["quantity"]);
      $mrp = ucwords($_GET["mrp"]);
      $rate = ucwords($_GET["rate"]);
      updateMedicineStock($id, $batch_id, $expiry_date, $quantity, $mrp, $rate);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showMedicinesStock("0");

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchMedicineStock(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showMedicinesStock($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.name = medicines_stock.name";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['batch_id'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showMedicineStockRow($seq_no, $row);
      }
    }
  }

  function showMedicineStockRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['packing']; ?></td>
      <td><?php echo $row['generic_name']; ?></td>
      <td><?php echo $row['batch_id']; ?></td>
      <td><?php echo $row['expiry_date']; ?></td>
      <td><?php echo $row['supplier_name']; ?></td>
      <td><?php echo $row['quantity']; ?></td>
      <td><?php echo $row['mrp']; ?></td>
      <td><?php echo $row['rate']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editMedicineStock('<?php echo $row['batch_id']; ?>');">
          <i class="fa fa-pencil"></i>
        </button>
        <!--
        <button class="btn btn-danger btn-sm" onclick="deleteMedicineStock(<?php echo $row['id']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      -->
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <!--<tr><td colspan="11"><?php //echo $row[5]; ?></tr>-->
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['packing']; ?></td>
    <td><?php echo $row['generic_name']; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['batch_id']; ?>" placeholder="Batch id" id="batch_id" onblur="notNull(this.value, 'batch_id_error');">
      <code class="text-danger small font-weight-bold float-right" id="batch_id_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['expiry_date']; ?>" placeholder="Expiry" id="expiry_date" onblur="checkExpiry(this.value, 'expiry_date_error');">
      <code class="text-danger small font-weight-bold float-right" id="expiry_date_error" style="display: none;"></code>
    </td>
    <td><?php echo $row['supplier_name']; ?></td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['quantity']; ?>" placeholder="quantity" id="quantity" onkeyup="checkquantity(this.value, 'quantity_error');">
      <code class="text-danger small font-weight-bold float-right" id="quantity_error" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['mrp']; ?>" placeholder="mrp" id="mrp" onkeyup="checkValue(this.value, 'mrp_error');">
      <code class="text-danger small font-weight-bold float-right" id="mrp_error" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['rate']; ?>" placeholder="rate" id="rate" onkeyup="checkValue(this.value, 'rate_error');">
      <code class="text-danger small font-weight-bold float-right" id="rate_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateMedicineStock(<?php echo $row[5]; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateMedicineStock($id, $batch_id, $expiry_date, $quantity, $mrp, $rate) {
  require "db_connection.php";
  $query = "UPDATE medicines_stock SET batch_id = '$batch_id', expiry_date = '$expiry_date', quantity = $quantity, mrp = $mrp, rate = $rate WHERE id = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showMedicinesStock("0");
}

function searchMedicineStock($text, $column) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;

    if($column == "expiry_date")
      $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.name = medicines_stock.name";
    else if($column == 'quantity')
      $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.name = medicines_stock.name WHERE medicines_stock.$column = 0";
    else
      $query = "SELECT * FROM medicines INNER JOIN medicines_stock ON medicines.name = medicines_stock.name WHERE UPPER(medicines.$column) LIKE '%$text%'";

    $result = mysqli_query($con, $query);

    if($column == 'expiry_date') {
      while($row = mysqli_fetch_array($result)) {
        $expiry_date = $row['expiry_date'];
        if(substr($expiry_date, 3) < date('y'))
          showMedicineStockRow($seq_no, $row);
        else if(substr($expiry_date, 3) == date('y')) {
          if(substr($expiry_date, 0, 2) < date('m'))
            showMedicineStockRow($seq_no, $row);
        }
      }
    }
    else {
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        showMedicineStockRow($seq_no, $row);
      }
    }
  }
}

?>
