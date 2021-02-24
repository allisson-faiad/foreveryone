<input id="toggle" type="checkbox">
<label class="toggle-container" for="toggle">
    <span class="button button-toggle"></span>
</label>

<!-- The Nav Menu -->
<nav class="nav">
    <a class="nav-item" href="tela-inicial-ong.php">Home</a>
    <a class="nav-item" href="meu-perfil-ong.php">Meu Perfil</a>
    <a class="nav-item" href="minhas-vagas.php">Minhas Vagas</a>
    <a class="nav-item" href="ajuda.php">Ajuda</a>
    <a class="nav-item" href="sobre-ong.php">Sobre</a>
</nav>
<header class="pesquisa">
    <div class="icons">
        <p><?php echo $_SESSION["nome_ong"]; ?></p>
        <a href="meu-perfil-ong.php"> <button class="botao-teste"><i class="fa fa-user"></i></button></a>
    </div>
</header>