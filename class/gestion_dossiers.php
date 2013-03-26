<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gestion_dossiers
 *
 * @author Marc
 */
class gestion_dossiers {
    //put your code here
    
    public $id; 
    public function the_folders()
    {
        $cnx = new cnx() ; 
        $req['liste_dossier'] = "SELECT * FROM dossiers ORDER BY nom_site ASC "; 
        return $cnx->query($req['liste_dossier']); 
        
    }
    public function get_the_folder($id)
    {
        $this->id = $id ; 
        $req['le_dossier'] = "SELECT * FROM dossiers  WHERE id = :id ";
        $cnx = new cnx(); 
       $sth = $cnx->prepare($req['le_dossier']); 
        $sth->execute(array( ":id" => $this->id
                ));
        
        
       return $sth->fetch();
    }
    public function delete_dossier($id)
    {
                $this->id= $id;
        $cnx = new cnx();
        $sth = $cnx->prepare('UPDATE dossiers SET actif = 0 WHERE id = :id_dossier');
        $sth->execute(array( ":id_dossier" => $this->id
                ));
    }
    public function activation_dossier($id)
    {
                $this->id= $id;
        $cnx = new cnx();
        $sth = $cnx->prepare('UPDATE dossiers SET actif = 1 WHERE id = :id_dossier');
        $sth->execute(array( ":id_dossier" => $this->id
                ));
    }
    
    public function activation_desactivation_dossier($id, $statut, $toPublish)
    {
           $this->id= $id;
        $cnx = new cnx();
        $req['dossier'] = "SELECT  d.id, ib.url as url_blog, login , mdp , publication, actif, id_articlesurblog, iaba.id_article  
                           FROM `dossiers` as d 
                           LEFT JOIN articles as a ON a.id_dossier = d.id 
                           LEFT JOIN id_article_blog_articlesurblog as iaba ON iaba.id_article = a.id 
                           LEFT JOIN identifiant_blog as ib ON id_blog = ib.id  
                           WHERE d.id = :id_dossier";
         $sth = $cnx->prepare($req['dossier']); 
        $sth->execute(array( ":id_dossier" => $this->id));
       foreach($sth->fetchAll() as $value)
       {
           $xml_rpc = new xml_rpc_post();
        $rep =  $xml_rpc->publication_article_xml_rpc($value['login'], $value['mdp'], $value['url_blog'], $value['id_articlesurblog'], $toPublish);
          
          /* print_r("<pre>");
          var_dump($value);
          print_r("</pre>");*/
       }
       
       
        $article = new article();
           $article->update_publish($value['id_article'], $statut);
        if($value['actif'])
        {
            $this->delete_dossier($this->id);
        }
        else
        {
            $this->activation_dossier($this->id);
        }
        return $rep; 
    }
    
    
        public function actif_or_not($id)
    {
        $cnx = new cnx (); 
        $req['dossier'] ="SELECT actif FROM dossiers WHERE id = :id_dossier"; 
         $sth = $cnx->prepare($req['dossier']); 
        $sth->execute(array(':id_dossier' => $id)); 
        $row = $sth->fetch() ; 
      if($row['actif'])
      {
          return '<a href="modifier_site.php?id_dossier='.$id.'&amp;action=actif_dossier"><img src="images/publish.png" alt="Désactiver le dossier" /></a>'; 
          
      }
 else {
          return '<a href="modifier_site.php?id_dossier='.$id.'&action=non_actif_dossier"><img src="images/unpublish.png" alt="Activer le dossier" /></a>'; 
      }
        
    }
    
    
    
}

?>
