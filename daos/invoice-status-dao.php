<?php
class InvoiceStatusDao{

/**
* function to insert single object of type InvoiceStatus into database
* @param object instance of type InvoiceStatus
* @return inserted objected of type InvoiceStatus
*/
  public function insert($invoiceStatus){
    $invoiceStatusId=  $invoiceStatus->getInvoiceStatusId();
    $name=  $invoiceStatus->getName();
    try{
      $sql="INSERT INTO invoice_status(`invoiceStatusId`,`name`) VALUES(?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("is",$invoiceStatusId,$name);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM invoice_status WHERE `invoiceStatusId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedInvoiceStatus = $this->getFields($row);
        $stmt->close();
        return $insertedInvoiceStatus;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type InvoiceStatus
* @param object instance of type InvoiceStatus
* @return updated objected of type InvoiceStatus
*/
  public function update($invoiceStatus){
    $invoiceStatusId=  $invoiceStatus->getInvoiceStatusId();
    $name=  $invoiceStatus->getName();
    try{
      $sql="UPDATE invoice_status SET `name`=? WHERE invoiceStatusId =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("si",$name,$invoiceStatusId);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM invoice_status WHERE `invoiceStatusId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceStatusId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedInvoiceStatus = $this->getFields($row);
        $stmt->close();
        return $updatedInvoiceStatus;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type InvoiceStatus from database through the provided search term
* @return array of objects of type InvoiceStatus
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
      $sql="SELECT * FROM invoice_status WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceStatus = $this->getFields($row);
        $objects[]=$invoiceStatus;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type InvoiceStatus from database
* @return array of objects of type InvoiceStatus
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
      $sql="SELECT * FROM invoice_status $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceStatus = $this->getFields($row);
        $objects[]=$invoiceStatus;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type InvoiceStatus from database
* @return object of type InvoiceStatus
*/
  public function select($invoiceStatusId){
    try{
      $sql="SELECT * FROM `invoice_status` WHERE `invoiceStatusId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceStatusId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $invoiceStatus = $this->getFields($row);
        return $invoiceStatus;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type InvoiceStatus from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type InvoiceStatus
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
      $sql="SELECT * FROM invoice_status  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceStatus = $this->getFields($row);
        $objects[]=$invoiceStatus;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type InvoiceStatus from database
* @return boolean
*/
  public function delete($invoiceStatusId){
    try{
      $sql="DELETE FROM `invoice_status` WHERE `invoiceStatusId`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceStatusId);
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
* function to select array of object of type InvoiceStatus from database
* @param values: whereClause containing search conditions.
* @return array of objects of type InvoiceStatus
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM invoice_status  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoiceStatus = $this->getFields($row);
        $objects[]=$invoiceStatus;
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
* function to select array of object of type InvoiceStatus from database
* @param values: whereClause containing search conditions.
* @return array of objects of type InvoiceStatus
*/
  public function getFields($row){
    $invoiceStatus= new InvoiceStatus();
      $invoiceStatus->setInvoiceStatusId($row['invoiceStatusId']);
      $invoiceStatus->setName($row['name']);
    return $invoiceStatus;
  }
}
