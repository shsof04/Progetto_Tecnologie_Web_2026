// Passaggio dati PHP al JS già fatto in review-form.php:
// window.dati = <?= json_encode($templateParams["professori_corsi"]) ?>;
// window.appelli = <?= json_encode($templateParams["appelli"]) ?>;

const selectProf = document.getElementById("professore");
const selectCorso = document.getElementById("corso");
const selectAnno = document.getElementById("anno");
const selectAppello = document.getElementById("appello");

// Professore → Corsi
selectProf.addEventListener("change", function () {
    const profId = this.value;

    // Reset select
    selectCorso.innerHTML = "<option value=''>-- Seleziona corso --</option>";
    selectCorso.disabled = !profId;

    selectAnno.innerHTML = "<option value=''>-- Seleziona prima un corso --</option>";
    selectAnno.disabled = true;

    selectAppello.innerHTML = "<option value=''>-- Seleziona prima un anno --</option>";
    selectAppello.disabled = true;

    if (!profId) return;

    // Prendiamo solo corsi unici per il professore
    const corsi = [...new Map(
        dati
        .filter(r => r.professore_id === profId)
        .map(r => [r.corso_id, r])
    ).values()];

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

    // Reset select
    selectAnno.innerHTML = "<option value=''>-- Seleziona anno --</option>";
    selectAnno.disabled = !corsoId;

    selectAppello.innerHTML = "<option value=''>-- Seleziona prima un anno --</option>";
    selectAppello.disabled = true;

    if (!profId || !corsoId) return;

    // Prendiamo anni unici
    const anni = [...new Set(
        dati
        .filter(r => r.professore_id === profId && r.corso_id === corsoId)
        .map(r => r.anno_accademico)
    )];

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

    // Reset select
    selectAppello.innerHTML = "<option value=''>-- Seleziona appello --</option>";
    selectAppello.disabled = !anno;

    if (!profId || !corsoId || !anno) return;

    // Filtriamo appelli e rimuoviamo duplicati per data_appello
    const appelliFiltrati = [...new Map(
        appelli
        .filter(r => r.professore_id === profId && r.corso_id === corsoId && r.anno_accademico === anno)
        .map(r => [r.data_appello, r])
    ).values()];

    // Ordiniamo per data
    appelliFiltrati.sort((a,b) => new Date(a.data_appello) - new Date(b.data_appello));

    appelliFiltrati.forEach(r => {
        const opt = document.createElement("option");
        opt.value = r.data_appello; // YYYY-MM-DD
        opt.textContent = r.data_appello.split("-").reverse().join("/"); // DD/MM/YYYY
        selectAppello.appendChild(opt);
    });
});
