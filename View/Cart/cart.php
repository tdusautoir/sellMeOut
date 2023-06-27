<div class="cart-title">
    <h2>Panier</h2>
    <i class="fa-solid fa-basket-shopping"></i>
</div>


<?php if(isset($cart) && !empty($cart)): ?>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cart as $product): ?>
                <tr>
                    <td><?= $product->name ?></td>
                    <td class="product-price"><?= $product->price ?>€</td>
                    <td class="product-quantity"><?= $product->quantity ?></td>
                    <td>
                        <form action="/cart/remove/<?= $product->id ?>" method="POST">
                            <button><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="command-price">
        <p class="price-total">Total : <?= $total ?> €</p>
        <form action="/cart/command" method="POST">
            <button>Buy <i class="fa-solid fa-cart-shopping"></i></button>
        </form>
    </div>
    
<?php else: ?>
    <p>Votre panier est vide</p>
<?php endif; ?>