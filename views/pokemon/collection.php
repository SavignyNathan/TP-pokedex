<?php 
require_once MODEL_PATH . '/User.php';
$pageTitle = 'Ma Collection - Mini Pokédex';
require_once VIEW_PATH . '/includes/header.php'; 
?>

<h1>Ma Collection</h1>

<?php if (empty($capturedPokemons)): ?>
    <div style="text-align: center; padding: 60px 20px;">
        <p style="font-size: 20px; color: #666; margin-bottom: 20px;">
            Vous n'avez pas encore capturé de Pokémon.
        </p>
        <a href="?page=pokemons" class="btn btn-primary">
            Commencer à capturer des Pokémon
        </a>
    </div>
<?php else: ?>
    <p style="margin-bottom: 20px; font-size: 18px;">
        Vous avez capturé <strong><?php echo count($capturedPokemons); ?></strong> Pokémon !
    </p>
    
    <div class="pokemon-grid">
        <?php foreach ($capturedPokemons as $pokemon): ?>
            <div class="pokemon-card captured">
                <span class="captured-badge">✓ Capturé</span>
                
                <img src="<?php echo htmlspecialchars($pokemon['image']); ?>" 
                     alt="<?php echo htmlspecialchars($pokemon['name']); ?>"
                     loading="lazy">
                
                <h3><?php echo htmlspecialchars($pokemon['name']); ?></h3>
                
                <div class="pokemon-types">
                    <?php foreach ($pokemon['type'] as $type): ?>
                        <span class="type-badge type-<?php echo strtolower($type); ?>">
                            <?php echo htmlspecialchars($type); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
                
                <a href="?page=pokemon&id=<?php echo $pokemon['id']; ?>" class="btn btn-primary">
                    Voir détail
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once VIEW_PATH . '/includes/footer.php'; ?>
