<?php
class PatientSchemeDao{

/**
* function to insert single object of type PatientScheme into database
* @param object instance of type PatientScheme
* @return inserted objected of type PatientScheme
*/
  public function insert($patientScheme){
    $id=  $patientScheme->getId();
    $name=  $patientScheme->getName();
    $description=  $patientScheme->getDescription();
    $patientId=  $patientScheme->getPatientId();
    $insuranceProviderId=  $patientScheme->getInsuranceProviderId();
    $status=  $patientScheme->getStatus();
    try{
      $sql="INSERT INTO patient_scheme(`id`,`name`,`description`,`patientId`,`insuranceProviderId`,`status`) VALUES(?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issiii",$id,$name,$description,$patientId,$insuranceProviderId,$status);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM patient_scheme WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedPatientScheme = $this->getFields($row);
        $stmt->close();
        return $insertedPatientScheme;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type PatientScheme
* @param object instance of type PatientScheme
* @return updated objected of type PatientScheme
*/
  public function update($patientScheme){
    $id=  $patientScheme->getId();
    $name=  $patientScheme->getName();
    $description=  $patientScheme->getDescription();
    $patientId=  $patientScheme->getPatientId();
    $insuranceProviderId=  $patientScheme->getInsuranceProviderId();
    $status=  $patientScheme->getStatus();
    try{
      $sql="UPDATE patient_scheme SET `name`=?,`description`=?,`patientId`=?,`insuranceProviderId`=?,`status`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssiiii",$name,$description,$patientId,$insuranceProviderId,$status,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM patient_scheme WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedPatientScheme = $this->getFields($row);
        $stmt->close();
        return $updatedPatientScheme;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type PatientScheme from database through the provided search term
* @return array of objects of type PatientScheme
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
      $sql="SELECT * FROM patient_scheme WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientScheme = $this->getFields($row);
        $objects[]=$patientScheme;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type PatientScheme from database
* @return array of objects of type PatientScheme
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
      $sql="SELECT * FROM patient_scheme $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientScheme = $this->getFields($row);
        $objects[]=$patientScheme;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type PatientScheme from database
* @return object of type PatientScheme
*/
  public function select($patientSchemeId){
    try{
      $sql="SELECT * FROM `patient_scheme` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$patientSchemeId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $patientScheme = $this->getFields($row);
        return $patientScheme;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type PatientScheme from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type PatientScheme
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
      $sql="SELECT * FROM patient_scheme  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientScheme = $this->getFields($row);
        $objects[]=$patientScheme;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type PatientScheme from database
* @return boolean
*/
  public function delete($patientSchemeId){
    try{
      $sql="DELETE FROM `patient_scheme` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$patientSchemeId);
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
* function to select array of object of type PatientScheme from database
* @param values: whereClause containing search conditions.
* @return array of objects of type PatientScheme
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM patient_scheme  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientScheme = $this->getFields($row);
        $objects[]=$patientScheme;
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
* function to select array of object of type PatientScheme from database
* @param values: whereClause containing search conditions.
* @return array of objects of type PatientScheme
*/
  public function getFields($row){
    $patientScheme= new PatientScheme();
      $patientScheme->setId($row['id']);
      $patientScheme->setName($row['name']);
      $patientScheme->setDescription($row['description']);
      $patientScheme->setPatientId($row['patientId']);
      $patientScheme->setInsuranceProviderId($row['insuranceProviderId']);
      $patientScheme->setStatus($row['status']);
    return $patientScheme;
  }
}
