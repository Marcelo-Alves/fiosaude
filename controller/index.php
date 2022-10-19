<?php
namespace controller;
include_once "../model/inserir.php";
use Exception;
use inserir;
use model\inserir as ModelInserir;

class index{
    public static function lerxml(){
        try{
            if(isset($_FILES) && $_FILES['xml']['type'] == 'text/xml'){
            
                $caminho ="../upload/arquivo-xml-".date('dmyhis').".xml";
                if(move_uploaded_file($_FILES['xml']['tmp_name'],$caminho)){
                    $caminho = str_replace("\\","/",$caminho);
          

                    $myfile = fopen($caminho, "r") or die("Unable to open file!");

                    $xml = "";
                    while(!feof($myfile)) {
                        $xml .= fgets($myfile);
                    }
                    $xml =  str_replace("guiaSP-SADT","guiaSPSADT", $xml);

                    fclose($myfile);

                    $xml = simplexml_load_string($xml);
                    
                    //cadastra contratado
                    foreach($xml->prestadorParaOperadora->loteGuias->guiasTISS->guiaSPSADT as $solicitantes){
                            ModelInserir::inserirBanco("contratado",
                            '"'.$solicitantes->dadosSolicitante->contratadoSolicitante->cpfContratado.'",
                            "'.$solicitantes->dadosSolicitante->contratadoSolicitante->nomeContratado.'"');                        
                    }

                    //cadastra procedimmento
                    foreach($xml->prestadorParaOperadora->loteGuias->guiasTISS->guiaSPSADT as $procedimmento){
                        ModelInserir::inserirBanco("procedimento",
                        '"'.$procedimmento->procedimentosExecutados->procedimentoExecutado->procedimento->codigoProcedimento.'",
                        "'.$procedimmento->procedimentosExecutados->procedimentoExecutado->procedimento->descricaoProcedimento.'",
                        "'.$procedimmento->procedimentosExecutados->procedimentoExecutado->valorUnitario.'"');                        
                    }

                    //cadastra profissional
                    foreach($xml->prestadorParaOperadora->loteGuias->guiasTISS->guiaSPSADT as $profissional){
                        ModelInserir::inserirBanco("profissional",
                        '"'.$profissional->dadosExecutante->contratadoExecutante->cnpjContratado.'",
                        "'.$profissional->dadosExecutante->contratadoExecutante->nomeContratado.'"');                        
                    }
                    
                    //cadastra quantidade
                    foreach($xml->prestadorParaOperadora->loteGuias->guiasTISS->guiaSPSADT as $quantidade){
                        ModelInserir::inserirBanco("quantidade",'null'.
                        ',"'.$quantidade->cabecalhoGuia->numeroGuiaPrestador.'",
                        "'.$quantidade->procedimentosExecutados->procedimentoExecutado->valorTotal.'",
                        "'.$quantidade->procedimentosExecutados->procedimentoExecutado->quantidadeExecutada.'"');                        
                    }

                     //cadastra guia
                     foreach($xml->prestadorParaOperadora->loteGuias->guiasTISS->guiaSPSADT as $guia){
                        ModelInserir::inserirBanco("guia",
                        '"'.$guia->cabecalhoGuia->numeroGuiaPrestador.'",
                        "'.$guia->dadosSolicitante->contratadoSolicitante->cpfContratado.'",
                        "'.$guia->dadosExecutante->contratadoExecutante->cnpjContratado.'",
                        "'.$guia->procedimentosExecutados->procedimentoExecutado->procedimento->codigoProcedimento.'",
                        "'.$guia->procedimentosExecutados->procedimentoExecutado->dataExecucao.'"');                        
                    }

                    echo json_encode(array("sucesso"=>"Arquivo importado com sucesso."));

                    return null;
                }
                else{
                    echo json_encode(array("erro"=>"Não foi possível fazer o upload do arquivo."));
                    return null;
                }
            }
            echo json_encode(array("erro"=>"Por favor, escolhar um arquivo XML."));
            return null;
        } 
        catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    } 
}
index::lerxml();

?>