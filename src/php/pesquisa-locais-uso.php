<?php

include(__DIR__ . '/../db/conexao_oracle_prod.php');

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
