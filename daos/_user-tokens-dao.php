<?php
class UserTokensDao{

/**
* function to insert single object of type UserTokens into database
* @param object instance of type UserTokens
* @return inserted objected of type UserTokens
*/
  public function insert($userTokens){
    $id=  $userTokens->getid();
    $selector=  $userTokens->getSelector();
    $hashedValidator=  $userTokens->getHashedValidator();
    $userId=  $userTokens->getuserId();
    $expiry=  $userTokens->getExpiry();
    try{
      $sql="INSERT INTO _user_tokens(`id`,`selector`,`hashed_validator`,`user_id`,`expiry`) VALUES(?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issis",$id,$selector,$hashedValidator,$userId,$expiry);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM _user_tokens WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedUserTokens = $this->getFields($row);
        $stmt->close();
        return $insertedUserTokens;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type UserTokens
* @param object instance of type UserTokens
* @return updated objected of type UserTokens
*/
  public function update($userTokens){
    $id=  $userTokens->getid();
    $selector=  $userTokens->getSelector();
    $hashedValidator=  $userTokens->getHashedValidator();
    $userId=  $userTokens->getuserId();
    $expiry=  $userTokens->getExpiry();
    try{
      $sql="UPDATE _user_tokens SET `selector`=?,`hashed_validator`=?,`user_id`=?,`expiry`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssisi",$selector,$hashedValidator,$userId,$expiry,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM _user_tokens WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedUserTokens = $this->getFields($row);
        $stmt->close();
        return $updatedUserTokens;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type UserTokens from database through the provided search term
* @return array of objects of type UserTokens
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
      $sql="SELECT * FROM _user_tokens WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $userTokens = $this->getFields($row);
        $objects[]=$userTokens;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type UserTokens from database
* @return array of objects of type UserTokens
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
      $sql="SELECT * FROM _user_tokens $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $userTokens = $this->getFields($row);
        $objects[]=$userTokens;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type UserTokens from database
* @return object of type UserTokens
*/
  public function select($userTokensid){
    try{
      $sql="SELECT * FROM `_user_tokens` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$userTokensid);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $userTokens = $this->getFields($row);
        return $userTokens;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type UserTokens from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type UserTokens
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
      $sql="SELECT * FROM _user_tokens  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $userTokens = $this->getFields($row);
        $objects[]=$userTokens;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type UserTokens from database
* @return boolean
*/
  public function delete($userTokensid){
    try{
      $sql="DELETE FROM `_user_tokens` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$userTokensid);
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
* function to select array of object of type UserTokens from database
* @param values: whereClause containing search conditions.
* @return array of objects of type UserTokens
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM _user_tokens  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $userTokens = $this->getFields($row);
        $objects[]=$userTokens;
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
* function to select array of object of type UserTokens from database
* @param values: whereClause containing search conditions.
* @return array of objects of type UserTokens
*/
  public function getFields($row){
    $userTokens= new UserTokens();
      $userTokens->setid($row['id']);
      $userTokens->setSelector($row['selector']);
      $userTokens->setHashedValidator($row['hashed_validator']);
      $userTokens->setuserId($row['user_id']);
      $userTokens->setExpiry($row['expiry']);
    return $userTokens;
  }
}
