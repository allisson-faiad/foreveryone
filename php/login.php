<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>For Everyone</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--IMPORTANDO ARQUIVOS-->
    <link rel="icon" type="image/png" href="../images/icons/logotipo-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../bibliotecas/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <!--Importando os icones-->
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/geral.css">
</head>

<body>
    <div class="base">
        <div class="fundo">
            <div>
                <div class="principal row centro">
                    <div class="col-xl-5 col-sm-12">
                        <div class="logo">
                            <a href="index.php"><img src="../images/logotipoatual.png" alt="IMG" class="logotipo login"></a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-sm-12">
                        <div class="form">
                            <form class="form-mesmo" method="POST" action="verificar-login.php">
                                <span class="contact100-form-title">
                                    Login
                                </span>

                                <div class="wrap-input100 validate-input" data-validate="Email inválido: ex@abc.com">
                                    <input class="input100" type="text" name="email" placeholder="E-mail ou Usuário">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <div class="wrap-input100 validate-input" data-validate="Senha inválida">
                                    <input class="input100" type="password" name="senha" placeholder="Senha">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-key" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="container-form-btn">
                                    <input type="submit" class="form-btn" value="Entrar">
                                </div>
                                <br>
                                <a href="cadastro.php">
                                    <h6 class="redirect-cadastro">Cadastre-se</h6>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bibliotecas/jquery/jquery-3.2.1.min.js"></script>
    <script src="bibliotecas/tilt/tilt.jquery.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>