<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 * 
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
case 'demandeConnexion':
    include 'vues/v_connexion.php';//affiche dmd de connexion
    break;//
case 'valideConnexion':
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);// pr dire que le fitre,appliquer filtre en string
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    $visiteur = $pdo->getInfosVisiteur($login, $mdp);// represnete la connexion entre php et base de donnee
    $comptable = $pdo->getInfosComptable($login, $mdp);// represnete la connexion entre php et base de donnee
    
    
    if (!is_array($visiteur)&&!is_array($comptable))  {
        ajouterErreur('Login ou mot de passe incorrect');
        include 'vues/v_erreurs.php';//affiche 
        include 'vues/v_connexion.php';
    } else {
        if (is_array($visiteur)){
        $id = $visiteur['id'];
        $nom = $visiteur['nom'];
        $prenom = $visiteur['prenom'];
        $statut='visiteur';}
        
        elseif (is_array($comptable)){
  
            $id = $comptable['id'];
            $nom = $comptable['nom'];
            $prenom = $comptable['prenom'];
            $statut='comptable';
        }
            connecter($id, $nom, $prenom,$statut);
            header('Location: index.php');
        }
    break;
default:
    include 'vues/v_connexion.php';
    break;
}
