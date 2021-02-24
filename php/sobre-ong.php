<?php
session_start();
include('conecta_banco.php');



$nome = $_SESSION["nome"];
$nome_usuario = $_SESSION["nome_usuario"];

$id = $_SESSION["id"];
$email = $_SESSION["email"];
/**
 * Verificando se existe alguma sessão ativa
 */
if ($email == null) {

    echo "<script>alert('Login não efetuado');window.location.href='login.php';</script>";
}

if (isset($_SESSION['id_ong']) == false) {
    echo "<script>alert('Sessão da ONG não iniciada');window.location.href='minhas-ongs2.php';</script>";
} else {
    $id_ong = $_SESSION["id_ong"];
}

$select = $con->query("SELECT * from tb_ong where cd_ong ='$id_ong'");
$dados = $select->fetch_array();
$nome_ong = $dados["nm_ong"];


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sobre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--IMPORTANDO ARQUIVOS-->
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" type="text/css" href="..\bibliotecas\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\js\bootstrap.js">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="screen" href="..\css\geral.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\css\sobre.css">


</head>

<body>
    <?php include "../php/elementos/menu-lateral-ong.php"; ?>
    <?php include "../php/elementos/pesquisa-ong.php"; ?>
    <div id="conteudo">
        <div class="row" id="div-lateral">


        </div>
        <!--<div class="top">
    <div class="header">
      </div>
</div>-->
        <div class="content">
            <div class="img-lat">
                <img src="../images/tes.png">
            </div>
            <div class="article">
                <h2>Quem somos?</h2>
                <h3>For Everyone</h3>
                <p class="firstpara"><span class="firstcharacter">l</span>O projeto “For Everyone” que é um site que tem por objetivo tornar o voluntariado mais acessível à população, através de informações sobre, bem como,
                    o estímulo da prática do mesmo pela emissão de certificados,
                    sendo uma forma de comprovação sobre o voluntariado realizado, além do acesso à vagas em ONG’s através de sua formação ou habilidade de forma simples e prática.</p>
            </div>
            <!-- ***************************************************** -->
            <div class="divisao"></div>

            <div class="card-deck card-deck--regular">
                <h2 class="card-deck__title"><img src="../images/code.png" style="padding:10px;">Desenvolvedores</h2>

                <div class="card">
                    <div class="card__image">
                        <img src="../images/carlos.jpeg" style="height:100px;width:100px;background-size:cover;border-radius:100%;border: 1px solid #444;">
                    </div>
                    <div class="card__content">
                        <h3>Carlos Vinicius Souza </h3>
                        <h5>Front-End Developer</h5>
                        <!-- <p>17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso. Busco para meu
        futuro profissional fazer uma faculdade de Design Digital, Fotografia e de Administração. E para meu
        futuro pessoal busco me desenvolver com mais conhecimentos e saberes.</p> -->
                    </div>
                </div>

                <div class="card">
                    <div class="card__image">
                        <img src="../images/ileck.jpeg" style="height:100px;width:100px;background-size:cover;border-radius:100%;border: 1px solid #444;">
                    </div>
                    <div class="card__content">
                        <h3>Matheus Ileck Farias</h3>
                        <h5>Front-End Developer</h5>
                        <!-- <p>Tenho 17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso.
        Busco para meu futuro profissional fazer uma faculdade de Ciência da Computação e Engenharia de
        Software.</p> -->
                    </div>
                </div>

                <div class="card">
                    <div class="card__image">
                        <img src="../images/allisson.jpeg" style="height:100px;width:100px;background-size:cover;border-radius:100%;border: 1px solid #444;">
                    </div>
                    <div class="card__content">
                        <h3>Allisson Faiad Santos</h3>
                        <h5>Back-End Developer</h5>
                        <!-- <p>17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso. Busco para meu
        futuro profissional fazer uma faculdade de Design Digital, Fotografia e de Administração. E para meu
        futuro pessoal busco me desenvolver com mais conhecimentos e saberes.</p> -->
                    </div>
                </div>

                <div class="card">
                    <div class="card__image">
                        <img src="../images/jaime.jpg" style="height:100px;width:100px;background-size:cover;border-radius:100%;border: 1px solid #444;">
                    </div>
                    <div class="card__content">
                        <h3>Jaime Gabriel Sandim</h3>
                        <h5>Front-End Developer</h5>
                        <!-- <p>Tenho 17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso.
        Busco para meu futuro profissional fazer uma faculdade de Ciência da Computação e Engenharia de
        Software.</p> -->
                    </div>
                </div>

                <div class="card">
                    <div class="card__image">
                        <img src="../images/alexia.jpeg" style="height:100px;width:100px;background-size:cover;border-radius:100%;border: 1px solid #444;">
                    </div>
                    <div class="card__content">
                        <h3>Alexia Ribeiro Marques</h3>
                        <h5>Ciencia de Dados</h5>
                        <!-- <p>Tenho 17 anos e no momento estou cursando Desenvolvimento de Sistemas na Etec Dra. Ruth Cardoso. 
          Me vejo futuramente na área de pesquisas científica da tecnologia avançada existente.
    </p> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="container">
            <div class="row align-items-center">
                <div class="foto1">
                    <img class="avatar" src="../images/allisson.jpeg">
                </div>
                <div class="col col-lg-3">
                    <h5 class="p1">Allisson Faiad Santos
                </div>
                <div class="col">
                    <h6> 17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso. Busco para meu
                        futuro profissional fazer uma faculdade de Design Digital, Fotografia e de Administração. E para meu
                        futuro pessoal busco me desenvolver com mais conhecimentos e saberes.
                    </h6>
                </div>

            </div>
            <hr>
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="p1">Tenho 17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso.
                        Busco para meu futuro profissional fazer uma faculdade de Engenharia de Software e segurança
                        cibernética. </h6>
                </div>
                <div class="col col-lg-3">
                    <h5 class="p2">Carlos Vinicius Santos</h4>
                </div>
                <div class="foto2">
                    <img class="avatar" src="../images/carlos.jpeg">
                </div>

            </div>
            <hr>
            <div class="row align-items-center">
                <div class="foto3 ">
                    <img class="avatar" src="../images/ileck.jpeg">
                </div>
                <div class="col col-lg-3">
                    <h5 class="p3">Matheus Ileck Farias</h4>
                </div>
                <div class="col">
                    <h6 class="p3">Tenho 17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso.
                        Busco para meu futuro profissional fazer uma faculdade de Ciência da Computação e Engenharia de
                        Software.</h6>
                </div>
            </div>
            <hr>
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="p1">Tenho 17 anos e no momento estou cursando Desenvolvimento de Sistemas na Etec Dra. Ruth Cardoso. Me vejo futuramente na área de pesquisas científica da tecnologia avançada existente.</h6>
                </div>
                <div class="col col-lg-3">
                    <h5 class="p4">Alexia Ribeiro</h4>
                </div>
                <div class="foto4">
                    <img class="avatar" src="../images/alexia.jpeg">
                </div>
            </div>
            <hr>
            <div class="row align-items-center">
                <div class="foto3 ">
                    <img class="avatar" src="../images/jaime.jpeg">
                </div>
                <div class="col col-lg-3">
                    <h5 class="avatar" class="p3">Jaime Gabriel Sandim Santos</h4>
                </div>
                <div class="col">
                    <h6 class="p3">Tenho 17 anos, estou cursando Desenvolvimento de Sistemas na ETEC Dra. Ruth Cardoso.
                        Busco para meu futuro profissional fazer uma faculdade de Ciência da Computação e Engenharia de
                        Software.</h6>
                </div>
            </div>
        </div>
        <br>
    </section> -->

</body>

</html>