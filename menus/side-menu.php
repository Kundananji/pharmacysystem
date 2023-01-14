<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
  <div class="sidebar-brand-icon">
    <img src="images/prof.jpg" style="width:60px"/>
  </div>
</a>



<hr class="sidebar-divider my-0">
<?php 
include_once("daos/_profile-dao.php");
include_once("classes/_profile.php");

include_once("classes/menu-target.php");
include_once("daos/menu-target-dao.php");

include_once("daos/menu-dao.php");
include_once("classes/menu.php");
include_once("config/database.php");

$menuDao = new MenuDao();

$menuTargetDao = new MenuTargetDao(); 

if(isset($_SESSION['user_profile_id'])){
  
    $profileDao = new Profiledao();
    $profile = $profileDao->select($_SESSION['user_profile_id']);
    if($profile){
     
        $profileId = $profile->getId();
        //get parent items
        $menus = $menuDao->selectByWhereClause("profileId = $profileId AND parentId IS NULL");
        foreach($menus as $menu){
            $menuId = $menu->getId();
            $target = $menuTargetDao->select($menu->getTarget());
            //check if it has children
            $children = $menuDao->selectByWhereClause("profileId = $profileId AND parentId =$menuId");
            if(sizeof($children)>0){
                ?>
                     <!-- Access Rights Settings-->  
         <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?php echo $menu->getName();?>"
                    aria-expanded="true" aria-controls="collapse<?php echo $menu->getName();?>">
                    <i class="fas fa-fw <?php echo $menu->getIcon();?>"></i>
                    <span><?php echo $menu->getLabel();?></span>
                </a>
                <div id="collapse<?php echo $menu->getName();?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"><?php echo $menu->getLabel();?></h6>

                        <?php
                          foreach($children as $child){
                            $target = $menuTargetDao->select($child->getTarget());
                            ?>
                                 <a class="collapse-item" href="<?php echo $child->getUrl() ?>" id="<?php echo $child->getIdName() ?>" <?php echo $target!=null?'target="'.$target->getName().'"':"" ?>><?php echo $child->getLabel() ?></a>
                            <?php
                          }

                        ?>    

                   
                    </div>
                </div>
            </li> 

                <?php

            }
            else{
                //no children
                ?>
                 <li class="nav-item">
                    <a class="nav-link" href="<?php echo $menu->getUrl()?>" <?php echo $target!=null?'target="'.$target->getName().'"':"" ?> id="<?php echo $menu->getIdName() ?>">
                        <em class="<?php echo $menu->getIcon() ?>"></em>
                        <span><?php echo $menu->getLabel() ?></span>
                    </a>
                </li>

               <?php 
            }
        }
    }

}
?>
                <!--only allowed profiles can view this menu item-->
                <?php
                if($_SESSION['user_profile'] == 'Admin'){
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" onclick="Profile.viewProfileProfiles_admin({})" href="javascript:void(0)" >
                        <em class="fa fa-user"></em>
                        <span>Profiles</span>
                    </a>
                    </li>
                <?php    
                }    
                ?>            
                
                <!--only allowed profiles can view this menu item-->
                <?php
                if($_SESSION['user_profile'] == 'Admin'){
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" onclick="AlternativeProfile.viewAlternativeProfileUserprofiles_admin({})" href="javascript:void(0)" >
                        <em class="fa fa-user"></em>
                        <span>User Profiles</span>
                    </a>
                    </li>
                <?php    
                }    
                ?>            
                
                <!--only allowed profiles can view this menu item-->
                <?php
                if($_SESSION['user_profile'] == 'Admin'){
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" onclick="Menu.viewMenuMenus_admin({})" href="javascript:void(0)" >
                        <em class="fa fa-list"></em>
                        <span>Menus</span>
                    </a>
                    </li>
                <?php    
                }    
                ?>            
                
                <!--only allowed profiles can view this menu item-->
                <?php
                if($_SESSION['user_profile'] == 'Admin'){
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" onclick="Privilege.viewPrivilegePrivileges_admin({})" href="javascript:void(0)" >
                        <em class="fa fa-key"></em>
                        <span>Privileges</span>
                    </a>
                    </li>
                <?php    
                }    
                ?>            
                
                <!--only allowed profiles can view this menu item-->
                <?php
                if($_SESSION['user_profile'] == 'Admin'){
                    ?>
                    <li class="nav-item">
                    <a class="nav-link" onclick="Users.viewUsersUsers_admin({})" href="javascript:void(0)" >
                        <em class="fa fa-users"></em>
                        <span>Users</span>
                    </a>
                    </li>
                <?php    
                }    
                ?>            
                </ul>

