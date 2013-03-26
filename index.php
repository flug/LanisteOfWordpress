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
             <div id="tablerow1">
            <table  class="widefat" style="width: 100%">
                <tr><th class="manage-column">Article</th><th class="manage-column ">Article diffusé</th><th class="manage-column">Action</th></tr>
        

 <?php    foreach ($post->the_articles() as $value )
         {
   echo '<tr><td id="article_'.$value['id_article'].'"> '.$value['title'].'   </td><td class="align-center"><a href="liste_articles.php?id_article='.$value['id_article'].'" target="_blank" >'.$post->nb_article_online($value['id_article']).' </a></td><td><a href="modifier_article.php?id_article='.$value['id_article'].'"><img src="images/edit.png"/></a><a href="index.php?id_article='.$value['id_article'].'&amp;action=new_add"><img src="images/arrow_circle_double.png" /></a></td></tr>';
    
         }
   ?>
           </table>
            
            
            
            </div>  
     <?php include('inc/footer.php') ?>