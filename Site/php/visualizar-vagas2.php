
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

$cd_vaga = $_GET["visualizarVaga"];

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
 <!-- Pegando os dados da vaga -->
<?php
            $select = $con->query("SELECT * from tb_vaga where cd_vaga = '$cd_vaga'");
            $linha = $select->fetch_array();
            $nm_vaga = $linha["nm_vaga"];
            $dt_inicio_vaga = $linha["dt_inicio"];
             ?>

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


           
            <form action="" method="POST" id="formulario" class="form" name="formCadastro">
                        <h2 style="text-align: center; font-weight: bolder;">Vaga: <?php echo $linha["nm_vaga"];?></h2>
                        <h2 style="text-align: center; font-weight: bolder;">ONG: <?php 
                        $selectONG = $con->query("SELECT nm_ong from tb_ong where cd_ong = (SELECT cd_ong from tb_vaga where cd_vaga = '$cd_vaga')");
                        $linha2 = $selectONG->fetch_array();
                        echo $linha2["nm_ong"];?></h2>
            <div class="field">
                <h2>Foto para Vaga</h2><br>
					<img src="<?php echo $linha["im_vaga"];?>"   width="400" height="300" alt="erro" id="foto-ong" class="img-fluid" name="" for=""><br>
                </div>
                <div class="field">
					
                    <h2>Formação Exigida</h2>
                    <select name="formacao" id="formacao" readonly>
                        <?php 
                        $cd_formacao = $linha["cd_formacao"];
                        $select2 = $con->query("SELECT nm_formacao from tb_formacao where cd_formacao = '$cd_formacao'");
                        $formacao = $select2->fetch_array();
                        $nm_formacao = $formacao["nm_formacao"];
                        ?>
                        <option selected disabled><?php echo $nm_formacao;?></option>
                        
                    </select>
                    </div>
                    <div class="field">
                    <h2>Habilidade Exigida</h2>
                    <select name="habilidade" id="habilidade" readonly>
                    <?php 
                        $cd_habilidade = $linha["cd_habilidade"];
                        $select3 = $con->query("SELECT nm_habilidade from tb_habilidade where cd_habilidade = '$cd_habilidade'");
                       if(mysqli_num_rows($select3)>0){
                        $habilidade = $select3->fetch_array();
                        $nm_habilidade = $habilidade["nm_habilidade"];
                       }else
                       $nm_habilidade = "Nenhuma";
                        ?>
                        <option selected disabled><?php echo $nm_habilidade;?></option>
                    </select>
                </div>
           
                <div class="field">
                    <h1></h1>
                </div>
                    <div class="field">
                    <h2>Quantidade Limite de Voluntários</h2>
                        <input class="input" type="number" value="<?php echo $linha["qt_limite_pessoas"];?>" max="300" value="Limite" readonly>
                    </div>
                    <div class="field">
                        <h2>Data inicial da vaga</h2>
                        <input class="input"  type="date" id="data_inicio" value="<?php echo $linha["dt_inicio"];?>" readonly>
                    </div>
                    <div class="field">
                        <h2>Data final da vaga</h2>
                        <input class="input" type="date" id="data_fim"  value="<?php echo $linha["dt_fim"];?>" readonly>   
                    </div>
                    <div class="field">
                        <h2>Horário de inicial da vaga</h2>
                        <input class="input" type="time" id="hora_inicio" name="hora_inicio" value="<?php echo substr($linha["hr_inicio"],0,5)?>" readonly>
                    </div>
                    <div class="field">
                        <h2>Horário de final da vaga </h2>
                        <input class="input" type="time" id="hora_fim" name="hora_fim" value="<?php echo substr($linha["hr_fim"],0,5)?>" readonly>
                    </div>
                    <div id="line"></div>

                    <?php
// PEGANDO TODO ENDEREÇO DO VOLUNTARIO

$select = $con->query("SELECT tb_logradouro.nm_logradouro, tb_logradouro.cd_cep, tb_bairro.nm_bairro, tb_cidade.nm_cidade,tb_uf.sg_uf, tb_vaga.nm_numero
from tb_uf inner join tb_cidade
on tb_uf.cd_uf = tb_cidade.cd_uf
inner join tb_bairro
on tb_cidade.cd_cidade = tb_bairro.cd_cidade
inner join tb_logradouro
on tb_bairro.cd_bairro = tb_logradouro.cd_bairro
inner join tb_vaga
on tb_logradouro.cd_logradouro = tb_vaga.cd_logradouro
WHERE cd_vaga = '$cd_vaga'");

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
                        <h2>Sobre a Vaga</h2>
                        <input  class="input"name="sobre" value="<?php echo $linha["ds_vaga"];?>" readonly></input>
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
                        <tr class="table100-head" ><th class="column1">Voluntarios da Vaga</th></tr>

							<tr class="table100-head">
                    <th class="column1">#</th>
                    <th class="column2">Nome</th>
                    <th class="column3">Habilidade</th>
                    <th class="column4">Formação</th>
							</tr>
						</thead>
						<tbody>
            <tr>
                <?php
                    $select = $con->query("SELECT * from tb_registro_vaga where cd_vaga = '$cd_vaga'");
                    foreach ($select as $dados) {
                        $cd_voluntario = $dados["cd_voluntario"];
                        $select2 = $con->query("SELECT * from tb_voluntario where cd_voluntario = '$cd_voluntario'");
                        $dados2 = $select2->fetch_array();
                        $im_voluntario = $dados2["im_voluntario"];
                        $nm_voluntario = $dados2["nm_voluntario"];


                        $habilidade = $dados2["cd_habilidade"];
                        $formacao = $dados2["cd_formacao"];

                        ?>
            <td class="column2"><img src="<?php echo $im_voluntario; ?>"   width="50" height="50" style="background-radius:20px;" alt="erro" id="foto-ong" class="img-fluid" name="" for=""><br></td>
                    <td class="column2"><?php echo "<a href='visualizar-voluntario.php?visualizarVoluntario=$cd_voluntario'>".$nm_voluntario."</a>"  ?></td>

                    <?php 
                        $cd_formacao = $linha["cd_formacao"];
                        $select2 = $con->query("SELECT nm_formacao from tb_formacao where cd_formacao = '$formacao'");
                        $formacao = $select2->fetch_array();
                        $nm_formacao = $formacao["nm_formacao"];
                    ?>
                    <td class="column3"><?php echo $nm_formacao ?></td>
                    
                    <?php $select3 = $con->query("SELECT nm_habilidade from tb_habilidade where cd_habilidade = '$habilidade'");
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