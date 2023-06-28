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
            <?php if(isset($search) && $search): ?>
                <p>Aucun produit ne correspond à votre recherche</p>
            <?php elseif(isset($seller) && $seller): ?>
                <p>Vous n'avez mis aucun produit en vente.</p>
            <?php else: ?>
                <p>Aucun produit n'est actuellement en vente</p>
            <?php endif; ?>
        <?php else: ?> 
            <?php foreach($products as $product): 
                if($product->public == 1 || isset($seller) && $seller) { ?>
                    <div class="product-card" data-id="<?= $product->id ?>">
                        <!-- <img src="<?= $product->images ?>" alt=""> -->
                        <h3><?= $product->name ?></h3>
                        <p class="desc"><?= $product->description ?></p>
                        <p class="price"><?= $product->price ?> €</p>
                        <?php if(isset($seller) && $seller): ?>
                            <?php if($product->public == 1): ?>
                                <form action="/products/<?= $product->id ?>/unpublish" method="POST">
                                    <button>Dépublié</button>
                                </form>
                            <?php else: ?>
                                <form action="/products/<?= $product->id ?>/publish" method="POST">
                                    <button>Publié</button>
                                </form>
                            <?php endif; ?>
                        <?php endif ?>
                    </div>
            <?php }endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php if(isset($seller) && $seller): ?>
    <a href="/products/new">Ajouter un produit</a>
<?php endif; ?>