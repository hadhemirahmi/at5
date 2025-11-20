<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>Supprimez adhérent</title>
</head>
<body>
<?php
include('connexion.php');
$idcom=connect('bibliothequedb');
if (!empty($_POST['code']) && !empty($_POST['code'])) {
$code=(integer)$_POST['code'];
$requete="DELETE FROM adherent WHERE idAdherent ='$code' ";
$nblignes=$idcom->exec($requete);
if($nblignes==1)
echo "succès";
else
echo "erreur";
}
else
echo "vérifier votre formulaire";
?>
</body>
</html>