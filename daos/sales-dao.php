<?php
class SalesDao{

/**
* function to insert single object of type Sales into database
* @param object instance of type Sales
* @return inserted objected of type Sales
*/
  public function insert($sales){
    $customerId=  $sales->getCustomerId();
    $invoiceNumber=  $sales->getInvoiceNumber();
    $medicineName=  $sales->getMedicineName();
    $batchId=  $sales->getBatchId();
    $expiryDate=  $sales->getExpiryDate();
    $qUANTITY=  $sales->getQUANTITY();
    $mRP=  $sales->getMRP();
    $dISCOUNT=  $sales->getDISCOUNT();
    $tOTAL=  $sales->getTOTAL();
    try{
      $sql="INSERT INTO sales(`CUSTOMER_ID`,`INVOICE_NUMBER`,`MEDICINE_NAME`,`BATCH_ID`,`EXPIRY_DATE`,`QUANTITY`,`MRP`,`DISCOUNT`,`TOTAL`) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issssisss",$customerId,$invoiceNumber,$medicineName,$batchId,$expiryDate,$qUANTITY,$mRP,$dISCOUNT,$tOTAL);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM sales WHERE ``=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedSales = $this->getFields($row);
        $stmt->close();
        return $insertedSales;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Sales from database through the provided search term
* @return array of objects of type Sales
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
      $sql="SELECT * FROM sales WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $sales = $this->getFields($row);
        $objects[]=$sales;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Sales from database
* @return array of objects of type Sales
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
      $sql="SELECT * FROM sales $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $sales = $this->getFields($row);
        $objects[]=$sales;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Sales from database
* @return object of type Sales
*/
  public function select($salesId){
    try{
      $sql="SELECT * FROM `sales` WHERE ``=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$salesId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $sales = $this->getFields($row);
        return $sales;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Sales from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Sales
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
      $sql="SELECT * FROM sales  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $sales = $this->getFields($row);
        $objects[]=$sales;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Sales from database
* @return boolean
*/
  public function delete($salesId){
    try{
      $sql="DELETE FROM `sales` WHERE ``=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$salesId);
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
* function to select array of object of type Sales from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Sales
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM sales  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $sales = $this->getFields($row);
        $objects[]=$sales;
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
* function to select array of object of type Sales from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Sales
*/
  public function getFields($row){
    $sales= new Sales();
      $sales->setCustomerId($row['CUSTOMER_ID']);
      $sales->setInvoiceNumber($row['INVOICE_NUMBER']);
      $sales->setMedicineName($row['MEDICINE_NAME']);
      $sales->setBatchId($row['BATCH_ID']);
      $sales->setExpiryDate($row['EXPIRY_DATE']);
      $sales->setQUANTITY($row['QUANTITY']);
      $sales->setMRP($row['MRP']);
      $sales->setDISCOUNT($row['DISCOUNT']);
      $sales->setTOTAL($row['TOTAL']);
    return $sales;
  }
}
