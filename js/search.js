


//search bar

// Generic client-side search for pages that use:
// - an input#search
// - optional ul#results (for a short "suggestions" list)
// - either a table (filters its data rows) or a list (.listexams ul)
//
// Works without any backend/API.

(function () {
  function normalize(str) {
    return (str || "")
      .toString()
      .toLowerCase()
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .replace(/\s+/g, " ")
      .trim();
  }

  function clearChildren(el) {
    if (!el) return;
    while (el.firstChild) el.removeChild(el.firstChild);
  }

  document.addEventListener("DOMContentLoaded", () => {
    const input = document.querySelector("#search");
    if (!input) return;

    // Prevent the search form from reloading the page
    const form = input.closest("form");
    if (form) {
      form.addEventListener("submit", (e) => e.preventDefault());
    }

    const results = document.querySelector("#results");
    const table = document.querySelector("table");
    const list = document.querySelector(".listexams ul");

    // Collect searchable items
    let items = [];

    if (table) {
      // All rows except the first header row
      const rows = Array.from(table.querySelectorAll("tr")).slice(1);
      items = rows.map((row) => {
        // Build a "label" for suggestions: first 2 cells if present
        const cells = Array.from(row.children);
        const labelParts = cells.slice(0, 3).map((c) => c.textContent.trim()).filter(Boolean);
        const label = labelParts.join(" — ");

        const a = row.querySelector("a[href]");
        const href = a ? a.getAttribute("href") : null;

        return { el: row, text: normalize(row.textContent), label, href };
      });
    } else if (list) {
      const lis = Array.from(list.querySelectorAll("li"));
      items = lis.map((li) => {
        const a = li.querySelector("a[href]");
        const href = a ? a.getAttribute("href") : null;
        return { el: li, text: normalize(li.textContent), label: li.textContent.trim(), href };
      });
    }
 

function update() {
  const q = normalize(input.value);

  if (!q) {
    items.forEach((it) => (it.el.style.display = ""));
    if (results) clearChildren(results);
    return;
  }

  items.forEach((it) => {
    const ok = it.text.includes(q);
    it.el.style.display = ok ? "" : "none";
  });

  // NON mostrare suggerimenti
  if (results) clearChildren(results);
}


    input.addEventListener("input", update);
    update();
  });
})();
