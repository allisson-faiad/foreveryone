<?php
session_start();
include('conecta_banco.php');


$cd_voluntario = $_SESSION["id"];
$email_voluntario = $_SESSION["email"];
/**
 * Verificando se existe alguma sessão ativa
 */
if ($email_voluntario == null) {
    echo "<script>alert('Login não efetuado');window.location.href='login.php';</script>";
}


$id = $_GET["visualizarONG"];

$select = $con->query("SELECT * from tb_ong where cd_ong ='$id'");
$dados = $select->fetch_array();
$nome = $dados["nm_ong"];
$email = $dados["nm_email_ong"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meu Perfil</title>
    <!--IMPORTANDO ARQUIVOS-->
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" type="text/css" href="bibliotecas/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\css\bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" media="screen" href="..\bibliotecas\bootstrap\js\bootstrap.js">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--Importando os icones-->

    <link rel="stylesheet" type="text/css" href="../css/meu-perfil.css">
    <link rel="stylesheet" type="text/css" href="../css/geral.css">
    <script type="text/javascript" src="../js/jquery/jquery.min.js"></script>

</head>

<body>

    <?php
    if (isset($_SESSION["id_ong"]) == false)
        include "../php/elementos/menu-lateral.php";
    else
        include "../php/elementos/menu-lateral-ong.php";
    ?>
    <form action="alterar-dados-voluntario-ong.php" name="form" method="post" id="formulario" enctype="multipart/form-data">
        <div id="conteudo"><br><br>
            <div class="header-conteudo">
                <div style="position: relative;
    align-items: center;
    width: 130px;
    height: 130px;
    border-radius: 100px;
    display:grid;">
                    <img style="width: 130px;
    height: 130px;
    border-radius: 100px;
    position: absolute;
    object-fit: cover;" src="<?php

                                $select = $con->query("SELECT * from tb_ong where cd_ong = '$id'");
                                $dados = $select->fetch_array();
                                $imagem = $dados["im_ong"];
                                echo $imagem;
                                ?>" alt="IMG" >
                        <script>
                        $("#foto").change(function(){
   if($(this).val()){ // só se o input não estiver vazio
      var img = this.files[0]; // seleciona o arquivo do input
      var f = new FileReader(); // cria o objeto FileReader
      f.onload = function(e){ // ao carregar a imagem
         $(".logotipo-2").attr("src",e.target.result); // altera o src da imagem
      }
      f.readAsDataURL(img); // lê o arquivo
   }
});
                        </script>

                </div>

                <?php $select_causa = $con->query("SELECT nm_causa from tb_causa where cd_causa = (SELECT cd_causa from tb_ong where cd_ong = '$id') ");
                                                            
                                                            $linhas = $select_causa->fetch_array();
                                                            $causa = $linhas["nm_causa"]; ?>
                <div class="lado-logo">
                    <?php
                    echo "  <h3>$nome </h3>
        <h3 style='font-size:12px;'>Causa: $causa</h3>";

                    ?>
                </div>
            </div>
            <hr>
            <div class="informacoes row">
                <div class="bloco bloco-1 col-xl-6 col-md-12">
                    <h6>Dados do Perfil</h6>
                    <hr>
                    <div class="p-input">
                        <p>Nome da ONG</p>
                        <input readonly type="text" name="nome" value="<?php echo $nome; ?>" >

                        <p>E-Mail</p>
                        <input readonly type="text" value="<?php echo $email; ?>" disabled>
                        <!-- <p>CNPJ</p>
                        <?php
                        $select = $con->query("SELECT cd_cnpj_ong from tb_ong where cd_ong = '$id'");
                        $linhas = $select->fetch_array();
                        $cnpj = $linhas["cd_cnpj_ong"];
                        if (!isset($cnpj)) {
                            echo "<input readonly type='text' name='cnpj'  maxlength='15' minlength='15' id='cnpj' placeholder='472.384.394-92'  >";
                        } else {
                            echo "<input readonly type='text' name='cnpj'  maxlength='15' minlength='15' id='cnpj' placeholder='$cnpj' disabled >";
                        }
                        ?> -->

                        <p>Telefone Fixo</p>
                        <input readonly type="text" name="tel_fixo" minlength="14" maxlength="15" id="telefone_fixo" placeholder="(13) 3461-6030" value="<?php
                            $query = $con->query("SELECT cd_contato from tb_contato where cd_ong='$id' and cd_tipo_contato = 1");
                            $result = $query->fetch_array();
                            $cd_contato = $result["cd_contato"];



                            echo $cd_contato; ?>">

                       
                        <p>Causa da ONG*</p>
                        <select disabled name="causas" id="causas" <?php $select_causa = $con->query("SELECT nm_causa from tb_causa where cd_causa = (SELECT cd_causa from tb_ong where cd_ong = '$id') ");
                                                            if (mysqli_num_rows($select_causa) == 0) 
                                                            echo ""?>>
                            <?php  
                            if (mysqli_num_rows($select_causa) == 0) {
                                echo "<option selected value='Nenhuma' readonly> Nenhuma</option>";
                            }
                            else{
                            $linhas = $select_causa->fetch_array();
                            $causa = $linhas["nm_causa"]; 
                            echo "<option selected value='$causa' readonly>$causa</option>";

                            }
                            $select = $con->query("SELECT nm_causa from tb_causa order by nm_causa");
                            foreach ($select as $c) {
                                $causa = $c["nm_causa"];
                                echo "<option value='$causa'>$causa</option>";
                            }
                            ?>
                        </select>
                        <p>Sobre a ONG</p>
                        <input readonly type="text" value="<?php
                                                    $query = $con->query("SELECT ds_ong from tb_ong where cd_ong='$id'");
                                                    $result = $query->fetch_array();
                                                    $descricao = $result["ds_ong"];



                                                    echo $descricao; ?>" name="sobre">
                    </div>
                </div>
                <div class="bloco bloco-2 col-xl-6 col-md-12">
                    <h6>Redes Sociais</h6>
                    <hr>
                    <div class="redes-sociais">
                        <i style="color:blue" class="fa fa-facebook-square fa-2x"></i>
                        <input readonly type="text" name="facebook" value="<?php
                                                                                    $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_ong='$id' and cd_tipo_rede_social = 1;");
                                                                                    $result = $query->fetch_assoc();
                                                                                    $nm_rede_social = $result["nm_rede_social"];


                                                                                    echo $nm_rede_social; ?>">

                    </div>

                    <div class="redes-sociais">
                        <i style="color:#ff0076" class="fa fa-instagram fa-2x"></i>
                        <input readonly type="text" name="instagram" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_ong='$id' and cd_tipo_rede_social = 2");
                                                                                                $result = $query->fetch_array();
                                                                                                $nm_rede_social = $result["nm_rede_social"];



                                                                                                echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i style="color:#0697bc" class="fa fa-twitter-square fa-2x"></i>
                        <input readonly type="text" name="twitter" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_ong='$id' and cd_tipo_rede_social = 5");
                                                                                                $result = $query->fetch_array();
                                                                                                $nm_rede_social = $result["nm_rede_social"];



                                                                                                echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i style="color:green" class="fa fa-whatsapp fa-2x"></i>
                        <input readonly type="text" name="whatsapp" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_ong='$id' and cd_tipo_rede_social = 3");
                                                                                                $result = $query->fetch_array();
                                                                                                $nm_rede_social = $result["nm_rede_social"];



                                                                                                echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i class="fa fa-chrome fa-2x"></i>
                        <input readonly type="text" name="site" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_ong='$id' and cd_tipo_rede_social = 4");
                                                                                                $result = $query->fetch_array();
                                                                                                $nm_rede_social = $result["nm_rede_social"];



                                                                                                echo $nm_rede_social; ?>">
                    </div>
                </div>
            </div>
            <div class="informacoes-2 row">
                <div class="bloco bloco-3 col-xl-6 col-md-12">

                    <?php

                    // PEGANDO TODO ENDEREÇO DO ong

                    $select = $con->query("SELECT tb_logradouro.nm_logradouro, tb_logradouro.cd_cep, tb_bairro.nm_bairro, tb_cidade.nm_cidade,tb_uf.sg_uf, tb_ong.nm_numero
                    from tb_uf inner join tb_cidade
                    on tb_uf.cd_uf = tb_cidade.cd_uf
                    inner join tb_bairro
                    on tb_cidade.cd_cidade = tb_bairro.cd_cidade
                    inner join tb_logradouro
                    on tb_bairro.cd_bairro = tb_logradouro.cd_bairro
                    inner join tb_ong
                    on tb_logradouro.cd_logradouro = tb_ong.cd_logradouro
                    WHERE cd_ong = '$id'");

                    $linhas = $select->fetch_array();

                    $numero = $linhas['nm_numero'];
                    $logradouro = $linhas['nm_logradouro'];
                    $cep = $linhas['cd_cep'];
                    $bairro = $linhas['nm_bairro'];
                    $cidade = $linhas['nm_cidade'];
                    $uf = $linhas['sg_uf'];
                    ?>
                    <h6>Endereço</h6>
                    <hr>
                    <div class="p-input">
                        <p>Logradouro*</p>
                        <input type="text" id="cadastro-logradouro" name="logradouro"  value="<?php echo $logradouro ?>" readonly>
                        <p>Número*</p>
                        <input type="text" id="cadastro-numero" name="numero"  value="<?php echo $numero ?>" readonly>
                        <p>CEP*</p>
                        <input type="text" id="cadastro-cep" name="cep" maxlength="8"  value="<?php echo $cep ?>" readonly>
                        <p>Bairro*</p>
                        <input type="text" id="cadastro-bairro" name="bairro"  value="<?php echo $bairro ?>" readonly>
                        <p>Cidade*</p>
                        <input type="text" id="cadastro-cidade" name="cidade"  value="<?php echo $cidade ?>" readonly>
                        <p>UF*</p>
                        <input type="text" id="cadastro-uf" name="uf"  value="<?php echo $uf ?>" readonly>
                    </div>
                </div>
                <div class="bloco bloco-4 col-xl-6 col-md-12">
                    
                </div>
            </div>
        </div>
        <!--===============================================================================================-->
    </form>
    <div style="height:600px;width:100px;background:white;margin:50px;"></div>
    <script type="text/javascript" src="../js/jquery/jquery-mask/src/jquery.mask.js"></script>
    <script type="text/javascript" src="../js/jquery/jquery-validation-master/lib/jquery.form.js"> </script>
    <script type="text/javascript" src="../js/jquery/jquery-validation/dist/jquery.validate.js"> </script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../js/endereco.js"></script>
    <script type="text/javascript" src="../js/cadastro2.js"></script>
    <script src="../js/meu-perfil.js"></script>
</body>

</html>