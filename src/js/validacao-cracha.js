const limpaImput = () => {

    document.getElementById('idCracha').value = '';
    document.getElementById('idCracha').focus;
}

const validacaoCracha = async (cracha) => {
    let enderecoApi = await fetch('./src/php/pesquisa-cracha.php?apontador=' + cracha)
    let retornoApi = await enderecoApi.json();

    if (retornoApi['retorno'] === 'CRACHA_NAO_LOCALIZADO') {
        alert('CRACHA NÃO LOCALIZADO');
        limpaImput();
    }
}