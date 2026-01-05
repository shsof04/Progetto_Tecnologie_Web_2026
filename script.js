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
