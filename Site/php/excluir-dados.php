<?php
session_start();
include "conecta_banco.php";

//excluindo ong
if (isset($_GET["id_ong"])) {
    $id_ong = $_GET["id_ong"];
    
    $deletar1 = $con->query("DELETE FROM tb_registro_vaga where cd_vaga = (SELECT cd_vaga from tb_vaga where cd_ong = '$id_ong')");
    $deletar = $con->query("DELETE FROM tb_confirmacao_evento where cd_evento = (SELECT cd_evento from tb_evento where cd_ong = '$id_ong')");
    $deletar1 = $con->query("DELETE FROM tb_contato where cd_ong = '$id_ong'");
    $deletar2 = $con->query("DELETE FROM tb_rede_social where cd_ong = '$id_ong'");
    $deletar2 = $con->query("DELETE FROM tb_vaga where cd_ong = '$id_ong'");
    $deletar2 = $con->query("DELETE FROM tb_evento where cd_ong = '$id_ong'");
    $deletar = $con->query("DELETE FROM tb_ong where cd_ong = '$id_ong'");
    unset($_SESSION['id_ong']);

    echo "<script>alert('ONG excluída com sucesso'); window.location.href = 'minhas-ongs2.php';</script>";
}
 //Excluindo Voluntario
 if(isset($_GET["id_voluntario"])){
  $cd_voluntario = $_GET["id_voluntario"];
 
  $deletar = $con->query("DELETE FROM tb_registro_vaga where cd_voluntario = '$cd_voluntario'");
  $deletar = $con->query("DELETE FROM tb_contato where cd_voluntario = '$cd_voluntario'");
  $deletar = $con->query("DELETE FROM tb_confirmacao_evento where cd_voluntario = '$cd_voluntario'");
  $deletar = $con->query("DELETE FROM tb_rede_social where cd_voluntario = '$cd_voluntario'");
  $deletar1 = $con->query("DELETE FROM tb_contato where cd_ong = (SELECT cd_ong from tb_ong where cd_voluntario = '$cd_voluntario')");
  $deletar2 = $con->query("DELETE FROM tb_rede_social where cd_ong = (SELECT cd_ong from tb_ong where cd_voluntario = '$cd_voluntario')");
  $deletar = $con->query("DELETE FROM tb_ong where cd_voluntario = '$cd_voluntario'");
  $deletar = $con->query("DELETE FROM tb_voluntario where cd_voluntario = '$cd_voluntario'");
 
  echo "<script>alert('Conta excluída com sucesso'); window.location.href = 'index.php';</script>";
  }

    //Excluindo evento
    if(isset($_GET["excluirEvento"])){
    $cd_evento = $_GET["excluirEvento"];
   
    $deletar = $con->query("DELETE FROM tb_confirmacao_evento where cd_evento = '$cd_evento'");
    $deletar = $con->query("DELETE FROM tb_evento where cd_evento = '$cd_evento'");

    echo "<script>alert('Evento excluído com sucesso'); window.location.href = 'minhas-publicacoes.php';</script>";
                
    }

      //Excluindo vaga
      if(isset($_GET["excluirVaga"])){
        $cd_vaga = $_GET["excluirVaga"];
       
        $deletar = $con->query("DELETE FROM tb_registro_vaga where cd_vaga = '$cd_vaga'");
        $deletar = $con->query("DELETE FROM tb_vaga where cd_vaga = '$cd_vaga'");
    
        echo "<script>alert('Vaga excluída com sucesso'); window.location.href = 'minhas-publicacoes.php';</script>";
                    
        }
?>