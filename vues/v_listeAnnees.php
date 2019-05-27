
<div class="row">
    <form action="index.php?uc=remboursementFrais&action=validAnnee" 
          method="post" role="form">
        


        <div class="col-md-4" >
            <div class="form-group">
                <label for="lstAnnees" accesskey="n">Choisir une année: </label>
                <select id="lstAnnees" name="lstAnnees" class="form-control">
                    <?php
                    foreach ($lesAnnees as $uneAnnee) {
                        $lannee = $uneAnnee['annee'];
                        
                        if ($lannee == $anneeASelectionner) {
                            ?>
                            <option selected value="<?php echo $lannee ?>">
                                <?php echo $lannee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $lannee ?>">
                                <?php echo $lannee ?> </option>
                            <?php
                        }
                    }
                    ?>                        

                </select>
            </div>
        </div>
        <div  >
            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
        </div>
    </form>  
</div>



