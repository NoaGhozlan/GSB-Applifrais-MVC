<?php

?>
<div id="accueil">
    <h2>
        Gestion des frais<small> - Comptable : 
            <?php 
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            ?></small>
    </h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span>
                    Navigation
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a href="index.php?uc=validerFrais&action=valider"
                           class="btn btn-success btn-lg" role="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <br>Valider les fiches de frais</a>
                        <a href="index.php?uc=validerFrais"
                           class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon glyphicon-euro"></span>
                            <br>Suivre le paiement des fiches de frais</a>
                        <a href="index.php?uc=remboursementFrais&action=fraisRemb"
                           class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon glyphicon-euro"></span>
                            <br>Frais remboursés par année</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>