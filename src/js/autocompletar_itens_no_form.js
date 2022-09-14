const carregar_produtos = async (valor) => {

    if (valor.length >= 2) {

        var dados = await fetch('./src/php/pesquisa_itens.php?cod_e_descricao=' + valor);
        var resposta = await dados.json();

        let div = document.getElementById('div');
        div.classList.remove('itensPesquisaInativo');
        div.classList.add('itensPesquisaAtivo');

        var html = "<ul>";

        for (i = 0; i < resposta['dados'].length; i++) {

            html += "<dt id='litxt'; onclick='get_produto("
                + JSON.stringify(resposta['dados'][i].id) + ","
                + JSON.stringify(resposta['dados'][i].descricao) + ","
                + JSON.stringify(resposta['dados'][i].uni) + ","
                + JSON.stringify(resposta['dados'][i].tipo) + ","
                + JSON.stringify(resposta['dados'][i].qttotal) + ")'>"

                + resposta['dados'][i].cod_e_descricao + "<br>"
        }

        html += "</ul>";

    } else {

        var html = "<ul>";
        html += "<dt id=litxtNe>" + "NADA ENCONTRADO, VERIFIQUE O CÓDIGO DO PRODUTO OU DESCRIÇÃO!";
        html += "</ul>";

    };
    document.getElementById('resultado_pesquisa').innerHTML = html;
};

function get_produto(id, descricao, uni, tipo, qttotal) {
    document.getElementById("id").value = id;
    document.getElementById("descricao").value = descricao;
    document.getElementById("uni").value = uni;
    document.getElementById("qttotal").value = qttotal;
    document.getElementById("tipo").value = tipo;
    
};

const fechar_lista = document.getElementById('id');
document.addEventListener('click', function (event) {
    const validar_clique = fechar_lista.contains(event.target);
    if (!validar_clique) {

        document.getElementById('resultado_pesquisa').innerHTML = '';
        div.classList.remove('itensPesquisaAtivo');
        div.classList.add('itensPesquisaInativo');
    };
});


