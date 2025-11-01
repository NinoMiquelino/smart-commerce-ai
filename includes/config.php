<?php
// includes/config.php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'smart_ecommerce');
define('DB_USER', 'root');
define('DB_PASS', '');
define('OPENAI_API_KEY', 'sk-sua-chave-api-aqui');

// Conexão com o banco
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Função para obter recomendações da IA
function getAIRecommendations($userHistory, $currentProduct = null) {
    $prompt = "Baseado no histórico de produtos: " . json_encode($userHistory);
    
    if ($currentProduct) {
        $prompt .= " e no produto atual: " . json_encode($currentProduct);
    }
    
    $prompt .= " Sugira 3 produtos relacionados que o usuário pode gostar. 
                Retorne apenas um JSON array com os IDs dos produtos recomendados.";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            [
                'role' => 'user',
                'content' => $prompt
            ]
        ],
        'max_tokens' => 150,
        'temperature' => 0.7
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . OPENAI_API_KEY
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        $content = $data['choices'][0]['message']['content'];
        
        // Extrai JSON da resposta
        preg_match('/\[.*\]/', $content, $matches);
        if (!empty($matches)) {
            return json_decode($matches[0], true);
        }
    }
    
    return [];
}
?>