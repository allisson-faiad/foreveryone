<?php
session_start();
include('conecta_banco.php');



if (isset($_SESSION['id_ong']) == true) {
    echo "<script>alert('Para acessar sua conta de usuário, termine a sessão como ONG');window.location.href='tela-inicial-ong.php';</script>";
}


$nome = $_SESSION["nome"];
$nome_usuario = $_SESSION["nome_usuario"];

$id = $_SESSION["id"];
$email = $_SESSION["email"];
/**
 * Verificando se existe alguma sessão ativa
 */


if ($email == null) {
    echo "<script>alert('Login não efetuado'); window.location.href = 'login.php';</script>";
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

//Deletando Registro depois da data
$select = $con->query("SELECT tb_vaga.*, tb_ong.nm_ong,tb_registro_vaga.cd_registro_vaga 
FROM tb_registro_vaga inner join tb_vaga
on tb_registro_vaga.cd_vaga = tb_vaga.cd_vaga
inner join tb_ong
on tb_vaga.cd_ong = tb_ong.cd_ong
 where tb_registro_vaga.cd_voluntario = '$id'");

$a = $select->fetch_array();
$cd_registro_vaga = $a["cd_registro_vaga"];
$dt_fim = $a["dt_fim"];
$dt_now = date("Y-m-d");

if ($dt_now >= $dt_fim) {
$deletar = $con->query("DELETE FROM tb_registro_vaga where cd_registro_vaga = '$cd_registro_vaga'");
}

//Deletando evento depois da data

$select1 = $con->query("SELECT dt_fim,hr_fim,cd_evento from tb_evento");
foreach ($select1 as $eventos) {
    $dt_fim = $eventos["dt_fim"];
    $cd_evento = $eventos["cd_evento"];

    $dt_now = date("Y-m-d");



    if ($dt_now > $dt_fim) {
        
        $deletar = $con->query("DELETE FROM tb_confirmacao_evento where cd_evento = '$cd_evento'");
        $deletar = $con->query("DELETE FROM tb_evento where cd_evento = '$cd_evento'");


    }
}

// Cadastrando na vaga
if (isset($_GET["codigo"])) {
    $cd_vaga = $_GET["codigo"];

    //Verificando se ele ja esta cadastrado
    $verifica = $con->query("SELECT cd_voluntario from tb_registro_vaga where cd_voluntario = '$id' and cd_vaga = '$cd_vaga'");

    //Verificando se ele já esta cadastrado em uma vaga
    $verifica2 = $con->query("SELECT cd_voluntario from tb_registro_vaga where cd_voluntario = '$id'");

    //Verificando se ele está tentando se cadastrar na própria vaga
    $verifica3 = $con->query("SELECT tb_vaga.cd_vaga 
	from tb_vaga inner join tb_ong
    on tb_vaga.cd_ong = tb_ong.cd_ong
	where tb_ong.cd_voluntario = $id
    and tb_vaga.cd_vaga = $cd_vaga;");
    
    //Verificando se atingiu o limite
    $verifica5 = $con->query("SELECT count(cd_voluntario) from tb_registro_vaga where cd_vaga = '$cd_vaga'");
    $linha = $verifica5->fetch_array();
    $qt_voluntarios = $linha["count(cd_voluntario)"];
      
    $verifica6 = $con->query("SELECT qt_limite_pessoas from tb_vaga where cd_vaga = '$cd_vaga'");
    $linha = $verifica6->fetch_array();
    $qt_limite = $linha["qt_limite_pessoas"];
    if (mysqli_num_rows($verifica) > 0) {
        echo "<script>alert('Você já está cadastrado nessa vaga');</script>";
    } elseif (mysqli_num_rows($verifica3) > 0) {
        echo "<script>alert('Não é possivel se cadastrar em uma vaga criada por você');</script>";
    } elseif ($qt_voluntarios == $qt_limite) {
        echo "<script>alert('Limite de voluntários atingido!');</script>";
    }else {
        $insert = $con->query("INSERT INTO tb_registro_vaga (cd_voluntario,cd_vaga) 
	VALUES ('$id','$cd_vaga')");
    }
}

// Cancelando Cadastro na vaga
if (isset($_GET["cancelarRegistro"])) {
    $deletar = $con->query("DELETE FROM tb_registro_vaga where cd_voluntario = '$id'");
}

// Cadastrando no evento
if (isset($_GET["confirmarPresenca"])) {
    $cd_evento = $_GET["confirmarPresenca"];

    $insert = $con->query("INSERT INTO tb_confirmacao_evento (cd_voluntario,cd_evento) 
	VALUES ('$id','$cd_evento')");
}

// Cancelando Presenca no evento
if (isset($_GET["cancelarPresenca"])) {
    $deletar = $con->query("DELETE FROM tb_confirmacao_evento where cd_voluntario = '$id'");
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>For Everyone</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--IMPORTANDO ARQUIVOS-->
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\js\bootstrap.js">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--Importando os icones-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="..\css\geral.css">
    <link rel="stylesheet" type="text/css" href="..\css\tela-inicial-voluntario.css">
    
    <script type="text/javascript" src="../js/jquery/jquery.min.js"></script>


</head>

<body>
    <?php include "../php/elementos/menu-lateral.php"; ?>
    <?php include "../php/elementos/pesquisa.php"; ?>
    <div id="conteudo">
    <div class="guarda-filtro">
            <?php $select = $con->query("SELECT nm_formacao from tb_formacao where cd_formacao = (SELECT cd_formacao from tb_voluntario where cd_voluntario = '$id')");
            $linha = $select->fetch_array();
            $nm_formacao = $linha["nm_formacao"];

            $select = $con->query("SELECT nm_habilidade from tb_habilidade where cd_habilidade = (SELECT cd_habilidade from tb_voluntario where cd_voluntario = '$id')");
            $linha2 = $select->fetch_array();
            $nm_habilidade = $linha2["nm_habilidade"];

   
?>





            <select name="filtro1" id="filtro1" class="filtro" style="margin-right: 8px;">
                <option style="display: none;">Formação</option>
                <option >Geral</option>
                <?php 
                // $inicio = stripos($nm_formacao,'&nbsp');
                // $tira = str_replace("&nbsp"," ",$nm_formacao);
                 // $tira = str_replace("&nbsp","",$_GET["filtro1"]);
                    // $tira2 = str_replace("&nbsp","",$nm_formacao);
                    
                echo "<option value='".$nm_formacao."'";
                
                if (isset($_GET["filtro1"]) && $_GET["filtro1"] == $nm_formacao) {
                    $filtro1 = $_GET['filtro1'];
                    echo "selected";
                }
                echo ">".$nm_formacao."</option>";?>

            </select>

            
            <select name="filtro2"  id="filtro2" class="filtro">
                <option style="display: none;">Habilidade</option>
                <option >Geral</option>

                <?php 
                echo "<option value='".$nm_habilidade."'";

                if (isset($_GET["filtro2"]) && $_GET["filtro2"] == $nm_habilidade) {
                    $filtro2 = $_GET['filtro2'];
                    echo "selected";
                }
                echo ">".$nm_habilidade."</option>";?>


            </select>
                <script>
        $(document).ready(function(e) {
            $("#filtro1").change(function(data){

                //Pegando o valor do select
                var valor2 = $(this).val();
                //Enviando o valor do meu select para ser processado e
                //retornar as informações que eu preciso
                $("body").load("tela-inicial-voluntario.php?filtro1="+ valor2);

                });
            $("#filtro2").change(function(data){

                //Pegando o valor do select
                var valor2 = $(this).val();
                //Enviando o valor do meu select para ser processado e
                //retornar as informações que eu preciso
                $("body").load("tela-inicial-voluntario.php?filtro2="+ valor2);

            });
        });
</script>
            
        </div>
        <div class="divisao">
            <hr>
            <h5 class="titulo-evento">Eventos </h5>
            <hr>
        </div>
        <div class="row">
        <?php

             //Pegando todas eventos e suas respectivas ongs
             $select = $con->query("SELECT tb_ong.*, tb_evento.*, tb_logradouro.nm_logradouro,tb_uf.sg_uf
             from tb_ong inner join tb_evento
             on tb_ong.cd_ong = tb_evento.cd_ong
              inner join tb_logradouro
            on tb_ong.cd_logradouro = tb_logradouro.cd_logradouro
              inner join tb_bairro
            on tb_logradouro.cd_bairro = tb_bairro.cd_bairro
            inner join tb_cidade
            on tb_bairro.cd_cidade = tb_cidade.cd_cidade
            inner join tb_uf
            on tb_cidade.cd_uf = tb_uf.cd_uf
            order by rand()
            LIMIT 4
            ");

     foreach ($select as $dados) {
         //  $dt_publicacao = $dados["dt_publicacao"];
         //  $datas = strtotime(date("Y-m-d")) - strtotime($dt_publicacao);
         // $periodo_tempo = floor($datas / (60 * 60 * 24));
//      if ($periodo_tempo < 20) {
  
             
             
            
         $cd_evento = $dados["cd_evento"];
         $verificaEvento = $con->query("SELECT cd_voluntario from tb_confirmacao_evento where cd_voluntario = '$id' and cd_evento = '$cd_evento'");


         $selectDia = $con->query("SELECT dt_inicio,hr_inicio from tb_evento where cd_evento = '$cd_evento'");
         $linha = $selectDia->fetch_array();
        //  $hr_inicio = $linha["hr_inicio"];
        //  $hr_now = date("H:i");
         
         
         $dt_inicio = $linha["dt_inicio"];
         $dt_now = date("Y-m-d");
         
         
         
         if ($dt_now <= $dt_inicio) {
             echo "
             <div class='example-2 card' style='background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(".$dados["im_foto"].") center / cover no-repeat !important'>
             <div class='wrapper first-card'>
                 <div class='header'>";


             echo "<div class='date'>
                         <span class='day'>" . date('d-m-Y',strtotime($dados["dt_publicacao"])) . "</span>
                     </div>
                     <ul class='menu-content'>
                         <li><a href='#' class='fa fa-clock-o'><span>" . substr($dados["hr_inicio"], 0, 5) . "</span></a></li>";

             //ver quantas pessoas estao confirmadas
             $selectEvento = $con->query("SELECT count(cd_confirmacao) from tb_confirmacao_evento where cd_evento = '$cd_evento'");
             $linhas = $selectEvento->fetch_array();
             $qt_pessoas = $linhas["count(cd_confirmacao)"];
             echo "<li><a href='#' class='fa fa-users'><span>$qt_pessoas</span></a></li>";
             if (mysqli_num_rows($verificaEvento) > 0) {
                 echo "
                         <li><a href='?cancelarPresenca=" . $dados["cd_evento"] . "'' class='fa fa-times'><span>Cancelar</span></a></li>
                         ";
             } else {
                 echo "<li><a href='?confirmarPresenca=" . $dados["cd_evento"] . "' class='fa fa-sign-in'><span>Confirmar</span></a></li>";
             }
             echo "</ul>
                 </div>
                 <div class='data'>
                     <div class='content'>
                         <span class='author'>".$dados["nm_logradouro"]." - ".$dados["sg_uf"]."</span>
                         <h1 class='title'><a href='#'>" . $dados["nm_evento"] . "</a></h1>
                        
                         <p class='text'>" . substr($dados["ds_evento"],0,20) . "...</p>";
                         if (mysqli_num_rows($verificaEvento) > 0) {
                             echo "<a href='?cancelarPresenca=" . $dados["cd_evento"] . "' class='btn btn-outline-light btn-block'>Cancelar</a>";   
                            }
                            else{
                                echo "<a href='?confirmarPresenca=" . $dados["cd_evento"] . "' class='btn btn-outline-light btn-block'>Confirmar</a>";
                         }
                         echo "<a href='visualizar-eventos2.php?visualizarEvento=" . $dados["cd_evento"] . "'><button type='button' class='btn btn-outline-light btn-block'>Visualizar Evento</button></a>
                         <a href='visualizar-ong.php?visualizarONG=" . $dados["cd_ong"] . "'><button type='button' style='padding:2px 2px !important;font-size:10px;border:0;' class='btn btn-outline-light btn-block'>ONG: ".$dados["nm_ong"]."</button></a>
                         </div>
             </div>
         </div>
        </div>
        ";
         }
     }
       
            ?>
        </div>
    
    <div class="divisao">
        <hr>
        <h5>Vagas</h5>
        <hr>
    </div>
    <div class="row">
    <?php

//Pegando todas vagas e suas respectivas ongs


if (isset($_GET["filtro1"])  && $_GET["filtro1"] == $nm_formacao){ //filtrar por formação
    $filtro1 = $_GET['filtro1'];
$select = $con->query("SELECT tb_ong.*, tb_vaga.*
from tb_ong inner join tb_vaga
on tb_ong.cd_ong = tb_vaga.cd_ong
where tb_ong.cd_voluntario != '$id' and tb_vaga.cd_formacao = (SELECT tb_formacao.cd_formacao from tb_formacao where tb_formacao.nm_formacao = '$filtro1')");
}
else if (isset($_GET["filtro2"])  && $_GET["filtro2"] == $nm_habilidade){ //filtrar por habilidade
    $filtro2 = $_GET['filtro2'];

$select = $con->query("SELECT tb_ong.*, tb_vaga.*
from tb_ong inner join tb_vaga
on tb_ong.cd_ong = tb_vaga.cd_ong
where tb_ong.cd_voluntario != '$id' and tb_vaga.cd_habilidade = (SELECT tb_habilidade.cd_habilidade from tb_habilidade where tb_habilidade.nm_habilidade = '$filtro2')");
}
else if (isset($_GET["filtro1"]) && isset($_GET["filtro2"]) && $_GET["filtro2"] == $nm_habilidade  && $_GET["filtro1"] == $nm_formacao){ // filtrar pelos dois
    $filtro1 = $_GET['filtro1'];
 $filtro2 = $_GET['filtro2'];
$select = $con->query("SELECT tb_ong.*, tb_vaga.*
from tb_ong inner join tb_vaga
on tb_ong.cd_ong = tb_vaga.cd_ong
where tb_ong.cd_voluntario != '$id' and tb_vaga.cd_formacao = (SELECT tb_formacao.cd_formacao from tb_formacao where tb_formacao.nm_formacao = '$filtro1')  and tb_vaga.cd_habilidade = (SELECT tb_habilidade.cd_habilidade from tb_habilidade where tb_habilidade.nm_habilidade = '$filtro2')");
}
else{ // sem filtro    
    $select = $con->query("SELECT tb_ong.*, tb_vaga.*, tb_logradouro.nm_logradouro,tb_uf.sg_uf
         from tb_ong inner join tb_vaga
         on tb_ong.cd_ong = tb_vaga.cd_ong
         inner join tb_logradouro
            on tb_ong.cd_logradouro = tb_logradouro.cd_logradouro
              inner join tb_bairro
            on tb_logradouro.cd_bairro = tb_bairro.cd_bairro
            inner join tb_cidade
            on tb_bairro.cd_cidade = tb_cidade.cd_cidade
            inner join tb_uf
            on tb_cidade.cd_uf = tb_uf.cd_uf
         where tb_ong.cd_voluntario != '$id'
         order by tb_vaga.nm_vaga asc");
}

 foreach ($select as $dados) {
     $cd_vaga = $dados["cd_vaga"];
     $select2 = $con->query("SELECT count(cd_registro_vaga) from tb_registro_vaga where cd_vaga = '$cd_vaga'");
     $linhas2 = $select2->fetch_array();
     $qt_pessoas = $linhas2["count(cd_registro_vaga)"];

     // usando para verificar se ja ta cadastrado
     $verificaVaga = $con->query("SELECT cd_voluntario from tb_registro_vaga where cd_voluntario = '$id' and cd_vaga = '$cd_vaga'");


     $selectDia = $con->query("SELECT dt_inicio,hr_inicio from tb_vaga where cd_vaga='$cd_vaga'");
     $linha = $selectDia->fetch_array();
     $dt_inicio = $linha["dt_inicio"];
     $hr_inicio = $linha["hr_inicio"];
     
     
     $dt_now = date("Y-m-d");
     $hr_now = date("H:i");
     
     
     
     if ($dt_now <= $dt_inicio) {
         echo "<div class='example-2 card' style='background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8)), url(".$dados["im_vaga"].") center / cover no-repeat !important'>
         
     <div class='wrapper first-card'>
         <div class='header'>";


         echo "<div class='date'>
                 <span class='day'>" .date('d-m-Y',strtotime($dados["dt_publicacao"])) . "</span>
             </div>
             <ul class='menu-content'>
                 <li><a href='#' class='fa fa-clock-o'><span>" . substr($dados["hr_carga_horaria"], 0, 5) . "</span></a></li>
                 <li><a href='#' class='fa fa-users'><span>$qt_pessoas</span></a></li>";
         if (mysqli_num_rows($verificaVaga) > 0) {
             echo "<li><a href='?cancelarInscricao=" . $dados["cd_vaga"] . "' class='fa fa-times'><span>Sair</span></a></li>";
         } else {
             echo "<li><a href='?codigo=" . $dados["cd_vaga"] . "' class='fa fa-sign-in'><span>Candidatar-se</span></a></li>";
         }
         echo"</ul>
         </div>
         <div class='data'>
             <div class='content'>
                 <h1 class='title'><a href='#'>" . $dados["nm_vaga"] . "</a></h1>
                
                 <p class='text'>" . substr($dados["ds_vaga"], 0, 50) . "...</p>";
         //Verificando se ele ja esta cadastrado
         
         if (mysqli_num_rows($verificaVaga) > 0) {
             echo "
                 <a href='?cancelarRegistro=" . $dados["cd_vaga"] . "' class='btn btn-outline-light btn-block'>Cancelar Registro</a>
                 <a href='visualizar-vagas2.php?visualizarVaga=" . $dados["cd_vaga"] . "' ><button type='button' class='btn btn-outline-light btn-block'>Visualizar Vaga</button></a>
                 <a href='visualizar-ong.php?visualizarONG=" . $dados["cd_ong"] . "'><button type='button' style='padding:2px 2px !important;font-size:10px;border:0;' class='btn btn-outline-light btn-block'>ONG: ".$dados["nm_ong"]."</button></a>

                     ";
         } else {
             echo "<a href='?codigo=" . $dados["cd_vaga"] . "' class='btn btn-outline-light btn-block'>PARTICIPAR</a>";
             echo "<a href='visualizar-vagas2.php?visualizarVaga=" . $dados["cd_vaga"] . "' ><button type='button' class='btn btn-outline-light btn-block'>Visualizar Vaga</button></a>
             <a href='visualizar-ong.php?visualizarONG=" . $dados["cd_ong"] . "'><button type='button' style='padding:2px 2px !important;font-size:10px;border:0;' class='btn btn-outline-light btn-block'>ONG: ".$dados["nm_ong"]."</button></a>
             ";
         }
         echo "</div>
         </div>
     </div>
 </div>";
     }
 }
    
 
        ?>
    </div>
    <div style="height:100px;width:100px;background:white;margin:50px;"></div>

    </div>

    <!--===============================================================================================-->
    <script src="bibliotecas/jquery/jquery-3.2.1.min.js"></script>
    <script src="bibliotecas/tilt/tilt.jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>