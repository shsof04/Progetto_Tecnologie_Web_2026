<?php
$img = $templateParams["professore"]["immagineprofilo"] ?? "";
// Se nel DB c'e solo il nome file, aggiungo la cartella resources/
if($img !== "" && strpos($img, "/") === false){
    $img = "resources/" . $img;
}
?>

<h2><?php echo $templateParams["professore"]["nome"]; ?> - <?php echo $templateParams["corso"]["nome"]; ?></h2>

<section class="profile-head">
    <ul>
        <li>
            <img class="profile-avatar" src="<?php echo $img; ?>" alt="Foto profilo del docente" />
        </li>
        <li>
            <strong>Media Recensioni: </strong> <?php echo $templateParams["medie"]["media_recensioni"]; ?><br>
            <strong>Media Voti: </strong><?php echo $templateParams["medie"]["media_voti"]; ?><br>
            <strong>E-mail:</strong> <?php echo $templateParams["professore"]["professore_id"]; ?>
        </li>
    </ul>
</section>

<h2>Recensioni:</h2>

<section class="reviews">
    <?php foreach($templateParams["recensioniprofessore"] as $recensione): ?>
    <article class="review">
        <header>
            <strong class="review-date"><?php echo $recensione["data_pubblicazione"]; ?></strong>
        </header>

        <p>
            <span><strong>Voto recensione:</strong> <?php echo $recensione["voto_recensione"]; ?>/10</span> •
            <span><strong>Voto esame:</strong> <?php echo $recensione["voto_esame"] === null ? "Respinto" : $recensione["voto_esame"]; ?></span> •
            <span><strong>Appello:</strong> <?php echo $recensione["data_appello"]; ?></span>
        </p>

        <p class="review-text">
            <?php echo $recensione["testo"]; ?>
        </p>
    </article>
    <?php endforeach; ?>
</section>
