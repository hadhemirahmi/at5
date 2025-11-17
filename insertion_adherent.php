<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <h2>Formulaire d'inscription</h2>

    <form action="#" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" required><br><br>

        <button type="reset">Effacer</button>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>

<?php
include("connexion.php");
$idcom = connect('bibliothequebd');


// Vérifie que le formulaire est soumis avec les 3 champs
if (isset($_POST['nom'], $_POST['prenom'], $_POST['ville'])) {
    $id_adherant = "\N";
    $nom = $idcom->quote($_POST['nom']);
    $prenom = $idcom->quote($_POST['prenom']);
    $ville = $idcom->quote($_POST['ville']);

    $requete = "INSERT INTO adherant (idAdherant,nom, prenom, ville) VALUES (Null,$nom, $prenom, $ville)";
    $nblignes = $idcom->exec($requete);

    if ($nblignes != 1) {
        echo "Insertion n'est pas effectuée";
    } else {
        echo "Insertion effectuée";
    }
}

$idcom = null;
?>

