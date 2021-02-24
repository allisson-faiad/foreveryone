<?php
session_start();
include('conecta_banco.php');


if (isset($_SESSION['id_ong']) == true) {
    echo "<script>alert('Para acessar sua conta de usuário, termine a sessão como ONG');window.location.href='tela-inicial-ong.php';</script>";
}


$nome = $_SESSION["nome"];
$nome_usuario = $_SESSION["nome_usuario"];
$email = $_SESSION["email"];
$id = $_SESSION["id"];

$query = $con->query("SELECT dt_nascimento_voluntario FROM tb_voluntario where cd_voluntario = '$id'");
$result = $query->fetch_array();
$data = $result['dt_nascimento_voluntario'];

/**
 * Verificando se existe alguma sessão ativa
 */
if ($email == null) {

    echo "<script>alert('Login não efetuado');window.location.href='login.php';</script>";
}

//Verificando se o trabalho ja foi concluido
$select1 = $con->query("SELECT dt_fim,hr_fim,cd_vaga from tb_vaga");
foreach ($select1 as $vagas) {
    $dt_fim = $vagas["dt_fim"];
    $hr_fim = $vagas["hr_fim"];
    $cd_vaga = $vagas["cd_vaga"];

    $dt_now = date("Y-m-d");
    $hr_now = date("H:i");



    if ($dt_now >= $dt_fim) {
        $select2 = $con->query("SELECT tb_vaga.*,tb_voluntario.*,tb_ong.nm_ong from tb_vaga inner join tb_registro_vaga
    on tb_vaga.cd_vaga = tb_registro_vaga.cd_vaga
    inner join tb_voluntario
    on tb_voluntario.cd_voluntario = tb_registro_vaga.cd_voluntario
    inner join tb_ong
    on tb_ong.cd_ong = tb_vaga.cd_ong
    where tb_vaga.cd_vaga = '$cd_vaga'");

        foreach ($select2 as $a) {
            $nm_trabalho = $a["nm_vaga"];
            $ds_trabalho = $a["ds_vaga"];
            $carga_horaria = $a["hr_carga_horaria"];
            $nm_ong = $a["nm_ong"];
            $dt_inicio = $a["dt_inicio"];
            $dt_fim = $a["dt_fim"];
            $cd_voluntario = $a["cd_voluntario"];

            $select = $con->query("SELECT * from tb_trabalho_realizado where nm_trabalho_realizado = '$nm_trabalho' and cd_voluntario = '$cd_voluntario' ");

            if (mysqli_num_rows($select) <=0) {
                $insert = $con->query("INSERT INTO tb_trabalho_realizado (nm_trabalho_realizado,ds_trabalho_realizado,hr_carga_trabalho_realizado,nm_ong,dt_inicio_trabalho,dt_fim_trabalho,cd_voluntario) Values ('$nm_trabalho','$ds_trabalho','$carga_horaria','$nm_ong','$dt_inicio','$dt_fim','$cd_voluntario')");
            }
        }
    }
}
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

<body class="container-fluid">
    <?php include "../php/elementos/menu-lateral.php"; ?>
    <?php include "../php/elementos/pesquisa.php"; ?>
    <form action="alterar-dados-voluntario.php" name="form" method="post" enctype="multipart/form-data">
        <div id="conteudo"><br>
            <hr>
            <div class="header-conteudo">
                <div class="logo-2">
                    <img src="<?php

                                $select = $con->query("SELECT * from tb_voluntario where cd_voluntario = '$id'");
                                $dados = $select->fetch_array();
                                $imagem = $dados["im_voluntario"];
                                echo $imagem;
                                ?>" alt="IMG" class="logotipo-2">
                    <i class="fa fa-camera camera " type="file" for="foto"><input type="file" name="arquivo" id="foto"></i>
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
                        <input type="text" name="nome_usuario" minlength="9" maxlength="35" id="nome_usuario" value="<?php echo $nome_usuario; ?>" required>
                    </div>
                    <div class="p-input">
                    <p>Nome Completo</p>
                <input type="text" name="nome" minlength="10" maxlength="70" id="nome" value="<?php echo $nome;   ?>"required>
                    </div>
                    <div class="p-input">
                        <p>E-Mail</p>
                        <input type="text" id="" value="<?php echo $email; ?>" disabled>
                    </div>
                    <div class="p-input">
                        <p>CPF</p>
                        <?php
                        $select = $con->query("SELECT cd_cpf_voluntario from tb_voluntario where cd_voluntario = '$id'");
                        $linhas = $select->fetch_array();
                        $cpf = $linhas["cd_cpf_voluntario"];
                        if (!isset($cpf)) {
                            echo "<input type='text' name='cpf'  maxlength='15' minlength='15' id='cpf' placeholder='472.384.394-92'  >";
                        } else {
                            echo "<input type='text' name='cpf'  maxlength='15' minlength='15' id='cpf' placeholder='$cpf' disabled >";
                        }
                        ?>
                    </div>
                    <div class="p-input">
                        <p>Telefone Fixo</p>
                        <input type="text" name="tel_fixo" minlength="14" maxlength="15" id="telefone_fixo" placeholder="(13) 3461-6030" value="<?php
                                                                                                                                                $query = $con->query("SELECT cd_contato from tb_contato where cd_voluntario='$id'and cd_tipo_contato = 1");
                                                                                                                                                $result = $query->fetch_array();
                                                                                                                                                $cd_contato = $result["cd_contato"];



                                                                                                                                                echo $cd_contato; ?>">
                    </div>
                    <div class="p-input">
                        <p>Telefone Celular</p>
                        <input type="text" name="tel_celular" minlength="15" maxlength="15" id="telefone_celular" placeholder="(13) 99624-2235" value="<?php
                                                                                                                                                        $query = $con->query("SELECT cd_contato from tb_contato where cd_voluntario='$id'and cd_tipo_contato = 2");
                                                                                                                                                        $result = $query->fetch_array();
                                                                                                                                                        $cd_contato = $result["cd_contato"];



                                                                                                                                                        echo $cd_contato; ?>">
                    </div>
                    <div class="p-input">
                        <p>Data de Nascimento</p>
                        <div class="data">
                            <input type="number" name="dia" value="<?php echo substr($data, 8, 2); ?>" disabled>
                            <input type="number" name="mes" value="<?php echo substr($data, 5, 2); ?>" disabled>
                            <input type="number" name="ano" value="<?php echo substr($data, 0, 4); ?>" disabled>
                        </div>
                    </div>
                    <div class="p-input">
                        <p>Sobre Mim</p>
                        <input type="text" value="<?php
                                                    $query = $con->query("SELECT * from tb_voluntario where cd_voluntario='$id'");
                                                    $result = $query->fetch_array();
                                                    $descricao = $result["ds_voluntario"];



                                                    echo $descricao; ?>" name="sobre">
                    </div>
                    <div class="p-input">
                        <p>Habilidade</p>
                        <select name="habilidade" id="habilidade" <?php
                        $cd_habilidade = $result["cd_habilidade"];
                        $select_habilidade = $con->query("SELECT nm_habilidade from tb_habilidade where cd_habilidade = (SELECT cd_habilidade from tb_voluntario where cd_voluntario = '$id' and  cd_habilidade = '$cd_habilidade') ");?>>
                            <?php  
                            if (mysqli_num_rows($select_habilidade) == 0) {
                                echo "<option selected value='Selecione uma Habilidade' readonly> Selecione uma Habilidade</option>";
                            }
                            else{
                            $linhas = $select_habilidade->fetch_array();
                            $habilidade = $linhas["nm_habilidade"]; 
                            echo "<option selected value='$habilidade' readonly>$habilidade</option>";

                            }
                            $select = $con->query("SELECT nm_habilidade from tb_habilidade order by nm_habilidade");
                            foreach ($select as $c) {
                                $habilidade = $c["nm_habilidade"];
                                echo "<option value='$habilidade'>$habilidade</option>";
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
                                echo "<option selected value='Selecione uma Formacao' readonly> Selecione uma Formacao</option>";
                            }
                            else{
                            $linhas = $select_formacao->fetch_array();
                            $formacao = $linhas["nm_formacao"]; 
                            echo "<option selected value='$formacao' readonly>$formacao</option>";

                            }
                            $select = $con->query("SELECT nm_formacao from tb_formacao order by nm_formacao");
                            foreach ($select as $c) {
                                $formacao = $c["nm_formacao"];
                                echo "<option value='$formacao'>$formacao</option>";
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
                        <input type="text" name="facebook" placeholder="Allisson Faiad" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 1;");
                                                                                                $result = $query->fetch_assoc();
                                                                                                $nm_rede_social = $result["nm_rede_social"];


                                                                                                echo $nm_rede_social; ?>">

                    </div>

                    <div class="redes-sociais">
                        <i style="color:#ff0076" class="fa fa-instagram fa-2x"></i>
                        <input type="text" name="instagram" placeholder="wtf_f4i4d" value="<?php
                                                                                            $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 2");
                                                                                            $result = $query->fetch_array();
                                                                                            $nm_rede_social = $result["nm_rede_social"];



                                                                                            echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i style="color:#0697bc" class="fa fa-twitter-square fa-2x"></i>
                        <input type="text" name="twitter" placeholder="wtf_f4i4d" value="<?php
                                                                                            $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 5");
                                                                                            $result = $query->fetch_array();
                                                                                            $nm_rede_social = $result["nm_rede_social"];



                                                                                            echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i style="color:green" class="fa fa-whatsapp fa-2x"></i>
                        <input type="text" name="whatsapp" placeholder="(13) 99524-2236" value="<?php
                                                                                                $query = $con->query("SELECT tb_rede_social.nm_rede_social from tb_rede_social where tb_rede_social.cd_voluntario='$id' and cd_tipo_rede_social = 3");
                                                                                                $result = $query->fetch_array();
                                                                                                $nm_rede_social = $result["nm_rede_social"];



                                                                                                echo $nm_rede_social; ?>">
                    </div>

                    <div class="redes-sociais">
                        <i class="fa fa-chrome fa-2x"></i>
                        <input type="text" name="site" placeholder="www.meusite.com" value="<?php
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
                        <p>CEP*</p>
                        <input type="text" placeholder="CEP" id="cadastro-cep" name="cep" maxlength="8" required value="<?php echo $cep ?>">
                    </div>
                    <div class="p-input">
                        <p>Número*</p>
                        <input type="text" placeholder="Número" id="cadastro-numero" name="numero" required value="<?php echo $numero ?>">
                    </div>
                    <div class="p-input">
                        <p>Logradouro*</p>
                        <input type="text" placeholder="Logradouro" id="cadastro-logradouro" name="logradouro" required value="<?php echo $logradouro ?>" readonly>
                    </div>
                    <div class="p-input">
                        <p>Bairro*</p>
                        <input type="text" placeholder="Bairro" id="cadastro-bairro" name="bairro" required value="<?php echo $bairro ?>" readonly>
                    </div>
                    <div class="p-input">
                        <p>Cidade*</p>
                        <input type="text" placeholder="Cidade" id="cadastro-cidade" name="cidade" required value="<?php echo $cidade ?>" readonly>
                    </div>
                    <div class="p-input">
                        <p>UF*</p>
                        <input type="text" placeholder="UF" id="cadastro-uf" name="uf" required value="<?php echo $uf ?>" readonly>
                    </div>
                </div>
                <div class="bloco bloco-4 col-xl-6 col-md-12">
                    <h6>Funções</h6>
                    <hr>
                    <div class="b4-dentro">
                        
                        <div class="mais">
                           
                            
                            <button type="submit" class="btn btn-success">Confirmar Alteração</button>
                            <a href="excluir-dados.php?id_voluntario=<?php echo $id?>" onclick='return confirm("Esteja ciente de que ao apagar, consequentemente todas suas ONGS cadastradas serão excluídas e seus eventos e vagas também.\nVocê tem certeza de que deseja apagar esta conta? ")'>Excluir Conta</a><br>


                            <!-- <a href="">Alterar senha</a>
                            <a href="">Excluir conta</a> --> <br><br><br><br>
                        </div>
                       
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