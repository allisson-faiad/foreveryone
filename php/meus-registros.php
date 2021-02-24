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

// Cancelando Cadastro na vaga
if (isset($_GET["cancelarRegistro"])) {
    $cd_registro = $_GET["cancelarRegistro"];
    $deletar = $con->query("DELETE FROM tb_registro_vaga where cd_voluntario = '$id' and cd_registro_vaga = '$cd_registro'");
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
                                <th class="column1"><!--<a class="fa fa-address-card"></a>-->Vaga</th>
                                <th class="column2">Descrição do Trabalho</th>
                                <th class="column2">Nome da ONG</th>
                                <th class="column3">Carga Horária   </th>
                                <th class="column3">Data Inicial   </th>
                                <th class="column3">Data Final   </th>
                                <th class="column5">Cancelar</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                             $select = $con->query("SELECT tb_vaga.*, tb_ong.nm_ong,tb_registro_vaga.cd_registro_vaga 
                             FROM tb_registro_vaga inner join tb_vaga
                             on tb_registro_vaga.cd_vaga = tb_vaga.cd_vaga
                             inner join tb_ong
                             on tb_vaga.cd_ong = tb_ong.cd_ong
                              where tb_registro_vaga.cd_voluntario = '$id'");
                            

                            foreach($select as $a){
                                $cd_registro_vaga = $a["cd_registro_vaga"];

                                $nm_trabalho = $a["nm_vaga"];
                                $ds_trabalho = $a["ds_vaga"];
                                $carga_horaria = $a["hr_carga_horaria"];
                                $dt_inicio = $a["dt_inicio"];
                                $dt_fim = $a["dt_fim"];

                                $nm_ong = $a["nm_ong"];

                                $dt_now = date("Y-m-d");

                                if ($dt_now >= $dt_fim) {
                                    $deletar = $con->query("DELETE FROM tb_registro_vaga where cd_registro_vaga = '$cd_registro_vaga'");
                                }else{
                                    echo "<tr>
                                    <td class='column1'> $nm_trabalho</td>
                                    <td class='column2'> $ds_trabalho</td>
                                    <td class='column4'>$nm_ong</td>
                                    <td class='column3'>$carga_horaria</td>
                                    <td class='column3'>$dt_inicio</td>
                                    <td class='column3'>$dt_fim</td>";
                                    echo "<td class='column5'><a class='btn btn-primary' href='?apagarRegistro=$cd_registro_vaga'>Cancelar Registro</a></td>";
                                
                                    echo "</tr>";
                                }
                                              
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