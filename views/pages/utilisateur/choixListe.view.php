<div class="animTitres pageListes">

    <?php if (!estConnecte()) :  ?>

        <h1>Pour accéder à ce service</h1>
        <h2>Veuillez vous connecter <a href="<?= URL ?>login">
                <i class="fa-solid fa-link fa-bounce"></i>
            </a>
            <br><br>
            Ou vous inscrire <a href="<?= URL ?>creerCompte">
                <i class="fa-solid fa-user-plus fa-bounce"></i>
            </a>
        </h2>
        <h3>Créez plusieurs listes (ToBuy, ToDo...)</h3>
        <h3>Permettez à d'autres utilisateurs d'accéder à une ou plusieurs listes, </h3>
        <h3>Ou seulement d'ajouter des éléments. </h3>
    <?php else : ?>

        <h1 class="clipH1 h1ChoixListe">Les listes</h1>

        <div class="actionScreenMenu">
            <a href="listes"><i class="fa-solid fa-list-check"></i></a>
            <i class="fa-solid fa-file-medical creationListe"></i>
        </div>

        <!-- formulaire création liste -->
        <div class="formCreationListe dnone">
            <form action="<?= URL ?>compte/creerListe" class="formulaire" method="POST">
                <div class="entryForm">
                    <input type="text" placeholder="Nom de votre nouvelle liste" name="name_list">
                    <p class="regexListe">Nom en lettres et chiffres sans caractère spécial et/ou espace</p>
                    <input type="hidden" name="creator" value=<?= $_SESSION['profil']['login'] ?>>
                    <button>Créer Liste</button>
                    <div class="annulerFormCreationListe">
                        <p>Annuler</p>
                    </div>
                </div>
            </form>
        </div>


        <!-- liste des listes -->
        <div class="listeDesListes">
            <div class="listeListesPerso">
                <?php foreach ($listes as $liste) : ?>
                    <a href="listeChoisie/<?= $liste['name_list'] ?>/<?= $liste['creator'] ?>">
                        <div class="iconeListe listePerso">
                            <div class="nomListe">
                                <h3><?php
                                    $mots = explode("_", $liste['name_list']);
                                    $mots = array_slice($mots, 2);
                                    $nomListe = implode("_", $mots);
                                    echo $nomListe;
                                    ?></h3>
                                de
                                <h3><?= $liste['creator'] ?></h3>
                            </div>
                            <?php if ($_SESSION['profil']['login'] === $liste['creator']) : ?><br>




                                <div class="partageList">
                                    <h4>Partagée avec :</h4>
                                    <div class="utilisateursTiers">

                                        <?php foreach ($droitsListe as $utilisateur) : ?>
                                            <?php if (
                                                $utilisateur['name_list'] === $liste['name_list']
                                                &&
                                                $utilisateur['rights'] == 1
                                            ) : ?>
                                                <h4>
                                                    <?= $utilisateur['user'] ?>
                                                    <a href="effacerUtilisateur/<?= $utilisateur['id_rights'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce partage ?')">
                                                        <i class="fa-regular fa-circle-xmark"></i></a>
                                                </h4>
                                           
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </div>
                                    <br>
                                    <div class="iconesList">
                                        <a href="effacerListe/<?= $liste['name_list'] ?>/<?= $liste['creator'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')"><i class="fa-solid fa-trash"></i></a>
                                        <i class="fa-solid fa-share-nodes partageListe"></i>
                                    </div>

                                    <div class="ajouterUtilisateurListe  dnone">
                                        <form action="ajouterUtilisateurListe" method="post">
                                            <div class="entryForm ">
                                                <input type="text" name="user" placeholder="Avec qui souhaitez-vous partager cette liste ?">

                                                <input type="hidden" name="creator" value=<?= $liste['creator'] ?>>
                                                <input type="hidden" name="name_list" value=<?= $liste['name_list'] ?>>
                                                <button type="submit">Ajouter</button>
                                                <div class="annulerFormCreationListe annulerPartageListe">
                                                    <p>Annuler</p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>


            <div class="listeListesTiers">

                <?php foreach ($listesTiers as $listeTiers) : ?>
                    <a href="listeChoisie/<?= $listeTiers['name_list'] ?>/<?= $listeTiers['creator'] ?>">
                        <div class="iconeListe listeTiers">
                            <h3><?php
                                $mots = explode("_", $listeTiers['name_list']);
                                $mots = array_slice($mots, 2);
                                $nomListe = implode("_", $mots);
                                echo $nomListe;
                                ?></h3>
                            de
                            <h4><?= $listeTiers['creator'] ?></h4>
                            <a href="sortirDeListe/<?= $listeTiers['id_rights'] ?>" onclick="return confirm
                             (`Êtes-vous sûr de vouloir sortir de ce partage avec <?= $listeTiers['creator'] ?> ?`)">

                                <i class="fa-solid fa-right-from-bracket exitListeTiers"></i></a>
                        </div>
                    </a>
                <?php endforeach ?>
            </div>



        </div>
    <?php endif ?>


</div>