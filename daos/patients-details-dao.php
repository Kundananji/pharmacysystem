<?php
class PatientsDetailsDao{

/**
* function to insert single object of type PatientsDetails into database
* @param object instance of type PatientsDetails
* @return inserted objected of type PatientsDetails
*/
  public function insert($patientsDetails){
    $id=  $patientsDetails->getId();
    $fileId=  $patientsDetails->getFileId();
    $firstName=  $patientsDetails->getFirstName();
    $lastName=  $patientsDetails->getLastName();
    $address=  $patientsDetails->getAddress();
    $contactNumber=  $patientsDetails->getContactNumber();
    $dateOfBirth=  $patientsDetails->getDateOfBirth();
    $nationality=  $patientsDetails->getNationality();
    $status=  $patientsDetails->getStatus();
    try{
      $sql="INSERT INTO patients_details(`id`,`fileId`,`firstName`,`lastName`,`address`,`contactNumber`,`dateOfBirth`,`nationality`,`status`) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("isssssssi",$id,$fileId,$firstName,$lastName,$address,$contactNumber,$dateOfBirth,$nationality,$status);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM patients_details WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedPatientsDetails = $this->getFields($row);
        $stmt->close();
        return $insertedPatientsDetails;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type PatientsDetails
* @param object instance of type PatientsDetails
* @return updated objected of type PatientsDetails
*/
  public function update($patientsDetails){
    $id=  $patientsDetails->getId();
    $fileId=  $patientsDetails->getFileId();
    $firstName=  $patientsDetails->getFirstName();
    $lastName=  $patientsDetails->getLastName();
    $address=  $patientsDetails->getAddress();
    $contactNumber=  $patientsDetails->getContactNumber();
    $dateOfBirth=  $patientsDetails->getDateOfBirth();
    $nationality=  $patientsDetails->getNationality();
    $status=  $patientsDetails->getStatus();
    try{
      $sql="UPDATE patients_details SET `fileId`=?,`firstName`=?,`lastName`=?,`address`=?,`contactNumber`=?,`dateOfBirth`=?,`nationality`=?,`status`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sssssssii",$fileId,$firstName,$lastName,$address,$contactNumber,$dateOfBirth,$nationality,$status,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM patients_details WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedPatientsDetails = $this->getFields($row);
        $stmt->close();
        return $updatedPatientsDetails;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type PatientsDetails from database through the provided search term
* @return array of objects of type PatientsDetails
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
      $sql="SELECT * FROM patients_details WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientsDetails = $this->getFields($row);
        $objects[]=$patientsDetails;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type PatientsDetails from database
* @return array of objects of type PatientsDetails
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
      $sql="SELECT * FROM patients_details $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientsDetails = $this->getFields($row);
        $objects[]=$patientsDetails;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type PatientsDetails from database
* @return object of type PatientsDetails
*/
  public function select($patientsDetailsId){
    try{
      $sql="SELECT * FROM `patients_details` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$patientsDetailsId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $patientsDetails = $this->getFields($row);
        return $patientsDetails;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type PatientsDetails from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type PatientsDetails
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
      $sql="SELECT * FROM patients_details  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientsDetails = $this->getFields($row);
        $objects[]=$patientsDetails;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type PatientsDetails from database
* @return boolean
*/
  public function delete($patientsDetailsId){
    try{
      $sql="DELETE FROM `patients_details` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$patientsDetailsId);
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
* function to select array of object of type PatientsDetails from database
* @param values: whereClause containing search conditions.
* @return array of objects of type PatientsDetails
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM patients_details  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $patientsDetails = $this->getFields($row);
        $objects[]=$patientsDetails;
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
* function to select array of object of type PatientsDetails from database
* @param values: whereClause containing search conditions.
* @return array of objects of type PatientsDetails
*/
  public function getFields($row){
    $patientsDetails= new PatientsDetails();
      $patientsDetails->setId($row['id']);
      $patientsDetails->setFileId($row['fileId']);
      $patientsDetails->setFirstName($row['firstName']);
      $patientsDetails->setLastName($row['lastName']);
      $patientsDetails->setAddress($row['address']);
      $patientsDetails->setContactNumber($row['contactNumber']);
      $patientsDetails->setDateOfBirth($row['dateOfBirth']);
      $patientsDetails->setNationality($row['nationality']);
      $patientsDetails->setStatus($row['status']);
    return $patientsDetails;
  }
}
