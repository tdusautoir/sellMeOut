<h2>Sign up</h2>

<form action="/signin" method="POST">
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
        <select id="role" >
            <option value=""></option>
            <option value="seller">Vendeur</option>
            <option value="buyer">Acheteur</option>
        </select>
    </div>
    

    <button type="submit">S'inscrire</button>
</form>