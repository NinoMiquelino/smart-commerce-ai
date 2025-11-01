<?php
// api/recommendations.php
include '../includes/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Obtém histórico do usuário para recomendações
    $userHistory = [];
    
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("
            SELECT product_id, action 
            FROM user_behavior 
            WHERE user_id = ? 
            ORDER BY created_at DESC 
            LIMIT 10
        ");
        $stmt->execute([$_SESSION['user_id']]);
        $userHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Se não há histórico suficiente, mostra produtos populares
    if (count($userHistory) < 3) {
        $stmt = $pdo->prepare("
            SELECT p.*, COUNT(ub.id) as views
            FROM products p
            LEFT JOIN user_behavior ub ON p.id = ub.product_id
            WHERE ub.action = 'view'
            GROUP BY p.id
            ORDER BY views DESC
            LIMIT 6
        ");
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Usa IA para recomendações personalizadas
        $recommendedIds = getAIRecommendations($userHistory);
        
        if (!empty($recommendedIds)) {
            $placeholders = str_repeat('?,', count($recommendedIds) - 1) . '?';
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
            $stmt->execute($recommendedIds);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $products = [];
        }
    }
    
    echo json_encode($products);
    
} elseif ($method === 'POST') {
    // Registra comportamento do usuário
    $data = json_decode(file_get_contents('php://input'), true);
    
    $userId = $_SESSION['user_id'] ?? null;
    $productId = $data['product_id'];
    $action = $data['action'];
    
    $stmt = $pdo->prepare("
        INSERT INTO user_behavior (user_id, product_id, action) 
        VALUES (?, ?, ?)
    ");
    $stmt->execute([$userId, $productId, $action]);
    
    echo json_encode(['success' => true]);
}
?>