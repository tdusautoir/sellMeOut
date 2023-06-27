<div class="cart-title">
    <h2>Panier</h2>
    <i class="fa-solid fa-basket-shopping"></i>
</div>


<?php if(isset($products) && !empty($products)): ?>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
                <tr>
                    <td><?= $product->name ?></td>
                    <td class="product-price"><?= $product->price ?>€</td>
                    <td class="product-quantity"><?= $product->quantity ?></td>
                    <td><a href=""><i class="fa-solid fa-trash-can"></i></a></td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Votre panier est vide</p>
<?php endif; ?>