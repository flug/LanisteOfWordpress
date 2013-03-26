<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cnx
 *
 * @author Marc
 */
class cnx extends PDO{
    private $engine = "mysql";
    private $host = "localhost";
    private $database = "batiatus";
    private $user = "batiatus";
    private $pass ="PyUqaKw4GNRLmmCy";
   
    public function __construct(){
  
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    } 
}

?>
