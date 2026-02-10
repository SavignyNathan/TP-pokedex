<?php 
$pageTitle = 'Connexion - Mini Pokédex';
require_once VIEW_PATH . '/includes/header.php'; 
?>

<h1>Connexion</h1>

<form method="POST" action="?page=login" style="max-width: 500px; margin: 0 auto;">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" required 
               placeholder="Votre nom d'utilisateur">
    </div>
    
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required 
               placeholder="Votre mot de passe">
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary" style="width: 100%;">Se connecter</button>
    </div>
    
    <p style="text-align: center; margin-top: 20px;">
        Vous n'avez pas de compte ? 
        <a href="?page=register" style="color: #667eea; font-weight: 500;">Inscrivez-vous</a>
    </p>
</form>

<?php require_once VIEW_PATH . '/includes/footer.php'; ?>
