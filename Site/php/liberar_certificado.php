<?php
include "conecta_banco.php";
session_start();

if (isset($_GET["cd_vaga"])) {
    $id_ong = $_SESSION["id_ong"];

    $select = $con->query("SELECT * from tb_ong where cd_ong ='$id_ong'");
    $dados = $select->fetch_array();
    $nome_ong = $dados["nm_ong"];

    $cd_vaga = $_GET["cd_vaga"];



    $select = $con->query("SELECT * from tb_vaga where cd_vaga = '$cd_vaga'");
    $linha = $select->fetch_array();
    $nm_vaga = $linha["nm_vaga"];
    $dt_inicio_vaga = $linha["dt_inicio"];


    $select = $con->query("SELECT cd_trabalho_realizado from tb_trabalho_realizado where nm_liberado_ong = '' and nm_trabalho_realizado = '$nm_vaga' and nm_ong = '$nome_ong' and dt_inicio_trabalho = '$dt_inicio_vaga'");

    foreach ($select as $libera) {
        $codigo = $libera["cd_trabalho_realizado"];
        $update = $con->query("UPDATE tb_trabalho_realizado set nm_liberado_ong = 'Sim' where cd_trabalho_realizado = '$codigo'  ");
    }

    echo "<meta charset='utf-8'> <script>alert('Certificado Liberado'); window.location = 'visualizar-vagas.php?visualizarVaga=$cd_vaga';</script>";
}
else if(isset($_GET["cd_vaga2"])){

    $id_ong = $_SESSION["id_ong"];

    $select = $con->query("SELECT * from tb_ong where cd_ong ='$id_ong'");
    $dados = $select->fetch_array();
    $nome_ong = $dados["nm_ong"];

    $cd_vaga = $_GET["cd_vaga2"];



    $select = $con->query("SELECT * from tb_vaga where cd_vaga = '$cd_vaga'");
    $linha = $select->fetch_array();
    $nm_vaga = $linha["nm_vaga"];
    $dt_inicio_vaga = $linha["dt_inicio"];


    $select = $con->query("SELECT cd_trabalho_realizado from tb_trabalho_realizado where nm_liberado_ong = 'Sim' and nm_trabalho_realizado = '$nm_vaga' and nm_ong = '$nome_ong' and dt_inicio_trabalho = '$dt_inicio_vaga'");

    foreach ($select as $libera) {
        $codigo = $libera["cd_trabalho_realizado"];
        $update = $con->query("UPDATE tb_trabalho_realizado set nm_liberado_ong = '' where cd_trabalho_realizado = '$codigo'  ");
    }

    echo "<meta charset='utf-8'> <script>alert('Certificado Bloqueado'); window.location = 'visualizar-vagas.php?visualizarVaga=$cd_vaga';</script>";
}
?>