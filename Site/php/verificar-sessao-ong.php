<?php
session_start();
include "conecta_banco.php";

$id_ong = $_GET["id_ong"];

$query = $con->query("SELECT * FROM tb_ong where cd_ong = '$id_ong'");
$result = $query->fetch_array();
$nome_ong = $result["nm_ong"];
$email_ong = $result["nm_email_ong"];

$_SESSION["id_ong"] = $id_ong;
$_SESSION["nome_ong"] = $nome_ong;
$_SESSION["email_ong"] = $email_ong;


echo "<script>window.location.href='tela-inicial-ong.php';</script>";

?>