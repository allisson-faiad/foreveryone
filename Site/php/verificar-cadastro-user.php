<?php
include "conecta_banco.php";

$nome_usuario = $_POST["nome_usuario"];//obrigatorio
$email = $_POST["email"];//obrigatorio
$senha = $_POST["senha"];//obrigatorio
$dt_nascimento = $_POST["data"];//obrigatorio




$logradouro = $_POST["logradouro"]; //obrigatorio
$numero = $_POST["numero"]; //obrigatorio
$cep = $_POST["cep"]; //obrigatorio
$bairro = $_POST["bairro"]; //obrigatorio
$cidade = $_POST["cidade"]; //obrigatorio
$uf = $_POST["uf"]; //obrigatorio



$sobre = $_POST["sobre"];

$verifica = $con->query("SELECT * from tb_voluntario where nm_email_voluntario = '$email' or nm_usuario_voluntario = '$nome_usuario'");
if(mysqli_num_rows($verifica)>0)
{
    echo "<script> alert('Ja existe um usuario cadastrado com este email ou nome de usuário');history.back();</script>";

}
else{

//     if (isset($_POST['cpf']) == true || $_POST["cpf"] != null) {
//         $cpf = $_POST['cpf'];

//         // Elimina possivel mascara
//         $cpf = preg_replace("/[^0-9]/", "", $cpf);
//         $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

//         // Verifica se o numero de digitos informados é igual a 11 
//         if (strlen($cpf) != 11) {
//             echo "<script> alert('Diferente de 11');</script>";
//         }
//         // Verifica se nenhuma das sequências invalidas abaixo 
//         // foi digitada. Caso afirmativo, retorna falso
//         else if (
//             $cpf == '00000000000' ||
//             $cpf == '11111111111' ||
//             $cpf == '22222222222' ||
//             $cpf == '33333333333' ||
//             $cpf == '44444444444' ||
//             $cpf == '55555555555' ||
//             $cpf == '66666666666' ||
//             $cpf == '77777777777' ||
//             $cpf == '88888888888' ||
//             $cpf == '99999999999'
//         ) {
//             echo "<script> alert('CPF inválido!');window.location.href = 'cadastro.php';</script>";

//             // Calcula os digitos verificadores para verificar se o
//             // CPF é válido
//         } else {

//             for ($t = 9; $t < 11; $t++) {

//                 for ($d = 0, $c = 0; $c < $t; $c++) {
//                     $d += $cpf{
//                     $c} * (($t + 1) - $c);
//                 }
//                 $d = ((10 * $d) % 11) % 10;
//                 if ($cpf{
//                 $c} != $d) {
//                     echo "<script> alert('CPF inválido!');window.location.href = 'cadastro.php';</script>";
//                 }
//             }
//         }
//     }


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



// Atualizando Endereco

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





$nome = $_POST["nome"];//Obrigatorio

$insert = $con->query("INSERT INTO tb_voluntario(nm_voluntario,nm_usuario_voluntario,nm_email_voluntario,nm_senha_voluntario,dt_nascimento_voluntario,im_voluntario,nm_numero) 
VALUES ('$nome','$nome_usuario','$email','$senha', '$dt_nascimento','$destino','$numero')");


$selectUser = $con->query("SELECT cd_voluntario from tb_voluntario where nm_email_voluntario = '$email'");
$linha = $selectUser->fetch_array();
    $id = $linha["cd_voluntario"];


// Adicionando CPF
if(isset($_POST["cpf"])){
    $cpf = $_POST["cpf"];
    $alterar = $con->query("UPDATE tb_voluntario set 
cd_cpf_voluntario = '$cpf'
where cd_voluntario = '$id'");
    }



if(isset($_POST["formacao"])){
    $formacao = $_POST["formacao"];
    $selectForm = $con->query("SELECT cd_formacao from tb_formacao where nm_formacao = '$formacao'");
$linha = $selectForm->fetch_array();
$formacao = $linha["cd_formacao"];

$alterar = $con->query("UPDATE tb_voluntario set 
cd_formacao = '$formacao'
where cd_voluntario = '$id'");
}

if (isset($_POST["habilidade"])) {
    $habilidade = $_POST["habilidade"];
    $selectHab = $con->query("SELECT cd_habilidade from tb_habilidade where nm_habilidade = '$habilidade'");
    $linha = $selectHab->fetch_array();
    $habilidade = $linha["cd_habilidade"];

    $alterar = $con->query("UPDATE tb_voluntario set 
cd_habilidade = '$habilidade'
where cd_voluntario = '$id'");

}




if(isset($sobre)) {
    $alterar = $con->query("UPDATE tb_voluntario set 
ds_voluntario = '$sobre'
where cd_voluntario = '$id'");
}


// Adicionando contato
if(isset($_POST["telefone_fixo"])){
$telefone_fixo = $_POST["telefone_fixo"];
echo $telefone_fixo."<br>";
$insert = $con->query("INSERT INTO tb_contato(cd_contato,cd_voluntario,cd_tipo_contato) VALUES ('$telefone_fixo','$id',1)");
}

if(isset($_POST["telefone_celular"])){
$telefone_celular = $_POST["telefone_celular"];
echo $telefone_celular."<br>";

$insert = $con->query("INSERT INTO tb_contato(cd_contato,cd_voluntario,cd_tipo_contato) VALUES ('$telefone_celular','$id',2)");
}



$alterar = $con->query("UPDATE tb_voluntario set 
cd_logradouro = '$cd_logradouro'
where cd_voluntario = '$id'");


echo "<script> alert('Cadastro realizado com sucesso!');window.location.href='login.php';</script>";

}
?>