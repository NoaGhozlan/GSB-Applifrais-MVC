<?php

$mois = getMois(date('d/m/Y')); //retourne aaaa.mm qd on rentre la date, en supprimant la valeur du jour
$moisPrecedent = getMoisPrecedent($mois);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$fichesCL = $pdo->ficheDuMoisCloturees($moisPrecedent);
$pdo = PdoGsb::getPdoGsb();

switch ($action) {
    case 'valider':

        $lesVisiteurs = $pdo->getLesVisiteurs($pdo);
        $lesMois = getLesDouzeDerniersMois($mois);
        $lesClesM = array_keys($lesMois);
        $moisASelectionner = $lesClesM[0];
        $lesClesV = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesClesV[0];

        if ($fichesCL) {
            include 'vues/v_listesVisiteursMois.php';
        } else {
            $pdo->clotureFiches($moisPrecedent); //cr en cl
            include 'vues/v_listesVisiteursMois.php'; //afficher listemois et listevisiteur
        }
        break;
    case 'validerVM':
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $leVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $moisASelectionner = $leMois;
        $visiteurASelectionner = $leVisiteur;
        $lesMois = getLesDouzeDerniersMois($mois);
        $lesVisiteurs = $pdo->getLesVisiteurs($pdo);

        //affiche les info des fiches de frais du visiteur et mois selectionnes
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
        $infosFiche = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);

        if (!is_array($infosFiche)) { //si la fiche n'a pas d info, c est qu elle n existe pas dc erreur
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_listesVisiteursMois.php';
        } else {
            include 'vues/v_listesVisiteursMois.php';
            include 'vues/v_afficheFrais.php';
        }
        break;

    case 'validerMajFraisForfait':
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $leVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $moisASelectionner = $leMois;
        $visiteurASelectionner = $leVisiteur;
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);

        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($leVisiteur, $leMois, $lesFrais);
            

        } else {
            ajouterErreur('Les valeurs des frais doivent être numériques');
            include 'vues/v_erreurs.php';
        }
       
        break;
    default;
}


