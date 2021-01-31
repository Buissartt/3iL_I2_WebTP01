<?php

/* Permet d'ouvrir la connection à la base de données */
function openDatabase() {
	$db = new PDO("mysql:host=localhost;dbname=I2_TPWEB_01", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $db;
}

/* Permet de fermer la connection à la base de données */
function closeDatabase($db) {
	$db = null;
}

/* Permet d'obtenir toutes les familles présentes en base */
function obtenirLesFamilles() {
	$db = openDatabase();

	$result = $db->query("SELECT * FROM Famille");
	$familles = $result->fetchAll();

	closeDatabase($db);

	return $familles;
}

/* Permet d'obtenir tous les ordianteurs présents en base */
function obtenirLesOrdinateurs() {
	$db = openDatabase();

	$result = $db->query("SELECT * FROM Ordinateur");
	$ordinateurs = $result->fetchAll();

	closeDatabase($db);

	return $ordinateurs;
}

/* Permet d'obtenir les emprunts */
function obtenirLesEmprunts() {
	$db = openDatabase();

	$query = "SELECT * FROM Emprunt";
	$result = $db->query($query);
	$emprunts = $result->fetchAll();

	closeDatabase($db);	

	return $emprunts;
}

/* Permet de charger un ordinateur à partir de son numéro de série */
function chargerOrdinateur($numero_serie) {
	$db = openDatabase();

	$query = $db->prepare("SELECT * FROM Ordinateur WHERE numero_serie=?");
	$query->execute([$numero_serie]); 

	$ordinateur = $query->fetch();

	closeDatabase($db);

	return $ordinateur;
}

/* Permet de charger une famille à partir de son id */
function chargerFamille($id) {
	$db = openDatabase();

	$query = $db->prepare("SELECT * FROM Famille WHERE id=?");
	$query->execute([$id]); 

	$famille = $query->fetch();

	closeDatabase($db);

	return $famille;
}

/* Permet de charger un emprunt à partir de son id */
function chargerEmprunt($id) {
	$db = openDatabase();

	$query = $db->prepare("SELECT * FROM Emprunt WHERE id=?");
	$query->execute([$id]); 

	$emprunt = $query->fetch();

	closeDatabase($db);

	return $emprunt;
}

/* Permet de charger un utilisateur à partir de son username */
function chargerUtilisateur($username) {
	$db = openDatabase();

	$query = $db->prepare("SELECT * FROM Utilisateur WHERE username=?");
	$query->execute([$username]); 

	$utilisateur = $query->fetch();

	closeDatabase($db);

	return $utilisateur;
}

?>