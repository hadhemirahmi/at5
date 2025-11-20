<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
input[type=submit] {
width: 10em; height: 2em;
}
.edit_btn {
text-decoration: none;

padding: 2px 5px;
background: #2E8B57;
color: white;
border-radius: 3px;
}
.del_btn {
text-decoration: none;
padding: 2px 5px;
color: white;
border-radius: 3px;
background: #800000;
}
</style>
<title>Affiche Document</title>
</head>
<body>
<h2>Liste des documents </h2>
<form action="" method="post">
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
if(isset($_POST["envoi"])){
$type=$_POST['type'];
//Livre
if($_POST["type"]=="livre"){
include("connexion.php");
$idcom=connect("bibliothequedb");
$requete="SELECT d.code,d.titre,d.etat,l.auteur,l.nbredepage FROM document d ,livre l
where d.code=l.code ";
$result=$idcom->query($requete);
if(!$result){
$mes_erreur=$idcom->errorInfo();
echo "Lecture impossible, code", $idcom->errorCode(),$mes_erreur[2];
}
else{
$nbart=$result->rowCount();
echo "<h3>Il y a $nbart livres</h3>";
$ligne=$result->fetchObject();

// Affichage des titres du tableau
echo "<table border=\"1\"> <tr>";
foreach($ligne as $nomcol=>$val) {
echo "<th>", $nomcol ,"</th>";
}
echo "<th colspan=\"2\">Action</th></tr>";
// Affichage des valeurs du tableau
echo "<tr>";
// Il faut utiliser do while car sinon on perd la première ligne de données
do{
echo"<td>", $ligne->code,"</td>", "<td>", $ligne->titre,"</td>","<td>",
$ligne->etat,"</td>","<td>", $ligne->auteur,"</td>","<td>",
$ligne->nbredepage,"</td>";
?>
<td>
<a href="maj_livre.php?edit=<?php echo $ligne->code; ?>" class="edit_btn"
>Modifier</a>
</td>
<td>
<a href="supp_livre.php?del=<?php echo $ligne->code; ?>"
class="del_btn">Supprimer</a>
</td></tr>
<?php
}while ($ligne = $result->fetchObject()) ;
echo "</table>";
$result->closeCursor();
$idcom=null;
}

}
else if($_POST["type"]=="dictionnaire"){
}
else if($_POST["type"]=="revue"){
}
}
?>
</body>
</html>