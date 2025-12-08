<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Controle Financeiro | <?= $titulo ?></title>
	<link rel="stylesheet" href="<?= base_url("css/libs/bootstrap.min.css") ?>">
	<link rel="stylesheet" href="<?= base_url("css/libs/datatables.min.css") ?>">
	<link rel="stylesheet" href="<?= base_url("css/libs/datatables.bootstrap5.min.css") ?>">
	<link rel="shortcut icon" href="<?= base_url("img/favicon.png") ?>" type="image/x-icon">
	<script src="<?= base_url("js/libs/jquery.min.js") ?>"></script>
	<script src="<?= base_url("js/libs/bootstrap.bundle.min.js") ?>"></script>
	<script src="<?= base_url("js/libs/jquery.mask.min.js") ?>"></script>
	<script src="<?= base_url("js/libs/datatables.min.js") ?>"></script>
	<script src="<?= base_url("js/libs/datatables.bootstrap5.min.js") ?>"></script>
	<script src="<?= base_url("js/libs/fontawesome.min.js") ?>"></script>

	<style>
		#loader-overlay {
			display: none;        /* começa oculto */
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(255, 255, 255, 0.6); /* fundo levemente branco */
			backdrop-filter: blur(2px);           /* opcional: aplica blur */
			z-index: 9999;        /* fica acima de tudo */
			display: flex;
			justify-content: center;
			align-items: center;
			pointer-events: all;  /* garante bloqueio */
		}

	</style>
</head>