-- Création de la base de données
CREATE DATABASE IF NOT EXISTS pokedex CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE pokedex;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table pour les Pokémon capturés par utilisateur
CREATE TABLE IF NOT EXISTS user_pokemon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pokemon_id INT NOT NULL,
    captured_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    UNIQUE KEY unique_capture (user_id, pokemon_id)
);
