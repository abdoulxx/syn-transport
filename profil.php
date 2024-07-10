<?php
session_start();
include('cnx.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_profile'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $adresse = $_POST['adresse'];

        $sql = "UPDATE users SET nom = ?, email = ?, numero = ?, adresse = ? WHERE id = ?";
        $stmt = $cnx->prepare($sql);
        $stmt->execute([$name, $email, $tel, $adresse, $user_id]);

        $success_message = "Profil mis à jour avec succès.";
    } elseif (isset($_POST['update_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        $sql = "SELECT mot_de_passe FROM users WHERE id = ?";
        $stmt = $cnx->prepare($sql);
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        if (password_verify($old_password, $user['mot_de_passe'])) {
            if ($new_password === $confirm_password) {
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET mot_de_passe = ? WHERE id = ?";
                $stmt = $cnx->prepare($sql);
                $stmt->execute([$new_password_hashed, $user_id]);

                $success_message = "Mot de passe mis à jour avec succès.";
            } else {
                $error_message = "Le nouveau mot de passe et la confirmation ne correspondent pas.";
            }
        } else {
            $error_message = "L'ancien mot de passe est incorrect.";
        }
    }
}

$sql = "SELECT nom, email, numero, adresse FROM users WHERE id = ?";
$stmt = $cnx->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil - SYN Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .hidden-section {
            display: none;
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
                        <a class="nav-link" href="apropos.php">À propos</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item bonjour">
                            <span class="navbar-text text-white me-3">Bienvenue, <?php echo $_SESSION['nom']; ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="profil.php">
                                <i class="fas fa-user" style="font-size:18px"></i> Mon profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="reservations.php">
                                <i class="fas fa-calendar-check" style="font-size:18px"></i> Mes réservations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="deconnexion.php">
                                <i class="fas fa-sign-out-alt" style="font-size:18px"></i> Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <style>
                    .bonjour {
                        position: relative;
                        top: 7px;
                    }
                </style>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-md-3">
    <div class="list-group">
        <a href="#" id="showProfile" class="list-group-item list-group-item-action custom-btn active">Modifier mes informations</a>
        <a href="#" id="showPassword" class="list-group-item list-group-item-action custom-btn">Modifier mon mot de passe</a>
    </div>
</div>

<style>
  .custom-btn {
    margin-bottom: 20px; /* Adds spacing between buttons */
}




</style>

            <!-- Content Area -->
            <div class="col-md-9">
                <!-- Update Profile Section -->
                <div id="profileSection">
                    <h2>Modifier mes informations</h2>
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="profil.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo htmlspecialchars($user['nom']); ?>" value="<?php echo htmlspecialchars($user['nom']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo htmlspecialchars($user['email']); ?>" value="<?php echo htmlspecialchars($user['email']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label">Numéro</label>
                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="<?php echo htmlspecialchars($user['numero']); ?>" value="<?php echo htmlspecialchars($user['numero']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="<?php echo htmlspecialchars($user['adresse']); ?>" value="<?php echo htmlspecialchars($user['adresse']); ?>">
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>

                <!-- Update Password Section -->
                <div id="passwordSection" class="hidden-section">
                    <h2>Modifier mon mot de passe</h2>
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error_message; ?>
                        </div>
                    <?php elseif (isset($success_message) && !isset($_POST['update_profile'])): ?>
                        <div class="alert alert-success">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="profil.php" method="post">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Ancien mot de passe</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" name="update_password" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('showProfile').addEventListener('click', function() {
            document.getElementById('profileSection').classList.remove('hidden-section');
            document.getElementById('passwordSection').classList.add('hidden-section');
            this.classList.add('active');
            document.getElementById('showPassword').classList.remove('active');
        });

        document.getElementById('showPassword').addEventListener('click', function() {
            document.getElementById('passwordSection').classList.remove('hidden-section');
            document.getElementById('profileSection').classList.add('hidden-section');
            this.classList.add('active');
            document.getElementById('showProfile').classList.remove('active');
        });
    </script>
</body>
</html>
