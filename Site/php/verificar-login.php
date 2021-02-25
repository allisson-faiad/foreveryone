<?php
include('conecta_banco.php');



if(empty($_POST['email']) || empty($_POST['senha'])) 
{
    echo "<meta charset='utf-8'> <script>alert('Email ou senha não está preenchido');window.location.href='login.php';</script>";
}
else
{
$email = mysqli_real_escape_string($con, $_POST['email']);
$senha = mysqli_real_escape_string($con, $_POST['senha']);


$verifica = $con->query("SELECT * from tb_voluntario where nm_email_voluntario = '$email' and nm_senha_voluntario = '$senha'");
$verifica2 = $con->query("SELECT * from tb_voluntario where nm_usuario_voluntario = '$email' and nm_senha_voluntario = '$senha'");

if(mysqli_num_rows($verifica) > 0)
{
    while($dados = $verifica->fetch_array())
    {
        session_start();
        $nome_ = $dados["nm_voluntario"];
        $nome_usuario = $dados["nm_usuario_voluntario"];
        $email_ = $dados["nm_email_voluntario"];
        $id = $dados["cd_voluntario"];
        
        $_SESSION["nome"] = $nome_;
        $_SESSION["email"] = $email_;
        $_SESSION["nome_usuario"] = $nome_usuario;
        $_SESSION["id"] = $id;

        header("location: tela-inicial-voluntario.php");
    }
}
elseif(mysqli_num_rows($verifica2) > 0){
    while($dados = $verifica2->fetch_array())
    {
        session_start();
        $nome_ = $dados["nm_voluntario"];
        $nome_usuario = $dados["nm_usuario_voluntario"];
        $email_ = $dados["nm_email_voluntario"];
        $id = $dados["cd_voluntario"];
        
        $_SESSION["nome"] = $nome_;
        $_SESSION["email"] = $email_;
        $_SESSION["nome_usuario"] = $nome_usuario;
        $_SESSION["id"] = $id;

        header("location: tela-inicial-voluntario.php");
    }
}
else
{
    echo "<script> alert('Email ou Senha incorreto!');window.location.href='login.php';</script>";
}

}

?>