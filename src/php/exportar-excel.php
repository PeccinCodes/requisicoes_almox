<?php

include(__DIR__ . '/../include/banco.php');
include(__DIR__ . '/../db/' . $db); //conexao com o banco
include(__DIR__ . '/pesquisa-requisicoes.php')

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .descricao {
            width: 850px;
        }
    </style>
</head>

<body>
    <?php

    $nome_arquivo = 'relatorio_requisicoes_almox.xls';

    $html = '';
    $html .= '<table border="1">';
    $html .= '<tr>';
    $html .= '<td><b>REQUISICAO</b></td>';
    $html .= '<td><b>ITEM</b></td>';
    $html .= '<td><b>DESCRICAO</b></td>';
    $html .= '<td><b>QUANTIDADE DESEJADA</b></td>';
    $html .= '<td><b>TIPO</b></td>';
    $html .= '<td><b>LOCAL DA ENTREGA</b></td>';
    $html .= '<td><b>SOLICITANTE</b></td>';
    $html .= '<td><b>DATA DA SOLICITACAO</b></td>';
    $html .= '<td><b>RETORNO</b></td>';
    $html .= '<td><b>OBSERVACAO</b></td>';
    $html .= '</tr>';

    while (($array = oci_fetch_assoc($query)) != false) {
        $html .= '<tr>';
        $html .= '<td>' . $array['REQUISICAO']                  . '</td>';
        $html .= '<td>' . $array['ITEM']                        . '</td>';
        $html .= '<td class="descricao">' . $array['DESCRICAO'] . '</td>';
        $html .= '<td>' . $array['QTDESEJADA']                  . '</td>';
        $html .= '<td>' . $array['TIPO']                        . '</td>';
        $html .= '<td>' . $array['LOCALENTREGA']                . '</td>';
        $html .= '<td>' . $array['NOME']                        . '</td>';
        $html .= '<td>' . $array['DATASOLICITACAO']             . '</td>';
        $html .= '<td>' . $array['RETORNO']                     . '</td>';
        $html .= '<td>' . strval($array['OBSERVACAO'])          . '</td>';
        $html .= '</tr>';
    };

    // CABECALHO DO EXCEL
    header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header("Content-Disposition: attachment; filename=\"{$nome_arquivo}\"");
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);

    echo $html;

    exit;
    ?>
</body>

</html>