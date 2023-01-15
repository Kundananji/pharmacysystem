<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM medicines WHERE id = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showMedicines(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showMedicines($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      $packing = strtoupper($_GET["packing"]);
      $generic_name = ucwords($_GET["generic_name"]);
      $suppliers_name = ucwords($_GET["suppliers_name"]);
      updateMedicine($id, $name, $packing, $generic_name, $suppliers_name);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showMedicines(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchMedicine(strtoupper($_GET["text"]), $_GET["tag"]);
  }

  function showMedicines($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM medicines";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['id'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showMedicineRow($seq_no, $row);
      }
    }
  }

  function showMedicineRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['packing']; ?></td>
      <td><?php echo $row['generic_name']; ?></td>
      <td><?php echo $row['supplier_name']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editMedicine(<?php echo $row['id']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteMedicine(<?php echo $row['id']; ?>);">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
    <?php
  }

function showEditOptionsRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['name']; ?>" placeholder="Medicine name" id="medicine_name" onblur="notNull(this.value, 'medicine_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="medicine_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['packing']; ?>" placeholder="packing" id="packing" onblur="notNull(this.value, 'pack_error');">
      <code class="text-danger small font-weight-bold float-right" id="pack_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['generic_name']; ?>" placeholder="Generic name" id="generic_name" onblur="notNull(this.value, 'generic_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="generic_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['supplier_name']; ?>" placeholder="Supplier name" id="suppliers_name" onblur="notNull(this.value, 'supplier_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="supplier_name_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateMedicine(<?php echo $row['id']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateMedicine($id, $name, $packing, $generic_name, $suppliers_name) {
  require "db_connection.php";
  $query = "UPDATE medicines SET name = '$name', packing = '$packing', generic_name = '$generic_name', supplier_name = '$suppliers_name' WHERE id = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showMedicines(0);
}

function searchMedicine($text, $tag) {
  require "db_connection.php";
  if($tag == "name")
    $column = "name";
  if($tag == "generic_name")
    $column = "generic_name";
  if($tag == "suppliers_name")
    $column = "supplier_name";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM medicines WHERE UPPER($column) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showMedicineRow($seq_no, $row);
    }
  }
}

?>
