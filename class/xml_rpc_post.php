<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of xml_rpc_post
 *
 * @author Marc
 */
class xml_rpc_post {
 
    public  $title; 
    public  $text ; 
    public  $categorie = array(); 
    public  $tag = array(); 
    private $login; 
    private $pass; 
    private $blog_url; 
    
    public $request; 
    public $xml_reponse; 
    public $response ;
    private $useragent = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
   
  
    
    
    
    
    private  function  get_response($URL, $context) {
        
         if(!function_exists('curl_init')) {
         die ("Curl PHP package not installed\n");
         }

         /*Initializing CURL*/
         $curlHandle = curl_init();

         /*The URL to be downloaded is set*/
        @curl_setopt($curlHandle, CURLOPT_URL, $URL);
        @curl_setopt($curlHandle, CURLOPT_HEADER, FALSE);
        @curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array("Content-Type: text/xml")); 
        @curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $context);
        @curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true); 
        

         /*Now execute the CURL, download the URL specified*/   
        return   @curl_exec($curlHandle); 
        }

        
  public function create_category($name)
    {
        if (!$name)
        {
            return false;
        }
        
       
   foreach($name as $row){
             $category["name"] = $row;
             
           $this->request = xmlrpc_encode_request("wp.newCategory",array(1,$this->login, $this->pass, $category));
           
          
         
             $this->xml_reponse =  @$this->get_response($this->blog_url."/xmlrpc.php", $this->request); 
         $this->response = xmlrpc_decode($this->xml_reponse); 
   }
           
           
           
          // $this->request  = xmlrpc_encode_request("metaWeblog.newPost", array(0,$user, $password, $content)); 
       
        return  $this->xml_reponse;
    }
    
        
        public function send_article_xml_rpc($user, $password, $blog_url, $title, $text,$date, $categorie , $tag )
        {
          /*  $content['title'] = $title; 
            $content['description'] = $text; 
            $content['categories'] = $categorie; 
            $content['dateCreated'] = '<dateTime.iso8601>'.$date. '</dateTime.iso8601>'; 
            
            */
            
            $this->login = $user; 
            $this->pass = $password; 
            $this->blog_url = $blog_url; 
            
            $cat = $this->create_category($categorie); 
       
            if($cat != false){
                    $content = array(
                                    'title' => utf8_decode($title),
                                    'description' => utf8_decode($text) ,
                                    'mt_allow_comments' => 1,
                                    'mt_allow_pings' => 1,
                                    'post_type' => 'post',
                                    'date_created_gmt' => '%pubdate%', // Just as place holder here.
                                    'mt_keywords' => $tag,
                                    'categories'=> $categorie
                                );

            
            }
            $toPublish = true;
            $this->request  = xmlrpc_encode_request("metaWeblog.newPost", array(1,$user, $password, $content, $toPublish)); 
            $this->request = str_replace('<string>%pubdate%</string>',
                   '<dateTime.iso8601>' . $date . '</dateTime.iso8601>',
                  $this->request );
           
            $this->xml_reponse = $this->get_response($blog_url."/xmlrpc.php", $this->request);
           
          //  $this->response = xmlrpc_decode($this->xml_reponse);
            return  $this->xml_reponse; 
            
        }
        
        
        public function edit_article_xml_rpc($user, $password, $blog_url, $title, $text, $categorie , $tag=array(), $postid, $toPublish=true)
        {
            $cat = $this->create_category($categorie); 
   
            
                    $content = array(
                                    'title' => utf8_decode($title) ,
                                    'description' => utf8_decode($text),
                                    'mt_keywords' => $tag,
                                    'categories'=> $categorie, 
                                    
                                );

            
            
            //var_dump($content);
            // $toPublish = true;
            
            $this->request  = xmlrpc_encode_request("metaWeblog.editPost", array($postid ,$user, $password, $content, $toPublish)); 
        /*    $this->request = str_replace('<string>%pubdate%</string>',
                   '<dateTime.iso8601>' . $date . '</dateTime.iso8601>',
                  $this->request );*/
           
            $this->xml_reponse = $this->get_response($blog_url."/xmlrpc.php", $this->request);
           
           $this->response = xmlrpc_decode($this->xml_reponse);
            return   $this->response; 
            
        }
        public  function publication_article_xml_rpc($user, $password, $blog_url, $postid, $toPublish)
        {
           
         $this->request  = xmlrpc_encode_request("metaWeblog.getPost", array($postid , $user, $password)); 
         $this->xml_reponse = $this->get_response($blog_url."/xmlrpc.php", $this->request);
         $this->response = xmlrpc_decode($this->xml_reponse);
           
        //   var_dump($this->response);
         //  echo $this->response['post_status'];
         /*  echo $this->response['title'];
           echo $this->response['categories'];*/
           
        
          return $this->edit_article_xml_rpc($user, $password, $blog_url, $this->response['title'], $this->response['description'], $this->response['categories'], '', $postid, $toPublish);
          // echo $this->response['mt_keywords'];
          //  return   $this->response; 
        }
        
        
        
        public function get_article_xml_rpc ($user, $password, $blog_url, $postid)
        {
             $this->request  = xmlrpc_encode_request("metaWeblog.getPost", array($postid , $user, $password)); 
           $this->xml_reponse = $this->get_response($blog_url."/xmlrpc.php", $this->request);
             $this->response = xmlrpc_decode($this->xml_reponse);
             
             
             return $this->response;
        }
        
        
        
        
        
        public function delete_article_xml_rpc($user, $password, $blog_url, $postid)
        {
             $toPublish = false;
            
            $this->request  = xmlrpc_encode_request("metaWeblog.deletePost", array('',$postid ,$user, $password,$toPublish));
         
            $this->xml_reponse = $this->get_response($blog_url."/xmlrpc.php", $this->request);
           
           $this->response = xmlrpc_decode($this->xml_reponse);
            return   $this->response; 
        }
        
        public function get_rand_date($nb_j)
        {
             for($i = 0 ; $i<= $nb_j ; $i++ ){
          // $date =  strtotime("+".$i." day"); 

         $date[] = date('Ymd\TH:i:s' ,  strtotime("+".$i." day")); 
           }
        return $date[rand(0,$nb_j)]; 
        }
       
 
}

?>
