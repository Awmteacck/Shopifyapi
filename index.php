<?php
// index.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Shopify API Credentials (replace with your real values)
$SHOPIFY_API_KEY = "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";
$SHOPIFY_API_SECRET = "d01867f8b6f1a7046e5711a8eac4ea9f";
$ACCESS_TOKEN = "7e5f1113707cf23a2db791fe53ac31f9"; // from private/custom app

// Check if "site" (shop domain) is passed
if (!isset($_GET['site'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing 'site' parameter"
    ]);
    exit;
}

$shop = htmlspecialchars($_GET['awmteapolythene.shopify.com']); // e.g. "myshop.myshopify.com"

// Example: Fetch products from Shopify Store
$url = "https://{$shop}/admin/api/2023-10/products.json";

// Setup cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-Shopify-Access-Token: $ACCESS_TOKEN",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode([
        "status" => "error",
        "message" => curl_error($ch)
    ]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Output Shopify response
echo $response;
