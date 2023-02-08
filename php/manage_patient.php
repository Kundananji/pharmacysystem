<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM patients WHERE id = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showCustomers(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showCustomers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $name = ucwords($_GET["name"]);
      $contact_number = $_GET["contact_number"];
      $address = ucwords($_GET["address"]);
      $doctor_name = ucwords($_GET["doctor_name"]);
      $doctor_address = ucwords($_GET["doctor_address"]);
      updateCustomer($id, $name, $contact_number, $address, $doctor_name, $doctor_address);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showCustomers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchCustomer(strtoupper($_GET["text"]));
  }

  function showCustomers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM patients";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['id'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showCustomerRow($seq_no, $row);
      }
    }
  }

  function showCustomerRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['id'] ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['contact_number']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['doctor_name']; ?></td>
      <td><?php echo $row['doctor_address']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editCustomer(<?php echo $row['id']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteCustomer(<?php echo $row['id']; ?>);">
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
    <td><?php echo $row['id'] ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['name']; ?>" placeholder="name" id="customer_name" onkeyup="validatename(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['contact_number']; ?>" placeholder="Contact Number" id="customer_contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="address" id="customer_address" onblur="validateaddress(this.value, 'address_error');"><?php echo $row['address']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['doctor_name']; ?>" placeholder="Doctor's name" id="customer_doctors_name" onkeyup="validatename(this.value, 'doctor_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="doctor_name_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Doctor's address" id="customer_doctors_address" onblur="validateaddress(this.value, 'doctor_address_error');"><?php echo $row['doctor_address']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="doctor_address_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateCustomer(<?php echo $row['id']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateCustomer($id, $name, $contact_number, $address, $doctor_name, $doctor_address) {
  require "db_connection.php";
  $query = "UPDATE patients SET name = '$name', contact_number = '$contact_number', address = '$address', doctor_name = '$doctor_name', doctor_address = '$doctor_address' WHERE id = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showCustomers(0);
}

function searchCustomer($text) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM patients WHERE UPPER(name) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showCustomerRow($seq_no, $row);
    }
  }
}

?>
