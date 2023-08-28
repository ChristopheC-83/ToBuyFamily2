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

        <h1 class="clipH1 h1Liste">
                    <?php
                    $mots = explode("_", $_SESSION['profil']['liste']);
                    $mots = array_slice($mots, 2);
                    $nomListe = implode("_", $mots);
                    echo $nomListe;
                    ?>
                    <span style="font-weight: normal">de</span> <?= $_SESSION['profil']['creator'] ?>
                </h1>


        <div class="actionScreenMenu">
            <a href="choixListe"><i class="fa-solid fa-arrow-rotate-left"></i></a>
            <a href="supprimerElementsListeFaits/<?= $_SESSION['profil']['liste'] ?>"><i class="fa-solid fa-trash"></i></a>
            <i class="fa-solid fa-circle-plus ajoutElementListe"></i>
        </div>

        <div class="listeEnCours">
            <?php if (isset($_SESSION['profil']['liste'])) : ?>
               

                <div class="formAjoutElement dnone">
                    <form action="<?= URL ?>compte/ajouterElement" class="formulaire" method="POST">
                        <div class="entryForm">
                            <input type="text" placeholder="Ajouter dans <?= $nomListe ?> de <?= $_SESSION['profil']['creator'] ?>" name="content" id="inputAjoutElementList" oninput="verifContenuAjoutElement()">
                            <input type="hidden" name="name_list" value=<?= $_SESSION['profil']['liste'] ?>>
                            <input type="hidden" name="creator" value=<?= $_SESSION['profil']['creator'] ?>>
                            <input type="hidden" name="contentFrom" value=<?= $_SESSION['profil']['login'] ?>>
                            <button class="btnListDisable " id="btnAjoutElementList">Ajouter élément</button>
                            <div class="annulerFormAjoutElement">
                                <p>Annuler</p>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if ($_SESSION['profil']['login'] === $_SESSION['profil']['creator']) : ?>
                    <div class="contentsList">
                        <?php foreach ($contentListPerso as $content) : ?>
                            <div class="contentList">
                                <a href="validerElement/<?= $content['id'] ?>/<?= $content['did'] ?>" class="<?= ($content['did'] ? 'a-did' : '') ?>">
                                    <p><?= $content['content'] ?></p>
                                </a>
                                <div class="miniBurger">
                                    <span class="miniBurgerPoint minBurgerPoint1"></span>
                                    <span class="miniBurgerPoint minBurgerPoint2"></span>
                                    <span class="miniBurgerPoint minBurgerPoint3"></span>
                                </div>
                                <div class="gestionElement dnone">
                                    <p>de <?= $content['contentFrom'] ?></p>
                                    <br>
                                    <p class="updateElement">Modifier</p>
                                    <br>
                                    <p><a href="supprimerElementListe/<?= $content['id'] ?> ?>">Supprimer</a></p>
                                </div>
                                <div class="modifElement dnone">
                                    <form action="modifierElementListe" method="POST" class="modifierElementListe">
                                        <input type="text" name="content" placeholder="<?= $content['content'] ?>">
                                        <input type="hidden" name="id" value="<?= $content['id'] ?>">
                                        <button type="submit" class="btnValiderModifierElement">✅</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php else : ?>
                    <!-- ########################################################### -->
                    <div class="contentsList">
                        <?php foreach ($readContentListTiers as $content) : ?>
                            <div class="contentList">
                                <a href="validerElement/<?= $content['id'] ?>/<?= $content['did'] ?>" class="<?= ($content['did'] ? 'a-did' : '') ?>"><?= $content['content'] ?></a>
                                <div class="miniBurger">
                                    <span class="miniBurgerPoint minBurgerPoint1"></span>
                                    <span class="miniBurgerPoint minBurgerPoint2"></span>
                                    <span class="miniBurgerPoint minBurgerPoint3"></span>
                                </div>
                                <div class="gestionElement dnone">
                                    <p>de <?= $content['contentFrom'] ?></p>
                                    <br>
                                    <p class="updateElement">Modifier</p>
                                    <a href="supprimerElementListe/<?= $content['id'] ?> ?>">Supprimer</a>
                                </div>
                                <div class="modifElement dnone">
                                    <form action="modifierElementListe" method="POST">
                                        <input type="text" name="content" placeholder="<?= $content['content'] ?>">
                                        <input type="hidden" name="id" value="<?= $content['id'] ?>">
                                        <button type="submit" class="btnValiderModifierElement"><i class="fa-solid fa-square-check"></i></button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>


                <?php endif ?>

        </div>
    <?php else : ?>
        <?php header('location:'. URL. "compte/choixListe"); ?>
    <?php endif ?>

</div>













<?php endif ?>







</div>