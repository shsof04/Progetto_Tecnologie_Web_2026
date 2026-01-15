<!-- mancano i dati utente, i bottoni di elimina e modifica e il cambia password -->            
            
            <h2>Profilo</h2>

            <section class="profile-head">
                <ul>
                    <li><img class="profile-avatar" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Seal_of_the_University_of_Bologna.svg/1280px-Seal_of_the_University_of_Bologna.svg.png" alt="Foto profilo" /></li>
                    <li class="profile-name">Blasco Pulieri<br><span class="profile-email">blasco.pulieri@studio.unibo.it</span></li>
                </ul>
            </section>

            <h3>Recensioni: </h3> 

            <section class="reviews">
                <?php foreach($templateParams["recensioniutente"] as $recensione): ?>
                <article class="review">
                    <header>
                    <strong class="review-date"><?php echo $recensione["data_pubblicazione"] ?></strong>
                    </header>

                    <p>
                    <span><strong>Voto recensione:</strong> <?php echo $recensione["voto_recensione"] ?>/10</span> •
                    <span><strong>Voto esame:</strong> <?php echo $recensione["voto_esame"] ?></span> •
                    <span><strong>Appello:</strong> <?php echo $recensione["data_appello"] ?></span>
                    </p>

                    <p class="review-text">
                    <?php echo $recensione["testo"] ?>
                    </p>
                    <input class="button" type="submit" value="Modifica" />
                    <input class="button" type="reset" value="Elimina" />
                    <!--Meglio così per quando passare a PHP?
                        <button type="button" class="button">Modifica</button>
                        <button type="button" class="button">Elimina</button>-->
                </article>
                <?php endforeach; ?>
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
