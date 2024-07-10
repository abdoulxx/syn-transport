<?php
include('cnx.php');
session_start();

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire en utilisant filter_input pour nettoyer les entrées
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    try {
        // Préparer la requête SQL avec un placeholder pour l'email
        $sql = "SELECT id, nom, mot_de_passe FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Vérifier si l'utilisateur existe
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Vérifier le mot de passe
            if (password_verify($password, $user['mot_de_passe'])) {
                // Démarrer la session et enregistrer les informations de l'utilisateur
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['login'] = $email; // Stocker l'email de l'utilisateur
                $_SESSION['nom'] = $user['nom'];
                // Rediriger vers la page louer.php après 1 seconde
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 1000);
                      </script>";
                $success_message = "Connexion réussie. Redirection en cours...";
            } else {
                $error_message = "Mot de passe incorrect.";
            }
        } else {
            $error_message = "Aucun utilisateur trouvé avec cet email.";
        }
    } catch (PDOException $e) {
        $error_message = "Erreur: " . $e->getMessage();
    }

    // Fermer la connexion
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SYN Transport</title>
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
                        <a class="nav-link" href="#">Louer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Acheter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">A propos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content (e.g., Connexion Form) -->
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-lg">
            <div class="row g-0">
                <!-- Logo Section -->
                <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center logo-section">
                    <img src="images/logo.png" alt="SYN Transport Logo" class="logo">
                </div>
                <!-- Form Section -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center form-section">
                    <div class="form-container">
                        <h2>Connexion</h2>
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error_message); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($success_message)): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo htmlspecialchars($success_message); ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>
                        <p class="mt-3">Pas de compte? <a href="inscription.php" class="text-primary">S'inscrire</a></p>
                    </div>
                </div>
            </div>
        </div>
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

    /* Logo Section */
    .logo-section {
        text-align: center;
    }

    .logo-section .logo {
        max-width: 80%;
        height: auto;
    }

    /* Form Section */
    .form-section {
        background-color: #fff;
        padding: 40px;
    }

    .form-container {
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .form-container h2 {
        margin-bottom: 30px;
        color: #333;
    }

    .form-container .form-control {
        border-radius: 20px;
        padding: 10px 20px;
    }

    .form-container .btn-primary {
        background-color: #ff1100d8;
        border-color: #ff1100d8;
        border-radius: 20px;
        padding: 10px 20px;
    }

    .form-container .btn-primary:hover {
        background-color: #ff1100e0;
        border-color: #ff1100e0;
    }

    .form-container p {
        margin-top: 20px;
    }

    .form-container p a {
        color: #ff1100d8;
    }

    .form-container p a:hover {
        color: #ff1100e0;
    }
</style>
