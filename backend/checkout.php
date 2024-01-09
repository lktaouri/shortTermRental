<?php
include 'db/conn.php';
require "../vendor/autoload.php";

$stripe_secret_key = "sk_test_51OAYItKu6zNIBVrcw0v4AQHEzyC9YnXmP924BS5bN0ghoLAeSn8o8MGcx64tslI975nWycYnBV6e4wYKbUtiPKtm00UDXB6ZVI";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$flat_id = $_GET['flat_id']; 
$start_date = new DateTime($_GET['start_date']); 
$end_date = new DateTime($_GET['end_date']); 

// Calculate the difference in days
$interval = $start_date->diff($end_date);
$days = $interval->days;

try {
    $query = "SELECT name, price FROM flats WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$flat_id]);
    $flat = $stmt->fetch();

    // Throw an exception if the flat doesn't exist
    if (!$flat) {
        throw new Exception("Flat with ID $flat_id not found.");
    }

    $product_name = "Flat Rental: " . $flat['name'];
    // Calculate the total amount
    $amount = $flat['price'] * $days * 100; // Stripe requires the amount in cents

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/shortTermRental/frontend/index.php",
        "cancel_url" => "http://localhost/shortTermRental/frontend/cancel.php",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "eur",
                    "unit_amount" => $amount,
                    "product_data" => [
                        "name" => $product_name . " for $days days"
                    ],
                ],
            ],
        ],
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
    exit;
} catch (Exception $e) {
    // Handle error appropriately
    http_response_code(500);
    echo "Error: " . $e->getMessage();
    exit;
}
?>
