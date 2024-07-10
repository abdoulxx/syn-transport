<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: connexion.php");
    exit();
}

// Récupérer l'email de l'utilisateur connecté
$user_email = $_SESSION['login'];
$client_id = $_SESSION['user_id']; // Assurez-vous que client_id est défini lors de la connexion

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syn";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer les réservations du client connecté avec les détails de la voiture, y compris la première photo de chaque voiture
$sql = "SELECT c.id, c.date_debut, c.date_fin, c.nombre_jours, c.prix_total, c.mode_paiement, c.statut, l.nom AS nom_voiture, i.image_url AS photo_voiture
        FROM commande c
        INNER JOIN louer l ON c.voiture_id = l.id
        INNER JOIN (SELECT voiture_id, MIN(id) AS min_id FROM images GROUP BY voiture_id) m ON l.id = m.voiture_id
        INNER JOIN images i ON m.min_id = i.id
        WHERE c.client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

$reservations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
} else {
    $message = "Aucune réservation trouvée.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos Réservations - SYN Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="louer.php">Louer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="acheter.php">Acheter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="a_propos.php">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservations.php">Mes Réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-5">
        <h1 class="text-center">Vos Réservations</h1>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php else: ?>
            <!-- Tableau des réservations -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Nom de la Voiture</th>
                            <th>Date de Début</th>
                            <th>Date de Fin</th>
                            <th>Nombre de Jours</th>
                            <th>Prix Total</th>
                            <th>Mode de Paiement</th>
                            <th>Statut</th>
                            <th>Actions</th>
                            <th>Facture </th> <!-- Nouvelle colonne pour l'aperçu PDF -->
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($reservations as $reservation): ?>
        <tr>
            <td><img src="<?php echo $reservation['photo_voiture']; ?>" alt="Photo de la voiture" width="150"></td>
            <td><?php echo htmlspecialchars($reservation['nom_voiture']); ?></td>
            <td><?php echo htmlspecialchars($reservation['date_debut']); ?></td>
            <td><?php echo htmlspecialchars($reservation['date_fin']); ?></td>
            <td><?php echo htmlspecialchars($reservation['nombre_jours']); ?></td>
            <td><?php echo htmlspecialchars($reservation['prix_total']); ?></td>
            <td><?php echo htmlspecialchars($reservation['mode_paiement']); ?></td>
            <td style="color: <?php echo $reservation['statut'] === 'annule' ? 'red' : ($reservation['statut'] === 'valide' ? 'green' : 'gray'); ?>">
                <?php echo htmlspecialchars($reservation['statut']); ?>
            </td>
            <td>
                <a href="annuler_commande.php?id=<?php echo $reservation['id']; ?>" class="text-danger">
                    <i class="fas fa-times-circle me-1"></i> Annuler
                </a>
            </td>
            <td>
                <a href="fpdf/apercu_facture.php?id=<?php echo $reservation['id']; ?>" target="_blank" class="text-primary">
                    <i class="fas fa-file-pdf"></i> Facture
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>


<style>
    /* General Styles */
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    /* Navbar Custom */
    .navbar-custom {
        background-color: #000;
    }

    .navbar-custom .nav-link {
        color: #fff;
    }

    .navbar-custom .nav-link:hover {
        color: #ffcccb;
    }
</style>
