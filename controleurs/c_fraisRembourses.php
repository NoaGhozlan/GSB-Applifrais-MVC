<?php

$pdo = PdoGsb::getPdoGsb();
$anneeCourante = date("Y");
//echo $anneeCourante; pour le test de la fonction date
$lesAnnees = getLesCinqDernieresAnnees($anneeCourante);
//var_dump($lesAnnees); test de la fonction
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);



switch ($action){
  case 'fraisRemb':
      $lesCles = array_keys($lesAnnees);
      $anneeASelectionner = $lesCles[0];
      
      include 'vues/v_listeAnnees.php';
      
      
      break;
  case 'validAnnee':
      $anneeChoisie = filter_input(INPUT_POST, 'lstAnnees', FILTER_SANITIZE_STRING);
      $totalMontant = $pdo->getTotalRemboursement($anneeChoisie);
     // var_dump($totalMontant); die();
      $nbFichesRB = $pdo->getNombreFichesRB($anneeChoisie);
      include 'vues/v_afficheRemb.php';
      
      break;
  
  default;
}

