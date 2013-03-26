<?php

if(!empty($_POST['url'])&& $_POST['url']!= $config_default_ajout_site_url)
{
    if(!empty($_POST['nom_site'])&& $_POST['nom_site'] != $config_default_ajout_nom_site)
    {
        
        $req['ajout_dossier'] ="INSERT INTO dossiers SET url = :url, nom_site = :nom_site" ; 
        $sth = $cnx->prepare($req['ajout_dossier']);
        $sth->execute(array( ":url" => $_POST['url'], 
                             ":nom_site" => $_POST['nom_site']            
        )); 
        
      
        header('Location: modifier_site.php?e='.urlencode('Le site a bien était ajouté')) ; 
    }
    
    else
    {
        $error_string="Nom du site est obligatoire" ; 
    }
}
else
{
    $error_string ="Vous devez indiquer un site"; 
}

?>
