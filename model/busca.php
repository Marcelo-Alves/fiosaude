<?php
namespace busca;
include_once 'banco.php';
use Exception;
use PDO;
use model\mysql;

class busca  {   
    public static function Retorno($campo,$tabela,$where) {
        try {
            $sql= "SELECT $campo FROM $tabela WHERE $where ;";           
            $rs = mysql::conexao()->prepare($sql);  
            $rs->execute();
            $dados=$rs->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (Exception $ex) {
            echo $ex->getMessage(). " Erro sql ". $sql;
        }        
    
    }
}