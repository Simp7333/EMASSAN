<?php
function getPdoConnection(): PDO {
    $host = 'localhost';
    $db   = 'emassan_ndo_vl'; // nom de la base de données
    $user = 'root'; // ou autre identifiant
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    return new PDO($dsn, $user, $pass, $options);
}

function getSliderpub(): array {
    $pdo = getPdoConnection();
    $stmt = $pdo->query("SELECT * FROM img_espace_pub WHERE autorisation = 1");
    $result = $stmt->fetchAll();
    return $result;
}


function extraireToutesLesImages(PDO $conn, $dossierCible = 'image/') {
    if (!file_exists($dossierCible)) {
        mkdir($dossierCible, 0777, true);
    }

    $sql = "SELECT * FROM img_espace_pub  WHERE autorisation = 1"; // Remplacez "votre_table" par votre vrai nom de table
    $stmt = $conn->query($sql);

    $images = $stmt->fetchAll();
    if (!$images) {
        return "Aucune image trouvée.";
    }

    foreach ($images as $row) {
        $id = $row['ID'];
        $blob = $row['image'];
        $proprietaire = $row['proprietaire_imge'];

        $extension = "jpg"; // ici en dur ; sinon détection possible
        $proprietaire_sain = preg_replace('/[^a-zA-Z0-9_-]/', '_', $proprietaire);
        $cheminFichier = $dossierCible . "image" . $id . "_" . $proprietaire_sain . "." . $extension;

        if (!file_exists($cheminFichier)) {
            file_put_contents($cheminFichier, $blob);
        }
    }

    return " Toutes les images ont été extraites.";
}

function getProduitsRecents(): array {
    $pdo = getPdoConnection();
    $stmt = $pdo->query("SELECT * FROM produit_recent_emassan WHERE autoriser = 1");
    return $stmt->fetchAll();
}


function extraireToutesLesImagesProduit(PDO $conn, $dossierCible = 'imgProduit/') {
    if (!file_exists($dossierCible)) {
        mkdir($dossierCible, 0777, true);
    }

    $sql = "SELECT * FROM produit_recent_emassan  WHERE autoriser = 1"; // Remplacez "votre_table" par votre vrai nom de table
    $stmt = $conn->query($sql);

    $images = $stmt->fetchAll();
    if (!$images) {
        return "Aucune image trouvée.";
    }

    foreach ($images as $row) {
        $id = $row['ID'];
        $blob = $row['nom'];
    

        $extension = "jpg"; // ici en dur ; sinon détection possible
    
        $cheminFichier = $dossierCible . "image" . $id . "_" . "." . $extension;

        if (!file_exists($cheminFichier)) {
            file_put_contents($cheminFichier, $blob);
        }
    }

    return " Toutes les images ont été extraites.";
}
?>
