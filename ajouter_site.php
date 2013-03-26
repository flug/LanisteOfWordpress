<?php include 'inc/header_config.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
            <input type="text" id="url" name="url" value="<?php echo (!$_POST['url'])? $config_default_ajout_site_url : $_POST['url'] ?>" onblur="this.value=(this.value=='') ? '<?php echo $config_default_ajout_site_url ?>' : this.value;" onfocus="this.value=(this.value=='<?php echo $config_default_ajout_site_url ?>') ? '' : this.value;" /><br/><br/>
            <input type="text" name="nom_site" id="nom_site" value="<?php echo (!$_POST['nom_site'])? $config_default_ajout_nom_site : $_POST['nom_site'] ?>" onblur="this.value=(this.value=='') ? '<?php echo $config_default_ajout_nom_site ?>' : this.value;" onfocus="this.value=(this.value=='<?php echo $config_default_ajout_nom_site ?>') ? '' : this.value;" /><br/><br/>
                
            <input type="hidden" name="action" value="ajout_site"/>
            <input type="submit" value="Ajouter le site" />
        </form>
             <?php include('inc/footer.php') ?>