<?php
// config/config.php

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chemins de l'application
define('ROOT_PATH', dirname(__DIR__));
define('CONFIG_PATH', ROOT_PATH . '/config');
define('MODEL_PATH', ROOT_PATH . '/models');
define('VIEW_PATH', ROOT_PATH . '/views');
define('CONTROLLER_PATH', ROOT_PATH . '/controllers');
define('DATA_PATH', ROOT_PATH . '/data');

// URL de base
define('BASE_URL', '/');

// Fichier JSON des Pokémon
define('POKEMON_JSON_FILE', DATA_PATH . '/pokemons.json');

// Inclusion de la configuration de la base de données
require_once CONFIG_PATH . '/database.php';
