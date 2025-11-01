<?php
// api/products.php
include '../includes/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $featured = isset($_GET['featured']) ? $_GET['featured'] : false;
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    
    $sql = "SELECT * FROM products WHERE 1=1";
    
    if ($featured) {
        $sql .= " AND featured = 1";
    }
    
    if ($category) {
        $sql .= " AND category_id = :category";
    }
    
    $sql .= " ORDER BY created_at DESC LIMIT 12";
    
    $stmt = $pdo->prepare($sql);
    
    if ($category) {
        $stmt->bindParam(':category', $category);
    }
    
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($products);
}
?>