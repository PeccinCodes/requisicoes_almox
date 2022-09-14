<?php

include(__DIR__ . '/../include/banco.php');
include(__DIR__ . '/../db/'.$db); //conexao com o banco

$filtro_nome = filter_input(INPUT_GET, "cod_e_descricao");
$filtro_nome = strtoupper($filtro_nome);

if(!empty($filtro_nome)){
    $pesquisa_nome = "%" . $filtro_nome . "%";
    $stid = oci_parse($ora_conexao,
     "SELECT
            CODIGO,
            DESCRICAO,
            UM,
            TIPO,
            QTDE
       FROM 
            PCN_VW_PRODUTOS_ALMOX
        WHERE 
            CODIGO LIKE :cod_e_descricao 
            OR DESCRICAO LIKE :cod_e_descricao"
    );
    oci_bind_by_name($stid, ':cod_e_descricao', $pesquisa_nome);
    oci_execute($stid);
    
while(($row_usuario = oci_fetch_assoc($stid)) != false){
    $dados[] = [
        'id' => $row_usuario['CODIGO'],
        'descricao' => $row_usuario['DESCRICAO'],
        'uni' => utf8_encode($row_usuario['UM']),
        'tipo' => $row_usuario['TIPO'],
        'qttotal' => $row_usuario['QTDE'],
        'cod_e_descricao' => $row_usuario['CODIGO'] . " - " . $row_usuario['DESCRICAO']
    ];
}  

$retorna = ['erro' => false, 'dados' => $dados];

}else{

    $retorna = ['erro' => true, 'msgErro' => "Nada encontrado encontrado!"];

}

echo json_encode($retorna);