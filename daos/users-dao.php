<?php
class UsersDao{

/**
* function to insert single object of type Users into database
* @param object instance of type Users
* @return inserted objected of type Users
*/
  public function insert($users){
    $id=  $users->getid();
    $username=  $users->getUsername();
    $firstName=  $users->getfirstName();
    $lastName=  $users->getlastName();
    $password=  $users->getPassword();
    $address=  $users->getaddress();
    $email=  $users->getemail();
    $contactNumber=  $users->getContactNumber();
    $isLoggedIn=  $users->getIsLoggedIn();
    $status=  $users->getStatus();
    $profile=  $users->getProfile();
    try{
      $sql="INSERT INTO users(`id`,`username`,`firstName`,`lastName`,`password`,`address`,`email`,`contactNumber`,`isLoggedIn`,`status`,`profile`) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("isssssssiii",$id,$username,$firstName,$lastName,$password,$address,$email,$contactNumber,$isLoggedIn,$status,$profile);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM users WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedUsers = $this->getFields($row);
        $stmt->close();
        return $insertedUsers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Users
* @param object instance of type Users
* @return updated objected of type Users
*/
  public function update($users){
    $id=  $users->getid();
    $username=  $users->getUsername();
    $firstName=  $users->getfirstName();
    $lastName=  $users->getlastName();
    $password=  $users->getPassword();
    $address=  $users->getaddress();
    $email=  $users->getemail();
    $contactNumber=  $users->getContactNumber();
    $isLoggedIn=  $users->getIsLoggedIn();
    $status=  $users->getStatus();
    $profile=  $users->getProfile();
    try{
      $sql="UPDATE users SET `username`=?,`firstName`=?,`lastName`=?,`password`=?,`address`=?,`email`=?,`contactNumber`=?,`isLoggedIn`=?,`status`=?,`profile`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("sssssssiiii",$username,$firstName,$lastName,$password,$address,$email,$contactNumber,$isLoggedIn,$status,$profile,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM users WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedUsers = $this->getFields($row);
        $stmt->close();
        return $updatedUsers;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Users from database through the provided search term
* @return array of objects of type Users
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
      $sql="SELECT * FROM users WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $users = $this->getFields($row);
        $objects[]=$users;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Users from database
* @return array of objects of type Users
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
      $sql="SELECT * FROM users $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $users = $this->getFields($row);
        $objects[]=$users;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Users from database
* @return object of type Users
*/
  public function select($usersid){
    try{
      $sql="SELECT * FROM `users` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$usersid);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $users = $this->getFields($row);
        return $users;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Users from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Users
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
      $sql="SELECT * FROM users  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $users = $this->getFields($row);
        $objects[]=$users;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Users from database
* @return boolean
*/
  public function delete($usersid){
    try{
      $sql="DELETE FROM `users` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$usersid);
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
* function to select array of object of type Users from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Users
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM users  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $users = $this->getFields($row);
        $objects[]=$users;
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
* function to select array of object of type Users from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Users
*/
  public function getFields($row){
    $users= new Users();
      $users->setid($row['id']);
      $users->setUsername($row['username']);
      $users->setfirstName($row['firstName']);
      $users->setlastName($row['lastName']);
      $users->setPassword($row['password']);
      $users->setaddress($row['address']);
      $users->setemail($row['email']);
      $users->setContactNumber($row['contactNumber']);
      $users->setIsLoggedIn($row['isLoggedIn']);
      $users->setStatus($row['status']);
      $users->setProfile($row['profile']);
    return $users;
  }
}
