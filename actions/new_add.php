<?php
if($_GET['id_article'])
{
    foreach($site->the_blogs() as $blog)
    {
       // echo $blog['id']; 
        
       $sth =  $cnx->prepare('SELECT * FROM id_article_blog_articlesurblog WHERE id_article = :id_article AND id_blog = :id_blog');
        $sth->execute(array(':id_article' => $_GET['id_article'], 
                            ':id_blog' => $blog['id']
                    ));
      if(!$sth->rowCount())
      {
         $article = $post->get_the_article ($_GET['id_article']);
                 //echo $article['post']; 
        /* echo $blog['url']; 
         echo $blog['login'];
         echo $blog['mdp'];*/
         /*echo $article['title']; 
         echo $article['post']; 
         echo $article['date']; */
      /*   echo json_decode($article['id_categories']); 
         echo json_decode($article['id_tags']); */
        /* print_r('<pre>');
         
        var_dump($article);
         
         print_r('</pre>');*/
        $xml_rpc = new xml_rpc_post(); 
                    
                    $cat = $post->get_array_categories(json_decode($article['id_categories'])); 

                    $tag = $post->get_array_tags(json_decode($article['id_tags']));   
                     
                    $title =  $post->spinnage($article['title']); 

                    $content =  $post->spinnage($article['post']); 

                    $date = $xml_rpc->get_rand_date($article['date']); 


                  $rep = $xml_rpc->send_article_xml_rpc($blog['login'], $blog['mdp'], $blog['url'], $title, $content ,$date, $cat , $tag); 
                 // echo $rep ; 
        $xml = new SimpleXMLElement($rep); 
        $result = $xml->xpath('//string'); 
                        
                  
               list( , $node) = each($result) ;
                      // echo 'b/c: ',$node,"\n";
                   
         //    var_dump($rep); 
              //  echo $node; 
          
       
                   
               $req['insert_article_blog_articlesurblog'] = "INSERT INTO id_article_blog_articlesurblog SET id_article = :id_article, id_blog = :id_blog , id_articlesurblog = :id_reponse" ; 
              
                $sth = $cnx->prepare($req['insert_article_blog_articlesurblog']);
                $sth->execute(array(':id_article' => $_GET['id_article'],
                    ':id_blog' => $blog['id'], 
                    ':id_reponse' => $node
                    
                    ));
         
      }
        
        
    }
}
?>
