<div class="animTitres pageAccueil">


    <?php if (!estConnecte()) :  ?>

        <h1>Pour accéder à ce service</h1>
        <h2>Veuillez vous connecter <a href="<?= URL ?>login">
                <i class="fa-solid fa-link fa-bounce"></i>
            </a>
            <br><br>
            Ou vous inscrire <a href="<?= URL ?>creerCompte">
            <i class="fa-solid fa-user-plus fa-bounce"></i>
            </a></h2>
        <h3>Créez plusieurs listes (ToBuy, ToDo...)</h3>
        <h3>Permettez à d'autres utilisateurs d'accéder à une ou plusieurs listes, </h3>
        <h3>Ou seulement d'ajouter des éléments. </h3>
        <?php else : ?>
            <h1>coucou <?= $utilisateur['login'] ?></h1>
            <?= afficherTableau($utilisateur)  ?>



    <?php endif ?>




</div>