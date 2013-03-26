<?php include 'inc/header_config.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <link rel="stylesheet" href="menu/menu_style.css" type="text/css" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <script type="text/javascript" src="javascript/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="javascript/TinyMce.js"></script>
    </head>
    <body>
        <div id="container" >
        <?php
        include 'menu/index.php' ; 
        echo  @$error_string ; 
       if(!empty($_GET['id_tag']))
       {
           $tag = $post->get_the_tag($_GET['id_tag']);
           
           
           $id_tag = $_GET['id_tag'] ; 
        }
        ?>
            
            <div id="tablerow2">
            <form action="<?php echo (!empty($_GET['id_tag']))? $_SERVER['PHP_SELF'].'?id_tag='.$_GET['id_tag'] : $_SERVER['PHP_SELF'] ;?>" method="post" >
            
                <input type="text" name="post_tag"  size="40" id ="post_tag" value="<?php echo (@$_POST['post_tagegorie'])? @$_POST['post_tag'] : $tag['tag'] ?>"/>
                <br/>
                <?php echo (!empty($_GET['id_tag']))? '<input type="hidden" name="id_tag" value="'.$_GET['id_tag'].'"/>' : ''; ?>
                <input type="hidden" name="action" value="<?php echo  (!empty($_GET['id_tag']))? 'update_tag' : 'ajout_tag'; ?>"  />
                <input type="submit" value="<?php echo  (!empty($_GET['id_tag']))? 'Modifier le tag' : 'Ajouter un tag';?>" />
            </form><?php
        $row = $post->the_tags(); 
     
          
          
          ?>
                </div>
            <div id="tablerow1">
            <table  class="widefat">
                <tr><th class="manage-column">Sélection</th><th class="manage-column">Action</th></tr>
                <?php 
                
        
                foreach ($row as $value)
                {
                  
                  echo ' <tr><td>'.$value['tag'].'</td><td><a href="gestion_tag.php?id_tag='.$value['id'].'&amp;action=supprimer_tag"><img src="images/cross.png" /></a><a href="gestion_tag.php?id_tag='.$value['id'].'"><img src="images/edit.png" /></a></td></tr>' ; 
                  
                }
                ?>
                
                
                
            </table>
            
            
            
            </div>
            
              <?php include('inc/footer.php') ?>