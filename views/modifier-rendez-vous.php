<div class="addAppForm">
    <?php 
    if(isset($error)){
        echo $error;
    } else {
    ?>

    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">

        <label for="date">Date</label>
        <input type="date" name="date" id="date" value="<?=date('Y-m-d', strtotime($appointmentOne->hour)) ?? '' ?>">
        <span class="error"><?= $errors['date'] ?? '' ?></span>

        <label for="schedule"> Heure (Ouvert de 08h du matin à 20h)</label>
        <input type="time" name="hour" min="08:00" max="20:00" step="300" value="<?=date('H:i', strtotime($appointmentOne->hour)) ?? ''?>">
        <span class="error"><?= $errors['schedule'] ?? '' ?></span>
        

        <label for="patient">Patient</label>
        <select name="patient" id="patient">
            <?php
                foreach($patientList as  $index => $patient ){
                    if($patientList[$index]->id == $appointmentOne->patientsId){
                        echo '<option  selected  value = "'.$patient->id.'" >'.$patient->firstname.' '.$patient->lastname.'</option>' ;
                    } else {
                        echo '<option value = "'.$patient->id.'" >'.$patient->firstname.' '.$patient->lastname.'</option>' ;
                    }
                }
            ?>
        </select>
        
        <span class="error"><?= $errors['patient'] ?? '' ?></span>

        <input type="submit" value="Modifier le rendez-vous" class="submit">
        <a href="/info-rendez-vous?id=<?=$appointmentOne->appointmentsId?>">Retour au profil</a>
    </form>
    <?php } ?>
</div>