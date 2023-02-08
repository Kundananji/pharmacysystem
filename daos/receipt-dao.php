<?php
class ReceiptDao{

/**
* function to insert single object of type Receipt into database
* @param object instance of type Receipt
* @return inserted objected of type Receipt
*/
  public function insert($receipt){
    $receiptId=  $receipt->getReceiptId();
    $description=  $receipt->getDescription();
    $patientId=  $receipt->getPatientId();
    $receiptNo=  $receipt->getReceiptNo();
    $invoiceId=  $receipt->getInvoiceId();
    $receiptDate=  $receipt->getReceiptDate();
    $invoiceAmount=  $receipt->getInvoiceAmount();
    $amountPaid=  $receipt->getAmountPaid();
    $paymentMethodId=  $receipt->getPaymentMethodId();
    $changeAmount=  $receipt->getChangeAmount();
    try{
      $sql="INSERT INTO receipt(`receiptId`,`description`,`patientId`,`receiptNo`,`invoiceId`,`receiptDate`,`invoiceAmount`,`amountPaid`,`paymentMethodId`,`changeAmount`) VALUES(?,?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("isisisssis",$receiptId,$description,$patientId,$receiptNo,$invoiceId,$receiptDate,$invoiceAmount,$amountPaid,$paymentMethodId,$changeAmount);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM receipt WHERE `receiptId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedReceipt = $this->getFields($row);
        $stmt->close();
        return $insertedReceipt;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Receipt
* @param object instance of type Receipt
* @return updated objected of type Receipt
*/
  public function update($receipt){
    $receiptId=  $receipt->getReceiptId();
    $description=  $receipt->getDescription();
    $patientId=  $receipt->getPatientId();
    $receiptNo=  $receipt->getReceiptNo();
    $invoiceId=  $receipt->getInvoiceId();
    $receiptDate=  $receipt->getReceiptDate();
    $invoiceAmount=  $receipt->getInvoiceAmount();
    $amountPaid=  $receipt->getAmountPaid();
    $paymentMethodId=  $receipt->getPaymentMethodId();
    $changeAmount=  $receipt->getChangeAmount();
    try{
      $sql="UPDATE receipt SET `description`=?,`patientId`=?,`receiptNo`=?,`invoiceId`=?,`receiptDate`=?,`invoiceAmount`=?,`amountPaid`=?,`paymentMethodId`=?,`changeAmount`=? WHERE receiptId =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sisisssisi",$description,$patientId,$receiptNo,$invoiceId,$receiptDate,$invoiceAmount,$amountPaid,$paymentMethodId,$changeAmount,$receiptId);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM receipt WHERE `receiptId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$receiptId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedReceipt = $this->getFields($row);
        $stmt->close();
        return $updatedReceipt;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Receipt from database through the provided search term
* @return array of objects of type Receipt
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
      $sql="SELECT * FROM receipt WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receipt = $this->getFields($row);
        $objects[]=$receipt;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Receipt from database
* @return array of objects of type Receipt
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
      $sql="SELECT * FROM receipt $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receipt = $this->getFields($row);
        $objects[]=$receipt;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Receipt from database
* @return object of type Receipt
*/
  public function select($receiptId){
    try{
      $sql="SELECT * FROM `receipt` WHERE `receiptId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$receiptId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $receipt = $this->getFields($row);
        return $receipt;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Receipt from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Receipt
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
      $sql="SELECT * FROM receipt  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receipt = $this->getFields($row);
        $objects[]=$receipt;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Receipt from database
* @return boolean
*/
  public function delete($receiptId){
    try{
      $sql="DELETE FROM `receipt` WHERE `receiptId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$receiptId);
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
* function to select array of object of type Receipt from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Receipt
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM receipt  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receipt = $this->getFields($row);
        $objects[]=$receipt;
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
* function to select array of object of type Receipt from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Receipt
*/
  public function getFields($row){
    $receipt= new Receipt();
      $receipt->setReceiptId($row['receiptId']);
      $receipt->setDescription($row['description']);
      $receipt->setPatientId($row['patientId']);
      $receipt->setReceiptNo($row['receiptNo']);
      $receipt->setInvoiceId($row['invoiceId']);
      $receipt->setReceiptDate($row['receiptDate']);
      $receipt->setInvoiceAmount($row['invoiceAmount']);
      $receipt->setAmountPaid($row['amountPaid']);
      $receipt->setPaymentMethodId($row['paymentMethodId']);
      $receipt->setChangeAmount($row['changeAmount']);
    return $receipt;
  }
}
