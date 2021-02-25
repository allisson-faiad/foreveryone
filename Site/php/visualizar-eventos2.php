
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



$cd_evento = $_GET["visualizarEvento"];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>For Everyone</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" type="text/css" href="bibliotecas/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\js\bootstrap.js">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../biblioteca/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../biblioteca/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../biblioteca/vendor/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" type="text/css" href="../css/geral.css">
<link rel="stylesheet" type="text/css" href="../css/visualizar-vagas.css">
</head>

<body>
    <div class="principal">
        <?php
        if (isset($_SESSION["id_ong"])== false) {
            include "../php/elementos/menu-lateral.php";
        } else {
            include "../php/elementos/menu-lateral-ong.php";
        }

        ?>
                    <?php include "../php/elementos/pesquisa.php"; ?>

    </div>

    <div class="container2">
            
            <section class="register">


            <?php
            $select = $con->query("SELECT * from tb_evento where cd_evento = '$cd_evento'");
            $linha = $select->fetch_array();
            
             ?>
            <form action="" method="POST" id="formulario" class="form" name="formCadastro">
                        <h2 style="text-align: center; font-weight: bolder;">Evento: <?php echo $linha["nm_evento"];?></h2>
                        <h2 style="text-align: center; font-weight: bolder;">ONG: <?php 
                        $selectONG = $con->query("SELECT nm_ong from tb_ong where cd_ong = (SELECT cd_ong from tb_evento where cd_evento = '$cd_evento')");
                        $linha2 = $selectONG->fetch_array();
                        echo $linha2["nm_ong"];?></h2>
            <div class="field">
                <h2>Foto para evento</h2><br>
					<img src="<?php echo $linha["im_foto"];?>"   width="400" height="300" alt="erro" id="foto-ong" class="img-fluid" name="" for=""><br>
                </div>           
                <div class="field">
                    <h1></h1>
                </div>
                    <div class="field">
                    <h2>Quantidade de confirmados</h2>
                    <?php 
                     $selectEvento = $con->query("SELECT count(cd_confirmacao) from tb_confirmacao_evento where cd_evento = '$cd_evento'");
                     $linhas = $selectEvento->fetch_array();
                     $qt_pessoas = $linhas["count(cd_confirmacao)"];
                    ?>
                        <input class="input" type="number" value="<?php echo $qt_pessoas;?>" max="300" value="Limite" readonly>
                    </div>
                    <div class="field">
                        <h2>Data inicial da evento</h2>
                        <input class="input"  type="date" id="data_inicio" value="<?php echo $linha["dt_inicio"];?>" readonly>
                    </div>
                    <div class="field">
                        <h2>Data final da evento</h2>
                        <input class="input" type="date" id="data_fim"  value="<?php echo $linha["dt_fim"];?>" readonly>   
                    </div>
                    <div class="field">
                        <h2>Horário de inicial da evento</h2>
                        <input class="input" type="time" id="hora_inicio" name="hora_inicio" value="<?php echo substr($linha["hr_inicio"],0,5)?>" readonly>
                    </div>
                    <div class="field">
                        <h2>Horário de final da evento </h2>
                        <input class="input" type="time" id="hora_fim" name="hora_fim" value="<?php echo substr($linha["hr_fim"],0,5)?>" readonly>
                    </div>
                    <div id="line"></div>

                    <?php
// PEGANDO TODO ENDEREÇO DO VOLUNTARIO

$select = $con->query("SELECT tb_logradouro.nm_logradouro, tb_logradouro.cd_cep, tb_bairro.nm_bairro, tb_cidade.nm_cidade,tb_uf.sg_uf, tb_evento.nm_numero
from tb_uf inner join tb_cidade
on tb_uf.cd_uf = tb_cidade.cd_uf
inner join tb_bairro
on tb_cidade.cd_cidade = tb_bairro.cd_cidade
inner join tb_logradouro
on tb_bairro.cd_bairro = tb_logradouro.cd_bairro
inner join tb_evento
on tb_logradouro.cd_logradouro = tb_evento.cd_logradouro
WHERE cd_evento = '$cd_evento'");

$linhas = $select->fetch_array();

$numero = $linhas['nm_numero'];
$logradouro = $linhas['nm_logradouro'];
$cep = $linhas['cd_cep'];
$bairro = $linhas['nm_bairro'];
$cidade = $linhas['nm_cidade'];
$uf = $linhas['sg_uf'];
?>
                    <div class="field">
                        <h2>Logradouro</h2>
                        <input class="input" id="cadastro-logradouro"  name="logradouro" value="<?php echo $logradouro;?>" readonly>
                    </div>
                    <div class="field">
                        <h2>Número</h2>
                        <input class="input"  id="cadastro-numero"  name="numero" value="<?php echo $numero;?>" readonly>
                    </div>
                    <div class="field">
                        <h2>CEP</h2>
                        <input class="input" id="cadastro-cep"  name="cep" maxlength="8" value="<?php echo $cep;?>" readonly>
                    </div>
                    <div class="field">
                        <h2>Bairro</h2>
                        <input class="input" id="cadastro-bairro" name="bairro"  value="<?php echo $bairro;?>" readonly>
                    </div>
                    <div class="field">
                        <h2>Cidade</h2>
                        <input class="input"  id="cadastro-cidade" name="cidade" value="<?php echo $cidade;?>" readonly>
                    </div>
                    <div class="field">
                        <h2>UF</h2>
                        <input class="input" id="cadastro-uf"  name="uf" value="<?php echo $uf;?>" readonly>
                    </div>


                    <div id="line"></div>

               <br>
                    <div class="field">
                        <h2>Sobre a evento</h2>
                        <input  class="input"name="sobre" value="<?php echo $linha["ds_evento"];?>" readonly></input>
                    </div>
                </form>
            </section>
        </div>
        
  
    <div class="limiter">
		<div class="container-table100" style="margin-left:20px;">
			<div class="wrap-table100">
				<div class="table100">
					<table>

						<thead>
                        <tr class="table100-head" ><th class="column1">Voluntarios do Evento</th></tr>

							<tr class="table100-head">
                    <th class="column1"><!--<a class="fa fa-address-card"></a>--></th>
                    <th class="column2">Nome</th>
                    <th class="column3">Habilidade</th>
                    <th class="column4">Formação</th>
							</tr>
						</thead>
						<tbody>
            <tr>
                <?php
                  $selectEvento = $con->query("SELECT cd_voluntario from tb_confirmacao_evento where cd_evento = '$cd_evento'");
                    foreach ($selectEvento as $dados) {
                        $cd_voluntario = $dados["cd_voluntario"];
                        $select2 = $con->query("SELECT * from tb_voluntario where cd_voluntario = '$cd_voluntario'");
                        $dados2 = $select2->fetch_array();
                        $im_voluntario = $dados2["im_voluntario"];
                        $nm_voluntario = $dados2["nm_voluntario"];

                        ?>
            <td class="column2"><img src="<?php echo $im_voluntario; ?>"   width="50" height="50" style="background-radius:20px;" alt="erro" id="foto-ong" class="img-fluid" name="" for=""><br></td>
                    <td class="column2"><?php echo "<a href='visualizar-voluntario.php?visualizarVoluntario=$cd_voluntario'>".$nm_voluntario."</a>"  ?></td>

                    <?php 
                        $select2 = $con->query("SELECT nm_formacao from tb_formacao where cd_formacao = (SELECT cd_formacao from tb_voluntario where cd_voluntario = '$cd_voluntario')");
                        $formacao = $select2->fetch_array();
                        $nm_formacao = $formacao["nm_formacao"];
                    ?>
                    <td class="column3"><?php echo $nm_formacao ?></td>
                    
                    <?php $select3 = $con->query("SELECT nm_habilidade from tb_habilidade where cd_habilidade = (SELECT cd_habilidade from tb_voluntario where cd_voluntario = '$cd_voluntario')");
                        $habilidade = $select3->fetch_array();
                        $nm_habilidade = $habilidade["nm_habilidade"];
                        ?>
                    <td class="column4"><?php echo $nm_habilidade ?></td>
								</tr>
                <?php
                    }
                ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

    
<!--https://fdmania.com/top-25-simple-css3-html-table-templates-and-examples-2018-colorlib/-->
</body>

</html>