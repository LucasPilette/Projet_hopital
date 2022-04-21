<div class="addAppForm">
    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">

        <label for="date">Date</label>
        <input type="date" name="date" min="<?=date('Y-m-d')?>" id="date" value="<?= $date ?? date('Y-m-d') ?>">
        <span class="error"><?= $errors['date'] ?? '' ?></span>

        <label for="schedule"> Heure (Ouvert de 08h du matin à 20h)</label>
        <input type="time" name="hour" min="08:00" max="20:00" step="300" value="<?=$hour ?? date('H:i')?>">
        <span class="error"><?= $errors['schedule'] ?? '' ?></span>
        

        <label for="patient">Patient</label>
        <select name="patient" id="patient">
            
            
            <?php
                foreach($patientList as $index => $patient){
                    if($index == 0){
                        echo '<option value=""> Sélectionnez un client </option>';
                    }
                    if($patientValue == $patient->id){
                        echo '<option  selected  value = "'.$patient->id.'" >'.$patient->firstname.' '.$patient->lastname.'</option>' ;
                    } else {
                        echo '<option value = "'.$patient->id.'" >'.$patient->firstname.' '.$patient->lastname.'</option>' ;
                    }

                }
            ?>
        </select>
        <span class="error"><?= $errors['patient'] ?? '' ?></span>

        <input type="submit" value="Ajouter rendez-vous" class="submit">
    </form>
</div>