<?php
// models/UserPokemon.php

require_once CONFIG_PATH . '/database.php';

class UserPokemon {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Capturer un Pokémon
     */
    public function capturePokemon($userId, $pokemonId) {
        try {
            // Vérifier si le Pokémon n'est pas déjà capturé
            if ($this->isPokemonCaptured($userId, $pokemonId)) {
                return ['success' => false, 'message' => 'Vous possédez déjà ce Pokémon.'];
            }
            
            $stmt = $this->db->prepare("INSERT INTO user_pokemon (user_id, pokemon_id) VALUES (?, ?)");
            $stmt->execute([$userId, $pokemonId]);
            
            return ['success' => true, 'message' => 'Pokémon capturé avec succès !'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de la capture du Pokémon.'];
        }
    }
    
    /**
     * Libérer un Pokémon
     */
    public function releasePokemon($userId, $pokemonId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM user_pokemon WHERE user_id = ? AND pokemon_id = ?");
            $stmt->execute([$userId, $pokemonId]);
            
            if ($stmt->rowCount() > 0) {
                return ['success' => true, 'message' => 'Pokémon libéré.'];
            } else {
                return ['success' => false, 'message' => 'Pokémon non trouvé dans votre collection.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de la libération du Pokémon.'];
        }
    }
    
    /**
     * Obtenir tous les Pokémon capturés par un utilisateur
     */
    public function getUserPokemons($userId) {
        try {
            $stmt = $this->db->prepare("SELECT pokemon_id FROM user_pokemon WHERE user_id = ?");
            $stmt->execute([$userId]);
            
            $pokemonIds = [];
            while ($row = $stmt->fetch()) {
                $pokemonIds[] = $row['pokemon_id'];
            }
            
            return $pokemonIds;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    /**
     * Vérifier si un Pokémon est capturé par un utilisateur
     */
    public function isPokemonCaptured($userId, $pokemonId) {
        try {
            $stmt = $this->db->prepare("SELECT id FROM user_pokemon WHERE user_id = ? AND pokemon_id = ?");
            $stmt->execute([$userId, $pokemonId]);
            
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    /**
     * Compter le nombre de Pokémon capturés
     */
    public function countCapturedPokemons($userId) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM user_pokemon WHERE user_id = ?");
            $stmt->execute([$userId]);
            $result = $stmt->fetch();
            
            return $result['count'] ?? 0;
        } catch (PDOException $e) {
            return 0;
        }
    }
}
