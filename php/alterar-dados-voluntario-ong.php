<?php
include "conecta_banco.php";
session_start();
$id = $_SESSION["id_ong"];

//parte 1 - Dados do Perfil

$nome = $_POST["nome"];




$sobre = $_POST["sobre"];

//parte 2 - Redes Sociais



//parte 3 - Endereço

$logradouro = $_POST["logradouro"];
$numero = $_POST["numero"];
$cep = $_POST["cep"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$uf = $_POST["uf"];



//---------------------

//Atualizando rede social - Facebook
if (isset($_POST["facebook"]) && $_POST["facebook"] != "") {
    $facebook = $_POST["facebook"];
    
    $select = $con->query("SELECT * from tb_rede_social where cd_ong = '$id' and cd_tipo_rede_social = 1");
    if (mysqli_num_rows($select) > 0) {
        $alterar = $con->query("UPDATE tb_rede_social set 
    nm_rede_social = '$facebook'
    where cd_ong = '$id' and cd_tipo_rede_social = 1");
    } else {
        $insert = $con->query("INSERT INTO tb_rede_social(nm_rede_social,cd_ong,cd_tipo_rede_social) VALUES ('$facebook','$id',1)");
    }
}

//Atualizando rede social - instagram
if (isset($_POST["instagram"]) && $_POST["instagram"] != "") {
    $instagram = $_POST["instagram"];

    $select = $con->query("SELECT * from tb_rede_social where cd_ong = '$id' and cd_tipo_rede_social = 2");
    if (mysqli_num_rows($select) > 0) {
        $alterar = $con->query("UPDATE tb_rede_social set 
    nm_rede_social = '$instagram'
    where cd_ong = '$id' and cd_tipo_rede_social = 2");
    } else {
        $insert = $con->query("INSERT INTO tb_rede_social(nm_rede_social,cd_ong,cd_tipo_rede_social) VALUES ('$instagram','$id',2)");
    }
}


//Atualizando rede social - twitter
if (isset($_POST["twitter"]) && $_POST["twitter"] != "") {
    $twitter = $_POST["twitter"]; 
    
    $select = $con->query("SELECT * from tb_rede_social where cd_ong = '$id' and cd_tipo_rede_social = 5");
    if (mysqli_num_rows($select) > 0) {
        $alterar = $con->query("UPDATE tb_rede_social set 
    nm_rede_social = '$twitter'
    where cd_ong = '$id' and cd_tipo_rede_social = 5");
    } else {
        $insert = $con->query("INSERT INTO tb_rede_social(nm_rede_social,cd_ong,cd_tipo_rede_social) VALUES ('$twitter','$id',5)");
    }
}

if (isset($_POST["whatsapp"]) && $_POST["whatsapp"] != "") {
    $whatsapp = $_POST["whatsapp"];
    $select = $con->query("SELECT * from tb_rede_social where cd_ong = '$id' and cd_tipo_rede_social = 3");
    if (mysqli_num_rows($select) > 0) {
        $alterar = $con->query("UPDATE tb_rede_social set 
    nm_rede_social = '$whatsapp'
    where cd_ong = '$id' and cd_tipo_rede_social = 3");
    } else {
        $insert = $con->query("INSERT INTO tb_rede_social(nm_rede_social,cd_ong,cd_tipo_rede_social) VALUES ('$whatsapp','$id',3)");
    }
}

//Atualizando rede social - site
if(isset($_POST["site"]) && $_POST["site"] != ""){
    $site = $_POST["site"];
$select = $con->query("SELECT * from tb_rede_social where cd_ong = '$id' and cd_tipo_rede_social = 4");
if (mysqli_num_rows($select) > 0) {
    $alterar = $con->query("UPDATE tb_rede_social set 
    nm_rede_social = '$site'
    where cd_ong = '$id' and cd_tipo_rede_social = 4");
} else {
    $insert = $con->query("INSERT INTO tb_rede_social(nm_rede_social,cd_ong,cd_tipo_rede_social) VALUES ('$site','$id',4)");
}
}


//---------------------


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


    $alterar = $con->query("UPDATE tb_ong set nm_numero = '$numero' where cd_ong = '$id'");


/** ARMAZENANDO FOTO */
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome_ = $_FILES[ 'arquivo' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome_, PATHINFO_EXTENSION );
 
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
            $alterar = $con->query("UPDATE tb_ong set 
            im_ong = '$destino'
            where cd_ong = '$id'");
            
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}



//Atualizando tb ong

$alterar = $con->query("UPDATE tb_ong set 
nm_ong = '$nome',
ds_ong = '$sobre',
cd_logradouro = '$cd_logradouro'
where cd_ong = '$id'");

$alterar = $con->query("UPDATE tb_ong set 
cd_logradouro = '$cd_logradouro'
where cd_ong = '$id'");

if (isset($_POST["tel_fixo"])) {
    $tel_fixo = $_POST["tel_fixo"];
    $select = $con->query("SELECT * from tb_contato where cd_ong = '$id'  and cd_tipo_contato = 1");
    if (mysqli_num_rows($select) > 0) {
        $alterar = $con->query("UPDATE tb_contato set
cd_contato = '$tel_fixo' where cd_ong = '$id' and cd_tipo_contato = 1");
    } else {
        $insert = $con->query("INSERT INTO tb_contato(cd_contato,cd_ong,cd_tipo_contato) VALUES ('$tel_fixo','$id',1)");
    }
}




$verifica = $con->query("SELECT * from tb_ong where cd_ong = '$id'");

$linhas = $verifica->fetch_array();
$nome = $linhas["nm_ong"];

unset($_SESSION['nome']);
$_SESSION['nome'] = $nome;

/*
//Atualizando Endereço - UF


//Atualizando Endereço - Cidade
$alterar = $con->query("UPDATE tb_cidade set 
nm_cidade = '$cidade'"); 

//Atualizando Endereço - Bairro
$alterar = $con->query("UPDATE tb_cidade set 
nm_bairro = '$bairro'"); 

//Atualizando Endereço - Logradouro
$alterar = $con->query("UPDATE tb_cidade set 
nm_logradouro = '$logradouro'"); 

//Atualizando Endereço - Cidade
$alterar = $con->query("UPDATE tb_cidade set 
nm_numero = '$numero'");
*/
echo "<meta charset='utf-8'> <script>alert('Alteração realizada com sucesso'); window.location = 'meu-perfil-ong.php';</script>";
