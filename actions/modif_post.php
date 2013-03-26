<?php

if(!empty($_POST['post_title']))
{
    if(!empty ($_POST['post_category']))
    {
        if(!empty ($_POST['post_tag']))
        {
            if(!empty($_POST['content']))
            {
                 if(!empty ($_POST['dossier']))
                {
                    
                     
                     
                                                  $req['update_article'] ="UPDATE articles SET post = :post, title = :title, date_publication = :date, id_dossier = :id_dossier WHERE id = :id_article"; 
                $sth = $cnx->prepare($req['update_article']);
                $sth->execute(array(':post' => $_POST['content'],
                                    ':title' => $_POST['post_title'], 
                                    ':date' => $_POST['date'], 
                                    ':id_article' =>$_POST['id_article'], 
                                    ':id_dossier' => $_POST['dossier']
                                    ));
                
                
                   $req['update_articles_categories'] = "UPDATE  id_articles_categories_tags SET id_article = :id_article, id_categories = :id_categories, id_tags  = :id_tags WHERE id_article = :id_article"; 
                   
                    $sth = $cnx->prepare($req['update_articles_categories']);
                $sth->execute(array(':id_article' => $_POST['id_article'], 
                                    ':id_categories' => json_encode($_POST['post_category']), 
                                    ':id_tags' => json_encode($_POST['post_tag']) ,
                                                                ));
                   
                     
                     
                $blog = $site->edit_the_post_blog(); 
                  
                foreach ($blog as $row)
                {
                    $xml_rpc = new xml_rpc_post(); 
                    
                    $cat = $post->get_array_categories($_POST['post_category']); 

                    $tag = $post->get_array_tags($_POST['post_tag']);   
                     
                    $title =  $post->spinnage($_POST['post_title']); 

                    $content =  $post->spinnage($_POST['content']); 

                    $date = $xml_rpc->get_rand_date($_POST['date']); 

                      $rep = $xml_rpc->edit_article_xml_rpc($row['login'], $row['mdp'], $row['url'], $title, $content , $cat , $tag, (int)$row['id_articlesurblog']);
                     // var_dump($row);
                     /* var_dump($row); 
                      var_dump($rep); 
                      */
                 //   var_dump($rep); 
                      
                      if($rep){

                 /*   $req['update_article_blog_articlesurblog'] = "UPDATE id_article_blog_articlesurblog SET id_article = :id_article, id_blog = :id_blog , id_articlesurblog = :id_reponse WHERE id_article = :id_article" ; 
              
                $sth = $cnx->prepare($req['update_article_blog_articlesurblog']);
                $sth->execute(array(':id_article' => $_POST['id_article'],
                                    ':id_blog' => $row['id'], 
                                    ':id_reponse' => $node, 
                    ));*/
                      }
                //$date = $xml_rpc->get_rand_date($_POST['date']); 
                   //  
                   //  
                   //  list( , $node) = each($result) ;
                     
             // header("Location: modifier_article.php?id_article=".$_POST['id_article'].'&e='.  urlencode('La modification est éffectué avec succès ! ')); 
                }
      
                }
                else
                {
                    $error_string ="Vous devez sélectionner un dossier" ; 
                }
            }
        }
    }
}


?>
