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
<link rel="stylesheet" type="text/css" href="../css/meus-certificados.css">
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
    
    <div class="limiter" id="conteudo">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>


                    
						<thead>
							<tr class="table100-head">
                                <th class="column1"><!--<a class="fa fa-address-card"></a>-->Trabalho Realizado</th>
                                <th class="column2">Descrição do Trabalho</th>
                                <th class="column2">Nome da ONG</th>
                                <th class="column3">Carga Horária   </th>
                                <th class="column3">Data Inicial   </th>
                                <th class="column3">Data Final   </th>
                                <th class="column5">Certificados</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                             $select = $con->query("SELECT * FROM tb_trabalho_realizado where cd_voluntario = '$id'");
                            

                            foreach($select as $a){
                                $cd_trabalho = $a["cd_trabalho_realizado"];

                                $nm_trabalho = $a["nm_trabalho_realizado"];
                                $ds_trabalho = $a["ds_trabalho_realizado"];
                                $carga_horaria = $a["hr_carga_trabalho_realizado"];
                                $dt_inicio = $a["dt_inicio_trabalho"];
                                $dt_fim = $a["dt_fim_trabalho"];

                                $nm_ong = $a["nm_ong"];
								echo "<tr>
                                    <td class='column1'> $nm_trabalho</td>
                                    <td class='column2'> $ds_trabalho</td>
                                    <td class='column4'>$nm_ong</td>
                                    <td class='column3'>$carga_horaria</td>
                                    <td class='column3'>$dt_inicio</td>
                                    <td class='column3'>$dt_fim</td>";

                                    $select2 = $con->query("SELECT cd_trabalho_realizado from tb_trabalho_realizado where nm_liberado_ong = 'Sim' and nm_trabalho_realizado = '$nm_trabalho' and nm_ong = '$nm_ong' and dt_inicio_trabalho = '$dt_inicio' and cd_voluntario = '$id'");
                                    if(mysqli_num_rows($select2) > 0)
                                    echo "<td class='column5'><a class='btn btn-primary' href='../php/gerar_certificado/gerador.php?codigo=$cd_trabalho'>Baixar</a></td>";

                                    else
                                      echo "<td class='column5'><a class='btn btn-primary' disabled>Baixar</a></td>";
                      
                                      echo "</tr>";
                                              
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