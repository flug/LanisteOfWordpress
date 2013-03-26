<?php

// var_dump($_POST); 

 /* 'url' => string 'rrzerez' (length=7)
  'login' => string 'rzerezr' (length=7)
  'mdp' => string 'rzerzerzrerz' (length=12)
  'hote' => string 'localhost' (length=9)
  'login_bdd' => string 'erzerzerz' (length=9)
  'mdp_bdd' => string 'erzerzerz' (length=9)
  'url_ftp' => string 'dfgdgdf' (length=7)
  'login_ftp' => string 'rzer' (length=4)
  'mdp_ftp' => string 'erzrzerze' (length=9)
  'action' => string 'ajout_site' (length=10)*/
if(!empty ($_POST['url']))
{
    if(!empty ($_POST['login']))
    {
        if(!empty ($_POST['mdp']))
        {
            
            if(!empty ($_POST['hote']))
            {
                
                if(!empty ($_POST['login_bdd']))
                {
                    if(!empty ($_POST['mdp_bdd']))
                    {
                        if(!empty ($_POST['url_ftp']))
                        {
                            if(!empty ($_POST['login_ftp']))
                            {
                                
                                
                                $req['ajout_site'] = "UPDATE identifiant_blog 
                                                      SET url = :url , login = :login , mdp = :mdp, hote= :hote, login_bdd = :login_bdd, 
                                                      mdp_bdd = :mdp_bdd, url_ftp = :url_ftp , login_ftp = :login_ftp , mdp_ftp = :mdp_ftp WHERE id = :id " ; 
                              $sth =   $cnx->prepare($req['ajout_site']); 
                               $sth->execute(array(':url'       => $_POST['url']         , 
                                                   ':login'     => $_POST['login']       , 
                                                   ':mdp'       => $_POST['mdp']         , 
                                                   ':hote'      => $_POST['hote']        , 
                                                   ':login_bdd' => $_POST['login_bdd']   , 
                                                   ':mdp_bdd'   => $_POST['mdp_bdd']     ,
                                                   ':url_ftp'   => $_POST['url_ftp']     ,
                                                   ':login_ftp' => $_POST['login_ftp']   ,
                                                   ':mdp_ftp'   => $_POST['mdp_ftp']     ,
                                                   ':id'        => $_POST['blog_id']     ,
                                                   ));
                            $error_string ="le site a bien été ajouté" ; 
                                
                            }
 else {
    $error_string = "le login ftp est vide" ; 
}
                        }
 else {
    $error_string = "l'url ftp est vide" ; 
}
                    }
 else {
    $error_string ="le mot de passe de la base de donnée est vide" ; 
}
                }
 else {
    $error_string = "Le login de la base de donnée est vide"; 
}
            }
            else
            {
                $error_string ="l'hote est vide" ; 
            }
        }
        else{
            $error_string = "le mot de passe est vide"  ;
        }
    }
 else {
        $error_string="le login est vide"; 
    }
}
else{
    $error_string = "l'url est vide" ; 
}

?>
