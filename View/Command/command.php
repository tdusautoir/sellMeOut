<?php if(isset_flash_message_by_type("command-success")): ?>
    <h1><?= display_flash_message_by_type("command-success"); ?></h1>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($command->products as $product): ?>
            <tr>
                <td><?= $product->name ?></td>
                <td class="product-price"><?= $product->price ?> €</td>
                <td class="product-quantity"><?= $product->quantity ?></td>
                <td class="product-rating" data-id=<?= $product->id ?>>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <?php if (isset($product->rate)) : ?>
                            <?php if ($i <= $product->rate) : ?>
                                <i class="fas fa-star star"></i>
                            <?php else : ?>
                                <i class="far fa-star star"></i>
                            <?php endif; ?>
                        <?php else : ?>
                            <i class="far fa-star star"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>Total : <?= $command->total ?> €</p>

<div class="seller-ratings">
    <?php foreach($command->sellers as $seller): ?>
        </p>Notez le vendeur <?= $seller->pseudo ?> 
        ( Produit(s) :  
        <?php foreach($seller->products as $index => $product):
             echo $product->name . ($index < count($seller->products) - 1 ? ", " : "");
        endforeach; ?> ) :
        </p>
        <div class="seller-rating" data-id=<?= $seller->id ?>>
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <?php if (isset($seller->rating)) : ?>
                    <?php if ($i <= $seller->rating) : ?>
                        <i class="fas fa-star star"></i>
                    <?php else : ?>
                        <i class="far fa-star star"></i>
                    <?php endif; ?>
                <?php else : ?>
                    <i class="far fa-star star"></i>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endforeach; ?>
</div>