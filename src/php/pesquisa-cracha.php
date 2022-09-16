<?php

// CONEXÃO COM O BANCO DE DADOS
include(__DIR__ . '/../db/conexao_oracle_prod.php');

////////////////////////////////////////////////////////

// VARIAVEIS DE ENTRADA
$get_cracha = filter_input(INPUT_GET, 'apontador');

////////////////////////////////////////////////////////

// VALIDAÇÃO DE PARAMENTROS DE ENTRADA
if (!empty($get_cracha)) {

    ////////////////////////////////////////////////////

    // QUERY APONTADORES
    $codigo_do_cracha = $get_cracha;
    $query_cracha = ociparse(
        $ora_conexao,
        "SELECT
        trunc(chapa) CODIGO,
        nome,
        situacao,
        setor
    FROM
        pcn_vw_senior_func
    WHERE
        situacao = 'Trabalhando'
        AND trunc(chapa) = :apontador"
    );
    ocibindbyname($query_cracha, ':apontador', $codigo_do_cracha);
    ociexecute($query_cracha);
    $retorno_cracha = oci_fetch_assoc($query_cracha);

    ////////////////////////////////////////////////////////

    // INICIO DAS VALIDAÇÕES DO APONTADOR

    // NÃO LOCALIZADO
    if (($retorno_cracha['CODIGO']) == '') {

        $array['retorno'] = 'CRACHA_NAO_LOCALIZADO';
    } else {

        $array['retorno'] = 'CRACHA_LOCALIZADO';
    }

    echo json_encode($array);
} else {

    echo 'ATENÇÃO! INFORME O NUMERO DO CRACHA!';
}
