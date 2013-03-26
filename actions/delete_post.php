<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if($_GET['id_article'])
{
   $row = $post->get_the_blog_article($_GET['id_article']); 
foreach($row as $value)
{
    
    /*  echo $value['url'];
      echo $value['login'];
      echo $value['mdp'];
      echo $value['id_articlesurblog'];
     */
    $xml_rpc = new xml_rpc_post();
    $rep = $xml_rpc->delete_article_xml_rpc($value['login'], $value['mdp'], $value['url'], $value['id_articlesurblog']);
    //var_dump($rep);
}
$post->delete_article($_GET['id_article']);
$post->delete_id_tags_categories($_GET['id_article']);
$post->delete_id_article_sur_blog($_GET['id_article']);
    
}

?>
