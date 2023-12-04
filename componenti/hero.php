<div class="hero-image">
  <div class="hero-text"> <!-- fare la tabella dei testi del sito -->
    <?php
      $queryPrendiTestoHero = "SELECT * FROM header";
      $resultQueryPrendiTestoHero = mysqli_query($conn, $queryPrendiTestoHero);

      if($resultQueryPrendiTestoHero->num_rows > 0) {
        while($row = $resultQueryPrendiTestoHero->fetch_assoc()) {
          echo '<p> ' . $row["testo_header"] . ' </p>';
        }
      }
    ?>
    <div class="hero-ctas">
      <button type="button" class="btn" id="darkModeBtn">Dark mode</button>
      <a href="../davidetagini-sitoweb-ufficiale/pagine/area_riservata.php" class="btn" target="_blank">Area riservata</a>
    </div>
  </div>
</div>