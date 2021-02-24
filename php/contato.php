<?php
session_start();
session_destroy();

if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["assunto"]) && isset($_POST["mensagem"])){
$nome = $_POST["nome"];
$email = $_POST["email"];
$assunto = $_POST["assunto"];
$mensagem = $_POST["mensagem"];

$to = "foreveryone.oficial2019@gmail.com";
$subject = $assunto;
$message = "<strong>Nome:</strong> $nome<br><br><strong>E-mail:</strong> $email<br><br>
<strong>Assunto:</strong> $assunto<br><br><strong>Mensagem:</strong> $mensagem";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset-iso-8859-1\r\n";
$headers .= "From: $email\r\n";
$headers .= "Return-Path: $email\r\n";
$envio = mail($to, $subject, $message, $headers);

if($envio)
echo "<script>alert('Mensagem enviada com sucesso!');</script>";
else
 echo "<script>alert('A mensagem não pode ser enviada');</script>";
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
	<link rel="stylesheet" type="text/css" media="screen" href="..\bootstrap\css\bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" media="screen" src="..\bootstrap\js\bootstrap.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/geral.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/cadastro.js"></script>


    <!--Importando os icones-->
	<link rel="stylesheet" type="text/css" href="../css/contato.css">
</head>
<body>
    <div class="container">
        <div class="side">
        <!--<img class="img-side" src="../images/icons/logotipo-icon.ico">-->
        </div>
        <div class="container2">
            <header>
             Contato
            </header>
            <section class="register">
            <form action="#" method="POST" class="form" name="formCadastro">
                    <div class="field">
                        <h2>Nome Completo</h2>
                        <input class="input" id="nome" type="text" name="nome">
                    </div>
                    <div class="field">
                        <h2>Email</h2>
                        <input class="input" id="email" type="text" name="email">
                    </div>
                    <div class="field">
                        <h2>Assunto</h2>
                        <input class="input" id="assunto" type="text" name="assunto">
                   <br>
                        <h2>Mensagem</h2>
                        <textarea class="input" id="mensagem" name="mensagem" cols="50" rows="10" style="resize: none"></textarea>
                    </div>
                    <div id="line"></div>
                    <div class="form_footer">
                        <a id="cancel" href="index.php">Cancelar</a>
                        <input id="submit" type="submit" value="Enviar ">
                    </div>
                </form>
            </section>
        </div>
    </div>
    <a href="../php/index.php"><button class="btn"><i class="fa fa-home"></i></button></a>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<script type="text/javascript" src="../js/endereco.js"></script>
</body>
</html>