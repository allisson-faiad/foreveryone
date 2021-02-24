<?php
include "conecta_banco.php";
session_start();

$id_ong = $_SESSION["id_ong"];


// Dados
$nome_evento = $_POST["nome"];
$sobre = $_POST["sobre"];

$data_inicio = $_POST["data_inicio"];
$data_fim = $_POST["data_fim"];

$hora_inicio = $_POST["hora_inicio"];
$hora_fim = $_POST["hora_fim"];


/**
 * segundo bloco
 */
$logradouro = $_POST["logradouro"];//Obrigatorio
$numero = $_POST["numero"];//Obrigatorio
$cep = $_POST["cep"];//Obrigatorio
$bairro = $_POST["bairro"];//Obrigatorio
$cidade = $_POST["cidade"];//Obrigatorio
$uf = $_POST["uf"];//Obrigatorio








/** ARMAZENANDO FOTO */
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../.././ForEveryone/user_img/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
           
            
        }
        else
        echo "<script> alert('Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.');history.back();</script>";
    }
    else
    echo "<script> alert('Você poderá enviar apenas arquivos *.jpg;*.jpeg;*.gif;*.png');history.back();</script>";
}
else
    echo "<script> alert('Você não enviou nenhum arquivo!');history.back();</script>";






// Endereço



$select = $con->query("SELECT cd_uf from tb_uf where sg_uf = '$uf'"); // Pegando o codigo do uf

if (mysqli_num_rows($select) > 0) {
    $linhas = $select->fetch_array();
    $cd_uf = $linhas["cd_uf"];
} else {
    $insert = $con->query("INSERT INTO tb_uf(sg_uf) VALUES ('$uf')");
    $select = $con->query("SELECT cd_uf from tb_uf where sg_uf = '$uf'");
    $linhas = $select->fetch_array();
    $cd_uf = $linhas["cd_uf"];
}

$select = $con->query("SELECT cd_cidade from tb_cidade where nm_cidade = '$cidade'"); // Pegando o codigo da cidade

if (mysqli_num_rows($select) > 0) {
    $linhas = $select->fetch_array();
    $cd_cidade = $linhas["cd_cidade"];
} else {
    $insert = $con->query("INSERT INTO tb_cidade(nm_cidade, cd_uf) VALUES ('$cidade','$cd_uf')");
    $select = $con->query("SELECT cd_cidade from tb_cidade where nm_cidade = '$cidade'");
    $linhas = $select->fetch_array();
    $cd_cidade = $linhas["cd_cidade"];
}

$select = $con->query("SELECT cd_bairro from tb_bairro where nm_bairro = '$bairro'"); // Pegando o codigo do bairro

if (mysqli_num_rows($select) > 0) {
    $linhas = $select->fetch_array();
    $cd_bairro = $linhas["cd_bairro"];
} else {
    $insert = $con->query("INSERT INTO tb_bairro(nm_bairro, cd_cidade) VALUES ('$bairro','$cd_cidade')");
    $select = $con->query("SELECT cd_bairro from tb_bairro where nm_bairro = '$bairro'");
    $linhas = $select->fetch_array();
    $cd_bairro = $linhas["cd_bairro"];
}

$select = $con->query("SELECT cd_logradouro from tb_logradouro where nm_logradouro = '$logradouro'"); // Pegando o codigo do logradouro
if (mysqli_num_rows($select) > 0) {
    $linhas = $select->fetch_array();
    $cd_logradouro = $linhas["cd_logradouro"];
} else {
    $insert = $con->query("INSERT INTO tb_logradouro(nm_logradouro,cd_cep,cd_bairro) VALUES ('$logradouro', '$cep', '$cd_bairro')");
    $select = $con->query("SELECT cd_logradouro from tb_logradouro where nm_logradouro = '$logradouro'");
    $linhas = $select->fetch_array();
    $cd_logradouro = $linhas["cd_logradouro"];
}


// Fim do Endereço

$dt_publicacao = date("Y-m-d");




 $insert = $con->query("INSERT INTO tb_evento (nm_evento,ds_evento,dt_publicacao,dt_inicio,dt_fim,hr_inicio,hr_fim,im_foto,nm_numero,cd_ong,cd_logradouro) 
 VALUES ('$nome_evento','$sobre','$dt_publicacao','$data_inicio','$data_fim','$hora_inicio','$hora_fim','$destino','$numero','$id_ong','$cd_logradouro')");


echo "<script> alert('Cadastro realizado com sucesso!');window.location.href = 'tela-inicial-ong.php';</script>";

?>