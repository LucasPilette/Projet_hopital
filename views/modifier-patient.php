<div class="addPatientForm">
    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">

        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?= $patientAccount->firstname ?? '' ?>">
        <span class="error"><?= $errors['firstname'] ?? '' ?></span>

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" value="<?= $patientAccount->lastname ?? '' ?>">
        <span class="error"><?= $errors['lastname'] ?? '' ?></span>

        <label for="birthDate">Date de naissance</label>
        <input type="date" name="birthDate" id="birthDate" value="<?= $patientAccount->birthdate ?? '' ?>">
        <span class="error"><?= $errors['birthDate'] ?? '' ?></span>

        <label for="phone">Numéro de téléphone</label>
        <input type="text" name="phone" id="phone" value="<?= $patientAccount->phone ?? '' ?>" pattern="<?=REG_EXP_PHONE?>">
        <span class="error"><?= $errors['phone'] ?? '' ?></span>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $patientAccount->mail ?? '' ?>">
        <span class="error"><?= $errors['email'] ?? '' ?></span>

        <input type="submit" value="Modifier mes données" class="submit">
        <a href="/profil-patient?id=<?=$patientAccount->id?>">Retour au profil</a>
    </form>
</div>