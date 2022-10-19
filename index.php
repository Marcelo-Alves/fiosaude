<?php
include_once "./template/topo.php";
?>
<h1>Index</h1>

    <div id="mensagem" name="mensagem" ></div>
    <div class="input-group mb-3">
        <input type="file" name="xml" id="xml" accept="text/xml" class="form-control form-control-lg" />
        <button class="btn btn-secondary" onclick="jsUpload()">Enviar</button>
    </div>


<?php
include_once "./template/rodape.php";
?>