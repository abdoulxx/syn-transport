<?php
session_start();

if (!isset($_SESSION['client_id'])) {
    header('Location: login.php');
    exit();
}

include('cnx.php');

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$voiture_id = $_POST['voiture_id'];
$client_id = $_SESSION['client_id'];
$date_debut = $_POST['start_date'];
$date_fin = $_POST['end_date'];
$nombre_jours = (new DateTime($date_fin))->diff(new DateTime($date_debut))->days + 1;
$prix_total = $_POST['total_price'];
$mode_paiement = 'mobile_money';

$sql = "INSERT INTO commande (voiture_id, client_id, date_debut, date_fin, nombre_jours, prix_total, mode_paiement, statut)
        VALUES ('$voiture_id', '$client_id', '$date_debut', '$date_fin', '$nombre_jours', '$prix_total', '$mode_paiement', 'valide')";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
