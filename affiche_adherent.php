<!doctype html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Affichage des adhérents</title>
        <style type="text/css">
            table {
                border-style: double;
                border-width: 3px;
                border-color: yellow;

            }
            </style>
            </head>
    <body>
            
<?php
include("connexion.php");
$idcom = connect('bibliotheque');
$requete = "SELECT * FROM adherant";
$resultat = $idcom->query($requete);
if (!$resultat){
    $mess_erreur = $idcom->errorInfo();
    echo"requete non executée";
    
}
else{
    $nbart=$resultat->rowCount();
    echo"<h3>Nombre d'adhérents: $nbart </h3>";
    $ligne=$resultat->fetchObject();//chaque ligne du tableau wakt tchargiha takraha
    echo "<table border=\"1\"><tr>";
    foreach($ligne as $nomcol=>$val){
    echo "<th>",$nomcol,"</th>";
    }
    echo"</tr>";
    //afichage des valeurs du tableau
    echo"<tr>";
    do{
        echo"<td>",$ligne->idAdherant,"</td><br><td>",
        $ligne->nom,"</td><br><td>",$ligne->prenom,
        "</td><br><td>",$ligne->ville,"</td></tr>";
    }while($ligne=$resultat->fetchObject());
    echo"</table>";


    
}

?>