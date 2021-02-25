<?php
session_start();
include('conecta_banco.php');


if (isset($_SESSION['id_ong']) == false) {
    echo "<script>alert('Sessão da ONG não iniciada');window.location.href='minhas-ongs2.php';</script>";
} else {
    $id_ong = $_SESSION["id_ong"];
}

$id = $_GET["visualizarVoluntario"];


$query = $con->query("SELECT * FROM tb_voluntario where cd_voluntario = '$id'");
$result = $query->fetch_array();
$data = $result['dt_nascimento_voluntario'];

$nome = $result["nm_voluntario"];
$nome_usuario = $result["nm_usuario_voluntario"];
$email = $result["nm_email_voluntario"];
/**
 * Verificando se existe alguma sessão ativa
 */


?>
<!DOCTYPE html>
<html lang="pt-br">

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

<body class="container-fluid">
    <?php include "../php/elementos/menu-lateral-ong.php"; ?>
    <form action="alterar-dados-voluntario.php" name="form" method="post" enctype="multipart/form-data">
        <div id="conteudo"><br>
            <hr>
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

                                $select = $con->query("SELECT * from tb_voluntario where cd_voluntario = '$id'");
                                $dados = $select->fetch_array();
                                $imagem = $dados["im_voluntario"];
                                echo $imagem;
                                ?>" alt="IMG" class="logotipo-2">
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
                <div class="lado-logo">
                    <?php
                    $idade = date('Y') - substr($data, 0, 4);

                    echo "  <h3>$nome_usuario </h3>
        <h3>$idade anos</h6>";

                    ?>
                </div>
            </div>
            <hr>
            <div class="informacoes row">
                <div class="bloco bloco-1 col-xl-6 col-md-12">
                    <h6>Dados do Perfil</h6>
                    <hr>
                    <div class="p-input">
                        <p>Nome do Usuário</p>
                        <input  readonly type="text" name="nome_usuario" minlength="9" maxlength="35" id="nome_usuario" value="<?php echo $nome_usuario; ?>" required>
                    </div>
                    <div class="p-input">
                    <p>Nome Completo</p>
                <input  readonly type="text" name="nome" minlength="10" maxlength="70" id="nome" value="<?php echo $nome;   ?>"required>
                    </div>
                    <div class="p-input">
                        <p>E-Mail</p>
                        <input  readonly type="text" id="" value="<?php echo $email; ?>">
                    </div>
                    <div class="p-input">
                        <p>CPF</p>
                        <?php
                        $select = $con->query("SELECT cd_cpf_voluntario from tb_voluntario where cd_voluntario = '$id'");
                        $linhas = $select->fetch_array();
                        $cpf = $linhas["cd_cpf_voluntario"];
                        if (!isset($cpf)) {
                            echo "<input  readonly type='text' name='cpf'  maxlength='15' minlength='15' id='cpf'   >";
                        } else {
                            echo "<input  readonly type='text' name='cpf'  maxlength='15' minlength='15' id='cpf' placeholder='$cpf' >";
                        }
                        ?>
                    </div>
                    <div class="p-input">
                        <p>Telefone Fixo</p>
                        <input  readonly type="text" name="tel_fixo" minlength="14" maxlength="15" id="telefone_fixo"  value="<?php
                                                                                                                                                $query = $con->query("SELECT cd_contato from tb_contato where cd_voluntario='$id'and cd_tipo_contato = 1");
                                                                                                                                                $result = $query->fetch_array();
                                                                                                                                                $cd_contato = $result["cd_contato"];



                                                                                                                                                echo $cd_contato; ?>">
                    </div>
                    <div class="p-input">
                        <p>Telefone Celular</p>
                        <input  readonly type="text" name="tel_celular" minlength="15" maxlength="15" id="telefone_celular"  value="<?php
                                                                                                                                                        $query = $con->query("SELECT cd_contato from tb_contato where cd_voluntario='$id'and cd_tipo_contato = 2");
                                                                                                                                                        $result = $query->fetch_array();
                                                                                                                                                        $cd_contato = $result["cd_contato"];



                                                                                                                                                        echo $cd_contato; ?>">
                    </div>
                    <div class="p-input">
                        <p>Data de Nascimento</p>
                        <div class="data">
                            <input  readonly type="number" name="dia" value="<?php echo substr($data, 8, 2); ?>" >
                            <input  readonly type="number" name="mes" value="<?php echo substr($data, 5, 2); ?>" >
                            <input  readonly type="number" name="ano" value="<?php echo substr($data, 0, 4); ?>" >
                        </div>
                    </div>
                    <div class="p-input">
                        <p>Sobre Mim</p>
                        <input  readonly type="text" value="<?php
                                                    $query = $con->query("SELECT * from tb_voluntario where cd_voluntario='$id'");
                                                    $result = $query->fetch_array();
                                                    $descricao = $result["ds_voluntario"];



                                                    echo $descricao; ?>" name="sobre">
                    </div>
                    <div class="p-input">
                        <p>Habilidade</p>
                        <select readonly name="habilidade" id="habilidade" <?php
                        $cd_habilidade = $result["cd_habilidade"];
                        $select_habilidade = $con->query("SELECT nm_habilidade from tb_habilidade where cd_habilidade = (SELECT cd_habilidade from tb_voluntario where cd_voluntario = '$id' and  cd_habilidade = '$cd_habilidade') ");?>>
                            <?php  
                            if (mysqli_num_rows($select_habilidade) == 0) {
                                echo "<option selected value='Nenhuma' readonly> Nenhuma</option>";
                            }
                            else{
                            $linhas = $select_habilidade->fetch_array();
                            $habilidade = $linhas["nm_habilidade"]; 
                            echo "<option selected value='$habilidade' readonly>$habilidade</option>";

                            }
                           
                            ?>
                        </select>
                    </div>
                    <div class="p-input">
                        <p>Formacao</p>
                        <select name="formacao" id="formacao" <?php
                        $cd_formacao = $result["cd_formacao"];
                        $select_formacao = $con->query("SELECT nm_formacao from tb_formacao where cd_formacao = (SELECT cd_formacao from tb_voluntario where cd_voluntario = '$id' and cd_formacao = '$cd_formacao') ");?>>
                            <?php  
                            if (mysqli_num_rows($select_formacao) == 0) {
                                echo "<option selected value='Nenhuma' readonly> Nenhuma</option>";
                            }
                            else{
                            $linhas = $select_formacao->fetch_array();
                            $formacao = $linhas["nm_formacao"]; 
                            echo "<option selected value='$formacao' readonly>$formacao</option>";

                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="bloco bloco-2 col-xl-6 col-md-12">
                    <h6>Redes Sociais</h6>
                    <hr>
                    <div class="redes-sociais">
                        <i style="color:blue" class="fa fa-facebook-square fa-2x"></i>
                        <input  readonly type="text" name="facebook" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 1;");
                                                                                                $result = $query->fetch_assoc();
                                                                                                $nm_rede_social = $result["nm_rede_social"];


                                                                                                echo $nm_rede_social; ?>">

                    </div>

                    <div class="redes-sociais">
                        <i style="color:#ff0076" class="fa fa-instagram fa-2x"></i>
                        <input  readonly type="text" name="instagram"  value="<?php
                                                                                            $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 2");
                                                                                            $result = $query->fetch_array();
                                                                                            $nm_rede_social = $result["nm_rede_social"];



                                                                                            echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i  style="color:#0697bc" class="fa fa-twitter-square fa-2x"></i>
                        <input  readonly type="text" name="twitter" value="<?php
                                                                                            $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 5");
                                                                                            $result = $query->fetch_array();
                                                                                            $nm_rede_social = $result["nm_rede_social"];



                                                                                            echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i style="color:green" class="fa fa-whatsapp fa-2x"></i>
                        <input  readonly type="text" name="whatsapp" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 3");
                                                                                                $result = $query->fetch_array();
                                                                                                $nm_rede_social = $result["nm_rede_social"];



                                                                                                echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i class="fa fa-chrome fa-2x"></i>
                        <input  readonly type="text" name="site" value="<?php
                                                                                            $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 4");
                                                                                            $result = $query->fetch_array();
                                                                                            $nm_rede_social = $result["nm_rede_social"];



                                                                                            echo $nm_rede_social; ?>">
                    </div>

                </div>
            </div>
            <div class="informacoes-2 row">
                <div class="bloco bloco-3 col-xl-6 col-md-12">

                    <?php

                    // PEGANDO TODO ENDEREÇO DO VOLUNTARIO

                    $select = $con->query("SELECT tb_logradouro.nm_logradouro, tb_logradouro.cd_cep, tb_bairro.nm_bairro, tb_cidade.nm_cidade,tb_uf.sg_uf, tb_voluntario.nm_numero
            from tb_uf inner join tb_cidade
            on tb_uf.cd_uf = tb_cidade.cd_uf
            inner join tb_bairro
            on tb_cidade.cd_cidade = tb_bairro.cd_cidade
            inner join tb_logradouro
            on tb_bairro.cd_bairro = tb_logradouro.cd_bairro
            inner join tb_voluntario
            on tb_logradouro.cd_logradouro = tb_voluntario.cd_logradouro
            WHERE cd_voluntario = '$id'");

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
                        <input  readonly type="text" id="cadastro-logradouro" name="logradouro" required value="<?php echo $logradouro ?>" readonly>
                    </div>
                    <div class="p-input">
                        <p>Número*</p>
                        <input  readonly type="text"  id="cadastro-numero" name="numero" required value="<?php echo $numero ?>">
                    </div>
                    <div class="p-input">
                        <p>CEP*</p>
                        <input  readonly type="text"  id="cadastro-cep" name="cep" maxlength="8" required value="<?php echo $cep ?>">
                    </div>
                    <div class="p-input">
                        <p>Bairro*</p>
                        <input  readonly type="text" id="cadastro-bairro" name="bairro" required value="<?php echo $bairro ?>" readonly>
                    </div>
                    <div class="p-input">
                        <p>Cidade*</p>
                        <input  readonly type="text" id="cadastro-cidade" name="cidade" required value="<?php echo $cidade ?>" readonly>
                    </div>
                    <div class="p-input">
                        <p>UF*</p>
                        <input  readonly type="text" id="cadastro-uf" name="uf" required value="<?php echo $uf ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin:20px;"></div>
        <!--===============================================================================================-->
    </form>
    

                                



    <script language="JavaScript" type="text/javascript" src="../js/geral.js"></script>

    <script type="text/javascript" src="../js/jquery/jquery-mask/src/jquery.mask.js"></script>
    <script type="text/javascript" src="../js/jquery/jquery-validation-master/lib/jquery.form.js"> </script>
    <script type="text/javascript" src="../js/jquery/jquery-validation/dist/jquery.validate.js"> </script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../js/endereco.js"></script>
    <script type="text/javascript" src="../js/cadastro2.js"></script>
    <script src="../js/meu-perfil.js"></script>
</body>

</html>