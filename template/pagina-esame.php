<?php
$anni = $templateParams["anni_accademici"] ?? [];
$sel  = $templateParams["anno_accademico"] ?? CURRENT_AA;
?>


<h2>
  Esami <?php echo ($sel === "all") ? "(tutti gli anni)" : htmlspecialchars($sel); ?>:
</h2>




<!-- DA SISTEMARE css --> 
<form class="form" method="get" action="exams.php">
  <label for="aa">Anno accademico:</label>
  <select id="aa" name="aa">
    <option value="all" <?php echo ($sel === "all") ? "selected" : ""; ?>>Tutti</option>
    <?php foreach($anni as $a): ?>
      <?php $val = $a["anno_accademico"]; ?>
      <option value="<?php echo htmlspecialchars($val); ?>" <?php echo ($sel === $val) ? "selected" : ""; ?>>
        <?php echo htmlspecialchars($val); ?>
      </option>
    <?php endforeach; ?>
  </select>
  <input class="button" type="submit" value="Vai" />
</form>


<section>
  <form class="filter-bar" role="search">
    <label class="visually-hidden" for="search">Cerca Esame</label>
    <input id="search" type="search" placeholder="Cerca Esame..." />
    <button type="submit" class="filter-btn">Cerca</button>
  </form> 
</section>


<section class="listexams">
  <ul>
    <?php
      $esami = $templateParams["esami"] ?? [];
      if(empty($esami)):
    ?>
      <li>Nessun appello disponibile.</li>
    <?php else:
      foreach($esami as $e):
        $label = "—";
        if(($e["ruolo"] ?? "") === "LEZIONI") $label = "Teorico";
        if(($e["ruolo"] ?? "") === "LABORATORIO") $label = "Pratico";

        $data = !empty($e["data_appello"]) ? date("d/m/Y", strtotime($e["data_appello"])) : "";
        $media = $e["media_voto_esame"] !== null ? number_format((float)$e["media_voto_esame"], 1) : "—";
    ?>
      <li>
        <span>
          <a href="professors.php?professore_id=<?php echo urlencode($e["professore_id"]); ?>&corso_id=<?php echo urlencode($e["corso_id"]); ?>">
            <?php echo htmlspecialchars($e["corso_nome"]); ?>
          </a>
        </span> -
        <span><?php echo htmlspecialchars($label); ?></span> -
        <span><?php echo htmlspecialchars($data); ?></span> -
        <span><?php echo htmlspecialchars($media); ?></span>
      </li>
    <?php
      endforeach;
      endif;
    ?>
  </ul>
</section>
