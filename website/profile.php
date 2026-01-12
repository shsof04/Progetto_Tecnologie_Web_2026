<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniboRankings - Profilo</title>
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
    <header><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Seal_of_the_University_of_Bologna.svg/1280px-Seal_of_the_University_of_Bologna.svg.png" alt="" /><h1>UniboRankings</h1></header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li><li><a href="review.html">Scrivi una recensione</a></li>
        </ul>
    </nav>

    <div class="layout">
        <main>
            <h2>Profilo</h2>

            <section class="profile-head">
                <ul>
                    <li><img class="profile-avatar" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Seal_of_the_University_of_Bologna.svg/1280px-Seal_of_the_University_of_Bologna.svg.png" alt="Foto profilo" /></li>
                    <li class="profile-name">Blasco Pulieri<br><span class="profile-email">blasco.pulieri@studio.unibo.it</span></li>
                </ul>
            </section>


            <h3>Recensioni: </h3> 

            <section class="reviews">
                <article class="review">
                    <header>
                    <strong class="review-date">05/01/2026</strong>
                    </header>

                    <p>
                    <span><strong>Voto recensione:</strong> 9/10</span> •
                    <span><strong>Voto esame:</strong> 28</span> •
                    <span><strong>Appello:</strong> 12/05/2026</span>
                    </p>

                    <p class="review-text">
                    Spiega bene, esame coerente con le lezioni. Consiglio di fare tanti esercizi prima dell’appello.
                    </p>
                    <input class="button" type="submit" value="Modifica" />
                    <input class="button" type="reset" value="Elimina" />
                    <!--Meglio così per quando passare a PHP?
                        <button type="button" class="button">Modifica</button>
                        <button type="button" class="button">Elimina</button>-->
                </article>

                <article class="review">
                    <header>
                    <strong class="review-date">22/12/2025</strong>
                    </header>

                    <p>
                    <span><strong>Voto recensione:</strong> 8/10</span> •
                    <span><strong>Voto esame:</strong> 25</span> •
                    <span><strong>Appello:</strong> 18/12/2025</span>
                    </p>

                    <p class="review-text">
                    Corso interessante, però ritmo veloce. Ricevimento utile.
                    </p>

                    <input class="button" type="submit" value="Modifica" />
                    <input class="button" type="reset" value="Elimina" />
                </article>
            </section>

            <h3>Cambia Password: </h3> 

            <section>
                <form class="form" action="#" method="POST">
                    <ul>
                        <li>
                            <label for="password">Password Attuale:</label><input type="password" id="password" name="password" />
                        </li>
                        <li>
                            <label for="passwordnew">Nuova Password:</label><input type="password" id="passwordnew" name="passwordnew" />
                        </li>
                        <li>
                            <label for="passwordconfirm">Conferma Nuova Password:</label><input type="password" id="passwordconfirm" name="passwordconfirm" />
                        </li>
                        <li>
                            <input class="button" type="submit" name="submit" value="Aggiorna Password" />
                        </li>
                    </ul>
                </form>
            </section>

        </main>
        <aside>
            <section>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="courses.html">Corsi</a></li>
                    <li><a href="profile.html">Profilo</a></li>
                    <li><a href="review.html">Scrivi una recensione</a></li>
                </ul>
            </section>
            <section>
                <a href="login.html">Logout</a>
            </section>
        </aside>
    </div>
    <footer>
        <h3>Contatti:</h3>
        <ul>
            <li>Email segreteria: segcesena@unibo.it</li>
            <li>Telefono: +39 0547338300</li>
            <li><a href="https://www.unibo.it/it">Sito Unibo</a></li>
        </ul>
    </footer>
</body>
</html>
