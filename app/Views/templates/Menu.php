<nav class="navbar navbar-expand-lg bg-success text-white mb-3 shadow">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="<?= base_url("arealogada/principal") ?>">
      <img src="<?= base_url("public/img/logo.png") ?>" height="50" width="60" alt="Logo">
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="<?= base_url("arealogada/principal") ?>"><i class="fa-solid fa-house"></i> Principal</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= sprintf("%s Cadastros", ICONE_CADASTRO) ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url("arealogada/conta") ?>"><i class="fa-solid fa-coins"></i> Contas</a></li>
            <li><a class="dropdown-item" href="<?= base_url("arealogada/pagador") ?>"><?= sprintf("%s Pagadores", ICONE_PAGADOR) ?></a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="<?= base_url("arealogada/saida") ?>"><?= sprintf("%s %s", ICONE_SAIDA, "Saída")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= base_url("logout") ?>"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
        </li>
      </ul>
    </div>
  </div>
  <span class="align-items-end text-white" style="text-align: center"><?= sprintf("%s %s", ICONE_USUARIO, session()->get("nome_usua")) ?></span>
</nav>
