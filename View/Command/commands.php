<h2>Commandes</h2>

<?php if(empty($commands)): ?>
    <p>Vous n'avez passer aucune commande</p>
<?php else: ?>
    <?php if($_SESSION["user"]->role == "buyer"): ?>
    <div class="commands-list">
        <?php foreach($commands as $command): ?>
                <a href="/profil/commands/<?= $command->id ?>">
                    <div class="command">
                        <h3>Commande n.<?= $command->id ?></h3>
                        <p>Total : <?= $command->total ?></p>
                        <p>Date : <?= (new DateTime($command->date, new DateTimeZone('UTC')))->setTimezone(new DatetimeZone('Europe/Paris'))->format('d-m-Y H:i:s'); ?></p>
                    </div>
                </a>
        <?php endforeach; ?>
    </div>
    <?php elseif($_SESSION["user"]->role == "seller"): ?>
            <?php foreach($products as $product): ?>
                <div class="product">
                    <h3>Produit : <?= $product->name ?></h3>
                    <div class="commands-list">
                        <?php dump($commands[$product->id]); ?>
                        <?php foreach($commands[$product->id] as $command): ?>
                            <?php dump($command) ?>
                        <?php endforeach; ?>
                        <!-- <?php foreach($commands[$product->id] as $command): ?>
                            <div class="command">
                                <h4>Commande n.<?= $command->id ?></h4>
                                <p>Total : <?= $command->total ?></p>
                                <p>Date : <?= (new DateTime($command->date, new DateTimeZone('UTC')))->setTimezone(new DatetimeZone('Europe/Paris'))->format('d-m-Y H:i:s'); ?></p>
                            </div>
                        <?php endforeach; ?> -->
                    </div>
                </div>
            <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>