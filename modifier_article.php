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
        
        $row = $post->get_the_article($_GET['id_article']);
echo $error_string; 
if(!empty($_GET['id_article']) && !$_GET['action']){
  
 ?>
          
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id_article=<?php echo $_GET['id_article'] ?>" method="post" >
              <div class="column">
                <label for="title">Titre</label> <input type="text" name="post_title" id ="title" size="60" value="<?php echo $row['title'] ?>"/>
                <label for="content" >Article</label>
                <textarea name="content" id="content" ><?php echo $row['post'] ?></textarea>
                <input type="hidden" name="id_article" value="<?php echo $row['id_article']?>" />
                <input type="hidden" name="action" value="modif_post" />
                <input type="submit" value="Modifier l'article" />
              
           </div>
                <div class="inner-sidebar">
                    
                          <div id="dossierdiv" class="postbox ">
                        <h3><span>Dossiers</span></h3>
                        <div id="dossier-all"><ul><li>
                        <select name="dossier" id="dossier" >
                            <option value="0">------------</option>
                    <?php foreach ($dossier->the_folders() as $value){
                        
                        echo '<option value="'.$value['id'].'" '.$post->is_selected($value['id'],$row['id_dossier'] ).'>'.$value['nom_site'].'</option>';
                    }
?></select></li></ul></div>
                    </div>
                    
            <?php $tag = $post->the_tags();
                    $cat = $post->the_categories();?>
                <div id="categorydiv" class="postbox ">
                    <h3><span>Catégorie</span></h3>
                    <div id="category-all" class="tabs-panel">
                 <ul>
                <?php 
                foreach($cat as $value){
                 
               echo '<li><input type="checkbox" name="post_category[]" value="'.$value['id'].'" id="cat_'.$value['id'].'" '.$post->is_checked($value['id'], json_decode($row['id_categories'])).' /><span><label for="cat_'.$value['id'].'">'.$value['intitule'].'</label></span></li>' ; 
                } ?>
                    </ul>
                        </div>
            </div>
            <div id="container_tag" class="postbox ">
                <h3><span>Tag</span></h3>
                <div id="tag-all">
                <ul>
                <?php 
                foreach($tag as $value){
               echo '<li><input type="checkbox" name="post_tag[]" value="'.$value['id'].'"  id="tag_'.$value['id'].'"  '.$post->is_checked($value['id'], json_decode($row['id_tags'])).' /><span><label for="tag_'.$value['id'].'">'.$value['tag'].'</label></span></li>' ; 
                } ?>
                    </ul>
                    </div>
            </div>
                    <div id="container_date" class="postbox ">
                <h3><span>Date de publication</span></h3>
                <div id="date-all">
                <ul>
                    <li><select name="date" id="datetime" class="">
               <?php for($i = 0 ;$i <= 7 ; $i++ )
               {
                   echo ($i <= 1 )?'<option value="'.$i.'" '.$post->is_selected($i , $row['date_publication']).'>'.$i. ' jour </option>' : '<option value="'.$i.'" '.$post->is_selected($i , $row['date_publication']).'>'.$i. ' jours </option>'  ;  
               }
                   ?> </select></li></ul>
                    </div>
            </div>
           
            </div>
            </form>
            </div>
        <?php }else { ?>
           <div id="tablerow1">
            <table  class="widefat" style="width: 100%">
                <tr><th class="manage-column">Sélection</th><th class="manage-column">Dossiers</th><th class="manage-column">Action</th></tr>
        <?php $liste = $post->the_articles();  
        
      foreach($liste as $value )
      {
         
          echo ' <tr><td>'.$value['title'].'</td><td><a href="'.$value['url_dossier'].'">'.$value['nom_dossier'].'</a></td><td><a href="modifier_article.php?id_article='.$value['id_article'].'&amp;action=delete_post"><img src="images/cross.png" /></a>'.$post->publish_to_unpublish($value['id_article']).'<a href="modifier_article.php?id_article='.$value['id_article'].'"><img src="images/edit.png"/></a></td></tr>' ; 
      }
        
        
        ?>
        
        
        
        <?php } ?>
            </table>
            
            
            
            </div>  
      <?php include('inc/footer.php') ?>