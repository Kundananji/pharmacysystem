<?php
class InvoiceDetailDao{

/**
* function to insert single object of type InvoiceDetail into database
* @param object instance of type InvoiceDetail
* @return inserted objected of type InvoiceDetail
*/
  public function insert($invoiceDetail){
    $id=  $invoiceDetail->getId();
    $invoiceId=  $invoiceDetail->getInvoiceId();
    $feeId=  $invoiceDetail->getFeeId();
    $medicineId=  $invoiceDetail->getMedicineId();
    $description=  $invoiceDetail->getDescription();
    $unitPrice=  $invoiceDetail->getUnitPrice();
    $quantity=  $invoiceDetail->getQuantity();
    $discount=  $invoiceDetail->getDiscount();
    $totalAmount=  $invoiceDetail->getTotalAmount();
    try{
      $sql="INSERT INTO invoice_detail(`id`,`invoiceId`,`feeId`,`medicineId`,`description`,`unitPrice`,`quantity`,`discount`,`totalAmount`) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iiiississ",$id,$invoiceId,$feeId,$medicineId,$description,$unitPrice,$quantity,$discount,$totalAmount);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM invoice_detail WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedInvoiceDetail = $this->getFields($row);
        $stmt->close();
        return $insertedInvoiceDetail;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type InvoiceDetail
* @param object instance of type InvoiceDetail
* @return updated objected of type InvoiceDetail
*/
  public function update($invoiceDetail){
    $id=  $invoiceDetail->getId();
    $invoiceId=  $invoiceDetail->getInvoiceId();
    $feeId=  $invoiceDetail->getFeeId();
    $medicineId=  $invoiceDetail->getMedicineId();
    $description=  $invoiceDetail->getDescription();
    $unitPrice=  $invoiceDetail->getUnitPrice();
    $quantity=  $invoiceDetail->getQuantity();
    $discount=  $invoiceDetail->getDiscount();
    $totalAmount=  $invoiceDetail->getTotalAmount();
    try{
      $sql="UPDATE invoice_detail SET `invoiceId`=?,`feeId`=?,`medicineId`=?,`description`=?,`unitPrice`=?,`quantity`=?,`discount`=?,`totalAmount`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iiississi",$invoiceId,$feeId,$medicineId,$description,$unitPrice,$quantity,$discount,$totalAmount,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM invoice_detail WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedInvoiceDetail = $this->getFields($row);
        $stmt->close();
        return $updatedInvoiceDetail;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type InvoiceDetail from database through the provided search term
* @return array of objects of type InvoiceDetail
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
      $sql="SELECT * FROM invoice_detail WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceDetail = $this->getFields($row);
        $objects[]=$invoiceDetail;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type InvoiceDetail from database
* @return array of objects of type InvoiceDetail
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
      $sql="SELECT * FROM invoice_detail $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceDetail = $this->getFields($row);
        $objects[]=$invoiceDetail;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type InvoiceDetail from database
* @return object of type InvoiceDetail
*/
  public function select($invoiceDetailId){
    try{
      $sql="SELECT * FROM `invoice_detail` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceDetailId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $invoiceDetail = $this->getFields($row);
        return $invoiceDetail;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type InvoiceDetail from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type InvoiceDetail
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
      $sql="SELECT * FROM invoice_detail  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceDetail = $this->getFields($row);
        $objects[]=$invoiceDetail;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type InvoiceDetail from database
* @return boolean
*/
  public function delete($invoiceDetailId){
    try{
      $sql="DELETE FROM `invoice_detail` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceDetailId);
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
* function to select array of object of type InvoiceDetail from database
* @param values: whereClause containing search conditions.
* @return array of objects of type InvoiceDetail
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM invoice_detail  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceDetail = $this->getFields($row);
        $objects[]=$invoiceDetail;
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
* function to select array of object of type InvoiceDetail from database
* @param values: whereClause containing search conditions.
* @return array of objects of type InvoiceDetail
*/
  public function getFields($row){
    $invoiceDetail= new InvoiceDetail();
      $invoiceDetail->setId($row['id']);
      $invoiceDetail->setInvoiceId($row['invoiceId']);
      $invoiceDetail->setFeeId($row['feeId']);
      $invoiceDetail->setMedicineId($row['medicineId']);
      $invoiceDetail->setDescription($row['description']);
      $invoiceDetail->setUnitPrice($row['unitPrice']);
      $invoiceDetail->setQuantity($row['quantity']);
      $invoiceDetail->setDiscount($row['discount']);
      $invoiceDetail->setTotalAmount($row['totalAmount']);
    return $invoiceDetail;
  }
}
