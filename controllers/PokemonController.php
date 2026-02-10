<?php
// controllers/PokemonController.php

require_once MODEL_PATH . '/Pokemon.php';
require_once MODEL_PATH . '/UserPokemon.php';
require_once MODEL_PATH . '/User.php';

class PokemonController {
    private $pokemonModel;
    private $userPokemonModel;
    
    public function __construct() {
        $this->pokemonModel = new Pokemon();
        $this->userPokemonModel = new UserPokemon();
    }
    
    /**
     * Afficher tous les Pokémon
     */
    public function showAllPokemon() {
        // Récupérer tous les Pokémon
        $pokemons = $this->pokemonModel->getAllPokemons();
        
        // Si l'utilisateur est connecté, récupérer ses Pokémon capturés
        $capturedPokemonIds = [];
        if (User::isLoggedIn()) {
            $userId = User::getCurrentUserId();
            $capturedPokemonIds = $this->userPokemonModel->getUserPokemons($userId);
        }
        
        // Charger la vue
        require_once VIEW_PATH . '/pokemon/list.php';
    }
    
    /**
     * Afficher le détail d'un Pokémon
     */
    public function showOnePokemon($id) {
        // Récupérer le Pokémon
        $pokemon = $this->pokemonModel->getPokemonById($id);
        
        if (!$pokemon) {
            $_SESSION['error'] = 'Pokémon non trouvé.';
            header('Location: ?page=pokemons');
            exit;
        }
        
        // Vérifier si l'utilisateur possède ce Pokémon
        $isCaptured = false;
        if (User::isLoggedIn()) {
            $userId = User::getCurrentUserId();
            $isCaptured = $this->userPokemonModel->isPokemonCaptured($userId, $id);
        }
        
        // Charger la vue
        require_once VIEW_PATH . '/pokemon/detail.php';
    }
    
    /**
     * Capturer un Pokémon
     */
    public function capturePokemon() {
        // Vérifier que l'utilisateur est connecté
        if (!User::isLoggedIn()) {
            $_SESSION['error'] = 'Vous devez être connecté pour capturer un Pokémon.';
            header('Location: ?page=login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pokemonId = $_POST['pokemon_id'] ?? null;
            
            if (!$pokemonId) {
                $_SESSION['error'] = 'Pokémon invalide.';
                header('Location: ?page=pokemons');
                exit;
            }
            
            $userId = User::getCurrentUserId();
            $result = $this->userPokemonModel->capturePokemon($userId, $pokemonId);
            
            if ($result['success']) {
                $_SESSION['success'] = $result['message'];
            } else {
                $_SESSION['error'] = $result['message'];
            }
            
            header('Location: ?page=pokemon&id=' . $pokemonId);
            exit;
        }
    }
    
    /**
     * Libérer un Pokémon
     */
    public function releasePokemon() {
        if (!User::isLoggedIn()) {
            $_SESSION['error'] = 'Vous devez être connecté.';
            header('Location: ?page=login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pokemonId = $_POST['pokemon_id'] ?? null;
            
            if (!$pokemonId) {
                $_SESSION['error'] = 'Pokémon invalide.';
                header('Location: ?page=pokemons');
                exit;
            }
            
            $userId = User::getCurrentUserId();
            $result = $this->userPokemonModel->releasePokemon($userId, $pokemonId);
            
            if ($result['success']) {
                $_SESSION['success'] = $result['message'];
            } else {
                $_SESSION['error'] = $result['message'];
            }
            
            header('Location: ?page=pokemon&id=' . $pokemonId);
            exit;
        }
    }
    
    /**
     * Afficher la collection de l'utilisateur
     */
    public function showMyCollection() {
        if (!User::isLoggedIn()) {
            $_SESSION['error'] = 'Vous devez être connecté pour voir votre collection.';
            header('Location: ?page=login');
            exit;
        }
        
        $userId = User::getCurrentUserId();
        $capturedPokemonIds = $this->userPokemonModel->getUserPokemons($userId);
        
        // Récupérer les détails des Pokémon capturés
        $capturedPokemons = [];
        foreach ($capturedPokemonIds as $pokemonId) {
            $pokemon = $this->pokemonModel->getPokemonById($pokemonId);
            if ($pokemon) {
                $capturedPokemons[] = $pokemon;
            }
        }
        
        require_once VIEW_PATH . '/pokemon/collection.php';
    }
}
