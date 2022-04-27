<?=SessionFlash::display('message')?>
<div class="container" id="profile">
    <div class="cardUser">
        <div class="textCard">
            <div> <p><span class="elemCard">Prénom : </span> <?=$patientAccount->firstname?></p></div>
            <div> <p><span class="elemCard">Nom :</span> <?=$patientAccount->lastname?></p></div>
            <div> <p><span class="elemCard">Date de naissance : </span><?=date('j M Y', strtotime($patientAccount->birthdate))?> </p></div>
            <div> <p><span class="elemCard">Numéro de téléphone :</span><?=$patientAccount->phone?> </p></div>
            <div> <p><span class="elemCard">Mail :</span><?=$patientAccount->mail?> </p></div>
            <div class="modifyPatient"> <a href="/modifier-patient?id=<?=$patientAccount->id?>">Modifier le profil</a></div>
        </div>
        <div class="pictureCard">
            <img src="/public/assets/src/User-icon.png" alt="">
        </div>
    </div>
    <div class="appList">
        <?php if(!empty($appList)) :?>
        <h2>Rendez-vous :</h2>
    <table>
        <thead>
            <th>ID</th>
            <th>Date</th>
            <th>Heure</th>
            <th></th>
        </thead>
        <tbody>
            <?php
                foreach($appList as $app){
                    echo '<tr><td>'.$app->appointmentsId.'</td>
                    <td>'.date('j M Y', strtotime($app->hour)).'</td>
                    <td>'.date('H:i', strtotime($app->hour)).'</td>
                    <td class="delete"><a href="/supprimer-rendez-vous?id='.$app->appointmentsId.'">Supprimer</a>   </td>
                    </tr>';
                }
            ?> 
        </tbody>
    </table>
    <?php endif; ?>
    <?php if(empty($appList)) :?>
        <h2>Pas de rendez-vous</h2>
    <?php endif;?>
    </div>
</div>



