<?php

include(__DIR__.'/pesquisa-requisicoes.php');

// EXPLODE DO NOME PARA PEGAR O NOME E O ULTIMO NOME *LINHA 81
$nome = explode(' ',$array['NOME'])

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/lista_solicitacoes.css">
    <link rel="stylesheet" href="../css/geral.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/cabecalho.css">
    <link rel="stylesheet" href="../css/btn.css">

    <title>PECCIN | Relatório Requisições</title>
</head>

<body>
    <div id="idcontainer" class="container">

        <img class="logo" src="../img/peccin.png" />

        <head class="cabecalho">
            <label for="" class="cabecalho__titulo">Requisições de Itens do Almox</label>
            <div class="dropdown" style="float:right;">
                <button class="dropbtn">MENU</button>
                <div class="dropdown-content">
                    <input id="btnRequisicoes" onclick="window.location.href='../../index.php'" type="button" value="REQUISIÇÕES DE ITENS">
                    <br><br>
                    <input id="btnAtualizarPagina" onclick='atualizar()' type="button" value="ATUALIZAR LISTA">
                    <br><br>
                    <label for="">Nº REQ:</label>
                    <input id="inputContagemReq" type="text" value="<?= $cont_requ ?>" readonly>
                </div>
            </div>
        </head>

        <div class="buttons">
            <div>
                <input id="imprimir" type="button" value="IMPRIMIR RELATÓRIO" onClick="window.print()" />
            </div>
            <div>
                <a href="./exportar-excel.php"><input id="export" type="button" value="EXPORTAR PARA EXCEL" /></a>
            </div>
        </div>

        <div id="tabela">
            <table id="tabelaitens" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>REQ</th>
                        <th>ITEM</th>
                        <th>QT.</th>
                        <th>LOCAL</th>
                        <th>DATA</th>
                        <th>NOME</th>
                        <th>OBS.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if ( $linhas > 0) {

                        do {
                    ?>
                            <tr>
                                <td><?= $array['REQUISICAO'] ?></td>
                                <td><?= $array['ITEM'] . ' - ' . $array['DESCRICAO'] ?></td>
                                <td><?= $array['QTDESEJADA'] ?></td>
                                <td><?= $array['LOCALENTREGA'] ?></td>
                                <td><?= $array['DATASOLICITACAO'] ?></td>
                                <td><?= $nome[0].' '.end($nome) ?></td>
                                <td><?= $array['OBSERVACAO'] ?></td>
                            </tr>
                    <?php
                        } while ($array = oci_fetch_assoc($query));
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script>
    var vals = [];
    $('#tabelaitens').dataTable({
        "paging": true,
        "info": false,
        "order": [],
        "language": {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
        },
    });

    atualizar = () =>{
        location.reload()
    }
</script>

</html>