<?php
class InvoiceDao{

/**
* function to insert single object of type Invoice into database
* @param object instance of type Invoice
* @return inserted objected of type Invoice
*/
  public function insert($invoice){
    $invoiceId=  $invoice->getInvoiceId();
    $invoiceNo=  $invoice->getInvoiceNo();
    $description=  $invoice->getDescription();
    $invoiceDate=  $invoice->getInvoiceDate();
    $patientId=  $invoice->getPatientId();
    $taxAmount=  $invoice->getTaxAmount();
    $amount=  $invoice->getAmount();
    $isPaidFor=  $invoice->getIsPaidFor();
    $status=  $invoice->getStatus();
    try{
      $sql="INSERT INTO invoice(`invoiceId`,`invoiceNo`,`description`,`invoiceDate`,`patientId`,`taxAmount`,`amount`,`isPaidFor`,`status`) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("isssissii",$invoiceId,$invoiceNo,$description,$invoiceDate,$patientId,$taxAmount,$amount,$isPaidFor,$status);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM invoice WHERE `invoiceId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedInvoice = $this->getFields($row);
        $stmt->close();
        return $insertedInvoice;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Invoice
* @param object instance of type Invoice
* @return updated objected of type Invoice
*/
  public function update($invoice){
    $invoiceId=  $invoice->getInvoiceId();
    $invoiceNo=  $invoice->getInvoiceNo();
    $description=  $invoice->getDescription();
    $invoiceDate=  $invoice->getInvoiceDate();
    $patientId=  $invoice->getPatientId();
    $taxAmount=  $invoice->getTaxAmount();
    $amount=  $invoice->getAmount();
    $isPaidFor=  $invoice->getIsPaidFor();
    $status=  $invoice->getStatus();
    try{
      $sql="UPDATE invoice SET `invoiceNo`=?,`description`=?,`invoiceDate`=?,`patientId`=?,`taxAmount`=?,`amount`=?,`isPaidFor`=?,`status`=? WHERE invoiceId =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sssissiii",$invoiceNo,$description,$invoiceDate,$patientId,$taxAmount,$amount,$isPaidFor,$status,$invoiceId);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM invoice WHERE `invoiceId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedInvoice = $this->getFields($row);
        $stmt->close();
        return $updatedInvoice;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Invoice from database through the provided search term
* @return array of objects of type Invoice
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
      $sql="SELECT * FROM invoice WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoice = $this->getFields($row);
        $objects[]=$invoice;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Invoice from database
* @return array of objects of type Invoice
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
      $sql="SELECT * FROM invoice $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoice = $this->getFields($row);
        $objects[]=$invoice;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Invoice from database
* @return object of type Invoice
*/
  public function select($invoiceId){
    try{
      $sql="SELECT * FROM `invoice` WHERE `invoiceId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $invoice = $this->getFields($row);
        return $invoice;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Invoice from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Invoice
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
      $sql="SELECT * FROM invoice  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoice = $this->getFields($row);
        $objects[]=$invoice;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Invoice from database
* @return boolean
*/
  public function delete($invoiceId){
    try{
      $sql="DELETE FROM `invoice` WHERE `invoiceId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceId);
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
* function to select array of object of type Invoice from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Invoice
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM invoice  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoice = $this->getFields($row);
        $objects[]=$invoice;
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
* function to select array of object of type Invoice from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Invoice
*/
  public function getFields($row){
    $invoice= new Invoice();
      $invoice->setInvoiceId($row['invoiceId']);
      $invoice->setInvoiceNo($row['invoiceNo']);
      $invoice->setDescription($row['description']);
      $invoice->setInvoiceDate($row['invoiceDate']);
      $invoice->setPatientId($row['patientId']);
      $invoice->setTaxAmount($row['taxAmount']);
      $invoice->setAmount($row['amount']);
      $invoice->setIsPaidFor($row['isPaidFor']);
      $invoice->setStatus($row['status']);
    return $invoice;
  }
}
