
<div class="container">
    <div class="headContainer">
        <h2>Liste patients :</h2>
        <div class="addPatient">
            Ajouter un patient 
            <a class="addPatientLink"href="/ajout-patient"><img  class="addPatientSvg" src="/public/assets/src/plus.png" alt=""></a>
        </div>
    </div>
    <div class="searchBar">
        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" id="searchForm">
            <input type="text" name="search" id="searchBox" autocomplete="off" value="<?=$search ?? ''?>">
            <!-- <input type="submit" value="Rechercher"> -->
            <div class="suggestions">
            <ul id="suggestions">

            </ul>
        </div>
        </form>
        
    </div>

    <?php if(!empty($_POST)){ ?>
        <table>
        <thead>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($results as $result){ ?>
                <tr>
                    <td><?=$result->id?></td>
                    <td><?=$result->firstname?></td>
                    <td><?=$result->lastname?></td>
                    <td><?=date('j M Y', strtotime($result->birthdate))?></td>
                    <td><a href="tel:<?=$result->phone?>"><?=$result->phone?></a></td>
                    <td><a href="mailto:<?=$result->mail?>"><?=$result->mail?></a></td>
                    <td class ="activeCase"><a href="/profil-patient?id=<?=$result->id?>"> Voir le profil </a></td>
                    <td class="delete suppApp"><a href="/supprimer-patient?id=<?=$result->id?>">Supprimer le patient</a> </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <table>
        <thead>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($patientList as $patient){ ?>
                <tr>
                    <td><?=$patient->id?></td>
                    <td><?=$patient->firstname?></td>
                    <td><?=$patient->lastname?></td>
                    <td><?=date('j M Y', strtotime($patient->birthdate))?></td>
                    <td><a href="tel:<?=$patient->phone?>"><?=$patient->phone?></a></td>
                    <td><a href="mailto:<?=$patient->mail?>"><?=$patient->mail?></a></td>
                    <td class ="activeCase"><a href="/profil-patient?id=<?=$patient->id?>"> Voir le profil </a></td>
                    <td class="delete"><a href="/supprimer-patient?id=<?=$patient->id?>">Supprimer le patient</a> </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php }?>
    <div class="pagination">
    <?php 
        for($count = 1; $count <= $pages ; $count++){
            $class = $page == $count ? 'active' : '';?>
            <a href="?page=<?=$count?>" class="<?=$class?>"><?=$count?></a>
        <?php } ?>
    </div>

</div>



