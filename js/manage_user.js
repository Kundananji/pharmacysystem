function deleteUser(id) {
  var confirmation = confirm("Are you sure?");
  if(confirmation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
          document.getElementById('users_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_user.php?action=delete&id=" + id, true);
    xhttp.send();
  }
}

function editUser(id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('users_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_user.php?action=edit&id=" + id, true);
  xhttp.send();
}

function updateUser(id) {
    var fname = document.getElementById("fname");
    var sname = document.getElementById("sname");
  var email = document.getElementById("email");
  var contact_number = document.getElementById("contact_number");
    var address = document.getElementById("address");
    var role = document.getElementById("role");
    var status = document.getElementById("status");
    if (!validateAddress(email.value, "name_error"))
        email.focus();
  else if(!validateContactNumber(contact_number.value, "contact_number_error"))
    contact_number.focus();
  else if(!validateAddress(address.value, "address_error"))
    address.focus();
  else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
          document.getElementById('users_div').innerHTML = xhttp.responseText;
    };
        xhttp.open("GET", "php/manage_user.php?action=update&id=" + id + "&fname=" + fname.value + "&sname=" + sname.value + "&email=" + email.value + "&contact_number=" + contact_number.value + "&address=" + address.value + "&role=" + role.value + "&status=" + status.value , true);
    xhttp.send();
  }
}

function cancel() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('users_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_user.php?action=cancel", true);
  xhttp.send();
}

function searchSupplier(text) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById('users_div').innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/manage_user.php?action=search&text=" + text, true);
  xhttp.send();
}
