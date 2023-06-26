<div class="products">
    <h2>Liste des produits</h2>
    <div class="products-list">
        <?php foreach($products as $product): ?>
            <div class="product-card" data-href="/Product/<?= $product->id ?>">
                <h4><?= $product->name ?></h4>
                <p><?= $product->description ?></p>
                <p><?= $product->price ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>