<?php
echo '
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement accepte</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .message {
            text-align: center;
            font-size: 24px;
            color: #00ff00;
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 2000);
    </script>
</head>
<body>
    <div class="message">
       Felicitation Paiement reussi !
    </div>
</body>
</html>
';
?>

















