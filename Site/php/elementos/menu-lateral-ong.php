<nav class="main-menu d-none d-sm-block">
    <ul>
        <li style="background: black;">
            <a href="">
                <i class="fa fa-2x"><img src="..\images\logotipoatual.ico" style=" width: 30px; height: 30px;"></i>
                <span class="nav-text" style="color: white; text-align: center; letter-spacing: 5px; font-size: 15px;">
                    FOR EVERYONE
                </span>
            </a>
        </li>
        <li>
            <a href="tela-inicial-ong.php">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">
                    Home
                </span>
            </a>
        </li>

        <li class="has-subnav">
            <a href="meu-perfil-ong.php">
                <i class="fa fa-user fa-2x"></i>
                <span class="nav-text">
                    Meu Perfil
                </span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="minhas-publicacoes.php">
                <i class="fa fa-window-restore fa-2x"></i>
                <span class="nav-text">
                    Minhas Publicações
                </span>
            </a>
        </li>

        <li>
            <a href="ajuda.php">
                <i class="fa fa-question-circle fa-2x"></i>
                <span class="nav-text">
                    Ajuda
                </span>
            </a>
        </li>
        <li>
            <a href="sobre-ong.php">
                <i class="fa fa-info fa-2x"></i>
                <span class="nav-text">
                    Sobre
                </span>
            </a>
        </li>
    </ul>

    <ul class="logout">
        <li>
            <a href="logout-ong.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">
                    Sair
                </span>
            </a>
        </li>
    </ul>
</nav>

<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);

    @import url(https://fonts.googleapis.com/css?family=Titillium+Web:300);

    .fa-2x {
        font-size: 2em;
    }

    .fa {
        position: relative;
        display: table-cell;
        width: 60px;
        height: 36px;
        text-align: center;
        vertical-align: middle;
        font-size: 20px;
        padding: 20px 0;
    }


    .main-menu:hover,
    nav.main-menu.expanded {
        width: 250px;
        overflow: visible;
    }

    .main-menu {

        background: #efefef;
        border-right: 1px solid #e5e5e5;
        position: fixed;
        top: 0;
        bottom: 0;
        height: 100%;
        left: 0;
        width: 60px;
        overflow: hidden;
        -webkit-transition: width .05s linear;
        transition: width .05s linear;
        z-index: 1000;
    }



    .main-menu li {
        position: relative;
        display: block;
        width: 250px;
    }

    .main-menu li>a {
        position: relative;
        display: table;
        border-collapse: collapse;
        border-spacing: 0;
        color: #161920;
        font-family: arial;
        font-size: 14px;
        text-decoration: none;
        -webkit-transition: all .1s linear;
        transition: all .1s linear;

    }

    .main-menu .nav-icon {
        position: relative;
        display: table-cell;
        width: 60px;
        height: 36px;
        text-align: center;
        vertical-align: middle;
        font-size: 18px;
    }

    .main-menu .nav-text {
        position: relative;
        display: table-cell;
        vertical-align: middle;
        width: 190px;
    }

    .main-menu>ul.logout {
        position: absolute;
        left: 0;
        bottom: 0;
    }

    .no-touch .scrollable.hover {
        overflow-y: hidden;
    }

    .no-touch .scrollable.hover:hover {
        overflow-y: auto;
        overflow: visible;
    }

    a:hover,
    a:focus {
        text-decoration: none;
    }

    nav {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        -o-user-select: none;
        user-select: none;
    }

    nav ul,
    nav li {
        outline: 0;
        margin: 0;
        padding: 0;
    }

    .main-menu li:hover>a,
    nav.main-menu li.active>a,
    .dropdown-menu>li>a:hover,
    .dropdown-menu>li>a:focus,
    .dropdown-menu>.active>a,
    .dropdown-menu>.active>a:hover,
    .dropdown-menu>.active>a:focus,
    .no-touch .dashboard-page nav.dashboard-menu ul li:hover a,
    .dashboard-page nav.dashboard-menu ul li.active a {
        color: #fff;
        background-color: #ff7d00;
        transition-duration: 2s;
    }

    .area {
        float: left;
        background: #e2e2e2;
        width: 100%;
        height: 100%;
    }

    @font-face {
        font-family: 'Titillium Web';
        font-style: normal;
        font-weight: 300;
        src: local('Titillium WebLight'), local('TitilliumWeb-Light'), url(http://themes.googleusercontent.com/static/fonts/titilliumweb/v2/anMUvcNT0H1YN4FII8wpr24bNCNEoFTpS2BTjF6FB5E.woff) format('woff');
    }
</style>