<h2>Login</h2>

<form action="/login" method="POST">
    <!-- <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo"> -->
    <div class="Mail">
        <label for="mail">Mail</label>
        <input class="error" type="text" id="mail" name="mail">
    </div>

    <div class="Password">
        <label for="password">Mot de passe</label>
        <input class="error" type="password" id="password" name="password">
    </div>
    
    <button type="submit">Connexion</button>
</form>

<a class="signin" href="/signin">Vous n'avez pas encore de compte ?</a>