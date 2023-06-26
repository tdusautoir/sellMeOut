<h2>Ajout produit</h2>

<form action="/Product/new" method="POST">
    <div class="name">
        <label for="name">Nom</label>
        <input class="error" type="text" id="name" name="name"> 
    </div>

    <div class="description">
        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </div>

    <div class="price">
        <label for="price">Prix</label>
        <input class="error" type="number" id="price" name="price" step="0.01" min="0">
    </div>

    <button type="submit">Ajouter</button>
</form>