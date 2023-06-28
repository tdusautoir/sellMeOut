<h2>Commandes</h2>

<?php if(empty($commands)): ?>
    <p>Vous n'avez passer aucune commande</p>
<?php else: ?>
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
<?php endif; ?>