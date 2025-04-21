<body>
	<?= view("templates/Menu") ?>
	
	<div class="container">
		<h1 class="mb-3">Bem-vindo &#128578;</h1>
		<p>O sistema tem o intuito de agir como um lembrete de contas a serem pagas durante o mês e ano (de acordo com as contas cadastradas).</p>
	</div>

	<script src="<?= base_url(sprintf("public/js/arealogada/principal.js?v=%d", time())) ?>"></script>
</body>
