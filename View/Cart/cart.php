<h2>Panier</h2>

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
                    <td><?= $product->price ?>€</td>
                    <td><?= $product->quantity ?></td>
                    <td>
                        <form action="/cart/remove/<?= $product->id ?>" method="POST">
                            <button>Supprimer</button>
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