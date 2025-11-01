<?php
// index.php
include 'includes/config.php';
include 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCommerce - Loja Inteligente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-robot"></i> SmartCommerce
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="cart.php">
                    <i class="fas fa-shopping-cart"></i> Carrinho
                    <span class="badge bg-primary" id="cart-count">0</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <!-- Produtos em Destaque -->
        <section class="mb-5">
            <h2 class="mb-4">Produtos em Destaque</h2>
            <div class="row" id="featured-products">
                <!-- Produtos carregados via JavaScript -->
            </div>
        </section>

        <!-- Recomendações Personalizadas -->
        <section class="mb-5">
            <h2 class="mb-4">
                <i class="fas fa-magic"></i> Recomendados para Você
            </h2>
            <div class="row" id="recommended-products">
                <!-- Recomendações carregadas via JavaScript -->
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Carrega produtos ao iniciar
        document.addEventListener('DOMContentLoaded', function() {
            loadFeaturedProducts();
            loadRecommendedProducts();
            updateCartCount();
        });
    </script>
</body>
</html>