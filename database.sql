CREATE DATABASE smart_commerce;
USE smart_commerce;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(100),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_behavior (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    product_id INT NOT NULL,
    action_type ENUM('view', 'add_to_cart', 'purchase') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Inserir produtos de exemplo
INSERT INTO products (name, description, price, image, category, stock) VALUES
('Smartphone Galaxy S23', 'Smartphone Android com 128GB, câmera tripla e tela AMOLED', 2999.99, 'phone1.jpg', 'Eletrônicos', 50),
('Notebook Dell Inspiron', 'Notebook Intel i5, 8GB RAM, SSD 256GB, 15.6 polegadas', 3499.99, 'laptop1.jpg', 'Informática', 30),
('Fone de Ouvido Bluetooth', 'Fone sem fio com cancelamento de ruído ativo', 499.99, 'headphone1.jpg', 'Áudio', 100),
('Smart TV 55" 4K', 'TV LED 4K UHD com HDR e Smart TV integrado', 2499.99, 'tv1.jpg', 'Eletrônicos', 25),
('Tablet Samsung Tab S8', 'Tablet Android com S-Pen, 128GB, tela 11 polegadas', 1899.99, 'tablet1.jpg', 'Eletrônicos', 40),
('Mouse Gamer RGB', 'Mouse óptico com iluminação RGB, 6400 DPI', 199.99, 'mouse1.jpg', 'Informática', 75),
('Teclado Mecânico', 'Teclado mecânico com switches azuis, retroiluminação', 349.99, 'keyboard1.jpg', 'Informática', 60),
('Monitor 27" 4K', 'Monitor IPS 4K, 144Hz, HDR400', 1999.99, 'monitor1.jpg', 'Informática', 20);