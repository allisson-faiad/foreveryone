<?php

session_start();
include('conecta_banco.php');


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
    $id = $_SESSION["id_ong"];
}

$select = $con->query("SELECT * from tb_ong where cd_ong ='$id'");
$dados = $select->fetch_array();
$nome_ong = $dados["nm_ong"];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>For Everyone</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="..\css\geral.css">
    <link rel="stylesheet" type="text/css" href="..\css\tela-inicial-ong.css">
</head>

<body>
    <?php include "../php/elementos/menu-lateral-ong.php"; ?>
    <?php include "../php/elementos/pesquisa-ong.php"; ?>
    <div id="conteudo">


        <section class="secundaria">
            <div class="divisao">
                <hr>
                <h5 class="titulo-evento">Publicações</h5>
                <hr>
            </div>


            <div class="botoes">
                <a href="cadastro-vaga.php"><button type="submit">Nova Vaga</button></a>
                <a href="cadastro-evento.php" style="margin-left: 5px;"><button type="submit">Novo Evento</button></a>
            </div>

            <div class='cards'>
                <div class='esquerda-cards'>

                    <?php
                    //Pegando todas vagas e suas respectivas ongs
                    $select = $con->query("SELECT tb_ong.*, tb_vaga.*
					from tb_ong inner join tb_vaga
                    on tb_ong.cd_ong = tb_vaga.cd_ong");



                    foreach ($select as $dados) {
                        $cd_vaga = $dados["cd_vaga"];

                        $select2 = $con->query("SELECT count(cd_registro_vaga) from tb_registro_vaga where cd_vaga = '$cd_vaga'");
                        $linhas2 = $select2->fetch_array();
                        $qt_pessoas = $linhas2["count(cd_registro_vaga)"];
                        echo "<div class='card' style='margin-bottom: 100px;'>
                            <div class='dentro-esquerda'>
                                <div class='perf'style='display: flex; align-items: center;'>
                                    <img class='logotipo-avatar' src='" . $dados["im_ong"] . "' alt=''>
                                    <p style='margin: 0 10px; color: black;'>" . $dados["nm_ong"] . "</p>
                                </div>
                                <div>
                                    <i class='fa fa-users fa-2x'></i>
                                    <p style='text-align: center;'>$qt_pessoas</p>
                                </div>
                            </div>
                            <p class='publicacao'><span style='font-weight: bold;'>Publicou:</span>" . $dados["nm_vaga"] . "</p>
                            <p class='publicacao sobre'><span style='font-weight: bold;'>Descrição:</span>" .  $dados["ds_vaga"]. "</p>
                            <div class='imagem'><img src='" . $dados["im_vaga"] . "'class='img-vaga img-fluid' alt'imagem da vaga'></img></div>
                            <p style='font-size: 18px;'>Publicado em: " . date('d-m-Y',strtotime($dados["dt_publicacao"])) . "</p>
                        </div>";
                    }
                    ?>

                </div>
                <div class="direita-cards">

                </div>


            </div>
        </section>
    </div>
</body>

</html>