<?php
//Check if the form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    //Get the values the user typed into the form, remove any special characters and if no entry use an empty string
    $name = htmlspecialchars($_POST["name"] ?? "");
    $email = htmlspecialchars($_POST["email"] ?? "");
    $phone = htmlspecialchars($_POST["phone"] ?? "");

    //Get pizza choices
    $size = $_POST["size"] ?? "";
    $thickness = $_POST["thickness"] ?? "";
    $bake = $_POST["bake"] ?? "";
    $crustBase = $_POST["crustBase"] ?? "";
    $cheese = $_POST["cheese"] ?? "";

    //Get toppings and seasonings. If nothing was chosen use an empty array
    $toppings = $_POST["toppings"] ?? [];
    $seasonings = $_POST["seasonings"] ?? [];

    //Get pickup info
    $pickupOption = $_POST["pickup-option"] ?? "";
    $pickupTime = $_POST["pickup-time"] ?? "";

    //Get special instructions
    $notes = htmlspecialchars($_POST["notes"] ?? "");

    //Make a list of any errors
    $errors = [];

    //Check required fields to see if they're empty or invalid and inform the user of exactly what they missed
    if (empty($name)) $errors[] = "Name is missing.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email is missing or invalid.";//checks if email is empty OR invalid
    if (empty($phone)) $errors[] = "Phone number is missing.";
    if (empty($size)) $errors[] = "Size is not selected.";
    if (empty($thickness)) $errors[] = "Thickness is not selected.";
    if (empty($bake)) $errors[] = "Bake level is not selected.";
    if (empty($cheese)) $errors[] = "Cheese is not selected.";
    if ($pickupOption === "scheduled" && empty($pickupTime)) {
        $errors[] = "Pickup time is missing.";
    }

    //If there's no errors, show the order confirmation. Tifa's warm conversation style to show confirmation
    if (empty($errors)) {
        ?>
        <!DOCTYPE html> <!--wrapping the confirmation information in html to make it easier to style-->
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Pizza Order Confirmed</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body class="confirmation">
            <main>
                <h2> Limit Break: Pizza Order Confirmed</h2>
                <p>Hey, <?= htmlspecialchars($name) ?>.<!--php tags to show info verified in php--> your order’s been logged at Seventh Heaven.</p>
                <p>We’re already firing up the oven — this one’s gonna hit like a Meteor combo.</p>
                <ul>
                    <li><strong>Size:</strong> <?= $size ?></li>
                    <li><strong>Crust Thickness:</strong> <?= $thickness ?></li>
                    <li><strong>Bake Level:</strong> <?= $bake ?></li>
                    <li><strong>Crust Base:</strong> <?= $crustBase ?: "Standard" ?></li>
                    <li><strong>Cheese Materia:</strong> <?= $cheese ?></li>
                    <li><strong>Toppings Equipped:</strong>
                        <?= !empty($toppings) ? implode(", ", $toppings) : "None, simple and strong " ?>
                    </li>
                    <li><strong>Seasonings Applied:</strong>
                        <?= !empty($seasonings) ? implode(", ", $seasonings) : "None, we'll keep it classic" ?>
                    </li>
                    <li><strong>Pickup Strategy:</strong>
                        <?= ($pickupOption === "scheduled") ? "Ready for you at $pickupTime" : "We'll have it hot and ready ASAP" ?>
                    </li>
                    <li><strong>Mission Notes:</strong> <?= $notes ?: "No special requests. We'll trust our instincts." ?></li>
                </ul>

                <p>Thanks again. I'll make sure it's perfect. Just like old times.</p>
                <p class="signature"> Tifa</p>
            </main>
        </body>
    </html>
    <?php

    } else {
        //Show errors. Have Barret's rough and gruff style tell them they did something wrong. (unlikely to see this page unless something goes wrong)
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>ORDER INCOMPLETE</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body class="error-screen">
            <main>
                <h2>WHAT THE HELL, <?= htmlspecialchars($name) ?: "rookie" ?>?!</h2>
                <p>You tryin’ to send an incomplete order to the kitchen? We ain’t got time for half-baked missions!</p>

                <ul class="error-list">
                    <?php foreach ($errors as $error): ?>
                        <li><?= strtoupper($error) ?></li>
                    <?php endforeach; ?>
                </ul>

                <p>Fix it. Fast. Tifa’s waitin’ and the oven’s already fired up.</p>
                <p><a href="javascript:history.back()">Go back and do it right this time</a></p>
                <p class="signature"> Barret</p>
            </main>
        </body>
        </html>
        <?php
    }

}