<div class="container">
<h2>Infos Rendez-vous</h2>
    <div class="cardUser">
        <div class="textCard">
            <div> <p><span class="elemCard">Date : </span> <?=date('j M Y', strtotime($appointmentInfos->hour))?></p></div>
            <div> <p><span class="elemCard">Heure :</span> <?=date('H:i', strtotime($appointmentInfos->hour))?></p></div>
            <div> <p><span class="elemCard">Nom : </span><?=$appointmentInfos->lastname?> </p></div>
            <div> <p><span class="elemCard">Prénom :</span><?=$appointmentInfos->firstname?> </p></div>
            <div> <p><span class="elemCard">Mail :</span><?=$appointmentInfos->mail?> </p></div>
            <div class="modifyPatient"> <a href="/modifier-rendez-vous?id=<?=$appointmentInfos->appointmentsId?>">Modifier le rendez-vous</a></div>
        </div>
        <div class="pictureCard">
            <img src="/public/assets/src/rdv.png" alt="">
        </div>
    </div>
</div>