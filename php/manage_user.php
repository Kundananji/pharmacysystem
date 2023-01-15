<?php
  require "db_connection.php";

  if($con) {
    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
      $id = $_GET["id"];
      $query = "DELETE FROM users WHERE id = $id";
      $result = mysqli_query($con, $query);
      if(!empty($result))
    		showUsers(0);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "edit") {
      $id = $_GET["id"];
      showUsers($id);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "update") {
      $id = $_GET["id"];
      $fname = ucwords($_GET["firstName"]);
      $sname = ucwords($_GET["lastName"]);
      $email = $_GET["email"];
      $contact_number = $_GET["contact_number"];
      $address = ucwords($_GET["address"]);
      $role = ucwords($_GET["role"]);
      $status = ucwords($_GET["status"]);
      updateUser($id, $name, $email, $contact_number, $address, $role, $status);
    }

    if(isset($_GET["action"]) && $_GET["action"] == "cancel")
      showUsers(0);

    if(isset($_GET["action"]) && $_GET["action"] == "search")
      searchUser(strtoupper($_GET["text"]));
  }

  function showUsers($id) {
    require "db_connection.php";
    if($con) {
      $seq_no = 0;
      $query = "SELECT * FROM users";
      $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $seq_no++;
        if($row['id'] == $id)
          showEditOptionsRow($seq_no, $row);
        else
          showUserRow($seq_no, $row);
      }
    }
  }

  function showUserRow($seq_no, $row) {
    ?>
    <tr>
      <td><?php echo $seq_no; ?></td>
      <td><?php echo $row['firstName']; ?></td>
      <td><?php echo $row['lastName']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['contactNumber']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td><?php echo $row['ROLE']; ?></td>
      <td><?php echo $row['STATUS']; ?></td>
      <td>
        <button href="" class="btn btn-info btn-sm" onclick="editUser(<?php echo $row['id']; ?>);">
          <i class="fa fa-pencil"></i>
        </button>
        <button class="btn btn-danger btn-sm" onclick="deleteUser(<?php echo $row['id']; ?>);">
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
      <input type="text" class="form-control" value="<?php echo $row['firtName']; ?>" placeholder="First name" id="fname" onkeyup="validatename(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['lastName']; ?>" placeholder="sname" id="sname" onkeyup="validatename(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="email" class="form-control" value="<?php echo $row['email']; ?>" placeholder="email" id="email" onblur="validateContactNumber(this.value, 'email_error');">
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['contactNumber']; ?>" placeholder="Contact Number" id="contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="address" id="address" onblur="validateaddress(this.value, 'address_error');"><?php echo $row['address']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
    </td>
    <td>
      <select class="form-control" id="role" name="role">
            <option selected value="<?php echo $row['ROLE']; ?>"><?php echo $row['ROLE']; ?></option>
            <option value="Stock Manager">Stock Manager</option>
            <option value="Accountant">Accountant</option>
            <option value="Sales">Sales</option>
            <option value="Admin">Admin</option>
        </select>
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
     <select class="form-control" id="status" name="status">
            <option selected value="<?php echo $row['STATUS']; ?>"><?php echo $row['STATUS']; ?></option>        
            <option value="ACTIVE" selected>Active</option>
            <option value="DEACTIVE">Deactive</option>
      </select>
    <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateUser(<?php echo $row['id']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateUser($id, $name, $email, $contact_number, $address) {
  require "db_connection.php";
  $query = "UPDATE users SET firstName = '$fname', lastName = '$sname', email = '$email', contact_number = '$contact_number', address = '$address', ROLE = '$role', STATUS = '$status' WHERE id = $id";
  $result = mysqli_query($con, $query);
  if(!empty($result))
    showUsers(0);
}

function searchUser($text) {
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $query = "SELECT * FROM users WHERE UPPER(lastName) LIKE '%$text%' OR UPPER(firstName) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showUserRow($seq_no, $row);
    }
  }
}

?>
