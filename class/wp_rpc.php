<?php

class wp_rpc {    
    private $url;     

private $login;    
private $pass;    
private $rpc;     
private $erreurs = array();    
public $useragent;     
/**      * WordPress_client::__construct()      *      
 * @param mixed $url    
 * @param mixed $login     
 * @param mixed $pass      
 * @param string $useragent      
 * @return     
 **/   
public function __construct($url, $login, $pass, $useragent = '')     
        {         $this->url = $url;

        $this->login = trim($login);
        $this->pass = trim($pass);
        $this->useragent = (!$useragent)?'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)':$useragent;
        $this->rpc = new IXR_Client($this->url, false, 80, $this->useragent);
    }
    public function verif_rpc()
    {
        #echo '';
        #var_dump($this->rpc->query("wp.getUsersBlogs", $this->login, $this->pass));
        #echo '';
        return $this->rpc->query("wp.getUsersBlogs", $this->login, $this->pass);
    }
    /**
     * wp_rpc::create_category()
     *
     * @param mixed $name
     * @return
     */
     
    public function create_category($name)
    {
        if (!$name)
        {
            return false;
        }
            $category["name"] = $name;
           $status = $this->rpc->query("wp.newCategory","", $this->login, $this->pass,$category);
        if (!$status)
        {
            $this->erreurs[] = "Erreur( ".$this->rpc->getErrorCode().") : ".$this->rpc->getErrorMessage()."\n";
        }
        return $this->rpc->getResponse();
    }
    /**
     * WordPress_client::poster_article()
     *
     * @param mixed $titre
     * @param mixed $categorie
     * @param mixed $article
     * @return
     */
    public function poster_article_metaweblog($titre, $categorie, $article,$tags,$dateToPost)
    {
         $cat = $this->create_category($categorie);
         if ($cat != false)
         {
             $content_struct['title'] = $titre;
             $content_struct['description'] = $article;
             $content_struct['categories'] = array ($categorie);
             $content_struct['mt_keywords'] = $tags;
             if ($dateToPost)
             {
/*
|--------------------------------------------------------------------------
| Formatage de la date pour schéduler
|--------------------------------------------------------------------------
|   date('Ymd\TH:i:s',time()); // tout simplement
|   OU
|   $oneDay = 60*60*24; // en programmant des datas alétoires ( passées/futures)
|   $now = time();
|   $post_interval = (0);
|   $year = rand (2005,date('Y')); //optionnel
|   $dateToPost = date('Ymd\TH:i:s',$now+(3*$oneDay));
|
*/
                  $date = new IXR_Date($dateToPost);
                  $content_struct['dateCreated'] =  $date;
             }
              if (!$this->rpc->query("metaWeblog.newPost","", $this->login, $this->pass,$content_struct,'publish'))
            {
                $this->erreurs[] = 'Votre  <a href="http://www.secrets-de-comment.com#articles_libres_de_droit" title="article">article</a> $titre semble posté sur votre blog mais une erreur dans la réponse renvoyée par votre Blog est survenue :';
                $this->erreurs[] = "Erreur ( ".$this->rpc->getErrorCode()." ) : ".$this->rpc->getErrorMessage()."\n";
            }
            return ($this->rpc->getResponse())?$this->rpc->getResponse():'Erreur';
         }
         else
         {
              return false;
         }
    }
}

?>
