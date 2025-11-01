<?php
// cart.php
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - SmartCommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-robot"></i> SmartCommerce
            </a>
        </div>
    </nav>

    <div class="container my-4">
        <h1 class="mb-4">
            <i class="fas fa-shopping-cart"></i> Meu Carrinho
        </h1>
        
        <div id="cart-content">
            <!-- Conteúdo do carrinho carregado via JavaScript -->
        </div>
        
        <div class="row mt-4">
            <div class="col-md-8">
                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Continuar Comprando
                </a>
            </div>
            <div class="col-md-4 text-end">
                <div class="card">
                    <div class="card-body">
                        <h5>Total: <span id="cart-total">R$ 0,00</span></h5>
                        <a href="checkout.php" class="btn btn-primary btn-lg w-100" id="checkout-btn">
                            <i class="fas fa-credit-card"></i> Finalizar Compra
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/cart.js"></script>
</body>
</html>