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

    <p>Total : <?= $total ?> €</p>

    <form action="/cart/command" method="POST">
        <button>Commander</button>
    </form>
<?php else: ?>
    <p>Votre panier est vide</p>
<?php endif; ?>