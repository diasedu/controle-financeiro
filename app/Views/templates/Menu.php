<nav class="navbar navbar-expand-lg bg-body-tertiary mb-3 shadow">
  <div class="container-fluid">
    <!--<a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>-->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url("arealogada/principal") ?>"><i class="fa-solid fa-house"></i> Principal</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= sprintf("%s Cadastros", ICONE_CADASTRO) ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url("arealogada/conta") ?>"><i class="fa-solid fa-coins"></i> Contas</a></li>
            <li><a class="dropdown-item" href="<?= base_url("arealogada/pagador") ?>"><?= sprintf("%s Pagadores", ICONE_PAGADOR) ?></a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url("arealogada/saida") ?>"><?= sprintf("%s %s", ICONE_SAIDA, "Saída")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url("logout") ?>"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
        </li>
      </ul>
      
    </div>
  </div>
  <span class="align-items-end" style="text-align: center"><?= sprintf("%s %s", ICONE_USUARIO, session()->get("nome_usua")) ?></span>
</nav>