<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYN Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Top Info Bar with Logo and Contact Info -->
    <div class="top-info-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="Logo" class="logo">
            </a>
            <div class="contact-info">
                <p class="me-3"><i class="fa fa-phone" aria-hidden="true"></i> +225 01 51 51 60 84</p>
                <p class="me-3"><i class="fab fa-facebook"></i> syn_transport</p>
                <p class="me-3"><i class="fab fa-instagram"></i> syn_transport</p>
                <p class="me-3"><i class="fab fa-twitter"></i> syn_transport</p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i> contact@syn_transport.com</p>
            </div>
        </div>
    </div>

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


    <!-- Full Screen Image with Captivating Text -->
    <div class="full-screen-image"></div>
    <style>
        .full-screen-image {
    position: relative;
    height: 78vh;
    background-image: url('images/home6.jpg'); /* Replace with your image path */
    background-size: cover;
    background-position: center;
}
    </style>

    <!-- About Us Section -->
    <section class="about-section">
        <div class="container info-section">
            <div class="row">
                <div class="col-md-4 info-box">
                    <i class="fas fa-clock"></i>
                    <h4>livraison expresse</h4>
                    <p>Livraison immediate directement chez vous</p>
                </div>
                <div class="col-md-4 info-box">
                    <i class="fas fa-car"></i>
                    <h4>Flotte unique</h4>
                    <p>Des cabriolets haut de gamme aux SUV premium</p>
                </div>
                <div class="col-md-4 info-box">
                    <i class="fas fa-heart"></i>
                    <h4>Service exceptionnel</h4>
                    <p>Sans stress, fiable, sans coûts cachés</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rent Section -->
    <section class="card-section">
    <div class="container">
        <h2 class="text-center mb-5">Véhicules à Louer</h2>
        <div class="card-container mt-4">
        <div class="card mt-6">
            <div class="position-relative">
                <div class="fuel-type">Petrol</div>
                <img src="images/misti.png" class="card-img-top" alt="Mitsubishi">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Mitsubishi</h5>
                <div class="icons">
                    <div><i class="fas fa-user-friends"></i> <span>4 places</span></div>
                    <div><i class="fas fa-cogs"></i> <span>Manuel</span></div>
                    <div><i class="fas fa-tachometer-alt"></i> <span>20Km/h</span></div>
                </div>
                <p class="price">À partir de 55.000fr/Jour</p>
            </div>
            <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-primary">voir plus</button>
            </div>
        </div>
        <div class="card">
            <div class="position-relative">
                <div class="fuel-type">diesel</div>
                <img src="images/audi.png" class="card-img-top" alt="Mitsubishi">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Audi</h5>
                <div class="icons">
                    <div><i class="fas fa-user-friends"></i> <span>5 places</span></div>
                    <div><i class="fas fa-cogs"></i> <span>auto</span></div>
                    <div><i class="fas fa-tachometer-alt"></i> <span>2Km/h</span></div>
                </div>
                <p class="price">À partir de 30.000fr/Jour</p>
            </div>
            <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-primary">voir plus</button>
            </div>
        </div>
        <div class="card">
            <div class="position-relative">
                <div class="fuel-type">Diesel</div>
                <img src="images/jeep.png" class="card-img-top" alt="Jeep">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Jeep</h5>
                <div class="icons">
                    <div><i class="fas fa-user-friends"></i> <span>4 places</span></div>
                    <div><i class="fas fa-cogs"></i> <span>manuel</span></div>
                    <div><i class="fas fa-tachometer-alt"></i> <span>5Km/h</span></div>
                </div>
                <p class="price">À partir de 20.000fr/Jour</p>
            </div>
            <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-primary">voir plus</button>
            </div>
        </div>
    </div>
</div>
        <!-- Voir Plus Button -->
        <div class="text-center mt-4">
        <a href="louer.php" class="btn btn-outline-custom btn-lg">Louer Maintenant</a>
        </div>
    </div>
</section>
<style>
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
    <section>
        <section class="card-section">
            <div class="container">
                <h2 class="text-center mb-5">Véhicules à Acheter</h2>
                <div class="card-container mt-4">
        <div class="card mt-6">
            <div class="position-relative">
                <div class="fuel-type">Petrol</div>
                <img src="images/merco.png" class="card-img-top" alt="Mitsubishi">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">Mercedes c300</h5>
                <div class="icons">
                    <div><i class="fas fa-user-friends"></i> <span>4 places</span></div>
                    <div><i class="fas fa-cogs"></i> <span>Manuel</span></div>
                    <div><i class="fas fa-tachometer-alt"></i> <span>20Km/h</span></div>
                </div>
                <p class="price">À partir de 20.000.000fr</p>
            </div>
            <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-outline-custom">voir plus</button>
            </div>
        </div>
        <div class="card">
            <div class="position-relative">
                <div class="fuel-type">diesel</div>
                <img src="images/tucson.png" class="card-img-top" alt="Mitsubishi">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">tucson 2021</h5>
                <div class="icons">
                    <div><i class="fas fa-user-friends"></i> <span>5 places</span></div>
                    <div><i class="fas fa-cogs"></i> <span>auto</span></div>
                    <div><i class="fas fa-tachometer-alt"></i> <span>2Km/h</span></div>
                </div>
                <p class="price">À partir de 30.000.000fr</p>
            </div>
            <div class="card-footer d-flex justify-content-around">
            <button class="btn btn-outline-custom">voir plus</button>
            </div>
        </div>
        <div class="card">
            <div class="position-relative">
                <div class="fuel-type">Diesel</div>
                <img src="images/elantra.png" class="card-img-top" alt="Jeep">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">elantra 2020</h5>
                <div class="icons">
                    <div><i class="fas fa-user-friends"></i> <span>4 places</span></div>
                    <div><i class="fas fa-cogs"></i> <span>manuel</span></div>
                    <div><i class="fas fa-tachometer-alt"></i> <span>5Km/h</span></div>
                </div>
                <p class="price">À partir de 25.000.000fr</p>
            </div>
            <div class="card-footer d-flex justify-content-around">
            <button class="btn btn-outline-custom">voir plus</button>
            </div>
        </div>
    </div>
</div>
<div class="text-center mt-4">
        <a href="acheter.php" class="btn btn-outline-custom btn-lg">Acheter Maintenant</a>
        </div>
    </div>
        </section>
    </section>
    <section>
        <div class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                            <h4>20+</h4>
                            <p>Ans d'activité</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat">
                            <i class="fas fa-car fa-2x"></i>
                            <h4>500+</h4>
                            <p>Voitures neuves à vendre </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat">
                            <i class="fas fa-car-side fa-2x"></i>
                            <h4>1000+</h4>
                            <p>Voitures pour la location</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat">
                            <i class="fas fa-users fa-2x"></i>
                            <h4>600+</h4>
                            <p>Clients satisfaits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <section class="testimonials-section">
        <div class="container">
            <h2 class="text-center mb-5">Témoignages de nos clients</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial text-center">
                        <img src="images/logo.png" alt="Client 1">
                        <p>Le service était excellent, la voiture était en parfait état et le personnel était très serviable. Je recommande vivement!</p>
                        <div class="testimonial-author">kouassi marie</div>
                        <div class="testimonial-role">Client satisfait</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial text-center">
                        <img src="images/logo.png" alt="Client 2">
                        <p>Une expérience de location sans stress, avec des tarifs transparents et un personnel amical.</p>
                        <div class="testimonial-author">kone astou</div>
                        <div class="testimonial-role">Client satisfait</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial text-center">
                        <img src="images/logo.png" alt="Client 3">
                        <p>J'ai loué un véhicule pour un voyage d'affaires et tout s'est passé sans accroc. Merci pour le service exceptionnel!</p>
                        <div class="testimonial-author">traore moussa</div>
                        <div class="testimonial-role">Client satisfait</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>Contactez-nous</h4>
                <p><i class="fa fa-map-marker" aria-hidden="true"></i> Adresse: Marcory injs, Abidjan, Côte d'Ivoire</p>
                <p><i class="fa fa-phone" aria-hidden="true"></i> Téléphone: +225 01 51 51 60 84</p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i> Email: contact@syn_transport.com</p>
            </div>
            <div class="col-md-4">
                <h4>Méthodes de paiement</h4>
                <ul class="footer-links">
                    <li><img src="images/wave.png" alt="Méthode de paiement 1" class="payment-icon"></li>
                    <li><img src="images/orange.png" alt="Méthode de paiement 2" class="payment-icon"></li>
                    <li><img src="images/mtn.png" alt="Méthode de paiement 3" class="payment-icon"></li>
                    <li><img src="images/moov.png" alt="Méthode de paiement 4" class="payment-icon"></li>
                    <li><img src="images/visa.png" alt="Méthode de paiement 5" class="payment-icon"></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Suivez-nous</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/abdoul.x/"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom mt-3">
        <p>&copy; 2024 Syn Transport. Tous droits réservés.</p>
    </div>
</footer>

    <style>
        body, html {
    height: 100%;
    margin: 0;
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

.full-screen-text {
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 10px;
}
.full-screen-text h1 {
    font-size: 3em;
    margin-bottom: 20px;
}
.full-screen-text p {
    font-size: 1.5em;
}
.info-section {
    padding: 50px 0;
    text-align: center;
}
.info-section .info-box {
    margin-bottom: 30px;
}
.info-section .info-box i {
    font-size: 2em;
    margin-bottom: 10px;
}
.info-section .info-box h4 {
    font-weight: bold;
    margin-bottom: 10px;
}
.info-section .info-box p {
    margin: 0;
}

.stats-section {
    background-image: url('images/home6.jpg'); /* Replace with your background image */
    background-size: cover;
    background-attachment: fixed;
    color: #fff;
    padding: 50px 0;
    text-align: center;
}
.stats-section .stat {
    background-color: rgba(255, 17, 0, 0.8);
    border-radius: 50%;
    width: 150px;
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 20px auto;
    color: #fff;
}
.stats-section .stat h4, .stats-section .stat p {
    margin: 0;
    padding: 0;
}
.testimonials-section {
    padding: 50px 0;
    background-color: #f8f9fa;
}
.testimonial {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.testimonial:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
}
.testimonial img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
    margin-bottom: 15px;
}
.testimonial .testimonial-author {
    margin-top: 15px;
    font-weight: bold;
    font-size: 1.2em;
}
.testimonial .testimonial-role {
    color: #777;
    font-size: 0.9em;
}
.footer {
    background-color: #000;
    color: #ffffff;
    padding: 40px 0;
}

.footer a {
    color: #ffffff;
    text-decoration: none;
}

.footer a:hover {
    color: #ff1100;
}

.footer .footer-links {
    list-style: none;
    padding: 0;
}

.footer .footer-links li {
    display: inline-block;
    margin: 0 10px;
}

.footer .payment-icon {
    width: 50px;
}

.footer .social-icons a {
    margin: 0 10px;
    color: #ffffff;
    font-size: 1.5em;
}

.footer .social-icons a:hover {
    color: #ff1100;
}

.footer-bottom {
    border-top: 1px solid #474e54;
    padding-top: 20px;
    text-align: center;
}

    </style>

    <style>
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
    </style>