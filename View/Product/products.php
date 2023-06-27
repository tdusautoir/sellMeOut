<div class="products">
    <h2>Liste des produits</h2>
    <div class="products-list">
        <?php foreach($products as $product): 
            if($product->deletion != 1){?>
            <div class="product-card" data-id="<?= $product->id ?>">
                <!-- <img src="<?= $product->images ?>" alt=""> -->
                <h3><?= $product->name ?></h3>
                <p class="desc"><?= $product->description ?></p>
                <p class="price"><?= $product->price ?></p>
            </div>
        <?php }endforeach; ?>
    </div>
</div>