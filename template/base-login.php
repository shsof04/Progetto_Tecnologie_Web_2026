
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $templateParams["titolo"]; ?></title>
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <header><img src="" alt="" /><h1>UniboRankings</h1></header>

    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
    </main>

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
