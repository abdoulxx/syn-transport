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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la voiture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .carousel-main img {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 10px;
        }
        .thumbnail img {
            height: 100px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 10px;
        }
        .car-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .car-info h3 {
            margin-bottom: 20px;
        }
        .car-info p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .car-info .form-control {
            margin-bottom: 20px;
        }
        .total-price {
            font-size: 18px;
            font-weight: bold;
        }
        .reserve-btn {
            background: #007bff;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .reserve-btn:hover {
            background: #0056b3;
        }
    </style>
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
        <h5>Session user_email: <?php echo htmlspecialchars($user_email); ?></h5>
        <!-- Ajoutez ici le contenu de votre page de location -->
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <?php
                // Connexion à la base de données
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "syn";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

                if (isset($_GET['id'])) {
                    $voiture_id = $_GET['id'];
                    
                    $sql = "SELECT * FROM louer WHERE id = $voiture_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $voiture = $result->fetch_assoc();

                        // Récupérer les images
                        $sql_images = "SELECT image_url FROM images WHERE voiture_id = $voiture_id";
                        $result_images = $conn->query($sql_images);
                        $images = [];
                        while($row = $result_images->fetch_assoc()) {
                            $images[] = $row['image_url'];
                        }
                        
                        echo '<h2 class="text-center mb-4">' . $voiture['nom'] . '</h2>';

                        // Affichage de l'image principale et des miniatures
                        if (!empty($images)) {
                            echo '<div id="carouselMain" class="carousel-main mb-4">';
                            echo '  <img src="' . $images[0] . '" class="img-fluid" alt="Image voiture" id="mainImage">';
                            echo '</div>';

                            echo '<div class="thumbnail-carousel owl-carousel owl-theme">';
                            foreach ($images as $image) {
                                echo '<div class="item thumbnail">';
                                echo '  <img src="' . $image . '" class="img-fluid" alt="Image voiture" onclick="changeImage(\'' . $image . '\')">';
                                echo '</div>';
                            }
                            echo '</div>';
                        } else {
                            echo '<p>Aucune image disponible pour cette voiture.</p>';
                        }

                    } else {
                        echo "Aucun détail disponible pour cette voiture.";
                    }
                } else {
                    echo "ID de voiture manquant.";
                }

                $conn->close();
                ?>
            </div>
            <div class="col-md-4">
                <?php
                if (isset($voiture)) {
                    // Descriptif
                    echo '<div class="car-info">';
                    echo '  <h3>Informations sur la voiture</h3>';
                    echo '  <p><strong>Type de carburant:</strong> ' . $voiture['type_carburant'] . '</p>';
                    echo '  <p><strong>Nombre de places:</strong> ' . $voiture['nombre_places'] . '</p>';
                    echo '  <p><strong>Transmission:</strong> ' . $voiture['transmission'] . '</p>';
                    echo '  <p><strong>Consommation:</strong> ' . $voiture['consommation'] . ' km/h</p>';
                    echo '  <p><strong>Prix par jour:</strong> ' . number_format($voiture['prix_jour'], 0, ',', '.') . ' fr</p>';
                    
                    // Formulaire de réservation
                    echo '<form id="reservationForm" method="POST" action="process_payment.php">';
                    echo '  <div class="mt-4">';
                    echo '    <label for="start-date" class="form-label">Date de début:</label>';
                    echo '    <input type="text" id="start-date" name="start_date" class="form-control flatpickr">';
                    echo '    <label for="end-date" class="form-label mt-3">Date de fin:</label>';
                    echo '    <input type="text" id="end-date" name="end_date" class="form-control flatpickr">';
                    echo '    <label for="payment-method" class="form-label mt-3">Mode de paiement:</label>';
                    echo '    <select id="payment-method" name="payment_method" class="form-control">';
                    echo '      <option value="cash">Cash à la livraison</option>';
                    echo '      <option value="mobile_money">Mobile Money</option>';
                    echo '    </select>';
                    echo '    <input type="hidden" name="voiture_id" value="' . $voiture['id'] . '">'; // ID de la voiture
                    echo '    <input type="hidden" name="item_name" value="' . $voiture['nom'] . '">';
                    echo '    <input type="hidden" name="item_price" id="item_price" value="' . $voiture['prix_jour'] . '">';
                    echo '    <input type="hidden" name="currency" value="XOF">';
                    echo '    <input type="hidden" name="ref_command" value="' . uniqid() . '">';
                    echo '    <input type="hidden" name="command_name" value="Réservation de ' . $voiture['nom'] . '">';
                    echo '    <input type="hidden" name="total_price" id="total_price" value="0">';  // Nouveau champ pour le prix total
                    echo '    <p class="total-days mt-3">Nombre total de jours: <span id="totalDays">0</span> jours</p>';
                    echo '    <p class="total-price mt-3">Prix total: <span id="totalPrice">0</span> fr</p>';
                    echo '    <button type="submit" class="reserve-btn">Réserver</button>';
                    echo '  </div>';
                    echo '</form>';

                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function(){
            $(".thumbnail-carousel").owlCarousel({
                items: 4,
                margin: 10,
                loop: true,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            $(".flatpickr").flatpickr({
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    calculateTotal();
                }
            });
        });

        function changeImage(imageUrl) {
            document.getElementById('mainImage').src = imageUrl;
        }

        function calculateTotal() {
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const pricePerDay = parseFloat(document.getElementById('item_price').value);

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const timeDiff = Math.abs(end - start);
                const totalDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;

                if (!isNaN(totalDays) && totalDays > 0) {
                    const totalPrice = totalDays * pricePerDay;
                    document.getElementById('totalDays').innerText = totalDays;
                    document.getElementById('totalPrice').innerText = totalPrice.toLocaleString();
                    document.getElementById('total_price').value = totalPrice; // Mettre à jour le champ caché
                } else {
                    document.getElementById('totalDays').innerText = 0;
                    document.getElementById('totalPrice').innerText = 0;
                    document.getElementById('total_price').value = 0; // Mettre à jour le champ caché
                }
            } else {
                document.getElementById('totalDays').innerText = 0;
                document.getElementById('totalPrice').innerText = 0;
                document.getElementById('total_price').value = 0; // Mettre à jour le champ caché
            }
        }
    </script>
</body>
</html>
