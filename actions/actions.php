<?php
@$action = (isset($_POST['action']))? $_POST['action'] : $_GET['action'] ; 


if(file_exists($config_path.'/actions/'.$action.'.php'))
{
  
    include($action. '.php');
}
 else {
    header ('Location : '. $_SERVER['PHP_SELF'].'?e='.urlencode('Un Gros problème est survenu dans votre action !')); 
}

?>
