<?php

require_once "fonctions.php";

if(isset($_POST["submit"])) {
	
	$utilisateur = chargerUtilisateur($_POST["username"]);

	if( isset($utilisateur["username"]) && 
		isset($utilisateur["password"]) &&
		isset($utilisateur["is_admin"]) ) {

		if( password_verify($_POST["password"], $utilisateur["password"]) ){
			session_start();
			$_SESSION['username'] = $utilisateur["username"];
			$_SESSION['is_admin'] = $utilisateur["is_admin"];
			header("Location: index.php");
		} else {
			header("Location: login.php?connexion=echouee");
		}

	} else {
			header("Location: login.php?connexion=echouee");
	}
}

?>

<!DOCTYPE html>
<html>
	<head lang="fr">

    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Login</title>
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
						<a href="logout.php" class="badge badge-danger"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
					<?php else : ?>
						<a href="login.php" class="badge badge-success"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->

		<!-- LOGIN FORM -->
		<div class="container mt-3">
			<div class="row justify-content-center">
				<div class="col-sm-12 col-md-6">
					<form class="form" method="POST" action="">

						<div class="form-group">
							<label for="username">Nom d'utilisateur :</label>
							<input class="form-control" type="text" name="username" id="username" placeholder="Nom d'utilisateur">
						</div>

						<div class="form-group">
							<label for="password">Mot de passe :</label>
							<input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe">
						</div>

						<div class="form-group text-center">
							<button type="submit" name="submit" class="btn btn-success">
								Se connecter
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- END LOGIN FORM -->
		
	</body>
</html>