<div class="bg-white min-h-screen flex flex-col justify-center align-middle gap-3 border-b-4 border-red-500">
<?php
      $queryPrendiTestoHero = "SELECT testo_header FROM header";
      $resultQueryPrendiTestoHero = mysqli_query($conn, $queryPrendiTestoHero);

      if ($resultQueryPrendiTestoHero) {
        while ($row = mysqli_fetch_assoc($resultQueryPrendiTestoHero)) {
          // Sanitize output before echoing
          $testoHeader = sanitizeOutput($row["testo_header"]);
          echo '<p class="text-center text-red-500 text-2xl font-bold"> ' . $testoHeader . ' </p>';
        }
      }
    ?>
    <div class="flex md:flex-row flex-col w-full justify-center align-middle p-5 gap-3">
      <button id="profilo-github" type="button" class="bg-red-500 text-white text-center uppercase p-3 rounded-lg md:w-1/5">Sviluppo mobile</button>
      <button id="goto-area-riservata" type="button" class="bg-red-500 text-white text-center uppercase p-3 rounded-lg md:w-1/5">Area riservata</button>
    </div>
</div>

<!--
    <button id="attiva-mod-scura" class="bg-white text-black font-bold py-2 px-4 rounded uppercase">Modalità scura</button>
    <button id="goto-area-riservata" class="bg-white text-black font-bold py-2 px-4 rounded uppercase">Area riservata</button>
    <p class="text-center">Davide Tagini</p>
    <p class="text-center">Sviluppatore web</p>
-->