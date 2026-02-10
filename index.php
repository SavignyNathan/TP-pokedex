<?php
// index.php

require_once 'config/config.php';
require_once CONTROLLER_PATH . '/HomeController.php';
require_once CONTROLLER_PATH . '/AuthController.php';
require_once CONTROLLER_PATH . '/PokemonController.php';

// Récupérer la page demandée
$page = $_GET['page'] ?? 'home';

// Router - rediriger vers le bon contrôleur
switch ($page) {
    // Pages d'authentification
    case 'register':
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegister();
        }
        break;
        
    case 'login':
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    
    // Pages Pokémon
    case 'pokemons':
        $controller = new PokemonController();
        $controller->showAllPokemon();
        break;
        
    case 'pokemon':
        $controller = new PokemonController();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $controller->showOnePokemon($id);
        } else {
            header('Location: ?page=pokemons');
            exit;
        }
        break;
        
    case 'capture':
        $controller = new PokemonController();
        $controller->capturePokemon();
        break;
        
    case 'release':
        $controller = new PokemonController();
        $controller->releasePokemon();
        break;
        
    case 'collection':
        $controller = new PokemonController();
        $controller->showMyCollection();
        break;
    
    // Page d'accueil
    case 'home':
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
