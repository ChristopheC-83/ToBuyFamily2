<div class="animTitres pageMP">

    <h1>Les Messages Privés</h1>

    <!-- Formulaire Nouveau Message -->

    <div class="btnNewMsg">
        <h3 class="ecrireMP">Ecrire un nouveau message </h3>
    </div>

    <form method="POST" action="envoiMP" class="formulaire dnone" id="formulaireMP">
        <div class="entryForm">
            <label for="destinataire">Destinataire</label>
            <input type="text" name="destinataire" id="destinataire">
        </div>
        <div class="entryForm">
            <label for="msg">Message</label>
            <textarea type="text" name="msg" id="msg"></textarea>
        </div>
        <div class="entryForm">
            <button type="submit" id="envoiMP">Envoyer</button>
        </div>

        <h3 id="annulerMP">Annuler</h3>
    </form>

    <!-- Boite de réception -->

    <div class="messagesRecus">
        <h2>Boite de réception</h2>
        <?php if (empty($mpRecus)) : ?>
            <h3 class="boiteVide">Boite de réception vide.</h3>
        <?php endif ?>
        <?php
        foreach ($mpRecus as $mpRecu) :
        ?>

            <?php if ($mpRecu['boiteReception'] === 1) : ?>
                <div class="listeMessagesRecus">
                    <div class="messageDe">
                        <h3>Message de <?= $mpRecu['login'] ?>
                            <i class="fa-solid fa-angles-down"></i>
                        </h3>
                    </div>
                    <div class="messageRecu dnone">
                        <div class="messageDe">
                            <p class="dateMP">
                                <?php
                                $dateTime = new DateTime($mpRecu['date']);
                                $nouveauFormat = $dateTime->format("G\hi \, j F Y");
                                echo $nouveauFormat; ?>
                            </p>
                            <h4>Message de <?= $mpRecu['login'] ?> <i class="fa-solid fa-angles-up"></i></h4>
                        </div>
                        <div class="message">
                            <h4><?= $mpRecu['message'] ?></h4>
                        </div>
                        <div class="trashBox">
                            <a href="<?= URL ?>compte/masquerDeBR/<?= $mpRecu['id'] ?>"><i class="fa-regular fa-trash-can"></i>
                        </div>
                        </a>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>

    <!-- Boite d'envoi -->

    <div class="messagesRecus">
        <h2>Messages envoyés</h2>
        <?php if (empty($mpEnvoyes)) : ?>
            <h3 class="boiteVide">Aucun message envoyé.</h3>
        <?php endif ?>
        <?php
        foreach ($mpEnvoyes as $mpEnvoye) :
        ?>
            <?php if ($mpEnvoye['boiteEnvoi'] === 1) : ?>
                <div class="listeMessagesRecus">
                    <div class="messageDe">
                        <h3>Message pour <?= $mpEnvoye['destinataire'] ?>
                            <i class="fa-solid fa-angles-down"></i>
                        </h3>
                    </div>
                    <div class="messageRecu dnone">
                        <div class="messageDe">
                            <p class="dateMP">
                                <?php
                                $dateTime = new DateTime($mpEnvoye['date']);
                                $nouveauFormat = $dateTime->format("G\hi \, j F Y");
                                echo $nouveauFormat; ?>
                            </p>
                            <h4>Message pour <?= $mpEnvoye['destinataire'] ?> <i class="fa-solid fa-angles-up"></i></h4>
                        </div>
                        <div class="message">
                            <h4><?= $mpEnvoye['message'] ?></h4>
                        </div>
                        <div class="trashBox">
                            <a href="<?= URL ?>compte/masquerDeBE/<?= $mpEnvoye['id'] ?>"><i class="fa-regular fa-trash-can"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>

</div>