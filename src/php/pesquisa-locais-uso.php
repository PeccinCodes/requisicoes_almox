<?php

include(__DIR__ . '/../include/banco.php');
include(__DIR__ . '/../db/'.$db);

$pesquisaLocais = ociparse(
  $ora_conexao,
  "SELECT
  local
FROM
  pcn_prod_almox_locais
WHERE
  tipo_uso = 'REQ_MAN'"  
);
ociexecute($pesquisaLocais);
