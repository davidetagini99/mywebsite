
<!--
  <div class="hero-image">
  <div class="hero-text">
  <?php
      $queryPrendiTestoHero = "SELECT testo_header FROM header";
      $resultQueryPrendiTestoHero = mysqli_query($conn, $queryPrendiTestoHero);

      if ($resultQueryPrendiTestoHero) {
        while ($row = mysqli_fetch_assoc($resultQueryPrendiTestoHero)) {
          // Sanitize output before echoing
          $testoHeader = sanitizeOutput($row["testo_header"]);
          echo '<p> ' . $testoHeader . ' </p>';
        }
      }
    ?>
    <div class="hero-ctas">
      <button class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow" id="activateDarkMode">Dark mode</button>
      <button class="bg-white hover:bg-gray-100 text-gray-800 py-2 px-4 border border-gray-400 rounded shadow" id="gotoAreaRiservata">Area riservata</button>
    </div>
  </div>
</div>
-->

<!--
  <button type="button" class="btn" id="darkModeBtn">Dark mode</button>
      <a href="../mywebsite/pagine/area_riservata.php" class="btn" target="_blank">Area riservata</a>
-->