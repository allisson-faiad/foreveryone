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
<link rel="stylesheet" type="text/css" href="../css/minhas-atividades.css">
</head>

<body>
    <div class="principal">
        <?php
        session_start();
        if(isset($_SESSION["id_ong"])== false)
            include "../php/elementos/menu-lateral.php";
        else
        include "../php/elementos/menu-lateral-ong.php";

        ?>
                    <?php include "../php/elementos/pesquisa.php"; ?>

    </div>
    
    <div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
                    <th class="column1"><!--<a class="fa fa-address-card"></a>-->Nome</th>
                    <th class="column2">Função</th>
                    <th class="column3">Trabalho Realizado</th>
                    <th class="column4">Data de Início</th>
                    <th class="column5">Data de Termino</th>
							</tr>
						</thead>
						<tbody>
            <tr>
                    <td class="column1">Carlos Vinícius Souza Dos Santos</td>
                    <td class="column2">Desenvolvedor</td>
                    <td class="column3">Desenvolvimento Web</td>
                    <td class="column4">9/12/2019</td>
                    <td class="column5">9/1/2020</td>
								</tr>
                <tr>
                    <td class="column1">Carlos Vinícius Souza Dos Santos</td>
                    <td class="column2">Desenvolvedor</td>
                    <td class="column3">Desenvolvimento Web</td>
                    <td class="column4">9/12/2019</td>
                    <td class="column5">9/1/2020</td>
								</tr>
                <tr>
                    <td class="column1">Carlos Vinícius Souza Dos Santos</td>
                    <td class="column2">Desenvolvedor</td>
                    <td class="column3">Desenvolvimento Web</td>
                    <td class="column4">9/12/2019</td>
                    <td class="column5">9/1/2020</td>
								</tr>
                <tr>
                    <td class="column1">Carlos Vinícius Souza Dos Santos</td>
                    <td class="column2">Desenvolvedor</td>
                    <td class="column3">Desenvolvimento Web</td>
                    <td class="column4">9/12/2019</td>
                    <td class="column5">9/1/2020</td>
								</tr>
                <tr>
                    <td class="column1">Carlos Vinícius Souza Dos Santos</td>
                    <td class="column2">Desenvolvedor</td>
                    <td class="column3">Desenvolvimento Web</td>
                    <td class="column4">9/12/2019</td>
                    <td class="column5">9/1/2020</td>
								</tr>
								<tr>
                    <td class="column1">Carlos Vinícius Souza Dos Santos</td>
                    <td class="column2">Desenvolvedor</td>
                    <td class="column3">Desenvolvimento Web</td>
                    <td class="column4">9/12/2019</td>
                    <td class="column5">9/1/2020</td>
								</tr>
								<tr>
                    <td class="column1">Carlos Vinícius Souza Dos Santos</td>
                    <td class="column2">Desenvolvedor</td>
                    <td class="column3">Desenvolvimento Web</td>
                    <td class="column4">9/12/2019</td>
                    <td class="column5">9/1/2020</td>
								</tr>
								
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

    
<!--https://fdmania.com/top-25-simple-css3-html-table-templates-and-examples-2018-colorlib/-->
</body>

</html>