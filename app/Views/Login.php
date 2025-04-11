<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="<?= base_url("public/css/libs/bootstrap.min.css") ?>">
	<script src="<?= base_url("public/js/libs/bootstrap.min.js") ?>"></script>

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

<body class="d-flex align-items-center py-4 bg-body-tertiary">
	<main class="form-signin w-100 m-auto">
		<form>
			<h1 class="h3 mb-3 fw-normal">Login</h1>

			<div class="form-floating">
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
				<label for="email">E-mail</label>
			</div>
			<div class="form-floating">
				<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
				<label for="senha">Senha</label>
			</div>

			<button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
		</form>
	</main>
</body>

</html>