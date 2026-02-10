<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Mini Pokédex'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <h1>🎮 Mini Pokédex</h1>
            </div>
            
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="?page=pokemons">Tous les Pokémon</a></li>
                    
                    <?php if (User::isLoggedIn()): ?>
                        <li><a href="?page=collection">Ma Collection</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            
            <div class="user-info">
                <?php if (User::isLoggedIn()): ?>
                    <span>Bienvenue, <strong><?php echo htmlspecialchars(User::getCurrentUsername()); ?></strong></span>
                    <a href="?page=logout" class="btn btn-secondary">Déconnexion</a>
                <?php else: ?>
                    <a href="?page=login" class="btn btn-primary">Connexion</a>
                    <a href="?page=register" class="btn btn-secondary">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    
    <div class="container">
        <?php
        // Afficher les messages de succès
        if (isset($_SESSION['success'])):
        ?>
            <div class="alert alert-success">
                <?php 
                echo htmlspecialchars($_SESSION['success']); 
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php
        // Afficher les messages d'erreur
        if (isset($_SESSION['error'])):
        ?>
            <div class="alert alert-error">
                <?php 
                echo htmlspecialchars($_SESSION['error']); 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
