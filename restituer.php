<?php
session_start();
if(isset($_POST['submit'])){

	$date = new DateTime('NOW');

	$db = new PDO("mysql:host=localhost;dbname=I2_TPWEB_01", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$query = "UPDATE Emprunt
			  SET date_restitution        = ?,
			  	  commentaire_restitution = ?
			  WHERE id = ?";

	$db->prepare($query)->execute([
								   $date->format('Y-m-d H:m:s'),
								   $_POST["commentaire_restitution"],
								   $_POST["id"],
								   ]);

	header("Location: emprunts.php");
} 
?>

<!DOCTYPE html>
<html>
	<head lang="fr">
		
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Restituer</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	</head>
	<body>

		<?php
			// Inclusion du fichier regroupant des fonctions communes
			require_once 'fonctions.php';
		?>

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
	
		<!-- ALERT RESTITUTION -->
		<?php if(isset($_GET["restitution"]) && $_GET["restitution"]=='succes'): ?>
			<div class="alert alert-success alert-dismissible text-center" role="alert">
	  			Restitution enregistrée avec succès !
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
  				</button>
			</div>
		<?php endif; ?>
		<!-- END ALERT RESTITUTION -->

		<?php
			//Chargement des informations relatives à l'emprunt
			if( isset($_GET["id"]) ){
				$emprunt = chargerEmprunt($_GET["id"]);
				$famille = chargerFamille($emprunt["id_famille"]);
				$ordinateur = chargerOrdinateur($emprunt["id_ordinateur"]);
			}

		?>

		<!-- FORMULAIRE RESTITUTION -->
		<div class="container mt-3">
			<form action="" method="POST">

				<input type="hidden" name="id" value="<?= $emprunt["id"]; ?>">

				<div class="form-group">
					<label for="famille">Famille :</label>
					<input type="text" class="form-control" id="famille" disabled value="<?= $famille["nom"]; ?>">
				</div>

				<div class="form-group">
					<label for="ordinateur">Ordinateur :</label>
					<input type="text" class="form-control" id="ordinateur" disabled value="<?= $ordinateur["marque"]; ?>">
				</div>

				<div class="form-group">
					<label for="date_emprunt">Date d'emprunt :</label>
					<input type="text" class="form-control" id="date_emprunt" disabled value="<?= $emprunt["date_emprunt"]; ?>">
				</div>

				<div class="form-group">
				    <label for="commentaire_emprunt">Commentaire à l'emprunt :</label>
				    <textarea class="form-control" maxlength="255" id="commentaire_emprunt" disabled><?= $emprunt["commentaire_emprunt"]; ?></textarea>
				</div>

				<div class="form-group">
				    <label for="commentaire_restitution">Commentaire à la restitution :</label>
				    <textarea class="form-control" maxlength="255" name="commentaire_restitution" id="commentaire_restitution"></textarea>
				</div>

				<div class="form-group text-center">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Déclarer la restitution</button>
				</div>

			</form>
		</div>
		<!-- END FORMULAIRE RESTITUTION -->

	</body>
</html>
