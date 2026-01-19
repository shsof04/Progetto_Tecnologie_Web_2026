<h2>Scrivi recensione</h2>

<?php if(!empty($templateParams["errore"])): ?>
    <p class="error"><?= $templateParams["errore"] ?></p>
<?php endif; ?>

<form action="/Progetto_Tecnologie_Web_2026/review.php" method="POST">
    <fieldset>
        <ul>
            <!-- Professore -->
            <li>
                <label>Professore:
                    <select id="professore" name="professore_id" required>
                        <option value="">-- Seleziona professore --</option>
                        <?php foreach ($templateParams["professori"] as $prof): ?>
                            <option value="<?= $prof["professore_id"] ?>"><?= $prof["nome"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </li>

            <!-- Corso -->
            <li>
                <label>Corso:
                    <select id="corso" name="corso_id" disabled required>
                        <option value="">-- Seleziona prima un professore --</option>
                    </select>
                </label>
            </li>

            <!-- Anno Accademico -->
            <li>
                <label>Anno Accademico:
                    <select id="anno" name="anno_accademico" disabled required>
                        <option value="">-- Seleziona prima un corso --</option>
                    </select>
                </label>
            </li>

            <!-- Appello -->
            <li>
                <label>Appello:
                    <select id="appello" name="data_appello" disabled required>
                        <option value="">-- Seleziona prima un anno --</option>
                    </select>
                </label>
            </li>

            <!-- Voto Esame -->
            <li>
                <label>Voto Esame:
                    <select name="voto_esame" required>
                        <option value="respinto">Respinto</option>
                        <?php for ($v = 18; $v <= 30; $v++): ?>
                            <option value="<?= $v ?>"><?= $v ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </li>
        </ul>
    </fieldset>

    <!-- Recensione -->
    <fieldset>
        <label>Scrivi la recensione: 
            <br/><textarea name="testo" rows="4" cols="50"></textarea>
        </label><br/>

        <div class="rating-wrapper">
            <span>Voto recensione:</span>
            <div class="rating">
                <?php for ($i = 10; $i >= 1; $i--):
                    $checked = (isset($_POST["voto_recensione"]) && $_POST["voto_recensione"] == $i) ? "checked" : "";
                ?>
                    <input type="radio" name="voto_recensione" id="star<?= $i ?>" value="<?= $i ?>" <?= $checked ?> />
                    <label for="star<?= $i ?>" class="fa fa-star-o"></label>
                <?php endfor; ?>
            </div>
        </div>
    </fieldset>

    <input class="button" type="submit" value="Pubblica" />
    <input class="button" type="reset" value="Cancella" />
</form>

<script>
    window.dati = <?= json_encode($templateParams["professori_corsi"]) ?>;
    window.appelli = <?= json_encode($templateParams["appelli"]) ?>;
</script>
<script src="/Progetto_Tecnologie_Web_2026/js/script-form.js"></script>
