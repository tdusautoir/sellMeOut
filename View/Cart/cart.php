<h2>Panier</h2>

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
                    <td><?= $product->price ?>€</td>
                    <td><?= $product->quantity ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Votre panier est vide</p>
<?php endif; ?>