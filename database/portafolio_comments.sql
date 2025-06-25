CREATE DATABASE IF NOT EXISTS portafolio_db;
USE portafolio_db;

CREATE TABLE IF NOT EXISTS comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreyapellido VARCHAR(255) NOT NULL,
    usuario VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    nota VARCHAR(1000) NOT NULL,
    fechanota VARCHAR(255) NOT NULL
);