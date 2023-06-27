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

    <div class="role">
        <p class="Role">Rôle</p>
        <select id="role" name="role">
            <option value=""></option>
            <option value="seller">Vendeur</option>
            <option value="buyer">Acheteur</option>
        </select>
    </div>
    
    <button type="submit">Connexion</button>
</form>

<a class="signin" href="/signup">Vous n'avez pas encore de compte.</a>
