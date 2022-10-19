<?php
namespace model;

use Exception;
use model\mysql;

include_once 'banco.php';


class inserir  {   
    
    public static function inserirBanco($tabela,$valores) {
        try {            
            $sql= "INSERT INTO $tabela values ($valores);";            
            $rs = mysql::conexao()->prepare($sql);  			
            $rs->execute();		           
        } catch (Exception $ex) {            
        }        
    }
    
}