<?php
session_start();
if(isset($_POST['submit'])){

	$date = new DateTime('NOW');

	$db = new PDO("mysql:host=localhost;dbname=I2_TPWEB_01", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$query = "INSERT INTO Emprunt(id_famille,
								  id_ordinateur,
								  date_emprunt,
								  date_restitution,
								  commentaire_emprunt,
								  commentaire_restitution) 
			  VALUES (?,?,?,?,?,?)";

	$db->prepare($query)->execute([
								   $_POST['famille'],
								   $_POST['ordinateur'],
								   $date->format('Y-m-d H:m:s'),
								   NULL,
								   $_POST['commentaire_emprunt'],
								   NULL
								  ]);

	header("Location: /tpweb/emprunter.php?insertion=succes");
} 
?>

<!DOCTYPE html>
<html>
	<head lang="fr">
		
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Emprunter</title>
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
						<a href="/tpweb/logout.php" class="badge badge-danger"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
					<?php else : ?>
						<a href="/tpweb/login.php" class="badge badge-success"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
	
		<!-- ALERT INSERTION -->
		<?php if(isset($_GET["insertion"]) && $_GET["insertion"]=='succes'): ?>
			<div class="alert alert-success alert-dismissible text-center" role="alert">
	  			Emprunt enregistré avec succès !
	  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
  				</button>
			</div>
		<?php endif; ?>
		<!-- END ALERT INSERTION -->

		<!-- FORMULAIRE INSERTION -->
		<div class="container mt-3">
			<form action="" method="POST">

				<div class="form-group">
				    <label for="famille">Famille :</label>
				    <?php
						$familles = obtenirLesFamilles();
					?>
				    <select class="form-control" name="famille" id="famille" required>
				    	<option disabled hidden selected></option>
					  	<?php
					  		for ($i=0; $i < count($familles) ; $i++) { 
					  			echo '<option value="'.$familles[$i]['id'].'">'.$familles[$i]['nom'].' - '.$familles[$i]['adresse'].' - '.$familles[$i]['telephone'].' - '.$familles[$i]['enfants'].'</option>';
					  		}
					  	?>
					</select>
				</div>

				<div class="form-group">
				    <label for="ordinateur">Ordinateur :</label>
				    <?php
						$ordinateurs = obtenirLesOrdinateurs();
					?>
				    <select class="form-control" name="ordinateur" id="ordinateur" required>
				    	<option disabled hidden selected></option>
					  	<?php
					  		for ($i=0; $i < count($ordinateurs) ; $i++) { 
					  			echo '<option value="'.$ordinateurs[$i]['numero_serie'].'">'.$ordinateurs[$i]['marque'].' - '.$ordinateurs[$i]['processeur'].' - '.$ordinateurs[$i]['memoire'].' - '.$ordinateurs[$i]['os'].'</option>';
					  		}
					  	?>
					</select>
				</div>

				<div class="form-group">
				    <label for="commentaire_emprunt">Commentaire à l'emprunt :</label>
				    <textarea class="form-control" maxlength="255" name="commentaire_emprunt" id="commentaire_emprunt"></textarea>
				</div>

				<div class="form-group text-center">
					<button type="submit" name="submit" value="submit" class="btn btn-success">Déclarer l'emprunt</button>
				</div>

			</form>
		</div>
		<!-- END FORMULAIRE INSERTION -->

	</body>
</html>
