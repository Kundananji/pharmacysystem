<?php
class InvoicesDao{

/**
* function to insert single object of type Invoices into database
* @param object instance of type Invoices
* @return inserted objected of type Invoices
*/
  public function insert($invoices){
    $invoiceId=  $invoices->getInvoiceId();
    $netTotal=  $invoices->getNetTotal();
    $invoiceDate=  $invoices->getInvoiceDate();
    $customerId=  $invoices->getCustomerId();
    $totalAmount=  $invoices->getTotalAmount();
    $totalDiscount=  $invoices->getTotalDiscount();
    try{
      $sql="INSERT INTO invoices(`INVOICE_ID`,`NET_TOTAL`,`INVOICE_DATE`,`CUSTOMER_ID`,`TOTAL_AMOUNT`,`TOTAL_DISCOUNT`) VALUES(?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ississ",$invoiceId,$netTotal,$invoiceDate,$customerId,$totalAmount,$totalDiscount);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM invoices WHERE `INVOICE_ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedInvoices = $this->getFields($row);
        $stmt->close();
        return $insertedInvoices;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Invoices
* @param object instance of type Invoices
* @return updated objected of type Invoices
*/
  public function update($invoices){
    $invoiceId=  $invoices->getInvoiceId();
    $netTotal=  $invoices->getNetTotal();
    $invoiceDate=  $invoices->getInvoiceDate();
    $customerId=  $invoices->getCustomerId();
    $totalAmount=  $invoices->getTotalAmount();
    $totalDiscount=  $invoices->getTotalDiscount();
    try{
      $sql="UPDATE invoices SET `NET_TOTAL`=?,`INVOICE_DATE`=?,`CUSTOMER_ID`=?,`TOTAL_AMOUNT`=?,`TOTAL_DISCOUNT`=? WHERE INVOICE_ID =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssissi",$netTotal,$invoiceDate,$customerId,$totalAmount,$totalDiscount,$invoiceId);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM invoices WHERE `INVOICE_ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoiceId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedInvoices = $this->getFields($row);
        $stmt->close();
        return $updatedInvoices;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Invoices from database through the provided search term
* @return array of objects of type Invoices
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
      $sql="SELECT * FROM invoices WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoices = $this->getFields($row);
        $objects[]=$invoices;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Invoices from database
* @return array of objects of type Invoices
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
      $sql="SELECT * FROM invoices $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoices = $this->getFields($row);
        $objects[]=$invoices;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Invoices from database
* @return object of type Invoices
*/
  public function select($invoicesId){
    try{
      $sql="SELECT * FROM `invoices` WHERE `INVOICE_ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoicesId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $invoices = $this->getFields($row);
        return $invoices;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Invoices from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Invoices
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
      $sql="SELECT * FROM invoices  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoices = $this->getFields($row);
        $objects[]=$invoices;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Invoices from database
* @return boolean
*/
  public function delete($invoicesId){
    try{
      $sql="DELETE FROM `invoices` WHERE `INVOICE_ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$invoicesId);
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
* function to select array of object of type Invoices from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Invoices
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM invoices  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $invoices = $this->getFields($row);
        $objects[]=$invoices;
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
* function to select array of object of type Invoices from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Invoices
*/
  public function getFields($row){
    $invoices= new Invoices();
      $invoices->setInvoiceId($row['INVOICE_ID']);
      $invoices->setNetTotal($row['NET_TOTAL']);
      $invoices->setInvoiceDate($row['INVOICE_DATE']);
      $invoices->setCustomerId($row['CUSTOMER_ID']);
      $invoices->setTotalAmount($row['TOTAL_AMOUNT']);
      $invoices->setTotalDiscount($row['TOTAL_DISCOUNT']);
    return $invoices;
  }
}
