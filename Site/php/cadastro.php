<?php
session_start();
session_destroy();


include('conecta_banco.php');
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


    <script type="text/javascript" src="../js/jquery.min.js"></script>



    <!--Importando os icones-->
    <link rel="stylesheet" type="text/css" href="../css/cadastro.css">
</head>

<body>
    <div class="container">
        <div class="side">
            <!--<img class="img-side" src="../images/icons/logotipo-icon.ico">-->
        </div>
        <div class="container2">
            <header>
                Cadastro
            </header>
            <section class="register">
                <form action="verificar-cadastro-user.php" method="POST" id="formulario" class="form" class="form-group" name="formCadastro" enctype="multipart/form-data">
                    <div class="field">
                        <h2>Nome Completo*</h2>
                        <input class="input" id="nome" type="text" name="nome" minlength="10" maxlength="70" placeholder="Nome Completo" required>
                    </div>
                    <div class="field">
                        <h2>Nome de Usuário*</h2>
                        <input class="input" id="nome_usuario" type="text" name="nome_usuario" minlength="9" maxlength="35" placeholder="Nome Usuário" required>
                    </div>
                    <div class="field">
                        <h2>E-mail*</h2>
                        <input class="input" id="email" type="email" name="email" maxlength="100" placeholder="E-mail" required>
                    </div>
                    <div class="field">
                        <h2>Data de Nascimento*</h2>
                        <input class="input" id="data" type="date" name="data" max="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . "-192 month")) ?>" required>
                    </div>
                    <div class="field">
                        <h2>Senha*</h2>
                        <input class="input" minlength="5" maxlength="20" id="senha" type="password" name="senha" placeholder="Senha" required aria-invalid="false">
                    </div>
                    <div class="field">
                        <h2>Confirmar senha*</h2>
                        <input class="input" type="password" minlength="5" maxlength="20" name="confirmaSenha" placeholder="Confirma Senha" aria-invalid="false">
                    </div>
                    <div class="field">
                        <h2>Telefone Fixo</h2>
                        <input type="text" class="input" name="telefone_fixo" minlength="14" maxlength="14" id="telefone_fixo" placeholder="Telefone Fixo">
                    </div>


                    <div class="field">
                        <h2>Telefone Celular</h2>
                        <input type="text" class="input" name="telefone_celular" minlength="15" maxlength="15" id="telefone_celular" placeholder="Telefone Celular">
                    </div>
                    <div class="field">
                        <h2>CPF</h2>
                        <input  name="cpf" type="text" maxlength="14" minlength="14" class="form-control input" id="cpf"  placeholder='472.384.394-92' id="cpf" >
                    </div>
                    <div id="line"></div>
                    <div class="field">
                        <h2>CEP</h2>
                        <input class="input" id="cadastro-cep" name="cep" maxlength="8" placeholder="CEP" required>
                    </div>
                    <div class="field">
                        <h2>Logradouro</h2>
                        <input class="input" id="cadastro-logradouro" name="logradouro" placeholder="Logradouro" readonly>
                    </div>
                    <div class="field">
                        <h2>Número</h2>
                        <input class="input"  id="cadastro-numero" name="numero" placeholder="Número" required>
                    </div>
                    <div class="field">
                        <h2>Bairro</h2>
                        <input class="input" id="cadastro-bairro" name="bairro" placeholder="Bairro" readonly>
                    </div>
                    <div class="field">
                        <h2>Cidade</h2>
                        <input class="input" id="cadastro-cidade" name="cidade" placeholder="Cidade" readonly>
                    </div>
                    <div class="field">
                        <h2>UF</h2>
                        <input class="input" id="cadastro-uf" name="uf" placeholder="UF" readonly>
                    </div>
                    <div id="line"></div>

                    <div class="field">
                        <h2>Formação</h2>
                        <select name="formacao" id="formacao" class="input">
                            <option selected disabled>Formação</option>
                            <?php
                            $select = $con->query("SELECT *  from tb_formacao order by nm_formacao asc");
                            foreach ($select as $s) {
                                echo "<option value='" . $s['nm_formacao'] . "'>" . $s['nm_formacao'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field">
                        <h2>Habilidade Exigida</h2>
                        <select name="habilidade" id="habilidade" class="input">
                            <option selected disabled>Habilidade</option>
                            <?php
                            $select = $con->query("SELECT *  from tb_habilidade order by nm_habilidade asc");
                            foreach ($select as $s) {
                                echo "<option value='" . $s['nm_habilidade'] . "'>" . $s['nm_habilidade'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div id="line"></div>

                    <div class="field">

                    



                        <h2>Foto de Perfil</h2><br>
                        <img src="../images/logotipoatual.png" id="foto-ong" alt="erro" id="foto-ong" width="200" height="200" class="img-fluid" name="" for=""><br>
                        <input type="file"  id="teste" name="arquivo" id="arquivo" required>
                        <script>
                        $("#teste").change(function(){
   if($(this).val()){ // só se o input não estiver vazio
      var img = this.files[0]; // seleciona o arquivo do input
      var f = new FileReader(); // cria o objeto FileReader
      f.onload = function(e){ // ao carregar a imagem
         $("#foto-ong").attr("src",e.target.result); // altera o src da imagem
      }
      f.readAsDataURL(img); // lê o arquivo
   }
});
                        </script>
                    </div>
                    <div class="field">
                        <h2>Sobre Mim</h2>
                        <textarea  class="input"name="sobre"></textarea>
                    </div>
                    <div id="line"></div>

                    <div class="field">
                        <h2>Ao cadastrar-se você assume que leu e que concorda com nossos <a href="../php/termo-uso.php">Termos de Uso</a>.</h2>
                    </div>
                    <div id="line"></div>
                    <div class="form_footer">
                        <a id="cancel" href="index.php">Cancelar</a>
                        <input id="submit" type="submit" value="Cadastrar">
                    </div>
                </form>
            </section>
        </div>
    </div>
    <script language="JavaScript" type="text/javascript" src="../js/geral.js"></script>
    <script type="text/javascript" src="../js/jquery/jquery-mask/src/jquery.mask.js"></script>

    <script type="text/javascript" src="../js/jquery/jquery-validation/dist/jquery.validate.js"> </script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/endereco.js"></script>
<script type="text/javascript" src="../js/cadastro.js"></script>
</body>

</html>