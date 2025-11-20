<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>Supprimer un livre</title>
</head>
<body>
<?php
$code=(integer)$_GET['del'];
include('connexion.php');
$idcom=connect('bibliothèque');
$req="DELETE document , livre FROM document INNER JOIN livre WHERE document.code=
livre.code and document.code= $code";
$res=$idcom->exec($req);
if($res===false )
{
echo "<script type=\"text/javascript\">
alert('Erreur : ".$idcom->errorCode()."')</script>";
}
else

{
header("Location:affiche_document.php");
}
$idcom=null;
?>
</body>
</html>