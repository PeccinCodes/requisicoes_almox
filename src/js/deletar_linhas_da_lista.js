document.getElementById("btnSalvar").disabled = true;

dataentrega.min = new Date().toISOString().split("T")[0];

function deleteRow(linha) {

    var elemento_pai = document.body;
    var divAlertLinha = document.createElement('div');
    divAlertLinha.setAttribute("class", "alertaLinha");
    divAlertLinha.setAttribute("id", "IdalertaLinhadel");

    var inputAlertaLinha = document.createElement('input');
    inputAlertaLinha.setAttribute("type", "button");
    inputAlertaLinha.setAttribute("class", "btnValidaExcluirRow");
    inputAlertaLinha.setAttribute("value", "Confirmar");

    inputAlertaLinha.addEventListener("click", function () {

        //DELETA LINHA
        document.getElementById('Tabela').deleteRow(linha)

        //SOME COM O ALERTA DE CONFIRMA??O E CANCELAMENTO e LIBERA O BTN ADD ITEM E SALVAR
        setTimeout(function () {
            let msg = document.getElementById("IdalertaLinhadel");
            msg.parentNode.removeChild(msg);
            if (document.getElementById('tituloAlertDelLinha') < 1) {

                let btnAdd = document.getElementById('btnAdd')
                btnAdd.disabled = false

                let btn = document.getElementById('btnSalvar');
                btn.disabled = false;
                btn.classList.remove('btnSalvarInativo');
                btn.classList.add('btnSalvarAtivo');

                let container = document.getElementById('conteinerAtivado');
                container.classList.remove('containerInativo');
                container.classList.add('conteiner');

                if (document.getElementById('btnDel') < 1) {
                    let btn = document.getElementById('btnSalvar');
                    btn.disabled = true;
                    btn.classList.remove('btnSalvarAtivo');
                    btn.classList.add('btnSalvarInativo');
                }
            };
        }, 0000);

    });

    var inputAlertaLinhaNot = document.createElement('input');
    inputAlertaLinhaNot.setAttribute("type", "button");
    inputAlertaLinhaNot.setAttribute("class", "btnValidaExcluirRow");
    inputAlertaLinhaNot.setAttribute("value", "Cancelar");
    inputAlertaLinhaNot.addEventListener("click", function () {
        setTimeout(function () {
            let msg = document.getElementById("IdalertaLinhadel");
            msg.parentNode.removeChild(msg);
            if (document.getElementById('tituloAlertDelLinha') < 1) {

                let btnAdd = document.getElementById('btnAdd')
                btnAdd.disabled = false

                // REMOVE O EMBACADO DA TELA
                let container = document.getElementById('conteinerAtivado');
                container.classList.remove('containerInativo');
                container.classList.add('conteiner');

                let btn = document.getElementById('btnSalvar');
                btn.disabled = false;
                btn.classList.remove('btnSalvarInativo');
                btn.classList.add('btnSalvarAtivo');
            };
        }, 0000);
    });

    var br = document.createElement('br');
    var titulo = document.createElement('label');
    titulo.setAttribute("id", "tituloAlertDelLinha");
    var texto = document.createTextNode("O Item " + (linha - 1) + " Será Excluído da Lista!");

    //DESATIVA O BOT?O ENVIAR QUANDO A MSG DE ALERTA ESTA ATIVADA
    if (document.getElementById('tituloAlertDelLinha') < 1) {

        let btnAdd = document.getElementById('btnAdd')
        btnAdd.disabled = true

        let container = document.getElementById('conteinerAtivado');
        container.classList.remove('conteiner');
        container.classList.add('containerInativo');

        let btn = document.getElementById('btnSalvar');
        btn.disabled = true;
        btn.classList.remove('btnSalvarAtivo');
        btn.classList.add('btnSalvarInativo');
    }

    divAlertLinha.appendChild(texto);
    divAlertLinha.appendChild(titulo);
    divAlertLinha.appendChild(br);
    divAlertLinha.appendChild(inputAlertaLinha);
    divAlertLinha.appendChild(inputAlertaLinhaNot);
    elemento_pai.appendChild(divAlertLinha);

}

