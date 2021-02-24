<?php
session_start();
session_destroy();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>For Everyone</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--IMPORTANDO ARQUIVOS-->
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="../v6.1.0-dist/ol.css" rel="stylesheet">
    <script src="../v6.1.0-dist/ol.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v6.1.0/css/ol.css">

    <!--Importando os icones-->
    <link rel="stylesheet" type="text/css" href="..\css\index.css">
    <link rel="stylesheet" type="text/css" href="..\css\geral.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container-fluid" style="padding:0px;">
        <!-- header -->
        <header id="topo">
            <div class="d-none d-sm-block">
                <nav class="row menu-xl">
                    <ul class="col-xl-4 piece">
                        <li><a href="index.php" class="menu-a">Home</a></li>
                        <!-- <li><a href="ajuda.php" style="padding: 9px 39px;">Ajuda</a></li> -->

                        <li><a href="sobre-index.php" class="menu-a">Sobre</a></li>

                        <li><a href="contato.php" class="menu-a" >Contato</a></li>

                    </ul>
                    <div class="col-xl-5">

                    </div>
                    <ul class="col-xl-3 piece">
                        <li><a href="login.php">Login</a></li>

                        <li><a href="cadastro.php">Cadastre-se</a></li>
                    </ul>
                </nav>
            </div>
            <button id="btn-menu" class="d-block d-sm-none"><i class="fa fa-bars fa-lg"></i></button>
            <nav id="menu-mobile">
                <a id="btn-close" class="d-block d-sm-none">x</a>
                <ul>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="cadastro.php">Cadastre-se</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                    <li><a href="contato-index.php">Contato</a></li>
                    <li><a href="ajuda-index.php">Ajuda</a></li>
                </ul>
            </nav>
            <div class="conteudo-index">
                <h6>JUNTOS NÓS PODEMOS</h6>
                <img src="../images/logotipoatual.png" alt="IMG" id="logo" class="logotipo img-fluid">
                <h1>FOR <span style="color: #f67f00;">EVERYONE</span></h1>
                <h6>FAÇA A DIFERENÇA</h6>
                <a  href="../php/cadastro.php"><button type="submit">QUERO SER UM VOLUNTÁRIO</button></a>
            </div>
        </header>
        <!--Fim do Header-->
         <div class="card-deck card-deck--half-and-half">        
          <div class="card">
            <div class="card__image">
        <img  src="../images/id-card.png">
            </div>
            <div class="card__content">
              <h3>Venha ser um Voluntário</h3>
              <p class="text-align">Cadastrem-se e venham se tornar um voluntário.</p>
            </div>
          </div>          
          <div class="card">
            <div class="card__image">
              <img src="../images/map.png">
            </div>
            <div class="card__content">
              <h3>Mapa de Ong's</h3>
              <p class="text-align">Veja as ong's mais próximas que se cadastraram no nosso software.</p><BR>
              <button type="button" style="margin:10px;color:white;background-color:rgb(226, 124, 41);" class="btn" data-toggle="modal" data-target="#myModal">
                Veja
                </button>  
                <?php include "../php/elementos/modal.php"; ?>            
            </div>
          </div>          
          <div class="card">
            <div class="card__image">
            <img src="../images/search.png">
            </div>
            <div class="card__content">
              <h3>Busca de Voluntários</h3>
              <p class="text-align">Se cadastre, crie sua ong ou eventos e busque por pessoas para ajudar em <span class="span-text">trabalho voluntário</span>.</p>
              <style>.span-text{color:#f67f00;font-size:18px;}</style>
            </div>
          </div>
          
          <div class="card">
            <div class="card__image">
            <img src="../images/calendar.png">
            </div>
            <div class="card__content">
              <h3>Criação de Eventos</h3>
              <p class="text-align">Após o seu cadastro como ong, você poderá criar eventos para as participações de voluntários.</p>
            </div>
          </div> 
        </div>
    </div>
    <div class="card-deck card-deck--half-and-half">     
          <div class="card">
            <div class="card__image">
        <img  src="../images/agenda.png">
            </div>
            <div class="card__content">
              <h3 >Lei Nº 9608, 18 de Fevereiro de 1998</h3>
              <p class="text-align">Art.1º. Considera-se serviço voluntário, para fins desta Lei, a atividade não remunerada, prestada por pessoa fisica a entidade pública de qualquer natureza, ou a instituição privada de fins não lucrativos, que tenha objetivos civicos, culturais, educacionais, cientificos, recreativos ou de assistência social, inclusive mutualidade.</p>
            </div>
          </div>
          
          <div class="card">
            <div class="card__image">
              <img src="../images/tes.png">
            </div>
            <div class="card__content">
              <h3> Sobre a nós </h3>
               <video style="height:100%;width:100%;margin:1px;padding:1px;" src="../images/pitch.mp4" controls="controls"></video>
              
            </div>       
        </div>
    </div>

    </section>

    <div class="divisao"></div>

    <a href="../php/ajuda-index.php"><button class="btn btn-fixed" style="background-color:rgb(226, 124, 41);color:#fff;"><i class="fa fa-question"></i></button></a>

    <?php include "../php/elementos/footer.php"; ?>
    <?php include "../php/elementos/scroll-bar.php"; ?>
    </div>
    <!--Fim do container-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!--===============================================================================================-->
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
    </script>
    <script>
        $("#btn-menu").click(function() {
            $("#menu-mobile").show();
        });
        $("#btn-close").click(function() {
            $("#menu-mobile").hide();
        });
    </script>
</body>

</html>