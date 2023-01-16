<?php
class ReceiptDetailDao{

/**
* function to insert single object of type ReceiptDetail into database
* @param object instance of type ReceiptDetail
* @return inserted objected of type ReceiptDetail
*/
  public function insert($receiptDetail){
    $id=  $receiptDetail->getId();
    $receiptId=  $receiptDetail->getReceiptId();
    $item=  $receiptDetail->getItem();
    $description=  $receiptDetail->getDescription();
    $quantity=  $receiptDetail->getQuantity();
    $unitPrice=  $receiptDetail->getUnitPrice();
    $totalAmount=  $receiptDetail->getTotalAmount();
    $invoiceDetailId=  $receiptDetail->getInvoiceDetailId();
    $feeId=  $receiptDetail->getFeeId();
    $medicineId=  $receiptDetail->getMedicineId();
    $discount=  $receiptDetail->getDiscount();
    try{
      $sql="INSERT INTO receipt_detail(`id`,`receiptId`,`item`,`description`,`quantity`,`unitPrice`,`totalAmount`,`invoiceDetailId`,`feeId`,`medicineId`,`discount`) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iiiiissiiis",$id,$receiptId,$item,$description,$quantity,$unitPrice,$totalAmount,$invoiceDetailId,$feeId,$medicineId,$discount);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM receipt_detail WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedReceiptDetail = $this->getFields($row);
        $stmt->close();
        return $insertedReceiptDetail;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type ReceiptDetail
* @param object instance of type ReceiptDetail
* @return updated objected of type ReceiptDetail
*/
  public function update($receiptDetail){
    $id=  $receiptDetail->getId();
    $receiptId=  $receiptDetail->getReceiptId();
    $item=  $receiptDetail->getItem();
    $description=  $receiptDetail->getDescription();
    $quantity=  $receiptDetail->getQuantity();
    $unitPrice=  $receiptDetail->getUnitPrice();
    $totalAmount=  $receiptDetail->getTotalAmount();
    $invoiceDetailId=  $receiptDetail->getInvoiceDetailId();
    $feeId=  $receiptDetail->getFeeId();
    $medicineId=  $receiptDetail->getMedicineId();
    $discount=  $receiptDetail->getDiscount();
    try{
      $sql="UPDATE receipt_detail SET `receiptId`=?,`item`=?,`description`=?,`quantity`=?,`unitPrice`=?,`totalAmount`=?,`invoiceDetailId`=?,`feeId`=?,`medicineId`=?,`discount`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iiiissiiisi",$receiptId,$item,$description,$quantity,$unitPrice,$totalAmount,$invoiceDetailId,$feeId,$medicineId,$discount,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM receipt_detail WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedReceiptDetail = $this->getFields($row);
        $stmt->close();
        return $updatedReceiptDetail;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type ReceiptDetail from database through the provided search term
* @return array of objects of type ReceiptDetail
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
      $sql="SELECT * FROM receipt_detail WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receiptDetail = $this->getFields($row);
        $objects[]=$receiptDetail;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type ReceiptDetail from database
* @return array of objects of type ReceiptDetail
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
      $sql="SELECT * FROM receipt_detail $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receiptDetail = $this->getFields($row);
        $objects[]=$receiptDetail;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type ReceiptDetail from database
* @return object of type ReceiptDetail
*/
  public function select($receiptDetailId){
    try{
      $sql="SELECT * FROM `receipt_detail` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$receiptDetailId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $receiptDetail = $this->getFields($row);
        return $receiptDetail;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type ReceiptDetail from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type ReceiptDetail
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
      $sql="SELECT * FROM receipt_detail  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receiptDetail = $this->getFields($row);
        $objects[]=$receiptDetail;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type ReceiptDetail from database
* @return boolean
*/
  public function delete($receiptDetailId){
    try{
      $sql="DELETE FROM `receipt_detail` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$receiptDetailId);
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
* function to select array of object of type ReceiptDetail from database
* @param values: whereClause containing search conditions.
* @return array of objects of type ReceiptDetail
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM receipt_detail  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $receiptDetail = $this->getFields($row);
        $objects[]=$receiptDetail;
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
* function to select array of object of type ReceiptDetail from database
* @param values: whereClause containing search conditions.
* @return array of objects of type ReceiptDetail
*/
  public function getFields($row){
    $receiptDetail= new ReceiptDetail();
      $receiptDetail->setId($row['id']);
      $receiptDetail->setReceiptId($row['receiptId']);
      $receiptDetail->setItem($row['item']);
      $receiptDetail->setDescription($row['description']);
      $receiptDetail->setQuantity($row['quantity']);
      $receiptDetail->setUnitPrice($row['unitPrice']);
      $receiptDetail->setTotalAmount($row['totalAmount']);
      $receiptDetail->setInvoiceDetailId($row['invoiceDetailId']);
      $receiptDetail->setFeeId($row['feeId']);
      $receiptDetail->setMedicineId($row['medicineId']);
      $receiptDetail->setDiscount($row['discount']);
    return $receiptDetail;
  }
}
