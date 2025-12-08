<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container-fluid">
    <!-- ✅ BOTÃO MOBILE -->
    <button class="navbar-toggler text-white"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= sprintf("%s Cadastros", ICONE_CADASTRO) ?>
          </a>
          <ul class="dropdown-menu">
            <!--<li><a class="dropdown-item" href="<?= base_url("arealogada/marca") ?>"><i class="fa-solid fa-tags"></i> Marcas</a></li>-->
            <li><a class="dropdown-item" href="<?= base_url("arealogada/produto") ?>"><i class="fa-solid fa-box"></i> Produtos</a></li>
            <li><a class="dropdown-item" href="<?= base_url("arealogada/cliente") ?>"><i class="fa-solid fa-people-group"></i> Clientes</a></li>
          </ul>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="<?= base_url('arealogada/pedido') ?>"><i class="fa-solid fa-cart-shopping"></i> Pedidos</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="<?= base_url('arealogada/venda') ?>"><i class="fa-solid fa-cart-shopping"></i> Vendas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= base_url("logout") ?>"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>
        </li>
      </ul>
    </div>
  </div>
  <span class="align-items-end text-white" style="text-align: center"><?= sprintf("%s %s", ICONE_USUARIO, session()->get("nome_usua")) ?></span>
</nav>
