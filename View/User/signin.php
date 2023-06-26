<h2>Signin</h2>

<form action="/signin" method="POST">
    <!-- <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo"> -->

    <label for="mail">Mail</label>
    <input type="text" id="mail" name="mail" class="<?= isset($error_mail) ? "error" : "" ?>">

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password">

    <button type="submit">Envoyer</button>
</form>