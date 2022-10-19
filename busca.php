<?php
include_once "./template/topo.php";
?>
<h1>Busca</h1>
<div id="mensagem" name="mensagem" ></div>
<div class="row">
    <div class="col">
        <select name="seltipo" id="seltipo" class="form-control" onchange="trocaPlaceholder()">
            <option value="">Selecione um tipo de pesquisa</option>
            <option value="g.numeroguiaprestador">Guia</option>
            <option value="g.cnpjcontratado">Profissional</option>
            <option value="g.codigoprocedimento">Procedimento</option>
        </select>
    </div>
    <div class="col">
        <input type="text" name="txtbusca" id="txtbusca" class="form-control">
    </div>
    <div class="col">
        <button onclick="jsBusca()">Buscar</button>
    </div>
    <br>
    
    <div id="tabeladiv"></div>



    <!-- profissionais, procedimentos, custo do procedimento e quantidade de procedimento da guia-->
</div>
<?php
include_once "./template/rodape.php";
?>