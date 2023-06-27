var menu = document.getElementById("connexion-menu");
var sousMenu = document.getElementById("connexion-sous-menu");

menu.addEventListener("click", function(e) {
  if (sousMenu.classList.contains('visible')) {
    sousMenu.classList.remove('visible');
  } else {
    sousMenu.classList.add('visible');
  }
});

