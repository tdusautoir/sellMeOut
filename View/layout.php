<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SellMeOut</title>
    <script src="https://kit.fontawesome.com/49dbd7732f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/reset.css">
    <link rel="stylesheet" href="/style.css">

    <!-- FONT  -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">

    <!--  -->

    <?php if(!empty($headers)): ?>
        <?php foreach($headers as $header): ?>
            <?= $header ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <script>
        window.addEventListener("DOMContentLoaded", () => {
            const flashMessages = document.querySelectorAll(".flash_message");
            flashMessages.forEach(flashMessage => {
                flashMessage.classList.add("show");

                setTimeout(() => {
                    flashMessage.classList.remove("show");
                }, 2000)
            });
        });
    </script>
</head>

<body>
    <!-- MODAL -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <p>Êtes-vous sûr de vouloir continuer ?</p>
            <form action="/cart/command" method="POST">
                <button id="paiement">Buy <i class="fa-solid fa-cart-shopping"></i></button>
            </form>
            <button id="close-modal"><i class="fa-solid fa-xmark" ></i></button>
        </div>
    </div>
    <!-- MODAL END -->
    <header>
        <div class="header-content">
            <!-- <img src="/Images/Logo_SellMeOut.jpg" alt="Sell Me Out" class="logo"> -->
            <div class="logo"> SELL ME OUT</div>
            <nav>
                <ul>
                    <div class="Deroulant">
                        <a href="/products" class="Product-nav">Produits<?php if(isset($_SESSION["user"]) && ($_SESSION["user"]->role == 'seller')) : ?><i class="fa-solid fa-chevron-down"></i><?php endif; ?></a>
                        <?php if(isset($_SESSION["user"]) && ($_SESSION["user"]->role == 'seller')) : ?>
                            <div class="ProductOpt">
                                <a href="/profil/products" class="ajout">Mes produits</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href="/profil/commands" class="myCommand">Mes commandes</a>
                    <div class="connect" id="connexion-menu">
                        <div class="logo-connect <?php if(isset($_SESSION["user"])) { echo "connected"; } ?>">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="sous-menu" id="connexion-sous-menu">
                            <?php if(isset($_SESSION["user"])): ?>
                                <li><a href="/logout">Logout</a></li>
                            <?php else: ?>
                                <li><a href="/login">Login</a></li>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(isset($_SESSION["user"]) && ($_SESSION["user"]->role == 'buyer')) : ?>
                        <div class="basket">
                            <a href="/cart"><i class="fa-solid fa-basket-shopping"></i></a>
                        </div>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <?php if(isset_flash_message_by_type(FLASH_SUCCESS)): ?>
        <div class="flash_message success"><?php display_flash_message_by_type(FLASH_SUCCESS) ?></div>
    <?php endif; ?>

    <?php if(isset_flash_message_by_type(FLASH_ERROR)): ?>
        <div class="flash_message error"><?php display_flash_message_by_type(FLASH_ERROR) ?></div>
    <?php endif; ?>

    <div class="content">
        <?= $content ?>
    </div>

    <script>
        document.getElementById("connexion-menu").addEventListener("click", function(e) {
        if (document.getElementById("connexion-sous-menu").classList.contains('visible')) {
            document.getElementById("connexion-sous-menu").classList.remove('visible');
        } else {
            document.getElementById("connexion-sous-menu").classList.add('visible');
        }
        });
    </script>
</body>
</html>