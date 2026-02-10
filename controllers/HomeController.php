<?php
// controllers/HomeController.php

require_once MODEL_PATH . '/User.php';
require_once MODEL_PATH . '/UserPokemon.php';

class HomeController {
    /**
     * Afficher la page d'accueil
     */
    public function index() {
        // Récupérer les statistiques si l'utilisateur est connecté
        $stats = null;
        if (User::isLoggedIn()) {
            $userPokemonModel = new UserPokemon();
            $userId = User::getCurrentUserId();
            
            $stats = [
                'captured' => $userPokemonModel->countCapturedPokemons($userId),
                'total' => count((new Pokemon())->getAllPokemons())
            ];
        }
        
        require_once VIEW_PATH . '/home.php';
    }
}
