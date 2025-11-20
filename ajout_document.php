<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ajout Document</title>
</head>
<body>
<h2>Ajout d'un document </h2>
<!--avec $_SERVER['PHP_SELF'], le formulaire envoie les données à la même page,
celle qui a affiché le formulaire. -->
<form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<fieldset>
<label> Type de document </label>
<select name="type" >
<option value="livre">Livre</option>
<option value="dictionnaire">Dictionnaire</option>

<option value="revue">Revue</option>
</select>
<input type="submit" value="valider" name="envoi" /><br/><br/>
</fieldset>
</form>
<?php
//isset vérifie qu'une variable existe et non null
if(isset($_POST["envoi"])){
//Livre
if($_POST["type"]=="livre"){
?>
<form action="" method="post">
<fieldset>
<legend><h3> Ajout d'un livre</h3></legend>
<table>
<tr>
<td><label> Code </label></td>
<td><input type="text" name="code" required /></td>
</tr>
<tr>
<td><label> Titre </label></td>
<td><input type="text" name="titre" required /></td>
</tr>
<tr>
<td> <label> Auteur </label></td>
<td><input type="text" name="auteur" required /></td>
</tr>
<tr>
<td> <label> Nombre de pages </label></td>
<td><input type="text" name="nbpages" required /></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="addbook" value="Ajouter livre" />
</td>
</tr>
</table>
</fieldset>
</form>
<?php
}
else if($_POST["type"]=="dictionnaire"){
?>
<form method="post">
<fieldset>
<legend><h3>Ajout d'un dictionnaire</h3></legend>
<table>
<tr>
<td><label>Code</label></td>

<td><input type="text" name="code" required /></td>
</tr>
<tr>
<td><label>Titre</label></td>
<td><input type="text" name="titre" required /></td>
</tr>
<tr>
<td><label>Langue</label></td>
<td><input type="text" name="langue" required /></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="adddict" value="Ajouter dictionnaire" />
</td>
</tr>
</table>
</fieldset>
</form>
<?php
}
else if($_POST["type"]=="revue"){
?>
<form method="post">
<fieldset>
<legend><h3>Ajout d'une revue</h3></legend>
<table>
<tr>
<td><label>Code</label></td>
<td><input type="text" name="code" required /></td>
</tr>
<tr>
<td><label>Titre</label></td>
<td><input type="text" name="titre" required /></td>
</tr>
<tr>
<td><label>Mois d'édition</label></td>
<td><input type="text" name="mois" required /></td>
</tr>
<tr>
<td><label>Année d'édition</label></td>
<td><input type="text" name="annee" required /></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="addrevue" value="Ajouter revue" />
</td>
</tr>
</table>
</fieldset>
</form>

<?php
}
}
//n'oublier pas script dans le mm fichier $POST_SELF
if(isset($_POST['addbook'])){
if (isset($_POST['code'], $_POST['titre'], $_POST['auteur'], $_POST['nbpages'])){
include("connexion.php");
$idconnection=connect('bibliothequedb');
$code=$idconnection->quote($_POST['code']);
$titre=$idconnection->quote($_POST['titre']);
$auteur=$idconnection->quote($_POST['auteur']);
$nbpages=$idconnection->quote($_POST['nbpages']);
// Requête SQL
$requete1="INSERT INTO document VALUES($code,$titre,DEFAULT)";
$requete2="INSERT INTO livre VALUES($code,$auteur,$nbpages)";
$res1=$idconnection->exec($requete1);
$res2=$idconnection->exec($requete2);
if($res1!=1 || $res2!=1) {
$mess_erreur=$idconnection->errorInfo();
echo "Insertion impossible, code", $idconnection->errorCode(),$mess_erreur[2];
echo "<script type=\"text/javascript\">
alert('Erreur : ".$idconnection->errorCode()."')</script>";
}
else {
echo "<script type=\"text/javascript\">
alert('Le livre est ajouté')</script>";
$idconnection=null;
}
}
}
if(isset($_POST['adddict'])){
if (isset($_POST['code'], $_POST['titre'], $_POST['langue'])){
include("connexion.php");
$idconnection=connect('bibliothequebd');
$code=$idconnection->quote($_POST['code']);
$titre=$idconnection->quote($_POST['titre']);
$langue=$idconnection->quote($_POST['langue']);
// Requête SQL
$requete1="INSERT INTO document VALUES($code,$titre,'disponible')";
$requete2="INSERT INTO dictionnaire VALUES($code,$langue)";
$res1=$idconnection->exec($requete1);
$res2=$idconnection->exec($requete2);
if($res1!=1 || $res2!=1) {
$mess_erreur=$idconnection->errorInfo();
echo "Insertion impossible, code", $idconnection->errorCode(),$mess_erreur[2];
echo "<script type=\"text/javascript\">
alert('Erreur : ".$idconnection->errorCode()."')</script>";
}
else {

echo "<script type=\"text/javascript\">
alert('Le dictionnaire est ajouté')</script>";
$idconnection=null;
}
}
}
if(isset($_POST['addrevue'])){
if (isset($_POST['code'], $_POST['titre'], $_POST['mois'],$_POST['annee'])){
include("connexion.php");
$idconnection=connect('bibliothèque');
$code=$idconnection->quote($_POST['code']);
$titre=$idconnection->quote($_POST['titre']);
$mois=$idconnection->quote($_POST['mois']);
$annee=$idconnection->quote($_POST['annee']);
// Requête SQL
$requete1="INSERT INTO document VALUES($code,$titre,'disponible')";
$requete2="INSERT INTO revue VALUES($code,$mois,$annee)";
$res1=$idconnection->exec($requete1);
$res2=$idconnection->exec($requete2);
if($res1!=1 || $res2!=1) {
$mess_erreur=$idconnection->errorInfo();
echo "Insertion impossible, code", $idconnection->errorCode(),$mess_erreur[2];
echo "<script type=\"text/javascript\">
alert('Erreur : ".$idconnection->errorCode()."')</script>";
}
else {
echo "<script type=\"text/javascript\">
alert('Le revue est ajouté')</script>";
$idconnection=null;
}
}
}
?>
</body>
</html>