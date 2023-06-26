document.querySelectorAll('.product-card').forEach(product => {
    product.addEventListener('click', () => {
        window.location.href = `/products/${product.dataset.id}`;
    });
});