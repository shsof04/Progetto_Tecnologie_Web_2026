<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $templateParams["titolo"]; ?></title>
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <?php
    $logged = function_exists('isUserLoggedIn') ? isUserLoggedIn() : !empty($_SESSION['utente_id']);
    $showNav = $templateParams["showNav"] ?? $logged;
    $showAside = $templateParams["showAside"] ?? $logged;
  ?>

  <header>
    <img src="./resources/logo.PNG" alt="Logo UniboRankings" />
    <h1>UniboRankings</h1>
  </header>

<?php if($showNav): ?>
  <nav>
    <ul>
      <li><a <?php isActive('index.php'); ?> href="index.php">Home</a></li>
      <li><a <?php isActive('review.php'); ?> href="review.php">Scrivi una recensione</a></li>
    </ul>
  </nav>
  <main>
            
        <?php
            if(isset($templateParams["nome"])){
                require($templateParams["nome"]);
            }
        ?>
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
