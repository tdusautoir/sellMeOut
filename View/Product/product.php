<h1><?= $product->name ?></h1>

<p><?= $product->description ?></p>
<p><?= $product->price ?></p>


<div class="ratings">
    <?php for($i = 1; $i <= 5; $i++): ?>
        <?php if(isset($product->rating)): ?>
            <?php if($i <= $product->rating): ?>
                <i class="fas fa-star star"></i>
            <?php else: ?>
                <i class="far fa-star star"></i>
            <?php endif; ?>
        <?php else: ?>
            <i class="far fa-star star"></i>
        <?php endif; ?>
    <?php endfor; ?>
</div>

