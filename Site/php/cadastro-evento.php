<?php
            session_start();
            include('conecta_banco.php');


            $nome = $_SESSION["nome"];
            $email = $_SESSION["email"];
            /**
             * Verificando se existe alguma sessão ativa
             */
            if ($email == null) {

                echo "<script>alert('Login não efetuado');window.location.href='login.php';</script>";
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
	<link rel="stylesheet" type="text/css" href="../css/cadastro-vaga.css">
</head>
<body>
    <div class="container">
        <div class="side">
        <!--<img class="img-side" src="../images/icons/logotipo-icon.ico">-->
        </div>
        <div class="container2">
            <header>
             Cadastro de Evento
            </header>
            <section class="register">
            <form  action="verificar-cadastro-evento.php" method="post" id="formulario" class="form" name="formCadastro" enctype="multipart/form-data">
            <div class="field">
                        <h2>Nome do Evento</h2>
                        <input class="input"  minlength="10" maxlength="70" id="nome" placeholder="Nome do Evento" name="nome" required>
                    </div>
                    <div class="field">
                    <h2>...</h2>
                        <input class="input" disabled>
                    </div>
                    <div class="field">
                        <h2>Digite a data inicial do evento</h2>
                        <input class="input"  type="date" id="data_inicio" min="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . "+1 day")); ?>" max="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . "+100 day")); ?>" name="data_inicio" required>
                    </div>
                    <div class="field">
                        <h2>Digite a data final do evento</h2>
                        <input class="input" type="date" id="data_fim"  min="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . "+2 day")); ?>" max="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . "+105 day")); ?>" name="data_fim" required>
                    
                        <div id="resultado"></div>
                        <script language="javascript">
                            $(function(){
                            $('#data_fim').keyup(function(){
                            var data_inicio   = $("#data_inicio").val();
                            var data_fim      = $("#data_fim").val();
                            
                            var compara1 = parseInt(data_inicio.split("/")[2].toString() + data_inicio.split("/")[1].toString() + data_inicio.split("/")[0].toString());
                            
                            var compara2 = parseInt(data_fim.split("/")[2].toString() + data_fim.split("/")[1].toString() + data_fim.split("/")[0].toString());
                            
                            if (compara1 >= compara2)
                            {
                                $('#resultado').html("Data final não pode ser menor ou igual a data inicial");
                            }
                            return false;
                            })
                            });
                            </script>
                    </div>
                    <div class="field">
                        <h2>Digite o horário de inicial do evento </h2>
                        <input class="input" type="time" id="hora_inicio" name="hora_inicio" min="00:00" max="23:00" required>
                    </div>
                    <div class="field">
                        <h2>Digite o horário de final do evento </h2>
                        <input class="input" type="time" id="hora_fim" name="hora_fim" min="00:00" max="23:00" required>
                        
                        <div id="resultado"></div>

                        <script language="javascript">
                           
                            $('#hora_inicio').keyup(function(){

                                var hora_inicio   = $("#hora_inicio").val();
                            var hora_final      = $("#hora_fim").val();
                            var soma = hora_inicio + hora_final;
                            $('#hora_fim').attr('max') = hora_inicio + 4;
                            
                            return false;
                            });
                    </script>   
                    </div>
                    <div id="line"></div>
                    <div class="field">
                        <h2>CEP</h2>
                        <input class="input" id="cadastro-cep"  name="cep" maxlength="8" placeholder="CEP" required>
                    </div>
                    <div class="field">
                        <h2>Logradouro</h2>
                        <input class="input" id="cadastro-logradouro"  name="logradouro" placeholder="Logradouro" readonly>
                    </div>
                    <div class="field">
                        <h2>Número</h2>
                        <input class="input"  id="cadastro-numero"  name="numero" placeholder="Número" required>
                    </div>
                    <div class="field">
                        <h2>Bairro</h2>
                        <input class="input" id="cadastro-bairro" name="bairro"  placeholder="Bairro" readonly>
                    </div>
                    <div class="field">
                        <h2>Cidade</h2>
                        <input class="input"  id="cadastro-cidade" name="cidade" placeholder="Cidade" readonly>
                    </div>
                    <div class="field">
                        <h2>UF</h2>
                        <input class="input" id="cadastro-uf"  name="uf" placeholder="UF" readonly>
                    </div>


                    <div id="line"></div>

                <div class="field">
                <h2>Foto para Evento</h2><br>
                <img src="../images/logotipoatual.png"   alt="erro" id="foto-ong" class="img-fluid" name="" for=""><br>
					<input type="file"  id="teste"  name="arquivo"  id="arquivo" required>
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
                        <h2>Sobre o Evento</h2>
                        <textarea  class="input"name="sobre" required></textarea>
                    </div>

                   
                  
                    <div id="line"></div>
                    <div class="form_footer">
                        <a id="cancel" href="tela-inicial-ong.php">Cancelar</a>
                        <input id="submit" type="submit" value="Cadastrar">
                    </div>
                </form>
            </section>
        </div>

        </div>
    </div>
    <script type="text/javascript" src="../js/jquery/jquery-mask/src/jquery.mask.js"></script>
    
	<script type="text/javascript" src="../js/jquery/jquery-validation/dist/jquery.validate.js"> </script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
	
    <script type="text/javascript" src="../js/endereco.js"></script>
	<script type="text/javascript" src="../js/cadastro.js"></script>
</body>
</html>