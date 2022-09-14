<?php
session_start();
include(__DIR__ . '/src/php/pesquisa-locais-uso.php');
include(__DIR__ . '/src/include/banco.php');

?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--/////////////////////////////////////////////////////////////////////////////////////-->

    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./src/css/normalize.css">

    <link rel="stylesheet" href="./src/css/geral.css">
    <link rel="stylesheet" href="./src/css/input.css">
    <link rel="stylesheet" href="./src/css/cabecalho.css">
    <link rel="stylesheet" href="./src/css/dropdown.css">
    <link rel="stylesheet" href="./src/css/itens_pesquisa.css">
    <link rel="stylesheet" href="./src/css/tabela.css">
    <link rel="stylesheet" href="./src/css/btn.css">
    <link rel="stylesheet" href="./src/css/alerta_excluir.css">
    <link rel="stylesheet" href="./src/css/itens_pesquisa.css">
    <link rel="stylesheet" href="./src/css/alerta.css">

    <link rel="stylesheet" href="./src/css/media-query-mobile/md-input.css">

    <!--////////////////////////////////////////////////////////////////////////////////////-->

    <title>PECCIN | Solicitações Almox</title>
</head>

<body>

    <div class="conteiner" id="conteinerAtivado">

        <img class="logo" src="./src/img/peccin.png" />

        <head class="cabecalho">
            <label for="" class="cabecalho__titulo">Requisições de Itens do Almox</label>
            <div class="dropdown" style="float:right;">
                <button class="dropbtn">MENU</button>
                <div class="dropdown-content">
                    <input type="button" value="RELATÓRIO" id="btnRelatorio" onclick="window.location.href='./src/php/relatorio_requisicoes.php'">
                </div>
            </div>
        </head>

        <form method="POST" action="./src/php/salva_itens_no_db.php">

            <div class="blocosdoinput">

                <div class="primeirobloco">

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Item:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="" name="" id="id" placeholder="Digite o Código ou a Descrição do produto" onkeyup="carregar_produtos(this.value)" autofocus />
                        </div>
                    </div>

                    <div class="itensPesquisaInativo" id="div">
                        <span id="resultado_pesquisa"></span>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Descrição:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="" name="" id="descricao" disabled />
                        </div>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Medida:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="" name="" id="uni" disabled />
                        </div>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Estoque:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="" name="" id="qttotal" disabled />
                        </div>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Tipo:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="" name="" id="tipo" disabled />
                        </div>
                    </div>

                </div>

                <div class="segundobloco">

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Quantidade:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="number" name="" id="qtdesejada">
                        </div>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Entrega:</label>
                        </div>
                        <div class="column-2 column input">

                            <select name="" id="localentrega">
                                <option value=""></option>
                                <?
                                while ($retornoLocal = oci_fetch_assoc($pesquisaLocais)) {
                                ?>
                                    <option value="<?= $retornoLocal['LOCAL'] ?>"><?= $retornoLocal['LOCAL'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Crachá:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="password" name="idCracha" id="idCracha" onblur="validacaoCracha(this.value)">
                        </div>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Retorno:</label>
                        </div>
                        <div class="column-2 column input">
                            <input type="checkbox" id="retorno" name="retorno" value="S">
                        </div>
                    </div>

                    <div class="linha">
                        <div class="column-1 column label">
                            <label>Observação:</label>
                        </div>
                        <div class="column-2 column input">
                            <textarea name="" id="observacao" cols="69" rows="2"></textarea>
                        </div>
                    </div>

                </div>

            </div>

            <div id="btadd">
                <button onclick="javascript:addRow('Tabela')" type="button" class="btnAdd" id="btnAdd">(+) Adicionar Item na Lista</button></a>
            </div>
            <br>
            <div id="btenviar">
                <input name="eviarItens" class="btnSalvarInativo" id="btnSalvar" type="submit" value="Realizar Solicitação">
            </div>
            <br>
            <label for="" id="subtitulo">Lista de Itens</label>
            <br><br>
            <div id="tabela-produtos">
                <table id="Tabela">
                    <tbody>
                        <tr id="trLista">
                            <th>Código</th>
                            <th class="descricao">Descrição</th>
                            <th>Tipo</th>
                            <th>Qt. Desejada</th>
                            <th>Local da Entrega</th>
                            <th>Observação</th>
                            <th id="btnDelth"></th>
                        </tr>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            <div id="listaprodutos">
                <!-- <input type="hidden" name="listaprodutos[]"> -->
            </div>
            <!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

            <div id="msgDeAlerta">
                <div class="msgFimOk">
                    <div id="msgOk">
                        <?php
                        if (isset($_SESSION['msgOk'])) {
                            echo $_SESSION['msgOk'];
                            unset($_SESSION['msgOk']);
                        }
                        ?>
                    </div>
                </div>
                <div class="msgFimFail">
                    <div id="msgFail">
                        <?php
                        if (isset($_SESSION['msgFail'])) {
                            echo $_SESSION['msgFail'];
                            unset($_SESSION['msgFail']);
                        }
                        ?>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <footer><?= $tipo?></footer>

    <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

</body>

<script src="./src/js/autocompletar_itens_no_form.js"></script>
<script src="./src/js/gerador_de_inputs_dos_itens.js"></script>
<script src="./src/js/deletar_linhas_da_lista.js"></script>
<script src="./src/js/validacao-cracha.js"></script>

<script>
    //ALERTA DE VALIDAÇÃO DE ENVIO
    setTimeout(function() {
        let msg = document.getElementById("msgFail");
        msg.parentNode.removeChild(msg);
    }, 5100);

    setTimeout(function() {
        let msg = document.getElementById("msgOk");
        msg.parentNode.removeChild(msg);

    }, 60000);
</script>

</html>