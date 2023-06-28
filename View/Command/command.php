<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($command->products as $product): ?>
            <tr>
                <td>Commande n.<?= $product->id ?></td>
                <td><?= $product->name ?></td>
                <td class="product-price"><?= $product->price ?>€</td>
                <td class="product-quantity"><?= $product->quantity ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>Total : <?= $command->total ?> €</p>