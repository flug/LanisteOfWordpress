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
       if(!empty($_GET['id_cat']))
       {
           $cat = $post->get_the_categorie($_GET['id_cat']);
           
           
           $id_cat = $_GET['id_cat'] ; 
        }
        ?>
            
            <div id="tablerow2">
            <form action="<?php echo (!empty($_GET['id_cat']))? $_SERVER['PHP_SELF'].'?id_cat='.$_GET['id_cat'] : $_SERVER['PHP_SELF'] ;?>" method="post" >
            
                <input type="text" name="post_categorie"  size="40" id ="post_categorie" value="<?php echo (@$_POST['post_categorie'])? @$_POST['post_categorie'] : @$cat['intitule'] ?>"/>
                <br/>
                <?php echo (!empty($_GET['id_cat']))? '<input type="hidden" name="id_cat" value="'.$_GET['id_cat'].'"/>' : ''; ?>
                <input type="hidden" name="action" value="<?php echo  (!empty($_GET['id_cat']))? 'update_categorie' : 'ajout_categorie'; ?>"  />
                <input type="submit" value="<?php echo  (!empty($_GET['id_cat']))? 'Modifier la categorie' : 'Ajouter une catégorie';?>" />
            </form><?php
        $row = $post->the_categories(); 
     
          
          
          ?>
                </div>
            <div id="tablerow1">
            <table  class="widefat">
                <tr><th class="manage-column">Sélection</th><th class="manage-column">Action</th></tr>
                <?php 
                
        
                foreach ($row as $value)
                {
                  
                  echo ' <tr><td>'.$value['intitule'].'</td><td><a href="gestion_categories.php?id_cat='.$value['id'].'&amp;action=supprimer_cat"><img src="images/cross.png" /></a><a href="gestion_categories.php?id_cat='.$value['id'].'"><img src="images/edit.png" /></a></td></tr>' ; 
                  
                }
                ?>
                
                
                
            </table>
            
            
            
            </div>
            
              <?php include('inc/footer.php') ?>