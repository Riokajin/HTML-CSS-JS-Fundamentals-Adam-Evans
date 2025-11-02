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

    //If there's no errors, show the order
    if (empty($errors)) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
    }

}