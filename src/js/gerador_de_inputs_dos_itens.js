
//const adicionar = document.getElementById("adicionar"); //PEGA VALORES DOS INPUTS VINDOS DO INDEX.PHP PELO BUTTON "adicionar"
const listaprodutos = document.getElementById("listaprodutos"); //GERA A LISTA DOS ITENS
document.getElementById("btnSalvar").disabled = true;
dataentrega.min = new Date().toISOString().split("T")[0];

function addRow(vl) {

        if (id.value.length != 0 && qtdesejada.value.length != 0 && localentrega.value.length != 0) {
            if (parseFloat(qtdesejada.value) > parseFloat(qttotal.value)) {
                alert('QT. DESEJADA MAIOR QUE QT. EM ESTOQUE!')
    
            } else {
    
                var tbody = document.getElementById
                    (vl).getElementsByTagName("TBODY")[0];
                let row = document.createElement("TR")
    
                //ID
                let tableRow1 = document.createElement("td")
                let idItem = document.createElement("input");
                idItem.setAttribute("type", "text");
                idItem.setAttribute("name", "listaprodutos[]")
                idItem.setAttribute("value", id.value)
                idItem.setAttribute("class", "listaesperaInputNul")
                listaprodutos.appendChild(idItem);
    
                //DESCRICAO
                let tableRow2 = document.createElement('td')
                let descItem = document.createElement("input");
                descItem.setAttribute("type", "text");
                descItem.setAttribute("name", "listaprodutos[]")
                descItem.setAttribute("value", descricao.value)
                descItem.setAttribute("class", "listaesperaInputNul")
                listaprodutos.appendChild(descItem);
    
                //UNIDADE DE MEDIDA
                //let tableRow3 = document.createElement('td')
                //let uniItem = document.createElement("input");
                //uniItem.setAttribute("type", "text");
                //uniItem.setAttribute("name", "listaprodutos[]")
                //uniItem.setAttribute("value", uni.value)
                //uniItem.setAttribute("class", "listaesperaInputNul")
                //listaprodutos.appendChild(uniItem);
    
                //QT TOTAL
                //let tableRow4 = document.createElement('td')
                //let qtItem = document.createElement("input");
                //qtItem.setAttribute("type", "text");
                //qtItem.setAttribute("name", "listaprodutos[]")
                //qtItem.setAttribute("value", qttotal.value)
                //qtItem.setAttribute("class", "listaesperaInputNul")
                //listaprodutos.appendChild(qtItem);
    
                //TIPO
                let tableRow5 = document.createElement('td')
                let tipoItem = document.createElement("input");
                tipoItem.setAttribute("type", "text");
                tipoItem.setAttribute("name", "listaprodutos[]")
                tipoItem.setAttribute("value", tipo.value)
                tipoItem.setAttribute("class", "listaesperaInputNul")
                listaprodutos.appendChild(tipoItem);
    
                let tableRow6 = document.createElement('td')
                let qtDjItem = document.createElement("input");
                qtDjItem.setAttribute("type", "text");
                qtDjItem.setAttribute("name", "listaprodutos[]")
                qtDjItem.setAttribute("value", qtdesejada.value)
                qtDjItem.setAttribute("class", "listaesperaInputNul")
                listaprodutos.appendChild(qtDjItem);
    
                let tableRow7 = document.createElement('td')
                let localEntr = document.createElement("input");
                localEntr.setAttribute("type", "text");
                localEntr.setAttribute("name", "listaprodutos[]");
                localEntr.setAttribute("value", localentrega.value)
                localEntr.setAttribute("class", "listaespera")
                listaprodutos.appendChild(localEntr);
    
                let tableRow8 = document.createElement('td')
                let obs = document.createElement("input")
                obs.setAttribute("type", "text");
                obs.setAttribute("name", "listaprodutos[]");
                obs.setAttribute("value", observacao.value)
                obs.setAttribute("class", "listaespera")
                listaprodutos.appendChild(obs);
    
                //let tableRow9 = document.createElement('td')
                //let hrEntr = document.createElement("input");
                //hrEntr.setAttribute("type", "time");
                //hrEntr.setAttribute("name", "listaprodutos[]")
                //hrEntr.setAttribute("value", hrentrega.value)
                //hrEntr.setAttribute("class", "listaespera")
                //listaprodutos.appendChild(hrEntr);
    
                let tableBtmDel = document.createElement("td")
                tableBtmDel.setAttribute("id", "btnDeltd")
                let btnDel = document.createElement("input")
                btnDel.setAttribute("type", "button")
                btnDel.setAttribute("value", "X")
                btnDel.setAttribute("id", "btnDel")
                btnDel.setAttribute("name", "botaoDeletLinha")
                btnDel.setAttribute("class", "btnDelete")
                btnDel.setAttribute("onclick", "deleteRow(this.parentNode.parentNode.rowIndex)")
                listaprodutos.appendChild(btnDel);
    
                tableRow1.appendChild(idItem);
                tableRow2.appendChild(descItem);
                //tableRow3.appendChild(uniItem);
                //tableRow4.appendChild(qtItem);
                tableRow5.appendChild(tipoItem);
                tableRow6.appendChild(qtDjItem);
                tableRow7.appendChild(localEntr);
                tableRow8.appendChild(obs);
                //tableRow9.appendChild(hrEntr);
                tableBtmDel.appendChild(btnDel)
    
                row.appendChild(tableRow1);
                row.appendChild(tableRow2);
                //row.appendChild(tableRow3);
                //row.appendChild(tableRow4);
                row.appendChild(tableRow5);
                row.appendChild(tableRow6);
                row.appendChild(tableRow7);
                row.appendChild(tableRow8);
                //row.appendChild(tableRow9);
                row.appendChild(tableBtmDel);
                tbody.appendChild(row);
    
                id.value = ''
                descricao.value = ''
                uni.value = ''
                qttotal.value = ''
                qtdesejada.value = ''
                tipo.value = ''
                localentrega.value = ''
                observacao.value = ''
                //hrentrega.value = ''
    
            } if (document.getElementById('btnDel') != true) {
    
                let btn = document.getElementById('btnSalvar')
                btn.disabled = false;
                btn.classList.remove('btnSalvarInativo');
                btn.classList.add('btnSalvarAtivo');
    
                //let btnAdd = document.getElementById('btnAdd');
                //btnAdd.disabled = true;
                //btnAdd.classList.remove('btnAdd');
                //btnAdd.classList.add('btnAddInativo');
    
            }
    
        } else {
    
            alert('Informe Todos Os Campos da Requisição!');
    
        }

}

