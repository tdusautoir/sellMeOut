document.querySelectorAll('.user-card').forEach((card) => {
    card.addEventListener('click', () => {
        window.location.href = card.dataset.href;
    });
});