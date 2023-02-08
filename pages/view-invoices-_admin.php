<div class="card">
	<div class="card-header">
	   <h2>Dashboard</h2>
	</div>
	<div class="body">
	    <div class="container">
		       <!-- form content -->
			   <div class="row">
          <div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

            <?php
              function createSection1($location, $title, $table) {
                require '../php/db_connection.php';

                $query = "SELECT * FROM $table";
                if($title == "Out of Stock")
                  $query = "SELECT * FROM $table WHERE QUANTITY = 0";

                $result = mysqli_query($con, $query);
                $count = mysqli_num_rows($result);


                if($title == "Expired") {
                  // logic
                  $count = 0;
                  while($row = mysqli_fetch_array($result)) {
                    $expiry_date = $row['expiry_date'];
                    if(substr($expiry_date, 3) < date('y'))
                      $count++;
                    else if(substr($expiry_date, 3) == date('y')) {
                      if(substr($expiry_date, 0, 2) < date('m'))
                        $count++;
                    }
                  }
                }

                echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats" onclick="\''.$location.'\'">
                      <a class="text-dark text-decoration-none" href="'.$location.'">
                        <span class="h4">'.$count.'</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">'.$title.'</div>
                      </a>
                    </div>
                  </div>
                ';
              }
              createSection1('javascript:Patients.viewPatients({})', 'Total Patients', 'patients');
              createSection1('javascript:Suppliers.viewSuppliers({})', 'Total Supplier', 'suppliers');
              createSection1('javascript:Medicines.viewMedicines({})', 'Total Medicine', 'medicines');
              createSection1('void({})', 'Out of Stock', 'medicines_stock');
              createSection1('void({})', 'Expired', 'medicines_stock');
              createSection1('javascript:Invoice.viewInvoice({})', 'Total Invoice', 'invoices');
            ?>

          </div>

          <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
            <div class="todays-report">
              <div class="h5">Todays Report</div>
              <table class="table table-bordered table-striped table-hover">
                <tbody>
                  <?php
                    require '../php/db_connection.php';
                    if($con) {
                      $date = date('Y-m-d');
                  ?>
                  <tr>
                    <?php
                      $total = 0;
                      $query = "SELECT NET_TOTAL FROM invoices WHERE INVOICE_DATE = '$date'";
                      $result = mysqli_query($con, $query);

                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['NET_TOTAL'];
                    ?>
                    <th>Total Sales</th>
                    <th class="text-success">ZMW. <?php echo $total; ?></th>
                  </tr>
                  <tr>
                    <?php
                      //echo $date;
                      $total = 0;
                      $query = "SELECT TOTAL_AMOUNT FROM purchases WHERE PURCHASE_DATE = '$date'";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_array($result))
                        $total = $total + $row['TOTAL_AMOUNT'];
                    }
                    ?>
                    <th>Total Purchase</th>
                    <th class="text-danger">ZMW. <?php echo $total; ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <hr style="border-top: 2px solid #ff5252;">

        <div class="row">

          <?php
            function createSection2($icon, $location, $title) {
              echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;">
              		<div class="dashboard-stats" style="padding: 30px 15px;" onclick="location.href=\''.$location.'\'">
              			<div class="text-center">
                      <span class="h1"><i class="fa fa-'.$icon.' p-2"></i></span>
              				<div class="h5">'.$title.'</div>
              			</div>
              		</div>
                </div>
              ';
            }
            // createSection2('address-card', 'new_invoice.php', 'Create New Invoice');
            // createSection2('handshake', 'add_customer.php', 'Add New Customer');
            // createSection2('shopping-bag', 'add_medicine.php', 'Add New Medicine');
            //createSection2('group', 'add_supplier.php', 'Add New Supplier');
            //createSection2('group', 'add_user.php', 'Add New User');
            //createSection2('bar-chart', 'add_purchase.php', 'Add New Purchase');
            //createSection2('book', 'sales_report.php', 'Sales Report');
            //createSection2('book', 'purchase_report.php', 'Purchase Report');
          ?>

        </div>
        <!-- form content end -->
			
		</div><!-- end container-->
	
	</div> <!-- end body -->

</div> <!-- end card -->