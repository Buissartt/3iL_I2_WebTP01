<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head lang="fr">

    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Index</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	</head>
	<body>
		<!-- NAVBAR -->
		<nav class="navbar navbar-dark bg-dark navbar-expand-md">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
				    	<a class="nav-link" href="index.php">Accueil</a>
				    </li>
				    <li class="nav-item">
				    	<a class="nav-link" href="emprunter.php">Emprunter</a>
				    </li>
				    <li class="nav-item">
				    	<a class="nav-link" href="emprunts.php">Historique d'emprunts</a>
				    </li>
				</ul>
				<div class="text-right">
					<?php if(isset($_SESSION["username"])) : ?>
						<span class="text-uppercase font-weight-bold text-white"><?= $_SESSION["username"]; ?></span>
						<a href="/tpweb/logout.php" class="badge badge-danger"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
					<?php else : ?>
						<a href="/tpweb/login.php" class="badge badge-success"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->

		<!-- INFO UTILISATEUR CONNECTE -->
		<?php if(isset($_SESSION["username"])): ?>
			<div class="container">
				<p>Connecté en tant que : <?= $_SESSION["username"]; ?></p>
				<p>Est administrateur : <?= $_SESSION["is_admin"]==1?'Oui':'Non'; ?></p>
			</div>
		<?php endif; ?>
		<!-- END INFO UTILISATEUR CONNECTE -->
		
	</body>
</html>