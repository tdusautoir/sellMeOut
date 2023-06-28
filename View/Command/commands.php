<h2>Commandes</h2>

<?php if(empty($commands)): ?>
    <p>Vous n'avez passer aucune commande</p>
<?php else: ?>
    <div class="commands-list">
        <?php foreach($commands as $command): ?>
            <a href="/profil/commands/<?= $command->id ?>">
                <div class="command">
                    <h3>Commande n.<?= $command->id ?></h3>
                    <p><?= $command->total ?></p>
                    <p><?= (new DateTime($command->date, new DateTimeZone('UTC')))->setTimezone(new DatetimeZone('Europe/Paris'))->format('d-m-Y H:i:s'); ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>