<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $templateParams["titolo"]; ?></title>
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

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
  <?php endif; ?>
  
  <div class="layout">
  <main>
     <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
    </main>

    <?php if($showAside): ?>
      <aside>
        <section>
          <ul>
            <li><a <?php isActive('index.php'); ?> href="index.php">Home</a></li>
            <li><a <?php isActive('courses.php'); ?> href="courses.php">Corsi</a></li>
            <li><a <?php isActive('exams.php'); ?> href="exams.php">Esami</a></li>
            <li><a <?php isActive('profile.php'); ?> href="profile.php">Profilo</a></li>
            <li><a <?php isActive('review.php'); ?> href="review.php">Scrivi una recensione</a></li>
          </ul>
        </section>
        <section>
          <a href="logout.php">Logout</a>
        </section>
      </aside>
    <?php endif; ?>
  </div>

  
  <footer>
    <h3>Contatti:</h3>
    <ul>
      <li>Email segreteria: segcesena@unibo.it</li>
      <li>Telefono: +39 0547338300</li>
      <li><a href="https://www.unibo.it/it">Sito Unibo</a></li>
    </ul>
  </footer>


  <?php
    // Script opzionali specifici per pagina.
    // Uso $templateParams["scripts"] = ["js/search.js", ...]
    $baseUrlLocal = $templateParams["baseUrl"] ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), "/\\");
    if ($baseUrlLocal === "/") { $baseUrlLocal = ""; }

    $scripts = $templateParams["scripts"] ?? [];
    if (!is_array($scripts)) { $scripts = [$scripts]; }

    foreach ($scripts as $src) {
      if (empty($src)) continue;
      $src = ltrim($src, "/");
      echo '<script src="' . htmlspecialchars($baseUrlLocal . '/' . $src) . '"></script>';
    }
  ?>




</body>
</html>
