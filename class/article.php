<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article
 *
 * @author Marc
 */
class article {
    //put your code here
    
    private $id; 
    public $tag_arr  = array();
    public $cat_arr  = array();
    
    private $id_article ; 


    public function the_categories()
    {
        $cnx = new cnx(); 
        $req['liste_cat']  = "SELECT * FROM categories "; 
      return $cnx->query($req['liste_cat']) ;
    }
    public function get_the_categorie($id)
    {
        $cnx= new cnx (); 
        $this->id = $id; 
        $req['cat']='SELECT * FROM categories WHERE id = :id'; 
        $sth = $cnx->prepare($req['cat']); 
       $sth->execute(array(':id' => $this->id)); 
       return $sth->fetch();
    }
    public function the_tags()
    {
        $cnx = new cnx(); 
        $req['liste_tag']  = "SELECT * FROM tags "; 
      return $cnx->query($req['liste_tag']) ;
    }
    public function get_the_tag($id)
    {
        $cnx= new cnx (); 
        $this->id = $id; 
        $req['tag']='SELECT * FROM tags WHERE id = :id'; 
        $sth = $cnx->prepare($req['tag']); 
       $sth->execute(array(':id' => $this->id)); 
       return $sth->fetch();
    }
    public function get_array_tags($id_tag)
    {
       
        for ($i = 0  ; $i < count($id_tag); $i++)
        {
         $tag = self::get_the_tag($id_tag[$i]); 
            $this->tag_arr[] =  $tag['tag']; 

        }
        return  $this->tag_arr ; 
    }
    public function get_array_categories($id_cat)
    {
      
     for ($i = 0  ; $i < count($id_cat); $i++)
        {
            $cat = self::get_the_categorie($id_cat[$i]);
            $this->cat_arr[] = $cat['intitule']; 
        }
        return $this->cat_arr; 
    }
    public function spinnage($text)
    {
         if(!preg_match('/{/si', $text)) {
         return $text;
         }else {
            preg_match_all('/\{([^{}]*)\}/si', $text, $matches);
            $occur = count($matches[1]);
        for ($i=0; $i<$occur; $i++){

        $word_spinning = explode('|',$matches[1][$i]);
        shuffle($word_spinning);
        $text = str_replace($matches[0][$i], $word_spinning[0], $text);

         }
        return self::spinnage($text);
         }
    }
    
        public function the_articles()
    {
         $cnx= new cnx(); 
        $req['article'] ="SELECT post,d.url as url_dossier ,d.nom_site as nom_dossier, date_publication, title, id_article, id_categories, id_tags 
                          FROM articles as a 
                          LEFT JOIN id_articles_categories_tags as act 
                          ON act.id_article = a.id 
                          LEFT JOIN dossiers as d ON d.id = a.id_dossier ";
        return $cnx->query($req['article']) ;
    }
    
    
    public function get_the_article ($id)
    {
        $this->id_article = (int)$id; 
        $cnx= new cnx(); 
        $req['article'] ="SELECT post, date_publication, title, id_article, id_categories, id_dossier, id_tags FROM articles as a 
            LEFT JOIN id_articles_categories_tags as act ON act.id_article = a.id WHERE a.id  = :id_article" ; 
     $sth = $cnx->prepare($req['article']); 
       $sth->execute(array(':id_article' => $this->id_article)); 
       return $sth->fetch();
        
    }

    
    public function get_the_blog_article($id)
    {   $this->id_article = (int)$id; 
        $cnx= new cnx();
        $req['article']  =  "SELECT url, login, mdp,a.id,id_articlesurblog   FROM `articles` as a  
                            LEFT JOIN id_article_blog_articlesurblog as iaba ON a.id = iaba.id_article 
                            LEFT JOIN id_articles_categories_tags as iact 
                            ON a.id = iact.id_article 
                            LEFT JOIN  identifiant_blog as ib 
                            ON iaba.id_blog = ib.id 
                            WHERE a.id = :id_article";
        $sth = $cnx->prepare($req['article']); 
       $sth->execute(array(':id_article' => $this->id_article)); 
       
       
       return $sth->fetchAll();
        
    }
    
    public function delete_article($id)
    {
        $cnx = new cnx();
        $req['article'] = "DELETE FROM articles WHERE id = :id_article";
        $sth = $cnx->prepare($req['article']); 
        $sth->execute(array(':id_article' => $id)); 
        return $cnx->errorInfo();
    }
    
    public function delete_id_tags_categories($id)
    {
        $cnx = new cnx();
        $req['article'] = "DELETE FROM id_articles_categories_tags WHERE id_article = :id_article";
        $sth = $cnx->prepare($req['article']); 
        $sth->execute(array(':id_article' => $id)); 
        return $cnx->errorInfo();
    }
    public function delete_id_article_sur_blog ($id)
    {
        $cnx = new cnx();
        $req['article'] = "DELETE FROM  id_article_blog_articlesurblog WHERE id_article = :id_article";
        $sth = $cnx->prepare($req['article']); 
        $sth->execute(array(':id_article' => $id)); 
        return $cnx->errorInfo();
    }

public function get_date_publication($id)
{
    $article = $this->get_the_blog_article($id);
   
   // var_dump($article); 
    foreach($article as $article)
    {
        $xml_rpc = new xml_rpc_post();
        $rep = $xml_rpc->get_article_xml_rpc($article['login'], $article['mdp'], $article['url'], $article['id_articlesurblog']);
      //  var_dump($rep); 
        
      //  echo $rep['post_status']; 
       
       $date = $rep['dateCreated']; 
     // echo   $date->timestamp."<br/>"; 
        if($rep['post_status'] == 'publish') {
   $array_date[] = $date->timestamp; }
     
    }
     return $array_date; 
}
public function nb_article_online($id)
{
    $i = 0; 
    $datetime = $this->get_date_publication($id);
    
    foreach($datetime as $date)
    {
        
        

        if(time()>= $date)
        {
            $i++;
        }
    }
   return $i .' / '. count($datetime) ; 
}
    
    public function publish_to_unpublish($id)
    {
        $cnx = new cnx (); 
        $req['article'] ="SELECT publication FROM articles WHERE id = :id_article"; 
         $sth = $cnx->prepare($req['article']); 
        $sth->execute(array(':id_article' => $id)); 
        $row = $sth->fetch() ; 
      if($row['publication'])
      {
          return '<a href="modifier_article.php?id_article='.$id.'&amp;action=unpublish_post"><img src="images/publish.png" alt="Dépublier l\'article" /></a>'; 
          
      }
 else {
          return '<a href="modifier_article.php?id_article='.$id.'&action=publish_post"><img src="images/unpublish.png" alt="Publier l\'article" /></a>'; 
      }
        
    }
public function update_publish($id, $toPublish)
{
     $cnx = new cnx (); 
        $req['article'] ="UPDATE articles SET publication =  :publish WHERE id = :id_article"; 
         $sth = $cnx->prepare($req['article']); 
        $sth->execute(array(':id_article' => $id, 
                            ':publish' => $toPublish
                )); 
}
    
    public function is_checked($champ1, $array)
    {   
        return (in_array($champ1, $array))? 'checked ="checked" ' : ''; 
        
    }
    public function is_selected($champs1 , $champs2){
        return ($champs1 == $champs2)? 'selected ="selected"' : ""; 
        
    }
    
    
    

    
}
?>
