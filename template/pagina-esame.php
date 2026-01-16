<h2>Esami <?php echo htmlspecialchars($templateParams["anno_accademico"] ?? ""); ?>:</h2>

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
