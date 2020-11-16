<nav id="navbar_principal" class="navbar navbar-expand-lg navbar-dark bg-dark row">
    <a class="navbar-brand" href="/"><img src="storage/imagens/fixas/accb-logo-branco.png" height="30" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li @if($current == "home") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/home">Home</a>
            </li>
            <li @if($current == "arquivo") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/arquivo">Arquivo</a>
            </li>
            <li @if($current == "sobre") class="nav-item active" @else class="nav-item" @endif>
                <a class="nav-link" href="/sobre">Sobre</a>
            </li>
        </ul>
    </div>
</nav>