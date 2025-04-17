<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="<?= base_url("public/css/libs/bootstrap.min.css") ?>">
	<script src="<?= base_url("public/js/libs/bootstrap.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/bootstrap.bundle.min.js") ?>"></script>
	<script src="<?= base_url("public/js/libs/jquery.min.js") ?>"></script>
</head>

<body>
	<?= view("templates/Menu") ?>
	
	<script src="<?= base_url(sprintf("public/js/arealogada/principal.js?v=%d", time())) ?>"></script>
</body>

</html>