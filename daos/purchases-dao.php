<?php
class PurchasesDao{

/**
* function to insert single object of type Purchases into database
* @param object instance of type Purchases
* @return inserted objected of type Purchases
*/
  public function insert($purchases){
    $supplierName=  $purchases->getSupplierName();
    $invoiceNumber=  $purchases->getInvoiceNumber();
    $voucherNumber=  $purchases->getVoucherNumber();
    $purchaseDate=  $purchases->getPurchaseDate();
    $totalAmount=  $purchases->getTotalAmount();
    $paymentStatus=  $purchases->getPaymentStatus();
    try{
      $sql="INSERT INTO purchases(`supplier_name`,`invoice_number`,`voucher_number`,`purchase_date`,`total_amount`,`payment_status`) VALUES(?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("siisss",$supplierName,$invoiceNumber,$voucherNumber,$purchaseDate,$totalAmount,$paymentStatus);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM purchases WHERE `voucher_number`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedPurchases = $this->getFields($row);
        $stmt->close();
        return $insertedPurchases;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Purchases
* @param object instance of type Purchases
* @return updated objected of type Purchases
*/
  public function update($purchases){
    $supplierName=  $purchases->getSupplierName();
    $invoiceNumber=  $purchases->getInvoiceNumber();
    $voucherNumber=  $purchases->getVoucherNumber();
    $purchaseDate=  $purchases->getPurchaseDate();
    $totalAmount=  $purchases->getTotalAmount();
    $paymentStatus=  $purchases->getPaymentStatus();
    try{
      $sql="UPDATE purchases SET `supplier_name`=?,`invoice_number`=?,`purchase_date`=?,`total_amount`=?,`payment_status`=? WHERE voucher_number =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sisssi",$supplierName,$invoiceNumber,$purchaseDate,$totalAmount,$paymentStatus,$voucherNumber);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM purchases WHERE `voucher_number`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$voucherNumber);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedPurchases = $this->getFields($row);
        $stmt->close();
        return $updatedPurchases;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Purchases from database through the provided search term
* @return array of objects of type Purchases
*/
  public function search($term,$searchFields,$extra=null,$pageSize=0,$pageNo=null){
    //determine page size
    //if $pageSize is zero, then this table is not paged
    //if page is null, then we shall show all values, even if $pageSize is greater than zero
    $limitClause = '';
    if($pageSize > 0 && $pageNo !=NULL){
      $limitClause = 'LIMIT '.($pageNo*$pageSize).','.$pageSize;
    }
    //search through search fields
    $whereClause=[];
    foreach($searchFields as $searchField){
      $whereClause[]=$searchField.' LIKE \'%'.$term.'%\'';
    }
    try{
      $sql="SELECT * FROM purchases WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $purchases = $this->getFields($row);
        $objects[]=$purchases;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Purchases from database
* @return array of objects of type Purchases
*/
  public function selectAll($pageSize=0,$pageNo=null){
    //determine page size
    //if $pageSize is zero, then this table is not paged
    //if page is null, then we shall show all values, even if $pageSize is greater than zero
    $limitClause = '';
    if($pageSize > 0 && $pageNo !=NULL){
      $limitClause = 'LIMIT '.($pageNo*$pageSize).','.$pageSize;
    }
    try{
      $sql="SELECT * FROM purchases $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $purchases = $this->getFields($row);
        $objects[]=$purchases;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Purchases from database
* @return object of type Purchases
*/
  public function select($purchasesId){
    try{
      $sql="SELECT * FROM `purchases` WHERE `voucher_number`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$purchasesId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $purchases = $this->getFields($row);
        return $purchases;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Purchases from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Purchases
*/
  public function selectBy($fields,$values,$types,$orderByFields=array(),$pageSize=0,$pageNo=null){
    //determine page size
    //if $pageSize is zero, then this table is not paged
    //if page is null, then we shall show all values, even if $pageSize is greater than zero
    $limitClause = '';
    if($pageSize > 0 && $pageNo !=NULL){
      $limitClause = 'LIMIT '.($pageNo*$pageSize).','.$pageSize;
    }
    //validate variables
    if(sizeof($fields) == 0){
       throw new Exception("Fields should be passed"); //exit function to prevent catastrophy;
    }

    if(sizeof($fields)!=sizeof($values) && sizeof($fields)!=sizeof($types)){
       throw new Exception("Number of fields should match number of values and value types"); //exit function to prevent catastrophy;
    }

    $whereVars =array();

    //loop through each field to create a condition for where
    $fieldCount=0;
    foreach($fields as $field){
      $whereVars[]="$field='".$values[$fieldCount]."'";
      $fieldCount+=1;
    }

    try{
      $sql="SELECT * FROM purchases  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $purchases = $this->getFields($row);
        $objects[]=$purchases;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Purchases from database
* @return boolean
*/
  public function delete($purchasesId){
    try{
      $sql="DELETE FROM `purchases` WHERE `voucher_number`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$purchasesId);
      $stmt->execute();
      $numRows = $stmt->affected_rows;
      $stmt->close();
      return $numRows>0;
    }
    catch(Exception $ex){
      return false;
    }

  }

/**
* function to select array of object of type Purchases from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Purchases
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM purchases  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $purchases = $this->getFields($row);
        $objects[]=$purchases;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to execute custom select array of records
* @param values: $query to execute.
* @return array of records fetched
*/
  public function selectQuery($query){
    try{
      $sql="$query";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows = array();
      while($row=$result->fetch_assoc()){
         $rows[] =$row;
      }
      $stmt->close();
      return $rows;
    }
    catch(Exception $ex){
      throw $ex;
    }
    return null;

  }

/**
* function to select array of object of type Purchases from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Purchases
*/
  public function getFields($row){
    $purchases= new Purchases();
      $purchases->setSupplierName($row['supplier_name']);
      $purchases->setInvoiceNumber($row['invoice_number']);
      $purchases->setVoucherNumber($row['voucher_number']);
      $purchases->setPurchaseDate($row['purchase_date']);
      $purchases->setTotalAmount($row['total_amount']);
      $purchases->setPaymentStatus($row['payment_status']);
    return $purchases;
  }
}
