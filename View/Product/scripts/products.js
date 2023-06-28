document.querySelectorAll('.product-card').forEach(product => {
    product.addEventListener('click', () => {
        window.location.href = `/products/${product.dataset.id}`;
    });
});

document.getElementById("search").addEventListener("keyup", function(event) {
    document.getElementById("search-btn").href = encodeURI("/products/search/" + event.target.value);
});