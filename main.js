// Função para adicionar produto ao carrinho via AJAX
function addToCart(productId, quantity = 1) {
    fetch('ajax/add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Atualizar contador do carrinho
            document.getElementById('cart-count').textContent = data.total_items;
            
            // Mostrar mensagem de sucesso
            showNotification('Produto adicionado ao carrinho!', 'success');
        } else {
            showNotification('Erro ao adicionar produto.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Erro de conexão.', 'error');
    });
}

// Função para remover produto do carrinho
function removeFromCart(productId) {
    fetch('ajax/remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Recarregar para atualizar a página
        }
    });
}

// Função para atualizar quantidade
function updateQuantity(productId, quantity) {
    if (quantity <= 0) {
        removeFromCart(productId);
        return;
    }

    fetch('ajax/update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

// Sistema de notificações
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    } text-white`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Track user behavior
function trackUserBehavior(productId, action) {
    fetch('ajax/track_behavior.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId,
            action: action
        })
    });
}

// Auto-track when page loads for product details
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');
    
    if (productId && window.location.pathname.includes('product-detail.php')) {
        trackUserBehavior(productId, 'view');
    }
});