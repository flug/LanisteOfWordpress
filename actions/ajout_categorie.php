<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// http://joysofprogramming.com/category/web/xml-rpc/
// http://www.google.fr/search?q=metaWeblog.newPost&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:fr:official&client=firefox-a#sclient=psy-ab&hl=fr&safe=off&client=firefox-a&hs=1Cz&rls=org.mozilla:fr%3Aofficial&source=hp&q=metaWeblog.+wordpress&pbx=1&oq=metaWeblog.+wordpress&aq=f&aqi=&aql=&gs_sm=e&gs_upl=5117l6760l1l6924l10l8l0l0l0l0l918l4263l5-3.3l6l0&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=be8c2a17ec24cd5&biw=1278&bih=789

//http://fr.php.net/manual/fr/function.xmlrpc-encode-request.php

//http://www.thugeek.com/web/simuler-une-fausse-video-pour-google/



if(!empty($_POST['post_categorie']))
{
    
   $req['categorie'] =  "SELECT * FROM categories WHERE intitule = :post_categorie" ; 
    
   $sth =  $cnx->prepare($req['categorie']); 
   
   $sth->execute(array(':post_categorie' => trim($_POST['post_categorie']))); 
   
   if($sth->rowCount() != 1 )
   {
       $req['inster_cat']= "INSERT INTO categories SET intitule = :post_categorie"; 
      $sth = $cnx->prepare ($req['inster_cat']) ; 
      $sth->execute(array(':post_categorie' => trim($_POST['post_categorie']))) ; 
      
      
      
     
       
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
