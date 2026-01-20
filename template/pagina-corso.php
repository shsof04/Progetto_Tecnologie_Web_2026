<h2>Corsi <?php echo htmlspecialchars($templateParams["anno_accademico"] ?? ""); ?>:</h2>

<section>
    <form class="bar bar--right" role="search">
        <label class="visually-hidden" for="search">Cerca Docente o Corso</label>
        <input id="search" type="search" placeholder="Cerca Docente o Corso..." />
        <button type="submit" class="btn">Cerca</button>
    </form>
</section>

<section>
    <table>
        <tr>
            <th id="corso">Corso</th>
            <th id="docenteteorico">Docente (modulo teorico)</th>
            <th id="docentepratico">Docente (modulo pratico)</th>
        </tr>

        <?php
            $corsi = $templateParams["corsi"] ?? [];
            if(empty($corsi)):
        ?>
        <tr>
            <td colspan="3">Nessun corso trovato per l'anno accademico selezionato.</td>
        </tr>
        <?php else:
            foreach($corsi as $row):
            $rowId = "corso_" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $row["corso_id"]);
        ?>
        <tr id="<?php echo htmlspecialchars($rowId); ?>">
            <th id="<?php echo htmlspecialchars($rowId . "_th"); ?>"><?php echo htmlspecialchars($row["corso_nome"]); ?></th>

            <td headers="<?php echo htmlspecialchars($rowId . "_th docenteteorico"); ?>">
                <?php if(!empty($row["prof_lezioni_id"])): ?>
                    <a href="professors.php?professore_id=<?php echo urlencode($row["prof_lezioni_id"]); ?>&corso_id=<?php echo urlencode($row["corso_id"]); ?>">
                        <?php echo htmlspecialchars($row["prof_lezioni_nome"]); ?>
                    </a>
                <?php else: ?>
                ///
                <?php endif; ?>
            </td>

            <td headers="<?php echo htmlspecialchars($rowId . "_th docentepratico"); ?>">
                <?php if(!empty($row["prof_lab_id"])): ?>
                    <a href="professors.php?professore_id=<?php echo urlencode($row["prof_lab_id"]); ?>&corso_id=<?php echo urlencode($row["corso_id"]); ?>">
                        <?php echo htmlspecialchars($row["prof_lab_nome"]); ?>
                    </a>
                <?php else: ?>
                ///
                <?php endif; ?>
            </td>
        </tr>
        <?php
          endforeach;
          endif;
        ?>
    </table>
</section>
