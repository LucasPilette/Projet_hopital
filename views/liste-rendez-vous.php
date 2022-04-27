<?=SessionFlash::display('message')?>
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
            <th></th>
        </thead>
        <tbody>
            <?php foreach($appointmentList as $appointment){ ?>
                <tr>
                    <td><?=$appointment->appointmentsId?></td>
                    <td><?=date('j M Y', strtotime($appointment->hour))?></td>
                    <td><?=date('H:i', strtotime($appointment->hour))?></td>
                    <td><?=$appointment->lastname?></td>
                    <td><?=$appointment->firstname?></td><td><?=$appointment->mail?></td>
                    <td class ="activeCase" ><a href="/info-rendez-vous?id=<?=$appointment->appointmentsId?>"> Plus d'informations </a></td>
                    <td class="delete"><a href="/supprimer-rendez-vous?id=<?=$appointment->appointmentsId?>">Supprimer le RDV</a> </td>
                </tr>

            <?php } ?>
            
            
        </tbody>
    </table>
    <div class="pagination">
        <?php 
        for($count = 1; $count <= $pages ; $count++){
            $class = $page == $count ? 'active' : '';?>
            <a href="?page=<?=$count?>" class="<?=$class?>"><?=$count?></a>
        <?php } ?>
    </div>
</div>