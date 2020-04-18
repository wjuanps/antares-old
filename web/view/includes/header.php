<div ng-controller="headerCtrl">
    <nav class="navbar navbar-toggleable-sm fixed-top navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button"
            data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href=<?= __URL_BASE__ ?>>
            <img src="favicon.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Antares">
            Antares
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href=<?= __URL_BASE__ ?>>Home
                    <span class="sr-only">(current)</span>
                </a></li>
                <li class="nav-item"><a class="nav-link" href=<?= __URL_BASE__ . 'comparador' ?>>Comparar</a></li>
                <li class="nav-item"><a class="nav-link" href=<?= __URL_BASE__ . 'sobre' ?>>Sobre</a></li>
                <li class="nav-item" ng-if="!logado"><a class="nav-link" href=<?= __URL_BASE__ . 'acessar-sistema' ?>>Entrar</a></li>
                <li class="nav-item dropdown" ng-if="logado">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ng-bind="usuario.nome"></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Minhas pesquisas</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" ng-click="logOut()" href="#">Sair do Sistema</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>