<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>Modifiez vos informations</title>
</head>
<body>
<?php
include('connexion.php');
$idcom=connect('bibliothèque');
//isset — Détermine si une variable est déclarée et est différente de null
if(!isset($_POST['modif'])) {
$code=(integer)$_POST['code'];
// Requête SQL
$requete="SELECT * FROM adherent WHERE idadherent='$code' ";

$result=$idcom->query($requete);
//PDO::FETCH_NUM : retourne un tableau indexé
$coord=$result->fetch(PDO::FETCH_NUM);
// Création du formulaire complété avec les données existantes
?>
<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset>
<legend><b>Modifiez vos informations</b></legend>
<table>
<tr>
<td>Nom : </td>
<td><input type="text" name="nom" value="<?= $coord[1] ?>" /></td>
</tr>
<tr>
<td>Prénom : </td>
<td><input type="text" name="prenom" value="<?= $coord[2] ?>" /></td>
</tr>
<tr>
<td>Ville : </td>
<td><input type="text" name="ville" value="<?= $coord[3] ?>" /></td>
</tr>
<tr>
<td><input type="reset" value="Effacer"></td>
<td><input type="submit" name="modif" value="Enregistrer"></td>
</tr>
</table>
</fieldset>
<!--
Champ hidden :
Ce champ permet de transmettre l'identifiant de l'adhérent (idadherent)
au script lors de la soumission du formulaire, afin de connaître l'ID
de l'adhérent qui doit être mis à jour.
-->
<input type="hidden" name="code" value="<?= $code ?>" />
</form>
<?php
//Libération des ressources liées à la requête :
$idcom=null;
} elseif( !empty($_POST['nom'])&& !empty($_POST['prenom'])&& !empty($_POST['ville']))
{
// ENREGISTREMENT
$nom=$idcom->quote($_POST['nom']);
$prenom=$idcom->quote($_POST['prenom']);
$ville=$idcom->quote($_POST['ville']);
$code=(integer)$_POST['code'];
// Requête SQL

$requete="UPDATE adherent SET nom=$nom,prenom=$prenom,ville=$ville WHERE
idadherent=$code";
$result=$idcom->exec($requete);
if($result!=1)
{
echo "<script type=\"text/javascript\">
alert('Erreur : ".$idcom->errorCode()."')</script>";
}
else
{
echo "<script type=\"text/javascript\"> alert('Vos modifications sont enregistrées');
window.location='maj_adherent.php';</script>";
}
$idcom=null;
} else
{
echo "Modifiez vos coordonnées !";
} ?>
</body>
</html>