<?php


$moisDebut = '201609';
require './fonctions.php';

$pdo = new PDO('mysql:host=localhost;dbname=gsb_frais', 'root', '');
$pdo->query('SET CHARACTER SET utf8');

set_time_limit(0);
creationFichesFrais($pdo);
creationFraisForfait($pdo);
creationFraisHorsForfait($pdo);
majFicheFrais($pdo);
echo '<br>' . getNbTable($pdo, 'fichefrais') . ' fiches de frais créées !';
echo '<br>' . getNbTable($pdo, 'lignefraisforfait')
        . ' lignes de frais au forfait créées !';
echo '<br>' . getNbTable($pdo, 'lignefraishorsforfait')
        . ' lignes de frais hors forfait créées !';
