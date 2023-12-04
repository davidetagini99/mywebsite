<div class="footer">
    <div class="testo-footer">
        <?php
            $queryPrendiTestoFooter = "SELECT testo_footer FROM footer";
            $resultQueryPrendiTestoFooter = mysqli_query($conn, $queryPrendiTestoFooter);

            if($resultQueryPrendiTestoFooter->num_rows > 0) {
                while($row = $resultQueryPrendiTestoFooter->fetch_assoc()) {
                    $annoCorrente = date('Y');

                    echo '<p> ' . $row["testo_footer"] . ' ' . $annoCorrente . ' </p>'; // anno footer parametro DATE che andrà aggiornato allo scattare di ogni anno nuovo
                }
            }
            else {
                echo '<p>Errore</p>';
            }
        ?>
    </div>
</div>