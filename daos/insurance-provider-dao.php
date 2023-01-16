<?php
class InsuranceProviderDao{

/**
* function to insert single object of type InsuranceProvider into database
* @param object instance of type InsuranceProvider
* @return inserted objected of type InsuranceProvider
*/
  public function insert($insuranceProvider){
    $id=  $insuranceProvider->getId();
    $name=  $insuranceProvider->getName();
    $description=  $insuranceProvider->getDescription();
    $address=  $insuranceProvider->getAddress();
    $contactNumber=  $insuranceProvider->getContactNumber();
    try{
      $sql="INSERT INTO insurance_provider(`id`,`name`,`description`,`address`,`contactNumber`) VALUES(?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issss",$id,$name,$description,$address,$contactNumber);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM insurance_provider WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedInsuranceProvider = $this->getFields($row);
        $stmt->close();
        return $insertedInsuranceProvider;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type InsuranceProvider
* @param object instance of type InsuranceProvider
* @return updated objected of type InsuranceProvider
*/
  public function update($insuranceProvider){
    $id=  $insuranceProvider->getId();
    $name=  $insuranceProvider->getName();
    $description=  $insuranceProvider->getDescription();
    $address=  $insuranceProvider->getAddress();
    $contactNumber=  $insuranceProvider->getContactNumber();
    try{
      $sql="UPDATE insurance_provider SET `name`=?,`description`=?,`address`=?,`contactNumber`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssssi",$name,$description,$address,$contactNumber,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM insurance_provider WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedInsuranceProvider = $this->getFields($row);
        $stmt->close();
        return $updatedInsuranceProvider;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type InsuranceProvider from database through the provided search term
* @return array of objects of type InsuranceProvider
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
      $sql="SELECT * FROM insurance_provider WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $insuranceProvider = $this->getFields($row);
        $objects[]=$insuranceProvider;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type InsuranceProvider from database
* @return array of objects of type InsuranceProvider
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
      $sql="SELECT * FROM insurance_provider $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $insuranceProvider = $this->getFields($row);
        $objects[]=$insuranceProvider;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type InsuranceProvider from database
* @return object of type InsuranceProvider
*/
  public function select($insuranceProviderId){
    try{
      $sql="SELECT * FROM `insurance_provider` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$insuranceProviderId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $insuranceProvider = $this->getFields($row);
        return $insuranceProvider;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type InsuranceProvider from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type InsuranceProvider
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
      $sql="SELECT * FROM insurance_provider  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $insuranceProvider = $this->getFields($row);
        $objects[]=$insuranceProvider;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type InsuranceProvider from database
* @return boolean
*/
  public function delete($insuranceProviderId){
    try{
      $sql="DELETE FROM `insurance_provider` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$insuranceProviderId);
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
* function to select array of object of type InsuranceProvider from database
* @param values: whereClause containing search conditions.
* @return array of objects of type InsuranceProvider
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM insurance_provider  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $insuranceProvider = $this->getFields($row);
        $objects[]=$insuranceProvider;
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
* function to select array of object of type InsuranceProvider from database
* @param values: whereClause containing search conditions.
* @return array of objects of type InsuranceProvider
*/
  public function getFields($row){
    $insuranceProvider= new InsuranceProvider();
      $insuranceProvider->setId($row['id']);
      $insuranceProvider->setName($row['name']);
      $insuranceProvider->setDescription($row['description']);
      $insuranceProvider->setAddress($row['address']);
      $insuranceProvider->setContactNumber($row['contactNumber']);
    return $insuranceProvider;
  }
}
