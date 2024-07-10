<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: connexion.php");
    exit();
}

// Afficher l'email de l'utilisateur connecté
$user_email = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Louer - SYN Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-5">
        <p>Session user_email: <?php echo htmlspecialchars($user_email); ?></p>
        <!-- Ajoutez ici le contenu de votre page de location -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

    <div class="container">
        <h2 class="text-center mt-4">Voitures disponibles pour la location</h2>

        <div class="card-container mt-4">
    <?php
    // Connexion à la base de données
    $servername = "localhost"; // Remplacez par le nom de votre serveur
    $username = "root"; // Remplacez par votre nom d'utilisateur de la base de données
    $password = ""; // Remplacez par votre mot de passe de la base de données
    $dbname = "syn"; // Remplacez par le nom de votre base de données

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Requête SQL pour récupérer les informations des voitures et leurs premières images
    $sql = "SELECT louer.id, louer.nom, louer.type_carburant, louer.nombre_places, louer.transmission, louer.consommation, louer.prix_jour, images.image_url AS image
            FROM louer
            LEFT JOIN (SELECT voiture_id, image_url FROM images GROUP BY voiture_id) AS images ON louer.id = images.voiture_id";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Afficher les données pour chaque ligne
        while($row = $result->fetch_assoc()) {
            echo '<div class="card mt-6">';
            echo '    <div class="position-relative">';
            echo '        <div class="fuel-type">' . $row["type_carburant"] . '</div>';
            echo '        <img src="' . $row["image"] . '" class="card-img-top" alt="' . $row["nom"] . '">';
            echo '    </div>';
            echo '    <div class="card-body text-center">';
            echo '        <h5 class="card-title">' . $row["nom"] . '</h5>';
            echo '        <div class="icons">';
            echo '            <div><i class="fas fa-user-friends"></i> <span>' . $row["nombre_places"] . ' places</span></div>';
            echo '            <div><i class="fas fa-cogs"></i> <span>' . $row["transmission"] . '</span></div>';
            echo '            <div><i class="fas fa-tachometer-alt"></i> <span>' . $row["consommation"] . 'km/h</span></div>';
            echo '        </div>';
            echo '        <p class="price">À partir de ' . number_format($row["prix_jour"], 0, ',', '.') . 'fr/Jour</p>';
            echo '    </div>';
            echo '    <div class="card-footer d-flex justify-content-around">';
            echo '        <button class="btn btn-outline-custom" onclick="window.location.href=\'recap.php?id=' . $row["id"] . '\'">Details</button>';
            echo '        <button class="btn btn-primary" onclick="window.location.href=\'recap.php?id=' . $row["id"] . '\'">Reserver</button>';
            echo '    </div>';
            echo '</div>';
        }
    } else {
        echo "0 résultats";
    }
    $conn->close();
    ?>
</div>

    </div>

    <!-- Card CSS -->
    <style>
        .filter-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: center;
        }
        .filter-buttons .btn {
            background-color: #ff6f61;
            border-radius: 20px;
        }
        .filter-buttons .btn.active {
            background-color: #ff6f61;
            color: #fff;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 70px;
        }
        .card {
            width: 350px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .fuel-type {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }
        .card-body h5 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .card-body p {
            margin: 5px 0;
            color: gray;
        }
        .icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 10px 0;
        }
        .icons div {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .icons i {
            color: #555;
        }
        .price {
            font-size: 1.2em;
            margin: 10px 0;
            color: #000 !important;
        }
        .card-footer {
            background-color: #fff;
            border-top: none;
            display: flex;
            justify-content: space-between;
        }
        .card-footer .btn {
            flex: 1;
            margin: 0 5px;
        }
        .btn-outline-custom {
            color: #ff1100e0;
            border-color: #ff1100e0;
            border-width: 2px;
            font-weight: bold;
        }
        .btn-outline-custom:hover {
            background-color: #ff1100e0;
            color: white;
        }
    </style>

    <!-- Navbar CSS -->
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .top-info-bar {
            background-color: #f8f9fa;
            padding: 10px 0;
        }
        .top-info-bar .logo {
            height: 50px;
        }
        .top-info-bar .contact-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .navbar-custom {
            background-color: #000; /* Change to desired color */
        }
        .navbar-custom .nav-link {
            color: #fff;
        }
        .header_wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand .logo {
            height: 200px;
            margin-right: 10px;
            margin-bottom: -50px;
            margin-top: -50px;
        }
    </style>

</body>
</html>
