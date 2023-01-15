<?php
class MenuDao{

/**
* function to insert single object of type Menu into database
* @param object instance of type Menu
* @return inserted objected of type Menu
*/
  public function insert($menu){
    $id=  $menu->getid();
    $icon=  $menu->getIcon();
    $name=  $menu->getname();
    $label=  $menu->getLabel();
    $url=  $menu->getUrl();
    $target=  $menu->getTarget();
    $parentId=  $menu->getparentId();
    $profileId=  $menu->getprofileId();
    $idName=  $menu->getidName();
    try{
      $sql="INSERT INTO menu(`id`,`icon`,`name`,`label`,`url`,`target`,`parentId`,`profileId`,`idName`) VALUES(?,?,?,?,?,?,?,?,?)";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("issssiiis",$id,$icon,$name,$label,$url,$target,$parentId,$profileId,$idName);
      $stmt->execute();
      $stmt->store_result();
      $inserted = $stmt->insert_id;
      $stmt->close();

      $sql="SELECT * FROM menu WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$inserted);
      $stmt->execute();
      $result = $stmt->get_result();
      if($row=$result->fetch_assoc()){
      $insertedMenu = $this->getFields($row);
        $stmt->close();
        return $insertedMenu;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to update single object of type Menu
* @param object instance of type Menu
* @return updated objected of type Menu
*/
  public function update($menu){
    $id=  $menu->getid();
    $icon=  $menu->getIcon();
    $name=  $menu->getname();
    $label=  $menu->getLabel();
    $url=  $menu->getUrl();
    $target=  $menu->getTarget();
    $parentId=  $menu->getparentId();
    $profileId=  $menu->getprofileId();
    $idName=  $menu->getidName();
    try{
      $sql="UPDATE menu SET `icon`=?,`name`=?,`label`=?,`url`=?,`target`=?,`parentId`=?,`profileId`=?,`idName`=? WHERE id =?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("ssssiiisi",$icon,$name,$label,$url,$target,$parentId,$profileId,$idName,$id);
      $stmt->execute();
      $stmt->close();

      $sql="SELECT * FROM menu WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $updatedMenu = $this->getFields($row);
        $stmt->close();
        return $updatedMenu;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
       throw $ex;
    }

  }

/**
* function to select array of object of type Menu from database through the provided search term
* @return array of objects of type Menu
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
      $sql="SELECT * FROM menu WHERE (".implode(' OR ',$whereClause).") ".($extra!=null?("AND ".$extra):'')." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $menu = $this->getFields($row);
        $objects[]=$menu;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select array of object of type Menu from database
* @return array of objects of type Menu
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
      $sql="SELECT * FROM menu $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $menu = $this->getFields($row);
        $objects[]=$menu;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      return array();
    }

  }

/**
* function to select single instance of object of type Menu from database
* @return object of type Menu
*/
  public function select($menuid){
    try{
      $sql="SELECT * FROM `menu` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$menuid);
      $stmt->execute();
      $result = $stmt->get_result();
      while($row=$result->fetch_assoc()){
        $menu = $this->getFields($row);
        return $menu;
      }
      $stmt->close();
      return null;
    }
    catch(Exception $ex){
      return null;
    }

  }

/**
* function to select array of object of type Menu from database
* @param fields: array of fields consisting of one or more fields to select by
* @param values: array of values consisting of one or more values for corresponding fields. Number must correspond with fields number.
* @return array of objects of type Menu
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
      $sql="SELECT * FROM menu  WHERE ".implode(" AND ",$whereVars) .(sizeof($orderByFields)>0?("ORDER BY ".implode(",",$orderByFields)):"")." $limitClause";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $menu = $this->getFields($row);
        $objects[]=$menu;
      }
      $stmt->close();
      return $objects;
    }
    catch(Exception $ex){
      throw $ex;
    }

  }

/**
* function to delete a single instance of object of type Menu from database
* @return boolean
*/
  public function delete($menuid){
    try{
      $sql="DELETE FROM `menu` WHERE `id`=?";
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->bind_param("i",$menuid);
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
* function to select array of object of type Menu from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Menu
*/
  public function selectByWhereClause($whereClause){
    try{
      $sql="SELECT * FROM menu  WHERE ".$whereClause;
      $stmt=Database::getConnection()->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      $objects = array();
      while($row=$result->fetch_assoc()){
        $menu = $this->getFields($row);
        $objects[]=$menu;
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
* function to select array of object of type Menu from database
* @param values: whereClause containing search conditions.
* @return array of objects of type Menu
*/
  public function getFields($row){
    $menu= new Menu();
      $menu->setid($row['id']);
      $menu->setIcon($row['icon']);
      $menu->setname($row['name']);
      $menu->setLabel($row['label']);
      $menu->setUrl($row['url']);
      $menu->setTarget($row['target']);
      $menu->setparentId($row['parentId']);
      $menu->setprofileId($row['profileId']);
      $menu->setidName($row['idName']);
    return $menu;
  }
}
