<?php

include(__DIR__ . '/../include/banco.php');
include(__DIR__ . '/../db/' . $db); //conexao com o banco

$query_requisicoes =
    "SELECT
    ppa.requisicao,
    ppa.item,
    ppa.descricao,
    ppa.unimedida,
    ppa.qtestoque,
    ppa.qtdesejada,
    ppa.tipo,
    ppa.localentrega,
    ppa.datasolicitacao,
    ppa.retorno,
    vsf.nome,
    ppa.observacao
FROM
    pcn_prod_almox ppa,
    pcn_vw_senior_func vsf
WHERE
    trunc(vsf.chapa) = ppa.cracha
    AND vsf.situacao = 'Trabalhando'
ORDER BY
    to_number(ppa.requisicao) DESC";
$query = ociparse($ora_conexao, $query_requisicoes);
ociexecute($query);
$array = oci_fetch_assoc($query);
$linhas = oci_num_rows($query);

////////////////////////////////////////////////

$contador_req =
    "SELECT
       *
    FROM 
        pcn_prod_almox";
$query_cont = ociparse($ora_conexao, $contador_req);
ociexecute($query_cont);
$cont_requ = oci_fetch_all($query_cont, $req);
