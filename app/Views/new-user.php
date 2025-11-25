<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="<?= base_url("css/libs/bootstrap.min.css") ?>">
	<script src="<?= base_url("js/libs/bootstrap.min.js") ?>"></script>
	<script src="<?= base_url("js/libs/jquery.min.js") ?>"></script>

	<style>
		html,
		body {
			height: 100%;
		}

		.form-signin {
			max-width: 330px;
			padding: 1rem;
		}

		.form-signin .form-floating:focus-within {
			z-index: 2;
		}

		.form-signin input[type="email"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}

		.form-signin input[type="password"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
</head>

<body class="d-flex align-items-center py-4 bg-dark">
	<main class="form-signin w-100 m-auto">
		<form method="post" action="save-new-user" method="post">
			<h1 class="h3 mb-3 fw-normal text-center text-white">Cadastro</h1>

            <div class="form-floating mb-2">
				<input type="text" class="form-control" id="nome" name="nome" placeholder="nome" required>
				<label for="nome">Nome</label>
			</div>

			<div class="form-floating mb-2">
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
				<label for="email">E-mail</label>
			</div>

			<div class="form-floating mb-2">
				<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
				<label for="senha">Senha</label>
			</div>

            <div class="form-floating mb-2">
				<input type="password" class="form-control" id="confirma_senha" name="confirma_senha" placeholder="Confirma a senha" required>
				<label for="confirma_senha">Senha</label>
			</div>

			<div id="msg">
				<?php if (session()->getFlashdata('error')): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= esc(session()->getFlashdata('error')) ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<?php if (session()->getFlashdata('success')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= esc(session()->getFlashdata('success')) ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<?php if (session()->getFlashdata('errors')): ?>
					<?php $errors = session()->getFlashdata('errors'); ?>
					<?php if (is_array($errors)): ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<ul class="mb-0">
								<?php foreach ($errors as $error): ?>
									<li><?= esc($error) ?></li>
								<?php endforeach; ?>
							</ul>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php else: ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= esc($errors) ?>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php endif; ?>
				<?php endif; ?>
            </div>

			<button class="btn btn-primary w-100 py-2 mb-2" type="submit" id="btn-save-user">Salvar</button>
		</form>
	</main>
</body>

</html>