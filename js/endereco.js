$("#cadastro-cep").focusout(function() {
    //Início do Comando AJAX
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CEP
        url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/unicode/',
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta) {
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#cadastro-logradouro").val(resposta.logradouro);
            $("#cadastro-bairro").val(resposta.bairro);
            $("#cadastro-cidade").val(resposta.localidade);
            $("#cadastro-uf").val(resposta.uf);
            //Vamos incluir para que o Número seja focado automaticamente
            //melhorando a experiência do usuário
            $("#cadastro-numero").focus();
        }
    });
});

function formatCEP(){
    var $barra = "/";
    var cep = document.formCadastro.uf.value;

    if(cep.length == 5){
        cep = cep + barra;
        document.formCadastro.uf.value = cep;
}
}