<h2><?= isset($templateParams['recensione']) ? "Modifica recensione" : "Scrivi recensione" ?></h2>

<?php if(!empty($templateParams["errore"])): ?>
    <p class="error"><?= $templateParams["errore"] ?></p>
<?php endif; ?>

<form action="/Progetto_Tecnologie_Web_2026/review.php" method="POST">
    <input type="hidden" name="action" value="<?= $templateParams['formAction'] ?? 1 ?>">

    <fieldset>
        <ul>
            <!-- Professore -->
            <li>
                <label>Professore:
                    <?php if(isset($templateParams['recensione'])): ?>
                        <select id="professore" name="professore_id" disabled required>
                            <option value="<?= $templateParams['recensione']['professore_id'] ?>">
                                <?= $templateParams['recensione']['nome_professore'] ?>
                            </option>
                        </select>
                        <input type="hidden" name="professore_id" value="<?= $templateParams['recensione']['professore_id'] ?>">
                    <?php else: ?>
                        <select id="professore" name="professore_id" required>
                            <option value="">-- Seleziona professore --</option>
                            <?php foreach ($templateParams["professori"] as $prof): ?>
                                <option value="<?= $prof["professore_id"] ?>"><?= $prof["nome"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </label>
            </li>

            <!-- Corso -->
            <li>
                <label>Corso:
                    <?php if(isset($templateParams['recensione'])): ?>
                        <select id="corso" name="corso_id" disabled required>
                            <option value="<?= $templateParams['recensione']['corso_id'] ?>">
                                <?= $templateParams['recensione']['nome_corso'] ?? $templateParams['recensione']['corso_id'] ?>
                            </option>
                        </select>
                        <input type="hidden" name="corso_id" value="<?= $templateParams['recensione']['corso_id'] ?>">
                    <?php else: ?>
                        <select id="corso" name="corso_id" disabled required>
                            <option value="">-- Seleziona prima un professore --</option>
                        </select>
                    <?php endif; ?>
                </label>
            </li>

            <!-- Anno Accademico -->
            <li>
                <label>Anno Accademico:
                    <?php if(isset($templateParams['recensione'])): ?>
                        <select id="anno" name="anno_accademico" disabled required>
                            <option value="<?= $templateParams['recensione']['anno_accademico'] ?>">
                                <?= $templateParams['recensione']['anno_accademico'] ?>
                            </option>
                        </select>
                        <input type="hidden" name="anno_accademico" value="<?= $templateParams['recensione']['anno_accademico'] ?>">
                    <?php else: ?>
                        <select id="anno" name="anno_accademico" disabled required>
                            <option value="">-- Seleziona prima un corso --</option>
                        </select>
                    <?php endif; ?>
                </label>
            </li>

            <!-- Appello -->
            <li>
                <label>Appello:
                    <?php if(isset($templateParams['recensione'])): ?>
                        <select id="appello" name="data_appello" disabled required>
                            <option value="<?= $templateParams['recensione']['data_appello'] ?>">
                                <?= $templateParams['recensione']['data_appello'] ?>
                            </option>
                        </select>
                        <input type="hidden" name="data_appello" value="<?= $templateParams['recensione']['data_appello'] ?>">
                    <?php else: ?>
                        <select id="appello" name="data_appello" disabled required>
                            <option value="">-- Seleziona prima un anno --</option>
                        </select>
                    <?php endif; ?>
                </label>
            </li>

            <!-- Voto Esame -->
            <li>
                <label>Voto Esame:
                    <select name="voto_esame" required>
                        <option value="respinto" <?= (isset($templateParams['recensione']) && $templateParams['recensione']['voto_esame'] === null) ? "selected" : "" ?>>Respinto</option>
                        <?php for ($v = 18; $v <= 30; $v++): ?>
                            <option value="<?= $v ?>" <?= (isset($templateParams['recensione']) && $templateParams['recensione']['voto_esame'] == $v) ? "selected" : "" ?>><?= $v ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </li>
        </ul>
    </fieldset>

    <!-- Recensione -->
    <fieldset>
        <label>Scrivi la recensione:
            <br/>
            <textarea name="testo" rows="4" cols="50"><?= $templateParams['recensione']['testo'] ?? "" ?></textarea>
        </label><br/>

        <div class="rating-wrapper">
            <span>Voto recensione:</span>
            <div class="rating">
                <?php for ($i = 10; $i >= 1; $i--):
                    $checked = (isset($templateParams['recensione']) && $templateParams['recensione']['voto_recensione'] == $i) ? "checked" : "";
                ?>
                    <input type="radio" name="voto_recensione" id="star<?= $i ?>" value="<?= $i ?>" <?= $checked ?> />
                    <label for="star<?= $i ?>" class="fa fa-star-o"></label>
                <?php endfor; ?>
            </div>
        </div>
    </fieldset>

    <input class="button" type="submit" value="<?= isset($templateParams['recensione']) ? "Modifica" : "Pubblica" ?>" />
    <input class="button" type="reset" value="Cancella" />
</form>

<script>
    window.dati = <?= json_encode($templateParams["professori_corsi"]) ?>;
    window.appelli = <?= json_encode($templateParams["appelli"]) ?>;
</script>
<script src="/Progetto_Tecnologie_Web_2026/js/script-form.js"></script>

