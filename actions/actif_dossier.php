<?php



if(!empty($_GET['id_dossier']))
{
    
    $dossier->activation_desactivation_dossier((int)$_GET['id_dossier'], 0, false);
    
    header('Location: modifier_site.php');
    
}
?>
