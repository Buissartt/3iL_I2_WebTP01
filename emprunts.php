<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head lang="fr">
		
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Emprunts</title>
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

		<!-- Liste historique -->
		<div class="container-fluid mt-3">

			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Famille</th>
						<th scope="col">Date emprunt</th>
						<th scope="col">Date restitution</th>
						<th scope="col">Commentaire emprunt</th>
						<th scope="col">Commentaire restitution</th>
						<th scope="col">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						/* On réalise tous les chargements d'abord, puis on affiche.
						   C'est moins optimisé mais c'est plus clair
						*/
						
						$emprunts = obtenirLesEmprunts();
						$ordinateurs = [];
						$familles = [];

						foreach ($emprunts as $emprunt) {
							array_push($ordinateurs, chargerOrdinateur($emprunt["id_ordinateur"]));
							array_push($familles, chargerFamille($emprunt["id_famille"]));
						}
					?>

					<?php for ($i=0; $i < count($emprunts) ; $i++): ?>
						<tr>
							<td>
								<?= $emprunts[$i]["id"]; ?>
							</td>
							<td>
								<?= $familles[$i]["nom"]; ?>
							</td>
							<td>
								<?= $emprunts[$i]["date_emprunt"]; ?>
							</td>
							<td>
								<?= $emprunts[$i]["date_restitution"]; ?>
							</td>
							<td>
								<?= $emprunts[$i]["commentaire_emprunt"]; ?>
							</td>
							<td>
								<?= $emprunts[$i]["commentaire_restitution"]; ?>
							</td>
							<td>
								<?php if($emprunts[$i]["date_restitution"] == ""): ?>
									<a href="restituer.php?id=<?= $emprunts[$i]["id"]; ?>" ><button class="btn btn-info btn-sm" type="button">Restituer</button></a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endfor; ?>
				</tbody>
			</table>

		</div>
		<!-- END LISTE HISTORIQUE -->
	</body>
</html>