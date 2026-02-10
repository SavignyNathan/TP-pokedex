<?php 
$pageTitle = 'Inscription - Mini Pokédex';
require_once VIEW_PATH . '/includes/header.php'; 
?>

<h1>Inscription</h1>

<form method="POST" action="?page=register" style="max-width: 500px; margin: 0 auto;">
    <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" required 
               placeholder="Choisissez un nom d'utilisateur" 
               minlength="3">
    </div>
    
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required 
               placeholder="Entrez votre mot de passe" 
               minlength="6">
    </div>
    
    <div class="form-group">
        <label for="confirm_password">Confirmer le mot de passe</label>
        <input type="password" id="confirm_password" name="confirm_password" required 
               placeholder="Confirmez votre mot de passe" 
               minlength="6">
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary" style="width: 100%;">S'inscrire</button>
    </div>
    
    <p style="text-align: center; margin-top: 20px;">
        Vous avez déjà un compte ? 
        <a href="?page=login" style="color: #667eea; font-weight: 500;">Connectez-vous</a>
    </p>
</form>

<?php require_once VIEW_PATH . '/includes/footer.php'; ?>
