<?php

// CONEXÃO COM O BANCO DE DADOS
include(__DIR__ . '/../db/conexao_oracle_dev.php');

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
            codigo,
            apontador,
            perc_mi,
            perc_me,
            perc_sa,
            pa_mi,
            pa_me,
            sa,
            nome,
            DECODE(ativo, 'S', 'S', 'N') ativo
        FROM
            pcn_apontadores
        WHERE
            codigo = :apontador"
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
