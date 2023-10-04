<?php
$errors = [];

// TODO 3 - Get the data from the form and check for errors
if (isset($_POST['companyName']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contactMessage']) && isset($_POST['contactName'])) {
    $companyName = htmlentities($_POST['companyName']);
    $name = htmlentities($_POST['name']);
    $email =  htmlentities($_POST['email']);
    $contactMessage = htmlentities($_POST['contactMessage']);
    $contactName = htmlentities($_POST['contactName']);

    if (empty($companyName)) {
        $errors[] = 'CompanyName is require !';
    }
    if (empty($name)) {
        $errors[] = 'Name is require !';
    }
    if (empty($email)) {
        $errors[] = 'email is require !';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email filed must be an EMAIL ! ';
    }
    if (strlen($contactMessage) < 30) {
        $errors[] = 'Message too short (minimum 30 char) !';
    }


    $contactTab = [
        ['name' => 'andy', 'img' => 'andy.webp'],
        ['name' => 'dwight', 'img' => 'dwight.webp'],
        ['name' => 'jim', 'img' => 'jim.webp'],
        ['name' => 'phyllis', 'img' => 'phyllis.webp'],
        ['name' => 'stanley', 'img' => 'stanley.webp']
    ];

    foreach ($contactTab as $row) {
        if ($row['name'] === $contactName) {
            $contactImage = $row['img'];
            break;
        }
    }

    if (empty($contactImage)) {
        $errors[] = 'Contact not found ... ';
    }

} else {
    $errors[] = 'Invalid form !';
//    array_push($errors, 'Invalid form !');
}

if (!empty($errors)) {
    require 'error.php';
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif - Réclamation</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
    <h1>Nous traitons votre retour.</h1>
    <img src="images/logo_dunder.png" alt="Logo Dunder Mifflin">
</header>

<main>
    <div class="summary">
        <!-- BONUS -->
        <p>
            <img src="images/<?= $contactImage ?>" alt="">
            <span>Votre vendeur</span>
        </p>


        <!-- TODO 2 - Replace those placeholders by the values sent from the form -->
        <ul>
            <li>Votre entreprise : <span><?= $companyName ?></span></li>
            <li>Votre nom : <span><?= $name ?></span></li>
            <li>Votre email : <span><?= $email ?></span></li>
            <li>Votre message :
                <p><?= $contactMessage ?></p>
            </li>
        </ul>
    </div>
</main>
</body>

</html>