<input id="toggle" type="checkbox">


    <label class="toggle-container" for="toggle">

        <span class="button button-toggle"></span>
    </label>

    <!-- The Nav Menu -->
    <nav class="nav">
        <a class="nav-item" href="tela-inicial-voluntario.php">Home</a>
        <a class="nav-item" href="meus-certificados.php">Meus Certificados</a>
        <a class="nav-item" href="meus-registros.php">Meus Registros</a>
        <a class="nav-item" href="meu-perfil.php">Meu Perfil</a>
        <a class="nav-item" href="minhas-ongs.php">Minhas Ong's</a>
        <a class="nav-item" href="ajuda.php">Ajuda</a>
        <a class="nav-item" href="sobre.php">Sobre</a>
    </nav>
<header class="pesquisa">
    <div class="icons">
        <p><?php echo $_SESSION["nome_usuario"]; ?></p>
        <a href="meu-perfil.php"> <button class="botao-teste"><i class="fa fa-user"></i></button></a>
    </div>
</header>