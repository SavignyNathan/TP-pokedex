<?php
// models/User.php

require_once CONFIG_PATH . '/database.php';

class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    /**
     * Créer un nouveau utilisateur
     */
    public function register($username, $password) {
        // Vérifier si l'utilisateur existe déjà
        if ($this->userExists($username)) {
            return ['success' => false, 'message' => 'Ce nom d\'utilisateur existe déjà.'];
        }
        
        // Valider les données
        if (strlen($username) < 3) {
            return ['success' => false, 'message' => 'Le nom d\'utilisateur doit contenir au moins 3 caractères.'];
        }
        
        if (strlen($password) < 6) {
            return ['success' => false, 'message' => 'Le mot de passe doit contenir au moins 6 caractères.'];
        }
        
        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insérer l'utilisateur
        try {
            $stmt = $this->db->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);
            
            return ['success' => true, 'message' => 'Inscription réussie !'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de l\'inscription.'];
        }
    }
    
    /**
     * Connecter un utilisateur
     */
    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Créer la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                return ['success' => true, 'message' => 'Connexion réussie !'];
            } else {
                return ['success' => false, 'message' => 'Nom d\'utilisateur ou mot de passe incorrect.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de la connexion.'];
        }
    }
    
    /**
     * Déconnecter l'utilisateur
     */
    public function logout() {
        session_unset();
        session_destroy();
        return ['success' => true, 'message' => 'Déconnexion réussie.'];
    }
    
    /**
     * Vérifier si un utilisateur existe
     */
    private function userExists($username) {
        $stmt = $this->db->prepare("SELECT id FROM user WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch() !== false;
    }
    
    /**
     * Vérifier si l'utilisateur est connecté
     */
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    /**
     * Obtenir l'ID de l'utilisateur connecté
     */
    public static function getCurrentUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    /**
     * Obtenir le nom d'utilisateur connecté
     */
    public static function getCurrentUsername() {
        return $_SESSION['username'] ?? null;
    }
}
