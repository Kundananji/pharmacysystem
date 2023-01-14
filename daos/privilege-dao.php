<?php
class PrivilegeDao{

/**
* function to insert single object of type Privilege into database
* @param object instance of type Privilege
* @return inserted objected of type Privilege
*/
  public function insert($privilege){
    $id=  $privilege->getId();
    $name=  $privilege->getName();
    $profileId=  $privilege->getProfileId();
    try{
      $sql="INSERT INTO privilege(`id`,`name`,`profileId`) VALUES(?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("isi",$id,$name,$profileId);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM privilege WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedPrivilege = $this->getFields($row);
        $stmt->close();
        return $insertedPrivilege;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Privilege
* @param object instance of type Privilege
* @return updated objected of type Privilege
*/
  public function update($privilege){
    $id=  $privilege->getId();
    $name=  $privilege->getName();
    $profileId=  $privilege->getProfileId();
    try{
      $sql="UPDATE privilege SET `name`=?,`profileId`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sii",$name,$profileId,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM privilege WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedPrivilege = $this->getFields($row);
        $stmt->close();
        return $updatedPrivilege;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Privilege from database through the provided search term
* @return array of objects of type Privilege
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
      $sql="SELECT * FROM privilege WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $privilege = $this->getFields($row);
        $objects[]=$privilege;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Privilege from database
* @return array of objects of type Privilege
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
      $sql="SELECT * FROM privilege $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $privilege = $this->getFields($row);
        $objects[]=$privilege;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Privilege from database
* @return object of type Privilege
*/
  public function select($privilegeId){
    try{
      $sql="SELECT * FROM `privilege` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$privilegeId);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $privilege = $this->getFields($row);
        return $privilege;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Privilege from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Privilege
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
      $sql="SELECT * FROM privilege  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $privilege = $this->getFields($row);
        $objects[]=$privilege;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Privilege from database
* @return boolean
*/
  public function delete($privilegeId){
    try{
      $sql="DELETE FROM `privilege` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$privilegeId);
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
* function to select array of object of type Privilege from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Privilege
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM privilege  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $privilege = $this->getFields($row);
        $objects[]=$privilege;
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
* function to select array of object of type Privilege from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Privilege
*/
  public function getFields($row){
    $privilege= new Privilege();
      $privilege->setId($row['id']);
      $privilege->setName($row['name']);
      $privilege->setProfileId($row['profileId']);
    return $privilege;
  }
}
