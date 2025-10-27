<?php
require_once 'Connect.php';

use Model\Connect;

$conn = Connect::seConnecter();

if ($conn instanceof PDO) {
    echo "✅ Connexion réussie à la base de données !";
} else {
    echo "❌ Erreur de connexion : " . $conn;
}
