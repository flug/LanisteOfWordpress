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
        ?>
          
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >
              <div class="column">
                <label for="title">Titre</label> <input type="text" name="post_title" id ="title" size="60" value="<?php echo @$_POST['post_title'] ?>"/>
                <label for="content" >Article</label>
                <textarea name="content" id="content" ><?php echo @$_POST['content'] ?></textarea>
                <input type="hidden" name="action" value="send_post" />
                <input type="submit" value="Enregistrer" />
                <?php echo $xml->xml_reponse ?>
           </div>
                <div class="inner-sidebar">
                    <div id="dossierdiv" class="postbox ">
                        <h3><span>Dossiers</span></h3>
                        <div id="dossier-all"><ul><li>
                        <select name="dossier" id="dossier" >
                            <option value="0">------------</option>
                    <?php foreach ($dossier->the_folders() as $value){
                        
                        echo '<option value="'.$value['id'].'">'.$value['nom_site'].'</option>';
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
               echo '<li><input type="checkbox" name="post_category[]" value="'.$value['id'].'" id="cat_'.$value['id'].'" /><span><label for="cat_'.$value['id'].'">'.$value['intitule'].'</label></span></li>' ; 
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
               echo '<li><input type="checkbox" name="post_tag[]" value="'.$value['id'].'"  id="tag_'.$value['id'].'" /><span><label for="tag_'.$value['id'].'">'.$value['tag'].'</label></span></li>' ; 
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
                   echo ($i <= 1 )?'<option value="'.$i.'">'.$i. ' jour</option>' : '<option value="'.$i.'">'.$i. ' jours </option>'  ;  
               }
                   ?> </select></li></ul>
                    </div>
            </div>
           
            </div>
            </form>
                <?php include('inc/footer.php') ?>