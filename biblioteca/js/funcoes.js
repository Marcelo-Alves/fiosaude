function trocaPlaceholder(){
    const escolha = document.getElementById('seltipo');
    const txtbusca = document.getElementById('txtbusca');
    if(escolha.value == 'g.numeroguiaprestador'){
        txtbusca.placeholder='Digite número da Guia';
    }
    else if(escolha.value == 'g.cnpjcontratado'){
        txtbusca.placeholder='Digite CNPJ do profissional';
    }
    else if(escolha.value == 'g.codigoprocedimento'){
        txtbusca.placeholder='Digite código do Procedimento';
    }
    else{
        document.getElementById('txtbusca').placeholder='';
    }
}

function jsUpload(){
    
    const xml = document.getElementById('xml').files[0];
    const mensagem = document.getElementById('mensagem');
    mensagem.classList.add("alert");
    mensagem.classList.add("alert-dark");
    mensagem.innerHTML="Por favor, espere o arquivo ser processado";

    if(xml != null){
        if(xml.type == "text/xml"){
            const formdata = new FormData();
            formdata.append('xml',xml);
            const url = "controller/index.php";

            const requito =  new Request(url,{method: 'POST',body:formdata});
            fetch(requito)
            .then(resposta => resposta.json())
            .then(dados => {
                if(dados.erro){
                    mensagem.classList.remove("alert-dark");
                    mensagem.classList.add("alert-danger");
                    mensagem.innerHTML= dados.erro;
                }
                else{
                    mensagem.classList.remove("alert-dark");
                    mensagem.classList.add("alert-success");
                    mensagem.innerHTML= dados.sucesso;
                    xml.value = "";
                    xml.innerHTML="";
                }
            });

        }else{
            mensagem.classList.remove("alert-dark");
            mensagem.classList.add("alert-danger");
            mensagem.innerHTML="O arquivo tem que ser XML";
        }     
    }
    else{
        mensagem.classList.remove("alert-dark");
        mensagem.classList.add("alert-danger");
        mensagem.innerHTML="Por favor, escolhar um arquivo XML";
    }

    

}



function jsBusca(){
    const seltipo = document.getElementById("seltipo");
    const txtbusca = document.getElementById("txtbusca");
    const mensagem = document.getElementById('mensagem');
    

    if(seltipo.value != "" && txtbusca.values != ""){

        mensagem.classList.add("alert");
        mensagem.classList.add("alert-dark");
        mensagem.innerHTML="Por favor, espere a pesquisa ser executada";

        const formdata = new FormData();
        formdata.append('seltipo',seltipo.value);
        formdata.append('txtbusca',txtbusca.value);
        
        const url = "controller/buscar.php";

        const requito =  new Request(url,{method: 'POST',body:formdata});
        let html =" <table id='tabela' name='tabela' class='table'>";
                html=html +"<thead>";
                html=html +"<tr>";
                html=html +"<th scope='col'>Guia</th>";
                html=html +"<th scope='col'>Procedimento</th>";
                html=html +"<th scope='col'>Profissional</th>";
                html=html +"<th scope='col'>Quantidade</th>";
                html=html +"<th scope='col'>Valor</th>";
                html=html +"</tr>";
                html=html +"</thead>";
    
        fetch(requito)
        .then(resposta => resposta.json())
        .then(dados => {
                if(dados.erro){
                    mensagem.classList.remove("alert-dark");
                    mensagem.classList.add("alert-danger");
                    mensagem.innerHTML= dados.erro;
                }
                else{

                    dados.forEach((item, indice, array) => {
                        //console.log(item.numeroguiaprestador);
                        html=html +"<tr>";
                            html=html +"<td>"+item.numeroguiaprestador+"</td>";
                            html=html +"<td>"+item.descricaoprocedimento+"</td>";
                            html=html +"<td>"+item.nomecontratado+"</td>";
                            html=html +"<td>"+item.quantidadeexecucao+"</td>";
                            html=html +"<td>"+item.valortotal+"</td>";
                        html=html +"</tr>";

                    });
                    html=html +"</table>";
                    
                    document.getElementById("tabeladiv").innerHTML = html;
                    mensagem.classList.remove("alert-dark");
                    mensagem.classList.add("alert-success");
                    mensagem.innerHTML= "Arquivo importado com sucesso.";
                   /* xml.value = "";
                   }   xml.innerHTML="";*/
                }
            
        });
    }
    else{
        mensagem.classList.remove("alert-dark");
        mensagem.classList.remove("alert");
        mensagem.classList.add("alert");
        mensagem.classList.add("alert-danger");
        mensagem.innerHTML="Por favor, preencha todos os campos.";
    }
}
