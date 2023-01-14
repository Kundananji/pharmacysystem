<?php
class CustomersDao{

/**
* function to insert single object of type Customers into database
* @param object instance of type Customers
* @return inserted objected of type Customers
*/
  public function insert($customers){
    $iD=  $customers->getID();
    $nAME=  $customers->getNAME();
    $contactNumber=  $customers->getContactNumber();
    $aDDRESS=  $customers->getADDRESS();
    $doctorName=  $customers->getDoctorName();
    $doctorAddress=  $customers->getDoctorAddress();
    try{
      $sql="INSERT INTO customers(`ID`,`NAME`,`CONTACT_NUMBER`,`ADDRESS`,`DOCTOR_NAME`,`DOCTOR_ADDRESS`) VALUES(?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("isssss",$iD,$nAME,$contactNumber,$aDDRESS,$doctorName,$doctorAddress);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM customers WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedCustomers = $this->getFields($row);
        $stmt->close();
        return $insertedCustomers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Customers
* @param object instance of type Customers
* @return updated objected of type Customers
*/
  public function update($customers){
    $iD=  $customers->getID();
    $nAME=  $customers->getNAME();
    $contactNumber=  $customers->getContactNumber();
    $aDDRESS=  $customers->getADDRESS();
    $doctorName=  $customers->getDoctorName();
    $doctorAddress=  $customers->getDoctorAddress();
    try{
      $sql="UPDATE customers SET `NAME`=?,`CONTACT_NUMBER`=?,`ADDRESS`=?,`DOCTOR_NAME`=?,`DOCTOR_ADDRESS`=? WHERE ID =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sssssi",$nAME,$contactNumber,$aDDRESS,$doctorName,$doctorAddress,$iD);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM customers WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$iD);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedCustomers = $this->getFields($row);
        $stmt->close();
        return $updatedCustomers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Customers from database through the provided search term
* @return array of objects of type Customers
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
      $sql="SELECT * FROM customers WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $customers = $this->getFields($row);
        $objects[]=$customers;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Customers from database
* @return array of objects of type Customers
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
      $sql="SELECT * FROM customers $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $customers = $this->getFields($row);
        $objects[]=$customers;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Customers from database
* @return object of type Customers
*/
  public function select($customersId){
    try{
      $sql="SELECT * FROM `customers` WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$customersId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $customers = $this->getFields($row);
        return $customers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Customers from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Customers
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
      $sql="SELECT * FROM customers  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $customers = $this->getFields($row);
        $objects[]=$customers;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Customers from database
* @return boolean
*/
  public function delete($customersId){
    try{
      $sql="DELETE FROM `customers` WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$customersId);
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
* function to select array of object of type Customers from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Customers
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM customers  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $customers = $this->getFields($row);
        $objects[]=$customers;
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
* function to select array of object of type Customers from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Customers
*/
  public function getFields($row){
    $customers= new Customers();
      $customers->setID($row['ID']);
      $customers->setNAME($row['NAME']);
      $customers->setContactNumber($row['CONTACT_NUMBER']);
      $customers->setADDRESS($row['ADDRESS']);
      $customers->setDoctorName($row['DOCTOR_NAME']);
      $customers->setDoctorAddress($row['DOCTOR_ADDRESS']);
    return $customers;
  }
}
