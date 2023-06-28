var modal  = document.getElementById("modal");

var openModal = document.getElementById("open-modal");

var closeModal = document.getElementById('close-modal');

var paiement = document.getElementById("paiement");

openModal.onclick = function(){
  modal.style.display="block";
}

closeModal.onclick = function(){
  modal.style.display="none";
}

paiement.onclick = function(){
  modal.style.display="none";
}

window.onclick = function(e){
  if (e.target == modal) {
    modal.style.display="none";
    }
}