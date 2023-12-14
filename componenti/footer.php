

<!--
<div class="footer">
    <div class="testo-footer">
    <?php
        $queryPrendiTestoFooter = "SELECT testo_footer FROM footer";
        $resultQueryPrendiTestoFooter = mysqli_query($conn, $queryPrendiTestoFooter);

        if ($resultQueryPrendiTestoFooter) {
            while ($row = mysqli_fetch_assoc($resultQueryPrendiTestoFooter)) {
                // Sanitize output before echoing
                $testoFooter = sanitizeOutput($row["testo_footer"]);
                $annoCorrente = date('Y');

                echo '<p> ' . $testoFooter . ' ' . $annoCorrente . ' </p>'; // Update DATE parameter when a new year begins
            }
        } else {
            echo '<p>Errore</p>';
        }
        ?>
    </div>
</div>
-->