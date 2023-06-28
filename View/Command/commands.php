<h2>Commandes</h2>

<?php if(empty($commands)): ?>
    <p>Vous n'avez passer aucune commande</p>
<?php else: ?>
    <?php if($_SESSION["user"]->role == "buyer"): ?>
    <div class="commands-list">
        <?php foreach($commands as $command): ?>
            <div class="container">
                <a href="/profil/commands/<?= $command->id ?>" class="command">
                    <h3>Commande N.<?= $command->id ?></h3>
                    <div class="command-details">
                        <p><?= $command->total ?> €</p>
                        <p><?= (new DateTime($command->date, new DateTimeZone('UTC')))->setTimezone(new DatetimeZone('Europe/Paris'))->format('d-m-Y H:i:s'); ?></p>
                    </div>
                </a>
                <div class="show-details"><i class="fa-solid fa-chevron-down"></i></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php elseif($_SESSION["user"]->role == "seller"): ?>
            <?php foreach($products as $product): ?>
                <div class="product">
                    <h3>Produit : <?= $product->name ?></h3>
                    <h4>Résumé : </h4><p> Total : <?= $product->total ?> €, Quantité : <?= $product->quantity ?></h4>
                    <div class="commands-list">
                        <?php foreach($commands[$product->id] as $command): ?>
                            <div class="container">
                                <div class="command">
                                    <h3>Commande N.<?= $command->id ?></h3>
                                    <div class="command-details">
                                        <p>Quantité : <?= $command->quantity ?></p>
                                        <p>Mail : <?= $command->mail ?></p>
                                        <p>Total : <?= $command->total ?> €</p>
                                        <p>Note de l'utilisateur : <?= $command->rate !== false ? $command->rate : "Pas de note";  ?></p>
                                        <p>Date : <?= (new DateTime($command->date, new DateTimeZone('UTC')))->setTimezone(new DatetimeZone('Europe/Paris'))->format('d-m-Y H:i:s'); ?></p>
                                    </div>
                                </div>
                                <div class="show-details"><i class="fa-solid fa-chevron-down"></i></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>