document.querySelectorAll('.product-card').forEach(product => {
    product.addEventListener('click', () => {
        window.location.href = `/products/${product.dataset.id}`;
    });
});

const search = document.getElementById("search");
const searchBtn = document.getElementById("search-btn");
const searchUri = searchBtn.href;

search.addEventListener("keyup", function(event) {
    searchBtn.href = encodeURI(searchUri + event.target.value);
});