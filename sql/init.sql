CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    description TEXT,
    price DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (email, password, role) VALUES
('admin@example.com', '0192023a7bbd73250516f069df18b500', 'admin');

INSERT INTO items (name, image, description, price) VALUES
('Laptop Asus seri A', 'laptop1.jpg', 'Seri laptop bisnis legendaris. Dikenal dengan keyboard-nya yang luar biasa, sasis yang kokoh, fitur keamanan, dan TrackPoint merah ikoniknya', 3000000),
('Laptop Asus seri B', 'laptop2.jpeg', 'Seri laptop bisnis legendaris. Dikenal dengan keyboard-nya yang luar biasa, sasis yang kokoh, fitur keamanan, dan TrackPoint merah ikoniknya', 4000000),
('Laptop Asus seri C', 'laptop3.png', 'Seri laptop bisnis legendaris. Dikenal dengan keyboard-nya yang luar biasa, sasis yang kokoh, fitur keamanan, dan TrackPoint merah ikoniknya', 3000000),
('Laptop Lenovo seri A', 'laptop4.jpg', 'Seri laptop bisnis legendaris. Dikenal dengan keyboard-nya yang luar biasa, sasis yang kokoh, fitur keamanan, dan TrackPoint merah ikoniknya', 4300000);