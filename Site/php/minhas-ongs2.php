<?php
session_start();
include('conecta_banco.php');


if (isset($_SESSION['id_ong']) == true) {
    echo "<script>alert('Para acessar sua conta de usuário, termine a sessão como ONG');window.location.href='tela-inicial-ong.php';</script>";
}


$nome = $_SESSION["nome"];
$email = $_SESSION["email"];
$id = $_SESSION["id"];
/**
 * Verificando se existe alguma sessão ativa
 */
if ($email == null) {

    echo "<script>alert('Login não efetuado'); window.location.href = 'login.php';</script>";
}

$select = $con->query("SELECT * from tb_ong where cd_voluntario = '$id'");

if (mysqli_num_rows($select) == 0) {
    echo "<script>alert('Você não tem ONG's');window.location.href='minhas - ongs.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>For Everyone</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="..\css\geral.css">
    <link rel="stylesheet" type="text/css" href="..\css\minhas-ongs2.css">

    <script src="..\js\minhas-vagas.js"></script>
</head>

<body>
<div class="principal">
        <?php
        if(isset($_SESSION["id_ong"])== false)
            include "../php/elementos/menu-lateral.php";
        else
        include "../php/elementos/menu-lateral-ong.php";

        ?>
                    <?php include "../php/elementos/pesquisa.php"; ?>

    </div>
    <div id="conteudo" style="margin-top:50px;">
       
        <div class="divisao">
            <hr>
            <h5>Minhas ONG's</h5>
            <hr>
        </div>
        <div class="row card-ongs">
        <?php
          while ($dados = $select->fetch_array()) {
            echo "
                <div class='wrapper col-xl-4 col-lg-5 col-sm-12'>
                <div class=''>
                    <div class=''>
                    <div class='card'>
                    <div class='card-img'>
                    <img src='" . $dados["im_ong"] . "'>
                    </div>
                    <div class='card-body'>
                <h3>" . $dados["nm_ong"] . "</h3>
                <p class='text-justify'>" . $dados["ds_ong"] . "</p>
             
                <a  href='verificar-sessao-ong.php?id_ong=" . $dados["cd_ong"] . "'><button type='button' class='btn btn-primary'>Iniciar Sessão</button></a>
                <a href='excluir-dados.php?id_ong=" . $dados["cd_ong"] . "'  onclick='return confirm(\"Confirma Exclusão?\")' ><button type='button' class='btn btn-danger'>Excluir Ong</button></a>                   
                </div>
            </div>
                    </div>
        </div>    
                </div>
        ";
        }
        ?>
        </div>
<br>
<!-- <a href="../php/cadastro-ong.php"><button class="btn btn-fixed" style="background-color:green;color:#fff;"><i class="fa fa-plus"></i></button></a> -->


        
    </div><a href="../php/cadastro-ong.php"><button class="btn btn-fixed"><i class="fa fa-plus" ></i> Gerar nova ONG</button></a>

</body>

</html>