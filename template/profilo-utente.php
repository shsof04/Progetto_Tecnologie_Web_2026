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
            <span><strong>Voto recensione:</strong> <?php echo $recensione["voto_recensione"]; ?>/10</span> •
            <span><strong>Voto esame:</strong> <?php echo $recensione["voto_esame"]; ?></span> •
            <span><strong>Appello:</strong> <?php echo $recensione["data_appello"]; ?></span>
        </p>

        <p class="review-text">
            <?php echo $recensione["testo"]; ?>
        </p>

        <!-- TODO: collegare davvero le azioni a PHP quando implementi modifica/elimina -->
        <input class="button" type="submit" value="Modifica" />
        <input class="button" type="reset" value="Elimina" />
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
