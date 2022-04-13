<div class="container">
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
</div>



