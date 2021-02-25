<?php
session_start();
session_destroy();
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

    <link rel="stylesheet" type="text/css" media="screen" href="..\css\sobre.css">


</head>

<body>
    <div class="top">
        <div class="header">
        </div>
    </div>
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
    <a href="../php/index.php"><button class="btn"><i class="fa fa-home"></i></button></a>

</body>

</html>