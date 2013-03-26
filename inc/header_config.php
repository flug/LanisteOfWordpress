<?php set_time_limit(0);
include 'inc/config.php';


function __autoload($class)
{
    include'class/'.$class.'.php'; 
}



$cnx= new cnx();
$site= new site();
$post = new article(); 
$dossier= new gestion_dossiers(); 

include 'functions/functions.php' ; 




include 'actions/actions.php' ;
?>