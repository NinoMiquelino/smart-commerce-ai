<?php
session_start();
require_once '../config/database.php';
require_once '../classes/Cart.php';
require_once '../classes/UserBehavior.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? null;
$quantity = $data['quantity'] ?? 1;

if ($product_id) {
    $cart = new Cart();
    $cart->add($product_id, $quantity);
    
    // Track user behavior
    $database = new Database();
    $db = $database->getConnection();
    $userBehavior = new UserBehavior($db);
    $userBehavior->trackAddToCart($product_id, $_SESSION['user_id'] ?? null);
    
    echo json_encode([
        'success' => true,
        'total_items' => $cart->getTotalItems()
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Product ID is required'
    ]);
}
?>