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
	<script language="JavaScript" type="text/javascript" src="../js/cadastro.js"></script>


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
             Cadastro de Vagas
            </header>
            <section class="register">
            <form  action="verificar-cadastro-vaga.php" method="post" id="formulario" class="form" name="formCadastro" enctype="multipart/form-data">
                    <div class="field">
                        <h2>Nome da Vaga</h2>
                        <input class="input"  minlength="10" maxlength="70" id="nome" name="nome">
                    </div>
                    <div class="field">
                        <h2>....</h2>
                        <input class="input">
                    </div>
                    <div class="field">
                        <h2>Digite a carga horaria da vaga</h2>
                        <input class="input" type="time" id="carga_horaria" name="carga_horaria" min="00:00" max="23:00" >
                    </div>
                    <div class="field">
                        <h2>Digite a data inicial do trabalho</h2>
                        <input class="input"  type="date" id="data_inicio" min="<?php echo date("Y-m-d", strtotime(date("Y-m-d") . "+1 day")); ?>" name="data_inicio" >
                    </div>
                    <div class="field">
                        <h2>Digite a data final do trabalho</h2>
                        <input class="input" type="date" id="data_fim" <?php echo date("Y-m-d", strtotime(date("Y-m-d") . "+2 day")); ?> name="data_fim">
                    </div>
                    <div class="field">
                        <h2>Digite o horario de entrada do trabalho </h2>
                        <input class="input" type="time" id="hora_inicio" name="hora_inicio" min="00:00" max="23:00" >
                    </div>
                    <div id="line"></div>
                    <div class="field">
                        <h2>Logradouro</h2>
                        <input class="input" id="cadastro-logradouro"  name="logradouro" readonly>
                    </div>
                    <div class="field">
                        <h2>Número</h2>
                        <input class="input"  id="cadastro-numero"  name="numero" required>
                    </div>
                    <div class="field">
                        <h2>CEP</h2>
                        <input class="input" id="cadastro-cep"  name="cep" maxlength="8" required>
                    </div>
                    <div class="field">
                        <h2>Bairro</h2>
                        <input class="input" id="cadastro-bairro" name="bairro"  readonly>
                    </div>
                    <div class="field">
                        <h2>Cidade</h2>
                        <input class="input"  id="cadastro-cidade" name="cidade" readonly>
                    </div>
                    <div class="field">
                        <h2>UF</h2>
                        <input class="input" id="cadastro-uf"  name="uf" readonly>
                    </div>


                    <div id="line"></div>

                <div class="field">
                <h2>Foto para Vaga</h2><br>
					<img src="../images/logotipoatual.png" alt="erro" id="foto-ong" class="img-fluid" name="" for=""><br>
					<input type="file" name="arquivo"  id="arquivo">
                </div>
                <div class="field">
					
						<h2>Formação Exigida</h2>
						<select name="formacao" id="formacao">
							<option selected disabled>Formação</option>
							<?php
							$select= $con->query("SELECT *  from tb_formacao order by nm_formacao asc");
							foreach($select as $s){
								echo "<option value='".$s['nm_formacao']."'>".$s['nm_formacao']."</option>";
							}
							?>
                        </select>
                        </div>
                        <div class="field">
						<h2>Habilidade Exigida</h2>
						<select name="habilidade" id="habilidade">
							<option selected disabled>Habilidade</option>
							<?php
							$select= $con->query("SELECT *  from tb_habilidade order by nm_habilidade asc");
							foreach($select as $s){
								echo "<option value='".$s['nm_habilidade']."'>".$s['nm_habilidade']."</option>";
							}
							?>
						</select>
                    </div>
                    <div class="field">
                        <h2>Sobre a Vaga</h2>
                        <textarea  class="input"name="sobre"></textarea>
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
    </div>
   <script type="text/javascript" src="../js/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="../js/jquery/jquery-mask/src/jquery.mask.js"></script>
	<script type="text/javascript" src="../js/jquery/jquery-validation-master/lib/jquery.form.js"> </script>
	<script type="text/javascript" src="../js/jquery/jquery-validation/dist/jquery.validate.js"> </script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
	
    <script type="text/javascript" src="../js/endereco.js"></script>
	<script type="text/javascript" src="../js/cadastro.js"></script>
</body>
</html>