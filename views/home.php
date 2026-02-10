<?php 
require_once MODEL_PATH . '/User.php';
$pageTitle = 'Accueil - Mini Pokédex';
require_once VIEW_PATH . '/includes/header.php'; 
?>

<div class="welcome-section">
    <?php if (User::isLoggedIn()): ?>
        <h1>Bienvenue, <?php echo htmlspecialchars(User::getCurrentUsername()); ?> ! 👋</h1>
        <p>Prêt à compléter votre Pokédex ?</p>
        
        <?php if ($stats): ?>
            <div class="stats-cards">
                <div class="stat-card">
                    <h3>Pokémon Capturés</h3>
                    <p><?php echo $stats['captured']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Pokémon Total</h3>
                    <p><?php echo $stats['total']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Progression</h3>
                    <p><?php echo $stats['total'] > 0 ? round(($stats['captured'] / $stats['total']) * 100) : 0; ?>%</p>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="actions">
            <a href="?page=pokemons" class="btn btn-primary">Voir tous les Pokémon</a>
            <a href="?page=collection" class="btn btn-success">Ma Collection</a>
        </div>
        
    <?php else: ?>
        <h1>Bienvenue sur Mini Pokédex ! 🎮</h1>
        <p>Connectez-vous pour commencer votre aventure et capturer des Pokémon.</p>
        
        <div class="actions">
            <a href="?page=login" class="btn btn-primary">Se connecter</a>
            <a href="?page=register" class="btn btn-success">S'inscrire</a>
        </div>
        
        <div style="margin-top: 40px;">
            <h2>Fonctionnalités</h2>
            <div class="stats-cards">
                <div class="stat-card">
                    <h3>📋 Consulter</h3>
                    <p style="font-size: 16px;">Explorez tous les Pokémon disponibles</p>
                </div>
                <div class="stat-card">
                    <h3>⚡ Capturer</h3>
                    <p style="font-size: 16px;">Ajoutez des Pokémon à votre collection</p>
                </div>
                <div class="stat-card">
                    <h3>📊 Suivre</h3>
                    <p style="font-size: 16px;">Suivez votre progression</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once VIEW_PATH . '/includes/footer.php'; ?>
