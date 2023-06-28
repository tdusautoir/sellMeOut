<div class="products">
    <div class="top-banner">
    <?php if(isset($seller) && $seller): ?>
        <h2>Liste de mes produits</h2>
    <?php else: ?>
        <h2>Liste des produits</h2>
    <?php endif; ?>
        <div class="search-bar-item">
            <?php if(isset($search) && $search): ?>
            <a href="/products" class="reset-search"><i class="fa-solid fa-xmark"></i></a>
            <?php endif; ?>  
            <input type="search" id="search" class="searchbar">
            <a href="/products/search/" id="search-btn" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></a>
                    
        </div>
        
    </div>

    <div class="products-list">
        <?php if(empty($products)): ?>
            <?php if($search): ?>
                <p>Aucun produit ne correspond à votre recherche</p>
            <?php else: ?>
                <p>Aucun produit n'est disponible</p>
            <?php endif; ?>
        <?php else: ?> 
            <?php foreach($products as $product): 
                if($product->deletion != 1){?>
                <div class="product-card" data-id="<?= $product->id ?>">
                    <h3><?= $product->name ?></h3>
                    <p class="desc"><?= $product->description ?></p>
                    <p class="price"><?= $product->price ?> €</p>
                </div>
            <?php }endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php if(isset($seller) && $seller): ?>
    <a href="/products/new">Ajouter un produit</a>
<?php endif; ?>