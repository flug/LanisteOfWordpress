<?php

if(!empty($_POST['id_cat']))
{
    
   $req['categorie'] =  "SELECT * FROM categories WHERE intitule = :post_categorie" ; 
    
   $sth =  $cnx->prepare($req['categorie']); 
   
   $sth->execute(array(':post_categorie' => trim($_POST['post_categorie']))); 
   
   if($sth->rowCount() != 1 )
   {
       $req['inster_cat']= "UPDATE categories SET intitule = :post_categorie WHERE id = :id_cat"; 
      $sth = $cnx->prepare ($req['inster_cat']) ; 
      $sth->execute(array(':post_categorie' => trim($_POST['post_categorie']),
                          ':id_cat'         => trim($_POST['id_cat'])
                         )) ; 
       
   } 
   else
   {
       $error_string = "La catégorie existe déja"; 
   }
   





   
}
 else {
    $error_string = "Vous n'avez pas de catégorie"; 
}

?>
