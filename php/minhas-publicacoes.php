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

//Verificando se o trabalho ja foi concluido
$select1 = $con->query("SELECT dt_fim,hr_fim,cd_vaga from tb_vaga");
foreach ($select1 as $vagas) {
    $dt_fim = $vagas["dt_fim"];
    $hr_fim = $vagas["hr_fim"];
    $cd_vaga = $vagas["cd_vaga"];

    $dt_now = date("Y-m-d");
    $hr_now = date("H:i");



    if ($dt_now >= $dt_fim) {
        $select2 = $con->query("SELECT tb_vaga.*,tb_voluntario.*,tb_ong.nm_ong from tb_vaga inner join tb_registro_vaga
    on tb_vaga.cd_vaga = tb_registro_vaga.cd_vaga
    inner join tb_voluntario
    on tb_voluntario.cd_voluntario = tb_registro_vaga.cd_voluntario
    inner join tb_ong
    on tb_ong.cd_ong = tb_vaga.cd_ong
    where tb_vaga.cd_vaga = '$cd_vaga'");

        foreach ($select2 as $a) {
            $nm_trabalho = $a["nm_vaga"];
            $ds_trabalho = $a["ds_vaga"];
            $carga_horaria = $a["hr_carga_horaria"];
            $nm_ong = $a["nm_ong"];
            $dt_inicio = $a["dt_inicio"];
            $dt_fim = $a["dt_fim"];
            $cd_voluntario = $a["cd_voluntario"];

            $select = $con->query("SELECT * from tb_trabalho_realizado where nm_trabalho_realizado = '$nm_trabalho' and cd_voluntario = '$cd_voluntario' ");

            if (mysqli_num_rows($select) <=0) {
                $insert = $con->query("INSERT INTO tb_trabalho_realizado (nm_trabalho_realizado,ds_trabalho_realizado,hr_carga_trabalho_realizado,nm_ong,dt_inicio_trabalho,dt_fim_trabalho,cd_voluntario) Values ('$nm_trabalho','$ds_trabalho','$carga_horaria','$nm_ong','$dt_inicio','$dt_fim','$cd_voluntario')");
            }
        }
    }
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="..\css\geral.css">
    <link rel="stylesheet" type="text/css" href="..\css\minhas-vagas.css">

    <script src="..\js\minhas-vagas.js"></script>
</head>

<body>
    <?php
     if(isset($_SESSION["id_ong"])== false)
     include "../php/elementos/menu-lateral.php";
 else
 include "../php/elementos/menu-lateral-ong.php";
    ?>
    <div id="conteudo">
        <?php 
         if(isset($_SESSION["id_ong"])== false)
         include "../php/elementos/pesquisa.php";
     else
     include "../php/elementos/pesquisa-ong.php";
      ?>
          <div style="height:50px;width:50px;background:white;margin:0px;"></div>

        <div class="divisao">
            <hr>
            <h5>Meus Eventos</h5>
            <hr>
        </div>
        <div class="row">
        <?php
            //Pegando todas eventos e suas respectivas ongs
            $select = $con->query("SELECT tb_ong.*, tb_evento.*,tb_logradouro.nm_logradouro,tb_uf.sg_uf
            from tb_ong inner join tb_evento
            on tb_ong.cd_ong = tb_evento.cd_ong
            inner join tb_logradouro
            on tb_evento.cd_logradouro = tb_logradouro.cd_logradouro
              inner join tb_bairro
            on tb_logradouro.cd_bairro = tb_bairro.cd_bairro
            inner join tb_cidade
            on tb_bairro.cd_cidade = tb_cidade.cd_cidade
            inner join tb_uf
            on tb_cidade.cd_uf = tb_uf.cd_uf
            where tb_ong.cd_ong = '$id'");

            


            foreach ($select as $dados) {

                $cd_evento = $dados["cd_evento"];
                 //ver quantas pessoas estao confirmadas
                 $selectEvento = $con->query("SELECT count(cd_confirmacao) from tb_confirmacao_evento where cd_evento = '$cd_evento'");
                 $linhas = $selectEvento->fetch_array();
                 $qt_pessoas = $linhas["count(cd_confirmacao)"];

                echo "<div class='example-2 card' style='background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(" . $dados["im_foto"] . ") center / cover no-repeat !important'>
                <div class='wrapper first-card'>
                    <div class='header'>";


                echo "<div class='date'>
                            <span class='day'>" . date('d-m-Y',strtotime($dados["dt_publicacao"])) . "</span>
                        </div>
                        <ul class='menu-content'>
                            <li><a href='#' class='fa fa-clock-o'><span>" . substr($dados["hr_inicio"],0,5) . "</span></a></li>
                            <li><a href='#' class='fa fa-users'><span>$qt_pessoas</span></a></li>
                            <li><a href='excluir-dados.php?excluirEvento=" . $dados["cd_evento"] . "' class='fa fa-times' onclick='return confirm(\"Confirma Exclusão?\")' ><span>Excluir</span></a></li>
                        </ul>
                    </div>
                    <div class='data'>
                        <div class='content'>
                            <span class='author'>".$dados["nm_logradouro"]." - ".$dados["sg_uf"]."</span>
                            <h1 class='title'><a href='#'>" . $dados["nm_evento"] . "</a></h1>
                            <p class='text'>" . $dados["ds_evento"] . "</p>
                           
                            <a href='visualizar-eventos.php?visualizarEvento=" . $dados["cd_evento"] . "'><button type='button' class='btn btn-outline-light btn-block'>Visualizar Informações</button></a>
                    </div>
                </div>
            </div>
    </div>
            ";
            
            }

            ?>
            </div>
     

        <div class="divisao">
            <hr>
            <h5>Minhas Vagas</h5>
            <hr>
        </div>
        <div class="row">
        <?php
        //Pegando todas vagas e suas respectivas ongs
        $select = $con->query("SELECT tb_ong.*, tb_vaga.*, tb_logradouro.nm_logradouro,tb_uf.sg_uf
					from tb_ong inner join tb_vaga
                    on tb_ong.cd_ong = tb_vaga.cd_ong
                    inner join tb_logradouro
            on tb_vaga.cd_logradouro = tb_logradouro.cd_logradouro
              inner join tb_bairro
            on tb_logradouro.cd_bairro = tb_bairro.cd_bairro
            inner join tb_cidade
            on tb_bairro.cd_cidade = tb_cidade.cd_cidade
            inner join tb_uf
            on tb_cidade.cd_uf = tb_uf.cd_uf
                    where tb_ong.cd_ong = '$id'");

        foreach ($select as $dados) {
            $cd_vaga = $dados["cd_vaga"];
            $select2 = $con->query("SELECT count(cd_registro_vaga) from tb_registro_vaga where cd_vaga = '$cd_vaga'");
            $linhas2 = $select2->fetch_array();
            $qt_pessoas = $linhas2["count(cd_registro_vaga)"];

            echo "<div class='example-2 card' style='background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8)), url(" . $dados["im_vaga"] . ") center / cover no-repeat !important'>
                    
                <div class='wrapper first-card'>
                    <div class='header'>";

            $dt_fim = $dados["dt_fim"];

            $dt_now = date("Y-m-d");



            if ($dt_now < $dt_fim) {
                echo "<div class='date'>
                            <span class='day'>" . date('d-m-Y', strtotime($dados["dt_publicacao"])) . "</span>
                        </div>
                        <ul class='menu-content'>
                            <li><a href='#' class='fa fa-clock-o'><span>" . substr($dados["hr_carga_horaria"], 0, 5) . "</span></a></li>
                            <li><a href='#' class='fa fa-users'><span>$qt_pessoas</span></a></li>
                            <li><a href='excluir-dados.php?excluirVaga=" . $dados["cd_vaga"] . "'  class='fa fa-times' onclick='return confirm(\"Confirma Exclusão?\")' ><span>Excluir</span></a></li>
                        </ul>
                    </div>
                    <div class='data'>
                        <div class='content'>
                            <span class='author'>".$dados["nm_logradouro"]." - ".$dados["sg_uf"]."</span>
                            <h1 class='title'><a href='#'>" . $dados["nm_vaga"] . "</a></h1>
                            <p class='text'>" . $dados["ds_vaga"] . "</p>
                            <a href='visualizar-vagas.php?visualizarVaga=" . $dados["cd_vaga"] . "' ><button type='button' class='btn btn-outline-light btn-block'>Visualizar Informações</button></a>

                </div>
                    </div>
                </div>
            </div>";
            }
            else{
                echo "<div class='date'>
                <span class='day'>" . date('d-m-Y', strtotime($dados["dt_publicacao"])) . "</span>
            </div>
        
        </div>
        <div >
            <div class='content'>
                <span class='author'></span>
                <br><br>
                <h1 class='title'><a href='#'> Vaga Encerrada</a><br>
                <a href='visualizar-vagas.php?visualizarVaga=" . $dados["cd_vaga"] . "' ><button type='button' class='btn btn-outline-light btn-block'>Visualizar Informações</button></a>

    </div>
        </div>
    </div>
</div>";
            }
        }

        ?>
            </div>
  
        </div>
    <div style="height:100px;width:100px;background:white;margin:50px;"></div>

</body>

</html>