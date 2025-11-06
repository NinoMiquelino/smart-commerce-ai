<?php
session_start();
require_once 'config/database.php';
require_once 'classes/Product.php';
require_once 'classes/RecommendationEngine.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$recommendationEngine = new RecommendationEngine($db);

// Get featured products
$stmt = $product->read();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get AI recommendations
$recommendations = $recommendationEngine->getRecommendations($_SESSION['user_id'] ?? null);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCommerce AI - E-commerce Inteligente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-indigo-600">SmartCommerce AI</h1>
                </div>
                <nav class="hidden md:flex space-x-6">
                    <a href="index.php" class="text-gray-700 hover:text-indigo-600">Início</a>
                    <a href="products.php" class="text-gray-700 hover:text-indigo-600">Produtos</a>
                    <a href="cart.php" class="text-gray-700 hover:text-indigo-600">
                        Carrinho (<span id="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?></span>)
                    </a>
                </nav>
                <div class="md:hidden">
                    <button class="text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-indigo-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Bem-vindo ao E-commerce Inteligente</h2>
            <p class="text-xl mb-8">Descubra produtos perfeitos para você com recomendações de IA</p>
            <a href="products.php" class="bg-white text-indigo-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Explorar Produtos
            </a>
        </div>
    </section>

    <!-- AI Recommendations -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Recomendados para Você</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <?php foreach ($recommendations as $product): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2"><?php echo $product['name']; ?></h3>
                        <p class="text-gray-600 text-sm mb-4"><?php echo substr($product['description'], 0, 60) . '...'; ?></p>
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-600 font-bold">R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></span>
                            <button onclick="addToCart(<?php echo $product['id']; ?>)" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition duration-300">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Produtos em Destaque</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach (array_slice($products, 0, 8) as $product): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2"><?php echo $product['name']; ?></h3>
                        <p class="text-gray-600 text-sm mb-4"><?php echo substr($product['description'], 0, 60) . '...'; ?></p>
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-600 font-bold">R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></span>
                            <button onclick="addToCart(<?php echo $product['id']; ?>)" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition duration-300">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <script src="assets/js/main.js"></script>
</body>
</html>