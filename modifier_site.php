<?php include 'inc/header_config.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
        
        echo @$error_string ; 
        ?>

       <?php if(!empty($_GET['id_dossier'])&& !$_GET['action']) { 
           $row = $dossier->get_the_folder($_GET['id_dossier']); 
           ?>
        
         <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
            <input type="text" name="url" value="<?php echo $row['url']?>" /><br/><br/>
            <input type="text" name="nom_site" value="<?php echo $row['nom_site']?>" /><br/><br/>
            <input type="hidden" name="id_dossier" value="<?php echo $row['id']?>" />
            <input type="hidden" name="action" value="modif_site"/>
            <input type="submit" value="Modifier le site" />
        </form>
        
        <?php } else {?>
        
        <?php $liste = $dossier->the_folders(); ?>
         <div id="tablerow1">
            <table  class="widefat" style="width: 100%">
                <tr><th class="manage-column">Nom du site</th><th  class="manage-column">URL</th><th class="manage-column">Action</th></tr>
        
  <?php foreach($liste as $value )
      {
         
          echo ' <tr><td><a href="modifier_site.php?id_dossier='.$value['id'].'">'.$value['nom_site'].'</a></td>
<td>'.$value['url'].'</td>                

<td><a href="modifier_site.php?id_dossier='.$value['id'].'&amp;action=supprimer_dossier"><img src="images/cross.png" /></a>'.$dossier->actif_or_not($value['id']).'
    <a href="modifier_site.php?id_dossier='.$value['id'].'"><img src="images/edit.png" /></a>
</td></tr>' ; 
      }
        
        
        ?>
        <?php } ?>
            </table>
            </div>     
      <?php include('inc/footer.php') ?>