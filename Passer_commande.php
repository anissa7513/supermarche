<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix de la famille</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

    <div class="main-page">
        <div class="content-box">
            <h1 class="titre-commande">Bienvenue au supermarché</h1>
            <h2 class="sous-titre-commande">Veuillez choisir votre famille de produits</h2>

            <div class="famille-grid"> 
                <a href="produit_boisson.php?famille=400" class="famille-card">Boissons</a>
                <a href="produit_viande.php?famille=600" class="famille-card">Viandes</a>
                <a href="produit_hygiene.php?famille=500" class="famille-card">Hygiène</a>
                <a href="produit_vetement.php?famille=300" class="famille-card">Vêtements</a>
                <a href="produit_electronique.php?famille=100" class="famille-card">Électronique</a>
                <a href="produit_livre.php?famille=200" class="famille-card">Livres</a> 
                <a href="produits.php?famille=0" class="famille-card card-placeholder"></a>
                <a href="produits.php?famille=0" class="famille-card card-placeholder"></a>
                
            </div>
            
            <div class="zone-boutons-retour">
                <a href="index.php" class="btn btn-secondary">Retour au menu principal</a>
            </div>

        </div>
    </div> 
</body>
</html>