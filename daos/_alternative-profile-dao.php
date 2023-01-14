<?php
class AlternativeProfileDao{

/**
* function to insert single object of type AlternativeProfile into database
* @param object instance of type AlternativeProfile
* @return inserted objected of type AlternativeProfile
*/
  public function insert($alternativeProfile){
    $id=  $alternativeProfile->getId();
    $userId=  $alternativeProfile->getUserId();
    $profileId=  $alternativeProfile->getProfileId();
    try{
      $sql="INSERT INTO _alternative_profile(`id`,`userId`,`profileId`) VALUES(?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iii",$id,$userId,$profileId);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM _alternative_profile WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedAlternativeProfile = $this->getFields($row);
        $stmt->close();
        return $insertedAlternativeProfile;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type AlternativeProfile
* @param object instance of type AlternativeProfile
* @return updated objected of type AlternativeProfile
*/
  public function update($alternativeProfile){
    $id=  $alternativeProfile->getId();
    $userId=  $alternativeProfile->getUserId();
    $profileId=  $alternativeProfile->getProfileId();
    try{
      $sql="UPDATE _alternative_profile SET `userId`=?,`profileId`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("iii",$userId,$profileId,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM _alternative_profile WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedAlternativeProfile = $this->getFields($row);
        $stmt->close();
        return $updatedAlternativeProfile;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type AlternativeProfile from database through the provided search term
* @return array of objects of type AlternativeProfile
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
      $sql="SELECT * FROM _alternative_profile WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $alternativeProfile = $this->getFields($row);
        $objects[]=$alternativeProfile;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type AlternativeProfile from database
* @return array of objects of type AlternativeProfile
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
      $sql="SELECT * FROM _alternative_profile $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $alternativeProfile = $this->getFields($row);
        $objects[]=$alternativeProfile;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type AlternativeProfile from database
* @return object of type AlternativeProfile
*/
  public function select($alternativeProfileId){
    try{
      $sql="SELECT * FROM `_alternative_profile` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$alternativeProfileId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $alternativeProfile = $this->getFields($row);
        return $alternativeProfile;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type AlternativeProfile from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type AlternativeProfile
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
      $sql="SELECT * FROM _alternative_profile  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $alternativeProfile = $this->getFields($row);
        $objects[]=$alternativeProfile;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type AlternativeProfile from database
* @return boolean
*/
  public function delete($alternativeProfileId){
    try{
      $sql="DELETE FROM `_alternative_profile` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$alternativeProfileId);
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
* function to select array of object of type AlternativeProfile from database
* @param values: whereClause containing search conditions.
* @return array of objects of type AlternativeProfile
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM _alternative_profile  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $alternativeProfile = $this->getFields($row);
        $objects[]=$alternativeProfile;
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
* function to select array of object of type AlternativeProfile from database
* @param values: whereClause containing search conditions.
* @return array of objects of type AlternativeProfile
*/
  public function getFields($row){
    $alternativeProfile= new AlternativeProfile();
      $alternativeProfile->setId($row['id']);
      $alternativeProfile->setUserId($row['userId']);
      $alternativeProfile->setProfileId($row['profileId']);
    return $alternativeProfile;
  }
}
