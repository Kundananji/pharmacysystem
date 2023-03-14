<?php
       require '../config/database.php';
       $date = date('Y-m-d');
       $startDate = isset($_POST['startDate'])?filter_var($_POST['startDate'],FILTER_SANITIZE_SPECIAL_CHARS):$date;
       $endDate = isset($_POST['endDate'])?filter_var($_POST['endDate'],FILTER_SANITIZE_SPECIAL_CHARS):$date;
?>

<div class="card">
	<div class="card-header">
	   <h2>Dashboard</h2>
	</div>
	<div class="body">
	    <div class="container p-4">
		       <!-- form content -->
			   <div class="row">
          <div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

            <?php
              function createSection1($location, $title, $table) {
         

                $query = "SELECT * FROM $table";
                if($title == "Out of Stock"){
                  $query = "SELECT * FROM $table WHERE quantity = 0";
                }

                $result = Database::getConnection()->query($query);
                $count = $result->num_rows;


                if($title == "Expired") {
                  // logic
                  $count = 0;
                  while($row = $result->fetch_assoc()) {
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
              createSection1('javascript:Invoice.viewInvoice({})', 'Total Invoice', 'invoice');
            ?>

          </div>

          <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
            <div class="todays-report">
              <div class="h5"> <?php echo ($endDate==$startDate)?"Todays Report -":"Report FROM"?> <?php echo date("jS F, Y",strtotime($startDate)); echo $endDate!=$startDate?" to ".date("jS F, Y",strtotime($endDate)):"";?></div>
              <table class="table table-bordered table-striped table-hover">
                <tbody>
         
                  <tr>
                    <?php
                      $total = 0;
                      $query = "SELECT amount FROM invoice WHERE invoiceDate BETWEEN '$startDate' AND '$endDate' AND `status`=1";
                      $result = Database::getConnection()->query($query);
                      $count = 0;
                      while($row = $result->fetch_array()){
                        $total = $total + $row['amount'];
                        $count+=1;
                      }
                    ?>
                    <th>Invoices Issued</th>
                    <th class="text-success"><?php echo number_format($count); ?></th>
                  </tr>
                  <tr>
                    <th>Total Sales</th>
                    <th class="text-success">ZMW. <?php echo $total; ?></th>
                 </tr>
                  <!--
                  <tr>
                    <?php
                      //echo $date;
                      $total = 0;
                      $query = "SELECT TOTAL_AMOUNT FROM purchases WHERE purchase_date = '$date'";
                      $result = Database::getConnection()->query($query);
                      while($row = $result->fetch_array()){
                        $total = $total + $row['TOTAL_AMOUNT'];
                      }
                    
                    ?>
                    <th>Total Purchase</th>
                    <th class="text-danger">ZMW. <?php echo $total; ?></th>
                  </tr>
                    -->
                  <tr>
                    <?php
                      //echo $date;
                    
                      $query = "SELECT COUNT(*) as Total,sum(case when pt.gender =1 then 1 else 0 END) as Male, sum(case when pt.gender =2 then 1 else 0 END) AS Female FROM invoice inv INNER JOIN patients pt ON inv.patientId=pt.patientId WHERE invoiceDate BETWEEN '$startDate' AND '$endDate' AND inv.`status` = 1";
                      $result = Database::getConnection()->query($query);
                      while($row = $result->fetch_array()){
                        $total = $row['Total'];
                        $male =  $row['Male'];
                        $female =  $row['Female'];
                      }
                    
                    ?>
                    <th>Total Patients</th>
                    <th class="text-danger"><?php echo number_format($total); ?></th>
                  </tr>
                  <tr>
                  <th>Male Patients</th>
                    <th class="text-danger"><?php echo number_format($male); ?></th>
                  </tr>
                  <tr>
                  <th>Female Patients</th>
                    <th class="text-danger"><?php echo number_format($female); ?></th>
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
            // createSection2('group', 'add_supplier.php', 'Add New Supplier');
            // createSection2('group', 'add_user.php', 'Add New User');
            // createSection2('bar-chart', 'add_purchase.php', 'Add New Purchase');
            // createSection2('book', 'sales_report.php', 'Sales Report');
            // createSection2('book', 'purchase_report.php', 'Purchase Report');
          ?>

        </div>
        <!-- form content end -->
			
		</div><!-- end container-->
	
	</div> <!-- end body -->

</div> <!-- end card -->