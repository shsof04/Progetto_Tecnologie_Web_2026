<h2><?= isset($templateParams["recensione"]) ? "Modifica Recensione" : "Scrivi Recensione" ?></h2>

<?php if(!empty($templateParams["errore"])): ?>
    <p class="error"><?= $templateParams["errore"] ?></p>
<?php endif; ?>

<form action="review.php" method="POST">
    <?php if(isset($templateParams["recensione"])): ?>
        <input type="hidden" name="professore_id" value="<?= $templateParams["recensione"]["professore_id"] ?>">
        <input type="hidden" name="corso_id" value="<?= $templateParams["recensione"]["corso_id"] ?>">
        <input type="hidden" name="anno_accademico" value="<?= $templateParams["recensione"]["anno_accademico"] ?>">
        <input type="hidden" name="data_appello" value="<?= $templateParams["recensione"]["data_appello"] ?>">
        <input type="hidden" name="action" value="modifica">
    <?php else: ?>
        <input type="hidden" name="action" value="inserisci">
    <?php endif; ?>

    <fieldset>
        <ul>
            <!-- Professore -->
            <li>
                <label>Professore:
                    <select id="professore" name="professore_id" <?= isset($templateParams["recensione"]) ? "disabled" : "required" ?>>
                        <option value="">-- Seleziona professore --</option>
                        <?php foreach ($templateParams["professori"] as $prof): ?>
                            <option value="<?= $prof["professore_id"] ?>"
                                <?php if(isset($templateParams["recensione"]) && $templateParams["recensione"]["professore_id"] === $prof["professore_id"]) echo "selected"; ?>
                            ><?= $prof["nome"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </li>

            <!-- Corso -->
            <li>
                <label>Corso:
                    <select id="corso" name="corso_id" <?= isset($templateParams["recensione"]) ? "disabled" : "required" ?>>
                        <option value="">-- Seleziona corso --</option>
                        <?php 
                        if(isset($templateParams["recensione"])):
                            $corso = $dbh->getCourseById($templateParams["recensione"]["corso_id"]);
                        ?>
                            <option value="<?= $corso["corso_id"] ?>" selected><?= $corso["nome"] ?></option>
                        <?php endif; ?>
                    </select>
                </label>
            </li>

            <!-- Anno Accademico -->
            <li>
                <label>Anno Accademico:
                    <select id="anno" name="anno_accademico" <?= isset($templateParams["recensione"]) ? "disabled" : "required" ?>>
                        <option value="">-- Seleziona anno --</option>
                        <?php if(isset($templateParams["recensione"])): ?>
                            <option value="<?= $templateParams["recensione"]["anno_accademico"] ?>" selected><?= $templateParams["recensione"]["anno_accademico"] ?></option>
                        <?php endif; ?>
                    </select>
                </label>
            </li>

            <!-- Appello -->
            <li>
                <label>Appello:
                    <select id="appello" name="data_appello" <?= isset($templateParams["recensione"]) ? "disabled" : "required" ?>>
                        <option value="">-- Seleziona appello --</option>
                        <?php if(isset($templateParams["recensione"])): ?>
                            <option value="<?= $templateParams["recensione"]["data_appello"] ?>" selected><?= date("d/m/Y", strtotime($templateParams["recensione"]["data_appello"])) ?></option>
                        <?php endif; ?>
                    </select>
                </label>
            </li>

            <!-- Voto Esame -->
            <li>
                <label>Voto Esame:
                    <select name="voto_esame" required>
                        <option value="respinto" <?= isset($templateParams["recensione"]) && $templateParams["recensione"]["voto_esame"] === null ? "selected" : "" ?>>Respinto</option>
                        <?php for ($v = 18; $v <= 30; $v++): ?>
                            <option value="<?= $v ?>" <?= isset($templateParams["recensione"]) && $templateParams["recensione"]["voto_esame"] == $v ? "selected" : "" ?>><?= $v ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </li>
        </ul>
    </fieldset>

    <!-- Recensione -->
    <fieldset>
        <label>Scrivi la recensione: 
            <br/><textarea name="testo" rows="4" cols="50"><?= $templateParams["recensione"]["testo"] ?? "" ?></textarea>
        </label><br/>

        <div class="rating-wrapper">
            <span>Voto recensione:</span>
            <div class="rating">
                <?php for ($i = 10; $i >= 1; $i--):
                    $checked = (isset($templateParams["recensione"]) && $templateParams["recensione"]["voto_recensione"] == $i) ? "checked" : "";
                ?>
                    <input type="radio" name="voto_recensione" id="star<?= $i ?>" value="<?= $i ?>" <?= $i===10 ? "required" : "" ?> <?= $checked ?> />
                    <label for="star<?= $i ?>" class="fa fa-star-o"></label>
                <?php endfor; ?>
            </div>
        </div>
    </fieldset>

    <input class="button" type="submit" value="<?= isset($templateParams["recensione"]) ? "Aggiorna Recensione" : "Pubblica" ?>" />
    <input class="button" type="reset" value="Cancella" />

    <?php if(isset($templateParams["recensione"])): ?>
        <fieldset>
            <input type="hidden" name="action" value="cancella">
            <input type="hidden" name="professore_id" value="<?= $templateParams["recensione"]["professore_id"] ?>">
            <input type="hidden" name="corso_id" value="<?= $templateParams["recensione"]["corso_id"] ?>">
            <input type="hidden" name="anno_accademico" value="<?= $templateParams["recensione"]["anno_accademico"] ?>">
            <input type="hidden" name="data_appello" value="<?= $templateParams["recensione"]["data_appello"] ?>">
            <button class="button" onclick="return confirm('Sei sicuro di voler cancellare questa recensione?');">Elimina</button>
        </fieldset>
    <?php endif; ?>
</form>

<script>
    window.dati = <?= json_encode($templateParams["professori_corsi"]) ?>;
    window.appelli = <?= json_encode($templateParams["appelli"]) ?>;
</script>
<script src="/Progetto_Tecnologie_Web_2026/js/script-form.js"></script>
