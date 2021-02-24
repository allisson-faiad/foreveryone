<?php
session_start();
include('conecta_banco.php');


if (isset($_SESSION['id_ong']) == true) {
    echo "<script>alert('Para acessar sua conta de usuário, termine a sessão como ONG');window.location.href='tela-inicial-ong.php';</script>";
}

$id = mysqli_real_escape_string($con, $_SESSION["id"]);

$select = $con->query("SELECT * from tb_ong where cd_voluntario = '$id'");


if (mysqli_fetch_row($select) > 0) {
    echo "<script>alert('Você ja possui uma ONG!');window.location.href='minhas-ongs2.php';</script>";
}


$nome = $_SESSION["nome"];
$email = $_SESSION["email"];
/**
 * Verificando se existe alguma sessão ativa
 */
if ($email == null) {

    echo "<script>alert('Login não efetuado');window.location.href='login.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minhas ONG'S</title>
    <!--IMPORTANDO ARQUIVOS-->
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" type="text/css" href="bibliotecas/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\js\bootstrap.js">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--Importando os icones-->
    <link rel="stylesheet" type="text/css" href="../css/minhas-ongs.css">
    <link rel="stylesheet" type="text/css" href="../css/geral.css">
</head>

<body>
    <?php include "../php/elementos/menu-lateral.php"; ?>
    <?php include "../php/elementos/pesquisa.php"; ?>
    <div id="conteudo">>
    <div class="divisao">
            <hr>
            <h3 class="titulo-evento">Você possui uma ONG? </h3>
            <hr>
        </div>
        <div class="porque-ong">
    <h5> Registre sua ONG no nosso site para publicar suas vagas e eventos</h5>
    <img src="../images/geraong.png" alt="" srcset="">
</div>
            <a href="cadastro-ong.php" class="botao"><button name="criar-ong" class="criar-ong">Gerar ONG</button></a>
    </div>
</body>

</html>