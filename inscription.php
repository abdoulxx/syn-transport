<?php
include('cnx.php');
$success_message='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe

    try {
        // Préparer la requête SQL
        $sql = "INSERT INTO users (nom, email, numero, adresse, mot_de_passe) VALUES (:name, :email, :tel, :adresse, :password)";
        $stmt = $conn->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':password', $password);

        // Exécuter la requête
        if ($stmt->execute()) {
            $success_message = "Nouvel utilisateur ajouté avec succès.";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'connexion.php';
                    }, 3000);
                  </script>";
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur.";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }

    // Fermer la connexion
    $conn = null;
}
?>



<!DOCTYPE html>
<html lang="en">
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
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Louer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acheter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">À propos</a>
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
                        <h2>Inscription</h2>
                        <?php if ($success_message): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>
                        <form action="inscription.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email">
                            </div>
                            <div class="mb-3">
                        <label for="tel" class="form-label">Numéro</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="images/flag-cote-divoire.png" alt="Côte d'Ivoire" style="width: 20px;">
                            </span>
                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Votre numéro" aria-label="Numéro" aria-describedby="basic-addon1">
                        </div>
                    </div>
                            <div class="mb-3">
                                <label for="adresse" class="form-label">adresse</label>
                                <input type="adresse" class="form-control" id="adresse" name="adresse" placeholder="ex: marcory,injs">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
                            </div>
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </form>
                        <p class="mt-3">Déjà inscrit? <a href="connexion.php" class="text-primary">Se connecter</a></p>
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