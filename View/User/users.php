<div class="users">
    <h2>Liste des utilisateurs</h2>
    <div class="users-list">
        <?php foreach($users as $user): ?>
            <div class="user-card" data-href="/User/<?= $user->id ?>">
                    <h4><?= $user->pseudo ?></h4>
                    <p><?= $user->mail ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>