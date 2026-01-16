<h2>Professori più Consigliati</h2>

<section>
  <form class="search-bar" role="search">
    <label class="visually-hidden" for="search">Cerca Professore</label>
    <input id="search" type="search" placeholder="Cerca Professore" />
    <button type="submit" class="search-btn">Cerca</button>
  </form>

  <ul id="results"></ul>
</section>

<section>
  <table>
    <tr>
      <th id="posizione">Posizione</th>
      <th id="docente">Docente</th>
      <th id="corso">Corso</th>
      <th id="mediarecensioni">Media voto recensioni</th>
      <th id="mediaesami">Media voto esami</th>
    </tr>

<?php
    if (isset($templateParams["ranking"])) {
      $ranking = $templateParams["ranking"];
    } else {
      $ranking = [];
    }

    if (empty($ranking)):
?>

    <!--5 colonne-->
      <tr>
        <td colspan="5">Nessun dato disponibile.</td>
      </tr>

    <?php
    //entra qui se ranking non è vuoto, $pos per le posizioni della classifica
      else:
        $pos = 1;
        foreach($ranking as $row):
          $rowId = "row" . $pos;
    ?>
      <tr>
        <th id="<?php echo htmlspecialchars($rowId); ?>"><?php echo $pos; ?></th>


        <td headers="<?php echo htmlspecialchars($rowId); ?> docente">
          <a href="professors.php?professore_id=<?php echo urlencode($row['professore_id']); ?>&amp;corso_id=<?php echo urlencode($row['corso_id']); ?>">
            <?php echo htmlspecialchars($row["docente"]); ?>
          </a>
        </td>

        <td headers="<?php echo htmlspecialchars($rowId); ?> corso">
          <?php echo htmlspecialchars($row["corso"]); ?>
        </td>


        <td headers="<?php echo htmlspecialchars($rowId); ?> mediarecensioni"><?php echo number_format((float)$row["media_recensioni"], 1); ?></td>
        <td headers="<?php echo htmlspecialchars($rowId); ?> mediaesami"><?php echo number_format((float)$row["media_esami"], 0); ?></td>
      </tr>
    <?php
          $pos++;
        endforeach;
      endif;
    ?>
  </table>
</section>
