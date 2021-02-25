    <?php
session_start();

include "conecta_banco.php";


/**
 * Codigo usuario
 */

$id = $_SESSION["id"];



/**
 * primeiro bloco
 */
$nome = $_POST["nome"];//Obrigatorio

$email = $_POST["email"];//Obrigatorio

if(isset($_POST["cnpj"]))
$cnpj = $_POST["cnpj"];



/**
 * segundo bloco
 */
$logradouro = $_POST["logradouro"];//Obrigatorio
$numero = $_POST["numero"];//Obrigatorio
$cep = $_POST["cep"];//Obrigatorio
$bairro = $_POST["bairro"];//Obrigatorio
$cidade = $_POST["cidade"];//Obrigatorio
$uf = $_POST["uf"];//Obrigatorio



/**
 * Terceiro bloco

*$foto_ong = $_POST["foto_ong"]; */
$causa = $_POST["causas"];//Obrigatorio
$select = $con->query("SELECT cd_causa from tb_causa where nm_causa='$causa'");
$linha = $select->fetch_array();
$causa = $linha["cd_causa"];

$sobre = $_POST["sobre"];


$dt_criacao = date("Y-m-d", time());


if(empty($nome) || empty($email) || empty($logradouro) ||  empty($numero) || empty($cep) ||empty($bairro) || empty($cidade) || empty($uf) || empty($causa)){

    echo "<meta charset='utf-8'> <script>alert('Algum campo não está preenchido');history.back();</script>";

}
else{

$verifica = $con->query("SELECT nm_email_ong from tb_ong where nm_email_ong = '$email'");
if(mysqli_num_rows($verifica)>0)
{
    echo "<script> alert('Ja existe um usuario cadastrado com este email');window.location.href='cadastro.php';/script>";
}

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



   /* FIM DA FOTO*/



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

$insert = $con->query("INSERT INTO tb_ong(nm_ong,nm_email_ong,cd_cnpj_ong,dt_criacao,im_ong,ds_ong,nm_numero,cd_voluntario, cd_logradouro,cd_causa) VALUES ('$nome','$email','$cnpj','$dt_criacao','$destino','$sobre','$numero','$id','$cd_logradouro','$causa')"); // Criando a ONG
$select = $con->query("SELECT cd_ong from tb_ong where nm_email_ong = '$email'"); // Pegando o codigo da ong
$linhas = $select->fetch_array();
$cd_ong = $linhas["cd_ong"];

// Adicionando contato
if(isset($_POST["telefone_fixo"])){
    $telefone_fixo = $_POST["telefone_fixo"];
    echo $telefone_fixo."<br>";
    $insert = $con->query("INSERT INTO tb_contato(cd_contato,cd_ong,cd_tipo_contato) VALUES ('$telefone_fixo','$cd_ong',1)");
}
echo "<script> alert('Cadastro realizado com sucesso!');window.location.href='minhas-ongs2.php';</script>";



}
?>