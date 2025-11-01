// assets/js/main.js
class EcommerceApp {
    constructor() {
        this.apiBase = window.location.origin + '/smart-ecommerce/api';
        this.cart = this.loadCartFromStorage();
    }

    // Carrega produtos em destaque
    async loadFeaturedProducts() {
        try {
            const response = await fetch(`${this.apiBase}/products.php?featured=true`);
            const products = await response.json();
            
            const container = document.getElementById('featured-products');
            container.innerHTML = products.map(product => this.createProductCard(product)).join('');
        } catch (error) {
            console.error('Erro ao carregar produtos:', error);
        }
    }

    // Carrega recomendações personalizadas
    async loadRecommendedProducts() {
        try {
            const response = await fetch(`${this.apiBase}/recommendations.php`);
            const products = await response.json();
            
            const container = document.getElementById('recommended-products');
            if (products.length > 0) {
                container.innerHTML = products.map(product => this.createProductCard(product)).join('');
            } else {
                container.innerHTML = '<p class="text-muted">Navegue pelos produtos para receber recomendações personalizadas.</p>';
            }
        } catch (error) {
            console.error('Erro ao carregar recomendações:', error);
        }
    }

    // Cria card do produto
    createProductCard(product) {
        return `
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 product-card">
                    <img src="${product.image_url || 'assets/images/placeholder.jpg'}" 
                         class="card-img-top" alt="${product.name}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text flex-grow-1">${product.description.substring(0, 100)}...</p>
                        <div class="mt-auto">
                            <p class="h5 text-primary">R$ ${parseFloat(product.price).toFixed(2)}</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary btn-sm" 
                                        onclick="ecommerceApp.viewProduct(${product.id})">
                                    <i class="fas fa-eye"></i> Ver Detalhes
                                </button>
                                <button class="btn btn-primary btn-sm" 
                                        onclick="ecommerceApp.addToCart(${product.id})">
                                    <i class="fas fa-cart-plus"></i> Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Adiciona produto ao carrinho
    async addToCart(productId) {
        try {
            const response = await fetch(`${this.apiBase}/cart.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            });

            const result = await response.json();
            
            if (result.success) {
                this.showAlert('Produto adicionado ao carrinho!', 'success');
                this.updateCartCount();
                
                // Registra comportamento para recomendações
                this.recordUserBehavior(productId, 'add_to_cart');
            } else {
                this.showAlert('Erro ao adicionar produto: ' + result.message, 'danger');
            }
        } catch (error) {
            console.error('Erro ao adicionar ao carrinho:', error);
            this.showAlert('Erro ao adicionar produto', 'danger');
        }
    }

    // Visualiza produto
    viewProduct(productId) {
        window.location.href = `product-detail.php?id=${productId}`;
        
        // Registra visualização para recomendações
        this.recordUserBehavior(productId, 'view');
    }

    // Registra comportamento do usuário
    async recordUserBehavior(productId, action) {
        try {
            await fetch(`${this.apiBase}/recommendations.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    action: action
                })
            });
        } catch (error) {
            console.error('Erro ao registrar comportamento:', error);
        }
    }

    // Atualiza contador do carrinho
    async updateCartCount() {
        try {
            const response = await fetch(`${this.apiBase}/cart.php`);
            const cart = await response.json();
            
            const totalItems = cart.reduce((sum, item) => sum + parseInt(item.quantity), 0);
            document.getElementById('cart-count').textContent = totalItems;
        } catch (error) {
            console.error('Erro ao atualizar carrinho:', error);
        }
    }

    // Mostra alertas
    showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.prepend(alertDiv);
        
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }

    // Carrega carrinho do localStorage
    loadCartFromStorage() {
        return JSON.parse(localStorage.getItem('cart')) || [];
    }

    // Salva carrinho no localStorage
    saveCartToStorage() {
        localStorage.setItem('cart', JSON.stringify(this.cart));
    }
}

// Inicializa a aplicação
const ecommerceApp = new EcommerceApp();