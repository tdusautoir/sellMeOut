<div class="title-note">
    <h1><?= $product->name ?></h1>
    <div class="average-ratings ratings">
        <?php if (isset($product->averageRating)) : ?>
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <?php if ($i <= $product->averageRating) : ?>
                        <i class="fas fa-star star"></i>
                    <?php else : ?>
                        <i class="far fa-star star"></i>
                    <?php endif; ?>
            <?php endfor; ?>
        <?php else : ?>
            Aucune note
        <?php endif; ?>
    </div>
</div>

<div class="desc">
    <div class="desc-title">
        <p>Description</p>
        <span> :</span>
    </div>
    
    <p><?= $product->description ?></p>
</div>


<div class="price">
    <p>Prix : <?= $product->price ?> €</p>
    <?php if(isset($_SESSION["user"]) && $_SESSION["user"]->role == 'buyer'): ?>
    <form action="/cart/add" method="POST">
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <input type="number" name="quantity" value="1">
        <button><i class="fa-solid fa-plus"></i></button>
    </form>
    <?php endif; ?>
</div>

<?php if(!(isset($seller) && $seller)): ?>
    <div class="seller">
        <p>Vendeur : <?= $product->user->pseudo ?></p>
        <p>Mail du vendeur : <?= $product->user->mail ?></p>
        <div>Note moyenne du vendeur :
            <?php if (isset($product->user->averageRating)) : ?>
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <?php if ($i <= $product->user->averageRating) : ?>
                            <i class="fas fa-star star"></i>
                        <?php else : ?>
                            <i class="far fa-star star"></i>
                        <?php endif; ?>
                <?php endfor; ?>
            <?php else: ?>
                Aucune note
            <?php endif; ?>
            
        </div>
    </div>
<?php endif; ?>