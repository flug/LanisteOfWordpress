<?php

if(!empty($_POST['id_tag']))
{
    
   $req['tag'] =  "SELECT * FROM tags WHERE tag = :post_tag" ; 
    
   $sth =  $cnx->prepare($req['tag']); 
   
   $sth->execute(array(':post_tag' => trim($_POST['post_tag']))); 
   
   if($sth->rowCount() != 1 )
   {
       $req['inster_cat']= "UPDATE tags SET tag = :post_tag WHERE id = :id_tag"; 
      $sth = $cnx->prepare ($req['inster_cat']) ; 
      $sth->execute(array(':post_tag' => trim($_POST['post_tag']),
                          ':id_tag'         => trim($_POST['id_tag'])
                         )) ; 
       
   } 
   else
   {
       $error_string = "Le tag existe déja"; 
   }
   





   
}
 else {
    $error_string = "Vous n'avez pas de tag"; 
}

?>
