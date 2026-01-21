<?php
$img = $templateParams["utente"]["immagineprofilo"] ?? "";
// Se nel DB c'e solo il nome file, aggiungo la cartella resources/
if($img !== "" && strpos($img, "/") === false){
    $img = "resources/" . $img;
}
?>

<h2>Profilo</h2>

<section class="profile-head">
    <ul>
        <li>
            <img class="profile-avatar" src="<?php echo $img; ?>" alt="Foto profilo" />
        </li>
        <li class="profile-name">
            <?php echo $templateParams["utente"]["nome"]; ?><br>
            <span class="profile-email"><?php echo $templateParams["utente"]["utente_id"]; ?></span>
        </li>
    </ul>
</section>

<h3>Recensioni:</h3>

<section class="reviews">
    <?php foreach($templateParams["recensioniutente"] as $recensione): ?>
    <article class="review">
        <header>
            <strong class="review-date"><?php echo $recensione["data_pubblicazione"]; ?></strong>
        </header>

        <p>
            <span><strong>Professore:</strong> <?php echo $recensione["nome_professore"]; ?></span> •
            <span><strong>Corso:</strong> <?php echo $recensione["corso_id"]; ?></span> •
            <span><strong>Appello:</strong> <?php echo $recensione["data_appello"]; ?></span><br/>
            <span><strong>Voto recensione:</strong> <?php echo $recensione["voto_recensione"]; ?>/10</span> •
            <span><strong>Voto esame:</strong> <?php echo $recensione["voto_esame"] === null ? "Respinto" : $recensione["voto_esame"]; ?></span><br/>
        </p>

        <p class="review-text">
            <?php echo nl2br(htmlspecialchars($recensione["testo"], ENT_QUOTES, 'UTF-8')); ?>
        </p>

        <div class="review-actions">
            <a class="button" href="./review.php?action=2
                &utente_id=<?php echo $recensione["utente_id"]; ?>
                &professore_id=<?php echo $recensione["professore_id"]; ?>
                &corso_id=<?php echo $recensione["corso_id"]; ?>
                &anno_accademico=<?php echo $recensione["anno_accademico"]; ?>
                &data_appello=<?php echo $recensione["data_appello"]; ?>"
            >Modifica</a>

            <a class="button" href="./review.php?action=3
                &utente_id=<?php echo $recensione["utente_id"]; ?>
                &professore_id=<?php echo $recensione["professore_id"]; ?>
                &corso_id=<?php echo $recensione["corso_id"]; ?>
                &anno_accademico=<?php echo $recensione["anno_accademico"]; ?>
                &data_appello=<?php echo $recensione["data_appello"]; ?>"
                onclick="return confirm('Sei sicuro di voler cancellare questa recensione?');"
            >Elimina</a>
        </div>
    </article>
    <?php endforeach; ?>
</section>

<h3>Cambia Password:</h3>

<?php if (isset($templateParams["errore"])): ?>
    <p class="error"><?php echo $templateParams["errore"]; ?></p>
<?php endif; ?>

<?php if (isset($templateParams["successo"])): ?>
    <p class="success"><?php echo $templateParams["successo"]; ?></p>
<?php endif; ?>

<section>
    <form class="form" action="#" method="POST">
        <ul>
            <li>
                <label for="password">Password Attuale:</label>
                <input type="password" id="password" name="password" required />
            </li>
            <li>
                <label for="passwordnew">Nuova Password:</label>
                <input type="password" id="passwordnew" name="passwordnew" required />
            </li>
            <li>
                <label for="passwordconfirm">Conferma Nuova Password:</label>
                <input type="password" id="passwordconfirm" name="passwordconfirm" required />
            </li>
            <li>
                <input class="button" type="submit" name="submit" value="Aggiorna Password" />
            </li>
        </ul>
    </form>
</section>
