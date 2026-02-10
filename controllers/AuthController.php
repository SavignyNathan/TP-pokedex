<?php
// controllers/AuthController.php

require_once MODEL_PATH . '/User.php';

class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    /**
     * Afficher la page d'inscription
     */
    public function showRegister() {
        require_once VIEW_PATH . '/auth/register.php';
    }
    
    /**
     * Traiter l'inscription
     */
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            // Validation
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Tous les champs sont requis.';
                header('Location: ?page=register');
                exit;
            }
            
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = 'Les mots de passe ne correspondent pas.';
                header('Location: ?page=register');
                exit;
            }
            
            // Enregistrer l'utilisateur
            $result = $this->userModel->register($username, $password);
            
            if ($result['success']) {
                $_SESSION['success'] = $result['message'];
                header('Location: ?page=login');
            } else {
                $_SESSION['error'] = $result['message'];
                header('Location: ?page=register');
            }
            exit;
        }
    }
    
    /**
     * Afficher la page de connexion
     */
    public function showLogin() {
        require_once VIEW_PATH . '/auth/login.php';
    }
    
    /**
     * Traiter la connexion
     */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Tous les champs sont requis.';
                header('Location: ?page=login');
                exit;
            }
            
            $result = $this->userModel->login($username, $password);
            
            if ($result['success']) {
                $_SESSION['success'] = $result['message'];
                header('Location: index.php');
            } else {
                $_SESSION['error'] = $result['message'];
                header('Location: ?page=login');
            }
            exit;
        }
    }
    
    /**
     * Déconnecter l'utilisateur
     */
    public function logout() {
        $this->userModel->logout();
        header('Location: ?page=login');
        exit;
    }
}
