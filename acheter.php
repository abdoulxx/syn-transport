<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Louer - SYN Transport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">    <link rel="stylesheet" href="styles.css">
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
        <h2 class="text-center mt-4">Voitures disponibles pour la location</h2>

        <div class="card-container mt-4">
            <!-- Car Card 1 -->
            <div class="card mt-6">
                <div class="position-relative">
                    <div class="fuel-type">Essence</div>
                    <img src="images/merco.png" class="card-img-top" alt="Car 1">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Toyota Yaris</h5>
                    <div class="icons">
                        <div><i class="fas fa-user-friends"></i> <span>5 places</span></div>
                        <div><i class="fas fa-cogs"></i> <span>Automatique</span></div>
                        <div><i class="fas fa-tachometer-alt"></i> <span>6L/100km</span></div>
                    </div>
                    <p class="price">À partir de 45.000.000</p>
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <button class="btn btn-outline-custom" onclick="window.location.href='recap.php?id=1'">reserver un essaie</button>
                </div>
            </div>

            <div class="card-container mt-4">
            <!-- Car Card 1 -->
            <div class="card mt-6">
                <div class="position-relative">
                    <div class="fuel-type">Essence</div>
                    <img src="images/elantra.png" class="card-img-top" alt="Car 1">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Toyota Yaris</h5>
                    <div class="icons">
                        <div><i class="fas fa-user-friends"></i> <span>5 places</span></div>
                        <div><i class="fas fa-cogs"></i> <span>Automatique</span></div>
                        <div><i class="fas fa-tachometer-alt"></i> <span>6L/100km</span></div>
                    </div>
                    <p class="price">À partir de 20.000.000</p>
                </div>
                <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-outline-custom" onclick="window.location.href='recap.php?id=1'">reserver un essaie</button>
                </div>
            </div>

            <div class="card-container mt-4">
            <!-- Car Card 1 -->
            <div class="card mt-6">
                <div class="position-relative">
                    <div class="fuel-type">Essence</div>
                    <img src="images/tucson.png" class="card-img-top" alt="Car 1">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Toyota Yaris</h5>
                    <div class="icons">
                        <div><i class="fas fa-user-friends"></i> <span>5 places</span></div>
                        <div><i class="fas fa-cogs"></i> <span>Automatique</span></div>
                        <div><i class="fas fa-tachometer-alt"></i> <span>6L/100km</span></div>
                    </div>
                    <p class="price">À partir de 30.000.000</p>
                </div>
                <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-outline-custom" onclick="window.location.href='recap.php?id=1'">reserver un essaie</button>
                </div>
            </div>
            <!-- Add more car cards as needed -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

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
