<?php
if(!empty($_GET['id_article'])){
   $blog = $site->edit_the_post_blog(); 
                  
                foreach ($blog as $row)
                {
                    $xml_rpc = new xml_rpc_post();
                    $rep = $xml_rpc->publication_article_xml_rpc($row['login'], $row['mdp'], $row['url'], (int)$row['id_articlesurblog'], true);
                    
                }
                if($rep)
                {
                   $post->update_publish($_GET['id_article'], 1);
                }
}
                else
                {
                }


?>
