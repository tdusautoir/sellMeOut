<?php

// $RdmImg = [
//   "./1.png",
//   "./2.png",
//   "./3.png",
//   "./4.png",
//   "./5.png",
// ];

// $RdmImg_id = mt_rand(0,(count($RdmImg)-1));

// header('Location :'.$RdmImg[$RdmImg_id]);

$dir = '../Images/randomImage'; // Chemin vers le dossier contenant les images
$numberOfImages = 5; // Nombre total d'images disponibles
$randomImageNumber = rand(1, $numberOfImages); // Génère un numéro aléatoire entre 1 et le nombre total d'images
$randomImage = $dir . '/' . $randomImageNumber . '.png'; // Chemin de l'image aléatoire

// Redirige vers la page cible avec le chemin de l'image en tant que paramètre GET
header('Location: ../../View/Product/products.php?image=' . urlencode($randomImage));
exit();

?>