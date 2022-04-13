<div class="addPatientForm">
    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">

        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="<?= $firstname ?? '' ?>">
        <span class="error"><?= $errors['firstname'] ?? '' ?></span>

        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" value="<?= $lastname ?? '' ?>">
        <span class="error"><?= $errors['lastname'] ?? '' ?></span>

        <label for="birthDate">Date de naissance</label>
        <input type="date" name="birthDate" id="birthDate" value="<?= $birthDate ?? '' ?>">
        <span class="error"><?= $errors['birthDate'] ?? '' ?></span>

        <label for="phone">Numéro de téléphone</label>
        <input type="text" name="phone" id="phone" value="<?= $phone ?? '' ?>">
        <span class="error"><?= $errors['phone'] ?? '' ?></span>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $email ?? '' ?>">
        <span class="error"><?= $errors['email'] ?? '' ?></span>

        <input type="submit" value="Ajouter patient" class="submit">
    </form>
</div>