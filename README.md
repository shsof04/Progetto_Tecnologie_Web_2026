# Progetto_Tecnologie_Web_2026 

# UniboRankings 

Applicazione dove gli studenti possono leggere/scrivere recensioni su professori visualizzare una graduatoria dei professori più apprezzati.

# Specifiche funzionali:

- Login dell'utente.
- Pagine in dettaglio per professori ed esami con statistiche.
- Possibilità di pubblicare, modificare ed eliminare recensioni.
- L'amministratore può gestire tutte le recensioni.
- Possibilità di modificare la propria password.

# Specifiche non funzionali:

- Accessibilità limitata agli studenti iscritti al corso di laurea.
- Ricerca per professore, per appello e per anno accademico.
- Controllo sul login: ogni utente può modificare ed eliminare solo le proprie recensioni.
- Controllo sulle recensioni: ogni utente può pubblicare una sola recensione per appello.
- Garanzia di privacy: le recensioni sono anonime.

# Esempi di personas e scenarios:

1. Persona: Nico Tedeschi (reale). Vuole scegliere che corsi frequentare tra quelli a scelta. E' indeciso tra due corsi, dunque vuole sentire i pareri di altri studenti. Obiettivi:
- Interfaccia chiara che mostri tutti i docenti e corsi, con le relative statistiche
- Ricerca veloce dei corsi
- Storicizzazione degli appelli
  
2. Persona: Moira Quartieri (reale). Si sente in difficoltà riguardo ad un particolare esame. Vuole sapere se anche altri studenti si trovano nella sua stessa situazione ed eventualmente trovare qualche consiglio. Obiettivi:
- Possibilità di leggere ogni singola recensione per professore
- Possibilità di scrivere recensioni con esito esame "respinto"

3. Persona: Matteo Nencioni (reale). Ha scritto una recensione ma si è accorto di aver sbagliato ad inserire la sua valutazione e non vuole dover riscrivere tutto. Inoltre ha notato alcune recensioni non rispettore lasciate da altri studenti. Obiettivi:
- Possibilità di modificare le proprie recensioni
- Esistenza di profili admin per gestire le recensioni

# Implementazione, Test e Ottimizzazione:

Dopo aver implementato le funzionalità e realizzato la struttura del sito basandoci sui mockup, abbiamo avviato una fase di test. In questa fase abbiamo simulato scenari d’uso per verificare il corretto funzionamento delle funzionalità principali e valutato con attenzione che il design fosse user-centered.

In seguito ai test, abbiamo apportato alcune modifiche, tra cui:
- Abbiamo aggiunto delle barre di ricerca per facilitare la visualizzaione del professore/esame
- Nelle recenzioni visualizzate nella pagina dell'utente vengono aggiunti il nome del professore e il codice del corso
- Abbiamo spostato il collegamento alla pagina "Esami" dalla pagina professori all'aside
  






