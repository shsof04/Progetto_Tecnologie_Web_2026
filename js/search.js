function normalizzaTesto(testo){
    return (testo || "").toString().toLowerCase().trim();
}

document.addEventListener("DOMContentLoaded", function(){
    const input = document.getElementById("search");
    if(!input) return;

    const form = input.closest("form");
    if(form){
        form.addEventListener("submit", function(e){
            e.preventDefault();
        });
    }

    const tabella = document.querySelector("table");
    const listaEsami = document.querySelector(".listexams ul");

    function filtra(){
        const q = normalizzaTesto(input.value);

        if(tabella){
            const righe = tabella.querySelectorAll("tr");
            for(let i = 1; i < righe.length; i++){
                const riga = righe[i];
                const testo = normalizzaTesto(riga.textContent);
                riga.style.display = (q === "" || testo.indexOf(q) !== -1) ? "" : "none";
            }
        }

        if(listaEsami){
            const items = listaEsami.querySelectorAll("li");
            items.forEach(function(li){
                const testo = normalizzaTesto(li.textContent);
                li.style.display = (q === "" || testo.indexOf(q) !== -1) ? "" : "none";
            });
        }
    }

    input.addEventListener("input", filtra);
    filtra();
});
