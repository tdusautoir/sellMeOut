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
                    <h3><?= $product->name ?></h3>
                    <div class="resume">
                        <p> <?= $product->quantity ?> <?= $product->name ?> commandé pour un total de <?= $product->total ?> €</p>
                    </div>
                    <div class="commands-list">
                        <?php foreach($commands[$product->id] as $command): ?>
                            <div class="container">
                                <div class="command">
                                    <h3>Commande du <?= (new DateTime($command->date, new DateTimeZone('UTC')))->setTimezone(new DatetimeZone('Europe/Paris'))->format('d-m-Y'); ?></h3>
                                    <div class="command-details">
                                        <p>Quantité : <?= $command->quantity ?></p>
                                        <p>Total : <?= $command->total ?> €</p>
                                        <p>Acheté par "<?= $command->mail ?>" 
                                        ( 
                                            <?php if($command->rate): ?>
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <?php if (isset($command->rate)) : ?>
                                                        <?php if ($i <= $command->rate) : ?>
                                                            <i class="fas fa-star star"></i>
                                                        <?php else : ?>
                                                            <i class="far fa-star star"></i>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <i class="far fa-star star"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            <?php else: ?>
                                                Aucune note
                                            <?php endif; ?>
                                            )
                                        </p>
                                        <p>Commandé à <?= (new DateTime($command->date, new DateTimeZone('UTC')))->setTimezone(new DatetimeZone('Europe/Paris'))->format('H:i:s'); ?></p>
                                    </div>
                                </div>
                                <div class="show-details"><i class="fa-solid fa-chevron-down"></i></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <span class="bar"></span>
            <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>