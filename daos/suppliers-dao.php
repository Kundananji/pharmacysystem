<?php
class SuppliersDao{

/**
* function to insert single object of type Suppliers into database
* @param object instance of type Suppliers
* @return inserted objected of type Suppliers
*/
  public function insert($suppliers){
    $iD=  $suppliers->getID();
    $name=  $suppliers->getName();
    $email=  $suppliers->getEmail();
    $contactNumber=  $suppliers->getContactNumber();
    $address=  $suppliers->getAddress();
    try{
      $sql="INSERT INTO suppliers(`ID`,`name`,`email`,`contact_number`,`address`) VALUES(?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issss",$iD,$name,$email,$contactNumber,$address);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM suppliers WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedSuppliers = $this->getFields($row);
        $stmt->close();
        return $insertedSuppliers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Suppliers
* @param object instance of type Suppliers
* @return updated objected of type Suppliers
*/
  public function update($suppliers){
    $iD=  $suppliers->getID();
    $name=  $suppliers->getName();
    $email=  $suppliers->getEmail();
    $contactNumber=  $suppliers->getContactNumber();
    $address=  $suppliers->getAddress();
    try{
      $sql="UPDATE suppliers SET `name`=?,`email`=?,`contact_number`=?,`address`=? WHERE ID =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssssi",$name,$email,$contactNumber,$address,$iD);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM suppliers WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$iD);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedSuppliers = $this->getFields($row);
        $stmt->close();
        return $updatedSuppliers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Suppliers from database through the provided search term
* @return array of objects of type Suppliers
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
      $sql="SELECT * FROM suppliers WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $suppliers = $this->getFields($row);
        $objects[]=$suppliers;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Suppliers from database
* @return array of objects of type Suppliers
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
      $sql="SELECT * FROM suppliers $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $suppliers = $this->getFields($row);
        $objects[]=$suppliers;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Suppliers from database
* @return object of type Suppliers
*/
  public function select($suppliersId){
    try{
      $sql="SELECT * FROM `suppliers` WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$suppliersId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $suppliers = $this->getFields($row);
        return $suppliers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Suppliers from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Suppliers
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
      $sql="SELECT * FROM suppliers  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $suppliers = $this->getFields($row);
        $objects[]=$suppliers;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Suppliers from database
* @return boolean
*/
  public function delete($suppliersId){
    try{
      $sql="DELETE FROM `suppliers` WHERE `ID`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$suppliersId);
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
* function to select array of object of type Suppliers from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Suppliers
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM suppliers  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $suppliers = $this->getFields($row);
        $objects[]=$suppliers;
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
* function to select array of object of type Suppliers from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Suppliers
*/
  public function getFields($row){
    $suppliers= new Suppliers();
      $suppliers->setID($row['ID']);
      $suppliers->setName($row['name']);
      $suppliers->setEmail($row['email']);
      $suppliers->setContactNumber($row['contact_number']);
      $suppliers->setAddress($row['address']);
    return $suppliers;
  }
}
