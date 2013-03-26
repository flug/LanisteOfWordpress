<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of site
 *
 * @author Marc
 */
class site {
    //put your code here
    
    private $id; 
    
    public function form_liste_blog ($metod= 'post', $action = '')
    {
        $cnx = new cnx() ; 
        $req['liste_site'] = "SELECT url, id FROM identifiant_blog" ; 
        
        $form =  '<form action="'.$_SERVER['PHP_SELF'].'" method="'.$metod.'">'; 
      //  var_dump($cnx->query($req['liste_site'])); 
       foreach($cnx->query($req['liste_site']) as $row)
       {
           $form .= '<input type="radio" name="site" value="'.$row['id'].'"/><span>'.$row['url'].'</span>'; 
       }
        
        $form .= '<input type="hidden" name="action" value="'.$action.'" />';
        $form .= '<input type="submit" value="Envoyer" />';
        $form .= '</form>';
        
        
        return $form; 
    }
    
    public function get_the_blog($id)
    {
        $cnx= new cnx();
        $this->id = $id; 
        $req['blog'] = "SELECT * FROM identifiant_blog WHERE id = :id "; 
        $sth = $cnx->prepare($req['blog']); 
       $sth->execute(array(':id' => $this->id)); 
      $row = $sth->fetch(); 
      return $row;
        
    }
    public function the_blogs ()
    {
         $cnx= new cnx();
      
        $req['blog'] = "SELECT * FROM identifiant_blog";
        return $cnx->query($req['blog']); 
    }
    
    public function edit_the_post_blog()
    {
          $cnx= new cnx();
        $req['blog'] = 'SELECT idbl.url, idbl.login, idbl.mdp, iaba.id_article ,iaba.id_blog,iaba.id_articlesurblog 
            FROM identifiant_blog as idbl 
            LEFT JOIN id_article_blog_articlesurblog as iaba 
            ON idbl.id = iaba.id_blog'; 
          return $cnx->query($req['blog']); 
    }
    
    
    
    public function statut_blog($url)
    {
        file_get_contents($url); 
        //var_dump($http_response_header);
         
        if(array_search(200, $http_response_header  ))
        {
            $statut = "Le site est oppérationel"; 
        }
        else
        {
            $statut = "Doit y avoir un problème sur le site "; 
        }
        echo $statut; 
    }
    
}

?>
