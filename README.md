## 👨‍💻 Autor

<div align="center">
  <img src="https://avatars.githubusercontent.com/ninomiquelino" width="100" height="100" style="border-radius: 50%">
  <br>
  <strong>Onivaldo Miquelino</strong>
  <br>
  <a href="https://github.com/ninomiquelino">@ninomiquelino</a>
</div>

---

# 🛒 SmartCommerce AI

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/javascript)
[![OpenAI API](https://img.shields.io/badge/OpenAI-GPT--3.5-412991?logo=openai)](https://openai.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.2-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
![License MIT](https://img.shields.io/badge/License-MIT-green)
![Status Stable](https://img.shields.io/badge/Status-Stable-success)
![Version 1.0.0](https://img.shields.io/badge/Version-1.0.0-blue)
![GitHub stars](https://img.shields.io/github/stars/NinoMiquelino/smart-commerce-ai?style=social)
![GitHub forks](https://img.shields.io/github/forks/NinoMiquelino/smart-commerce-ai?style=social)
![GitHub issues](https://img.shields.io/github/issues/NinoMiquelino/smart-commerce-ai)

> E-commerce inteligente com sistema de recomendação baseado em IA, desenvolvido com PHP e JavaScript.

---

## 🚀 Funcionalidades Principais

### 🛒 E-commerce Completo

- **📋 Catálogo de Produtos** - Listagem e detalhes de produtos
- **🛍️ Carrinho de Compras** - Gestão completa do carrinho
- **💳 Checkout** - Processo de finalização de compra
- **📱 Design Responsivo** - Experiência mobile-first

### 🤖 Inteligência Artificial

- **🎯 Recomendações Personalizadas** - Sugestões baseadas no comportamento do usuário
- **🔍 Análise de Comportamento** - Registro de visualizações e interações
- **🧠 Algoritmo de Recomendação** - Integração com OpenAI GPT-3.5
- **📊 Produtos em Destaque** - Seleção inteligente de produtos

---

### ⚡ Tecnologias Avançadas

- **🔒 Sistema de Sessões** - Gestão segura de carrinhos
- **📈 Análise em Tempo Real** - Comportamento do usuário
- **🎨 Interface Moderna** - Bootstrap 5 + CSS3 customizado
- **🔄 AJAX Dinâmico** - Atualizações sem refresh

---

## 🛠️ Stack Tecnológica

### Backend
- **PHP 8.0+** - Linguagem server-side
- **MySQL** - Banco de dados relacional
- **OpenAI API** - Modelo GPT-3.5-turbo para recomendações
- **PDO** - Conexão segura com banco de dados

### Frontend
- **JavaScript ES6+** - Interatividade e chamadas assíncronas
- **Bootstrap 5** - Framework CSS para UI/UX
- **Fetch API** - Comunicação com backend
- **Chart.js** - Visualização de dados (futuras implementações)

### Ferramentas & APIs
- **Composer** - Gerenciamento de dependências PHP
- **Font Awesome** - Ícones e elementos visuais
- **RESTful API** - Arquitetura de APIs

---

## 📁 Estrutura do Projeto

```
smart-commerce-ai/
├──📄 index.php                 # Página inicial
├──🛍️ products.php             # Lista de produtos
├──🔍 product-detail.php       # Detalhe do produto
├──🛒 cart.php                 # Carrinho de compras
├──💳 checkout.php             # Finalização de compra
├──🏢 admin/                   # Painel administrativo
│├── index.php              # Dashboard admin
│├── products.php           # Gerenciar produtos
│└── orders.php             # Gerenciar pedidos
├──🔌 api/                     # Endpoints da API
│├── products.php           # API de produtos
│├── cart.php               # API do carrinho
│├── recommendations.php    # API de recomendações IA
│└── orders.php             # API de pedidos
├──📦 includes/               # Arquivos de inclusão
│├── config.php            # Configurações e conexão DB
│├── functions.php         # Funções auxiliares
│├── auth.php              # Sistema de autenticação
│└── recommendations.php   # Lógica de recomendações IA
├──🎨 assets/                 # Arquivos estáticos
│├── css/
││   └── style.css         # Estilos customizados
│├── js/
││   ├── main.js           # JavaScript principal
││   └── cart.js           # Lógica do carrinho
│└── images/
│└── products/         # Imagens dos produtos
├──🗃️ data/
│└── database.sql          # Estrutura do banco de dados
└──📖 README.md              # Documentação

```

---

## ⚡ Instalação Rápida

### Pré-requisitos
- PHP 8.0 ou superior
- MySQL 8.0 ou superior
- Servidor web (Apache/Nginx)
- Chave da API OpenAI

### 🚀 Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/smart-commerce-ai.git
   cd smart-commerce-ai
```

1. Configure o banco de dados
   ```bash
   mysql -u root -p < data/database.sql
   ```
2. Configure as variáveis de ambiente
   ```php
   # Edite includes/config.php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'smart_ecommerce');
   define('DB_USER', 'seu_usuario');
   define('DB_PASS', 'sua_senha');
   define('OPENAI_API_KEY', 'sua_chave_openai');
   ```
3. Adicione produtos de exemplo
   ```sql
   INSERT INTO products (name, description, price, stock) VALUES 
   ('iPhone 14 Pro', 'Smartphone Apple', 8999.99, 50),
   ('MacBook Air M2', 'Laptop Apple', 12999.99, 30);
   ```
4. Acesse a aplicação
   ```bash
   php -S localhost:8000
   ```
   Abra: http://localhost:8000

🎯 Como Usar

Para Clientes

1. Navegue pelos produtos na página inicial
2. Visualize detalhes clicando em qualquer produto
3. Adicione ao carrinho - o sistema registra seu comportamento
4. Receba recomendações personalizadas na home
5. Finalize a compra através do checkout

Para Desenvolvedores

API de Recomendações

```javascript
// Obter recomendações personalizadas
const response = await fetch('/api/recommendations.php');
const recommendations = await response.json();
```

Adicionar ao Carrinho

```javascript
// Adicionar produto ao carrinho
await fetch('/api/cart.php', {
    method: 'POST',
    body: JSON.stringify({
        product_id: 123,
        quantity: 1
    })
});
```

🔧 Configuração da API OpenAI

Obtenha sua Chave

1. Acesse OpenAI Platform
2. Crie uma conta ou faça login
3. Navegue até "API Keys"
4. Clique em "Create new secret key"
5. Copie a chave gerada

Configure no Projeto

```php
// includes/config.php
define('OPENAI_API_KEY', 'sk-sua-chave-aqui');
```

🗃️ Estrutura do Banco de Dados

Tabelas Principais

· users - Usuários do sistema<br>
· products - Catálogo de produtos<br>
· categories - Categorias de produtos<br>
· cart - Itens do carrinho<br>
· orders - Pedidos realizados<br>
· order_items - Itens dos pedidos<br>
· user_behavior - Comportamento para recomendações

Schema Completo

```sql
-- Ver arquivo data/database.sql para o schema completo
```

🎨 Personalização

Modificar o Sistema de Recomendações

```php
// includes/recommendations.php
public function getPersonalizedRecommendations($userHistory) {
    $prompt = "Baseado no histórico: {$userHistory} sugira produtos relacionados";
    // Lógica personalizada da IA
}
```

Adicionar Novos Campos de Produto

```sql
ALTER TABLE products ADD COLUMN brand VARCHAR(100);
ALTER TABLE products ADD COLUMN weight DECIMAL(10,2);
```

Customizar o Tema

```css
/* assets/css/style.css */
:root {
    --primary-color: #seu_azul;
    --secondary-color: #seu_cinza;
}
```

---

🐛 Troubleshooting

Problemas Comuns

Erro de conexão com o banco

```php
// Verifique includes/config.php
define('DB_HOST', 'localhost'); // Ou seu host
define('DB_NAME', 'smart_ecommerce'); // Nome correto do banco
```

API OpenAI não responde

· Verifique se a API Key está correta<br>
· Confirme se há créditos na conta OpenAI<br>
· Verifique a conexão com a internet

Carrinho não salva itens

· Verifique se as sessões PHP estão habilitadas
· Confirme as permissões de escrita

Logs e Debug

```php
// Ative o debug em includes/config.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

📈 Próximas Funcionalidades

· Sistema de usuários completo<br>
· Integração com gateways de pagamento (Stripe, PagSeguro)<br>
· Sistema de avaliações e reviews<br>
· Dashboard administrativo avançado<br>
· Email marketing automatizado<br>
· Sistema de cupons e promoções<br>
· Relatórios analíticos com gráficos<br>
· Multi-idioma e internacionalização<br>
· API RESTful documentada<br>
· PWA (Progressive Web App)

---

🙏 Agradecimentos

· OpenAI pela incrível API
· Bootstrap pelo framework CSS
· Comunidade PHP e JavaScript

---

⭐ Se este projeto foi útil, deixe uma estrela no repositório!

https://api.star-history.com/svg?repos=https://github.com/NinoMiquelino/smart-commerce-ai&type=Date

---

## 🤝 Contribuições
Contribuições são sempre bem-vindas!  
Sinta-se à vontade para abrir uma [*issue*](https://github.com/NinoMiquelino/smart-commerce-ai/issues) com sugestões ou enviar um [*pull request*](https://github.com/NinoMiquelino/smart-commerce-ai/pulls) com melhorias.

---

## 💬 Contato
📧 [Entre em contato pelo LinkedIn](https://www.linkedin.com/in/onivaldomiquelino/)  
💻 Desenvolvido por **Onivaldo Miquelino**

---
