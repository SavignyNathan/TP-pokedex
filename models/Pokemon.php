<?php
// models/Pokemon.php

class Pokemon {
    private $pokemons;
    
    public function __construct() {
        $this->loadPokemons();
    }
    
    /**
     * Charger les Pokémon depuis le fichier JSON
     */
    private function loadPokemons() {
        if (!file_exists(POKEMON_JSON_FILE)) {
            $this->pokemons = [];
            return;
        }
        
        $jsonContent = file_get_contents(POKEMON_JSON_FILE);
        $this->pokemons = json_decode($jsonContent, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->pokemons = [];
        }
    }
    
    /**
     * Obtenir tous les Pokémon
     */
    public function getAllPokemons() {
        return $this->pokemons;
    }
    
    /**
     * Obtenir un Pokémon par son ID
     */
    public function getPokemonById($id) {
        foreach ($this->pokemons as $pokemon) {
            if ($pokemon['id'] == $id) {
                return $pokemon;
            }
        }
        return null;
    }
    
    /**
     * Rechercher des Pokémon par type
     */
    public function getPokemonsByType($type) {
        $result = [];
        foreach ($this->pokemons as $pokemon) {
            if (in_array($type, $pokemon['type'])) {
                $result[] = $pokemon;
            }
        }
        return $result;
    }
    
    /**
     * Rechercher des Pokémon par nom
     */
    public function searchPokemonByName($searchTerm) {
        $result = [];
        $searchTerm = strtolower($searchTerm);
        
        foreach ($this->pokemons as $pokemon) {
            if (strpos(strtolower($pokemon['name']), $searchTerm) !== false) {
                $result[] = $pokemon;
            }
        }
        return $result;
    }
}
