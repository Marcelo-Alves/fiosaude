<?php
namespace controller;

use busca\busca;

include_once '../model/busca.php';

class buscar{
    public static function Resposta(){

        $buaca_campo = $_POST['seltipo'] ."='".$_POST['txtbusca']."'";
        $retorno = busca::Retorno("*","guia g inner join profissional pf on g.cnpjcontratado = pf.cnpjcontratado
        inner join procedimento pr on g.codigoprocedimento = pr.codigoprocedimento
        inner join quantidade qe on g.numeroguiaprestador=qe.numeroguiaprestador",$buaca_campo);        

        $jsonretorno = (count($retorno) >0?$retorno: array('erro'=>'Código não existe.'));
        echo json_encode($jsonretorno);
    }
}

buscar::Resposta();



