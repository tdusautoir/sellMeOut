<h2>Ajout produit</h2>

<form action="/Product/new" method="POST">
    <label for="name">Nom</label>
    <input type="text" id="name" name="name">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>

    <label for="price">prix</label>
    <input type="number" id="price" name="price" step="0.01" min="0">

    <button type="submit">Ajouter</button>
</form>