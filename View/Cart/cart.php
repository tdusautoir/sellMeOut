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
        <!-- <form action="/cart/command" method="POST"> -->
            <button id="open-modal">Buy <i class="fa-solid fa-cart-shopping"></i></button>
        <!-- </form> -->
        <div class="modal" id="modal">
            <div class="modal-content">
                <p>Êtes-vous sûr de vouloir continuer ?</p>
                <button id="paiement">Buy <i class="fa-solid fa-cart-shopping"></i></button>
                <button id="close-modal"><i class="fa-solid fa-xmark" ></i></button>
            </div>
        </div>
    </div>
    
<?php else: ?>
    <p>Votre panier est vide</p>
<?php endif; ?>