<script type="text/javascript" src="js/custom/_alternative-profile.js?v=1673683558"></script>
<script type="text/javascript" src="js/custom/_profile.js?v=1673683558"></script>
<script type="text/javascript" src="js/custom/menu.js?v=1673683558"></script>
<script type="text/javascript" src="js/custom/privilege.js?v=1673683558"></script>
<script type="text/javascript" src="js/custom/users.js?v=1673683558"></script>
<script>
  $(document).ready(()=>{
    <?php if(sizeof($_GET)<2){ ?>
    <?php }else{ 
      $params = []; //grab params from url
      foreach($_GET as $key=>$value){
          if($key !='view' && $key!='section'){
            $params[] = $key.":'$value'";
          }
      }
        //process variables as calls to views
        echo $_GET['view'].'.'.$_GET['section'].'({'.implode(",",$params).'})';
    } ?>
  });
</script>