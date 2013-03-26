<?php include 'inc/header_config.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
       <link rel="stylesheet" href="menu/menu_style.css" type="text/css" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <script type="text/javascript" src="javascript/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="javascript/TinyMce.js"></script>
    </head>
    <body>
        <div id="container" >
        <?php
        include 'menu/index.php' ; 
        
        echo @$error_string ; 
        ?>
            
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="ajout_blog">
                
                <fieldset ><legend>Identifiant wordpress</legend>
                    <label for="url" >Url: </label> <input type="text" name="url" id="url" value="<?php echo @$_POST['url'] ?>"/>
                <label for="login" >Login : </label> <input type="text" name="login" id="login" value="<?php echo @$_POST['login'] ?>" />
                <label for="mdp" >Mot de passe </label> <input type="text" name="mdp" id ="mdp" value="<?php echo @$_POST['mdp'] ?>" />
                </fieldset>
                <fieldset ><legend >Base de donnée</legend>
                    <label for="hote" >Hote : </label><input type="text" name="hote" id="hote" value="localhost"  />
                    <label for="login_bdd" >Login Base de donnée : </label><input type="text" name="login_bdd" id="login_base" value="<?php echo @$_POST['login_bdd'] ?>" />
                    <label for="mdp_bdd">Mot de passe base de donnée : </label> <input type="text" name="mdp_bdd" id="mdp_bdd" value="<?php echo @$_POST['mdp_bdd'] ?>" />
                    
                    
                </fieldset>
                
                
                <fieldset> <legend>Identifiant ftp</legend>
                    
                    <label for="url_ftp" >Url FTP : </label> <input type="text" name="url_ftp" id="url_ftp" value="<?php echo @$_POST['url_ftp'] ?>" />
                    <label for ="login_ftp" >Login FTP : </label><input type="text" name="login_ftp" id="login_ftp"  value="<?php echo @$_POST['login_ftp'] ?>"/>
                    <label for="mdp_ftp" >Mot de passe FTP : </label><input type="text" name="mdp_ftp" id="mdp_ftp"  value="<?php echo @$_POST['mdp_ftp'] ?>"/>
            
             </fieldset>
            
            
                <input type="hidden" name="action" value="ajout_blog" />
                <input type="submit"  value="Ajouter le site" />
            </form> 
            
     
                 <?php include('inc/footer.php') ?>