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

<!-- Passaggio dati PHP al JS 
<script>
    window.dati = <?= json_encode($templateParams["professori_corsi"]) ?>;
    window.appelli = <?= json_encode($templateParams["appelli"]) ?>;

    const selectProf = document.getElementById("professore");
    const selectCorso = document.getElementById("corso");
    const selectAnno = document.getElementById("anno");
    const selectAppello = document.getElementById("appello");

    // Professore → Corsi
    selectProf.addEventListener("change", function () {
        const profId = this.value;
        selectCorso.innerHTML = "<option value=''>-- Seleziona corso --</option>";
        selectCorso.disabled = !profId;

        selectAnno.innerHTML = "<option value=''>-- Seleziona prima un corso --</option>";
        selectAnno.disabled = true;
        selectAppello.innerHTML = "<option value=''>-- Seleziona prima un anno --</option>";
        selectAppello.disabled = true;

        if (!profId) return;

        const corsi = dati.filter(r => r.professore_id === profId);
        corsi.forEach(c => {
            const opt = document.createElement("option");
            opt.value = c.corso_id;
            opt.textContent = c.nome_corso;
            selectCorso.appendChild(opt);
        });
    });

    // Corso → Anni
    selectCorso.addEventListener("change", function () {
        const profId = selectProf.value;
        const corsoId = this.value;

        selectAnno.innerHTML = "<option value=''>-- Seleziona anno --</option>";
        selectAnno.disabled = !corsoId;
        selectAppello.innerHTML = "<option value=''>-- Seleziona prima un anno --</option>";
        selectAppello.disabled = true;

        if (!profId || !corsoId) return;

        const anni = [...new Set(dati
            .filter(r => r.professore_id === profId && r.corso_id === corsoId)
            .map(r => r.anno_accademico))];
        
        anni.forEach(a => {
            const opt = document.createElement("option");
            opt.value = a;
            opt.textContent = a;
            selectAnno.appendChild(opt);
        });
    });

    // Anno → Appelli
    selectAnno.addEventListener("change", function () {
        const profId = selectProf.value;
        const corsoId = selectCorso.value;
        const anno = this.value;

        selectAppello.innerHTML = "<option value=''>-- Seleziona appello --</option>";
        selectAppello.disabled = !anno;

        if (!profId || !corsoId || !anno) return;

        const appelliFiltrati = appelli
            .filter(r => r.professore_id === profId && r.corso_id === corsoId && r.anno_accademico === anno)
            .sort((a,b) => new Date(a.data_appello) - new Date(b.data_appello));

        appelliFiltrati.forEach(r => {
        const opt = document.createElement("option");
        opt.value = r.data_appello; // <-- VALORE DEVE RESTARE YYYY-MM-DD (FK)
        opt.textContent = r.data_appello.split("-").reverse().join("/"); // <-- solo visualizzazione DD/MM/YYYY
        selectAppello.appendChild(opt);
    });

    }); 
</script>-->

<script>
    window.dati = <?= json_encode($templateParams["professori_corsi"]) ?>;
    window.appelli = <?= json_encode($templateParams["appelli"]) ?>;
</script>
<script src="/Progetto_Tecnologie_Web_2026/js/script-form.js"></script>
