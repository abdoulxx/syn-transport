<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

function post($url, $data = [], $header = []) {
    $strPostField = http_build_query($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $strPostField);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, [
        'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
        'Content-Length: ' . mb_strlen($strPostField)
    ]));
    return curl_exec($ch);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $api_key = 'aa5d5ac81f0825ae4db58420da692f68db6914ff5c286296fc5c81fc11cf4c5b';
    $api_secret = '36d3f49bc8133e5f1915519db88d80cea91b6f164f53eee853784b7899279330';

    $mode_paiement = $_POST['payment_method'];
    $voiture_id = $_POST['voiture_id'];
    $client_id = $_SESSION['user_id'];
    $date_debut = $_POST['start_date'];
    $date_fin = $_POST['end_date'];
    $nombre_jours = (new DateTime($date_fin))->diff(new DateTime($date_debut))->days + 1;
    $prix_total = $_POST['total_price'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "syn";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    if ($mode_paiement == 'cash') {
        // Insérer la commande dans la base de données
        $sql = "INSERT INTO commande (voiture_id, client_id, date_debut, date_fin, nombre_jours, prix_total, mode_paiement, statut)
                VALUES ('$voiture_id', '$client_id', '$date_debut', '$date_fin', '$nombre_jours', '$prix_total', '$mode_paiement', 'valide')";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Erreur: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } elseif ($mode_paiement == 'mobile_money') {
        $postFields = [
            "item_name" => $_POST['item_name'],
            "item_price" => $_POST['total_price'],
            "currency" => "XOF",
            "ref_command" => $_POST['ref_command'],
            "command_name" => $_POST['command_name'],
            "env" => "test",
            "success_url" => "https://votre_site.com/success",
            "ipn_url" => "https://votre_site.com/ipn",
            "cancel_url" => "https://votre_site.com/cancel",
        ];

        $jsonResponse = post('https://paytech.sn/api/payment/request-payment', $postFields, [
            "API_KEY: $api_key",
            "API_SECRET: $api_secret"
        ]);

        $response = json_decode($jsonResponse, true);
        if ($response['success'] == 1) {
            // Rediriger vers la page de paiement
            header('Location: ' . $response['redirect_url']);
            exit();
        } else {
            echo "Erreur de paiement";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Commande</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .message {
            text-align: center;
            color: green;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="message">
        Félicitations, votre commande a été effectuée avec succès.
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'reservations.php';
        }, 2000); // Rediriger vers reservations.php après 2 secondes
    </script>
</body>
</html>

