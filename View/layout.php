<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/49dbd7732f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/reset.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://kit.fontawesome.com/dd65784bc0.js" crossorigin="anonymous"></script>
    <?php if(!empty($headers)): ?>
        <?php foreach($headers as $header): ?>
            <?= $header ?>
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <header>
        <div class="header-content">
            <img src="/Images/Logo_SellMeOut.jpg" alt="Sell Me Out" class="logo">
            <nav>
                <ul>
                    <div class="Deroulant">
                        <a href="/products" class="Product-nav">Produits<?php if(isset($_SESSION["user"]) && ($_SESSION["user"]->role == 'seller')) : ?><i class="fa-solid fa-chevron-down"></i><?php endif; ?></a>
                        <?php if(isset($_SESSION["user"]) && ($_SESSION["user"]->role == 'seller')) : ?>
                            <div class="ProductOpt">
                                <a href="/products/new" class="ajout">Ajout produit</a>
                                <a href="/products/delete" class="suppression">Supprimer produit</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="connect">
                        <div class="logo-connect ">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="sous-menu">
                            <?php if(isset($_SESSION["user"])): ?>
                            <li><a href="/logout">Logout</a></li>
                            <?php else: ?>
                            <li><a href="/login">Login</a></li>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset($success)): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <div class="content">
        <?= $content ?>
    </div>
</body>
</html>