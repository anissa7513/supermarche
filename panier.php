<?php
session_start();

// Connexion
$host = 'localhost';
$db   = 'super';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

// AJOUTER AU PANIER
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id_produit'];
    $_SESSION['panier'][$id] = ($_SESSION['panier'][$id] ?? 0) + 1;
}

// SUPPRIMER DU PANIER
if (isset($_GET['delete'])) {
    unset($_SESSION['panier'][$_GET['delete']]);
    header('Location: panier.php');
    exit();
}

// RECUPERER LES PRODUITS
$produits_panier = [];
$total_general = 0;
if (!empty($_SESSION['panier'])) {
    $ids = array_keys($_SESSION['panier']);
    $clause = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM produit WHERE id_produit IN ($clause)");
    $stmt->execute($ids);
    $produits_panier = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier</title>
    <style>
        /* Un petit style rapide pour eviter que tout soit colle */
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; }
        .panier-container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #d32f2f; border-bottom: 2px solid #d32f2f; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #eee; padding: 10px; text-align: left; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .total-box { text-align: right; margin-top: 20px; font-size: 1.2em; font-weight: bold; }
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block; cursor: pointer; border: none; }
        .btn-print { background-color: #4CAF50; color: white; }
        .btn-back { background-color: #2196F3; color: white; }
        .btn-delete { color: #d32f2f; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="panier-container">
    <h1>Mon Panier</h1>

    <?php if(empty($produits_panier)): ?>
        <p>Votre panier est vide.</p>
        <a href="passer_commande.html" class="btn btn-back">Retour aux rayons</a>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix Unit.</th>
                    <th>Quantite</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produits_panier as $p): 
                    $qte = $_SESSION['panier'][$p['id_produit']];
                    $st = $p['prix'] * $qte;
                    $total_general += $st;
                ?>
                <tr>
                    <td><?= htmlspecialchars($p['nom_produit']) ?></td>
                    <td><?= number_format($p['prix'], 2) ?> €</td>
                    <td><?= $qte ?></td>
                    <td><?= number_format($st, 2) ?> €</td>
                    <td><a href="panier.php?delete=<?= $p['id_produit'] ?>" class="btn-delete">Supprimer</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total-box">
            Total a payer : <?= number_format($total_general, 2) ?> €
        </div>

        <div style="margin-top: 30px; display: flex; justify-content: space-between;">
            <a href="passer_commande.html" class="btn btn-back">Continuer les achats</a>
            <button onclick="window.print()" class="btn btn-print">Imprimer la facture</button>
        </div>
    <?php endif; ?>
</div>

</body>
</html>