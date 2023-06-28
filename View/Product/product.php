<div class="title-note">
    <h1><?= $product->name ?></h1>
    <div class="average-ratings ratings">
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <?php if (isset($product->averageRating)) : ?>
                <?php if ($i <= $product->averageRating) : ?>
                    <i class="fas fa-star star"></i>
                <?php else : ?>
                    <i class="far fa-star star"></i>
                <?php endif; ?>
            <?php else : ?>
                <i class="far fa-star star"></i>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>

<div class="desc">
    <div class="desc-title">
        <p>Description</p>
        <span> :</span>
    </div>
    
    <p><?= $product->description ?></p>
</div>

<?php if($_SESSION["user"]->role == 'buyer'): ?>
<div class="price">
    <p>Prix : <?= $product->price ?> €</p>
    <form action="/cart/add" method="POST">
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <input type="number" name="quantity" value="1">
        <button><i class="fa-solid fa-plus"></i></button>
    </form>
</div>
<?php endif; ?>

<!-- 
<p>Note moyenne du produit</p>
<div class="average-ratings ratings">
    <?php for ($i = 1; $i <= 5; $i++) : ?>
        <?php if (isset($product->averageRating)) : ?>
            <?php if ($i <= $product->averageRating) : ?>
                <i class="fas fa-star star"></i>
            <?php else : ?>
                <i class="far fa-star star"></i>
            <?php endif; ?>
        <?php else : ?>
            <i class="far fa-star star"></i>
        <?php endif; ?>
    <?php endfor; ?>
</div>

<p>Note moyenne du vendeur : </p>
<div class="seller-ratings ratings">
    <?php for ($i = 1; $i <= 5; $i++) : ?>
        <?php if (isset($product->sellerRating)) : ?>
            <?php if ($i <= $product->sellerRating) : ?>
                <i class="fas fa-star star"></i>
            <?php else : ?>
                <i class="far fa-star star"></i>
            <?php endif; ?>
        <?php else : ?>
            <i class="far fa-star star"></i>
        <?php endif; ?>
    <?php endfor; ?>
</div> -->