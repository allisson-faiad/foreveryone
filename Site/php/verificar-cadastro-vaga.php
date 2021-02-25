<?php
include "conecta_banco.php";
session_start();

$id_ong = $_SESSION["id_ong"];


// Dados
$nome_vaga = $_POST["nome"];
$sobre = $_POST["sobre"];

$data_inicio = $_POST["data_inicio"];
$data_fim = $_POST["data_fim"];
$hora_inicio = $_POST["hora_inicio"];
$hora_fim = $_POST["hora_fim"];

$qt_limite = $_POST["qt_limite"];


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


if($hora_inicio >= "06:00" && $hora_inicio <= "11:59")
    $periodo = "Manhã";
    if($hora_inicio >= "12:00" && $hora_inicio <= "17:59")
    $periodo = "Tarde";
    if($hora_inicio >= "18:00" && $hora_inicio <= "23:59")
    $periodo = "Noite";

if($hora_inicio == $hora_fim){
    $carga_horaria = "12:00";
}else
$carga_horaria = $hora_fim - $hora_inicio;

$dt_publicacao = date("Y-m-d");

 $insert = $con->query("INSERT INTO tb_vaga(nm_vaga,ds_vaga,hr_carga_horaria,dt_publicacao,dt_inicio,dt_fim,hr_inicio,hr_fim,nm_periodo,im_vaga,qt_limite_pessoas,nm_numero,cd_ong,cd_logradouro)
        VALUES ('$nome_vaga','$sobre','$carga_horaria','$dt_publicacao','$data_inicio','$data_fim','$hora_inicio',
        '$hora_fim','$periodo','$destino','$qt_limite','$numero','$id_ong','$cd_logradouro')");

    $select = $con->query("SELECT cd_vaga from tb_vaga where nm_vaga = '$nome_vaga' and cd_ong = '$id_ong'");
    $linha = $select->fetch_array();
    $cd_vaga = $linha["cd_vaga"];

if(isset($_POST["formacao"])){

    $formacao = $_POST["formacao"];
    
    $insert = $con->query("UPDATE tb_vaga set cd_formacao = (SELECT cd_formacao from tb_formacao where nm_formacao = '$formacao') where cd_vaga = '$cd_vaga'");
    
}
if(isset($_POST["habilidade"])){
    $habilidade = $_POST["habilidade"];
    $insert = $con->query("UPDATE tb_vaga set cd_habilidade = (SELECT cd_habilidade from tb_habilidade where nm_habilidade = '$habilidade') where cd_vaga = '$cd_vaga'");
    
}
echo "<script> alert('Cadastro realizado com sucesso!');window.location.href = 'tela-inicial-ong.php';</script>";


?>