<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hito Grupal</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style>
		.navbar { background-color: #484848; }
        .navbar .navbar-nav .nav-link { color: #fff; }
        .navbar .navbar-nav .nav-link:hover { color: #fbc531; }
        .navbar .navbar-nav .active > .nav-link { color: #fbc531; }

        footer a.text-light:hover { color: #fed136!important; text-decoration: none; }
        footer .cizgi { border-right: 1px solid #535e67; }
        @media (max-width: 992px) { footer .cizgi { border-right: none; } }
	</style>
</head>
<body>
    <header style="position: absolute; z-index: 15 !important; width:100%">
	<!--- Navbar --->
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<a class="navbar-brand text-white" href="#"><i class="fa fa-graduation-cap fa-lg mr-2"></i>BLOG</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbCollapse" aria-controls="nvbCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="nvbCollapse">
				<ul class="navbar-nav ml-auto">
					<?php
						require_once("connection.php");	
						$conexion = dB::getConnect();
						$stmt = $conexion->query("SELECT titulo, id FROM entradas");
						foreach ($stmt->fetchAll() as $a){
							echo('<li class="nav-item pl-1"><a class="nav-link" href="?web='.$a['id'].'"><i class="fa fa-home fa-fw mr-1"></i>'.$a['titulo'].'</a></li>');
						}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<!--# Navbar #-->
	</header>
</body>
</html>


