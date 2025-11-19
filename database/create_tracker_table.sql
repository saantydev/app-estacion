CREATE TABLE app_estacion__tracker (
    id INT AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    ip VARCHAR(45) NOT NULL,
    latitud VARCHAR(50),
    longitud VARCHAR(50),
    pais VARCHAR(100),
    navegador VARCHAR(255),
    sistema VARCHAR(255),
    add_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_ip (ip),
    INDEX idx_token (token),
    INDEX idx_add_date (add_date)
);