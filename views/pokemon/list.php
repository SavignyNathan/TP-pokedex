<?php 
require_once MODEL_PATH . '/User.php';
$pageTitle = 'Tous les Pokémon - Mini Pokédex';
require_once VIEW_PATH . '/includes/header.php'; 
?>

<h1>Tous les Pokémon</h1>

<?php if (empty($pokemons)): ?>
    <p style="text-align: center; padding: 40px; color: #666;">Aucun Pokémon disponible.</p>
<?php else: ?>
    <div class="pokemon-grid">
        <?php foreach ($pokemons as $pokemon): ?>
            <div class="pokemon-card <?php echo in_array($pokemon['id'], $capturedPokemonIds) ? 'captured' : ''; ?>">
                <?php if (in_array($pokemon['id'], $capturedPokemonIds)): ?>
                    <span class="captured-badge">✓ Capturé</span>
                <?php endif; ?>
                
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
