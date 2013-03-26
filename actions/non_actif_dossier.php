<?php



if(!empty($_GET['id_dossier']))
{
    
    $dossier->activation_desactivation_dossier((int)$_GET['id_dossier'], 1, true);
    
        header('Location: modifier_site.php');
    
}
?>
