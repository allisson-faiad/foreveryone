<?php
session_start();
include "conecta_banco.php";

$id = mysqli_real_escape_string($con,$_SESSION["id"]);

$select = $con->query("SELECT * from tb_ong where cd_voluntario = '$id'");


if(mysqli_fetch_row($select) > 0){
header("location: minhas-ongs2.php");
}
else{
    
    header("location: minhas-ongs.php");   
}
?>