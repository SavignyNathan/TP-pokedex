<?php 
require_once MODEL_PATH . '/User.php';
$pageTitle = htmlspecialchars($pokemon['name']) . ' - Mini Pokédex';
require_once VIEW_PATH . '/includes/header.php'; 
?>

<a href="?page=pokemons" class="btn btn-secondary" style="margin-bottom: 20px;">← Retour à la liste</a>

<div class="pokemon-detail">
    <div class="pokemon-detail-image">
        <img src="<?php echo htmlspecialchars($pokemon['image']); ?>" 
             alt="<?php echo htmlspecialchars($pokemon['name']); ?>">
    </div>
    
    <div class="pokemon-detail-info">
        <h2><?php echo htmlspecialchars($pokemon['name']); ?></h2>
        
        <div class="pokemon-types">
            <?php foreach ($pokemon['type'] as $type): ?>
                <span class="type-badge type-<?php echo strtolower($type); ?>">
                    <?php echo htmlspecialchars($type); ?>
                </span>
            <?php endforeach; ?>
        </div>
        
        <p style="margin-top: 20px; font-size: 16px; line-height: 1.6;">
            <?php echo htmlspecialchars($pokemon['description']); ?>
        </p>
        
        <?php if (isset($pokemon['stats'])): ?>
            <div class="stats-container">
                <h3>Statistiques</h3>
                
                <?php 
                $statsLabels = [
                    'hp' => 'PV',
                    'attack' => 'Attaque',
                    'defense' => 'Défense',
                    'speed' => 'Vitesse'
                ];
                
                foreach ($pokemon['stats'] as $statKey => $statValue): 
                    if (isset($statsLabels[$statKey])):
                ?>
                    <div class="stat">
                        <div class="stat-label">
                            <span><?php echo $statsLabels[$statKey]; ?></span>
                            <span><?php echo $statValue; ?></span>
                        </div>
                        <div class="stat-bar">
                            <div class="stat-fill" style="width: <?php echo min(($statValue / 150) * 100, 100); ?>%;"></div>
                        </div>
                    </div>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (User::isLoggedIn()): ?>
            <div style="margin-top: 30px;">
                <?php if ($isCaptured): ?>
                    <form method="POST" action="?page=release">
                        <input type="hidden" name="pokemon_id" value="<?php echo $pokemon['id']; ?>">
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Êtes-vous sûr de vouloir libérer ce Pokémon ?');">
                            🔓 Libérer ce Pokémon
                        </button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="?page=capture">
                        <input type="hidden" name="pokemon_id" value="<?php echo $pokemon['id']; ?>">
                        <button type="submit" class="btn btn-success">
                            ⚡ Capturer ce Pokémon
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 5px;">
                <p style="margin: 0;">
                    <a href="?page=login" style="color: #667eea; font-weight: 500;">Connectez-vous</a> 
                    pour capturer ce Pokémon !
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once VIEW_PATH . '/includes/footer.php'; ?>
