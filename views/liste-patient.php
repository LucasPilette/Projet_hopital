
<div class="container">
    <div class="headContainer">
        <h2>Liste patients :</h2>
        <div class="addPatient">
            Ajouter un patient 
            <a class="addPatientLink"href="/ajout-patient"><img  class="addPatientSvg" src="/public/assets/src/plus.png" alt=""></a>
        </div>
    </div>

    <table>
        <thead>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            foreach($patientList as $patient){
                echo '<tr><td>'.$patient->id.'</td><td>'.$patient->firstname.'</td><td>'.$patient->lastname.'</td><td>'.date('j M Y', strtotime($patient->birthdate)).
                '</td><td><a href="tel:'.$patient->phone.'">'.$patient->phone.'</a></td><td><a href="mailto:'.$patient->mail.'">'.$patient->mail.'</a></td><td class ="activeCase"><a href="/profil-patient?id='.$patient->id.'"> Voir le profil </a></td></tr>';
            }
            
            ?>
        </tbody>
    </table>
</div>



