<?php
session_start();
include('conecta_banco.php');

if (isset($_SESSION['id_ong']) == true) {
    echo "<script>alert('Para acessar sua conta de usuário, termine a sessão como ONG');window.location.href='tela-inicial-ong.php';</script>";
}

$nome = $_SESSION["nome"];
$email = $_SESSION["email"];
/**
 * Verificando se existe alguma sessão ativa
 */
if ($email == null) {

    echo "<script>alert('Login não efetuado');window.location.href='login.php';</script>";
}

$select = $con->query("SELECT * from tb_ong where cd_voluntario = (SELECT cd_voluntario from tb_voluntario where nm_email_voluntario = '$email')");
if(mysqli_num_rows($select) >= 3){
    echo "<script type='text/javascript'>alert('Sinto muito, mas você não pode ter mais que 3 ONG`S');window.location.href='minhas-ongs2.php';</script>";
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

    <script type="text/javascript" src="../js/jquery/jquery.min.js"></script>


    <!--Importando os icones-->
    <link rel="stylesheet" type="text/css" href="../css/cadastro-ong.css">
</head>

<body>
    <div class="container">
        <div class="side">
            <!--<img class="img-side" src="../images/icons/logotipo-icon.ico">-->
        </div>
        <div class="container2">
            <header>
                Cadastro ONG
            </header>
            <section class="register">
                <form action="verificar-cadastro-ong.php" method="POST" class="form" name="formCadastro" enctype="multipart/form-data">
                    <div class="field">
                        <h2>Nome da ONG*</h2>
                        <input class="input" id="nome" type="text" name="nome" placeholder="Nome da ONG" required>
                    </div>
                    <div class="field">
                        <h2>E-mail*</h2>
                        <input class="input" id="email" type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <!-- <div class="field">
                        <h2>CNPJ</h2>
                        <input class="input" name="cnpj">
                    </div> -->
                    <div class="field">
                        <h2>Telefone Fixo*</h2>
                        <input type="text" class="input" name="telefone_fixo" placeholder="Telefone Fixo" minlength="14" maxlength="14" id="telefone_fixo" required>
                    </div>
                    <div class="field">
                        <h2>CEP</h2>
                        <input class="input" id="cadastro-cep" placeholder="CEP" name="cep" maxlength="8" required>
                    </div>
                    <div class="field">
                        <h2>Logradouro</h2>
                        <input class="input" id="cadastro-logradouro" placeholder="Logradouro" name="logradouro" readonly>
                    </div>
                    <div class="field">
                        <h2>Número</h2>
                        <input class="input"  id="cadastro-numero" placeholder="Número" name="numero" required>
                    </div>
                    <div class="field">
                        <h2>Bairro</h2>
                        <input class="input" placeholder="Bairro" id="cadastro-bairro" name="bairro" readonly>
                    </div>
                    <div class="field">
                        <h2>Cidade</h2>
                        <input class="input" id="cadastro-cidade" placeholder="Cidade" name="cidade" readonly>
                    </div>
                    <div class="field">
                        <h2>UF</h2>
                        <input class="input" id="cadastro-uf" placeholder="UF" name="uf" readonly>
                    </div>
                    <br><br><br>

                    <div class="bloco mais-dados">
                        <div class="dentro-bloco">
                            <div class="dentro-dentro-bloco">
                                <h2>Foto da ONG</h2><br>
                    <img src="../images/logotipoatual.png" alt="erro" id="foto-ong" width="200" height="200"class="img-fluid" name="" for="">
                                
                                <input type="file" id="teste" name="arquivo" id="arquivo">
                                <script>
                                    $("#teste").change(function() {
                                        if ($(this).val()) { // só se o input não estiver vazio
                                            var img = this.files[0]; // seleciona o arquivo do input
                                            var f = new FileReader(); // cria o objeto FileReader
                                            f.onload = function(e) { // ao carregar a imagem
                                                $("#foto-ong").attr("src", e.target.result); // altera o src da imagem
                                            }
                                            f.readAsDataURL(img); // lê o arquivo
                                        }
                                    });
                                </script>
                            </div>
                            <div class="dentro-dentro-bloco2">
                                <div>
                                    <h2>Causa da ONG*</h2><br>
                                    <select name="causas" id="causas" class="input" required>
                                        <option selected disabled> Causas</option>
                                        <?php
                                        $select = $con->query("SELECT nm_causa from tb_causa order by nm_causa");
                                        foreach ($select as $c) {
                                            $causa = $c["nm_causa"];
                                            echo "<option value='$causa'>$causa</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <h2>Sobre a ONG*</h2><br>
                                    <textarea placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum aspernatur ipsum eius consequuntur quibusdam." name="sobre" class="input"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><Br>
                    <div id="line"></div>
                    <div class="form_footer">
                        <a id="cancel" href="index.php">Cancelar</a>
                        <input id="submit" type="submit" value="Cadastrar">
                    </div>
                </form>
            </section>
        </div>
        <!---->





    </div>
    <script language="JavaScript" type="text/javascript" src="../js/geral.js"></script>
    <script type="text/javascript" src="../js/jquery/jquery-mask/src/jquery.mask.js"></script>

    <script type="text/javascript" src="../js/jquery/jquery-validation/dist/jquery.validate.js"> </script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/endereco.js"></script>
<script type="text/javascript" src="../js/cadastro.js"></script>
</body>

</html>