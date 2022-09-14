<?php
session_start();

include(__DIR__ . '/../include/banco.php');
include(__DIR__ . '/../db/' . $db); //conexao com o banco

//REMOVE ACENTUACAO
function removerAcentos($string)
{
    return preg_replace(
        array(
            "/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/",
            "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/",
            "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"
        ),
        explode(" ", "a A e E i I o O u U n N c C"),
        $string
    );
}

// RECEBE AS INFORMACOES DO FORMS
$enviarItens = filter_input(INPUT_POST, 'eviarItens');
$retorno = filter_input(INPUT_POST, 'retorno');

if ($enviarItens) {
    $numeroCracha = filter_input(INPUT_POST, 'idCracha', FILTER_SANITIZE_NUMBER_INT);
    $itens = $_POST['listaprodutos'];
};

// DIVIDE O ARRAY EM COLUNAS CONFORME RETORNO DE ITENS, MUDAR AQUI SE PRECISAR AUMENTAR OU DIMINUIR COLUNAS DO ARRAY.
$arraychunk = array_chunk($itens, 6);

// CRIAR REQUISICAO
$validaReq = oci_parse($ora_conexao, "SELECT PCN_TRG_PROD_ALMOX.NEXTVAL ID_REQUISICAO FROM DUAL");
oci_execute($validaReq);
while (oci_fetch($validaReq)) {
    $retornoReq = oci_result($validaReq, 'ID_REQUISICAO');
};

if (empty($itens) == TRUE) {

    $_SESSION['msgFail'] = "<h2>Atenção!<h2>" . "<h4>Requisição Mínima de Um Item para Envio!</h4>" . "<div class='barra-time-fail' data-style='smooth' style='--duration: 5'><div></div></div>";
    header("Location: ../../index.php");

} else {

    // INSERT DAS INFORMACOES APOS AS VALIDACOES
    foreach ($arraychunk as $array) {
        $consulta = "INSERT INTO pcn_prod_almox";
        $consulta .= "(requisicao,                                                  
                        item,                                           
                        descricao,
                        unimedida, 
                        qtestoque, 
                        qtdesejada, 
                        tipo, 
                        localentrega,
                        dtentrega,
                        hrentrega,
                        cracha,
                        datasolicitacao,
                        retorno,
                        observacao) ";
        $consulta .= "VALUES";
        $consulta .= "('"
            . $retornoReq .                             "','"
            . $array[0] .                               "','"
            . $array[1] .                               "','"
            . null      .                               "','"
            . null      .                               "','"
            . $array[3] .                               "','"
            . $array[2] .                               "','"
            . $array[4] .                               "','"
            . null      .                               "','"
            . null      .                               "','"
            . $numeroCracha .                           "',"
            . "sysdate" .                               ",'"
            . $retorno .                                "','"
            . removerAcentos(strtoupper($array[5])) .   "')";
        $objParse = OCIParse($ora_conexao, $consulta);
        $objExecute = OCIExecute($objParse);
    }

    $r = oci_commit($ora_conexao);
    $_SESSION['msgOk'] =
        "<html>
        <div id='divBtnFechaMsg'>
            <input type='button' onclick='javascript:fechaMsgOk()' class='btnFechaMsg' value='X'>
        </div>
        <br>
            <h2>Requisição Enviada com Sucesso!<h2>
        <br>
            <h3 id='msgRequisicao'>Requisição: $retornoReq</h3>
        <br> 
            <div class='barra-time-ok' data-style='smooth' style='--duration: 60'><div></div></div>
        <script>
        function fechaMsgOk(){
            location.reload();
        }
        </script>
    </html>";
    header("Location: ../../index.php");
};
