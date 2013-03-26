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
        <div id="container">
         <?php
        include 'menu/index.php' ; 
        ?>
            <div id="link_article">
                <ul>
                <?php 
                
                $liste = $post->get_the_blog_article((int)$_GET['id_article']); 
               foreach($liste as $value){
                $xml_rpc = new xml_rpc_post();
                $the_link = $xml_rpc->get_article_xml_rpc ($value['login'], $value['mdp'], $value['url'], $value['id_articlesurblog']); 
            
            // echo $the_link['dateCreated']->timestamp; 
            if(time()>= $the_link['dateCreated']->timestamp)
        {
                echo '<li class="vert"><a href="'.$the_link['permaLink'].'" target="_blank">'.$the_link['permaLink'].'</a></li>';
           }
           else
           {
                echo '<li class="rouge"><a href="'.$the_link['permaLink'].'" target="_blank">'.$the_link['permaLink'].'</a></li>';
           }
               
               
               }
                
                ?>
                
                </ul>
                
            </div>
            
                <?php include('inc/footer.php') ?>