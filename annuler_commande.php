<?php
session_start();

if (!isset($_SESSION['login'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: connexion.php");
    exit();
}

include('cnx.php');


// Récupérer l'identifiant de la commande à annuler depuis l'URL
if (!isset($_GET['id'])) {
    // Rediriger si l'identifiant de la commande n'est pas fourni dans l'URL
    header("Location: reserver.php");
    exit();
}
$commande_id = $_GET['id'];

// Connexion à la base de données
$conn = new mysqli($host, $user, $pass, $base);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Mettre à jour le statut de la commande à "annule"
$sql = "UPDATE commande SET statut = 'annule' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $commande_id);

if ($stmt->execute()) {
    // Afficher un message indiquant que la commande a été annulée avec succès
    $message = "La commande a été annulée avec succès.";
} else {
    // Afficher un message d'erreur s'il y a eu un problème lors de l'annulation de la commande
    $message = "Erreur lors de l'annulation de la commande : " . $conn->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuler Commande - SYN Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles spécifiques pour la page */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .alert {
            width: 50%;
            margin: 0 auto;
        }
        .btn {
            width: 100%;
            margin-top: 10px;
        }
        .btn-gray {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-green {
            background-color: #28a745;
            color: #fff;
        }
        .btn-red {
            background-color: #dc3545;
            color: #fff;
        }
        @media (max-width: 768px) {
            .alert {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar, header, ou tout autre contenu -->

    <div class="container">
        <div class="alert <?php echo $message == 'La commande a été annulée avec succès.' ? 'alert-danger' : 'alert-info'; ?>" role="alert">
            <?php echo $message; ?>
        </div>
    </div>

    <!-- Footer, ou tout autre contenu -->
</body>
</html>

