<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/reset.css">
    <link rel="stylesheet" href="/style.css">
    <?php if(!empty($headers)): ?>
        <?php foreach($headers as $header): ?>
            <?= $header ?>
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <header>
        <div class="header-content">
            <h1>PHP-MVC</h1>
            <nav>
                <ul>
                    <li><a href="/products">Produits</a></li>
                    <li><a href="/products/new">Ajout produit</a></li>
                    <?php if(isset($_SESSION["user"])): ?>
                        <li><a href="/logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/signin">Signin</a></li>
                        <li><a href="/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <div class="content">
        <?= $content ?>
    </div>
</body>
</html>