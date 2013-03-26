<?php

if(!empty($_POST['post_title']))
{
    if(!empty ($_POST['post_category']))
    {
        if(!empty ($_POST['post_tag']))
        {
            if(!empty($_POST['content']))
            {
                if($_POST['dossier']!="0")
                {
                    
                $blog = $site->the_blogs(); 
                
                
                     $req['insert_article'] ="INSERT INTO articles SET post = :post, title = :title, date_publication = :date, id_dossier = :id_dossier"; 
                $sth = $cnx->prepare($req['insert_article']);
                $sth->execute(array(':post' => $_POST['content'],
                                    ':title' => $_POST['post_title'], 
                                    ':date' => $_POST['date'], 
                                    ':id_dossier' => $_POST['dossier']
                                    ));
             $last_id_article  = $cnx->lastInsertId();
          
                       $req['insert_articles_categories'] = "INSERT INTO id_articles_categories_tags SET id_article = :id_article, id_categories = :id_categories, id_tags  = :id_tags"; 
            //   var_dump($_POST['post_category']) ;
               
                   $sth = $cnx->prepare($req['insert_articles_categories']);
                $sth->execute(array(':id_article' => $last_id_article, 
                                    ':id_categories' => json_encode($_POST['post_category']), 
                                    ':id_tags' => json_encode($_POST['post_tag']) , 
                                    ));
                
                foreach ($blog as $row)
                {
                    $xml_rpc = new xml_rpc_post(); 
                    
                    $cat = $post->get_array_categories($_POST['post_category']); 

                    $tag = $post->get_array_tags($_POST['post_tag']);   
                     
                    $title =  $post->spinnage($_POST['post_title']); 

                    $content =  $post->spinnage($_POST['content']); 

                    $date = $xml_rpc->get_rand_date($_POST['date']); 

                //$date = $xml_rpc->get_rand_date($_POST['date']); 

                  $rep = $xml_rpc->send_article_xml_rpc($row['login'], $row['mdp'], $row['url'], $title, $content ,$date, $cat , $tag); 
                 // echo $rep ; 
        $xml = new SimpleXMLElement($rep); 
        $result = $xml->xpath('//string'); 
                        
                  
               list( , $node) = each($result) ;
                      // echo 'b/c: ',$node,"\n";
                   
         //    var_dump($rep); 
                
          
      
                   
               $req['insert_article_blog_articlesurblog'] = "INSERT INTO id_article_blog_articlesurblog SET id_article = :id_article, id_blog = :id_blog , id_articlesurblog = :id_reponse" ; 
              
                $sth = $cnx->prepare($req['insert_article_blog_articlesurblog']);
                $sth->execute(array(':id_article' => $last_id_article,
                    ':id_blog' => $row['id'], 
                    ':id_reponse' => $node
                    
                    ));
               
             
                }
                // header("Location: modifier_article.php?id_article=".$last_id_article.'&e=' .urlencode("L'article a était correctement envoyé et enregistré en base")); 
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
