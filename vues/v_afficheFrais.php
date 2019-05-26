

<form method="post" 
      action="index.php?uc=validerFrais&action=validerMajFraisForfait" 
      role="form">
    <div class="row">
        <div class="col-md-4" >
            <div class="form-group" >
                <label for="lstVisiteurs" accesskey="n">Choisir le visiteur: </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>

        </div>

        <div class="col-md-4" >
            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($lesMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>                        

                </select>
            </div>
        </div>
    </div>
    <?php if(isset($message)){ ?>
    <div class="alert alert-success"><?= $message ?></div>
    <?php } ?>
    <div class="row">
        <h2><FONT color="darkorange">Valider la fiche de frais 
            <?php echo $moisAAfficher . '-' . $anneeAAfficher ?>
            </FONT></h2>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
            </fieldset>
        </div>
    </div>
</form>

<hr>

<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Id</th>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
                <?php
                foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                    $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                    $date = $unFraisHorsForfait['date'];
                    $montant = $unFraisHorsForfait['montant'];
                    $id = $unFraisHorsForfait['id'];
                    ?> 
                <form method="post" 
                      action="index.php?uc=validerFrais&action=validerMajFraisHorsForfait" 
                      role="form">
                    <tr>
                        <td><?= $id ?></td>
                        <td><input readonly type="text" id="txtDateHF" name="dateFrais" 
                                   class="form-control" id="text" value="<?php echo $date ?>"> </td>
                        <td><input readonly type="text" id="txtLibelleHF" name="libelle" 
                                   class="form-control" id="text" value="<?php echo $libelle ?>"> </td>
                        <td><input readonly type="text" id="txtMontantHF" name="montant" 
                                   class="form-control" value="<?php echo $montant ?>"></td>
                        <td><input type="hidden" id="lstVisiteurs" name="lstVisiteurs" value="<?= $visiteurASelectionner ?>">
                            <input type="hidden" id="lstMois" name="lstMois" value="<?= $moisASelectionner ?>">
                            <input type="hidden" id="idFHF" name="idFHF" value="<?= $id ?>">

                            <button class="btn btn-success" type="submit">Refuser</button>
                            <button class="btn btn-danger" type="reset">Réinitialiser</button></td>
                    </tr>
                </form>

                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>

    <form method="post" 
          action="index.php?uc=validerFrais&action=validerFicheFrais" 
          role="form"> 
        <input type="hidden" id="lstMois" name="lstMois" value="<?= $moisASelectionner ?>">
        <input type="hidden" id="lstVisiteurs" name="lstVisiteurs" value="<?= $visiteurASelectionner ?>">
        Nombre de justificatifs: <input type="text" id="nbJust" name="nbJust" size="4" value="<?= $nbJustificatifs ?>">
        <br><br>
        <button class="btn btn-success" type="submit">Valider</button>
        <button class="btn btn-danger" type="reset">Effacer</button>
    </form> 
</div>


