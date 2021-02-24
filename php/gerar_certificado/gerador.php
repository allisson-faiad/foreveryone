<?php
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
require('fpdf/alphapdf.php');
require('PHPMailer/class.phpmailer.php');


// --------- Variáveis do Formulário ----- //
/*$email    = $_POST['email'];
$nome     = utf8_decode($_POST['nome']);
$cpf      = $_POST['cpf'];*/



session_start();
include('../conecta_banco.php');

$cd_trabalho = $_GET["codigo"];


$select = $con->query("SELECT * FROM tb_trabalho_realizado where cd_trabalho_realizado = '$cd_trabalho'");
$linhas = $select->fetch_array();

$nm_trabalho = $linhas["nm_trabalho_realizado"];
$ds_trabalho = $linhas["ds_trabalho_realizado"];
$carga_horaria = $linhas["hr_carga_trabalho_realizado"];
$dt_fim = $linhas["dt_fim_trabalho"];
$nm_ong = $linhas["nm_ong"];
$cd_voluntario = $linhas["cd_voluntario"];


$select2 = $con->query("SELECT * FROM tb_voluntario where cd_voluntario = '$cd_voluntario'");
$linhas2 = $select2->fetch_array();
$nm_voluntario = $linhas2["nm_voluntario"];
$nm_email = $linhas2["nm_email_voluntario"];
$cd_cpf = $linhas2["cd_cpf_voluntario"];

// --------- Variáveis que podem vir de um banco de dados por exemplo ----- //
$empresa  = "For Everyone";
$trabalho    = "$nm_trabalho";
$ong = $nm_ong;
$data     = "29/05/2017";
$carga_h  = $carga_horaria;
$email = $nm_email;
$nome = $nm_voluntario;
$cpf = $cd_cpf;


$texto1 = utf8_decode($empresa);
$texto2 = utf8_decode('pela participação no trabalho "'.$trabalho.'", da ONG -  '.$ong.', concluído em '.$data.', com carga horária total de '.substr($carga_h,0,2).' horas.');
$texto3 = utf8_decode("São Vicente, ".utf8_encode(strftime( '%d de %B de %Y', strtotime( date( 'Y-m-d' ) ) )));


$pdf = new AlphaPDF();

// Orientação Landing Page ///
$pdf->AddPage('L');

$pdf->SetLineWidth(1.5);


// desenha a imagem do certificado
$pdf->Image('certificado-teste.jpg',0,0,295);

// opacidade total
$pdf->SetAlpha(1);

// Mostrar texto no topo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(130,46); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto1, '', 'L', 0); // Tamanho width e height e posição

// Mostrar o nome
$pdf->SetFont('Arial', '', 30); // Tipo de fonte e tamanho
$pdf->SetXY(20,86); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $nome, '', 'C', 0); // Tamanho width e height e posição

// Mostrar o corpo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(20,110); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto2, '', 'C', 0); // Tamanho width e height e posição

// Mostrar a data no final
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(32,172); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(165, 10, $texto3, '', 'L', 0); // Tamanho width e height e posição

$pdfdoc = $pdf->Output('', 'S');



// ******** Agora vai enviar o e-mail pro usuário contendo o anexo
// ******** e também mostrar na tela para caso o e-mail não chegar

$subject = 'Seu Certificado do Trabalho "'.$trabalho.'" concluído no dia '.$data.'';
$messageBody = "Olá $nome<br><br>É com grande prazer que entregamos o seu certificado.<br>Ele está em anexo nesse e-mail.<br><br>Atenciosamente,<br>Lincoln Borges<br><a href='http://www.lnborges.com.br'>http://www.lnborges.com.br</a>";


$mail = new PHPMailer();
$mail->SetFrom("certificado@lnborges.com.br", "Certificado");
$mail->Subject    = $subject;
$mail->MsgHTML(utf8_decode($messageBody));
$mail->AddAddress($email); 
$mail->addStringAttachment($pdfdoc, 'certificado.pdf');
$mail->Send();

$certificado="arquivos/$nome.pdf"; //atribui a variável $certificado com o caminho e o nome do arquivo que será salvo (vai usar o CPF digitado pelo usuário como nome de arquivo)
$pdf->Output($certificado,'F'); //Salva o certificado no servidor (verifique se a pasta "arquivos" tem a permissão necessária)
// Utilizando esse script provavelmente o certificado ficara salvo em www.seusite.com.br/gerar_certificado/arquivos/999.999.999-99.pdf (o 999 representa o CPF digitado pelo usuário)

$pdf->Output(); // Mostrar o certificado na tela do navegador

?>
