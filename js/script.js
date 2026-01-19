const prof = [
  { nome: "Mario Rossi", corso: "Tecnologie Web", email: "m.rossi@uni.it" },
  { nome: "Lucia Bianchi", corso: "Reti", email: "l.bianchi@uni.it" },
  { nome: "Paolo Verdi", corso: "Basi di Dati", email: "p.verdi@uni.it" },
];

const input = document.querySelector("#search");
const results = document.querySelector("#results");

function render(list) {
  results.innerHTML = "";
  list.forEach(p => {
    const li = document.createElement("li");
    li.innerHTML = `<strong>${p.nome}</strong> — ${p.corso} — <a href="mailto:${p.email}">${p.email}</a>`;
    results.appendChild(li);
  });
}

render(prof);

input.addEventListener("input", () => {
  const q = input.value.toLowerCase().trim();
  const filtered = prof.filter(p =>
    p.nome.toLowerCase().includes(q) || p.corso.toLowerCase().includes(q)
  );
  render(filtered);
});

//sezione per review-form
// script.js

document.addEventListener("DOMContentLoaded", () => {
    // Tutto il codice che manipola il form della review

    const dati = window.dati;       // dal PHP
    const appelli = window.appelli; // dal PHP

    const selectProf = document.getElementById("professore");
    const selectCorso = document.getElementById("corso");
    const selectAnno = document.getElementById("anno");
    const selectAppello = document.getElementById("appello");

    if (!selectProf || !selectCorso || !selectAnno || !selectAppello) return;

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
            opt.value = r.data_appello; // YYYY-MM-DD per FK
            opt.textContent = r.data_appello; // visualizzazione come è nel DB
            selectAppello.appendChild(opt);
        });
    });
});









/*const selectProf = document.getElementById("professore");
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

}); */







