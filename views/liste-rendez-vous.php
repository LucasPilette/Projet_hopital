<div class="container">
    <div class="headContainer">
        <h2>Liste rendez-vous :</h2>
        <div class="addPatient">
            Ajouter un rendez-vous
            <a class="addPatientLink"href="/rendez-vous"><img  class="addPatientSvg" src="/public/assets/src/plus.png" alt=""></a>
        </div>
    </div>

    <table>
        <thead>
            <th>ID</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            foreach($appointmentList as $appointment){
                echo '<tr><td>'.$appointment->appointmentsId.'</td><td>'.date('j M Y', strtotime($appointment->hour)).'</td><td>'.date('H:i', strtotime($appointment->hour))
                .'</td><td>'.$appointment->lastname.'</td><td>'.$appointment->firstname.'</td><td>'.$appointment->mail.'</td><td><a href="/info-rendez-vous?id='.$appointment->appointmentsId.'"> Plus d\'informations </a></td></tr>';
            }
            
            ?>
        </tbody>
    </table>
</div>